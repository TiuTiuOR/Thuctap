<?php 
function getCustomerInfoByID($makh) {
    // Khởi tạo một mảng để lưu trữ dữ liệu khách hàng
    $customerInfo = array();

    // Truy vấn để lấy thông tin khách hàng từ mã khách hàng
    $sql = "SELECT * FROM khachhang WHERE makh = ?";
    $customerData = pdo_query($sql, $makh);

    // Kiểm tra xem có dữ liệu khách hàng không
    if ($customerData) {
        // Lặp qua kết quả từ truy vấn
        foreach ($customerData as $customer) {
            // Lấy thông tin của khách hàng
            $customerInfo['makh'] = $customer['makh'];
            $customerInfo['tenkh'] = $customer['tenkh'];
            $customerInfo['diachi'] = $customer['diachi'];
            $customerInfo['dt'] = $customer['dt'];
            $customerInfo['cccd'] = $customer['cccd'];

            // Truy vấn để lấy thông tin điện kế của khách hàng
            $sql_dienke = "SELECT * FROM dienke WHERE makh = ?";
            $dienkeData = pdo_query($sql_dienke, $customer['makh']);

            // Nếu có thông tin điện kế, thêm vào mảng thông tin khách hàng
            if ($dienkeData) {
                $customerInfo['dienke'] = $dienkeData;
            }
        }
    }

    // Trả về thông tin khách hàng
    return $customerInfo;
}

    function searchIDKH($makh){
        $data = array();
        $sql_khachhang = "SELECT * FROM khachhang WHERE makh = ?";
        $khachhang = pdo_query($sql_khachhang, $makh);
        
        foreach($khachhang as $kh){
            $idkh = $kh['makh'];
            if($idkh !== null){
                $sql_dienke = "SELECT * FROM dienke WHERE makh = ?";
                $dienke = pdo_query($sql_dienke, $idkh);
                $kh['dienke'] = $dienke;
                $data['khachhang'][] = $kh;
            }
        }
        return $data;
    }

    function searchNameKH($tenkh){
        $data = array();
        $sql_khachhang = "SELECT * FROM khachhang WHERE tenkh LIKE ?";
        $khachhang = pdo_query($sql_khachhang, "%$tenkh%");
        
        foreach($khachhang as $kh){
            $idkh = $kh['makh'];
            if($idkh !== null){
                $sql_dienke = "SELECT * FROM dienke WHERE makh = ?";
                $dienke = pdo_query($sql_dienke, $idkh);
                $kh['dienke'] = $dienke;
                $data['khachhang'][] = $kh;
            }
        }
        return $data;
    }