 <!-- Main content -->
 <div class="content">
   <div class="container-fluid">
     <?php
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
          case 'home':
            include "home/index.php";
            break;
          case 'pembelian':
            include "pembelian/index.php";
            break;
          case 'data_hp':
            include "data_hp/index.php";
            break;
          case 'data_user':
            include "data_user/index.php";
            break;
          case 'menu_navbar':
            include "menu_navbar/index.php";
            break;
          case 'header':
            include "header/index.php";
            break;
          case 'footer':
            include "footer/index.php";
            break;
          case 'brand':
            include "brand/index.php";
            break;
          case 'artikel':
            include "artikel/index.php";
            break;
        }
      } else {
        include "home/index.php";
      }

      ?>
   </div><!-- /.container-fluid -->
 </div>
 <!-- /.content -->