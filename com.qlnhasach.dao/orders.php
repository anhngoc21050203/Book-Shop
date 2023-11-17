<?php
    include 'lib/database.php';
?>
<?php
    class orders{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }
        public function search_orders($searchQuery) {
            $query = "SELECT
                        orders.id,
                        orders.order_code,
                        nguoidung.username,
                        nguoidung.address,
                        orders.note,
                        orders.total,
                        orders.order_date,
                        order_status.id AS ido,
                        order_status.status_name
                        FROM
                        orders
                        INNER JOIN
                        nguoidung ON orders.user_id = nguoidung.id
                        INNER JOIN
                        order_status ON orders.status = order_status.id
                        WHERE
                        orders.order_code LIKE '%$searchQuery%'
                        OR nguoidung.username LIKE '%$searchQuery%'
                        OR nguoidung.address LIKE '%$searchQuery%'
                        OR orders.note LIKE '%$searchQuery%'
                        OR order_status.status_name LIKE '%$searchQuery'
                    ";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_orders($order_code, $username, $productname, $note, $total_product){
            $currentDateTime = date('Y-m-d H:i:s');
            $user_id = $this->getUserIdByName($username);
            $product_id = $this->getProIdByName($productname);
            $status_id = 2;
            $price = floatval($this->get_price($productname));
            $total_money = $price * (int)$total_product;
            $query = "INSERT INTO orders (order_code, user_id, note, order_date, status) VALUES ('$order_code', '$user_id', '$note', '$currentDateTime', '$status_id')";
            $result = $this ->db ->insert($query);
            if ($result) {
                // Thêm bản ghi vào bảng "order_detail"
                $order_id = $this->db->getLastInsertedId(); // Lấy ID của đơn hàng vừa tạo
                $query = "INSERT INTO order_details (order_id, num, productid, total_money) VALUES ('$order_id', '$product_id', '$total_product', '$total_money')";
                $detail_result = $this->db->insert($query);
        
                if ($detail_result) {
                    echo '<script>window.location.href = "invoices.php";</script>';
                } else {
                    echo 'Thêm đơn hàng không thành công.';
                }
            } else {
                echo 'Thêm đơn hàng không thành công.';
            }
            return $result;
        }

        public function show_orders(){
            $query = "SELECT
                        orders.id,
                        orders.order_code,
                        nguoidung.username,
                        nguoidung.address,
                        orders.status,
                        orders.note,
                        orders.total,
                        orders.order_date,
                        order_status.id AS ido,
                        order_status.status_name
                        FROM
                        orders
                        INNER JOIN
                        nguoidung ON orders.user_id = nguoidung.id
                        INNER JOIN
                        order_status ON orders.status = order_status.id
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_orders_user(){
            $query = "SELECT * FROM nguoidung WHERE role_id= 2";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_orders_product(){
            $query = "SELECT * FROM product ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_orders_status(){
            $query = "SELECT * FROM order_status ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function get_orders($id){
            $query = "SELECT
                        orders.id,
                        orders.order_code,
                        nguoidung.username,
                        nguoidung.phone_number,
                        nguoidung.email,
                        product.name AS product_name, 
                        nguoidung.address,
                        orders.note,
                        orders.total,
                        orders.order_date,                        
                        order_status.status_name,
                        order_details.num,
                        order_details.payment,
                        order_details.transactionno,
                        order_details.transactionstatus,
                        order_details.total_money
                        FROM
                        orders
                        INNER JOIN
                        nguoidung ON orders.user_id = nguoidung.id
                        INNER JOIN
                        order_status ON orders.status = order_status.id
                        LEFT JOIN
                        order_details ON orders.id = order_details.order_id
                        INNER JOIN
                        product ON order_details.product_id = product.id
                    WHERE
                        orders.id = '$id'";
            $result = $this -> db ->select($query);
            return $result;
        }
        public function get_orders_details($id){
            $query = "SELECT order_details.*, product.name AS product_name, product.price
                      FROM order_details
                      INNER JOIN product ON order_details.product_id = product.id
                      WHERE order_id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        

        // public function update_orders($statusname, $id) {
        //     $status_id = $this->getStatusByName($statusname);

        //         // Tiếp tục với cập nhật thông tin đơn hàng
        //         $query = "UPDATE orders SET status= '$status_id' WHERE id = '$id'";
        //         $result = $this->db->update($query);
                
        //         if ($result) {
        //             echo '<script>window.location.href = "invoices.php";</script>';
        //         } else {
        //             echo 'Cập nhật đơn hàng không thành công.';
        //         }
        //     return $result;
        // }
        public function update_orders($statusname, $id) {
            $status_id = $this->getStatusByName($statusname);
            $status_cr = $this->get_status($id);
            $orderDetails = false;
        
            // Kiểm tra nếu status_id = 2 và status hiện tại (status_cr) khác 2 thì thực hiện trừ số lượng sản phẩm
            if ($status_cr == 1){
                $query = "SELECT product_id, num FROM order_details WHERE order_id = '$id'";
                $orderDetails = $this->db->select($query);
        
                if ($orderDetails) {
                    foreach ($orderDetails as $orderDetail) {
                        $product_id = $orderDetail['product_id'];
                        $num = $orderDetail['num'];
        
                        // Trừ số lượng sản phẩm trong kho
                        $query = "UPDATE product SET total_product = total_product - '$num' WHERE id = '$product_id'";
                        $result = $this->db->update($query);
                    }
                }
            }
        
            if($status_id > $status_cr){
                $query = "UPDATE orders SET status = '$status_id' WHERE id = '$id'";
                $result = $this->db->update($query);
            
                if ($result) {
                    echo '<script>window.location.href = "invoices.php";</script>';
                } else {
                    echo 'Cập nhật đơn hàng không thành công.';
                }
            }else{
                echo '<script>window.location.href = "invoices.php";</script>';
            }
        
            return $result;
        }
        
        public function get_price($productname){
            $product_id = $this->getProIdByName($productname);
            $query = "SELECT * FROM product WHERE id = '$product_id'";
            $result = $this -> db ->select($query);
            if ($result) {
                $row = $result->fetch_assoc();
                $price = $row['price'];
                return $price;
            }
            return null;
        }
        public function get_status($id){
            $query = "SELECT status FROM orders WHERE id = '$id'";
            $result = $this -> db ->select($query);
            if ($result) {
                $row = $result->fetch_assoc();
                return $row['status'];
            }
            return null;
        }
        
        public function delete_orders($id){
            $query = "DELETE  FROM orders WHERE id = '$id'";
            $result = $this -> db ->delete($query);
            if ($result) {
                echo '<script>window.location.href = "invoices.php";</script>';
            }
            return $result;
        }
        public function getProIdByName($role_name){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM product WHERE name = '$role_name'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy một dòng dữ liệu
                return $row['id']; // Trả về ID nếu tìm thấy thể loại
            } else {
                return null; // Trả về null nếu không tìm thấy thể loại
            }
        }
        public function getUserIdByName($role_name){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM nguoidung WHERE username = '$role_name'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy một dòng dữ liệu
                return $row['id']; // Trả về ID nếu tìm thấy thể loại
            } else {
                return null; // Trả về null nếu không tìm thấy thể loại
            }
        }
        public function getStatusByName($role_name){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM order_status WHERE status_name = '$role_name'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy một dòng dữ liệu
                return $row['id']; // Trả về ID nếu tìm thấy thể loại
            } else {
                return null; // Trả về null nếu không tìm thấy thể loại
            }
        }
    
    }
?>
