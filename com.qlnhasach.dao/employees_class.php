<?php
    include 'lib/database.php';
?>
<?php
    class employess{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function insert_nguoidung($username, $fullname, $email, $phone_number, $address, $password, $role_name, $status){
            $role_id = $this->getCategoryIdByName($role_name);
            $query = "INSERT INTO nguoidung (username, fullname, email, phone_number, address, password, role_id, status) VALUES ('$username', '$fullname', ' $email', '$phone_number', '$address', '$password', '$role_id', '$status')";
            $result = $this ->db ->insert($query);
            if ($result) {
                echo '<script>window.location.href = "employees.php";</script>';
            }else{
                echo 'Thêm không thanh công';
            }
            return $result;   
        }
        public function show_nguoidung_2(){
            $query = "SELECT
                        nguoidung.id,
                        nguoidung.username,
                        nguoidung.fullname,
                        nguoidung.email,
                        nguoidung.phone_number,
                        nguoidung.address,
                        nguoidung.password,
                        role.name,
                        nguoidung.status
                        FROM
                        nguoidung
                        INNER JOIN
                        role ON nguoidung.role_id = role.id
                        WHERE 
                        role_id = '2'
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }
        public function show_nguoidung_1(){
            $query = "SELECT
                        nguoidung.id,
                        nguoidung.username,
                        nguoidung.fullname,
                        nguoidung.email,
                        nguoidung.phone_number,
                        nguoidung.address,
                        nguoidung.password,
                        role.name,
                        nguoidung.status
                        FROM
                        nguoidung
                        INNER JOIN
                        role ON nguoidung.role_id = role.id
                        WHERE 
                        role_id = '1' OR role_id = '3' 
                    ";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function show_nguoidung_role(){
            $query = "SELECT * FROM role ORDER BY id";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function get_nguoidung($id){
            $query = "SELECT
                        nguoidung.id,
                        nguoidung.username,
                        nguoidung.fullname,
                        nguoidung.email,
                        nguoidung.phone_number,
                        nguoidung.address,
                        nguoidung.password,
                        role.name,
                        nguoidung.status
                        FROM
                        nguoidung
                        INNER JOIN
                        role ON nguoidung.role_id = role.id
                    WHERE
                        nguoidung.id = '$id'";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function update_nguoidung($username, $fullname, $email, $phone_number, $address, $password, $role_name, $status, $id) {
            $role_id = $this->getCategoryIdByName($role_name);
            $query = "UPDATE nguoidung SET username = '$username', fullname ='$fullname', email= '$email', phone_number= '$phone_number', address= '$address', password= '$password', role_id= '$role_id', status='$status' WHERE id = '$id'";
            $result = $this ->db ->update($query);
            if ($result) {
                echo '<script>window.location.href = "employees.php";</script>';
            }
            return $result;
        }
        public function delete_nguoidung($id){
            $query = "DELETE  FROM nguoidung WHERE id = '$id'";
            $result = $this -> db ->delete($query);
            if ($result) {
                echo '<script>window.location.href = "employees.php";</script>';
            }
            return $result;
        }
        public function login($username, $password){
            $query = "SELECT * FROM nguoidung WHERE username = '$username' AND password = '$password'";
            $result = $this -> db ->select($query);
            return $result;
        }

        public function register($username, $fullname, $email, $phone_number, $address, $password){
            $role_id = 2;
            $status = 1;
            $query = "INSERT INTO nguoidung (username, fullname, email, phone_number, address, password, role_id, status) VALUES ('$username', '$fullname', ' $email', '$phone_number', '$address', '$password', '$role_id', '$status')";
            $result = $this ->db ->insert($query);
            return $result;
        }

        public function getCategoryIdByName($role_name){
            // Thực hiện truy vấn SQL để lấy ID thể loại dựa trên tên thể loại
            $query = "SELECT id FROM role WHERE name = '$role_name'";
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
