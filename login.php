<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/3532091.png">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<?php
    session_start();
    include 'com.qlnhasach.dao/employees_class.php';
    $nguoidungModel = new employess();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userlogin = $nguoidungModel->login($username, $password);
        if($userlogin){
            $user = $userlogin->fetch_assoc();
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['role_id'] = $user['role_id'];
            if ($user['role_id'] == 1) {
                // Nếu vai trò là admin, đẩy họ vào trang admin
                echo '<script>window.location.href = "index.php";</script>';
                exit;
            }elseif(($user['role_id'] == 3)){
                echo '<script>window.location.href = "salary.php";</script>';
                exit;
            } else {
                // Nếu vai trò là user (hoặc vai trò khác), đẩy họ vào trang user
                echo '<script>window.location.href = "Web_ban_sach/Trangchu/Trangchu.php";</script>';
                exit;
            }
        }else {
            // Xác minh không thành công, hiển thị thông báo lỗi
            $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
            echo '<script>window.location.href = "login.php";</script>';
            session_unset();
            }
        }
?>
<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="login.php" method="POST">
						<div class="account-logo">
                            <img src="assets/img/3532091.png " alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Tên người dùng</label>
                            <input type="text" autofocus="" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group text-right">
                            <a href="forgot-password.html">Quên mật khẩu?</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn" name="login">Đăng nhập</button>
                        </div>
                        <div class="text-center register-link">
                            Bạn không có tài khoản? <a href="register.php">Đăng kí ngay!</a>
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


<!-- login23:12-->
</html>