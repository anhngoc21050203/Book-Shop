<?php
    include 'lib/database.php';
?>

<?php
    class category{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }
        public function search_category($key) {
            $query = "SELECT * FROM category WHERE 
                      CategoryName LIKE '%$key%' OR
                      CategoryCode LIKE '%$key%'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_cartegory($categoryName, $categoryCode){
            $currentDateTime = date('Y-m-d');
            $createBy = "admin";
            $query = "INSERT INTO category (CategoryName, CategoryCode, createddate, createdby) VALUES ('$categoryName', '$categoryCode','$currentDateTime', '$createBy')";
            $result = $this ->db ->insert($query);
            if ($result) {
                echo '<script>window.location.href = "category.php";</script>';
            }
            return $result;   
        }

        public function show_cartegory(){
            $query = "SELECT * FROM category ORDER BY CategoryID ASC";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function get_cartegory($categoryID){
            $query = "SELECT * FROM category WHERE CategoryID = '$categoryID'";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function update_cartegory($categoryName, $categoryCode, $categoryID) {
            $query = "UPDATE category SET CategoryName = '$categoryName', CategoryCode = '$categoryCode' WHERE CategoryID = '$categoryID'";
            $result = $this ->db ->update($query);
            if ($result) {
                echo '<script>window.location.href = "category.php";</script>';
            }
            return $result;
        }
        public function delete_cartegory($id){
            $query = "DELETE  FROM category WHERE CategoryID = '$id'";
            $result = $this -> db ->delete($query);
            if ($result) {
                echo '<script>window.location.href = "category.php";</script>';
            }
            return $result;
        }
    }
?>