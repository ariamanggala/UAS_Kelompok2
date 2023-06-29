<?php
include "./../koneksi.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Pengecekan akses berdasarkan level
if ($_SESSION['level'] === 'Admin') {
  header("Location: ../backend/");
  exit();
} elseif ($_SESSION['level'] === 'User') {
  // Tetapkan halaman home.php untuk user
} else {
  // Jika level tidak valid, alihkan pengguna ke halaman login
  header("Location: ../index.php");
  exit();
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
  <!-- Swipper JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- Font Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/frontend.css">
</head>

<body>

  <!-- Navbar -->
  <?php
  include 'Assets/Komponen/Navbar.php';
  ?>
  <!-- Navbar END -->

  <!-- Header -->
  <?php
  include 'Assets/Komponen/Header.php';
  ?>
  <!-- Header END -->
  <!-- Brand -->
  <?php
  include 'Assets/Komponen/Brand.php';
  ?>
  <!-- Brand END -->
  <!-- LiteCatalog -->
  <?php
  include 'Assets/Komponen/LiteCatalog.php';
  ?>
  <!-- LiteCatalog END -->
  <!-- Article -->
  <?php
  include 'Assets/Komponen/Article.php';
  ?>
  <!-- Article END -->
  <!-- SectionAbout -->
  <?php
  include 'Assets/Komponen/SectionAbout.php';
  ?>
  <!-- SectionAbout END -->
  <!-- Footer -->
  <?php
  include 'Assets/Komponen/Footer.php';
  ?>
  <!-- Footer END -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <!-- Iconify -->
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <!-- Swipper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
    // Inisialisasi Swiper
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 4.5,
          spaceBetween: 50,
        },
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

</body>

</html>