<section id="Header">
  <div class="container py-3">
    <div class="row py-5">
      <div class="col-md-12">
        <h1 class="header-title">Discover Premium and Affordable Smartphone Collections.</h1>
      </div>
    </div>
    <div class="row d-flex justify-content-between">
      <?php
      include "./../koneksi.php";
      $query = mysqli_query($koneksi, "SELECT * FROM header");
      while ($data = mysqli_fetch_array($query)) {
      ?>

        <div class="col-md-7 header-first" style="background-image: url(Assets/img/<?= $data['photo1']; ?>);">
          <div class="teks">
            <h4>Smartphone Store</h4>
            <h5>Experience the Latest Smartphone Technology at Unbeatable Prices.</h5>
          </div>
          <a class="button" href="Catalog.php">Buy Now</a>
        </div>

        <div class="col-md-4 header-second" style="background-image: url(Assets/img/<?= $data['photo2']; ?>);">
          <div class="teks">
            <h4>See the Latest Articles</h4>
            <h5>Let's Know More About the Trend Now.</h5>
          </div>
          <a class="button" href="Catalog.php">See Article</a>

        </div>
      <?php } ?>
    </div>
  </div>
</section>