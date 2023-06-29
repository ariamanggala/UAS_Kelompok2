<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'user';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query awal untuk mengambil data dari tabel user
$query = "SELECT id_header, image_header FROM header";

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

<section id="Header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data header</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 mt-3">
        <div class="table-responsive">
          <form method="GET" action="">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
          </form>
          <a href="header/tambah.php?page=header" class="btn btn-primary">Tambah</a>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>image_header</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                $Id_header = $row['id_header'];
                $image_header = $row['image_header'];
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><img src="../frontend/assets/img/<?php echo $image_header; ?>" alt="image_header" width="300"></td>
                  <td>
                    <a class="btn btn-warning" href="header/edit.php?id_header=<?php echo $Id_header; ?>&page=header">Edit Akun</a>
                    <a class="btn btn-danger" href="header/hapus.php?id_header=<?php echo $Id_header; ?>&page=header" onclick='return confirmDelete()'>Hapus</a>
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