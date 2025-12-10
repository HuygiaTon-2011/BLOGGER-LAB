<?php
include "config.php";
session_start();

$id = (int)$_GET['id'];

// ✅ Lấy bài viết
$post = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT * FROM posts WHERE id = $id
"));

if(!$post){
  die("Không tìm thấy bài!");
}

// ================== BROKEN ACCESS CONTROL LAB ==================
$brokenTriggered = false;

if(!LAB_MODE){
  // ✅ CHẾ ĐỘ AN TOÀN
  if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $post['user_id']){
    die("❌ Bạn không có quyền xóa!");
  }
} else {
  // ❌ LAB MODE – CHO PHÉP TRUY CẬP TRÁI PHÉP NHƯNG KHÔNG XÓA THẬT
  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != $post['user_id']){
    $brokenTriggered = true;
  }
}

// ================== XỬ LÝ XÓA ==================
if($brokenTriggered){
  // ✅ CHỈ HIỆN FLAG – KHÔNG PHÁ DỮ LIỆU
  echo "
  <div style='
    background:black;
    color:#00ff00;
    padding:20px;
    margin:30px auto;
    text-align:center;
    font-weight:bold;
    border-radius:10px;
    max-width:700px;
  '>
    ✅ BROKEN ACCESS CONTROL – XÓA TRÁI PHÉP THÀNH CÔNG!<br><br>
    🚩 FLAG: <b>".BROKEN_FLAG."</b><br><br>
    (LAB MODE – KHÔNG XÓA THẬT DỮ LIỆU)
  </div>
  <a href='index.php' style='
    display:block;
    margin:0 auto;
    width:200px;
    text-align:center;
    background:#4f6cff;
    padding:10px;
    border-radius:8px;
    color:white;
    text-decoration:none;
  '>⬅ Quay về</a>
  ";
  exit;
}

// ✅ CHỈ CHỦ BÀI MỚI BỊ XÓA THẬT
mysqli_query($conn,"DELETE FROM posts WHERE id = $id");

header("Location: index.php");
exit;
