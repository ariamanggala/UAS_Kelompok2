<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'user';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query awal untuk mengambil data dari tabel user
$query = "SELECT id_merk, nama_merk, logo FROM brand";

// Pencarian
if (!empty($search)) {
  $query .= " WHERE nama_merk LIKE '%$search%'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}

?>

<section id="Brand">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Brand</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 mt-3">
        <div class="table-responsive">
          <form method="GET" action="">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="row mb-3">
              <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama brand" value="<?php echo $search; ?>">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </form>
          <a href="brand/tambah.php?page=brand" class="btn btn-primary">Tambah</a>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>nama_merk</th>
                <th>logo</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                $Id_merk = $row['id_merk'];
                $nama_merk = $row['nama_merk'];
                $logo = $row['logo'];
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $nama_merk; ?></td>
                  <td class="d-flex justify-content-center"><img src="../frontend/assets/img/<?php echo $logo; ?>" alt="lo$logo" width="70"></td>
                  <td>
                    <a class="btn btn-warning" href="brand/edit.php?id_merk=<?php echo $Id_merk; ?>&page=brand">Edit Akun</a>
                    <a class="btn btn-danger" href="brand/hapus.php?id_merk=<?php echo $Id_merk; ?>&page=brand" onclick='return confirmDelete()'>Hapus</a>
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