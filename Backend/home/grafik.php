<?php

include "../koneksi.php";

$queryBrand = "SELECT b.nama_merk, COUNT(*) AS jumlah_pembelian
                  FROM tb_pembelian p
                  JOIN data_hp hp ON p.id_hp = hp.id_hp
                  JOIN brand b ON hp.id_merk = b.id_merk
                  GROUP BY b.id_merk, b.nama_merk";
$resultBrand = mysqli_query($koneksi, $queryBrand);
$queryStatus = "SELECT status, COUNT(*) AS jumlah_pembelian
                    FROM tb_pembelian
                    GROUP BY status";
$resultStatus = mysqli_query($koneksi, $queryStatus);


$brandLabels = array();
$jumlahPembelianBrand = array();
$statusLabels = array();
$jumlahPembelianStatus = array();

while ($rowBrand = mysqli_fetch_assoc($resultBrand)) {
  $brand = $rowBrand['nama_merk'];
  $jumlahPembelianBrand[] = $rowBrand['jumlah_pembelian'];

  $brandLabels[] = $brand;
}

while ($rowStatus = mysqli_fetch_assoc($resultStatus)) {
  $status = $rowStatus['status'];
  $jumlahPembelianStatus[] = $rowStatus['jumlah_pembelian'];

  $statusLabels[] = $status;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Grafik Pembelian</title>
  <!-- Load Chart.js library -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <div class="row">
    <!-- Bar Chart -->
    <div class="col-sm-6 col-12">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Bar Chart - Jumlah Pembelian per Brand</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
    </div>

    <!-- Donut Chart -->
    <div class="col-sm-6 col-12">
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Donut Chart - Status Pembelian</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    var brandLabels = <?php echo json_encode($brandLabels); ?>;
    var jumlahPembelianBrand = <?php echo json_encode($jumlahPembelianBrand); ?>;
    var statusLabels = <?php echo json_encode($statusLabels); ?>;
    var jumlahPembelianStatus = <?php echo json_encode($jumlahPembelianStatus); ?>;

    // Bar Chart - Jumlah Pembelian per Brand
    var ctxBar = document.getElementById("barChart").getContext("2d");
    new Chart(ctxBar, {
      type: "bar",
      data: {
        labels: brandLabels,
        datasets: [{
          label: "Jumlah Pembelian",
          data: jumlahPembelianBrand,
          backgroundColor: "rgba(0, 123, 255, 0.8)"
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            precision: 0,
            stepSize: 1
          }
        }
      }
    });

    // Donut Chart - Status Pembelian
    var ctxDonut = document.getElementById("donutChart").getContext("2d");
    new Chart(ctxDonut, {
      type: "doughnut",
      data: {
        labels: statusLabels,
        datasets: [{
          data: jumlahPembelianStatus,
          backgroundColor: ["#f39c12", "#00a65a", "#f56954"]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  </script>
</body>

</html>