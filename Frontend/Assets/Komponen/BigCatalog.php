<section id="BigCatalog">
  <div class="container py-5">
    <div class="row" py-5>
      <div class="col-12">
        <h3>Catalog Smartphone</h3>
      </div>
      <div class="col-12 filter">
        <a class="btn btn-primary d-flex align-items-center" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Filter and Search
          <iconify-icon icon="bi:filter" class="ms-2"></iconify-icon>
        </a>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <div class="col-12 filter">
              <form action="" method="GET">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="merk">Brand</label>
                    <select name="merk" id="merk" class="form-control">
                      <option value="">All Brands</option>
                      <?php
                      $merkQuery = mysqli_query($koneksi, "SELECT DISTINCT nama_merk FROM brand");
                      while ($merkData = mysqli_fetch_array($merkQuery)) {
                        $merkValue = $merkData['nama_merk'];
                        echo "<option value='$merkValue'>$merkValue</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="price_sort">Price Sort</label>
                    <select name="price_sort" id="price_sort" class="form-control">
                      <option value="">No Sorting</option>
                      <option value="asc">Low to High</option>
                      <option value="desc">High to Low</option>
                    </select>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>

                <div class="row d-flex justify-content-center">
                  <div class="col-md-4 mb-3">
                    <label for="search">Search</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Name Smartphone">
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

      </div>

      <!-- Baris Katalog huhuaaaa -->
      <div class="row pt-5">
        <?php
        // Mengambil nilai filter merk jika ada
        $filterMerk = isset($_GET['merk']) ? $_GET['merk'] : '';

        // Mengambil nilai filter pengurutan harga jika ada
        $priceSort = isset($_GET['price_sort']) ? $_GET['price_sort'] : '';

        // Mengambil nilai filter pencarian nama_hp jika ada
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Query untuk mengambil data produk dari database dengan filter merk, pengurutan harga, dan pencarian nama_hp
        $query = "SELECT * FROM data_hp 
                  INNER JOIN brand ON data_hp.id_merk = brand.id_merk 
                  WHERE nama_merk LIKE '%$filterMerk%'";

        if (!empty($search)) {
          $query .= " AND nama_hp LIKE '%$search%'";
        }

        if ($priceSort == 'asc') {
          $query .= " ORDER BY harga ASC";
        } elseif ($priceSort == 'desc') {
          $query .= " ORDER BY harga DESC";
        }

        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($data = mysqli_fetch_array($result)) {
            // Mendapatkan data yang diperlukan
            $gambarUtama = $data['gambar_utama'];
            $namaHp = $data['nama_hp'];
            if (strlen($namaHp) > 10) {
              $namaHp = substr($namaHp, 0, 10) . '...';
            }
            $harga = $data['harga'];
            $idHp = $data['id_hp'];
            $stok = $data['stok'];
        ?>
            <div class="col-md-3 col-6 p-2">
              <div class="card">
                <div class="card-img">
                  <img src="Assets/img/<?= $gambarUtama ?>" class="card-img-top" alt="img HP">
                </div>
                <div class="card-body">
                  <h5 class="card-title"><?= $namaHp ?></h5>
                  <div class="card-detail d-flex justify-content-between">
                    <p class="card-text">Rp. <?= $harga ?></p>
                    <p class="card-text">stok: <?= $stok ?></p>
                  </div>
                  <a href="detailHp.php?id=<?= $idHp ?>" class="button text-center">See Detail</a>
                </div>
              </div>
            </div>
        <?php
          }
        } else {
          echo "<p>Pencarian tidak ditemukan.</p>";
        }
        ?>
      </div>
    </div>
  </div>
</section>