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

$id_artikel = $_GET['id_artikel'];

// Ambil data Artikel dari tabel artikel berdasarkan ID
$queryHp = "SELECT * FROM artikel WHERE id_artikel = '$id_artikel'";
$resultHp = mysqli_query($koneksi, $queryHp);
$rowArtikel = mysqli_fetch_assoc($resultHp);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $judul_artikel = $_POST['judul_artikel'];
  $content_artikel = $_POST['content_artikel'];
  $waktu_dibuat = date('Y-m-d H:i:s', strtotime($_POST['waktu_dibuat']));
  $slug = $_POST['slug'];

  // Proses update data Artikel
  $queryUpdateHp = "UPDATE artikel SET judul_artikel='$judul_artikel', content_artikel='$content_artikel', slug='$slug' WHERE id_artikel='$id_artikel'";
  $resultUpdateHp = mysqli_query($koneksi, $queryUpdateHp);

  // Proses unggah gambar utama
  if ($_FILES['cover']['name']) {
    $namaGambarUtama = $_FILES['cover']['name'];
    $namaSementaraGambarUtama = $_FILES['cover']['tmp_name'];
    $pathGambarUtama = "../../Frontend/Assets/img/" . $namaGambarUtama;
    move_uploaded_file($namaSementaraGambarUtama, $pathGambarUtama);

    $queryUpdateGambarUtama = "UPDATE artikel SET cover='$namaGambarUtama' WHERE id_artikel='$id_artikel'";
    $resultUpdateGambarUtama = mysqli_query($koneksi, $queryUpdateGambarUtama);
  }

  if ($resultUpdateHp) {
    // Jika berhasil diupdate, redirect ke halaman data Artikel
    header("Location: ../index.php?page=artikel");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
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
              <h3>Edit Data Artikel</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="judul_artikel" class="form-label">Judul Artikel</label>
                  <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="<?php echo $rowArtikel['judul_artikel']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="content_artikel" class="form-label">content_artikel</label>
                  <input type="text" class="form-control" id="content_artikel" name="content_artikel" value="<?php echo $rowArtikel['content_artikel']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="cover" class="form-label">cover</label>
                  <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                  <?php if ($rowArtikel['cover']) : ?>
                    <img src="../../Frontend/Assets/img/<?php echo $rowArtikel['cover']; ?>" alt="cover" width="200">
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label for="waktu_dibuat" class="form-label">Waktu</label>
                  <input type="datetime-local" class="form-control" id="waktu_dibuat" name="waktu_dibuat" value="<?php echo $rowArtikel['waktu_dibuat']; ?>" required readonly>

                </div>
                <div class="mb-3">
                  <label for="slug" class="form-label">slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" value="<?php echo $rowArtikel['slug']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Data</button>
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
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Footer Section</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
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
</body>

</html>