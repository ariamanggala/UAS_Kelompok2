<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'pembelian';
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';

// Query awal untuk mengambil data dari tabel
$query = "SELECT tb_pembelian.id_beli, user.username, data_hp.nama_hp, tb_pembelian.jumlah, tb_pembelian.total_harga, tb_pembelian.status 
          FROM tb_pembelian 
          INNER JOIN user ON tb_pembelian.id_user = user.id_user 
          INNER JOIN data_hp ON tb_pembelian.Id_hp = data_hp.Id_hp";

if (!empty($keyword)) {
  $query .= " WHERE user.username LIKE '%$keyword%' OR data_hp.nama_hp LIKE '%$keyword%'";
}
if (!empty($filterStatus)) {
  $query .= " AND tb_pembelian.status = '$filterStatus'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}
?>

<section id="Pembelian">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Pembelian</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 mt-3">
        <div class="table-responsive">
          <form method="GET" action="index.php">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="row mb-3">
              <div class="col-md-4">
                <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan username atau nama HP" value="<?php echo $keyword; ?>">
              </div>
              <div class="col-md-3">
                <select name="status" class="form-control">
                  <option value="">Semua Status</option>
                  <option value="Menunggu" <?php echo ($filterStatus == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                  <option value="Berhasil" <?php echo ($filterStatus == 'Berhasil') ? 'selected' : ''; ?>>Berhasil</option>
                  <option value="Gagal" <?php echo ($filterStatus == 'Gagal') ? 'selected' : ''; ?>>Gagal</option>
                </select>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </div>
          </form>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>Nama User</th>
                <th>Nama HP</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['nama_hp']; ?></td>
                  <td><?php echo $row['jumlah']; ?></td>
                  <td><?php echo $row['total_harga']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td>
                    <a class="btn btn-primary" href="pembelian/proses_konfirmasi.php?id_beli=<?php echo $row['id_beli']; ?>">Konfirmasi</a>
                    <a class="btn btn-danger" href="pembelian/proses_batalkan.php?id_beli=<?php echo $row['id_beli']; ?>">Batalkan</a>
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>