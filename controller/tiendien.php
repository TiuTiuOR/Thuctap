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
            // case "login":
            //     session_start();
            //     if(isset($_POST['dangnhap'])){
            //         $username = $_POST['username'];
            //         $password = md5($_POST['password']);
            //         $userLogin = checkAcccount($username,$password);
            //         if (!empty($username) && !empty($password)) {
            //             if ($userLogin && !empty($userLogin)) {
            //                 foreach ($userLogin as $row) {
            //                     extract($row);
            //                     $_SESSION['name'] = $tennv;
            //                     $_SESSION['username'] = $taikhoan;
            //                     $_SESSION['id_nv'] = $manv;
            //                     $_SESSION['password'] = $matkhau;
            //                 }
            //                 header("Location: ../controller/tiendien.php?act=quanly");
            //                 exit;
            //             } else {
            //                 echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu.')</script>";
            //             }
            //         } else {
            //             echo "<script>alert('Vui lòng nhập đầy đủ thông tin')</script>";
            //         }
            //     }
            //     include '../view/login.php';
            //     break;
            //VIEW QUẢN LÝ ĐIỆN
            case 'quanly':
                session_start();

                include "../view/quanly.php";
                break;
            case 'quanlydien': 
                $data=showData();
                include "../view/quanlydien.php";
                break;
            //TÍNH TIỀN ĐIỆN    
            case 'tinhdien':
                session_start();
                $result1 = showGiaHienHanh();

                //check ngày lập vs chỉ số cũ
                if(isset($_POST['selected_iddk'])){
                $a= $_POST['selected_iddk'];
                if(isset($a)){
                $show_csc_and_datehd = show_Data_HD_ID($a);
                if($show_csc_and_datehd){
                    foreach($show_csc_and_datehd as $showgt){
                        $csc_show = $showgt['chisocuoi'];
                        $ngaylaphd_show = $showgt['ngaylaphd']; 
                    }         
                } else {
                    $csc='';
                    $ngaylaphd= '';
                    }
                }
            }
            // sửa trạng thái
            if(isset($_GET['code']) && isset($_GET['action'])){
                $mahd_change = $_GET['code'];
                $action_change = $_GET['action'];
                switch ($action_change) {
                    case 'dathanhtoan':
                        $new_trangthai = 1; 
                        updateTrangThai($new_trangthai, $mahd_change);
                        echo '<script>window.location.href = "../controller/tiendien.php?act=tinhdien&mahd='.$mahd_change.'";</script>';
                        break;
                    default:
                        $new_trangthai = 0; 
                        updateTrangThai($new_trangthai, $mahd_change);
                        echo '<script>window.location.href = "../controller/tiendien.php?act=tinhdien&mahd="'.$mahd_change.'";</script>';
                        break;
                }
                exit();
            }
            // sau khi lưu hóa đơn xong kiểm tra theo mahd & show lại dlieu
            if(isset($_GET['mahd'])){
                $hoadon_add = $_GET['mahd'];
                $show_hd_add = show_HD_BY_ID($hoadon_add);
                
                $show_tt_byhd = show_Data_TT_By_ID($hoadon_add);

                $show_cthd_byhd = show_CTHD_Full($hoadon_add);

            }
                include "../view/nhapchiso.php";
                ?>
                <script>
                    function tinhTongKW() {
                        var tusokw = parseFloat(document.getElementById("tusokw").value);
                        var densokw = parseFloat(document.getElementById("densokw").value);
                        var ketqua = densokw - tusokw;
                        document.getElementById("kq").value = ketqua;
                };   
                </script>
                <?php
                if (isset($_POST['submit'])) {
                    unset($_SESSION['error_messages']);

                    $ketqua = $_POST['kq'];
                    $cst = $_POST['tusokw'];
                    $css = $_POST['densokw'];
                    $ky = $_POST['ky'];
                    if(isset($_POST['tungay'])){
                        $tungay = $_POST['tungay'];
                    }else{
                        $tungay = '';
                    }
                    if(isset($_POST['denngay'])){
                        $denngay = $_POST['denngay'];
                    }else{
                        $denngay='';
                    }
                    if($ketqua >0){
                        $star_tinh = tinhTienDien();
                        if ($star_tinh) {
                            $tong_tien = 0;
                            echo '<table border="2">';
                            echo '<tr><th>Tên Bậc</th><th>Từ số KW</th><th>Đến số KW</th><th>Đơn giá</th><th>Sản lượng(KWh)</th><th>Thành tiền</th></tr>';
                            foreach ($star_tinh as $row) {
                                if($row['tusokw'] <= $ketqua){
                                if($row['densokw'] == null){
                                    $row['densokw'] = "trở lên";
                                }
                                echo '<tr>';
                                echo '<td>' . $row['tenbac'] . '</td>';
                                echo '<td>' . $row['tusokw'] . '</td>';
                                echo '<td>' . $row['densokw'] . '</td>';
                                echo '<td>' . $row['dongia'] . '</td>';
                                
                                if($ketqua < $row['tusokw'] && $row['densokw'] == null){
                                        $thanhtienshow = 0;
                                    echo '<td> 0 </td>';
                                }else if($ketqua < $row['densokw']){
                                    if($row['tusokw'] != 0){
                                        $thanhtienshow = ($ketqua - $row['tusokw'] + 1);
                                    echo '<td>' . ($ketqua - $row['tusokw'] + 1) . '</td>';
                                    }else{
                                        $thanhtienshow = ($ketqua - $row['tusokw']);
                                        echo '<td>' . ($ketqua - $row['tusokw']) . '</td>';
                                    }
                                }else{
                                    if($row['tusokw'] != 0){
                                        $thanhtienshow = ($row['densokw'] - $row['tusokw'] + 1);
                                    echo '<td>' . ($row['densokw'] - $row['tusokw'] + 1) . '</td>';
                                    }else{
                                        $thanhtienshow = ($row['densokw'] - $row['tusokw']);
                                        echo '<td>' . ($row['densokw'] - $row['tusokw']) . '</td>';
                                    }
                                }
                                $tien_tra = $row['dongia'] * $thanhtienshow;
                                $show_tien_tong = number_format($tien_tra, 3, '.', '.');
                                echo '<td>' . $show_tien_tong . '</td>';    
                                echo '</tr>';
                                $tong_tien += $tien_tra; // Tính tổng tiền
                                $show_tongtien = number_format($tong_tien, 3, '.', '.');
                            }
                        }
                            echo '<tr><td colspan="4"></td><td>Tổng tiền:</td><td>' . $show_tongtien . '</td></tr>';
                            echo '</table>';
                            $show_tien_thue= $tong_tien * 0.1;
                            $show_tien_phai_thanh_toan = ($tong_tien * 0.1) + $tong_tien;
                            // echo 'Tính tiền điện sẽ là: '.$dongia_show. ' x ' .$ketqua. ' ta được tiền phải đóng: '.  $show_tien_phai_tra . ' VNĐ';
                            echo '<script>
                            document.getElementById("tusokw").value = "' . $_POST['tusokw'] . '";
                            document.getElementById("densokw").value = "' . $_POST['densokw'] . '";
                            document.getElementById("kq").value = "' . $_POST['kq'] . '";
                            document.getElementById("tongtien").value = "' . $show_tongtien . '";
                            document.getElementById("tungay").value = "' . $tungay . '";
                            document.getElementById("denngay").value = "' . $denngay . '";
                            document.getElementById("thue").value = "' . number_format( $show_tien_thue , 3, '.', '.') . '";
                            document.getElementById("tongtienphaitt").value = "' .  number_format($show_tien_phai_thanh_toan , 3, '.', '.'). '";
                            document.getElementById("ky").value = "' . $ky . '";

                            document.getElementById("secondForm").submit();
                        </script>';
                        } else {
                            echo "Không tìm thấy thông tin về giá điện cho số KW là $ketqua";
                        }
                    }else {
                        echo '<script>alert("Nhập lại đi, không hợp lệ số KW đã dùng[ Điện năng tiêu thụ không thể nhỏ hơn hoặc bằng 0]");</script>';
                    }
                    echo '<script>
                    document.getElementById("tusokw").value = "' . $_POST['tusokw'] . '";
                    document.getElementById("densokw").value = "' . $_POST['densokw'] . '";
                    document.getElementById("kq").value = "' . $_POST['kq'] . '";
                    document.getElementById("secondForm").submit();
                    </script>';
                }
                if(isset($_POST['addhd'])){
                    unset($_SESSION['error_messages']);
                    date_default_timezone_set('Asia/Ho_Chi_Minh');

                    if(isset($_SESSION['id_nv'])){
                        $idnv=$_SESSION['id_nv'];
                    }else{
                        $idnv = "1";
                    }
                    $cst = $_POST['tusokw'];
                    $css = $_POST['densokw'];
                    $mahd = $_POST['mahd'];
                    $dntt = $_POST['kq'];
                    $ky = $_POST['ky'];
                    $tungay=$_POST['tungay'];
                    $dengay=$_POST['denngay'];

                    $ngaylaphd=date('Y-m-d H:i:s');
                    $madk =$_POST['selected_madk'];
                    $tinhtrang="0";
                    $ketqua = $_POST['kq'];
                    $tongtien = $_POST['tongtien'];
                    $tongthanhtien = $_POST['tongtienphaitt'];
                    $thue = $_POST['thue'];

                    $error_messages = array();

                    if ($idnv != '' && $cst != '' && $css != '' && $mahd != '' && $dntt != '' && $ky != '' && $tungay != '' && $dengay != '' && $madk != '' && $ketqua != '' && $ketqua > 0 && $tongtien != '' && $tongthanhtien != '' && $thue != '') {
                        // Kiểm tra mã hóa đơn (mahd) chỉ được nhập số và không được rỗng
                        if (isset($mahd) && preg_match("/^[0-9]+$/", $mahd)) {
                            if (!preg_match("/^\d{2}\/\d{4}$/", $ky)) {
                                $error_messages[] = "Định dạng của kỳ không đúng. Vui lòng nhập theo định dạng mm/yyyy.";
                            }
                            if ($tungay >= $dengay) {
                                $error_messages[] = "Ngày bắt đầu phải nhỏ hơn ngày kết thúc.";
                            }
                            if (!is_numeric($cst) || !is_numeric($css) || $cst < 0 || $css < 0) {
                                $error_messages[] = "Chỉ số đầu và chỉ số cuối chỉ được nhập số và phải lớn hơn hoặc bằng 0.";
                            }
                            if ($css <= $cst) {
                                $error_messages[] = "Chỉ số cuối phải lớn hơn chỉ số đầu.";
                            }
                            // Nếu không có lỗi nào xảy ra, thêm hóa đơn và chuyển hướng
                            if (empty($error_messages)) {
                                themhd($mahd, $idnv ,$ky, $tungay, $dengay, $cst, $css, $tongthanhtien, $ngaylaphd, $tinhtrang);
                                themcthd($mahd, $madk, $dntt, $tongtien, $thue);
                                if ($dntt > 0) {
                                    $star_tinh = tinhTienDien();
                                    if ($star_tinh) {
                                        $tong_tien = 0;
                                        foreach ($star_tinh as $row) {
                                            $mabac_add = $row['mabac'];
                                        if($ketqua < $row['tusokw'] && $row['densokw'] == null){
                                                $thanhtienshow = 0;
                                        }else if($ketqua < $row['densokw']){
                                            if($row['tusokw'] != 0){
                                                $thanhtienshow = ($ketqua - $row['tusokw'] + 1);
                                            }else{
                                                $thanhtienshow = ($ketqua - $row['tusokw']);
                                            }
                                        }else{
                                            if($row['tusokw'] != 0){
                                                $thanhtienshow = ($row['densokw'] - $row['tusokw'] + 1);
                                            }else{
                                                $thanhtienshow = ($row['densokw'] - $row['tusokw']);
                                            }
                                        }
                                            $tien_tra = $row['dongia'] * $thanhtienshow;
                                            $show_tien_tong = number_format($tien_tra, 3, '.', '.');
                                            $tong_tien += $tien_tra;
                                            $show_tongtien = number_format($tong_tien, 3, '.', '.');
                                            addTinhtien($mahd, $mabac_add, $thanhtienshow, $show_tien_tong);
                                        }
                                    }
                                }
                                $_SESSION['success_messager'] = "Thêm thành công";
                                echo '<script>window.location.href = "../controller/tiendien.php?act=tinhdien&mahd='.$mahd.'";</script>';
                                exit();
                            }
                        } else {
                            $error_messages[] = "Mã hóa đơn chỉ được nhập số và không được để trống.";
                        }
                    } else {
                        $error_messages[] = "Không được để trống các giá trị.";
                    }
                    echo '<script>
                    document.getElementById("tusokw").value = "' . $cst . '";
                    document.getElementById("densokw").value = "' . $css . '";
                    document.getElementById("kq").value = "' . $ketqua . '";
                    document.getElementById("tongtien").value = "' . $tongtien . '";
                    document.getElementById("tungay").value = "' .  $tungay . '";
                    document.getElementById("denngay").value = "' . $dengay . '";
                    document.getElementById("thue").value = "' . $thue . '";
                    document.getElementById("tongtienphaitt").value = "' .  $tongthanhtien . '";
                    document.getElementById("ky").value = "' . $ky . '";

                    document.getElementById("secondForm").submit(); </script>';
                   
                    //lưu các lỗi check đc vào session
                    $_SESSION['error_messages'] = $error_messages;
                    
                    if(isset($_SESSION['error_messages']) && !empty($_SESSION['error_messages'])) {
                        echo '<p style="color: red; font-weight: bold;">';
                        foreach($_SESSION['error_messages'] as $error_message) {
                            echo $error_message . '<br>';
                        }
                        echo '</p>';
                        unset($_SESSION['error_messages']);
                    
                    }
                    // echo "<script>window.location.href = '../controller/tiendien.php?act=tinhdien';</script>";
                    // exit();
                }
                     
                break; 
            case 'in':
                
                include "../view/indoadon.php";
                break;
            default:
            include "../view/quanlydien.php";
            break;
        }
    } else { 
        include "../view/quanlydien.php";
    }
?>