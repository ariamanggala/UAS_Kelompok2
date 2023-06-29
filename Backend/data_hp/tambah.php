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
  $namaHp = $_POST['nama_hp'];
  $idMerk = $_POST['id_merk'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $gambarUtama = $_FILES['gambar_utama']['name'];
  $gambarPendukung = $_FILES['gambar_pendukung']['name'];
  $gambarPendukung2 = $_FILES['gambar_pendukung2']['name'];
  $baterai = $_POST['baterai'];
  $memori = $_POST['memori'];
  $prosesor = $_POST['prosesor'];

  // Pengecekan apakah data HP sudah ada
  $queryCheck = "SELECT * FROM data_hp WHERE nama_hp = '$namaHp'";
  $resultCheck = mysqli_query($koneksi, $queryCheck);

  if (mysqli_num_rows($resultCheck) > 0) {
    // Jika data HP sudah ada, tampilkan alert
    echo "<script>alert('Data HP sudah ada.');</script>";
  } else {
    // Proses query untuk menambahkan data HP ke dalam tabel data_hp
    $queryDataHp = "INSERT INTO data_hp (nama_hp, id_merk, harga, stok, gambar_utama, gambar_pendukung, gambar_pendukung2, baterai, memori, prosesor)
                  VALUES ('$namaHp', '$idMerk', '$harga', '$stok', '$gambarUtama', '$gambarPendukung', '$gambarPendukung2', '$baterai', '$memori', '$prosesor')";
    $resultDataHp = mysqli_query($koneksi, $queryDataHp);

    if ($resultDataHp) {
      // Mendapatkan ID data_hp yang baru saja di-generate
      $idHp = mysqli_insert_id($koneksi);

      // Lokasi folder tempat menyimpan gambar
      $targetDir = "../../Frontend/Assets/img/";

      // Upload gambar utama
      $targetFileUtama = $targetDir . basename($gambarUtama);
      move_uploaded_file($_FILES['gambar_utama']['tmp_name'], $targetFileUtama);

      // Upload gambar pendukung
      $targetFilePendukung = $targetDir . basename($gambarPendukung);
      move_uploaded_file($_FILES['gambar_pendukung']['tmp_name'], $targetFilePendukung);

      // Upload gambar pendukung2
      $targetFilePendukung2 = $targetDir . basename($gambarPendukung2);
      move_uploaded_file($_FILES['gambar_pendukung2']['tmp_name'], $targetFilePendukung2);

      if ($resultDataHp) {
        echo "<script>alert('Data HP berhasil ditambahkan.');</script>";
        header("Location: ../index.php?page=data_hp");
        exit();
      } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan data HP.');</script>";
      }
    } else {
      echo "<script>alert('Terjadi kesalahan saat menambahkan data HP.');</script>";
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
              <h3>Tambah Data HP</h3>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_hp" class="form-label">Nama HP</label>
                  <input type="text" class="form-control" id="nama_hp" name="nama_hp" required>
                </div>
                <div class="mb-3">
                  <label for="id_merk" class="form-label">Merk</label>
                  <select class="form-control" id="id_merk" name="id_merk" required>
                    <?php
                    // Query untuk mendapatkan data merk dari tabel brand
                    $queryBrand = "SELECT * FROM brand";
                    $resultBrand = mysqli_query($koneksi, $queryBrand);

                    while ($rowBrand = mysqli_fetch_assoc($resultBrand)) {
                      echo "<option value='" . $rowBrand['id_merk'] . "'>" . $rowBrand['nama_merk'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="harga" class="form-label">Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="mb-3">
                  <label for="stok" class="form-label">Stok</label>
                  <input type="text" class="form-control" id="stok" name="stok" required>
                </div>
                <div class="mb-3">
                  <label for="gambar_utama" class="form-label">Gambar Utama</label>
                  <input type="file" class="form-control" id="gambar_utama" name="gambar_utama" required>
                </div>
                <div class="mb-3">
                  <label for="gambar_pendukung" class="form-label">Gambar Pendukung</label>
                  <input type="file" class="form-control" id="gambar_pendukung" name="gambar_pendukung" required>
                </div>
                <div class="mb-3">
                  <label for="gambar_pendukung2" class="form-label">Gambar Pendukung2</label>
                  <input type="file" class="form-control" id="gambar_pendukung2" name="gambar_pendukung2" required>
                </div>
                <div class="mb-3">
                  <label for="baterai" class="form-label">Baterai</label>
                  <input type="number" class="form-control" id="baterai" name="baterai" required>
                </div>
                <div class="mb-3">
                  <label for="memori" class="form-label">Memori</label>
                  <input type="number" class="form-control" id="memori" name="memori" required>
                </div>
                <div class="mb-3">
                  <label for="prosesor" class="form-label">Prosesor</label>
                  <input type="text" class="form-control" id="prosesor" name="prosesor" required>
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