<?php
include "../../koneksi.php";

// Mengecek apakah parameter id_user telah diterima
if (isset($_GET['id_user'])) {
  $id_user = $_GET['id_user'];

  // Query untuk menghapus data HP berdasarkan id_user
  $query = "DELETE FROM user WHERE id_user = '$id_user'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Mengatur session untuk menampilkan alert berhasil di halaman sebelumnya
    session_start();
    $_SESSION['alert'] = "Data HP berhasil dihapus";

    // Redirect kembali ke halaman "user"
    header("Location: ../index.php?page=data_user");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "ID User tidak ditemukan";
  exit();
}
