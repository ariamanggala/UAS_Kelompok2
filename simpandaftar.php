<?php
// Koneksi ke database
include "koneksi.php";

// Ambil data dari form daftar.php
$username = $_POST['username'];
$password = $_POST['password'];
$photo = $_POST['photo'];

// Query untuk memeriksa apakah username sudah ada dalam database
$checkQuery = "SELECT * FROM user WHERE username='$username'";
$checkResult = mysqli_query($koneksi, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
  // Username sudah ada dalam database, tampilkan pesan error
  echo '<script>alert("Username already exists. Please choose a different username."); window.location.href = "daftar.php";</script>';
  exit();
} else {
  // Generate ID User secara acak
  $id_user = uniqid();

  // Query untuk menambahkan user baru ke database
  $query = "INSERT INTO user (id_user, username, password, photo, level) VALUES ('$id_user', '$username', '$password', '$photo', 'user')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Registrasi berhasil, arahkan ke halaman login
    echo '<script>alert("Registration successful. Please login with your new account."); window.location.href = "login.php";</script>';
    exit();
  } else {
    // Registrasi gagal, tampilkan pesan error
    echo '<script>alert("Registration failed. Please try again."); window.location.href = "daftar.php";</script>';
    exit();
  }
}
