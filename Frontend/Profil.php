<?php
include "./../koneksi.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


// Mendapatkan data pengguna dari tabel user berdasarkan id_user yang disimpan dalam sesi
$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = $id_user");
$data = mysqli_fetch_assoc($query);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UAS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- Icon FontAwesome -->
  <script src="https://kit.fontawesome.com/decb368884.js" crossorigin="anonymous"></script>
  <!-- Swipper JS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- Font Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/frontend.css">
</head>

<body>

  <!-- Navbar -->
  <?php
  include 'Assets/Komponen/Navbar.php';
  ?>
  <!-- Navbar END -->

  <!-- Profil -->
  <section id="Profil">
    <div class="container">
      <div class="row d-flex justify-content-center py-5 gap-3">
        <div class="col-12 bg-primary text-light mb-5 d-flex">
          <h3>Your Profile</h3>
        </div>
        <div class="col-md-7 profil d-flex justify-content-start align-items-center gap-5 bg-secondary p-2">
          <img class="img-profile rounded-circle" src="Assets/img/<?= $data['photo'] ?>" alt="photo profile">
          <div class="akun">
            <div class="username d-flex gap-1">
              <h4>Username: </h4>
              <h4><?php echo $data['username']; ?></h4>
            </div>
            <div class="password d-flex gap-1">
              <h4>Password: </h4>
              <h4 id="password"> ********</h4>
              <button class="btn btn-secondary" onclick="togglePasswordVisibility()"><iconify-icon icon="fluent-mdl2:hide-2"></iconify-icon></button>
            </div>
            <a href="edit_akun.php" class="btn btn-primary">Edit Akun</a>
            <script>
              function togglePasswordVisibility() {
                var passwordElement = document.getElementById("password");
                if (passwordElement.textContent === " ********") {
                  passwordElement.textContent = "<?php echo $data['password']; ?>";
                } else {
                  passwordElement.textContent = " ********";
                }
              }
            </script>
          </div>
        </div>
        <div class="col-12 data bg-secondary">
          <h6>Data Pembelian</h6>
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar Utama</th>
                <th>Nama HP</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Total Harga</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "./../koneksi.php";
              $id_user = $_SESSION['id_user'];
              $query = mysqli_query($koneksi, "SELECT spek_hp.gambar_utama, data_hp.nama_hp, tb_pembelian.jumlah, tb_pembelian.status, tb_pembelian.total_harga 
                                  FROM tb_pembelian
                                  INNER JOIN data_hp ON tb_pembelian.Id_hp = data_hp.id_hp
                                  INNER JOIN spek_hp ON data_hp.id_spek = spek_hp.id_spek
                                  WHERE tb_pembelian.id_user = $id_user");
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><img src="Assets/img/<?php echo $data['gambar_utama']; ?>" alt="Gambar Utama HP" width="100"></td>
                  <td><?php echo $data['nama_hp']; ?></td>
                  <td><?php echo $data['jumlah']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  <td><?php echo $data['total_harga']; ?></td>
                </tr>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </section>
  <!-- Profil END-->

  <!-- Footer -->
  <?php
  include 'Assets/Komponen/Footer.php';
  ?>
  <!-- Footer END -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <!-- Iconify -->
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>