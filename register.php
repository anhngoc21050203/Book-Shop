<!DOCTYPE html>
<html lang="en">


<!-- register24:03-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/3532091.png">
    <title>Đăng kí</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<?php
    session_start();
    include 'com.qlnhasach.dao/employees_class.php';
    $nguoidungModel = new employess();

    if (isset($_POST['reg'])) {
        $username = $_POST['username'];
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $userre = $nguoidungModel->register($username, $fullName, $email, $phoneNumber, $address, $password);
        if($userre){
            echo '<script>window.location.href = "Web_ban_sach/Trangchu/Trangchu.php";</script>';
            exit;
        }else {
            // Xác minh không thành công, hiển thị thông báo lỗi
            $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
            echo '<script>window.location.href = "login.php";</script>';
            session_unset();
        }
    }
?>

<body>
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form action="register.php" method="POST" class="form-signin">
						<div class="account-logo">
                            <img src="assets/img/3532091.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Tên người dùng</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" class="form-control" name="fullName">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control"name="email">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="phoneNumber">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group checkbox">
                            <label>
                                <input type="checkbox"> Đồng ý với chính sách của chúng tôi!
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit" name="reg">Đăng kí </button>
                        </div>
                        <div class="text-center login-link">
                            Bạn đã có tài khoản !<a href="login.php">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- register24:03-->
</html>