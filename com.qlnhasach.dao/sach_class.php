<?php
    include 'lib/database.php';
?>

<?php
    class sach{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function search_rs($key) {
            $query = "SELECT * FROM product
                INNER JOIN category ON product.category_id = category.CategoryID
                INNER JOIN nha_xuat_ban ON product.NXB = nha_xuat_ban.id
                WHERE product.id LIKE '%$key%' OR 
                    product.name LIKE '%$key%' OR 
                    product.thumbnail LIKE '%$key%' OR 
                    product.description LIKE '%$key%' OR 
                    product.author LIKE '%$key%' OR 
                    category.CategoryName LIKE '%$key%' OR 
                    product.total_product LIKE '%$key%' OR 
                    product.price LIKE '%$key%' OR 
                    nha_xuat_ban.ten_nha_xuat_ban LIKE '%$key%' OR 
                    product.created_at LIKE '%$key%' OR 
                    product.created_by LIKE '%$key%'";
            $result = $this->db->select($query);
            return $result;
        }
        
        

        public function insert_product($name, $thumbnail, $description,	$author, $category_name, $total_product, $price, $namenxb){
            $currentDateTime = date('Y-m-d H:i:s');
            $createBy = "admin";
            $category_id = $this->getCategoryIdByName($category_name);
            $NXB = $this->getNXBIdByName($namenxb);
            $query = "INSERT INTO product (name, thumbnail, description, author, category_id, total_product, price, NXB, created_at, created_by) VALUES ('$name', '$thumbnail', ' $description', '$author', '$category_id', '$total_product', '$price', '$NXB', '$currentDateTime', '$createBy')";
            $result = $this ->db ->insert($query);
            if ($result) {
                echo '<script>window.location.href = "salary.php";</script>';
            }else{
                echo 'Thêm không thanh công';
            }
            return $result;   
        }
        public function show_product(){
            $query = "SELECT
                        product.id,
                        product.name,
                        product.thumbnail,
                        product.description,
                        product.author,
                        category.CategoryName,
                        product.total_product,
                        product.price,
                        nha_xuat_ban.ten_nha_xuat_ban,
                        product.created_at,
                        product.created_by
                        FROM
                        product
                        INNER JOIN
                        category ON product.category_id = category.CategoryID
                        INNER JOIN
                        nha_xuat_ban ON product.NXB = nha_xuat_ban.id
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_product_cate(){
            $query = "SELECT * FROM category ORDER BY CategoryID";
            $result = $this -> db ->select($query);
            return $result;
        }
        public function show_product_nxb(){
            $query = "SELECT * FROM nha_xuat_ban ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }


        public function get_product($id){
            $query = "SELECT
                        product.id,
                        product.name,
                        product.thumbnail,
                        product.description,
                        product.author,
                        category.CategoryName,
                        product.total_product,
                        product.price,
                        nha_xuat_ban.ten_nha_xuat_ban,
                        product.created_at,
                        product.created_by
                    FROM
                        product
                    INNER JOIN
                        category ON product.category_id = category.CategoryID
                        INNER JOIN
                        nha_xuat_ban ON product.NXB = nha_xuat_ban.id
                    WHERE
                        product.id = '$id'";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function update_product($name, $thumbnail, $description,	$author, $category_name, $total_product, $price, $namenxb, $id) {
            $currentDateTime = date('Y-m-d H:i:s');
            $createBy = "admin";
            $category_id = $this->getCategoryIdByName($category_name);
            $NXB = $this->getNXBIdByName($namenxb);
            $query = "UPDATE product SET name = '$name', thumbnail ='$thumbnail', description= '$description', author= '$author', category_id= '$category_id', total_product= '$total_product', price= '$price', NXB='$NXB',	update_at='$currentDateTime', update_by='$createBy' WHERE id = '$id'";
            $result = $this ->db ->update($query);
            if ($result) {
                echo '<script>window.location.href = "salary.php";</script>';
            }
            return $result;
        }
        public function delete_product($id){
            $query = "DELETE  FROM product WHERE id = '$id'";
            $result = $this -> db ->delete($query);
            if ($result) {
                echo '<script>window.location.href = "salary.php";</script>';
            }
            return $result;
        }

        public function getCategoryIdByName($category_name){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT CategoryID FROM category WHERE CategoryName = '$category_name'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Lấy một dòng dữ liệu
                return $row['CategoryID']; // Trả về ID nếu tìm thấy thể loại
            } else {
                return null; // Trả về null nếu không tìm thấy thể loại
            }
        }
        public function getNXBIdByName($ten_nha_xuat_ban){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM nha_xuat_ban WHERE ten_nha_xuat_ban = '$ten_nha_xuat_ban'";
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