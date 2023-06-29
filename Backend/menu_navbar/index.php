<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'user';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query awal untuk mengambil data dari tabel user
$query = "SELECT id_navbar, nama_navbar, url_navbar FROM menu_navbar";

// Pencarian
if (!empty($search)) {
  $query .= " WHERE nama_navbar LIKE '%$search%'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}

?>

<section id="MenuNavbar">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Menu navbar</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row d-flex justify-content-center">
      <div class="col-12 mt-3">
        <div class="table-responsive">
          <form method="GET" action="">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <div class="row mb-3">
              <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama Navbar" value="<?php echo $search; ?>">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </form>
          <a href="menu_navbar/tambah.php?page=menu_navbar" class="btn btn-primary">Tambah</a>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>nama_navbar</th>
                <th>url_navbar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                $Id_navbar = $row['id_navbar'];
                $nama_navbar = $row['nama_navbar'];
                $url_navbar = $row['url_navbar'];
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $nama_navbar; ?></td>
                  <td><?php echo $url_navbar; ?></td>
                  <td>
                    <a class="btn btn-warning" href="menu_navbar/edit.php?id_navbar=<?php echo $Id_navbar; ?>&page=menu_navbar">Edit Akun</a>
                    <a class="btn btn-danger" href="menu_navbar/hapus.php?id_navbar=<?php echo $Id_navbar; ?>&page=menu_navbar" onclick='return confirmDelete()'>Hapus</a>
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