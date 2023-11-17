<?php
    include 'lib/database.php';
?>

<?php
    class nxb{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }
        public function search_nha_xuat_ban($key) {
            $query = "SELECT * FROM nha_xuat_ban WHERE 
                ten_nha_xuat_ban LIKE '%$key%' OR 
                dia_chi LIKE '%$key%' OR 
                so_dien_thoai LIKE '%$key'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insert_nha_xuat_ban($ten_nha_xuat_ban, $dia_chi, $so_dien_thoai, $createdby){
            $currentDateTime = date('Y-m-d H:i:s');
            $query = "INSERT INTO nha_xuat_ban (ten_nha_xuat_ban, dia_chi, so_dien_thoai, createddate, createdby) VALUES ('$ten_nha_xuat_ban', '$dia_chi', ' $so_dien_thoai', ' $currentDateTime', ' $createdby')";
            $result = $this ->db ->insert($query);
            if ($result) {
                echo '<script>window.location.href = "nxb.php";</script>';
            }else{
                echo 'Thêm không thanh công';
            }
            return $result;   
        }
        public function show_nha_xuat_ban(){
            $query = "SELECT * FROM nha_xuat_ban";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function get_nha_xuat_ban($id){
            $query = "SELECT * FROM nha_xuat_ban WHERE id = '$id'";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function update_nha_xuat_ban($ten_nha_xuat_ban, $dia_chi, $so_dien_thoai, $updatedby, $id) {
            $currentDateTime = date('Y-m-d H:i:s');
            $query = "UPDATE nha_xuat_ban SET ten_nha_xuat_ban = '$ten_nha_xuat_ban', dia_chi ='$dia_chi', so_dien_thoai= '$so_dien_thoai', updateddate= '$currentDateTime', updatedby= '$updatedby' WHERE id = '$id'";
            $result = $this ->db ->update($query);
            if ($result) {
                echo '<script>window.location.href = "nxb.php";</script>';
            }
            return $result;
        }
        public function delete_nha_xuat_ban($id){
            $query = "DELETE  FROM nha_xuat_ban WHERE id = '$id'";
            $result = $this -> db ->delete($query);
            if ($result) {
                echo '<script>window.location.href = "nxb.php";</script>';
            }
            return $result;
        }
    }
?>