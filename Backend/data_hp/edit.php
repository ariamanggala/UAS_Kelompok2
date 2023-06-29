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

$id_hp = $_GET['id_hp'];

// Ambil data HP dari tabel data_hp berdasarkan ID
$queryHp = "SELECT * FROM data_hp WHERE id_hp = '$id_hp'";
$resultHp = mysqli_query($koneksi, $queryHp);
$rowHp = mysqli_fetch_assoc($resultHp);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $namaHp = $_POST['nama_hp'];
  $idMerk = $_POST['id_merk'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];

  // Proses update data HP
  $queryUpdateHp = "UPDATE data_hp SET nama_hp='$namaHp', id_merk='$idMerk', harga='$harga', stok='$stok' WHERE id_hp='$id_hp'";
  $resultUpdateHp = mysqli_query($koneksi, $queryUpdateHp);

  // Proses unggah gambar utama
  if ($_FILES['gambar_utama']['name']) {
    $namaGambarUtama = $_FILES['gambar_utama']['name'];
    $namaSementaraGambarUtama = $_FILES['gambar_utama']['tmp_name'];
    $pathGambarUtama = "../../Frontend/Assets/img/" . $namaGambarUtama;
    move_uploaded_file($namaSementaraGambarUtama, $pathGambarUtama);

    $queryUpdateGambarUtama = "UPDATE data_hp SET gambar_utama='$namaGambarUtama' WHERE id_hp='$id_hp'";
    $resultUpdateGambarUtama = mysqli_query($koneksi, $queryUpdateGambarUtama);
  }

  // Proses unggah gambar pendukung
  if ($_FILES['gambar_pendukung']['name']) {
    $namaGambarPendukung = $_FILES['gambar_pendukung']['name'];
    $namaSementaraGambarPendukung = $_FILES['gambar_pendukung']['tmp_name'];
    $pathGambarPendukung = "../../Frontend/Assets/img/" . $namaGambarPendukung;
    move_uploaded_file($namaSementaraGambarPendukung, $pathGambarPendukung);

    $queryUpdateGambarPendukung = "UPDATE data_hp SET gambar_pendukung='$namaGambarPendukung' WHERE id_hp='$id_hp'";
    $resultUpdateGambarPendukung = mysqli_query($koneksi, $queryUpdateGambarPendukung);
  }

  // Proses unggah gambar pendukung2
  if ($_FILES['gambar_pendukung2']['name']) {
    $namaGambarPendukung2 = $_FILES['gambar_pendukung2']['name'];
    $namaSementaraGambarPendukung2 = $_FILES['gambar_pendukung2']['tmp_name'];
    $pathGambarPendukung2 = "../../Frontend/Assets/img/" . $namaGambarPendukung2;
    move_uploaded_file($namaSementaraGambarPendukung2, $pathGambarPendukung2);

    $queryUpdateGambarPendukung2 = "UPDATE data_hp SET gambar_pendukung2='$namaGambarPendukung2' WHERE id_hp='$id_hp'";
    $resultUpdateGambarPendukung2 = mysqli_query($koneksi, $queryUpdateGambarPendukung2);
  }

  if ($resultUpdateHp) {
    // Jika berhasil diupdate, redirect ke halaman data HP
    header("Location: ../index.php?page=data_hp");
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
              <h3>Edit Data HP</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_hp" class="form-label">Nama HP</label>
                  <input type="text" class="form-control" id="nama_hp" name="nama_hp" value="<?php echo $rowHp['nama_hp']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="id_merk" class="form-label">Merk</label>
                  <select class="form-control" id="id_merk" name="id_merk" required>
                    <?php
                    // Query untuk mendapatkan data merk dari tabel brand
                    $queryBrand = "SELECT * FROM brand";
                    $resultBrand = mysqli_query($koneksi, $queryBrand);

                    while ($rowBrand = mysqli_fetch_assoc($resultBrand)) {
                      $selected = ($rowBrand['id_merk'] == $rowHp['id_merk']) ? 'selected' : '';
                      echo "<option value='" . $rowBrand['id_merk'] . "' $selected>" . $rowBrand['nama_merk'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="harga" class="form-label">Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $rowHp['harga']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="stok" class="form-label">Stok</label>
                  <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $rowHp['stok']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="baterai" class="form-label">Baterai</label>
                  <input type="number" class="form-control" id="baterai" name="baterai" value="<?php echo $rowHp['baterai']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="memori" class="form-label">Memori</label>
                  <input type="number" class="form-control" id="memori" name="memori" value="<?php echo $rowHp['memori']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="prosesor" class="form-label">Prosesor</label>
                  <input type="text" class="form-control" id="prosesor" name="prosesor" value="<?php echo $rowHp['prosesor']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="gambar_utama" class="form-label">Gambar Utama</label>
                  <input type="file" class="form-control" id="gambar_utama" name="gambar_utama" accept="image/*">
                  <?php if ($rowHp['gambar_utama']) : ?>
                    <img src="../../Frontend/Assets/img/<?php echo $rowHp['gambar_utama']; ?>" alt="Gambar Utama" width="200">
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label for="gambar_pendukung" class="form-label">Gambar Pendukung</label>
                  <input type="file" class="form-control" id="gambar_pendukung" name="gambar_pendukung" accept="image/*">
                  <?php if ($rowHp['gambar_pendukung']) : ?>
                    <img src="../../Frontend/Assets/img/<?php echo $rowHp['gambar_pendukung']; ?>" alt="Gambar Pendukung" width="200">
                  <?php endif; ?>
                </div>
                <div class="mb-3">
                  <label for="gambar_pendukung2" class="form-label">Gambar Pendukung2</label>
                  <input type="file" class="form-control" id="gambar_pendukung2" name="gambar_pendukung2" accept="image/*">
                  <?php if ($rowHp['gambar_pendukung2']) : ?>
                    <img src="../../Frontend/Assets/img/<?php echo $rowHp['gambar_pendukung2']; ?>" alt="Gambar Pendukung2" width="200">
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