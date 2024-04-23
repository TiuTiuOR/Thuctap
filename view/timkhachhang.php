<link rel="stylesheet" href="../assets/css/quanlydien.css">
<div>
    <h2>Tìm kiếm khách hàng</h2>
    <form action="" method="post">
        <div>
            <b>Tìm theo mã</b>
            <input name="searchKH" type="radio" value="0" onclick="chosseSearch_KH();" <?php if (!isset($search_KH_by_Name)) echo "checked"; ?>>
        </div>
        <div>
            <b >Tìm theo tên</b>
            <input name="searchKH" type="radio" value="1" onclick="chosseSearch_KH();" <?php if (isset($search_KH_by_Name)) echo "checked"; ?>>
        </div>

        <div id="search_By_ID" style="display: <?php if (!isset($search_KH_by_Name)) echo "block"; else echo "none"; ?>;">
            <label for="makh">Mã khách hàng:</label>
            <input type="text" id="makh" name="makh" placeholder="Nhập mã khách hàng..." >
        </div>
        <div id="search_By_Name" style="display: <?php if (isset($search_KH_by_Name)) echo "block"; else echo "none"; ?>;">
            <label for="makh">Tên khách hàng:</label>
            <input type="text" id="nameKH" name="nameKH" placeholder="Nhập tên khách hàng...">
        </div>
        <input type="submit" name="searchCustomer" value="Tìm kiếm">
    </form>
</div>


<?php
if (isset($search_KH)) {
    if ($search_KH && !empty($search_KH)) {
        echo 'Tìm thấy khách hàng có mã: '. $makh;

        echo ' <table>
                <tr>
                    <th>Tên KH</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>CMND</th>
                    <th>Xem điện kế</th>
                </tr>';
        foreach ($search_KH['khachhang'] as $rows) {
            echo "<tr>
                    <td>" . $rows['tenkh'] . "</td>
                    <td>" . $rows['diachi'] . "</td>
                    <td>" . $rows['dt'] . "</td>
                    <td>" . $rows['cccd'] . "</td>
                    <td><button id='button_" . $rows['makh'] . "' onclick=\"showDienKe(" . $rows['makh'] . ")\">Xem</button></td>
                    </tr>";
            echo "<tr id='dienke_row_" . $rows['makh'] . "' style='display: none;'>
                    <td colspan='6'>
                        <div id='dienke_container_" . $rows['makh'] . "'>";
            if (isset($rows['dienke'])) {
                echo "<h2>Thông tin điện kế Mã khách hàng: " . $rows['makh'] . "</h2>
                    <form id='hoadon' method='post' action='../controller/tiendien.php?act=tinhdien' onsubmit='return kiemTraChon()'> 
                        <table id='dienke_table_" . $rows['makh'] . "'>
                            <tr>
                                <th>Mã ĐK</th>
                                <th>Mã KH</th>
                                <th>Ngày sản xuất</th>
                                <th>Ngày lắp</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Chọn để lập hóa đơn</th>
                            </tr>";
                foreach ($rows['dienke'] as $dienke) {
                    echo "<tr>
                        <td>" . $dienke['madk'] . "</td>
                        <td>" . $dienke['makh'] . "</td>
                        <td>" . $dienke['ngaysx'] . "</td>
                        <td>" . $dienke['ngaylap'] . "</td>
                        <td>" . $dienke['mota'] . "</td>";
                        if($dienke['trangthai'] == 1){
                            $status_dk = "Còn sử dụng";
                            echo "<td>".$status_dk."</td>
                            <td><input type='radio' name='selected_id' value='".$dienke['madk']."'/>
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
            }
            echo "</div>
                </td>
                </tr>";
        }
        echo '</table>';
    } else {
        echo 'Không tìm thấy khách hàng có mã ' . $makh . ' trong CSDL';
    }

}
?>

<?php
if (isset($search_KH_by_Name)) {
    if ($search_KH_by_Name && !empty($search_KH_by_Name)) {
        echo 'Tìm thấy các khách hàng có tên: '. $tenkh;
        echo ' <table>
                <tr>
                    <th>Tên KH</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>CMND</th>
                    <th>Xem điện kế</th>
                </tr>';
        foreach ($search_KH_by_Name['khachhang'] as $rows) {
            echo "<tr>
                    <td>" . $rows['tenkh'] . "</td>
                    <td>" . $rows['diachi'] . "</td>
                    <td>" . $rows['dt'] . "</td>
                    <td>" . $rows['cccd'] . "</td>
                    <td><button id='button_" . $rows['makh'] . "' onclick=\"showDienKe(" . $rows['makh'] . ")\">Xem</button></td>
                    </tr>";
            echo "<tr id='dienke_row_" . $rows['makh'] . "' style='display: none;'>
                    <td colspan='6'>
                        <div id='dienke_container_" . $rows['makh'] . "'>";
            if (isset($rows['dienke'])) {
                echo "<h2>Thông tin điện kế Mã khách hàng: " . $rows['makh'] . "</h2>
                    <form id='hoadon' method='post' action='../controller/tiendien.php?act=tinhdien' onsubmit='return kiemTraChon()'> 
                        <table id='dienke_table_" . $rows['makh'] . "'>
                            <tr>
                                <th>Mã ĐK</th>
                                <th>Mã KH</th>
                                <th>Ngày sản xuất</th>
                                <th>Ngày lắp</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Chọn để lập hóa đơn</th>
                            </tr>";
                foreach ($rows['dienke'] as $dienke) {
                    echo "<tr>
                        <td>" . $dienke['madk'] . "</td>
                        <td>" . $dienke['makh'] . "</td>
                        <td>" . $dienke['ngaysx'] . "</td>
                        <td>" . $dienke['ngaylap'] . "</td>
                        <td>" . $dienke['mota'] . "</td>";
                        if($dienke['trangthai'] == 1){
                            $status_dk = "Còn sử dụng";
                            echo "<td>".$status_dk."</td>
                            <td><input type='radio' name='selected_id' value='".$dienke['madk']."'/>
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
            }
            echo "</div>
                </td>
                </tr>";
        }
        echo '</table>';
    } else {
        echo 'Không tìm thấy khách hàng có tên ' . $tenkh . ' trong CSDL';
    }

}
?>
<br>
<button><a href="../controller/tiendien.php?act=quanly">Thoát</a></button>

<script src="../assets/js/dienkekh.js"></script>
<script src="../assets/js/timkhachhang.js"></script>

