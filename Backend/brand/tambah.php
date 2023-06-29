<?php
include "../../koneksi.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_merk = $_POST['nama_merk'];
  $logo = $_FILES['logo']['name'];

  // Lokasi folder tempat menyimpan gambar
  $targetDir = "../../Frontend/Assets/img/";
  // Upload Logo
  $targetFileLogo = $targetDir . basename($logo);
  move_uploaded_file($_FILES['logo']['tmp_name'], $targetFileLogo);

  // Insert data into the user table
  $queryInsertBrand = "INSERT INTO brand (id_merk, nama_merk, logo) VALUES ('$id_merk', '$nama_merk', '$logo')";
  $resultInsertUser = mysqli_query($koneksi, $queryInsertBrand);

  if ($resultInsertUser) {
    echo "<script>alert('Data brand berhasil ditambahkan.');</script>";
    header("Location: ../index.php?page=brand");
    exit();
  } else {
    echo "<script>alert('Terjadi kesalahan saat menambahkan data brand.');</script>";
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
              <h3>Tambah Data Brand</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_merk" class="form-label">Nama Brand</label>
                  <input type="text" class="form-control" id="nama_merk" name="nama_merk" required>
                </div>
                <div class="mb-3">
                  <label for="logo" class="form-label">Logo</label>
                  <input type="file" class="form-control" id="logo" name="logo" required>
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

  <!-- OPTIONAL SCRIPTS -->
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard2.js"></script>
</body>

</html>