<?php
include "../koneksi.php";

$queryPembelian = "SELECT COUNT(*) AS jumlah FROM tb_pembelian";
$queryBrand = "SELECT COUNT(*) AS jumlah FROM brand";
$queryDataHp = "SELECT COUNT(*) AS jumlah FROM data_hp";
$queryDataUser = "SELECT COUNT(*) AS jumlah FROM user";

$resultPembelian = mysqli_query($koneksi, $queryPembelian);
$resultBrand = mysqli_query($koneksi, $queryBrand);
$resultDataHp = mysqli_query($koneksi, $queryDataHp);
$resultDataUser = mysqli_query($koneksi, $queryDataUser);

if ($resultPembelian) {
  $rowPembelian = mysqli_fetch_assoc($resultPembelian);
  $totalHpDibeli = $rowPembelian['jumlah'];
} else {
  $totalHpDibeli = 0;
}

if ($resultBrand) {
  $rowBrand = mysqli_fetch_assoc($resultBrand);
  $totalBrand = $rowBrand['jumlah'];
} else {
  $totalBrand = 0;
}

if ($resultDataHp) {
  $rowDataHp = mysqli_fetch_assoc($resultDataHp);
  $totaljenisHP = $rowDataHp['jumlah'];
} else {
  $totaljenisHP = 0;
}

if ($resultDataUser) {
  $rowDataUser = mysqli_fetch_assoc($resultDataUser);
  $totalUser = $rowDataUser['jumlah'];
} else {
  $totalUser = 0;
}

?>

<div class="row">
  <!-- pembelian -->
  <div class="col-lg-3 col-6 py-2">
    <a href="index.php?page=pembelian" class="small-box-footer">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Pembelian</span>
          <span class="info-box-number"><?php echo $totalHpDibeli ?></span>
        </div>
      </div>
    </a>
  </div>

  <!-- Brand -->
  <div class="col-lg-3 col-6 py-2">
    <a href="index.php?page=brand" class="small-box-footer">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Brand</span>
          <span class="info-box-number"><?php echo $totalBrand ?></span>
        </div>
      </div>
    </a>
  </div>

  <!-- Data Hp -->
  <div class="col-lg-3 col-6 py-2">
    <a href="index.php?page=data_hp" class="small-box-footer">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Jenis HP</span>
          <span class="info-box-number"><?php echo $totaljenisHP ?></span>
        </div>
      </div>
    </a>
  </div>

  <!-- Data User -->
  <div class="col-lg-3 col-6 py-2">
    <a href="index.php?page=data_user" class="small-box-footer">
      <div class="info-box">
        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total User</span>
          <span class="info-box-number"><?php echo $totalUser ?></span>
        </div>
      </div>
    </a>
  </div>


</div>