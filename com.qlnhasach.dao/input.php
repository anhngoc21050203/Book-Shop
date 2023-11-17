<?php
    include 'lib/database.php';
?>

<?php
    class input{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function insertInputAndUpdateProduct($productname, $total_product, $price, $createdby, $ghichu) {
            // Lấy thông tin sản phẩm bằng tên sản phẩm
            $product_id = $this->getProIdByName($productname);
        
            // Tạo thời gian hiện tại
            $currentDateTime = date('Y-m-d H:i:s');
        
            // Thực hiện ghi giao dịch nhập hàng
            $inputQuery = "INSERT INTO input_history (product_id, total_product, price, input_date, createdby, ghichu)
                           VALUES ('$product_id', '$total_product', '$price', '$currentDateTime', '$createdby', '$ghichu')";
            $inputResult = $this->db->insert($inputQuery);
        
            // Nếu việc ghi giao dịch nhập hàng thành công, thì cập nhật số lượng tồn kho
            if ($inputResult) {
                $updateStockQuery = "UPDATE product
                SET total_product = total_product + '$total_product'
                WHERE id = '$product_id'";
                $updateResult = $this->db->update($updateStockQuery);
        
                if ($updateResult) {
                    echo '<script>window.location.href = "salary.php";</script>';
                }
        
                return $updateResult;
            }
        
            return false;
        }
        

        public function show_orders_product(){
            $query = "SELECT
                        product.name AS productname,
                        input_history.total_product,
                        input_history.price,
                        input_history.input_date,
                        input_history.createdby,
                        input_history.ghichu
                        FROM
                        input_history
                        INNER JOIN
                        product ON input_history.product_id = product.id
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_product(){
            $query = "SELECT * FROM product ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_input(){
            $query = "SELECT * FROM input_history ORDER BY id ASC";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function getProIdByName($namepro){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM product WHERE name = '$namepro'";
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