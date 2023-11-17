<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.dao/feedback.php';
    $fb_Model = new fb();
    $fb_List = $fb_Model->show_fb();

    if(isset($_POST['reply'])){
        $id = $_POST['id'];
        $reply_fb = $_POST['reply_fb'];
        $result = $fb_Model->update_fb($id, $reply_fb);
    }
    
?>