<?php
    include 'lib/database.php';
?>

<?php
    class output{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function updateProductAndInsertOutput($productname, $total_product, $price, $sold_by, $ghichu) {
            // Lấy thông tin sản phẩm bằng tên sản phẩm
            $product_id = $this->getProIdByName($productname);
        
            // Lấy số lượng tồn kho hiện tại
            $currentStock = $this->getCurrentProductQuantity($product_id);
        
            // Kiểm tra xem số lượng tồn kho có đủ lớn để xuất hàng không
            if ($currentStock >= $total_product) {
                // Tạo thời gian hiện tại
                $currentDateTime = date('Y-m-d H:i:s');
        
                // Cập nhật số lượng tồn kho
                $inputQuery = "INSERT INTO output_history (product_id, total_product, price, output_date, sold_by, ghichu)
                           VALUES ('$product_id', '$total_product', '$price', '$currentDateTime', '$sold_by', '$ghichu')";
                $inputResult = $this->db->insert($inputQuery);
        
            // Nếu việc ghi giao dịch nhập hàng thành công, thì cập nhật số lượng tồn kho
            if ($inputResult) {
                $updateStockQuery = "UPDATE product
                SET total_product = total_product - '$total_product'
                WHERE id = '$product_id'";
                $updateResult = $this->db->update($updateStockQuery);
        
                if ($updateResult) {
                    echo '<script>window.location.href = "salary.php";</script>';
                }
        
                return $updateResult;
            }
            } else {
                echo '<script>window.location.href = "output.php";</script>';
            }
        
            return false;
        }
        

        public function show_orders_product(){
            $query = "SELECT
                        product.name AS productname,
                        output_history.total_product,
                        output_history.price,
                        output_history.output_date,
                        output_history.sold_by,
                        output_history.ghichu
                        FROM
                        output_history
                        INNER JOIN
                        product ON output_history.product_id = product.id
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_product(){
            $query = "SELECT * FROM product ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_output(){
            $query = "SELECT * FROM output_history ORDER BY id ASC";
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
        public function getCurrentProductQuantity($product_id) {
            $query = "SELECT total_product FROM product WHERE id = '$product_id'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['total_product'];
            } else {
                return 0; // Hoặc giá trị mặc định khác nếu sản phẩm không tồn tại
            }
        }
        
    }
?>