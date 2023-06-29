<section id="Brand">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <h2 class="teks-brand text-center pt-4">We Collaborate With Leading Top
          Smartphones and Brands.
        </h2>
      </div>
      <div class="logo-wrap col-12">
        <?php
        include "./../koneksi.php";
        $query = mysqli_query($koneksi, "SELECT * FROM brand");
        while ($data = mysqli_fetch_array($query)) {
        ?>
            <img class="logo" src="Assets/img/<?= $data['logo'] ?>" alt="brand" width="100">
        <?php } ?>
      </div>
    </div>
  </div>
</section>