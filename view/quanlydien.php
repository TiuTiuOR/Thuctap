<?php
if(isset($_GET['size'])){
    $erro_size = $_GET['size'];
    if($erro_size <= 0 ){
        header('location: ../controller/tiendien.php?act=quanlydien&p=1&size=5');
    }
}
?>
<?php
if(isset($_GET['p'])){
    $erro_page = $_GET['p'];
    if($erro_page <= 0 ){
        header('location: ../controller/tiendien.php?act=quanlydien&p=1&size=5');
    }
}
?>
<link rel="stylesheet" href="../assets/css/quanlydien.css">
<button><a href="../controller/tiendien.php?act=quanly">Quay lại</a></button>

<h2>Thông tin khách hàng</h2>
<?php 
        if (isset($data)) {
            if ($data && !empty($data)){
    ?>
<?php
    $listsPerPage = isset($_GET['size']) ? (int)$_GET['size'] : 5;
    $currentPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;
    $startIndex = ($currentPage - 1) * $listsPerPage; // tính sl kh ở mỗi trang và trang htai
    $filteredCustomers = array_filter($data['khachhang'], function ($khachhang) {
        return isset($khachhang['makh']);
    });
    // xếp mảng giảm dần theo mã
    usort($filteredCustomers, function($a, $b) {
        return $b['makh'] <=> $a['makh'];
    });
    // lấy sl dữ liệu của khách hàng
    $totalCustomers = count($filteredCustomers);
    // tính trang
    $totalPages = ceil($totalCustomers / $listsPerPage);
    // hiện dl cho trang hiện tại
    $listsToShow = array_slice($filteredCustomers, $startIndex, $listsPerPage);
    ?>
    <table>
        <tr>
            <th>Mã KH</th>
            <th>Tên KH</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>CMND</th>
            <th>Xem điện kế</th>
        </tr>
        <?php
        foreach($listsToShow as $khachhang) {
            echo "<tr>
                    <td>".$khachhang['makh']."</td>
                    <td>".$khachhang['tenkh']."</td>
                    <td>".$khachhang['diachi']."</td>
                    <td>".$khachhang['dt']."</td>
                    <td>".$khachhang['cccd']."</td>
                    <td><button id='button_".$khachhang['makh']."' onclick=\"showDienKe(".$khachhang['makh'].")\">Xem</button></td>
                    </tr>";
            echo "<tr id='dienke_row_".$khachhang['makh']."' style='display: none;'>
                    <td colspan='6'>
                        <div id='dienke_container_".$khachhang['makh']."'>";
            if(isset($khachhang['dienke']) && !empty($khachhang['dienke'])) {
                echo "<h2>Thông tin điện kế Mã khách hàng: ".$khachhang['makh']."</h2>
                    <form id='hoadon' method='post' action='../controller/tiendien.php?act=tinhdien' onsubmit='return kiemTraChon()'> 
                        <table id='dienke_table_".$khachhang['makh']."'>
                            <tr>
                                <th>Mã ĐK</th>
                                <th>Mã KH</th>
                                <th>Ngày sản xuất</th>
                                <th>Ngày lắp</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Chọn để lập hóa đơn</th>
                            </tr>";
                foreach($khachhang['dienke'] as $dienke) {
                    echo "<tr>
                        <td>".$dienke['madk']."</td>
                        <td>".$dienke['makh']."</td>
                        <td>".$dienke['ngaysx']."</td>
                        <td>".$dienke['ngaylap']."</td>
                        <td>".$dienke['mota']."</td>";
                        if($dienke['trangthai'] == 1){
                            $status_dk = "Còn sử dụng";
                            echo "<td>".$status_dk."</td>
                            <td><input type='radio' name='selected_id' />
                            <input type='hidden' name='selected_iddk' value='".$dienke['madk']."'/>
                            </td>";
                        }else{
                            $status_dk = "Đã ngừng sử dụng";
                            echo "<td>".$status_dk."</td>
                            <td>Không thể lập hóa đơn cho điện kế này</td>";
                        }
                        echo "
                        </tr>
                        ";
                    }
                echo "</table>
                        <input type='submit' name='submit_button' id='submit_button' value='Lập hóa đơn'>
                        </form>";
            }else{
                echo "Khách hàng này chưa có điện kế";
            }
            echo "</div>
                </td>
                </tr>";
        }
        ?>
    </table>
    <?php
    // hiện các liên kết phân trang
    if ($totalPages > 1) {
        echo '<div></div>
                <div>';
        if ($currentPage > 1) {
            echo '<a href="?act=quanlydien&p=' . ($currentPage - 1) . '&size=' . $listsPerPage . '">&lt;</a>';
        }
        // Tính & hiện các liên kết phân trang
        $start = max(1, $currentPage - 1);
        $end = min($totalPages, $start + 3);
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $currentPage) {
                echo '<span >' . $i . '</span>';
            } else {
                echo '<a href="?act=quanlydien&p=' . $i . '&size=' . $listsPerPage . '">' . $i . '</a>';
            }
        }
        if ($currentPage < $totalPages) {
            echo '<a href="?act=quanlydien&p=' . ($currentPage + 1) . '&size=' . $listsPerPage . '">&gt;</a>';
        }
        echo '</div>';
    }

?>
<?php
            }else{
                echo 'Không có khách hàng - điện kế nào';
            }
        }
?>

<script src="../assets/js/dienkekh.js"></script>
