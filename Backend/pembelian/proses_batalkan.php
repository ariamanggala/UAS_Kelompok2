<?php
include "../../koneksi.php";

if (isset($_GET['id_beli'])) {
  $id_beli = $_GET['id_beli'];

  // Periksa status pembelian
  $statusQuery = "SELECT status, Id_hp, jumlah FROM tb_pembelian WHERE id_beli = $id_beli";
  $statusResult = mysqli_query($koneksi, $statusQuery);

  if ($statusResult) {
    $row = mysqli_fetch_assoc($statusResult);
    $status = $row['status'];

    if ($status == 'berhasil') {
      echo '<script>alert("Pesanan tidak bisa dibatalkan karena sudah dikirim."); window.history.go(-1);</script>';
      exit;
    } elseif ($status == 'Menunggu') {

      $updateQuery = "UPDATE tb_pembelian SET status = 'gagal' WHERE id_beli = $id_beli";
      $updateResult = mysqli_query($koneksi, $updateQuery);

      if ($updateResult) {
        // Kembalikan stok pada tabel data_hp
        $id_hp = $row['Id_hp'];
        $jumlah = $row['jumlah'];

        // Mengembalikan stok pada tabel data_hp
        $stokQuery = "UPDATE data_hp SET stok = stok + $jumlah WHERE id_hp = $id_hp";
        $stokResult = mysqli_query($koneksi, $stokQuery);

        if ($stokResult) {
          echo '<script>alert("Pembelian berhasil dibatalkan."); window.history.go(-1);</script>';
        } else {
          echo '<script>alert("Gagal mengembalikan stok: ' . mysqli_error($koneksi) . '"); window.history.go(-1);</script>';
        }
      } else {
        echo '<script>alert("Gagal membatalkan pembelian: ' . mysqli_error($koneksi) . '"); window.history.go(-1);</script>';
      }
    } else {
      echo '<script>alert("Pesanan tidak bisa dibatalkan karena status tidak valid."); window.history.go(-1);</script>';
    }
  } else {
    echo '<script>alert("Gagal memeriksa status pembelian: ' . mysqli_error($koneksi) . '"); window.history.go(-1);</script>';
  }
} else {
  echo '<script>alert("ID Pembelian tidak valid."); window.history.go(-1);</script>';
}
