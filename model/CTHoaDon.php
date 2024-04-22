<?php
    function themcthd($mahd, $madk, $dntt, $tongtien, $tienthue){
        $sql = "INSERT INTO cthoadon (mahd,madk,dntt, tongtiendien, tienthue) VALUES (?, ?, ?, ?, ?)";
        pdo_execute($sql, $mahd, $madk, $dntt, $tongtien, $tienthue);
    }
    function showhdct($id){
        $sql = "SELECT * FROM cthoadon WHERE mahd=?";
        return pdo_query($sql, $id);
    }
    
    function show_CTHD_Full($mahd){
        $sql = "SELECT * from cthoadon join dienke on cthoadon.madk = dienke.madk
                                    join khachhang on dienke.makh = khachhang.makh 
                where cthoadon.mahd=?";
        return pdo_query($sql, $mahd);

    }
?>