<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_SESSION['username'])) {
  header("Location: frontend/home.php");
  exit();
}

if (isset($_POST['submit'])) {
  include("koneksi.php");

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE username='$username'";
  $result = mysqli_query($koneksi, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];
    $level = $row['level'];

    // Memeriksa kecocokan password yang dimasukkan dengan password yang tersimpan dalam database
    if ($password === $stored_password) {
      $_SESSION['username'] = $row['username'];
      $_SESSION['id_user'] = $row['id_user'];

      if ($level === 'Admin') {
        header("Location: admin.php");
      } else {
        header("Location: frontend/home.php");
      }
      exit();
    } else {
      echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
  } else {
    echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
  }
}
?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UAS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Icon FontAwesome -->
  <script src="https://kit.fontawesome.com/decb368884.js" crossorigin="anonymous"></script>
  <!-- Font Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/frontend.css">
</head>

<body>

  <!-- Login -->
  <form action="index.php" method="post">
    <div class="input-group mb-3">
      <input type="text" name="username" class="form-control" placeholder="username" required>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-user"></span>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name='password' class="form-control" placeholder="Password" required>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-8">
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <!-- Login END -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <!-- Iconify -->
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>