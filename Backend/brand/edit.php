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

$id_merk = $_GET['id_merk'];

// Ambil data HP dari tabel user berdasarkan ID
$queryBrand = "SELECT * FROM brand WHERE id_merk = '$id_merk'";
$resultBrand = mysqli_query($koneksi, $queryBrand);
$rowBrand = mysqli_fetch_assoc($resultBrand);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama_merk = $_POST['nama_merk'];

  // Proses update data HP
  $queryUpdateNavbar = "UPDATE brand SET nama_merk='$nama_merk' WHERE id_merk='$id_merk'";
  $resultUpdateNavbar = mysqli_query($koneksi, $queryUpdateNavbar);

  // Proses unggah logo
  if ($_FILES['logo']['name']) {
    $namalogo = $_FILES['logo']['name'];
    $namaSementaralogo = $_FILES['logo']['tmp_name'];
    $pathlogo = "../../Frontend/Assets/img/" . $namalogo;
    move_uploaded_file($namaSementaralogo, $pathlogo);

    $queryUpdatelogo = "UPDATE brand SET logo='$namalogo' WHERE id_merk='$id_merk'";
    $resultUpdatelogo = mysqli_query($koneksi, $queryUpdatelogo);
  }

  if ($resultUpdateNavbar) {
    // Jika berhasil diupdate, redirect ke halaman data HP
    header("Location: ../index.php?page=brand");
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
              <h3>Edit Data Brand</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_merk" class="form-label">Nama User</label>
                  <input type="text" class="form-control" id="nama_merk" name="nama_merk" value="<?php echo $rowBrand['nama_merk']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="logo" class="form-label">logo</label>
                  <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                  <?php if ($rowBrand['logo']) : ?>
                    <img src="../../Frontend/Assets/img/<?php echo $rowBrand['logo']; ?>" alt="logo" width="200">
                  <?php endif; ?>
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