<?php
    require('../tfpdf/tfpdf.php');
    require_once '../vendor/autoload.php';
    require_once 'Numbers/Words.php';
    use Numbers_Words\Words;

    $pdf = new tFPDF();
    $pdf->AddPage("P", "A4"); 

    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 12);
    $pdf->SetFillColor(193, 229, 252);

    $mahd = $_GET['mahd'];
    $inhoadon = show_HD_BY_ID($mahd); 
    if(isset($_GET['mahd'])){
        $hoadon_add = $_GET['mahd'];
        $show_hd_add = show_HD_BY_ID($hoadon_add);
        
        $show_tt_byhd = show_Data_TT_By_ID($hoadon_add);

        $show_cthd_byhd = show_CTHD_Full($hoadon_add);

    }
    if($inhoadon['tinhtrang'] == 0){
    // Thiết lập các thuộc tính của font và màu sắc
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true); // Sử dụng font in đậm
        $pdf->SetFont('DejaVu', 'B', 17); // Đặt font in đậm
        $pdf->SetTextColor(0, 0, 255); // Đặt màu chữ thành màu xanh (R=0, G=0, B=255)

        // Tính toán vị trí cho dòng "Giấy báo điện" nằm giữa trang
        $x = ($pdf->GetPageWidth() - $pdf->GetStringWidth('Giấy báo điện')) / 2;
        $y = $pdf->GetY(); // Lấy vị trí dọc hiện tại

        $pdf->SetXY($x, $y);
        $pdf->Write(10, 'Giấy báo điện ');

        // Đặt lại font và màu chữ về như cũ sau khi in xong
        $pdf->SetFont('DejaVu', '', 12); // Đặt lại font về bình thường
        $pdf->SetTextColor(0); // Đặt lại màu chữ về mặc định (đen)
    }else{
        // Thiết lập các thuộc tính của font và màu sắc
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true); // Sử dụng font in đậm
        $pdf->SetFont('DejaVu', 'B', 17); // Đặt font in đậm
        $pdf->SetTextColor(0, 0, 255); // Đặt màu chữ thành màu xanh (R=0, G=0, B=255)

        $x = ($pdf->GetPageWidth() - $pdf->GetStringWidth('Hóa đơn TIỀN ĐIỆN')) / 2;
        $y = $pdf->GetY(); // Lấy vị trí dọc hiện tại

        $pdf->SetXY($x, $y);
        $pdf->Write(10, 'Hóa đơn TIỀN ĐIỆN ');

        // Đặt lại font và màu chữ về như cũ sau khi in xong
        $pdf->SetFont('DejaVu', '', 12); // Đặt lại font về bình thường
        $pdf->SetTextColor(0); // Đặt lại màu chữ về mặc định (đen)
    }

    $pdf->Ln(10);
    $pdf->Cell(15);
    $pdf->Cell(90, 5, 'Kỳ: ' . $inhoadon['ky'], 0, 0);
    $pdf->Ln(); 

    $pdf->Cell(15);
    $pdf->Cell(90, 5, 'Từ ngày: ' . $inhoadon['tungay'], 0, 0);
    $pdf->Cell(90, 5, 'Từ ngày: ' . $inhoadon['denngay'], 0, 0);
    $pdf->Ln(); 

    $pdf->Cell(15);
    $pdf->Cell(90, 5, 'Chỉ số đầu: ' . $inhoadon['chisodau'], 0, 0);
    $pdf->Cell(90, 5, 'Chỉ số cuối: ' . $inhoadon['chisocuoi'], 0, 0);
    $pdf->Ln();
    if ($show_cthd_byhd) {
        foreach ($show_cthd_byhd as $showct) {
            $pdf->Cell(15);
            $pdf->Cell(90, 5, 'Điện năng tiêu thụ: ' . $showct['dntt'] . ' Kwh', 0, 0);
        }
    } else {
        $pdf->Cell(0, 10, 'Không có dữ liệu phù hợp.', 0, 1);
    }
    $pdf->Ln(); 

    $pdf->Ln(3);
    if ($show_cthd_byhd) {
        foreach ($show_cthd_byhd as $showct) {
            $vat = $showct['tienthue'];   
            // In các thông tin trên cùng một dòng
            $pdf->Cell(15);
            $pdf->Cell(90, 5, 'Mã hóa đơn: ' . $showct['mahd'], 0, 0);
            $pdf->Cell(90, 5, 'Mã khách hàng: ' . $showct['makh'], 0, 0);
            $pdf->Ln(); 

            $pdf->Cell(15);
            $pdf->Cell(90, 5, 'Mã điện kế: ' . $showct['madk'], 0, 0);
            $pdf->Cell(90, 5, 'Tên khách hàng: ' . $showct['tenkh'], 0, 0);
            $pdf->Ln(); 

            $pdf->Cell(15);
            $pdf->Cell(90, 5, 'Địa chỉ: ' . $showct['diachi'], 0, 0);
            $pdf->Cell(90, 5, 'Căn cước công dân: ' . $showct['cccd'], 0, 0);
            $pdf->Ln(); 

            $pdf->Cell(15);
            $pdf->Cell(90, 5, 'Điện thoại: ' . $showct['dt'], 0, 0);
            $pdf->Ln(5);
        }
    } else {
        $pdf->Cell(0, 10, 'Không có dữ liệu phù hợp.', 0, 1);
    }
    if($show_tt_byhd) {
        $tongtienthanhtoan=0;

        $pdf->Ln(2); // Khoảng trống giữa thông tin chi tiết và bảng tổng tiền
        $pdf->Cell(10);
        $pdf->Cell(30, 5, 'Tên bậc', 1, 0, 'C', true);
        $pdf->Cell(35, 5, 'Số Kwh', 1, 0, 'C', true);
        $pdf->Cell(30, 5, 'Đơn giá', 1, 0, 'C', true);
        $pdf->Cell(40, 5, 'Sản lượng Kwh', 1, 0, 'C', true);
        $pdf->Cell(40, 5, 'Thành tiền', 1, 1, 'C', true);

        // In dữ liệu từ mảng $show_tt_byhd
        foreach($show_tt_byhd as $row) {
            if($row['sanluongKwh'] > 0 && $row['thanhtien'] > 0){
            if($row['densokw'] == null){
                $row['densokw'] = 'trở lên';
            }
            $pdf->Cell(10);
            $pdf->Cell(30, 7, $row['tenbac'], 1, 0, 'C');
            $pdf->Cell(35, 7, $row['tusokw'] . '-' . $row['densokw'], 1, 0, 'C');
            $pdf->Cell(30, 7, $row['dongia'], 1, 0, 'C');
            $pdf->Cell(40, 7, $row['sanluongKwh'], 1, 0, 'C');
            $pdf->Cell(40, 7, $row['thanhtien'], 1, 1, 'C');
            $thanhtien_float = floatval(str_replace('.', '', $row['thanhtien']));
            $tongtienthanhtoan += $thanhtien_float; 
        }
    }
        // In tổng tiền
        $pdf->Cell(10);
        $pdf->Cell(135, 7, 'Tổng tiền', 1, 0, 'C', true);
        $pdf->Cell(40, 7, number_format($tongtienthanhtoan, 0, '.', '.'), 1, 1, 'C');

        $pdf->Cell(10);
        $pdf->Cell(135, 7, 'Tiền thuế (VAT) - 10%', 1, 0, 'C', true);
        $pdf->Cell(40, 7, number_format(floatval(str_replace('.', '', $vat)), 0, '.', '.'), 1, 1, 'C');

        $pdf->Cell(10);
        if($inhoadon['tinhtrang'] == 0){
            $pdf->Cell(135, 7, 'Số tiền phải thanh toán', 1, 0, 'C', true);
        }else{
            $pdf->Cell(135, 7, 'Số tiền đã thanh toán', 1, 0, 'C', true);
        }
        $pdf->Cell(40, 7, $inhoadon['tongthanhtien'] , 1, 1, 'C');

    } else {
        $pdf->Cell(10);
        // Xử lý trường hợp không có dữ liệu phù hợp
        $pdf->Cell(0, 7, 'Không có dữ liệu phù hợp.', 0, 1);
    }


    $number = floatval(str_replace('.', '', $inhoadon['tongthanhtien'])); 
    $locale = new Numbers_Words_Vietnamese;
    $words = $locale->numberToVietnameseWords($number);

    $pdf->SetTextColor(255, 0, 0); // Màu chữ đỏ (R=255, G=0, B=0)
    $pdf->SetFillColor(255, 255, 255); // Màu nền trắng (R=255, G=255, B=255)
    $pdf->Cell(10); 
    if($inhoadon['tinhtrang'] == 0){
        // multicell xuất nhiều dòng văn bản trong một ô cell và tự động điều chỉnh kích thước của ô cell để vừa với nội dung.
        $pdf->MultiCell(175, 7, 'Số tiền phải thanh toán( bằng chữ): '. $words . ' đồng.', 1, 'C', true);
    }else{
        $pdf->MultiCell(175, 7, 'Số tiền đã thanh toán( bằng chữ): '. $words . ' đồng.', 1, 'C', true);
    }

    $pdf->SetTextColor(0);

    $pdf->Ln(10);


    $pdf->Cell(10, 20, 'Người lập                                                                                                            Khách hàng', 0, 1, 'L');
    $pdf->Ln(10);

    $filename = 'hoadon.pdf';
    $pdf->Output($filename, 'D');
?>
