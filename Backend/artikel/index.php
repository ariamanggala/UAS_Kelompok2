<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'artikel';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query awal untuk mengambil data dari tabel dengan inner join
$query = "SELECT id_artikel, judul_artikel, content_artikel, cover, waktu_dibuat, slug FROM artikel";

// Pencarian
if (!empty($search)) {
  $query .= " WHERE artikel.judul_artikel LIKE '%$search%'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}
?>

<section id="DataHP">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Artikel</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 mt-3">
        <div class="table-responsive">
          <form method="GET" action="">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="row mb-3">
              <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan Judul Artikel" value="<?php echo $search; ?>">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </form>
          <a href="artikel/tambah.php?page=artikel" class="btn btn-primary">Tambah</a>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>Judul Artikel</th>
                <th>Konten Artikel </th>
                <th>Cover</th>
                <th>Waktu Publish</th>
                <th>slug</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row['judul_artikel']; ?></td>
                  <td><?php echo $row['content_artikel']; ?></td>
                  <td><img src="../frontend/assets/img/<?php echo $row['cover']; ?>" alt="cover" width="70"></td>
                  <td><?php echo $row['waktu_dibuat']; ?></td>
                  <td><?php echo $row['slug']; ?></td>
                  <td>
                    <a class="btn btn-warning" href="artikel/edit.php?id_artikel=<?php echo $row['id_artikel']; ?>&page=artikel">Edit Akun</a>
                    <a class="btn btn-danger" href="artikel/hapus.php?id_artikel=<?php echo $row['id_artikel']; ?>&page=artikel" onclick='return confirmDelete()'>Hapus</a>

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