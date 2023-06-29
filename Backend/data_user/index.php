<?php
include "../koneksi.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'user';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query awal untuk mengambil data dari tabel user
$query = "SELECT id_user, username, password, photo, level FROM user";

// Pencarian
if (!empty($search)) {
  $query .= " WHERE username LIKE '%$search%'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}

// Mendapatkan ID pengguna yang sedang login dari sesi
$loggedInUserID = $_SESSION['id_user']; // Ganti 'user_id' dengan kunci sesi yang Anda gunakan untuk menyimpan ID pengguna yang sedang login

?>

<section id="DataUser">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data User</h1>
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
          <a href="data_user/tambah.php?page=data_user" class="btn btn-primary">Tambah</a>
          <table class="table table-striped" border="1">
            <thead>
              <tr class="text-center">
                <th>No.</th>
                <th>Username</th>
                <th>Password</th>
                <th>Photo</th>
                <th>Level</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row['id_user'];
                $username = $row['username'];
                $password = ($userID === $loggedInUserID) ? $row['password'] : '*****'; // Menampilkan password hanya jika ID pengguna sama dengan ID pengguna yang sedang login
                $photo = $row['photo'];
                $level = $row['level'];
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $username; ?></td>
                  <td><?php echo $password; ?></td>
                  <td><img src="../frontend/assets/img/<?php echo $photo; ?>" alt="photo" width="70"></td>
                  <td><?php echo $level; ?></td>
                  <td>
                    <a class="btn btn-warning" href="data_user/edit.php?id_user=<?php echo $userID; ?>&page=data_user">Edit Akun</a>
                    <a class="btn btn-danger" href="data_user/hapus.php?id_user=<?php echo $userID; ?>&page=data_user" onclick='return confirmDelete()'>Hapus</a>
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