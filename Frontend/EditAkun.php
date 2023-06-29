<?php
include "./../koneksi.php";
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (!isset($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['photo'])) {
    $file = $_FILES['photo'];
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    if ($fileError === 0) {
      // Periksa tipe file foto
      $allowedExtensions = array('jpg', 'jpeg', 'png');
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      if (in_array($fileExtension, $allowedExtensions)) {
        // Tentukan lokasi folder untuk menyimpan foto
        $uploadPath = 'Assets/img/';
        // Generate nama unik untuk foto
        $newFileName = uniqid('photo_') . '.' . $fileExtension;
        // Pindahkan file foto ke folder tujuan
        move_uploaded_file($fileTmp, $uploadPath . $newFileName);

        // Update data foto pengguna
        $updateQuery = "UPDATE user SET photo = '$newFileName' WHERE id_user = '" . $_GET['id_user'] . "'";
        $updateResult = mysqli_query($koneksi, $updateQuery);

        if ($updateResult) {
          echo '<script>alert("Foto profil berhasil diubah.");</script>';
        } else {
          echo "Gagal mengubah foto profil: " . mysqli_error($koneksi);
        }
      } else {
        echo '<script>alert("Ekstensi file yang diunggah tidak valid. Hanya file JPG, JPEG, dan PNG yang diperbolehkan.");</script>';
      }
    } else {
      echo "Error uploading file: " . $fileError;
    }
  }

  // Proses update data username dan password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Update data username dan password
  $updateQuery = "UPDATE user SET username = '$username', password = '$password' WHERE id_user = '" . $_GET['id_user'] . "'";
  $updateResult = mysqli_query($koneksi, $updateQuery);

  if ($updateResult) {
    echo '<script>alert("Data akun berhasil diubah."); window.location.href = "profil.php";</script>';
    exit();
  } else {
    echo "Gagal mengubah data akun: " . mysqli_error($koneksi);
  }
}

// Ambil data akun pengguna
$query = "SELECT * FROM user WHERE id_user = '" . $_GET['id_user'] . "'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  echo "Error: " . mysqli_error($koneksi);
  exit();
}

$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$password = $row['password'];
$photo = $row['photo'];
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

  <!-- EditAkun -->
  <section id="EditAkun">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>Edit Akun</h1>
          <form method="POST" enctype="multipart/form-data">
            <div>
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" value="<?php echo $username; ?>">
            </div>
            <div>
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" value="<?php echo $password; ?>">
            </div>
            <div>
              <label for="photo">Foto Profil:</label>
              <input type="file" id="photo" name="photo">
            </div>
            <div>
              <img src="Assets/img/<?php echo $photo; ?>" alt="Foto Profil" width="150">
            </div>
            <div>
              <button type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- EditAkun END -->

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