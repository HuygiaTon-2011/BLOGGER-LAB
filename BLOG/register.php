<?php 
include "config.php";

if(isset($_POST['u'])){
  $u = $_POST['u'];
  $p = $_POST['p'];

  // ✅ CHECK TRÙNG USERNAME
  $check = mysqli_query($conn,"SELECT * FROM users WHERE username='$u'");

  if(mysqli_num_rows($check) > 0){
    $error = "❌ Tài khoản đã tồn tại!";
  }else{
    mysqli_query($conn,"INSERT INTO users(username,password,role) 
    VALUES('$u','$p','user')");
    $success = "✅ Đăng ký thành công, mời đăng nhập!";
  }
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="box">
<h2>Đăng Ký</h2>

<?php 
if(isset($error))   echo "<p style='color:red'>$error</p>";
if(isset($success)) echo "<p style='color:green'>$success</p>";
?>

<form method="post">
  <input name="u" placeholder="Username" required>
  <input name="p" type="password" placeholder="Password" required>
  <button>Đăng ký</button>
</form>

<a href="login.php">Quay lại đăng nhập</a>
</div>
