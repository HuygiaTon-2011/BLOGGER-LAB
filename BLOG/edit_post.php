<?php
include "config.php";
session_start();

$id = (int)$_GET['id'];

// ✅ Lấy bài viết
$post = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT * FROM posts WHERE id = $id
"));

if(!$post){
  die("Bài viết không tồn tại!");
}

// ================== BROKEN ACCESS CONTROL LAB ==================
$brokenTriggered = false;

if(!LAB_MODE){
  // ✅ CHẾ ĐỘ AN TOÀN
  if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $post['user_id']){
    die("❌ Bạn không có quyền sửa bài!");
  }
} else {
  // ❌ CHẾ ĐỘ LAB – CỐ TÌNH BỎ CHECK QUYỀN
  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != $post['user_id']){
    $brokenTriggered = true;
  }
}

// ================== XỬ LÝ UPDATE ==================
if(isset($_POST['title'])){
  $title   = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  mysqli_query($conn,"
    UPDATE posts 
    SET title='$title', content='$content' 
    WHERE id=$id
  ");
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="post-container">
  <div class="post-card">
    <h2>Sửa bài viết</h2>

    <?php if($brokenTriggered): ?>
      <div style="
        background:black;
        color:#00ff00;
        padding:14px;
        margin-bottom:14px;
        text-align:center;
        font-weight:bold;
        border-radius:8px;
      ">
        ✅ BROKEN ACCESS CONTROL THÀNH CÔNG!<br>
        🚩 FLAG: <?= BROKEN_FLAG ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>">
      <textarea name="content"><?= htmlspecialchars($post['content']) ?></textarea>
      <button>Cập nhật</button>
    </form>

    <a href="index.php" class="back-btn">⬅ Quay về</a>
  </div>
</div>
