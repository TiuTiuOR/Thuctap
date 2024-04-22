<?php
    include_once "../model/config.php"; 
    include_once "../model/GiaDien.php"; 

    if (isset($_GET['act'])) {  
        switch ($_GET['act']) {
            case "themgiadien":
                if(isset($_POST['submit'])){
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $ngayapdung = date('Y-m-d H:i:s');
                    foreach($_POST['tenbac'] as $key => $value){
                        $tenbac = $_POST['tenbac'][$key];
                        $tusokw = $_POST['tusokw'][$key];
                        $densokw = $_POST['densokw'][$key];
                        $dongia = $_POST['dongia'][$key];
                        // Kiểm tra nếu trường densokw có giá trị là "Trở lên", gán giá trị null cho biến tương ứng
                        if ($densokw === "Trở lên") {
                            $densokw = null;
                        }
                        themDien($tenbac, $tusokw, $densokw, $dongia, $ngayapdung);
                        echo "<script>alert('Thêm Điện thành công'); window.location.href = '../controller/giadien.php?act=themgiadien';</script>";  
                    }
                }
                include "../view/thembanggiadien.php";
                break;
            //     if (isset($_POST['submit'])) {
            //         date_default_timezone_set('Asia/Ho_Chi_Minh');
            //         $ngayapdung = date('Y-m-d H:i:s');
            
            //         $valid = true; // ktra tính hợp lệ của dữ liệu
            
            //         foreach ($_POST['tenbac'] as $key => $value) {
            //             $tenbac = $_POST['tenbac'][$key];
            //             $tusokw = $_POST['tusokw'][$key];
            //             $densokw = $_POST['densokw'][$key];
            //             $dongia = $_POST['dongia'][$key];
                        
            //             if ($densokw === "Trở lên") {
            //                 $densokw = "9999";
            //             } 
            //             //ko để trống 
            //             if (empty($tenbac) || empty($tusokw) || empty($densokw) || empty($dongia)) {
            //                 $valid = false;
            //                 break; 
            //             }
            //             //phải là số và ko đc để null
            //             if (!is_numeric($tusokw) || $tusokw < 0 || !is_numeric($densokw) || $densokw < 0 || !is_numeric($dongia) || $dongia < 0) {
            //                 $valid = false;
            //                 break; 
            //             }
                                     
            //         }
            //          // ngày áp dụng <= ngày hiện tại
            //          if (strtotime($ngayapdung) > strtotime(date('Y-m-d H:i:s'))) {
            //             $valid = false;
            //             break; 
            //         }    

            //         if ($valid) {
            //             foreach ($_POST['tenbac'] as $key => $value) {
            //                 $tenbac = $_POST['tenbac'][$key];
            //                 $tusokw = $_POST['tusokw'][$key];
            //                 $densokw = $_POST['densokw'][$key];
            //                 $dongia = $_POST['dongia'][$key];
            //                 if ($densokw === "Trở lên") {
            //                     $densokw = null;
            //                 }  
            //                 themDien($tenbac, $tusokw, $densokw, $dongia, $ngayapdung);
            //             }
            //             echo "<script>alert('Thêm Điện thành công'); window.location.href = '../controller/giadien.php?act=themgiadien';</script>";
            //         } else {
            //             echo "<script>alert('Dữ liệu không hợp lệ'); window.location.href = '../controller/giadien.php?act=themgiadien';</script>";
            //         }
            //     }
            //     include "../view/thembanggiadien.php";
            //     break;
            
            default:
            include "../view/login.php";
            break;
        }
    } else { 
        include "../view/login.php";
    }
?>