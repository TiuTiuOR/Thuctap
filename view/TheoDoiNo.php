<link rel="stylesheet" href="../assets/css/theodoino.css">

<h2>Danh Sách Hóa Đơn Chưa Thanh Toán</h2>
<button onclick="openModal()">Xem Tổng Quan</button>
<div id="myModal" class="modal">
  <!-- Nội dung của modal -->
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h3>Tổng Quan</h3>
    <p>Số lượng hóa đơn chưa thanh toán: <?php echo count($user_unpaid); ?></p>
  </div>
</div>
<?php

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $ngayHienTai = new DateTime();

    if(isset($user_unpaid)){
        if($user_unpaid && !empty($user_unpaid)){     
            echo '<table border="1">';
            echo '<tr>';
            echo '<th>Mã khách hàng</th>';
            echo '<th>Tên khách hàng</th>';
            echo '<th>Địa chỉ</th>';
            echo '<th>Số điện thoại</th>';
            echo '<th>CCCD</th>';
            echo '<th>Mã hóa đơn</th>';
            echo '<th>Kỳ</th>';
            echo '<th>Tình trạng hóa đơn</th>';
            echo '<th>Mã điện kế</th>';
            echo '<th>Trạng thái điện kế</th>';
            echo '<th>Tiền điện</th>';
            echo '<th>Tiền thuế</th>';
            echo '<th>Tiền phải thanh toán</th>';
            echo '<th>Thông tin</th>';
            echo '</tr>';

            foreach($user_unpaid as $rows){
                $timestamp = strtotime($rows['ngaylaphd']);
                $current_time = time();
                $time_difference = $current_time - $timestamp;
                $seconds = $time_difference;
                $minutes = round($seconds / 60);           // value 60 is seconds tương ứng 1p
                $hours = round($seconds / 3600);           // value 3600 is 60 minutes * 60 sec tương ứng 1h
                $days = round($seconds / 86400);          // value 86400 is 24 hours * 60 minutes * 60 sec tương ứng 1 ngày
                $weeks = round($seconds / 604800);         // value 604800 is 7 days * 24 hours * 60 minutes * 60 sec tương ứng 1 tuần
                $months = round($seconds / 2629440);       // value 2629440 is ((365+365+365+365+366)/5/12) days * 24 hours * 60 minutes * 60 sec tương ứng 1 tháng
                $years = round($seconds / 31553280);       // value 31553280 is ((365+365+365+365+366)/5) days * 24 hours * 60 minutes * 60 sec tương ứng 1 năm

                if ($seconds <= 60) {
                    $output = "<span style='color: green;'>vài giây trước</span>";
                } elseif ($minutes <= 60) {
                    $output = "<span style='color: green;'>$minutes phút trước</span>";
                } elseif ($hours <= 24) {
                    $output = "<span style='color: green;'>$hours giờ trước</span>";
                } elseif ($days <= 7) {
                    $output = "<span style='color: green;'>$days ngày trước</span>";
                } elseif ($weeks <= 4.3) {  // 4.3 tuần gần bằng 1 tháng
                    $output = "<span style='color: blue;'>$weeks tuần trước</span>";
                } elseif ($months <= 12) {
                    $output = "<span style='color: red;'>$months tháng trước</span>";
                } else {
                    $output = "<span style='color: red;'>$years năm trước</span>";
                }

                echo '<tr>';
                echo '<td>' . $rows['makh'] . '</td>';
                echo '<td>' . $rows['tenkh'] . '</td>';
                echo '<td>' . $rows['diachi'] . '</td>';
                echo '<td>' . $rows['dt'] . '</td>';
                echo '<td>' . $rows['cccd'] . '</td>';
                echo '<td>' . $rows['mahd'] . '</td>';
                echo '<td>' . $rows['ky'] . '</td>';
                if($rows['tinhtrang'] == 0){
                    echo '<td>Chưa thanh toán</td>';
                }else{
                    echo '<td></td>';
                }
                echo '<td>' . $rows['madk'] . '</td>';
                if($rows['trangthai'] == 0){
                    echo '<td>Không còn sử dụng</td>';
                }else{
                    echo '<td>Còn sử dụng</td>';
                }
                echo '<td>' . $rows['tongtiendien'] . '</td>';
                echo '<td>' . $rows['tienthue'] . '</td>';
                echo '<td>' . $rows['tongthanhtien'] . '</td>';
                //chuyển chuỗi tgian sang dạng datetime
                $ngayLapHD = DateTime::createFromFormat('Y-m-d H:i:s', $rows['ngaylaphd']);
               // Kiểm tra xem ngày lập hóa đơn có hợp lệ không trước khi sử dụng diff()
               if ($ngayLapHD instanceof DateTime) {
                   // Tính toán số ngày từ ngày lập hóa đơn đến ngày hiện tại
                   $soNgay = $ngayLapHD->diff($ngayHienTai)->days;
                   echo '<td>Thời gian tạo hóa đơn: '.$output.' - ' .$soNgay. ' ngày chưa thanh toán</td>';
               } else {
                   echo '<td>Ngày không hợp lệ</td>';
               }

                echo '</tr>';
            }

            echo '</table>';
        }
    }
?>
<script>
    var modal = document.getElementById("myModal");
    function openModal() {
        modal.style.display = "block";
    }
    // nhấn x đóng modal
    function closeModal() {
        modal.style.display = "none";
    }
    // nhấp vùng ngoài modal -> đóng
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>