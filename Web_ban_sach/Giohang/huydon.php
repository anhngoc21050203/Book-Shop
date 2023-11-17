<?php
    include '../../connection.php';
    if (isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }
    $query1 = "UPDATE orders SET status = '6' WHERE id = '$order_id'";
    $rs1 = $conn->query($query1);
    if($rs1){
        header('Location: thongtin.php');
    }
?>