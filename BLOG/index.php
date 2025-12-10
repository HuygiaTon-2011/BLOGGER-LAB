<?php include "config.php"; ?>
 <!-- =================KHÔNG CÓ GÌ ĐÂY MÀ TÌM TRONG NÀY ================= -->

<link rel="stylesheet" href="assets/style.css">

<div class="container">

  <div class="header">
    <h2>WEB BLOG LAB</h2>

    <div class="menu">
    <?php if(isset($_SESSION['user_id'])): ?>
        ✅ Xin chào!
        <a href="add_post.php">Đăng bài</a>
        <a href="logout.php">Đăng xuất</a>
    <?php else: ?>
        <a href="login.php">Đăng nhập</a>
        <a href="register.php">Đăng ký</a>
    <?php endif; ?>
    </div>
  </div>


  <div class="hero">
    <h1>Chào mừng đến với Web Blog LAB</h1>
    <p>Tôi đã giấu 3 cái flag. Ráng mà tìm 😈</p>
  </div>

 
  <div class="main">

  
    <div class="blog-grid">
    <?php
    $res = mysqli_query($conn,"
        SELECT posts.*, users.username 
        FROM posts 
        JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC
    ");

    while($r = mysqli_fetch_assoc($res)){
    ?>
      <div class="blog-card">

        <?php if(!empty($r['image'])){ ?>
          <img src="uploads/<?= htmlspecialchars($r['image']) ?>">
        <?php } ?>

        <div class="content">
          <h3><?= htmlspecialchars($r['title']) ?></h3>

 
          <p style="font-size:13px;color:#aaa;margin:4px 0">
            👤 <?= htmlspecialchars($r['username']) ?> • 🕒 
            <?= !empty($r['created_at']) 
                ? date("d/m/Y H:i", strtotime($r['created_at'])) 
                : "Chưa có thời gian" ?>
          </p>

      
          <p>
            <?= substr(strip_tags($r['content']),0,100) ?>...
          </p>

          <a href="post.php?id=<?= $r['id'] ?>">Xem chi tiết</a>

    
          <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $r['user_id']): ?>
            <div style="margin-top:10px; display:flex; gap:10px;">
              
              <a href="edit_post.php?id=<?= $r['id'] ?>" class="btn-edit">
                ✏️ Sửa
              </a>

              <a href="delete_post.php?id=<?= $r['id'] ?>" 
                 onclick="return confirm('Xóa bài viết này?')"
                 class="btn-delete">
                🗑️ Xóa
              </a>

            </div>
          <?php endif; ?>

        </div>
      </div>
    <?php } ?>
    </div>


    <div class="sidebar">
      <h4>Giới thiệu</h4>
      <p>Web blog LAB phục vụ demo tấn công và phòng thủ web.</p>

      <h4>Chức năng</h4>
      <ul>
        <li>✅ Blog & Upload ảnh</li>
        <li>✅ Stored XSS</li>
        <li>✅ Blind SQL Injection</li>
        <li>✅ Broken Access Control</li>
      </ul>

      <h4>Quản trị</h4>
      <a href="admin.php">Vào trang Admin</a>
    </div>

  </div>
</div>
