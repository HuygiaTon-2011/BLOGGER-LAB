<?php
include "config.php";

/* ✅ BẮT BUỘC PHẢI ĐĂNG NHẬP MỚI ĐƯỢC ĐĂNG BÀI */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/* ✅ XỬ LÝ KHI BẤM ĐĂNG BÀI */
if (isset($_POST['title'])) {

    $title   = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // ✅ XỬ LÝ UPLOAD ẢNH
    $img = "";

    if (!empty($_FILES['img']['name'])) {
        $img = time() . "_" . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "uploads/" . $img);
    }

    // ❌ CỐ TÌNH KHÔNG CHỐNG SQLI/XSS (PHỤC VỤ LAB)
    mysqli_query($conn, "
        INSERT INTO posts(title, content, image, user_id)
        VALUES ('$title', '$content', '$img', $user_id)
    ");

    // ✅ ĐĂNG XONG → QUAY VỀ TRANG CHỦ
    header("Location: index.php");
    exit;
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="box">
    <h2>Đăng Bài Viết</h2>

    <form method="post" enctype="multipart/form-data">
        <input name="title" placeholder="Tiêu đề bài viết" required>

        <textarea name="content" rows="6" placeholder="Nội dung bài viết..." required></textarea>

        <input type="file" name="img">

        <button type="submit">Đăng bài</button>
    </form>

    <a href="index.php" style="display:block;text-align:center;margin-top:12px;color:#9aa4ff">
        ⬅ Quay về trang chủ
    </a>
</div>
