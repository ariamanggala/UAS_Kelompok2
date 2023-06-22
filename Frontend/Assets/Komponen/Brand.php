<section id="Brand">
  <div class="container py-5">
    <div class="row d-flex justify-content-between align-items-center">
      <div class="col-12 py-4">
        <h2 class="teks-brand text-center pt-4">There are various kinds of smartphone brands available.</h2>
      </div>
      <?php
      include "./../koneksi.php";
      $query = mysqli_query($koneksi, "SELECT * FROM brand");
      while ($data = mysqli_fetch_array($query)) {
      ?>
        <div class="col-md-2 logo d-flex">
          <img src="Assets/img/<?= $data['logo'] ?>" alt="brand" width="100rem">
          <a href="#" class="brand-link"><?= $data['nama_merk'] ?></a>
        </div>
      <?php } ?>
    </div>
  </div>
</section>