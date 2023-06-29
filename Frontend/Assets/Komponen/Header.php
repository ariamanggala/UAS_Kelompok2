<section id="Header">
  <div class="container py-3">
    <div class="row py-5">
      <div class="col-md-12">
        <h1 class="header-title text-center">Your Ultimate Online Destination for Cutting-Edge Smartphones.</h1>
      </div>
    </div>
    <div class="row d-flex justify-content-between header-carousel">
      <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
          include './../koneksi.php';
          $query = "SELECT image_header FROM header";
          $result = mysqli_query($koneksi, $query);

          if (mysqli_num_rows($result) > 0) {
            $activeClass = "active";
            while ($data = mysqli_fetch_assoc($result)) {
          ?>
              <div class="carousel-item <?php echo $activeClass; ?>">
                <img src="Assets/img/<?php echo $data['image_header'] ?>" class="d-block w-100 image-header" alt="Header">
              </div>
          <?php
              $activeClass = "";
            }
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</section>