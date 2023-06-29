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

$id_user = $_GET['id_user'];

// Ambil data HP dari tabel user berdasarkan ID
$queryHp = "SELECT * FROM user WHERE id_user = '$id_user'";
$resultHp = mysqli_query($koneksi, $queryHp);
$rowUser = mysqli_fetch_assoc($resultHp);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Proses update data HP
  $queryUpdateHp = "UPDATE user SET username='$username', password='$password' WHERE id_user='$id_user'";
  $resultUpdateHp = mysqli_query($koneksi, $queryUpdateHp);

  // Proses unggah Photo
  if ($_FILES['photo']['name']) {
    $namaPhoto = $_FILES['photo']['name'];
    $namaSementaraPhoto = $_FILES['photo']['tmp_name'];
    $pathPhoto = "../../Frontend/Assets/img/" . $namaPhoto;
    move_uploaded_file($namaSementaraPhoto, $pathPhoto);

    $queryUpdatePhoto = "UPDATE user SET photo='$namaPhoto' WHERE id_user='$id_user'";
    $resultUpdatePhoto = mysqli_query($koneksi, $queryUpdatePhoto);
  }

  if ($resultUpdateHp) {
    // Jika berhasil diupdate, redirect ke halaman data HP
    header("Location: ../index.php?page=data_user");
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
              <h3>Edit Data User</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="username" class="form-label">Nama User</label>
                  <input type="text" class="form-control" id="username" name="username" value="<?php echo $rowUser['username']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $rowUser['password']; ?>" required>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="photo" class="form-label">Photo</label>
                  <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                  <?php if ($rowUser['photo']) : ?>
                    <img src="../../Frontend/Assets/img/<?php echo $rowUser['photo']; ?>" alt="Photo" width="200">
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