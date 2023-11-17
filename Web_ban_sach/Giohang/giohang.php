<?php
  include 'header.php';
?>
<?php
  include '../../connection.php';

  if (isset($_GET['id'])) {
      $idsp = $_GET['id'];
  }

  $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
  $stmt->bind_param("i", $idsp);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
      $new_product = array(
          'id' => $row['id'],
          'name' => $row['name'],
          'price' => $row['price'],
          'quantity' => 1,
          'thumbnail' => $row['thumbnail'],
          'author' => $row['author']
      );

      if (isset($_SESSION['cart'][$idsp])) {
          // Product already in cart, update quantity
          $_SESSION['cart'][$idsp]['quantity'] += 1;
      } else {
          // Product not in cart, add it
          $_SESSION['cart'][$idsp] = $new_product;
      }
    header('Location:giohang.php');
  }

  // Close the statement
  $stmt->close();
  if (isset($_GET['xoasp'])) {
    $idToRemove = $_GET['xoasp'];

    if (isset($_SESSION['cart'][$idToRemove])) {
        unset($_SESSION['cart'][$idToRemove]);
    }
    header('Location:giohang.php');
}
  if (isset($_GET['trusp'])){
    $idtru = $_GET['trusp'];
    if (isset($_SESSION['cart'][$idtru])) {
      $_SESSION['cart'][$idtru]['quantity'] -= 1;
      if ($_SESSION['cart'][$idtru]['quantity'] == 0) {
        unset($_SESSION['cart'][$idtru]);
    }
    }
    header('Location:giohang.php');
  }
  if (isset($_GET['congsp'])){
    $idcong = $_GET['congsp'];
    if (isset($_SESSION['cart'][$idcong])) {
      if ($_SESSION['cart'][$idcong]['quantity'] < 10) {
        $_SESSION['cart'][$idcong]['quantity'] += 1;
      }
    }
    header('Location:giohang.php');
  }

?>

