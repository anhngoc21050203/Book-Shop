<?php
    include 'pages/header.php';
    include 'pages/menu.php';
    require_once 'phanq/pq.php';
    include 'connection.php';
    include 'com.qlnhasach.dao/orders.php';
    $sach_Model = new orders();
    $sach_list = $sach_Model->show_orders();
?>
        
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
							<span class="dash-widget-bg1"><img src="assets/img/social-media.png"></span>
							<div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE status >= 2 AND status < 6";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['total_orders'];
                                    echo "<h3>$totalOrders</h3>";
                                   }
                                ?>
								<span class="widget-title1">Lượt Mua <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><img src="assets/img/click.png"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT SUM(num) AS total_sum 
                                   FROM order_details  od
                                    INNER JOIN orders o ON od.order_id = o.id
                                    WHERE o.status >= 2 AND o.status <6;";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['total_sum'];
                                    echo "<h3>$totalOrders</h3>";
                                   }
                                ?>
                                <span class="widget-title2">Số lượng sách bán<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg7"><img src="assets/img/warehouse.png"></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT SUM(total_product) AS sum FROM product";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['sum'];
                                    echo "<h3>$totalOrders</h3>";
                                   }
                                ?>
                                <span class="widget-title7">Tổng tồn kho<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><img src="assets/img/cargo.png"></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT SUM(total_product) AS sum FROM input_history";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['sum'];
                                    echo "<h3>$totalOrders</h3>";
                                   }
                                ?>
                                <span class="widget-title3">Sách nhập vào <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><img src="assets/img/output.png"></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT SUM(total_product) AS sum FROM output_history";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['sum'];
                                    echo "<h3>$totalOrders</h3>";
                                   }
                                ?>
                                <span class="widget-title4">Sách xuất ra<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg6"><img src="assets/img/financial-statement.png"></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT SUM(total) AS sum FROM orders WHERE status >= 2 AND status <= 5";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['sum'];
                                    echo "<h3>$totalOrders đ</h3>";
                                   }
                                ?>
                                <span class="widget-title6">Doanh thu định tính<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg5"><img src="assets/img/salary.png"></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT SUM(total) AS sum FROM orders WHERE status = 5";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['sum'];
                                    echo "<h3>$totalOrders đ</h3>";
                                   }
                                ?>
                                <span class="widget-title5">Doanh thu đã tính<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg8"><img src="assets/img/close.png"></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                   $sql = "SELECT COUNT(*) AS sum FROM orders WHERE status = 6";
                                   $rs = $conn->query($sql);
                                   if ($rs->num_rows > 0) {
                                    $row = $rs->fetch_assoc();
                                    $totalOrders = $row['sum'];
                                    echo "<h3>$totalOrders</h3>";
                                   }
                                ?>
                                <span class="widget-title8">Đơn hàng hủy<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Tổng số người dùng</h4>
									<span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
								</div>	
								<canvas id="linegraph"></canvas>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Người đã mua</h4>
									<div class="float-right">
										<ul class="chat-user-total">
											<li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
											<li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
										</ul>
									</div>
								</div>	
								<canvas id="bargraph"></canvas>
							</div>
						</div>
					</div>
				</div>

                -->
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Đơn hàng chưa xác nhận </h4> <a href="invoices.php" class="btn btn-primary float-right">Xem tất cả</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<tbody>
                                        <?php
                                            if ($sach_list) {
                                                foreach ($sach_list as $sach) {
                                                    if ($sach['status'] == 1){
                                                        echo'
                                                        <tr>
                                                            <td>'.$sach['order_code'].'</td>
                                                            <td>'.$sach['order_date'].'</td>
                                                            <td><button class="btn btn-primary btn-primary-one float-right">Đang xử lý</button></td>
                                                        </tr>   
                                                        ';
                                                    }
                                                }
                                            }
                                        ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
                    <!--
					<div class="col-12 col-md-6 col-lg-4 col-xl-4">
						<div class="hospital-barchart">
							<h4 class="card-title d-inline-block">Quản lý nhà sách</h4>
						</div>
						<div class="bar-chart">
							<div class="legend">
								<div class="item">
									<h4>Level1</h4>
								</div>
								
								<div class="item">
									<h4>Level2</h4>
								</div>
								<div class="item text-right">
									<h4>Level3</h4>
								</div>
								<div class="item text-right">
									<h4>Level4</h4>
								</div>
							</div>
							<div class="chart clearfix">
								<div class="item">
									<div class="bar">
										<span class="percent">16%</span>
										<div class="item-progress" data-percent="16">
											<span class="title">OPD Patient</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">71%</span>
										<div class="item-progress" data-percent="71">
											<span class="title">New Patient</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">82%</span>
										<div class="item-progress" data-percent="82">
											<span class="title">Laboratory Test</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">67%</span>
										<div class="item-progress" data-percent="67">
											<span class="title">Treatment</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="bar">
										<span class="percent">30%</span>									
										<div class="item-progress" data-percent="30">
											<span class="title">Discharge</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					 </div>
                                -->
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
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>

</body>



</html>