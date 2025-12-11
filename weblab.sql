-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 05:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weblab`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`) VALUES
(1, 1, ''),
(2, 1, ''),
(3, 3, 'Ghê v cha'),
(4, 4, 'Ý nghĩa quá à'),
(5, 4, '<scropt>alert(1)</script>'),
(6, 5, '<h1> XIN CHÀO </h1>'),
(7, 5, '<h1> XIN CHÀO </h1>'),
(8, 5, '<h1> Xin chào  123</h1>'),
(9, 5, '[BLOCKED] Xin chào  123[BLOCKED]'),
(10, 5, '[BLOCKED]hello[BLOCKED]'),
(11, 5, 'hello'),
(12, 5, ' helo '),
(13, 5, '(1)'),
(14, 5, '(10)'),
(15, 5, '(10)'),
(16, 5, '(10)'),
(17, 5, '(10)'),
(18, 5, '(10)'),
(19, 5, '(10)'),
(20, 5, '(10)'),
(21, 5, ''),
(22, 5, '<video><source =\"(1)\"></video>'),
(23, 5, '&#60;script&#62;(1)&#60;/script&#62;\r\n'),
(24, 5, '(10)'),
(25, 5, '(10)'),
(26, 5, 'j%41vascript:(10)'),
(27, 5, '%3c/script%3e%3cscript%3e(10)%3c/script%3e'),
(28, 5, '(1)'),
(29, 5, '(\"xss\")'),
(30, 5, '(\"xss\")'),
(31, 5, '(\"xss\")'),
(32, 5, '(123)'),
(33, 5, '(123)'),
(34, 5, 'alert(123)'),
(35, 5, 'alert(123)'),
(36, 5, '<h1>huy<h1>'),
(37, 5, 'alert(123)'),
(38, 5, ''),
(39, 5, ''),
(40, 5, ''),
(41, 5, '<h1>hehe<h1>'),
(42, 5, ''),
(43, 5, 'alert(123)'),
(44, 5, '&lt;h1&gt;heko&lt;h1&gt;'),
(45, 5, 'Hád'),
(46, 5, 'Hád'),
(47, 5, 'alert(document.cookie)'),
(48, 5, 'alert(document.cookie)'),
(49, 5, 'alert(123)'),
(50, 5, 'alert(document.cookie)'),
(51, 5, '%3C/script%3Ealert(123)'),
(52, 5, '%3C/script%3Ealert(123)'),
(53, 12, 'alert(123)'),
(54, 12, '%3Cscript%3Ealert(1)%3C%2Fscript%3E\r\n'),
(55, 12, '%3C%2Fscript%3E%3Cscript%3Ealert(123)%3C%2Fscript%3E'),
(56, 12, 'alert(\"huy\")'),
(57, 13, '<h1>XIn CHAO<h1>'),
(58, 13, 'alert(1)'),
(59, 13, 'alert(\"PHU\")'),
(60, 13, 'alert(1)');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `user_id`) VALUES
(4, 'Xin chào', 'BÀI LAB này được tạo ra để giúp cho các lập trình viên hiểu rõ được những lỗi, và giúp cho các bạn pentest có thể hiểu rõ được cách thực hoạt động', '1765098273_garou.webp', 1),
(11, 'SQL BLIND', 'SQL mù là kiểu SQL Injection mà hệ thống KHÔNG trả về dữ liệu lỗi hay kết quả trực tiếp, chỉ trả về:\r\n\r\n✅ Đúng / ❌ Sai\r\n\r\nHoặc nhanh / chậm\r\nhehe\r\n\r\n👉 Hacker phải suy luận dữ liệu từng ký tự một.\r\nTrackingID=admin', '1765115187_chillguy.jpeg', 1),
(13, 'XSS tôi đê', 'THÁCH ĐẤY,  không encode và context đc đâu e ơi, chỉ có thể lừa server đâu là thẻ thật và đâu là thẻ giả thôi', '1765119642_tomandjery.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `tracking_id`) VALUES
(1, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '123456', 'admin'),
(2, 'user1', '123456', 'user'),
(3, 'huygiaton2011', 'huygiaton2011', 'user'),
(4, 'huygiaton2011', 'huygiaton2011', 'user'),
(5, 'test', 'test', 'user'),
(6, 'huy1', 'huy1', 'user'),
(7, 'phu', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
