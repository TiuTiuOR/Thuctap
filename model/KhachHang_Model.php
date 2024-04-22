<?php
require_once('../model/config.php');

class KhachHang_Model {
    public function getAllKhachHang() {
        global $conn;
        $sql = "SELECT * FROM khachhang";
        return pdo_query($sql);
    }
    public function addKhachHang($makh, $tenkh, $diachi, $dt, $cccd) {
        global $conn;
        $sql = "INSERT INTO khachhang (makh, tenkh, diachi, dt, cccd) VALUES (?, ?, ?, ?, ?)";
        pdo_execute($sql, $makh, $tenkh, $diachi, $dt, $cccd);
    }

    public function deleteKhachHang($makh) {
        global $conn;
        $sql = "DELETE FROM khachhang WHERE makh = ?";
        pdo_execute($sql, $makh);
    }

    public function updateKhachHang($makh, $tenkh, $diachi, $dt, $cccd) {
        global $conn;
        $sql = "UPDATE khachhang SET tenkh = ?, diachi = ?, dt = ?, cccd = ? WHERE makh = ?";
        pdo_execute($sql, $tenkh, $diachi, $dt, $cccd, $makh);
    }
}
?>
