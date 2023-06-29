<?php
include "../../koneksi.php";

// Mengecek apakah parameter id_header telah diterima
if (isset($_GET['id_header'])) {
  $id_header = $_GET['id_header'];

  // Query untuk menghapus Menu Navbar berdasarkan id_header
  $query = "DELETE FROM header WHERE id_header = '$id_header'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Mengatur session untuk menampilkan alert berhasil di halaman sebelumnya
    session_start();
    $_SESSION['alert'] = "Menu Navbar berhasil dihapus";

    // Redirect kembali ke halaman "user"
    header("Location: ../index.php?page=header");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "ID Navbar tidak ditemukan";
  exit();
}
