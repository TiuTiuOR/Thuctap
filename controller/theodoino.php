<?php
include_once "../model/config.php";
include_once "../model/KhachHang.php";
include_once "../model/Dienke.php";
include_once "../model/HoaDon.php";
include_once "../model/CTHoaDon.php";
include_once "../model/TinhTien.php";

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case "theodoino":
            include "../view/tracuu.php";
            $tinhtrang = 0;
            $user_unpaid = check_unpaid($tinhtrang);
            include "../view/TheoDoiNo.php";
            break;
        default:
            include "../view/login.php";
            break;
    }
} else {
    include "../view/login.php";
}
?>