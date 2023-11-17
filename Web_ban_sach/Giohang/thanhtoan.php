<?php
    include '../../connection.php';
    require_once 'config_vnpay.php';
    session_start();
    $payment = null;
    
    if(isset($_POST['ghichu']) && isset($_POST['payment']) && isset($_POST['hd'])){
        $note = $_POST['ghichu'];
        $payment = $_POST['payment'];
        $hd = $_POST['hd'];
    }
    echo "$hd";
    $randomCode = generateRandomCode();
    $user_id = $_SESSION['id'];
    $currentDateTime = date('Y-m-d');
    $status = 1;
    if ($payment == 'Tiền mặt' || $payment == 'Chuyển khoản') {
        $insert_orders = "INSERT INTO orders (order_code, user_id, note, order_date, status, total) VALUES ('$randomCode', '$user_id', '$note', '$currentDateTime', '$status', '$hd')";
        $query = $conn->query($insert_orders);
        $order_id = $conn->insert_id;
        if ($query) {
            foreach ($_SESSION['cart'] as $cart => $value) {
                $id_sp = $value['id'];
                $num = $value['quantity'];
                $total_money = $num * $value['price'];
                $insert_orders_details= "INSERT INTO order_details (order_id, product_id, num, total_money, payment) VALUES ('$order_id', '$id_sp', '$num', '$total_money', '$payment')";
                $query1 = $conn->query($insert_orders_details);       
            }
        }
    }else{
        $vnp_TxnRef = $randomCode; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $hd; // Số tiền thanh toán
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            $insert_orders = "INSERT INTO orders (order_code, user_id, note, order_date, status, total) VALUES ('$randomCode', '$user_id', '$note', '$currentDateTime', '$status', '$hd')";
            $query = $conn->query($insert_orders);
            $order_id = $conn->insert_id;
            if($query){
                foreach($_SESSION['cart'] as $cart => $value){
                    $id_sp = $value['id'];
                    $num = $value['quantity'];
                    $total_money = $num * $value['price'];
                    $insert_orders_details= "INSERT INTO order_details (order_id, product_id, num, total_money, payment) VALUES ('$order_id', '$id_sp', '$num', '$total_money', '$payment')";
                    $query1 = $conn->query($insert_orders_details);       
                }
            }
            if($query && $query1){
                unset($_SESSION['cart']);
                header('Location: ../Trangchu/Trangchu.php');
            }
        }
        header('Location: ' . $vnp_Url);
        die();
    }

    if($query && $query1){
        unset($_SESSION['cart']);
        header('Location: ../Trangchu/Trangchu.php');
    }
    // Hàm sinh mã ngẫu nhiên
    function generateRandomCode() {
        $prefix = "BS"; // Tiền tốggg
        $randomNumber = str_pad(mt_rand(1, 9999), 5, '0', STR_PAD_LEFT); // Số ngẫu nhiên 5 chữ số
        $suffix = "VN"; // Hậu tố

        $code = $prefix . $randomNumber . $suffix;
        return $code;
    }
    ?>