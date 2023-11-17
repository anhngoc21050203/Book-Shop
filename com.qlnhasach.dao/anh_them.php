<?php
    include 'lib/database.php';
?>

<?php
    class anhthem{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function insert_anh_bo_sung($product_name, $image_path, $image_name){
            $currentDateTime = date('Y-m-d H:i:s');
            $createBy = "admin";
            $product_id = $this->getCategoryIdByName($product_name);
            $query = "INSERT INTO anh_bo_sung (product_id, image_path, created_at, created_by, image_name) VALUES ('$product_id', '$image_path' ,  '$currentDateTime', '$createBy' ,'$image_name')";
            $result = $this ->db ->insert($query);
            if ($result) {
                echo '<script>window.location.href = "sach_anh.php";</script>';
            }else{
                echo 'Thêm không thanh công';
            }
            return $result;   
        }
        public function show_anh_bo_sung(){
            $query = "SELECT
                        anh_bo_sung.id,
                        anh_bo_sung.image_name,
                        product.name AS product_name,
                        anh_bo_sung.image_path,
                        anh_bo_sung.created_at,
                        anh_bo_sung.created_by
                        FROM
                        anh_bo_sung
                        INNER JOIN
                        product ON anh_bo_sung.product_id = product.id
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_anh_bo_sung_product(){
            $query = "SELECT * FROM product ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function get_anh_bo_sung($id){
            $query = "SELECT
                        anh_bo_sung.id,
                        product.name AS product_name,
                        anh_bo_sung.image_path,
                        anh_bo_sung.created_at,
                        anh_bo_sung.created_by,
                        anh_bo_sung.image_name
                        FROM
                        anh_bo_sung
                        INNER JOIN
                        product ON anh_bo_sung.product_id = product.id
                        WHERE
                        anh_bo_sung.product_id = '$id'";
            $result = $this -> db ->select($query);
            return $result;
        }
        public function delete_anh_bo_sung($id){
            $query = "DELETE  FROM anh_bo_sung WHERE id = '$id'";
            $result = $this -> db ->delete($query);
            if ($result) {
                echo '<script>window.location.href = "sach_anh.php";</script>';
            }
            return $result;
        }

        public function getCategoryIdByName($product_name){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM product WHERE name = '$product_name'";
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