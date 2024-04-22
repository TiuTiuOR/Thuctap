<?php
    function addTinhtien($mahd, $mabac, $sanluong, $thanhtien){
        $sql="INSERT INTO tinhdien (mahd, mabac, sanluongKwh, thanhtien) VALUES (?, ?, ?, ?)";
        pdo_execute($sql, $mahd, $mabac, $sanluong, $thanhtien);
    }

    function show_Data_TT_By_ID($idhd){
        $sql = "SELECT * from tinhdien join giadien on tinhdien.mabac = giadien.mabac where tinhdien.mahd=?";
        return pdo_query($sql, $idhd);
    }
?>