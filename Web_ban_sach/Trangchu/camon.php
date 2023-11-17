<?php
    include '../../connection.php';
    if(isset($_GET['vnp_Amount'])){
        $vnp_Amount = $_GET['vnp_Amount'];
        $vnp_BankCode = $_GET['vnp_BankCode'];
        $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
        $vnp_CardType = $_GET['vnp_CardType'];
        $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
        $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
        $vnp_TmnCode = $_GET['vnp_TmnCode'];
        $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
        $vnp_TransactionStatus = $_GET['vnp_TransactionStatus'];
        $vnp_TxnRef = $_GET['vnp_TxnRef'];
    }
    if ($vnp_TransactionStatus == '00') {
        // Truy vấn id từ bảng orders
        $sql = "SELECT id FROM orders WHERE order_code = '$vnp_TxnRef'";
        $query = $conn->query($sql);

        if ($query) {
            // Kiểm tra xem có bản ghi phù hợp không
            if ($query->num_rows > 0) {
                $row = $query->fetch_assoc();
                $order_id = $row['id'];
                echo "$order_id, $vnp_TransactionNo, $vnp_TransactionStatus";
            } else {
                echo "Không tìm thấy đơn hàng phù hợp.";
            }
        } 
    }
    if ($order_id != null){
        $sql = "UPDATE order_details SET transactionno = '$vnp_TransactionNo', transactionstatus = '$vnp_TransactionStatus' WHERE order_id = '$order_id'";
        $query = $conn->query($sql);
    }
    header('Location: Trangchu.php');
?>