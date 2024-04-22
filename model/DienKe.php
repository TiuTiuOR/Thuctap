<?php
    function searchIDDK($madk){
        $sql = "SELECT * FROM dienke WHERE madk=?";
        return pdo_query_one($sql, $madk);
    }


?>