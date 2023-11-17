<?php
  include 'header.php';
?>
<body>
    <section style="background-color: #eee;">
        <div class="container py-5">
          <div class="row">
            <div class="col">
              <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <h5>Hồ Sơ Của Tôi</h5>
                <h6>Quản lý thông tin hồ sơ để bảo mật tài khoản</h6>
              </nav>
            </div>
          </div>
      
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="../Trangchu-img/pngwing.com.png" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3">Ảnh đại diện</h5>
                  <div class="d-flex justify-content-center mb-2">
                    <input type="file" id="fileImg" accept="image/*" style="display: none;" />
                    <!--
                      <button type="button" onclick="document.getElementById('fileImg').click();" class="btn btn-primary">Tải Ảnh</button>
                    -->
                  </div>
                </div>
              </div>
              <div class="card mb-4 mb-lg-0">
                <div class="card-body p-0">
                  <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <img src="https://down-vn.img.susercontent.com/file/f0049e9df4e536bc3e7f140d071e9078" style="width: 20px;">
                        <a class="userClick" data-mdb-toggle="modal" data-mdb-target="#myModal" href="#"><span class="mb-0">Đơn mua trả khi nhận hàng</span></a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <img src="https://down-vn.img.susercontent.com/file/e10a43b53ec8605f4829da5618e0717c" style="width: 20px;">
                        <a class="userClick" href="#"><span class="mb-0">Thông Báo</span></a>
                      </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                        <i class="fa-solid fa-building-columns" style="color: #ff1a1a;" style="width: 20px;"></i>
                        <a class="userClick" data-mdb-toggle="modal" data-mdb-target="#myModal1" href="#"><span class="mb-0">Đơn hàng theo cổng thanh toán VNPAY</span></a>
                      </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Họ Và Tên</p>
                    </div>
                    <div class="col-sm-9">
                      <input class="userInput" type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Tên Đăng Nhập</p>
                    </div>
                    <div class="col-sm-9">
                      <input class="userInput" type="text" name="username" value="<?php echo $_SESSION['username'] ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <input class="userInput" type="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Số Điện Thoại</p>
                    </div>
                    <div class="col-sm-9">
                      <input class="userInput" type="text" value="<?php echo $_SESSION['phone_number'] ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Địa Chỉ</p>
                    </div>
                    <div class="col-sm-9">
                        <input class="userInput" type="text" name="address" value="<?php echo $_SESSION['address'] ?>">
                    </div>
                  </div>
                </div>
                <!--
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-primary">Thay đổi</button>
                  </div>

                -->
              </div>
              <div class="col-lg-8" style="width: 855.99px;">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Sách Đã Mua</p>
                  </div>
              </div>
              
            </div>
          </div>
        </div>
      </section>
                <?php
                  include '../../connection.php';
                  $sqll = "SELECT orders.*, order_status.status_name, order_details.transactionno, order_details.payment
                   FROM orders 
                   INNER JOIN order_status ON order_status.id = orders.status
                   INNER JOIN order_details ON order_details.order_id = orders.id
                   WHERE user_id = '" . $_SESSION['id'] . "'";
                  $result = $conn->query($sqll);
                ?>
          <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog custom-modal-dialog" style="max-width: calc(100% - 200px);">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Theo dõi đơn mua</h5>
                          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Mã đơn hàng</th>
                                          <th scope="col">Ngày đặt</th>
                                          <th scope="col">Trạng thái</th>
                                          <th scope="col">Giá</th>
                                          <th scope="col" colspan="2">Thanh toán</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      if ($result->num_rows > 0) {
                                          $dem = 1;
                                          while ($row = $result->fetch_assoc()) {
                                            if($row['payment'] != 'VNPAY' && $row['status'] < 6){

                                              echo '
                                              <tr>
                                              <th scope="row">' . $dem . '</th>
                                              <td>' . $row['order_code'] . '</td>
                                              <td>' . $row['order_date'] . '</td>
                                              <td>' . $row['status_name'] . '</td>
                                              <td>' . $row['total'] . '</td>
                                              '?>
                                                <?php
                                                if( $row['status'] == 5 ){
                                                  echo '
                                                  <td>Đã thanh toán</td>
                                                  <td>Để lại feedback!</td>
                                                  ';
                                                }else{
                                                  if ($row['status'] < 5 &&  $row['status'] >= 2) {
                                                    echo '<td>Chưa thanh toán</td>';
                                                  }else if( $row['status'] ==1 ){
                                                    echo '<td><a class="btn-primary" href="huydon.php?order_id=' . $row['id'] . '">Hủy đơn hàng</td>';
                                                  }
                                                }
                                                ?>
                                                <?php
                                                echo '  
                                                </tr>
                                                ';
                                                $dem++;
                                            }
                                          }
                                      }
                                      ?>
                                      <!-- Thêm các hàng dữ liệu khác tương tự -->
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
          <?php
            $sqlll = "SELECT orders.*, order_status.status_name, order_details.transactionno, order_details.payment
              FROM orders 
              INNER JOIN order_status ON order_status.id = orders.status
              INNER JOIN order_details ON order_details.order_id = orders.id
              WHERE orders.user_id = '" . $_SESSION['id'] . "' AND order_details.payment = 'VNPAY'";
            $result1 = $conn->query($sqlll);
          ?>
          <div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog custom-modal-dialog" style="max-width: calc(100% - 200px);">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Đơn mua VNPAY</h5>
                          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Mã đơn hàng</th>
                                          <th scope="col">Ngày đặt</th>
                                          <th scope="col">Trạng thái</th>
                                          <th scope="col">Giá</th>
                                          <th scope="col">Mã giao dịch</th>
                                          <th scope="col" colspan="2">Thanh toán</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      if ($result1->num_rows > 0) {
                                          $dem = 1;
                                          while ($row1 = $result1->fetch_assoc()) {
                                              echo '
                                              <tr>
                                                  <th scope="row">' . $dem . '</th>
                                                  <td>' . $row1['order_code'] . '</td>
                                                  <td>' . $row1['order_date'] . '</td>
                                                  <td>' . $row1['status_name'] . '</td>
                                                  <td>' . $row1['total'] . '</td>
                                                  <td>' . $row1['transactionno'] . '</td>
                                                  '?>
                                                  <?php
                                                  if($row1['transactionno'] != null){
                                                    echo '
                                                    <td>Đã thanh toán</td>
                                                    <td>Để lại feedback!</td>
                                                    ';
                                                  }else{
                                                    echo '
                                                    <td><a class="btn-primary" href="thanhtoan1.php?order_id=' . $row1['id'] . '">Thanh toán ngay</td>
                                                    <td><a class="btn-primary" href="huydon.php?order_id=' . $row1['id'] . '">Hủy đơn hàng</td>
                                                    ';
                                                  }
                                                  ?>
                                                  <?php
                                                  echo '  
                                                  </tr>
                                                ';
                                              $dem++;
                                          }
                                      }
                                      ?>
                                      <!-- Thêm các hàng dữ liệu khác tương tự -->
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>

      <footer class="py-5 bg-dark">
        <div class="container">
          <p class="m-0 text-center text-white">@Thư Viện Online - Made by Group 3</p>
        </div>
      </footer>
    <script type="text/javascript" src="./MDB/js/mdb.min.js"></script>
    <script type="text/javascript"></script>
</body>
</html>