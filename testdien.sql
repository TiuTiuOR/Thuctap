-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th4 16, 2024 lúc 05:26 PM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `testdien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthoadon`
--

DROP TABLE IF EXISTS `cthoadon`;
CREATE TABLE IF NOT EXISTS `cthoadon` (
  `mahd` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `madk` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dntt` int(11) DEFAULT NULL,
  `tongtiendien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tienthue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`mahd`,`madk`),
  KEY `fk_cthoadon_madk` (`madk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cthoadon`
--

INSERT INTO `cthoadon` (`mahd`, `madk`, `dntt`, `tongtiendien`, `tienthue`) VALUES
('240412155314', '2', 211, '291.618', '29.162'),
('240412234531', '2', 143, '180.272', '18.027'),
('240413012415', '3', 245, '352.410', '35.241'),
('240413012917', '2', 546, '928.402', '92.840'),
('240413183757', '3', 310, '469.870', '46.987'),
('240416000110', '2', 100, '124.200', '12.420'),
('240416221449', '2', 122, '122.000', '12.200'),
('240416222347', '2', 333, '333.000', '33.300'),
('240416232332', '2', 333, '513.846', '51.385'),
('240416235901', '2', 135, '166.590', '16.659'),
('240417001326', '2', 42, '63.924', '6.392');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dienke`
--

DROP TABLE IF EXISTS `dienke`;
CREATE TABLE IF NOT EXISTS `dienke` (
  `madk` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `makh` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaysx` datetime DEFAULT NULL,
  `ngaylap` datetime DEFAULT NULL,
  `mota` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` bit(1) DEFAULT NULL,
  PRIMARY KEY (`madk`),
  KEY `fk_dienke_makh` (`makh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dienke`
--

INSERT INTO `dienke` (`madk`, `makh`, `ngaysx`, `ngaylap`, `mota`, `trangthai`) VALUES
('1', '1', '2024-04-01 01:58:37', '2024-04-04 01:58:37', 'New', b'0'),
('2', '1', '2024-04-07 06:30:15', '2024-04-07 06:30:15', 'Ok', b'1'),
('3', '2', '2024-04-07 10:37:14', '2024-04-07 10:37:14', 'Ok', b'1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giadien`
--

DROP TABLE IF EXISTS `giadien`;
CREATE TABLE IF NOT EXISTS `giadien` (
  `mabac` int(15) NOT NULL AUTO_INCREMENT,
  `tenbac` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `tusokw` int(11) DEFAULT NULL,
  `densokw` int(11) DEFAULT NULL,
  `dongia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngayapdung` datetime DEFAULT NULL,
  PRIMARY KEY (`mabac`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giadien`
--

INSERT INTO `giadien` (`mabac`, `tenbac`, `tusokw`, `densokw`, `dongia`, `ngayapdung`) VALUES
(1, 'Bậc 1', 0, 100, '1.242', '2024-04-01 01:58:49'),
(2, 'Bậc 2', 101, 150, '1.304', '2024-04-01 01:58:49'),
(3, 'Bậc 3', 151, 200, '1.651', '2024-04-01 01:58:49'),
(4, 'Bậc 4', 201, 300, '1.788', '2024-04-01 01:58:49'),
(5, 'Bậc 5', 301, 400, '1.912', '2024-04-01 01:58:49'),
(9, 'Bậc 5', 301, 400, '1.912', '2024-04-01 02:52:49'),
(10, 'Bậc 2', 101, 150, '1.405', '2024-04-01 02:53:48'),
(11, 'Bậc 1', 0, 100, '1.242', '2024-04-01 03:16:52'),
(12, 'Bậc 6', 401, NULL, '1.962', '2024-04-01 05:38:09'),
(14, 'Bậc 1', 0, 100, '1.242', '2024-04-03 16:10:25'),
(15, 'Bậc 2', 101, 150, '1.304', '2024-04-03 16:24:14'),
(16, 'Bậc 4', 201, 300, '1.788', '2024-04-03 16:26:31'),
(17, 'Bậc 1', 0, 100, '1.242', '2024-04-16 01:58:49'),
(18, 'Bậc 2', 101, 150, '1.304', '2024-04-16 01:58:49'),
(19, 'Bậc 3', 151, 200, '1.651', '2024-04-16 01:58:49'),
(20, 'Bậc 4', 201, 300, '1.788', '2024-04-16 01:58:49'),
(21, 'Bậc 5', 301, 400, '1.912', '2024-04-16 01:58:49'),
(22, 'Bậc 6', 401, NULL, '1.962', '2024-04-16 01:58:49'),
(47, 'Bậc 1', 0, 150, '1.234', '2024-04-16 23:52:36'),
(48, 'Bậc 2', 151, 200, '1.345', '2024-04-16 23:52:36'),
(49, 'Bậc 3', 201, 250, '1.456', '2024-04-16 23:52:36'),
(50, 'Bậc 4', 251, 300, '1.567', '2024-04-16 23:52:36'),
(51, 'Bậc 5', 301, 350, '1.678', '2024-04-16 23:52:36'),
(52, 'Bậc 6', 351, 400, '1.789', '2024-04-16 23:52:36'),
(53, 'Bậc 7', 400, NULL, '1.890', '2024-04-16 23:52:36'),
(54, 'Bậc 1', 0, 100, '1.522', '2024-04-17 00:00:10'),
(55, 'Bậc 2', 101, 200, '1.789', '2024-04-17 00:00:10'),
(56, 'Bậc 3', 201, 300, '1.892', '2024-04-17 00:00:10'),
(57, 'Bậc 4', 301, 400, '1.992', '2024-04-17 00:00:10'),
(58, 'Bậc 5', 401, NULL, '2.033', '2024-04-17 00:00:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

DROP TABLE IF EXISTS `hoadon`;
CREATE TABLE IF NOT EXISTS `hoadon` (
  `mahd` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manv` int(15) DEFAULT NULL,
  `ky` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tungay` datetime DEFAULT NULL,
  `denngay` datetime DEFAULT NULL,
  `chisodau` int(11) DEFAULT NULL,
  `chisocuoi` int(11) DEFAULT NULL,
  `tongthanhtien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaylaphd` datetime DEFAULT NULL,
  `tinhtrang` int(1) DEFAULT NULL,
  PRIMARY KEY (`mahd`),
  KEY `fk_manv_nhanvien` (`manv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`mahd`, `manv`, `ky`, `tungay`, `denngay`, `chisodau`, `chisocuoi`, `tongthanhtien`, `ngaylaphd`, `tinhtrang`) VALUES
('240412155314', 1, '04/2024', '2024-04-06 15:42:00', '2024-05-06 15:42:00', 0, 211, '320.780', '2024-04-12 15:53:17', 0),
('240412234531', 1, '03/2024', '2024-03-01 15:53:17', '2024-03-31 23:45:00', 211, 354, '198.299', '2024-03-01 23:45:35', 0),
('240413012415', 1, '04/2024', '2024-04-01 01:24:00', '2024-04-30 01:24:00', 100, 345, '387.651', '2024-04-13 01:24:26', 1),
('240413012917', 1, '04/2024', '2024-04-12 23:45:35', '2024-05-03 01:29:00', 354, 900, '1.021.242', '2024-04-13 01:30:22', 1),
('240413183757', 1, '04/2024', '2024-04-13 01:24:26', '2024-05-13 18:38:00', 345, 655, '516.857', '2024-04-13 18:38:08', 0),
('240416000110', 1, '04/2024', '2024-04-13 01:30:22', '2024-04-14 00:38:00', 900, 1000, '136.620', '2024-04-16 00:38:06', 0),
('240416221449', 1, '04/2024', '2024-04-16 00:38:06', '2024-05-10 22:14:00', 1000, 1122, '134.205', '2024-04-16 22:14:55', 0),
('240416222347', 1, '04/2024', '2024-04-16 22:14:55', '2024-05-16 22:23:00', 1122, 1455, '366.300', '2024-04-16 22:23:53', 1),
('240416232332', 1, '04/2024', '2024-04-16 22:23:53', '2024-05-16 23:23:00', 1455, 1788, '565.231', '2024-04-16 23:23:45', 0),
('240416235901', 1, '05/2024', '2024-04-16 23:23:45', '2024-05-16 23:58:00', 1788, 1923, '183.249', '2024-04-16 23:59:04', 0),
('240417001326', 1, '06/2024', '2024-04-16 23:59:04', '2024-05-16 00:13:00', 1923, 1965, '70.316', '2024-04-17 00:13:29', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
CREATE TABLE IF NOT EXISTS `khachhang` (
  `makh` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenkh` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cccd` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`makh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`makh`, `tenkh`, `diachi`, `dt`, `cccd`) VALUES
('1', 'Khách hàng 1', 'Ai biết', '12345678', '12343'),
('10', 'Khách hàng 10', 'Địa chỉ 10', '123456786', '1234567897'),
('11', 'Khách hàng 11', 'Địa chỉ 11', '123456787', '1234567898'),
('12', 'Khách hàng 12', 'Địa chỉ 12', '123456788', '1234567899'),
('2', 'Khách hàng 2', 'Ai biết 2', '12345678', '1234567'),
('3', 'Khách hàng 3', 'Địa chỉ 3', '123456789', '1234567890'),
('4', 'Khách hàng 4', 'Địa chỉ 4', '123456780', '1234567891'),
('5', 'Khách hàng 5', 'Địa chỉ 5', '123456781', '1234567892'),
('6', 'Khách hàng 6', 'Địa chỉ 6', '123456782', '1234567893'),
('7', 'Khách hàng 7', 'Địa chỉ 7', '123456783', '1234567894'),
('8', 'Khách hàng 8', 'Địa chỉ 8', '123456784', '1234567895'),
('9', 'Khách hàng 9', 'Địa chỉ 9', '123456785', '1234567896');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `manv` int(15) NOT NULL AUTO_INCREMENT,
  `taikhoan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matkhau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tennv` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diachi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cccd` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quyen` int(1) DEFAULT NULL,
  PRIMARY KEY (`manv`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`manv`, `taikhoan`, `matkhau`, `tennv`, `diachi`, `dt`, `cccd`, `quyen`) VALUES
(1, 'nv1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Nhân viên 1', 'Ai biet', '123456789', '1234567890', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinhdien`
--

DROP TABLE IF EXISTS `tinhdien`;
CREATE TABLE IF NOT EXISTS `tinhdien` (
  `id_tinhdien` int(15) NOT NULL AUTO_INCREMENT,
  `mahd` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mabac` int(15) DEFAULT NULL,
  `sanluongKwh` int(200) DEFAULT NULL,
  `thanhtien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_tinhdien`),
  KEY `fk_tinhtien_mahd` (`mahd`),
  KEY `fk_tinhtien_mabac` (`mabac`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tinhdien`
--

INSERT INTO `tinhdien` (`id_tinhdien`, `mahd`, `mabac`, `sanluongKwh`, `thanhtien`) VALUES
(1, '240412155314', 14, 101, '125.442'),
(2, '240412155314', 15, 50, '65.200'),
(3, '240412155314', 3, 50, '82.550'),
(4, '240412155314', 16, 11, '19.668'),
(21, '240412234531', 14, 101, '125.442'),
(22, '240412234531', 15, 43, '56.072'),
(23, '240413012415', 14, 101, '125.442'),
(24, '240413012415', 15, 50, '65.200'),
(25, '240413012415', 3, 50, '82.550'),
(26, '240413012415', 16, 45, '80.460'),
(27, '240413012415', 9, 0, '0.000'),
(28, '240413012415', 12, 0, '0.000'),
(42, '240416000110', 15, 0, '0.000'),
(43, '240416000110', 3, 0, '0.000'),
(44, '240416000110', 16, 0, '0.000'),
(45, '240416000110', 9, 0, '0.000'),
(46, '240416000110', 12, 0, '0.000'),
(57, '240416221449', 21, 100, '100.000'),
(58, '240416221449', 22, 22, '22.000'),
(59, '240416221449', 23, 0, '0.000'),
(60, '240416221449', 24, 0, '0.000'),
(61, '240416221449', 25, 0, '0.000'),
(62, '240416222347', 21, 100, '100.000'),
(63, '240416222347', 22, 50, '50.000'),
(64, '240416222347', 23, 50, '50.000'),
(65, '240416222347', 24, 50, '50.000'),
(66, '240416222347', 25, 83, '83.000'),
(67, '240416232332', 17, 100, '124.200'),
(68, '240416232332', 18, 50, '65.200'),
(69, '240416232332', 19, 50, '82.550'),
(70, '240416232332', 20, 100, '178.800'),
(71, '240416232332', 21, 33, '63.096'),
(72, '240416232332', 22, 0, '0.000'),
(73, '240416235901', 47, 135, '166.590'),
(74, '240416235901', 48, -15, '-20.175'),
(75, '240416235901', 49, -65, '-94.640'),
(76, '240416235901', 50, -115, '-180.205'),
(77, '240416235901', 51, -165, '-276.870'),
(78, '240416235901', 52, -215, '-384.635'),
(79, '240416235901', 53, 0, '0.000'),
(80, '240417001326', 54, 42, '63.924'),
(81, '240417001326', 55, -58, '-103.762'),
(82, '240417001326', 56, -158, '-298.936'),
(83, '240417001326', 57, -258, '-513.936'),
(84, '240417001326', 58, 0, '0.000');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cthoadon`
--
ALTER TABLE `cthoadon`
  ADD CONSTRAINT `fk_cthoadon_madk` FOREIGN KEY (`madk`) REFERENCES `dienke` (`madk`),
  ADD CONSTRAINT `fk_cthoadon_mahd` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`);

--
-- Các ràng buộc cho bảng `dienke`
--
ALTER TABLE `dienke`
  ADD CONSTRAINT `fk_dienke_makh` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_manv_nhanvien` FOREIGN KEY (`manv`) REFERENCES `nhanvien` (`manv`);

--
-- Các ràng buộc cho bảng `tinhdien`
--
ALTER TABLE `tinhdien`
  ADD CONSTRAINT `fk_tinhtien_mabac` FOREIGN KEY (`mabac`) REFERENCES `giadien` (`mabac`),
  ADD CONSTRAINT `fk_tinhtien_mahd` FOREIGN KEY (`mahd`) REFERENCES `hoadon` (`mahd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
