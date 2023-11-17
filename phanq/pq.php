<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    echo '<script>window.location.href = "Web_ban_sach/Trangchu/Trangchu.php";</script>';
    exit;
}else{
    $id = $_SESSION['role_id'];
    $username = $_SESSION['username'];
    if($id != 1){
        echo '<script>window.location.href = "Web_ban_sach/Trangchu/Trangchu.php";</script>';
    }else if($id == 3){
        header("Location: salary.php");
        exit;
    }
}
// Ngược lại, người dùng đã đăng nhập và có thể truy cập trang này
?>