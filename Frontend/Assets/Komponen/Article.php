<section id="Article">
  <div class="container">
    <div class="row py-5 d-flex justify-content-center justify-content-md-between">
      <div class="col-12 d-flex justify-content-between align-items-center pb-4">
        <h4>Article</h4>
        <a class="link-article d-flex align-items-center" href="Catalog.php">Explore more here
          <iconify-icon icon="ph:arrow-right" class="icon-right"></iconify-icon></a>
      </div>
      <div class="col-md-8 bigarticle">
        <?php
        include "./../koneksi.php";
        $query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY waktu_dibuat DESC LIMIT 1");
        if ($data = mysqli_fetch_array($query)) {
          $content_artikel = $data['content_artikel'];
          $limited_content = implode(' ', array_slice(explode(' ', $content_artikel), 0, 60));
          $limited_content .= '...';
          $waktu_dibuat = strtotime($data['waktu_dibuat']);
          $waktu_sekarang = time();
          $selisih_detik = $waktu_sekarang - $waktu_dibuat;
          $waktu_lalu = '';
          if ($selisih_detik < 60) {
            $waktu_lalu = $selisih_detik . ' detik yang lalu';
          } elseif ($selisih_detik < 3600) {
            $waktu_lalu = floor($selisih_detik / 60) . ' menit yang lalu';
          } elseif ($selisih_detik < 86400) {
            $waktu_lalu = floor($selisih_detik / 3600) . ' jam yang lalu';
          } elseif ($selisih_detik < 2592000) {
            $waktu_lalu = floor($selisih_detik / 86400) . ' hari yang lalu';
          } else {
            $waktu_lalu = date('d M Y', $waktu_dibuat);
          }
        ?>
          <div class="card">
            <img src="Assets/img/<?= $data['cover'] ?>" class="card-img-top" alt="cover artikel">
            <div class="card-body">
              <h5 class="card-title"><?= $data['judul_artikel'] ?></h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Diupload<?= $waktu_lalu ?></h6>
              <p class="card-text"><?= $limited_content ?></p>
              <a href="DetailArtikel.php?id=<?= $data['id_artikel'] ?>" class="card-link">detail</a>
            </div>
          </div>
        <?php } ?>

      </div>
      <div class="col-md-4 doublearticle d-flex justify-content-between">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id_artikel ASC LIMIT 2");
        while ($data = mysqli_fetch_array($query)) {
          $content_artikel = $data['content_artikel'];
          $limited_content = substr($content_artikel, 0, 50);
          if (strlen($content_artikel) > 50) {
            $limited_content .= '...';
          }
          $waktu_dibuat = strtotime($data['waktu_dibuat']);
          $waktu_lalu = '';
          if ($selisih_detik < 60) {
            $waktu_lalu = $selisih_detik . ' detik yang lalu';
          } elseif ($selisih_detik < 3600) {
            $waktu_lalu = floor($selisih_detik / 60) . ' menit yang lalu';
          } elseif ($selisih_detik < 86400) {
            $waktu_lalu = floor($selisih_detik / 3600) . ' jam yang lalu';
          } elseif ($selisih_detik < 2592000) {
            $waktu_lalu = floor($selisih_detik / 86400) . ' hari yang lalu';
          } else {
            $waktu_lalu = date('d M Y', $waktu_dibuat);
          }
        ?>
          <div class="col-12">
            <div class="card" style="width: 20rem;">
              <img src="Assets/img/<?= $data['cover'] ?>" class="card-img-top" alt="cover artikel">
              <div class="card-body">
                <h5 class="card-title"><?= $data['judul_artikel'] ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Diupload <?= $waktu_lalu ?></h6>
                <p class="card-text"><?= $limited_content ?></p>
                <a href="DetailArtikel.php?id=<?= $data['id_artikel'] ?>" class="card-link">detail</a>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>