<?php
// Include các file cần thiết
include_once "../model/KhachHang.php";
include_once "../model/KhachHang_Model.php";

// Kiểm tra xem mã khách hàng có được truyền từ URL không
if (isset($_GET['makh'])) {
    // Lấy mã khách hàng từ URL
    $makh = $_GET['makh'];
    
    // Gọi hàm để lấy thông tin của khách hàng từ mã khách hàng
    $khachhang_info = searchIDKH($makh);
    
    // Kiểm tra xem khách hàng có tồn tại hay không
    if ($khachhang_info) {
        // Chuyển hướng người dùng đến trang view sửa thông tin
        header("Location: ../view/sua.php?makh=" . $makh);
        exit(); // Đảm bảo kết thúc luồng xử lý sau khi chuyển hướng
    } else {
        // Hiển thị thông báo nếu không tìm thấy thông tin khách hàng
        echo "Không tìm thấy thông tin khách hàng.";
    }
}
?>
