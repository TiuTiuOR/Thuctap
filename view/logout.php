<?php  
    session_start();

        if(isset($_SESSION['id_nv'])){
            unset($_SESSION['name']);
            unset($_SESSION['username']);

            unset($_SESSION['id_nv']);
            unset($_SESSION['password']);
            header("location: ../controller/nhanvien.php?act=login");
        }
?>