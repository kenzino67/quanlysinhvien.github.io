-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 06:20 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsinhvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblop`
--

CREATE TABLE `tblop` (
  `Malop` varchar(5) NOT NULL,
  `Tenlop` text DEFAULT NULL,
  `sosv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tblop`
--

INSERT INTO `tblop` (`Malop`, `Tenlop`, `sosv`) VALUES
('CD01', 'CNTT khóa 43', 20),
('CD02', 'SP MN 43', 0),
('CD03', 'CNTT khóa 45', 14),
('CD04', 'CĐ CNTT K78', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbsinhvien`
--

CREATE TABLE `tbsinhvien` (
  `masv` varchar(4) NOT NULL,
  `tensv` text DEFAULT NULL,
  `gioitinh` text DEFAULT NULL,
  `dienthoai` varchar(10) DEFAULT NULL,
  `diachi` text DEFAULT NULL,
  `malop` varchar(5) DEFAULT NULL,
  `hinhanh` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbsinhvien`
--

INSERT INTO `tbsinhvien` (`masv`, `tensv`, `gioitinh`, `dienthoai`, `diachi`, `malop`, `hinhanh`) VALUES
('SV01', 'Lê Mộng Thúy', 'Nữ', '012456789', 'Châu Thành', 'CD03', 'images/sv1.png'),
('SV02', 'Lê Mộng Thắng', 'Nam', '0145789652', 'Châu Thành', 'CD01', 'images/sv2.png'),
('SV03', 'Nguyễn Khải Tường', 'Nam', '031456988', 'Hòa Thành', 'CD01', 'images/sv3.png'),
('SV04', 'Lê Mộng Thắng', 'Nam', '0145789652', 'Châu Thành', 'CD01', 'images/sv4.png'),
('SV05', 'Nguyễn Hoàng Anh', 'Nam', '01245678', 'Tây Ninh', 'CD04', 'images/sv5.png'),
('SV06', 'Trần Thị Như Ý', 'Nữ', '012345678', 'Tây Ninh', 'CD01', 'images/sv6.png'),
('SV07', 'Nguyễn Văn An', 'Nam', '01245678', 'Tây Ninh', 'CD04', 'images/sv7.png'),
('SV08', 'Trần Bình Trong', 'Nam', '01245678', 'Châu Thành', 'CD01', 'images/sv8.png'),
('SV09', 'Trần Trung Trung', 'Nam', '012488', 'Thị Xã', 'CD01', 'images/sv9.png'),
('SV10', 'Nguyễn Văn An', 'Nam', '01245678', 'Tây Ninh', 'CD04', 'images/sv10.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbuser`
--

CREATE TABLE `tbuser` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbuser`
--

INSERT INTO `tbuser` (`id`, `name`, `pass`) VALUES
(1, 'admin', '12'),
(2, 'nhung', '654321');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tblop`
--
ALTER TABLE `tblop`
  ADD PRIMARY KEY (`Malop`);

--
-- Chỉ mục cho bảng `tbsinhvien`
--
ALTER TABLE `tbsinhvien`
  ADD PRIMARY KEY (`masv`);

--
-- Chỉ mục cho bảng `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
