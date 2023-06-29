<nav class="navbar navbar-expand-lg py-md-5">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="Assets/img/logo.png" alt="LOGO">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <iconify-icon icon="heroicons:bars-3-bottom-left-solid"></iconify-icon>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-md-4">
        <?php
        include "./../koneksi.php";
        $query = mysqli_query($koneksi, "SELECT * FROM menu_navbar");
        while ($data = mysqli_fetch_array($query)) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= $data['url_navbar'] ?>"><?= $data['nama_navbar'] ?></a>
          </li>
        <?php } ?>
      </ul>
      <?php
      if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
        $data = mysqli_fetch_array($query);
      ?>
        <a href="Profil.php?id_user=<?= $_SESSION['id_user']; ?>">
          <span class=" navbar-profile d-flex align-items-center gap-2 px-md-4">
            <h6 class="username"><?= $data['username']; ?></h6>
            <img class="img-profile rounded-circle" src="Assets/img/<?= $data['photo'] ?>" alt="User">
          </span>
        </a>
        <a href="../keluar.php" class="logout">
          <iconify-icon icon="solar:logout-outline" style="color: #101913;" width="25" height="25"></iconify-icon>
        </a>
      <?php } ?>
    </div>
  </div>
</nav>