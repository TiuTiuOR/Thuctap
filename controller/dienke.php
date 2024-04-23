<?php
    include_once "../model/config.php"; 
    include_once "../model/DienKe.php"; 
    include_once "../model/DienKeKhachHang.php"; 

    if (isset($_GET['act'])) {  
        switch ($_GET['act']) {
            case "quanlydienke":
                $data=showData();
                include "../view/quanlydienke.php";
                break;
            case "themdienke":
                $last_madk= last_IDDK();
                if(isset($_POST['addDienke'])){
                    $madk = $_POST['madk'];
                    $makh = $_POST['makh'];
                    $ngaysx = $_POST['ngaysx'];
                    $ngaylap = $_POST['ngaylap'];
                    $mota = $_POST['mota'];
                    $trangthai = $_POST['trangthai'];

                    if($madk != '' && $makh != '' && $ngaysx != '' && $ngaylap != '' && $mota !='' && $trangthai != ''){
                        addDienKe($madk, $makh, $ngaysx, $ngaylap, $mota, $trangthai);
                        echo "<script>alert('Thêm điện kế thành công!');window.location.href = '../controller/dienke.php?act=quanlydienke';</script>";  
                    }else{
                        echo "<script>alert('Thêm điện kế thất bại!');window.location.href = '../controller/dienke.php?act=quanlydienke';</script>";  
                    }
                }
                include "../view/themdienke.php";
                break;
            case "suadienke":
                if(isset($_POST['editDienKe'])){
                    $madk = $_POST['madk'];
                    $showDataDienke = show_DK_BY_ID($madk);
                    if(isset($showDataDienke) && !empty($showDataDienke)){
                        $show_madk=$showDataDienke['madk'];
                        $show_makh = $showDataDienke['makh'];
                        $show_ngaysx= $showDataDienke['ngaysx'];
                        $show_ngaylap=$showDataDienke['ngaylap'];
                        $show_mota_dk = $showDataDienke['mota'];
                        $show_trangthai=$showDataDienke['trangthai'];
                    }else{
                        echo 'Không tồn tại!!!';
                    }
                }
                if(isset($_POST['suaDienKe'])){
                    $madk = $_POST['madk'];
                    $ngaysx = $_POST['ngaysx'];
                    $ngaylap = $_POST['ngaylap'];
                    $mota = $_POST['mota'];
                    $trangthai = $_POST['trangthai'];
                    if($madk != '' && $ngaysx != '' && $ngaylap != '' && $mota !='' && $trangthai != ''){
                        editDienKe($ngaysx, $ngaylap, $mota, $trangthai, $madk);
                        echo "<script>alert('Sửa điện kế thành công!');window.location.href = '../controller/dienke.php?act=quanlydienke';</script>";  
                    }

                }
                include "../view/suadienke.php";
                break;
            case "xoadienke":
                echo "<script>alert('Đang xây dựng!');window.location.href = '../controller/dienke.php?act=quanlydienke';</script>";  
                break;
            default:
            include "../view/login.php";
            break;
        }
    } else { 
        include "../view/login.php";
    }
?>