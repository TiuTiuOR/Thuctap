<?php
function showData(){
    $data = array();
    $sql_khachhang = "SELECT * FROM khachhang";
    $khachhang = pdo_query($sql_khachhang);
    
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

function showtheoidgiadien($idbac){
    $sql = "SELECT * FROM giadien WHERE mabac=?";
    return pdo_query($sql, $idbac);

}
?>