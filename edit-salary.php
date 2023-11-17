<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'com.qlnhasach.dao/sach_class.php';
    $sachModel = new sach();
    $sach_cate = $sachModel->show_product_cate();
    $sach_nxb = $sachModel->show_product_nxb();

    if(isset($_GET['id'])){
        $sachid = $_GET['id'];
    }
    $sachedit=$sachModel->get_product($sachid);
    if($sachedit){
        $result = $sachedit ->fetch_assoc();
    }else {
        // Khởi tạo biến $result với giá trị mặc định nếu không có dữ liệu
        $result = [
            'name' => '',
            'thumbnail' => '',
            'description' => '',
            'author' => '',
            'category_name' => '',
            'total_product' => '',
            'price' => '',
            'NXB' => '',
            'id' =>''
        ];
    }
    if(isset($_POST['update_sach'])){
        $name = $_POST['name'];
        $thumbnail = $_POST['thumbnail'];
        $description = $_POST['description'];
        $author = $_POST['author'];
        $category_name = $_POST['category_name'];
        $total_product = $_POST['total_product'];
        $price = $_POST['price'];
        $NXB = $_POST['namenxb'];
        $id=$_POST['id'];
        $thumbnail = $_FILES['thumbnail']['name'];
        $target_directory = "upload/"; // Thư mục lưu trữ ảnh
        $target_file = $target_directory . basename($thumbnail);

    // Kiểm tra xem tệp đã tồn tại chưa
    if (file_exists($target_file)) {
        echo "Tệp đã tồn tại.";
    } else {
        // Di chuyển ảnh vào thư mục lưu trữ
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_file)) {
            echo "Ảnh đã được tải lên thành công.";
        } else {
            echo "Có lỗi khi tải lên ảnh.";
        }
    }
        $update_sach = $sachModel->update_product($name, $thumbnail, $description,	$author, $category_name, $total_product, $price, $NXB, $id);
    }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Sửa thông tin sách</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="edit-salary.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên sách</label>
                                        <input class="form-control" type="text" name="name" value="<?php echo $result['name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tác giả</label>
                                        <input class="form-control" type="text" name="author" value="<?php echo $result['author']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input class="form-control" type="text" name="price" value="<?php echo $result['price']; ?>">
                                    </div>
                                    <div class="form-group form-focus select-focus">
                                        <label>Thể loại</label>
                                            <select class="select floating" name="category_name">
                                                <?php
                                                    if ($sach_cate) {
                                                        foreach ($sach_cate as $category) {
                                                            $selected = ($category['CategoryName'] == $result['CategoryName']) ? 'selected' : '';
                                                            echo '<option value="' .$category['CategoryName'] . '" ' . $selected . '>' . $category['CategoryName'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tổng số sách</label>
                                        <input class="form-control" type="text" name="total_product" value="<?php echo $result['total_product']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nhà xuất bản</label>
                                        <select class="select floating" name="namenxb">
                                                <?php
                                                    if ($sach_nxb) {
                                                        foreach ($sach_nxb as $nxb) {
                                                            $selected = ($nxb['ten_nha_xuat_ban'] == $result['ten_nha_xuat_ban']) ? 'selected' : '';
                                                            echo '<option value="' .$nxb['ten_nha_xuat_ban'] . '" ' . $selected . '>' . $nxb['ten_nha_xuat_ban'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh bìa</label>
                                        <input class="form-control" type="file" name="thumbnail" id="thumbnailInput" onchange="displayImage()">
                                        <img id="thumbnailPreview" src="" style="max-width: 100%; max-height: 200px; margin-top: 10px;" alt="Ảnh mới">
                                        <img style="max-width: 100%; max-height: 200px; margin-top: 10px;" src="./upload/<?php echo $result['thumbnail']; ?>" alt="Ảnh cũ">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-12">
                                <div class="form-group">
                                        <label>Mô tả ngắn</label>
                                        <div class="form-group">
                                            <textarea style="height: 300px; width: 820px;" class="form-control" id="description" name="description"><?php echo $result['description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="update_sach">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">D</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Domenic Houston </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">B</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Buster Wigton </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Rolland Webber </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Claire Mapes </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Melita Faucher</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">L</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Loren Gatlin</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Tarah Shropshire</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/js_begin.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- edit-salary24:08-->
</html>
