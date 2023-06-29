<?php
include "../../koneksi.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Pengecekan akses berdasarkan level
if ($_SESSION['level'] === 'User') {
  header("Location: ../frontend/home.php");
  exit();
} elseif ($_SESSION['level'] !== 'Admin') {
  header("Location: ../../index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul_artikel = $_POST['judul_artikel'];
  $content_artikel = $_POST['content_artikel'];
  $cover = $_FILES['cover']['name'];
  $waktu_dibuat = date('Y-m-d H:i:s', strtotime($_POST['waktu_dibuat']));
  $slug = $_POST['slug'];

  // Pengecekan apakah data Artikel sudah ada
  $queryCheck = "SELECT * FROM artikel WHERE judul_artikel = '$judul_artikel'";
  $resultCheck = mysqli_query($koneksi, $queryCheck);

  if (mysqli_num_rows($resultCheck) > 0) {
    // Jika data Artikel sudah ada, tampilkan alert
    echo "<script>alert('Data Artikel sudah ada.');</script>";
  } else {
    // Proses query untuk menambahkan data Artikel ke dalam tabel artikel
    $queryDataArtikel = "INSERT INTO artikel (judul_artikel, content_artikel, cover, waktu_dibuat, slug)
                  VALUES ('$judul_artikel', '$content_artikel', '$cover', '$waktu_dibuat', '$slug')";
    $resultDataArtikel = mysqli_query($koneksi, $queryDataArtikel);

    if ($resultDataArtikel) {
      // Mendapatkan ID artikel yang baru saja di-generate
      $idHp = mysqli_insert_id($koneksi);

      // Lokasi folder tempat menyimpan gambar
      $targetDir = "../../Frontend/Assets/img/";

      // Upload Cover
      $targetFileUtama = $targetDir . basename($cover);
      move_uploaded_file($_FILES['cover']['tmp_name'], $targetFileUtama);

      if ($resultDataArtikel) {
        echo "<script>alert('Data Artikel berhasil ditambahkan.');</script>";
        header("Location: ../index.php?page=artikel");
        exit();
      } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan data Artikel.');</script>";
      }
    } else {
      echo "<script>alert('Terjadi kesalahan saat menambahkan data Artikel.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include "../Assets/Komponen/PageNavbar.php" ?>
    <!-- /.navbar END -->

    <!-- Main Sidebar Container -->
    <?php include '../Assets/Komponen/PageSidebar.php' ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section id="TambahData">
        <div class="container">
          <div class="row">
            <div class="col-md-6 offset-md-3">
              <h3>Tambah Data Artikel</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="judul_artikel" class="form-label">Judul Artikel</label>
                  <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" required>
                </div>
                <div class="mb-3">
                  <label for="content_artikel" class="form-label">content_artikel</label>
                  <input type="text" class="form-control" id="content_artikel" name="content_artikel" required>
                </div>
                <div class="mb-3">
                  <label for="cover" class="form-label">Cover</label>
                  <input type="file" class="form-control" id="cover" name="cover" required>
                </div>
                <div class="mb-3">
                  <label for="waktu_dibuat" class="form-label">Waktu</label>
                  <input type="datetime-local" class="form-control" id="waktu_dibuat" name="waktu_dibuat" required>
                </div>
                <div class="mb-3">
                  <label for="slug" class="form-label">slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
              </form>
            </div>
          </div>
        </div>
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      <strong>Powered by <a href="https://openai.com/">OpenAI</a></strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="../plugins/raphael/raphael.min.js"></script>
  <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard2.js"></script>
  <script>
    function confirmDelete() {
      if (confirm('Anda yakin menghapus data?')) {
        //action confirmed
        alert('Data berhasil dihapus');
      } else {
        //action cancelled
        alert('Data batal dihapus');
      }
    }
  </script>
</body>

</html>