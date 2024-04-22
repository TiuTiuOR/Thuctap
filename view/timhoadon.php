<div>
    <h2>Tìm kiếm hóa đơn</h2>
    <form action="" method="post">
        <label for="mahd">Mã hóa đơn:</label>
        <input type="text" id="mahd" name="mahd" placeholder="Nhập mã hóa đơn...">
        <input type="submit" name="SearchDH" value="Tìm kiếm">
    </form>
</div>
<?php
    if (isset($search_DH)) {
        if ($search_DH && !empty($search_DH)){
          echo ' <table border="1">
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Mã nhân viên</th>
                        <th>Kỳ</th>
                        <th>Từ ngày</th>
                        <th>Đến ngày</th>
                        <th>Chỉ số đầu</th>
                        <th>Chỉ số cuối</th>
                        <th>Tổng thành tiền</th>
                        <th>Ngày lập hóa đơn</th>
                        <th>Tình trạng</th>
                        <th>Chi tiết</th>
                        <th colspan=2>Công cụ</th>
                    </tr>
                    <tr>
                        <td>'. $search_DH['mahd'] .'</td>
                        <td>'. $search_DH['manv'] .'</td>
                        <td>'. $search_DH['ky'] .'</td>
                        <td>'. $search_DH['tungay'] .'</td>
                        <td>'. $search_DH['denngay'] .'</td>
                        <td>'. $search_DH['chisodau'] .'</td>
                        <td>'. $search_DH['chisocuoi'] .'</td>
                        <td>'. $search_DH['tongthanhtien'].'</td>
                        <td>'. $search_DH['ngaylaphd'] .'</td>';
                        if($search_DH['tinhtrang'] == 0){
                            echo '<td>Chưa thanh toán</td>';
                            echo '<td><a href="../controller/tracuu.php?act=cthd&mahd='.$search_DH['mahd'].'">Xem chi tiết hóa đơn</a></td>';
                            echo '<td><a href="../controller/tiendien.php?act=in&mahd='.$search_DH['mahd'].'">In giấy báo điện</a></td>';  
                            echo '<td><a name="hoanthanh"  href="../controller/tiendien.php?act=tinhdien&action=dathanhtoan&code=' . $search_DH['mahd'] . '">Đã thanh toán</a> </td>';
                        }else{ 
                            echo '<td>Đã thanh toán</td>';
                            echo '<td><a href="../controller/tracuu.php?act=cthd&mahd='.$search_DH['mahd'].'">Xem chi tiết hóa đơn</a></td>';
                            echo '<td><a href="../controller/tiendien.php?act=in&mahd='.$search_DH['mahd'].'">In hóa đơn</a> </td>'; 
                            }                    
                    echo '</tr> 
                </table';
        }else{
            echo "Không tìm thấy hóa đơn trong CSDL.";
        }
    }else{
        echo '';
    }
?>
<br>
<button><a href="../controller/tiendien.php?act=quanly">Thoát</a></button>
