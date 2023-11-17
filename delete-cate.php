<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.model/category_class.php';
    $categoryModel = new category();

    if (isset($_GET['id'])) {
        $categoryID = $_GET['id'];
        $delete_result = $categoryModel->delete_cartegory($categoryID);
    }
    
?>