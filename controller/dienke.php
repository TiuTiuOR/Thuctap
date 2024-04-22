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
                include "../view/themdienke.php";
                break;
            default:
            include "../view/login.php";
            break;
        }
    } else { 
        include "../view/login.php";
    }
?>