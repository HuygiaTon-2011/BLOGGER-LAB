<?php
include "config.php";

if(isset($_POST['u'])){
  $u = $_POST['u'];
  $p = $_POST['p'];

  $q = mysqli_query($conn,"SELECT * FROM users WHERE username='$u'");

  if(mysqli_num_rows($q)){
    $r = mysqli_fetch_assoc($q);

    // ✅ SO SÁNH PASSWORD DẠNG THƯỜNG (PHỤC VỤ SQLi LAB)
    if($p === $r['password']){
        $_SESSION['user_id'] = $r['id'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Sai mật khẩu!";
    }
  } else {
    $error = "Tài khoản không tồn tại!";
  }
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="box">
<h2>Đăng Nhập</h2>

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="post">
  <input name="u" placeholder="Username" required>
  <input name="p" type="password" placeholder="Password" required>
  <button>Đăng nhập</button>
</form>

<a href="register.php">Chưa có tài khoản? Đăng ký</a>
</div>
