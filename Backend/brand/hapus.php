<?php
include "../../koneksi.php";

// Mengecek apakah parameter id_merk telah diterima
if (isset($_GET['id_merk'])) {
  $id_merk = $_GET['id_merk'];

  // Query untuk menghapus Menu Navbar berdasarkan id_merk
  $query = "DELETE FROM brand WHERE id_merk = '$id_merk'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Mengatur session untuk menampilkan alert berhasil di halaman sebelumnya
    session_start();
    $_SESSION['alert'] = "Menu Navbar berhasil dihapus";

    // Redirect kembali ke halaman "user"
    header("Location: ../index.php?page=brand");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "ID Navbar tidak ditemukan";
  exit();
}
