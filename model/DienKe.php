<?php
    function addDienKe($madk, $makh, $ngaysx, $ngaylap, $mota, $trangthai){
        $sql= "INSERT INTO dienke (madk, makh, ngaysx, ngaylap, mota, trangthai) VALUES (?,?,?,?,?,?)";
        pdo_execute($sql, $madk, $makh, $ngaysx, $ngaylap, $mota, $trangthai);
    }

    function editDienKe($ngaysx, $ngaylap, $mota, $trangthai, $madk){
        $sql = "UPDATE dienke SET ngaysx = ?, ngaylap = ?, mota = ?, trangthai = ? WHERE madk = ?";
        pdo_execute($sql, $ngaysx, $ngaylap, $mota, $trangthai, $madk);
    }
    function searchIDDK($madk){
        $sql = "SELECT * FROM dienke WHERE madk=?";
        return pdo_query_one($sql, $madk);
    }

    function last_IDDK(){
        $sql = "SELECT LPAD(MAX(CAST(TRIM(LEADING '0' FROM madk) AS UNSIGNED)), 8, '0') AS max_madk FROM dienke";
        return pdo_query_one($sql);
    }

    function show_DK_BY_ID($madk){
        $sql = "SELECT * FROM dienke WHERE madk=?";
        return pdo_query_one($sql, $madk);
    }
?>