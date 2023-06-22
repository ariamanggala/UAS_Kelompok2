<section id="LiteCatalog">
  <div class="container py-5">
    <div class="row py-5">
      <div class="col-12 d-flex justify-content-between align-items-center">
        <h4>Short Catalog</h4>
        <a class="link-catalog d-flex align-items-center" href="Catalog.php">Explore more here
          <iconify-icon icon="ph:arrow-right" class="icon-right"></iconify-icon></a>
      </div>
      <div class="swiper mySwiper pt-4">
        <div class="swiper-wrapper">
          <?php
          include "./../koneksi.php";
          $query = mysqli_query($koneksi, "SELECT * FROM data_hp INNER JOIN spek_hp ON data_hp.id_spek = spek_hp.id_spek LIMIT 5");
          if ($query) {
            if (mysqli_num_rows($query) > 0) {
              while ($data = mysqli_fetch_array($query)) {
          ?>
                <div class="swiper-slide">
                  <div class="card" style="width: 18rem;">
                    <div class="card-img">
                      <img src="Assets/img/<?= $data['gambar_utama'] ?>" class="card-img-top" alt="img HP">
                    </div>
                    <div class="card-body">
                      <?php
                      $nama_hp = $data['nama_hp'];
                      if (strlen($nama_hp) > 10) {
                        $nama_hp = substr($nama_hp, 0, 10) . '...';
                      }
                      ?>
                      <h5 class="card-title"><?= $nama_hp ?></h5>
                      <p class="card-text">Rp. <?= $data['harga'] ?></p>
                      <a href="detailHp.php?id=<?= $data['id_hp'] ?>" class="button text-center">See Detail
                      </a>
                    </div>
                  </div>
                </div>
          <?php
              }
            } else {
              echo "Tidak ada data yang ditemukan.";
            }
          } else {
            echo "Kesalahan query: " . mysqli_error($koneksi);
          }
          ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </div>
</section>