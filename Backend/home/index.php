<?php
include "../koneksi.php";

$query = "SELECT COUNT(*) AS jumlah FROM tb_pembelian";
$result = mysqli_query($koneksi, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $totalHpDibeli = $row['jumlah'];
} else {
  $totalHpDibeli = 0;
}
?>

<div class="col-lg-3 col-6">
  <!-- small card -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3><?php echo $totalHpDibeli; ?></h3>
    </div>
    <div class="icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    <a href="index.php?page=pembelian" class="small-box-footer">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>