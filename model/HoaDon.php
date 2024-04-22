<?php

    function show_Data_HD_ID($madk){
        $sql="SELECT hoadon.chisocuoi, hoadon.ngaylaphd FROM cthoadon join hoadon on cthoadon.mahd = hoadon.mahd 
        where cthoadon.madk=? 
        ORDER BY ngaylaphd DESC LIMIT 1";
        return pdo_query($sql,$madk);
    }

    function themhd($mahd, $manv, $ky,$tungay,$denngay,$chisodau, $chisocuoi, $tongthanhtien, $ngaylaphd, $tinhtrang){
        $sql = "INSERT INTO hoadon (mahd, manv, ky, tungay, denngay,chisodau,chisocuoi,tongthanhtien,ngaylaphd,tinhtrang) VALUES (?, ?,?, ?,?,?,?,?,?,?)";
        pdo_execute($sql, $mahd, $manv, $ky,$tungay,$denngay,$chisodau, $chisocuoi, $tongthanhtien, $ngaylaphd, $tinhtrang);
    }
    
    function showhd(){
        $sql = "SELECT * FROM hoadon";
        return pdo_query($sql);
    }

    function show_HD_BY_ID($idhd){
        $sql = "SELECT * FROM hoadon WHERE mahd=?";
        return pdo_query_one($sql, $idhd);
    }
    
    function updateTrangThai($trangthai, $mahd){
        $sql = "UPDATE hoadon SET tinhtrang=? WHERE mahd=?";
        pdo_execute($sql, $trangthai, $mahd);
    }

    function check_unpaid($tinhtrang){
        $sql = "SELECT * FROM hoadon hd join cthoadon cthd on hd.mahd =cthd.mahd
                                        join dienke dk on cthd.madk = dk.madk
                                        join khachhang kh on dk.makh = kh.makh
                WHERE hd.tinhtrang = ?";
       return pdo_query($sql, $tinhtrang);
    }
?>