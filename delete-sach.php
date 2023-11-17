<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.dao/sach_class.php';
    $sachModel = new sach();

    if (isset($_GET['id'])) {
        $sachID = $_GET['id'];
        $delete_sach = $sachModel->delete_product($sachID);
    }
    
?>