<?php
$servername = "localhost";
$port = 4306;
$username = "root";
$password = "";
$database = "nhasach_ol";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
