<Section id="Footer">
  <div class="container pt-5">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-12">
        <div class="title-footer">
          <?php
          include "./../koneksi.php";
          $query = mysqli_query($koneksi, "SELECT * FROM footer ORDER BY id_footer DESC LIMIT 1");
          if ($data = mysqli_fetch_array($query)) {
          ?>
            <h1>"<?= $data['heading'] ?>."</h1>
            <p><?= $data['paragraf'] ?></p>
          <?php } ?>
        </div>
        <div class="medsos d-flex justify-content-center gap-5">
          <?php
          include "./../koneksi.php";
          $query = mysqli_query($koneksi, "SELECT * FROM kontak_admin");
          while ($data = mysqli_fetch_array($query)) {
          ?>
            <div class="kontak d-flex justify-content-center align-items-center">
              <img src="Assets/img/<?= $data['logo'] ?>" alt="logo medsos" width="30rem">
              <a href="<?= $data['url'] ?>" class="nama"><?= $data['nama_admin'] ?></a>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
    <div class="row pt-5">
      <h5 class="copyright">&copy; 2023 | Dibuat oleh Kelompok2. Hak Cipta Dilindungi.</h5>
    </div>
</Section>