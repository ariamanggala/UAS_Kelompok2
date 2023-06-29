<?php

$base_url = "http://localhost/backend/";
$page = $_GET['page'];
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <?php
      if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
        $data = mysqli_fetch_array($query);
      ?>
        <div class="image">
          <img src="Assets/img/<?= $data['photo']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $data['username']; ?></a>
        </div>
      <?php } ?>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="index.php?page=home" class="nav-link  <?php if ($page == 'home') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=pembelian" class="nav-link  <?php if ($page == 'pembelian') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Pembelian
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=data_hp" class="nav-link  <?php if ($page == 'data_hp') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data HP
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=data_user" class="nav-link  <?php if ($page == 'data_user') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data User
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=menu_navbar" class="nav-link  <?php if ($page == 'menu_navbar') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Menu Navbar
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=brand" class="nav-link  <?php if ($page == 'brand') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data Brand
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=header" class="nav-link  <?php if ($page == 'header') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data Header
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <a href="index.php?page=footer" class="nav-link  <?php if ($page == 'footer') { ?>active<?php } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data Footer
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>