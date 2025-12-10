<?php 
include "config.php"; 

$id = (int)$_GET['id'];

// LẤY BÀI VIẾT + USER
$post = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT posts.*, users.username 
  FROM posts 
  JOIN users ON posts.user_id = users.id 
  WHERE posts.id = $id
"));

if(!$post){
  die("Bài viết không tồn tại!");
}

if(!defined("XSS_LV2_FLAG")){
  define("XSS_LV2_FLAG", "FLAG{filter_bypass_xss_success}");
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="post-container">
  <div class="post-card">
    <h2><?= htmlspecialchars($post['title']) ?></h2>

    <p style="text-align:center; color:#aaa; font-size:14px;">
      Người đăng: <?= htmlspecialchars($post['username']) ?> • 
      Thời gian: <?= isset($post['created_at']) ? date("d/m/Y H:i", strtotime($post['created_at'])) : "Chưa có" ?>
    </p>

    <?php if($post['image']){ ?>
      <img src="uploads/<?= htmlspecialchars($post['image']) ?>" style="width:100%; border-radius:10px;">
    <?php } ?>

    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
      <div style="margin-top:14px; text-align:center;">
        <a href="edit_post.php?id=<?= $id ?>" class="btn-edit">Sửa</a>
        <a href="delete_post.php?id=<?= $id ?>" 
           onclick="return confirm('Xóa bài này?')" 
           class="btn-delete">Xóa</a>
      </div>
    <?php endif; ?>

    <!-- ===================== -->
    <!-- COMMENT + XSS HARD LAB -->
    <!-- ===================== -->
    <div class="comment-box">

      <?php if(isset($_SESSION['user_id'])): ?>
        <form method="post">
          <textarea name="content" placeholder="Bình luận đi nào" required></textarea>
          <button>Gửi bình luận</button>
        </form>
      <?php endif; ?>

      <?php
      if(isset($_POST['content'])) {
        $raw = $_POST['content'];           // giữ nguyên để check bypass
        $lower = strtolower($raw);

        // === FILTER SIÊU CHẶT: XÓA TẤT CẢ THẺ NGUY HIỂM ===
        $filtered = preg_replace([
          '#</?(script|iframe|svg|object|embed|link|meta|base|img|style|on\w+).*?>#i',
          '#javascript\s*:#i',
          '#data\s*:#i',
          '#expression\s*\(#i',
          '#@import#i'
        ], '', $raw);

        // === LƯU COMMENT ĐÃ LỌC (an toàn để hiển thị) ===
        mysqli_query($conn, "
          INSERT INTO comments (post_id, content) 
          VALUES ($id, '" . mysqli_real_escape_string($conn, $filtered) . "')
        ");

        // === CHECK BẰNG CHÍNH XÁC ĐIỀU KIỆN BẠN MUỐN ===
        $bypass_success = false;
        if (preg_match('/^\s*<\/script\s*>/i', $raw)) {
          
          if (preg_match('/script|%3cscript|&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;|&#115;&#99;&#114;&#105;&#112;&#116;/i', $lower)) {
            $bypass_success = true;
          }
        }

        if ($bypass_success) {
          echo "
          <div style='background:#000;color:#0f0;padding:20px;margin:20px 0;text-align:center;font-weight:bold;border:3px solid lime;border-radius:10px;'>
            XSS HARD FILTER BYPASS THÀNH CÔNG!<br><br>
            FLAG: <b>" . XSS_LV2_FLAG . "</b>
          </div>";
        }
      }
      ?>

      <!-- === HIỂN THỊ COMMENT (AN TOÀN 100%) === -->
      <?php
      $res = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = $id ORDER BY id DESC");
      while($c = mysqli_fetch_assoc($res)) {
        echo '<div class="comment">';
       if (isset($bypass_success) && $bypass_success) {
    // ⚠️ CHỈ LAB MODE MỚI CHO CHẠY SCRIPT
    echo nl2br($c['content']);   // ❌ KHÔNG ESCAPE → SCRIPT CHẠY
} else {
    echo nl2br(htmlspecialchars($c['content'])); // ✅ NGƯỜI DÙNG BÌNH THƯỜNG
}

        echo '</div>';
      }
      ?>
    </div>

    <a href="index.php" class="back-btn">Quay về trang chủ</a>
  </div>
</div>