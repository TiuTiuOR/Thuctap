<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin khách hàng</title>
</head>
<body>
    <h1>Sửa thông tin khách hàng</h1>
    <form action="../controller/xuly_sua.php" method="post">
        <!-- Các trường thông tin khách hàng cần sửa -->
        <input type="hidden" name="makh" value="<?php echo $makh; ?>"> <!-- Trường ẩn để truyền mã khách hàng -->
        Tên KH: <input type="text" name="tenkh"><br>
        Địa chỉ: <input type="text" name="diachi"><br>
        Điện thoại: <input type="text" name="dt"><br>
        CCCD: <input type="text" name="cccd"><br>
        <input type="submit" value="Lưu">
    </form>
    <!-- Nút quay lại -->
    <a href="javascript:history.back()">Quay lại</a>
</body>
</html>
