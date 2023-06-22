<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">Lsogo</a>
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
      <a href="Profil.php?id_user=<?= $_SESSION['id_user']; ?>">
        <span class=" navbar-profile d-flex align-items-center gap-2">
          <?php


          if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
            $data = mysqli_fetch_array($query);
          ?>
            <img class="img-profile rounded-circle" src="Assets/img/<?= $data['photo'] ?>" alt="User">
            <h6 class="username"><?= $data['username']; ?></h6>
          <?php } ?>
        </span>
      </a>
      <a href="../keluar.php">Logout</a>
      </a>
    </div>
  </div>
</nav>