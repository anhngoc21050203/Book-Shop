<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.dao/anh_them.php';
    $sach = new anhthem();

    if (isset($_GET['id'])) {
        $anhid = $_GET['id'];
        $delete_result = $sach->delete_anh_bo_sung($anhid);
    }
    
?>