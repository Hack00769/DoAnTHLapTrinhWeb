-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 07, 2022 lúc 08:22 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number_phone` varchar(30) NOT NULL,
  `gender` enum('Nam','Nữ') NOT NULL,
  `address` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `member`
--

INSERT INTO `member` (`member_id`, `first_name`, `last_name`, `username`, `password`, `email`, `number_phone`, `gender`, `address`) VALUES
(19, '', '', 'admin', '202cb962ac59075b964b07152d234b70', '', '', '', ''),
(55, '', '', 'admin1', '202cb962ac59075b964b07152d234b70', '', '', '', ''),
(60, 'Trần', 'Nghĩa', 'Hack007', '202cb962ac59075b964b07152d234b70', 'tnghia036@gmail.com', '0123456789', 'Nam', 'TPHCM'),
(61, 'Minh', 'Nghĩa', 'Hack00769', '202cb962ac59075b964b07152d234b70', 'tnghia035@gmail.com', '0123456789', 'Nữ', 'Quãng Ninh'),
(62, 'Nguyễn', 'Thanh Tùng', 'OneTwo', '202cb962ac59075b964b07152d234b70', 'tnghia035@gmail.com', '0123456789', 'Nữ', 'Huế');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `note` text NOT NULL,
  `total` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `phone`, `address`, `note`, `total`, `create_time`, `status`) VALUES
(11, 'Minh Nghĩa', '0123456789', 'Hà Nội', '', 900000, '2022-07-30 14:21:00', 1),
(12, 'Thanh Tâm', '0942397598', 'Hà Nội', '', 400000, '2022-08-01 11:40:32', 0),
(13, 'Nguyễn Thành Nhân', '0123456789', 'Quãng Ninh', '', 13700000, '2022-08-06 15:36:54', 2),
(14, 'Thành Chung', '0123456789', 'Lạng Sơn', '', 5500000, '2022-08-06 15:41:37', 2),
(15, 'Quang Trung', '0123456789', 'Cà Mau', '', 140000000, '2022-08-06 16:45:34', 1),
(16, 'Hoàng Hà', '0123456789', 'Đà Nẵng', '', 58000000, '2022-08-07 11:06:20', 1),
(17, 'Thanh Tịnh', '0123456789', 'Hà Nội', '', 470000000, '2022-08-07 12:36:33', 2),
(18, 'Hoàng Cầm ', '1234567890', 'Cà Mau', '', 100000000, '2022-08-07 13:18:07', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `member_id` varchar(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `member_id`, `product_id`, `quantity`, `price`, `create_time`) VALUES
(1, 11, '', 7, 1, 400000, '2022-07-30 14:21:00'),
(2, 11, '', 8, 1, 500000, '2022-07-30 14:21:00'),
(3, 12, '', 7, 1, 400000, '2022-08-01 11:40:32'),
(4, 13, '', 9, 10, 600000, '2022-08-06 15:36:54'),
(5, 13, '', 12, 3, 900000, '2022-08-06 15:36:54'),
(6, 13, '', 13, 5, 1000000, '2022-08-06 15:36:54'),
(7, 14, '', 7, 3, 400000, '2022-08-06 15:41:37'),
(8, 14, '', 8, 3, 500000, '2022-08-06 15:41:37'),
(9, 14, '', 9, 3, 600000, '2022-08-06 15:41:37'),
(10, 14, '', 13, 1, 1000000, '2022-08-06 15:41:37'),
(11, 15, '', 46, 2, 25000000, '2022-08-06 16:45:34'),
(12, 15, '', 47, 2, 45000000, '2022-08-06 16:45:34'),
(13, 16, '', 8, 1, 50000000, '2022-08-07 11:06:20'),
(14, 16, '', 9, 1, 8000000, '2022-08-07 11:06:20'),
(15, 17, '', 10, 3, 90000000, '2022-08-07 12:36:33'),
(16, 17, '', 14, 2, 100000000, '2022-08-07 12:36:33'),
(17, 18, '', 8, 2, 50000000, '2022-08-07 13:18:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `privilege`
--

CREATE TABLE `privilege` (
  `privilege_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url_match` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `privilege`
--

INSERT INTO `privilege` (`privilege_id`, `group_id`, `name`, `url_match`, `created_time`, `last_updated`) VALUES
(1, 1, 'Danh sách sản phẩm', 'product_listing\\.php$', 1596502615, 1596502615),
(2, 1, 'Thêm sản phẩm', 'product_editing\\.php$|product_editing\\.php\\?action=add+$', 1596502615, 1596502615),
(3, 1, 'Sửa sản phẩm', 'product_editing\\.php\\?id=\\d+$|product_editing\\.php\\?action=edit\\&id=\\d+$', 1596502615, 1596502615),
(4, 1, 'Xoá sản phẩm', 'product_delete\\.php\\?id=\\d+$', 1596502615, 1596502615),
(5, 2, 'Danh sách thành viên', 'member_listing\\.php$', 1596502615, 1596502615),
(6, 2, 'Thêm thành viên', 'member_editing\\.php$|member_editing\\.php\\?action=add+$', 1596502615, 1596502615),
(7, 2, 'Sửa thành viên', 'member_editing\\.php\\?id=\\d+$|member_editing\\.php\\?action=edit\\&id=\\d+$', 1596502615, 1596502615),
(8, 2, 'Xoá thành viên', 'member_delete\\.php\\?id=\\d+$', 1596502615, 1596502615),
(9, 3, 'Danh sách hoá đơn', 'order_listing\\.php$', 1596502615, 1596502615),
(10, 3, 'In hóa đơn', 'order_printing\\.php\\?id=\\d+$', 1596502615, 1596502615),
(11, 4, 'Phân quyền', 'member_privilege\\.php\\?id=\\d+$|member_privilege\\.php\\?action=save$', 1596502615, 1596502615),
(14, 3, 'Chi tiết hóa đơn', 'order_detail\\.php\\?id=\\d+$', 1596502615, 1596502615);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `privilege_group`
--

CREATE TABLE `privilege_group` (
  `group_id` int(11) NOT NULL,
  `privilege_name` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `privilege_group`
--

INSERT INTO `privilege_group` (`group_id`, `privilege_name`, `position`, `created_time`, `last_updated`) VALUES
(1, 'Sản phẩm', 1, 1596502615, 1596502615),
(2, 'Thành viên', 2, 1596502615, 1596502615),
(3, 'Đơn hàng', 3, 1596502615, 1596502615),
(4, 'Phân quyền', 4, 1596502615, 1596502615);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(255) NOT NULL,
  `category_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `name`, `image`, `price`, `quantity`, `content`, `created`, `last_update`) VALUES
