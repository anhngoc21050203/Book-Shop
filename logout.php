<?php
session_start();

// Xóa tất cả các biến session
session_unset();

// Hủy session
session_destroy();

// Chuyển hướng về trang đăng nhập (hoặc trang chính)
echo '<script>window.location.href = "Web_ban_sach/Trangchu/Trangchu.php";</script>';
exit;
?>