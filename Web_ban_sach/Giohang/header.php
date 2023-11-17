<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Giỏ Hàng</title>
    <!-- MDB icon -->
    <link rel="icon" href="../../assets/img/3532091.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="./MDB/css/mdb.min.css" />
    <link rel="stylesheet" href="giohang.css" />
    <link rel="stylesheet" href="thongtin.css" />
  </head>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="../Trangchu/Trangchu.php">
        <img
        src="../../assets/img/3532091.png"
          height="35"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
    </div>

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="link-secondary me-3" href="#">
        <i class="fas fa-shopping-cart"></i>
      </a>
      
      <!-- Notifications -->

      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="Trangchu-img/pngwing.com.png"
            class="rounded-circle"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
        <?php
          session_start();
          // Kiểm tra xem người dùng đã đăng nhập hay chưa
          if (!isset($_SESSION['username'])) {
              // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
              echo '<script>window.location.href = "../../login.php";</script>';
              exit;
          }else{
              $username = $_SESSION['username'];
              $id = $_SESSION['id'];
          }
          // Ngược lại, người dùng đã đăng nhập và có thể truy cập trang này
        ?>
        <?php
          if ($username == null){
            echo '
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
              <li>
                <a class="dropdown-item" href="#">Đăng nhập</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Đăng Kí</a>
              </li>
            </ul>      
            ';
          }else{
            echo '
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
              <li>
                <a class="dropdown-item" href="thongtin.php">Tên: '.$_SESSION['username'].'</a>
              </li>
              <li>
                <a class="dropdown-item" href="../../logout.php">Đăng Xuất</a>
              </li>
            </ul>      
            ';
          }

        ?>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->