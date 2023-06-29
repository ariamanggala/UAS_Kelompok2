<?php
include "../../koneksi.php";

if (isset($_GET['id_beli'])) {
  $id_beli = $_GET['id_beli'];

  // Periksa status pembelian
  $statusQuery = "SELECT status FROM tb_pembelian WHERE id_beli = $id_beli";
  $statusResult = mysqli_query($koneksi, $statusQuery);

  if ($statusResult) {
    $row = mysqli_fetch_assoc($statusResult);
    $status = $row['status'];

    if ($status == 'Menunggu') {
      // Update status pembelian menjadi berhasil
      $updateQuery = "UPDATE tb_pembelian SET status = 'berhasil' WHERE id_beli = $id_beli";
      $updateResult = mysqli_query($koneksi, $updateQuery);

      if ($updateResult) {
        // Redirect kembali ke halaman sebelumnya dengan pesan berhasil
        echo '<script>alert("Pembelian berhasil dikonfirmasi."); window.history.go(-1);</script>';
        exit;
      } else {
        echo '<script>alert("Gagal mengkonfirmasi pembelian: ' . mysqli_error($koneksi) . '"); window.history.go(-1);</script>';
      }
    } else {
      echo '<script>alert("Pembelian tidak bisa dikonfirmasi karena status tidak valid."); window.history.go(-1);</script>';
    }
  } else {
    echo '<script>alert("Gagal memeriksa status pembelian: ' . mysqli_error($koneksi) . '"); window.history.go(-1);</script>';
  }
} else {
  echo '<script>alert("ID Pembelian tidak valid."); window.history.go(-1);</script>';
}
