<?php
include "../../koneksi.php";

// Mengecek apakah parameter id_artikel telah diterima
if (isset($_GET['id_artikel'])) {
  $id_artikel = $_GET['id_artikel'];

  // Query untuk menghapus data HP berdasarkan id_artikel
  $query = "DELETE FROM artikel WHERE id_artikel = '$id_artikel'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Mengatur session untuk menampilkan alert berhasil di halaman sebelumnya
    session_start();
    $_SESSION['alert'] = "Data HP berhasil dihapus";

    // Redirect kembali ke halaman "artikel"
    header("Location: ../index.php?page=artikel");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "ID HP tidak ditemukan";
  exit();
}
