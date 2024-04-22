<?php
    function checkAcccount($username, $password) {
        $sql = "SELECT * FROM nhanvien WHERE taikhoan=? and matkhau=?  ";
        return pdo_query($sql, $username, $password);
    }

?>