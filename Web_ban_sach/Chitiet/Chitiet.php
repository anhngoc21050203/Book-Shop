<?php
  include '../user_header/header.php'
?>
<?php
  if(isset($_GET['id'])){
    $idpro = $_GET['id'];
  }
  $sql = "SELECT product.*, nha_xuat_ban.ten_nha_xuat_ban, category.CategoryName
  FROM product
  INNER JOIN nha_xuat_ban ON product.NXB = nha_xuat_ban.id
  INNER JOIN category ON product.category_id = category.CategoryID
  WHERE product.id = '$idpro'";
  $result = $conn->query($sql);

  $query = "SELECT od.product_id, SUM(od.num) AS total_products
  FROM order_details od
  JOIN orders o ON od.order_id = o.id
  WHERE od.product_id = '$idpro' AND o.status > 1
  GROUP BY od.product_id";
  $rs = $conn->query($query);
?>
  <body>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../Trangchu/Trangchu.php">Trang chủ</a>
        </li>
        <?php
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo'
              <li class="breadcrumb-item active" aria-current="page">'.$row['name'].'</li>';
              $nxb_id=$row['NXB'];
              $result->data_seek(0);
          }
        ?>
      </ol>
    </nav>
    <div>
    <?php
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo'
        <div class="produce" style="display: flex; margin-left:190px; margin-right:190px">
          <div class="illustrate">
            <img width=500px height: 600px src="../../upload/'.$row['thumbnail'].'" class="rounded float-start" alt="...">
          </div>
          <div class="information">
            <h2 class="text-center title">'.$row['name'].'</h2>
            '
            ?>
            <?php
              if ($rs->num_rows > 0) {
                  $row1 = $rs->fetch_assoc();
                  if (!empty($row1)) {
                      echo '<p class="text-center" style="font-size: 14px;"> Đã bán : ' . $row1['total_products'] . '</p>';
                  }
                }else{
                echo '<p class="text-center" style="font-size: 14px;"> Đã bán : 0 </p>';
              }
            ?>
            <?php
            echo '
            <hr style="margin: 0 auto; width: 50%; border: none;">
            <br>
            <h4 class="price">GIÁ : <span> '.$row['price'].' đ</span>
            <!--
              <span style="color: red;"> 100.000đ </span>
            -->
            </h4>
            <br>
            <ul style="font-size: 15px;">
              <li>Nhà xuất bản: <span style="font-weight: bold;"> '.$row['ten_nha_xuat_ban'].' </span>
              </li>
              <li>Tác giả: <span style="font-weight: bold;">'.$row['author'].'</span>
              </li>
              <li>Thể loại: <span style="font-weight: bold;">'.$row['CategoryName'].'</span>
              </li>
              '
              ?>
              <?php
              if ($row['total_product'] >= 0){
                echo '
                <li>Số lượng bản: <span style="font-weight: bold;">'.$row['total_product'].'</span>
                ';
              }else{
                echo '
                <li>Số lượng bản: <span style="font-weight: bold;">Hết sách</span>
                ';
              }
              ?>
              <?php
              echo'
              </li>
              <li>Khuôn Khổ: 13x19 cm</li>
            </ul>
            <div class="buy-button">
              <a href="../Giohang/giohang.php?id='.$row['id'].'" class="btn btn-secondary btn-lg">Thêm Vào Giỏ Hàng</a>
            </div>
          </div>
        </div>
          ';
      }
    ?>
    <?php
      echo '
      <br>
      <br>
      <div class="container text-center width=200px">
        <div class="row row-cols-2">
          <div class="row1">
            <div class="col text-start">Thông Tin Chi Tiết</div>
              <br>
              <textarea style="height: 500px; width: 800px; border: none; background-color: #f7f6f6; " readonly>'.$row['description'].'</textarea>
              <p class="describe" style="font-weight: bold;">'.$row['name'].'</p>

                <div class="new_swiper swiper">
                  <div class="swiper-wrapper">
                  '
                  ?>
                  <?php 
                  $sql2 = "SELECT image_path From anh_bo_sung 
                  WHERE product_id = '$idpro'";
                  $result2 = $conn->query($sql2);
                  if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                    echo '
                    <div class="swiper-slide">
                      <img  src="../../upload/'.$row['image_path']. '" class="w-100 h-100" alt="Ở ngoài kia đại dương">
                    </div>
                    ';
                      }
                    }
                    ?>
                    <!--  -->
                    <?php
                    echo '
                  </div>
                </div>
              <br>
              <br>
            </div>
      '
    ?>
          <div class="row2">
            <div class="col">Truyện Đồng Nhà Xuất Bản</div>
            <br>
            <div class="container text-center">
              <?php
                $sql1 = "SELECT * FROM product WHERE NXB = '$nxb_id' LIMIT 5";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                  while($row = $result1->fetch_assoc()) {
                    if ($row['id'] != $idpro){
                      echo'
                      <div style="display: flex; align-items: center;">
                      <img width=100px height: 200px src="../../upload/'.$row['thumbnail'].'" class="rounded float-start" alt="...">
                        <div>
                          <a style="text-decoration: none;  color: black;" href="../Chitiet/Chitiet.php?id='.$row['id'].'"><h5 class="title-related">'.$row['name'].'</h5></a>
                          <h5 class="price title-related">
                            <span>Giá: '.$row['price'].' đ</span>
                          </h5>
                        </div>
                      </div>
                      <br>
                      ';
                    }
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12 col-lg-10 col-xl-8">
              <div class="card-body">
                <?php
                  $sql2 = "SELECT feedback.*, nguoidung.username
                  FROM
                  feedback
                  INNER JOIN nguoidung ON feedback.user_id = nguoidung.id
                  WHERE product_id = '$idpro'";
                  $result2 = $conn->query($sql2);
                  if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                      echo'
                      <div class="card">
                        <div class="d-flex flex-start align-items-center">
                          <img class="rounded-circle shadow-1-strong me-3" src="../../assets/img/3532091.png" alt="avatar" width="60" height="60" />
                          <div>
                            <h6 class="fw-bold text-primary mb-1">'.$row['username'].'</h6>
                            <p class="text-muted small mb-0"> Bình luận </p>
                          </div>
                        </div>
                        <p class="mt-3 mb-4 pb-2"> '.$row['content'].' </p>
                      </div>
                      ';
                    }
                  }
                ?>
                <!--

                  <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                    <form action="Chitiet.php" method="POST">
                      <div class="d-flex flex-start w-100">
                        <img class="rounded-circle shadow-1-strong me-3" src="../../assets/img/3532091.png" alt="avatar" width="40" height="40" />
                        <div class="form-outline w-100">
                          <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="content"></textarea>
                          <label class="form-label" for="textAreaExample">Message</label>
                        </div>
                      </div>
                      <div class="float-end mt-2 pt-1">
                        <button type="submit" class="btn btn-primary btn-sm" name="cmt">Post comment</button>
                        <button type="reset" class="btn btn-outline-primary btn-sm">Cancel</button>
                      </div>
                    </form>
                  </div>
                -->
            </div>
          </div>
        </div>
      </div>
      </section>
      <p class="text-center" style="font-weight: bold;">CÓ THỂ BẠN SẼ THÍCH</p>
      <?php
        $sql3 = "SELECT * FROM product WHERE category_id ";
        $result3 = $conn->query($sql3);
      ?>
      <!-- Footer-slide -->
      <section class="py-5 section_footer">
          <div class="container px-4 px-lg-1 mt-5 d-flex justify-content-center" style="height: 500px;">
              <div class="row gx-4 gx-lg-2 row-cols-2 row-cols-md-2 row-cols-lg-4 footer_swiper swiper">
                  <?php
                  if ($result3->num_rows > 0) {
                      while ($row = $result3->fetch_assoc()) {
                          echo '
                          <div class="swiper-wrapper col mb-5">
                              <div class="swiper-slide card h-100 ml-5">
                                  <img class="card-img-top " src="../../upload/' . $row['thumbnail'] . '">
                                  <div class="card-body p-4">
                                      <div class="text-center ">
                                          <a style="text-decoration: none; color: black;" href="../Chitiet/Chitiet.php?id=' . $row['id'] . '">
                                              <h5 class="fw-bolder p_h5">' . $row['name'] . '</h5>
                                          </a>
                                          <p style="text-decoration-line: underline;">Giá: ' . $row['price'] . ' đ</p>
                                      </div>
                                  </div>
                                  <div class="p-2 pt-0 border-top-0 bg-transparent">
                                      <div class="text-center">
                                          <a class="btn btn-outline-dark mt-auto" href="../Giohang/giohang.php?id=' . $row['id'] . '">Thêm vào giỏ</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          ';
                      }
                  }
                  ?>
                  <div class="swiper-button-prev">
                     <i class="ri-arrow-left-s-line"></i>
                  </div>
                  <div class="swiper-button-next">
                     <i class="ri-arrow-right-s-line"></i>
                  </div>
              </div>
              
          </div>
      </section>

    </div>

    <script type="text/javascript" src="Bootstrap/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
  </body>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">@Thư Viện Online - Made by Group 3</p>
    </div>
  </footer>
  <script src="../../assets/js/swiper_slide.js"></script>
  <script src="../../assets/js/swiper.js"></script>
  <script src="../../assets/js/swiper-bundle.min.js"></script>
</html>