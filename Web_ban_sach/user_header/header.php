<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="Bootstrap/bootstrap-shop/css/styles.css">
    <link rel="stylesheet" type="text/css" href="Trangchu.css">
    <link rel="stylesheet" type="text/css" href="Theloai.css">
    <link rel="stylesheet" type="text/css" href="Chitiet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@200;500&family=Noto+Sans+JP&family=Playfair+Display:ital,wght@0,500;1,400&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="../../assets/css/swiper-bundle.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="./Trangchu-img/3532091.png">
    <title>Books Store</title>
  </head>
  <?php
  session_start();
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, bạn có thể cho phép truy cập trang này, không cần chuyển hướng
    // Tất cả mã PHP xử lý liên quan đến người dùng đã đăng nhập (ví dụ: $username, $id) nên được đặt bên trong điều kiện if
} else {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
}
?>
  <?php
    include '../../connection.php';
    $query = "SELECT * FROM category ORDER BY CategoryID ASC";
    $result = $conn->query($query);
    $query1 = "SELECT * FROM nha_xuat_ban";
    $result1 = $conn->query($query1);
  ?>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light custom-bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="../Trangchu/Trangchu.php">
          <img src="./Trangchu-img/3532091.png" style="width: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Danh mục sản phẩm </a>
                <?php
                  if ($result->num_rows > 0) {
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    while ($row = $result->fetch_assoc()) {
                      echo "<li><a class='dropdown-item' href='../Theloai/Theloai.php?id=". $row["CategoryID"] ."'>" . $row["CategoryName"] . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "Không có danh mục nào.";
                }
                ?>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Nhà xuất bản </a>
              <?php
                  if ($result1->num_rows > 0) {
                    echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    while ($row = $result1->fetch_assoc()) {
                      echo "<li><a class='dropdown-item' href='../Theloai/nxb.php?id=". $row["id"] ."'>" . $row["ten_nha_xuat_ban"] . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "Không có danh mục nào.";
                }
                ?>
            </li>
          </ul>
          <!-- Search -->
          <div class="dropdown find col-3">
              <form action="" class="mb-0 w-100" autocomplete="on">
                  <div class="input-group w-100">
                      <input type="text" class="form-control" placeholder="Tìm kiếm" id="searchInput" oninput="searchFunction()" onfocus="showList()" >
                  </div>
              </form>
              <div class="dropdown-menu shadow w-100 find_dropmenu" aria-labelledby="dropdownMenuButton" id="searchResults" style="display: none;">
                  <!-- Danh sách kết quả tìm kiếm sẽ được hiển thị ở đây -->
                  <?php
                  $query2 = "SELECT * FROM product";
                  $result2 = $conn->query($query2);
                  
                  if ($result2->num_rows > 0) {
                    // Duyệt qua các bản ghi và xử lý dữ liệu ở đây
                    $i=0;
                    while($row = $result2->fetch_assoc()) {
                          $i++;
                          if($i <= 5){
                    ?>
                            <a class="dropdown-item text-dark text-decoration-none" href="../chitiet/chitiet.php?id=<?php echo $row['id']; ?>"  onclick="fillInput(this)">
                                <div class="d-flex">
                                    <div class="card-body p-0">
                                        <p class="text-truncate text_line mb-0"><?php echo $row['name'];?></p>
                                    </div>
                                    <div>
                                        <img class="img__search" src="../../upload/<?php echo $row['thumbnail']; ?>"   alt="">
                                        
                                    </div>
                                </div>
                            </a>
                        <?php
                        } else {
                        ?>
                            <a class="dropdown-item text-dark text-decoration-none" href="../Chitiet/Chitiet.php?id=<?php echo $row['id']; ?>" onclick="fillInput(this)" style="display: none;">
                                <div class="d-flex">
                                    <div class="card-body p-0">
                                        <p class="text-truncate mb-0"><?php echo $row['name']; ?></p>
                                        
                                    </div>
                                    <div>
                                        <img class="img__search" src="../../upload/<?php echo $row['thumbnail']; ?>" width="50px" alt="">
                                    </div>
                                </div>
                            </a>
                        <?php
                          }
                      }
                  }
                  ?>
                  <a id="noResults" style="display: none;">
                      <div class="card-body p-0 text-center pt-4 pb-4">
                          <p class="text-truncate mb-2">Không tìm thấy sản phẩm</p>
                      </div>
                  </a>
              </div>
          </div>

<!-- Search_end -->
        </div>
          <br>
          <div>
          <?php
            if(isset($_SESSION['username'])){
              echo '
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img id="login" src="./Trangchu-img/pngwing.com.png" class="rounded float-start" style="width: 24px;"> </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                    <a class="dropdown-item" href="../Giohang/thongtin.php">Tên: '.$_SESSION['username'].'</a>
                    </li>
                    <li>
                    <a class="dropdown-item" href="../../logout.php">Đăng Xuất</a>
                    </li>
                  </ul>
                  </li>
                  </ul>
                  ';
                }else{
                  echo
                  '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img id="login" src="./Trangchu-img/pngwing.com.png" class="rounded float-start" style="width: 24px;"> </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                      <a class="dropdown-item" href="../../login.php">Đăng Nhập</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../../register.php">Đăng Ký</a>
                    </li>
                </ul>
              </li>
            </ul>';
            }
          ?>
        </div>
          <a href="../Giohang/giohang.php"><img id="shopping" src="./Trangchu-img/cart-shopping-solid.svg" class="rounded float-start" style="width: 24px; margin-left: 15px; margin-top: 1px;"></a>
        </div>
      </div>
    </nav>
    
  </header>