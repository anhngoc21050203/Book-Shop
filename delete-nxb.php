<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.dao/nxb_dao.php';
    $nxb_Model = new nxb();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $delete_result = $nxb_Model->delete_nha_xuat_ban($id);
    }
    
?>