<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'data_hp';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query awal untuk mengambil data dari tabel dengan inner join
$query = "SELECT data_hp.id_hp, brand.nama_merk, data_hp.nama_hp, data_hp.id_merk, data_hp.harga, data_hp.stok, data_hp.gambar_utama, data_hp.gambar_pendukung, data_hp.gambar_pendukung2, data_hp.baterai, data_hp.memori, data_hp.prosesor 
          FROM data_hp
          INNER JOIN brand ON data_hp.id_merk = brand.id_merk";

// Pencarian
if (!empty($search)) {
  $query .= " WHERE data_hp.nama_hp LIKE '%$search%'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}

// Pagination
$batas = 5; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1; // Halaman aktif
$mulai = ($halaman - 1) * $batas; // Menentukan nomor data awal yang akan ditampilkan

$query_pagination = $query . " LIMIT $mulai, $batas";
$result_pagination = mysqli_query($koneksi, $query_pagination);
if (!$result_pagination) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}

$total_data = mysqli_num_rows($result); // Total jumlah data
$total_halaman = ceil($total_data / $batas); // Total jumlah halaman
?>

<section id="DataHP">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data HP</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 mt-3">
        <div class="table-responsive">
          <form method="GET" action="">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="row mb-3">
              <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama HP" value="<?php echo $search; ?>">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </form>
          <a href="data_hp/tambah.php?page=data_hp" class="btn btn-primary">Tambah</a>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>Nama HP</th>
                <th>Nama Merk</th>
                <th>ID Merk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar Utama</th>
                <th>Gambar Pendukung</th>
                <th>Gambar Pendukung 2</th>
                <th>Baterai</th>
                <th>Memori</th>
                <th>Prosesor</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = $mulai + 1;
              while ($row = mysqli_fetch_assoc($result_pagination)) { ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['nama_hp']; ?></td>
                  <td><?php echo $row['nama_merk']; ?></td>
                  <td><?php echo $row['id_merk']; ?></td>
                  <td><?php echo $row['harga']; ?></td>
                  <td><?php echo $row['stok']; ?></td>
                  <td><img src="../frontend/assets/img/<?php echo $row['gambar_utama']; ?>" alt="gambar_utama" width="70"></td>
                  <td><img src="../frontend/assets/img/<?php echo $row['gambar_pendukung']; ?>" alt="gambar_utama" width="70"></td>
                  <td><img src="../frontend/assets/img/<?php echo $row['gambar_pendukung2']; ?>" alt="gambar_utama" width="70"></td>
                  <td><?php echo $row['baterai']; ?> mAH</td>
                  <td>Ram <?php echo $row['memori']; ?> GB</td>
                  <td><?php echo $row['prosesor']; ?></td>
                  <td>
                    <a class="btn btn-warning" href="data_hp/edit.php?id_hp=<?php echo $row['id_hp']; ?>&page=data_hp">Edit Akun</a>
                    <a class="btn btn-danger" href="data_hp/hapus.php?id_hp=<?php echo $row['id_hp']; ?>&page=data_hp" onclick='return confirmDelete()'>Hapus</a>
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>

          <!-- Pagination -->
          <ul class="pagination justify-content-center">
            <?php if ($halaman > 1) : ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page; ?>&search=<?php echo $search; ?>&halaman=<?php echo $halaman - 1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
              <?php if ($i == $halaman) : ?>
                <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
              <?php else : ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page; ?>&search=<?php echo $search; ?>&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halaman < $total_halaman) : ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page; ?>&search=<?php echo $search; ?>&halaman=<?php echo $halaman + 1; ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>