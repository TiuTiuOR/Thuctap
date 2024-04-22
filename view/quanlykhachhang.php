<!DOCTYPE html>
<html>

<head>
    <title>Quản lý khách hàng</title>
</head>

<body>
    <?php
    if (isset($search_KH)) {
        if ($search_KH && !empty($search_KH)) {
            echo 'Tìm thấy khách hàng có mã: ' . $makh;

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
            echo 'Tìm thấy các khách hàng có tên: ' . $tenkh;
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



    <h1>Danh sách khách hàng</h1>
    <table border='1'>
        <tr>
            <th>Mã KH</th>
            <th>Tên KH</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>CCCD</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($khachhangs as $khachhang): ?>
            <tr>
                <td><?php echo $khachhang['makh']; ?></td>
                <td><?php echo $khachhang['tenkh']; ?></td>
                <td><?php echo $khachhang['diachi']; ?></td>
                <td><?php echo $khachhang['dt']; ?></td>
                <td><?php echo $khachhang['cccd']; ?></td>
                <td>
                    <a href="../controller/sua.php?makh=<?php echo $khachhang['makh']; ?>">Sửa</a>

                    <a href="xoa.php?makh=<?php echo $khachhang['makh']; ?>">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <h2>Thêm khách hàng</h2>
    <!-- Form để thêm khách hàng -->
    <form action="add.php" method="post">
        Mã KH: <input type="text" name="makh"><br>
        Tên KH: <input type="text" name="tenkh"><br>
        Địa chỉ: <input type="text" name="diachi"><br>
        Điện thoại: <input type="text" name="dt"><br>
        CCCD: <input type="text" name="cccd"><br>
        <input type="submit" value="Thêm">
    </form>
    <br>

</body>
<script src="../assets/js/dienkekh.js"></script>
<script src="../assets/js/timkhachhang.js"></script>

</html>