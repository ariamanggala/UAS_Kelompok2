<?php
include "../../koneksi.php";

// Mengecek apakah parameter id_navbar telah diterima
if (isset($_GET['id_navbar'])) {
  $id_navbar = $_GET['id_navbar'];

  // Query untuk menghapus Menu Navbar berdasarkan id_navbar
  $query = "DELETE FROM menu_navbar WHERE id_navbar = '$id_navbar'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Mengatur session untuk menampilkan alert berhasil di halaman sebelumnya
    session_start();
    $_SESSION['alert'] = "Menu Navbar berhasil dihapus";

    // Redirect kembali ke halaman "user"
    header("Location: ../index.php?page=menu_navbar");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
    exit();
  }
} else {
  echo "ID Navbar tidak ditemukan";
  exit();
}
