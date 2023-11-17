<?php
    include 'lib/database.php';
?>

<?php
    class fb{

        private $db;

        public function __construct(){
            $this ->db = new Database();
        }

        public function update_fb($id, $reply) {
            $query = "UPDATE feedback SET reply_fb = '$reply' WHERE id = '$id'";
            $result = $this ->db ->update($query);
            if ($result) {
                echo '<script>window.location.href = "blog.php";</script>';
            }
            return $result;
        }

        public function show_fb(){
            $query = "SELECT feedback.*, nguoidung.username, product.name, product.thumbnail FROM feedback
            INNER JOIN product ON feedback.product_id = product.id
            INNER JOIN nguoidung ON feedback.user_id = nguoidung.id
            ORDER BY feedback.id";
            $result = $this -> db ->select($query);
            return $result;
        }

    }
?>