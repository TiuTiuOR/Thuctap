<?php
    include_once "../model/config.php"; 
    include_once "../model/DienKeKhachHang.php"; 
    include_once "../model/GiaDien.php"; 
    include_once "../model/HoaDon.php"; 
    include_once "../model/CTHoaDon.php"; 
    include_once "../model/TinhTien.php"; 
    include_once "../model/NhanVien.php"; 

    if (isset($_GET['act'])) {  
        switch ($_GET['act']) {
            case "login":
                session_start();
                if(isset($_POST['dangnhap'])){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $userLogin = checkAcccount($username,$password);
                    if (!empty($username) && !empty($password)) {
                        if ($userLogin && !empty($userLogin)) {
                            foreach ($userLogin as $row) {
                                extract($row);
                                $_SESSION['name'] = $tennv;
                                $_SESSION['username'] = $taikhoan;
                                $_SESSION['id_nv'] = $manv;
                                $_SESSION['password'] = $matkhau;
                            }
                            header("Location: ../controller/tiendien.php?act=quanly");
                            exit;
                        } else {
                            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu.')</script>";
                        }
                    } else {
                        echo "<script>alert('Vui lòng nhập đầy đủ thông tin')</script>";
                    }
                }
                include '../view/login.php';
                break;
            case 'logout':
                include "../view/logout.php";
                break;
            default:
            include "../view/login.php";
            break;
        }
    } else { 
        include "../view/login.php";
    }
?>