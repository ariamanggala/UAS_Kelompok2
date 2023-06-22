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

  <!-- Detail Beli -->
  <?php
  include "./../koneksi.php";

  // Mendapatkan id_hp dari parameter URL
  $idHp = $_GET['id'];

  // Query untuk mendapatkan data smartphone
  $query = mysqli_query($koneksi, "SELECT * FROM data_hp 
                                 INNER JOIN spek_hp ON data_hp.id_spek = spek_hp.id_spek
                                 WHERE data_hp.id_hp = $idHp");
  $data = mysqli_fetch_array($query);

  // Proses pembelian
  if (isset($_POST['beli'])) {
    if (isset($_SESSION['id_user'])) {
      $id_user = $_SESSION['id_user']; // Ambil nilai id_user dari sesi
      $id_hp = $_POST['id_hp'];
      $jumlah = $_POST['jumlah'];
      $total_harga = $data['harga'] * $jumlah;
      $status = 'Menunggu'; // Default status pembelian

      // Validasi stok dan jumlah pembelian
      if ($jumlah > 0 && $jumlah <= $data['stok']) {
        // Lakukan proses pembelian atau penyimpanan data ke tabel tb_pembelian
        $insertQuery = "INSERT INTO tb_pembelian (id_user, Id_hp, jumlah, total_harga, status)
                    VALUES ('$id_user', '$id_hp', '$jumlah', '$total_harga', '$status')";
        $result = mysqli_query($koneksi, $insertQuery);
        if ($result) {
          // Update stok pada tabel data_hp
          $newStok = $data['stok'] - $jumlah;
          mysqli_query($koneksi, "UPDATE data_hp SET stok = $newStok WHERE id_hp = $idHp");

          // Tampilkan pesan sukses atau lakukan tindakan lain setelah pembelian berhasil
          echo "<script>alert('Pembelian berhasil. Mohon tunggu konfirmasi pembelian untuk dikirimkan');</script>";
          echo "<script>window.location.href = 'Profil.php?id_user=" . $_SESSION['id_user'] . "';</script>";
        } else {
          echo "<script>alert('Terjadi kesalahan dalam pembelian. Silakan coba lagi.');</script>";
        }
      } elseif ($jumlah > $data['stok']) {
        echo "<script>alert('Jumlah pembelian melebihi stok yang tersedia. Harap periksa kembali stok yang tersedia.');</script>";
      } else {
        echo "<script>alert('Jumlah pembelian tidak valid. Harap periksa stok yang tersedia.');</script>";
      }
    } else {
      echo "<script>alert('Anda harus login terlebih dahulu.');</script>";
    }
  }
  ?>
  <section id="Pembelian">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h4 class="nama_hp"><?= $data['nama_hp']; ?></h4>
          <img src="Assets/img/<?= $data['gambar_utama']; ?>" alt="gambar utama">
        </div>
        <div class="col-md-6">
          <h3>Form Pembelian</h3>
          <form action="" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin melanjutkan pembelian ini?');">
            <?php
            if (isset($_SESSION['id_user'])) {
              // Jika ada sesi id_user, masukkan nilainya sebagai input tersembunyi
              echo "<input type='hidden' name='id_user' value='{$_SESSION['id_user']}'>";
            }
            ?>
            <input type="hidden" name="id_hp" value="<?= $data['id_hp']; ?>">
            <div class="form-group">
              <label for="jumlah">Jumlah:</label>
              <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" max="<?= $data['stok']; ?>" onchange="hitungTotalHarga()" required>
            </div>
            <div class="form-group">
              <label for="total_harga">Total Harga:</label>
              <input type="text" class="form-control" name="total_harga" id="total_harga" value="<?= $data['harga']; ?>" readonly>
            </div>
            <button type="submit" name="beli" class="btn btn-primary">Buy</button>
            <button onclick="window.history.back();">Back</button>

          </form>
        </div>
      </div>
    </div>
  </section>

  <script>
    function hitungTotalHarga() {
      var jumlah = parseInt(document.getElementById('jumlah').value);
      var harga = <?= $data['harga']; ?>;
      var totalHarga = jumlah * harga;
      document.getElementById('total_harga').value = totalHarga;
    }
  </script>

  <!-- Detail Beli END -->

  <!-- Footer -->
  <?php
  include 'Assets/Komponen/Footer.php';
  ?>
  <!-- Footer END -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <!-- Iconify -->
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

  <!-- Stok -->
  <script>
    document.querySelector("form").addEventListener("submit", function(event) {
      var stok = <?= $data['stok']; ?>;
      var jumlah = parseInt(document.getElementById("jumlah").value);

      if (jumlah > stok || jumlah <= 0) {
        event.preventDefault();
        alert("Jumlah pembelian tidak valid. Harap periksa stok yang tersedia.");
      }
    });
  </script>
  <script>
    function hitungTotalHarga() {
      var jumlah = parseInt(document.getElementById('jumlah').value);
      var harga = <?= $data['harga']; ?>;
      var totalHarga = jumlah * harga;
      document.getElementById('total_harga').value = totalHarga;
    }
  </script>
</body>

</html>