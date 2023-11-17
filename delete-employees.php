<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.dao/employees_class.php';
    $nguoidungModel = new employess();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete = $nguoidungModel->delete_nguoidung($id);
    }
    
?>