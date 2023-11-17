<?php
  include '../user_header/header.php'
?>
<?php
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  $sql = "SELECT product.*, category.CategoryName
  FROM product
  INNER JOIN category ON product.category_id = category.CategoryID
  WHERE product.category_id = '$id'";
  $result = $conn->query($sql);
?>
  <body>
    <div style="position: relative;">
      <nav style="--bs-breadcrumb-divider: '>'; position: absolute; padding-left: 20px; padding-top: 20px; margin-left: 100px;" aria-label="breadcrumb" >
        <h3 style="color: white;">Trạm Sách Online</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a class="breadcrumb-a" href="../Trangchu/Trangchu.php">Trang Chủ</a>
          </li>
          <?php
             if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo '<li class="breadcrumb-item active" aria-current="page">Thể loại: '.$row['CategoryName'].'</li>';
              $result->data_seek(0);
             }
          ?>
        </ol>
      </nav>
      <img src="./Trangchu-img/banner_home_pro3.png" class="img-fluid" alt="...">
    </div>
    <div class="container-fluid">
          <div class="col py-3">
            <section class="py-5">
              <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                  if ($result->num_rows > 0) {
                    // Duyệt qua các bản ghi và xử lý dữ liệu ở đây
                    while($row = $result->fetch_assoc()) {
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
                                    <!-- Product price-->  <p style="text-decoration-line: underline;">'.$row['price'] .' đ</p>
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
                    <!--
                      <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Trước</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">Sau</a>
                          </li>
                        </ul>
                      </nav>
                    -->
                </div>
              </div>
            </section>

          </div>
      </div>
  </div>
      <script type="text/javascript" src="Bootstrap/js/bootstrap.js"></script>
      <script type="text/javascript" src="./MDB/js/mdb.min.js"></script>
    </div>
  </body>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">@Thư Viện Online - Made by Group 3</p>
    </div>
  </footer>
</html>