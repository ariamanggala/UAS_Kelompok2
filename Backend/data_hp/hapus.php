<?php
include "../../koneksi.php";

// Mengecek apakah parameter id_hp telah diterima
if (isset($_GET['id_hp'])) {
  $id_hp = $_GET['id_hp'];

  // Query untuk menghapus data HP berdasarkan id_hp
  $query = "DELETE FROM data_hp WHERE id_hp = '$id_hp'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Mengatur session untuk menampilkan alert berhasil di halaman sebelumnya
    session_start();
    $_SESSION['alert'] = "Data HP berhasil dihapus";

    // Redirect kembali ke halaman "data_hp"
    header("Location: ../index.php?page=data_hp");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "ID HP tidak ditemukan";
  exit();
}
