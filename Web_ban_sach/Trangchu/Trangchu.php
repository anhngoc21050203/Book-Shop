<?php
  include '../user_header/header.php'
?>
  <body>
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Trangchu-img/ms_banner_img4.webp" class="d-block w-100" alt="Ở ngoài kia đại dương">
    
        </div>
        <div class="carousel-item">
          <img src="Trangchu-img/ms_banner_img3.webp" class="d-block w-100" alt="Hôn nhân hạnh phúc của tôi">
    
        </div>
        <div class="carousel-item">
          <img src="Trangchu-img/ms_banner_img5.webp" class="d-block w-100" alt="Bếp chiến Sanji">
    
        </div>
        <div class="carousel-item">
          <img src="../imgforweb/395249663_657542379825613_1826570120566597181_n.gif" class="d-block w-100" alt="Ngày xưa ơi">
    
        </div>
        <div class="carousel-item">
          <img src="../imgforweb/395765075_7291873364158002_6836979837739490998_n.gif" class="d-block w-100" alt="Thiên sứ 7">
    
        </div>
        <div class="carousel-item">
          <img src="../imgforweb/397947657_665214542395090_7207889694504454610_n.gif" class="d-block w-100" alt="Nói hay">
    
        </div>
      </div>
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="5" aria-label="Slide 6"></button>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <br>
    <?php
      $sql = "SELECT * FROM product WHERE category_id = 3 LIMIT 4";
      $result = $conn->query($sql);
      $sql1 = "SELECT * FROM product WHERE category_id = 12 LIMIT 4";
      $result1 = $conn->query($sql1);
      $sql2 = "SELECT * FROM product WHERE category_id = 23 LIMIT 4";
      $result2 = $conn->query($sql2);

    ?>
    <p class="fw-bolder">Văn Học</p>
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php
      if ($result->num_rows > 0) {
        // Duyệt qua các bản ghi và xử lý dữ liệu ở đây
        while($row = $result->fetch_assoc()) {
          echo '
                <div class="col mb-2">
                  <div class="card h-90" >
                    <!-- Product image-->
                    <img class="card-img-top" src="../../upload/'.$row['thumbnail'].'">
                    <!-- Product details-->
                    <div class="card-body p-4">
                      <div class="text-center">
                        <!-- Product name-->
                        <a style="text-decoration: none;  color: black;" href="../Chitiet/Chitiet.php?id='.$row['id'].'"><h5 class="fw-bolder">'.$row['name'].'</h5></a>
                        <!-- Product price-->  <p style="text-decoration-line: underline;">Giá: '.$row['price'] .' đ</p>
                      </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                      <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" href="../Giohang/giohang.php?id='.$row['id'].'">Thêm vào giỏ</a>
                      </div>
                    </div>
                  </div>
                </div>
                ';
              }
            } 
            ?>
            </div>
          </div>
          </section>
  
    <div>
      <img src="./Trangchu-img/banner_home_pro_1.webp" class="img-fluid" alt="...">
    </div>
    <br>
    <br>
    <p class="fw-bolder">Lịch sử</p>
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php
      if ($result1->num_rows > 0) {
        // Duyệt qua các bản ghi và xử lý dữ liệu ở đây
        while($row = $result1->fetch_assoc()) {
          echo '
          <div class="col mb-2">
                  <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="../../upload/'.$row['thumbnail'].'">
                    <!-- Product details-->
                    <div class="card-body p-4">
                      <div class="text-center">
                        <!-- Product name-->
                        <a style="text-decoration: none;  color: black;" href="../Chitiet/Chitiet.php?id='.$row['id'].'"><h5 class="fw-bolder">'.$row['name'].'</h5></a>
                        <!-- Product price-->  <p style="text-decoration-line: underline;">Giá: '.$row['price'] .' đ</p>
                      </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                      <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" href="../Giohang/giohang.php?id='.$row['id'].'">Thêm vào giỏ</a>
                      </div>
                    </div>
                  </div>
                </div>
                ';
              }
            } 
            ?>
            </div>
          </div>
          </section>
    <div>
      <img src="./Trangchu-img/banner_home_pro_7.webp" class="img-fluid" alt="...">
    </div>
    <br>
    <br>
    <p class="fw-bolder">Light Novel</p>
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php
      if ($result2->num_rows > 0) {
        // Duyệt qua các bản ghi và xử lý dữ liệu ở đây
        while($row = $result2->fetch_assoc()) {
          echo '
                <div class="col mb-2">
                  <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" height="325px" src="../../upload/'.$row['thumbnail'].'">
                    <!-- Product details-->
                    <div class="card-body p-4">
                      <div class="text-center">
                        <!-- Product name-->
                        <a style="text-decoration: none;  color: black;" href="../Chitiet/Chitiet.php?id='.$row['id'].'"><h5 class="fw-bolder">'.$row['name'].'</h5></a>
                        <!-- Product price-->  <p style="text-decoration-line: underline;">Giá: '.$row['price'] .' đ</p>
                      </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                      <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" href="../Giohang/giohang.php?id='.$row['id'].'">Thêm vào giỏ</a>
                      </div>
                    </div>
                  </div>
                </div>
                ';
              }
            } 
            ?>
            </div>
          </div>
          </section>
    <script type="text/javascript" src="Bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="Trangchu.js"></script>
  </body>
  <br><br>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">@Thư Viện Online - Made by Group 3</p>
    </div>
  </footer>
</html>