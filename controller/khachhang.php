<?php
require_once('../model/KhachHang_Model.php');
include_once('../model/KhachHang.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchCustomer"])) {
    require_once('../model/KhachHang.php');
    if ($_POST["searchKH"] == 0) {
        $makh = $_POST["makh"];
        $search_KH = searchIDKH($makh);
    } else {
        $tenkh = $_POST["nameKH"];
        $search_KH_by_Name = searchNameKH($tenkh);
    }
}
// Gọi view để hiển thị kết quả
require_once('../view/timkhachhang.php');
class KhachHang_Controller {
    private $model;
    
    public function __construct() {
        $this->model = new KhachHang_Model();
    }
    
    public function index() {
        $khachhangs = $this->model->getAllKhachHang();
        include('../view/quanlykhachhang.php');
    }

    public function themKhachHang($makh, $tenkh, $diachi, $dt, $cccd) {
        $this->model->addKhachHang($makh, $tenkh, $diachi, $dt, $cccd);
        header("Location: index.php");
    }

    public function xoaKhachHang($makh) {
        $this->model->deleteKhachHang($makh);
        header("Location: index.php");
    }

    public function suaKhachHang($makh, $tenkh, $diachi, $dt, $cccd) {
        $this->model->updateKhachHang($makh, $tenkh, $diachi, $dt, $cccd);
        header("Location: index.php");
    }
}

$controller = new KhachHang_Controller();

if (isset($_GET['act'])) {
    $action = $_GET['act'];
    switch ($action) {
        case 'add':
            if (isset($_POST['makh'], $_POST['tenkh'], $_POST['diachi'], $_POST['dt'], $_POST['cccd'])) {
                $controller->themKhachHang($_POST['makh'], $_POST['tenkh'], $_POST['diachi'], $_POST['dt'], $_POST['cccd']);
            }
            break;
        case 'delete':
            if (isset($_GET['makh'])) {
                $controller->xoaKhachHang($_GET['makh']);
            }
            break;
        case 'edit':
            // Xử lý sửa khách hàng
            if (isset($_POST['makh'], $_POST['tenkh'], $_POST['diachi'], $_POST['dt'], $_POST['cccd'])) {
                $controller->suaKhachHang($_POST['makh'], $_POST['tenkh'], $_POST['diachi'], $_POST['dt'], $_POST['cccd']);
            }
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
?>