(7, '', 'Armin', '/uploads//armin_a8dfd0eec37d44008f9512818660d695.jpg', 23000000, 45, '<p>123</p>\r\n', '2020-12-29 15:34:58', '2022-08-06 16:09:04'),
(8, '', 'Ventus M', '/uploads//ventus-10100f-450w_0060b5f9f53a49e0b534e97e1a658fd3.jpg', 50000000, 42, '<p>123</p>\r\n', '2020-12-29 15:35:19', '2022-08-06 16:09:19'),
(9, '', 'Ratchet M', '/uploads//ratchet_095d9fa312514fd9a243dc32a7456af9.jpg', 8000000, 36, '<p>123</p>\r\n', '2020-12-29 15:35:36', '2022-08-06 16:09:35'),
(10, '', 'Viper M', '/uploads//titan_6504fd1e844f44a2b80bdb207f36f0f9(1).jpg', 90000000, 47, '<p>123</p>\r\n', '2020-12-29 15:35:55', '2022-08-06 16:09:55'),
(12, '', 'Minion M', '/uploads//ratchet_095d9fa312514fd9a243dc32a7456af9(1).jpg', 71000000, 47, '<p>123</p>\r\n', '2020-12-29 15:36:36', '2022-08-06 16:10:26'),
(13, '', 'Hextech S', '/uploads//ventus-10100f-450w_0060b5f9f53a49e0b534e97e1a658fd3(1).jpg', 3000000, 44, '<p>123</p>\r\n', '2020-12-29 15:36:56', '2022-08-06 16:10:53'),
(14, '', 'Athen S', '/uploads//titan_6504fd1e844f44a2b80bdb207f36f0f9(1).jpg', 100000000, 48, '<p>123</p>\r\n', '2020-12-29 15:37:14', '2022-08-06 16:11:23'),
(16, '', 'Ghosts S', '/uploads//titan_6504fd1e844f44a2b80bdb207f36f0f9(1).jpg', 30000000, 50, '<p>123</p>\r\n', '2020-12-29 15:37:49', '2022-08-06 16:11:41'),
(17, '', 'AORUS S', '/uploads//titan_6504fd1e844f44a2b80bdb207f36f0f9(1)(1).jpg', 85000000, 50, '<p>123</p>\r\n', '2020-12-29 15:38:05', '2022-08-06 16:12:15'),
(18, '', 'Gaming Asus ROG Strix ', '/uploads//ventus-10100f-450w_0060b5f9f53a49e0b534e97e1a658fd3(1).jpg', 75000000, 50, '<p>123</p>\r\n', '2020-12-29 15:38:23', '2022-08-06 16:12:35'),
(31, '', 'AORUS X', '/uploads//pc_gvn_neon_s_white_edition_114c64baad944e5c8bd44bd63674adbd.jpg', 25000000, 0, '', '2022-06-26 20:28:32', '2022-06-26 20:30:32'),
(44, '', 'AORUS Z', '/uploads//1_39e376a4569a493b9b3800451f469cfe(1).jpg', 50000000, 49, '<p>123</p>\r\n', '2022-06-29 10:55:11', '2022-08-06 16:13:22'),
(46, '', 'AORUS X-MEN', '/uploads//1_39e376a4569a493b9b3800451f469cfe(1).jpg', 25000000, 37, '<p>123</p>\r\n', '2022-06-29 11:02:48', '2022-08-06 16:18:44'),
(47, '', 'AORUS GTA III', '/uploads//pc_gvn_neon_s_white_edition_114c64baad944e5c8bd44bd63674adbd(1).jpg', 45000000, 31, '', '2022-06-29 11:04:06', '2022-08-06 16:19:25'),
(48, '', 'AORUS GTA VII', '/uploads//1_39e376a4569a493b9b3800451f469cfe(1).jpg', 15000000, 0, '', '2022-06-29 11:14:23', '2022-08-06 16:19:41'),
(49, '', 'Gaming Antom', '/uploads//pc_gvn_neon_s_white_edition_114c64baad944e5c8bd44bd63674adbd(1).jpg', 54000000, 0, '', '2022-06-29 11:15:35', '2022-08-06 16:28:04'),
(50, '', 'Bosedon MSI', '/uploads//1_39e376a4569a493b9b3800451f469cfe(1).jpg', 120000000, 0, '', '2022-06-29 11:16:10', '2022-08-06 16:28:24'),
(68, '', 'AORUS B', '/uploads//pc_gvn_neon_s_white_edition_114c64baad944e5c8bd44bd63674adbd(1).jpg', 75000000, 20, '', '2022-07-10 18:36:27', '2022-07-10 18:36:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_category`
--

CREATE TABLE `product_category` (
  `category_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_privilege`
--

CREATE TABLE `user_privilege` (
  `user_privilege_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_privilege`
--

INSERT INTO `user_privilege` (`user_privilege_id`, `member_id`, `privilege_id`, `created_time`, `last_updated`) VALUES
(334, 19, 1, 1596502615, 1596502615),
(335, 19, 2, 1596502615, 1596502615),
(336, 19, 3, 1596502615, 1596502615),
(337, 19, 4, 1596502615, 1596502615),
(338, 19, 5, 1596502615, 1596502615),
(339, 19, 6, 1596502615, 1596502615),
(340, 19, 7, 1596502615, 1596502615),
(341, 19, 8, 1596502615, 1596502615),
(342, 19, 9, 1596502615, 1596502615),
(343, 19, 10, 1596502615, 1596502615),
(344, 19, 14, 1596502615, 1596502615),
(345, 19, 11, 1596502615, 1596502615),
(414, 55, 1, 1596502615, 1596502615),
(415, 55, 2, 1596502615, 1596502615),
(416, 55, 3, 1596502615, 1596502615),
(417, 55, 4, 1596502615, 1596502615),
(418, 55, 5, 1596502615, 1596502615),
(419, 55, 9, 1596502615, 1596502615);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`privilege_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Chỉ mục cho bảng `privilege_group`
--
ALTER TABLE `privilege_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD PRIMARY KEY (`user_privilege_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `privilege_id` (`privilege_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `privilege`
--
ALTER TABLE `privilege`
  MODIFY `privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `privilege_group`
--
ALTER TABLE `privilege_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `user_privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `privilege_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD CONSTRAINT `user_privilege_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_privilege_ibfk_2` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`privilege_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
