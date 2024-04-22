<?php
function giadien_showAll(){
    $sql = "SELECT * FROM giadien";
    return pdo_query($sql);
}

function cbbNgay(){
    $sql ="SELECT DISTINCT DATE_FORMAT(ngayapdung, '%Y-%m-%d %H:%i:%s') AS ngayapdung FROM giadien";
    return pdo_query($sql);
}
function showGia_cbb($ngay){
    $sql = "SELECT * FROM giadien WHERE DATE_FORMAT(ngayapdung, '%Y-%m-%d %H:%i:%s')=?";
    return pdo_query($sql, $ngay);
}

function themDien($tenbac, $sokw, $denkw, $dongia, $ngayapdung){
    $sql = "INSERT INTO giadien (tenbac, tusokw, densokw, dongia, ngayapdung) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $tenbac, $sokw, $denkw, $dongia, $ngayapdung);
}

function showGiaHienHanh() {
    $sql = "SELECT * FROM giadien g2 WHERE g2.ngayapdung =(
        SELECT ngayapdung
        FROM giadien g1
        WHERE g1.ngayapdung <= CURRENT_TIMESTAMP 
        ORDER BY g1.ngayapdung DESC 
        LIMIT 1
    ) ORDER BY g2.tenbac ASC;";
    return pdo_query($sql);
}
function tinhTienDien(){
    $sql = "SELECT * FROM giadien g2 WHERE g2.ngayapdung =(
        SELECT ngayapdung
        FROM giadien g1
        WHERE g1.ngayapdung <= CURRENT_TIMESTAMP 
        ORDER BY g1.ngayapdung DESC 
        LIMIT 1
    ) ORDER BY g2.tenbac ASC;";
    return pdo_query($sql);
}
// function showGiaConLai($selected_date) {
//     $sql = "SELECT * FROM giadien gi WHERE gi.tenbac NOT IN (
//             SELECT DISTINCT gi2.tenbac FROM giadien gi2 WHERE gi2.ngayapdung =? ) AND gi.ngayapdung = (
//             SELECT MAX(gi3.ngayapdung) FROM giadien gi3 WHERE gi3.tenbac = gi.tenbac ) 
//             ORDER BY tenbac, ngayapdung DESC ";

//     return pdo_query($sql, $selected_date);
// }

// function showGiaConLaiDung($selected_date, $selected_date1, $selected_date2) {
//     $sql = "SELECT gi.* FROM giadien gi WHERE gi.ngayapdung < ? AND gi.tenbac NOT IN (
//     SELECT DISTINCT gi2.tenbac FROM giadien gi2 WHERE gi2.ngayapdung = ? ) AND gi.ngayapdung = (
//     SELECT MAX(ngayapdung) FROM giadien WHERE ngayapdung < ? AND tenbac = gi.tenbac)
//     ORDER BY tenbac, ngayapdung DESC";
//     return pdo_query($sql, $selected_date, $selected_date1, $selected_date2);
// }
// function showGiaHienHanh() {
//     $sql = "SELECT * FROM giadien g WHERE g.ngayapdung = (
//             SELECT MAX(ngayapdung) FROM giadien WHERE tenbac = g.tenbac
//             )ORDER BY tenbac, ngayapdung DESC";

//     return pdo_query($sql);
// }


// function tinhTienDien(){
//     $sql = "SELECT *
//     FROM giadien g
//     WHERE g.ngayapdung = (
//         SELECT MAX(ngayapdung)
//         FROM giadien
//         WHERE tenbac = g.tenbac
//     )
//     ORDER BY g.tenbac, g.ngayapdung DESC";
//     return pdo_query($sql);
// }
// function tinhTienDien1($kq){
//     $sql = "SELECT *
//     FROM giadien g
//     WHERE g.tusokw <= ? AND g.ngayapdung = (
//         SELECT MAX(ngayapdung)
//         FROM giadien
//         WHERE tenbac = g.tenbac
//     )
//     ORDER BY g.tenbac, g.ngayapdung DESC";
//     return pdo_query($sql, $kq);
// }

// function thembanggiabac($mabc, $mahd){
//     $sql = "INSERT INTO banggiabacdien (mabac, mahd) VALUES (?, ?)";
//     pdo_execute($sql, $mabc, $mahd);
// }

?>