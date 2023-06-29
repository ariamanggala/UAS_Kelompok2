<?php
include "./../koneksi.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
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

  <!-- DetailHp -->

  <section id="DetailHp">
    <div class="container py-5">
      <div class="row d-flex justify-content-start">
        <div class="col-12 bg-primary text-light mb-5 d-flex">
          <h3>Details Smartphone</h3>
        </div>
        <div class="col-6 photo">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <?php
              include "./../koneksi.php";

              // Mendapatkan id_hp dari parameter URL
              $idHp = $_GET['id'];

              $query = mysqli_query($koneksi, "SELECT * FROM data_hp 
                             INNER JOIN brand ON data_hp.id_merk = brand.id_merk
                             WHERE data_hp.id_hp = $idHp");
              $data = mysqli_fetch_array($query);
              ?>

              <div class="swiper-slide">
                <img src="Assets/img/<?= $data['gambar_utama']; ?>" />
              </div>
              <div class="swiper-slide">
                <img src="Assets/img/<?= $data['gambar_pendukung']; ?>" />
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <div class="col-6 rincian">
          <div class="merk">
            <img class="logo" src="Assets/img/<?= $data['logo']; ?>" alt="logo brand">
            <!-- <p class="brand"><?= $data['merk']; ?></p> -->
          </div>
          <h4 class="nama_hp"><?= $data['nama_hp']; ?></h4>
          <h5 class="harga">Rp. <?= $data['harga']; ?></h5>
          <p class="stok">Stok tersedia : <?= $data['stok']; ?></p>
          <hr>
          <div class="spek mb-4">
            <p>Spesifikasi :</p>
            <div class="detail d-flex">
              <iconify-icon icon="ion:battery-half"></iconify-icon>
              <?= $data['baterai']; ?>mAH
            </div>
            <div class="detail d-flex">
              <iconify-icon icon="fluent-mdl2:offline-storage-solid"></iconify-icon>
              <?= $data['prosesor']; ?>
            </div>
            <div class="detail d-flex">
              <iconify-icon icon="basil:processor-outline"></iconify-icon>
              Ram <?= $data['memori']; ?> GB
            </div>
          </div>
          <?php
          if ($data['stok'] == 0) {
            echo '<button class="btn button" onclick="showAlert()">Buy</button>';
          } else {
            echo '<a class="button" href="pembelian.php?id=' . $data['id_hp'] . '">Buy</a>';
          }
          ?>
          <button onclick="window.history.back();">Back</button>
        </div>
      </div>
    </div>
  </section>
  <!-- DetailHp END -->

  <!-- Footer -->
  <?php
  include 'Assets/Komponen/Footer.php';
  ?>
  <!-- Footer END -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <!-- Iconify -->
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      effect: "cube",
      grabCursor: true,
      cubeEffect: {
        shadow: true,
        slideShadows: true,
        shadowOffset: 20,
        shadowScale: 0.94,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>

  <script>
    function showAlert() {
      alert("Mohon maaf, untuk saat ini barang tidak tersedia.");
    }
  </script>
</body>

</html>