<body>
  <section class="h-100 gradient-custom">
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Giỏ hàng</h5>
            </div>
            <div class="card-body">
            <?php
            $thanhtien = 0;
                if (isset($_SESSION['cart'])) {
                  foreach($_SESSION['cart'] as $cart){
                    $tongien = $cart['price']*$cart['quantity'];
                    $thanhtien += $tongien;
                    echo '
                      <!-- Single item -->
                      <div class="row">
                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                          <!-- Image -->
                          <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                            <img src="../../upload/'.$cart['thumbnail'].'"
                              class="w-100" alt="Blue Jeans Jacket" />
                            <a href="#!">
                              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                            </a>
                          </div>
                          <!-- Image -->
                        </div>
                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                          <!-- Data -->
                          <p><strong>'.$cart['name'].'</strong></p>
                          <p>Tác giả: '.$cart['author'].'</p>
                          <p>Giá/1sp: '.$cart['price'].' đ</p>
                          <a href="giohang.php?xoasp='.$cart['id'].'"><button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                            title="Xóa sản phầm khỏi giỏ hàng">
                            <i class="fas fa-trash"></i>
                          </button></a>
                          <!-- Data -->
                        </div>   
                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                          <div class="d-flex mb-4" style="max-width: 300px">
                              <a href="giohang.php?trusp='.$cart['id'].'"><button class="btn btn-primary px-3 me-2" onclick="decrementQuantity(this)">
                                  <i class="fas fa-minus"></i>
                              </button></a>
                              <div class="form-outline">
                                  <input id="form1" min="0" name="quantity" value="'.$cart['quantity'].'" type="number" class="form-control" />
                                  <label class="form-label" for="form1">Số Lượng</label>
                              </div>
                              <a href="giohang.php?congsp='.$cart['id'].'"><button class="btn btn-primary px-3 ms-2" onclick="incrementQuantity(this)">
                                  <i class="fas fa-plus"></i>
                              </button></a>
                          </div>
                          <p class="text-start text-md-center">
                              <strong>Tổng tiền: '.$tongien.' đ</strong>
                          </p>
                        </div>
                      </div>
                      <hr class="my-4" />             
                    ';
                  }
              }
            ?>
            </div>
          </div>
  
          <!--
            <div class="card mb-4">
              <div class="card-body">
                <form class="d-flex input-group w-auto">
                  <input
                    type="search"
                    class="form-control rounded"
                    placeholder="Nhập Mã Giảm Giá"
                    aria-label="Search"
                    aria-describedby="search-addon"
                  />
                  <button type="button" class="btn btn-light" data-mdb-ripple-color="dark" style="margin-left: 10px; ">Nhập</button>
                </form>
                <br>
                <p><strong>Dự Kiến Giao Hàng</strong></p>
                <p class="mb-0">20.10.2023 - 22.10.2023</p>
              </div>
            </div>

          -->

          <div class="card mb-4 mb-lg-0">
            <?php
              echo'
              <div class="card-body">
                <p><strong>Thông tin nhận hàng</strong></p>
                <div class="form-outline">
                  <input
                    class="form-control"
                    id="formControlReadonly"
                    type="text"
                    aria-label="readonly input example"
                    value="'.$_SESSION['fullname'].'"readonly
                  >
                  <label class="form-label" for="formControlReadonly">Họ và tên</label>
                </div>
  
                <br>
                <div class="form-outline">
                  <input
                    class="form-control"
                    id="formControlReadonly" 
                    type="text"
                    aria-label="readonly input example"
                    value="'.$_SESSION['address'].'" readonly
                  />
                  <label class="form-label" for="formControlReadonly">Địa chỉ chi tiết</label>
                </div>
                <br>
                <div class="form-outline">
                  <input
                    class="form-control"
                    id="formControlReadonly"
                    type="text"
                    aria-label="readonly input example"
                    value="'.$_SESSION['phone_number'].'" readonly
                  />
                  <label class="form-label" for="formControlReadonly">Số điện thoại</label>
                </div>
                <br>            
              </div>
              
              ';
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <form method="post" action="thanhtoan.php">
            <div class="card mb-4">
              <div class="card-body">
                  <p><strong>Hình Thức Thanh Toán</strong></p>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1" value="Tiền mặt" checked/>
                    <img src="../../assets/img/money.png"> 
                    <label class="form-check-label" for="flexRadioDefault1"> Thanh toán khi nhận hàng </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2" value="Chuyển khoản"/>
                    <img src="../../assets/img/money (1).png"> 
                    <label class="form-check-label" for="flexRadioDefault2"> Chuyển khoản </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault3" value="VNPAY"/>
                    <img width="16px" src="../../assets/img/0oxhzjmxbksr1686814746087.png"> 
                    <label class="form-check-label" for="payment"> VNPAY </label>
                  </div>
                  <!--

                    <img class="me-2" width="45px"
                      src="../imgforweb/logo-vietcombank-inkythuatso-10-10-41-18-16771235759271889182462.webp"
                      alt="Vietcombank" />
                    <img class="me-2" width="45px"
                      src="../imgforweb/logo-vietinbank-dongphucvina.vn_.png"
                      alt="Viettinbank" />
                    <img class="me-2" width="45px"
                      src="../imgforweb/no-image-momo.jpg"
                      alt="Momo" />
                  -->
                </div>
              <div class="card-header py-3">
                <h5 class="mb-0">Thành Tiền</h5>
              </div>
              <div class="card-body">
                <?php
                if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
                  $ship=0;
                }else{
                  $ship = 30000;
                }
                  $hd = $thanhtien + $ship;
                  echo'
                    <ul class="list-group list-group-flush">
                      <div class="form-outline">
                        <textarea class="form-control" id="textAreaExample" rows="4" name="ghichu"></textarea>
                        <label class="form-label" for="textAreaExample">Ghi chú</label>
                      </div>  
                      <li
                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Đơn giá: 
                        <span>'.$thanhtien.' đ</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        VAT
                        <span>'.$ship.' đ</span>
                      </li>
                      <li
                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                          <strong>Tổng Tiền</strong>
                          <strong>
                            <p class="mb-0">(Bao gồm SHIP)</p>
                          </strong>
                        </div>
                        <span><strong>'.$hd.'</strong></span>
                      </li>
                    </ul>
                    <input type="hidden" name="hd" value="'.$hd.'">
                    ';
                    
                    ?>
                </a>
                <?php
                  if ($hd ==0 ){
                    echo '';
                  }
                  else{
                    echo '
                    <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="submitForm()"> Thanh Toán</button>
                    ';
                  }
                ?>
              </div>
            </div>
          </form>
          </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="./MDB/js/mdb.min.js"></script>
  <script>
    function decrementQuantity(button) {
        const input = button.parentNode.querySelector('input[type=number]');
        if (input.value > 1) {
            input.stepDown();
        }
    }

    function incrementQuantity(button) {
        const input = button.parentNode.querySelector('input[type=number]');
        input.stepUp();
    }
  </script>
    <script>
    function submitForm() {
      // Lấy nội dung ô ghi chú
      var ghichu = document.getElementById("textAreaExample").value;
      
      // Tạo một form ẩn để gửi dữ liệu
      var form = document.createElement("form");
      form.setAttribute("method", "post");
      form.setAttribute("action", "thanhtoan.php");

      // Tạo một input để chứa nội dung ô ghi chú
      var input = document.createElement("input");
      input.setAttribute("type", "hidden");
      input.setAttribute("name", "ghichu");
      input.setAttribute("value", ghichu);

      // Thêm input vào form
      form.appendChild(input);

      // Thêm form vào body và submit nó
      document.body.appendChild(form);
      form.submit();
    }
    </script>

  <script type="text/javascript"></script>
</body>
</html>