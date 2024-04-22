<?php 
    if(isset($_SESSION['id_nv'])){
?>
<b>Xin chào, <?php echo $_SESSION['name'] ?> </b> <button><a href="../controller/nhanvien.php?act=logout">Đăng xuất</a></button>

<h2><b>MÀN HÌNH QUẢN LÝ </b></h2>
<a href="../controller/tiendien.php?act=quanlydien">Quản lý điện</a><br>
<a href="../controller/giadien.php?act=themgiadien">Quản lý giá điện</a><br>
<a href="../controller/dienke.php?act=quanlydienke">Quản lý điện kế</a><br>
<a href="../controller/khachhang.php?act=quanlykhachhang">Quản lý khách hàng</a><br>
<a href="../controller/tracuu.php?act=tracuu">Tra cứu</a>


<?php }else{
    header('location: ../controller/nhanvien.php?act=login');
} ?>