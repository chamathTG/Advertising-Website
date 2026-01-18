-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2026 at 07:28 PM
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
-- Database: `ad_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(65,0) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `user_id`, `title`, `description`, `price`, `image_path`, `status`, `created_at`) VALUES
(23, 8, 'Car', 'bmw', 100000, 'uploads/1768560646_car3.jpg', 0, '2026-01-16'),
(24, 8, 'car 2020', 'Benz', 150000, 'uploads/1768560710_car2.jpg', 0, '2026-01-16'),
(25, 7, 'new car', 'test', 12314, 'uploads/1768569802_car4.jpg', 0, '2026-01-16'),
(26, 7, 'test', '`12', 12, 'uploads/1768579376_car2.jpg', 1, '2026-01-16'),
(27, 7, 'trta', 'zfcv', 343, 'uploads/1768580622_car1.jpg', 1, '2026-01-16'),
(28, 7, 'adsfa', 'adsf', 45, 'uploads/1768580650_car4.jpg', 1, '2026-01-16'),
(29, 7, '423q5', 'fsgg', 346, 'uploads/1768580663_car3.jpg', 1, '2026-01-16'),
(30, 10, 'Lepord', 'for sale', 1414, 'uploads/1768637063_car3.jpg', 0, '2026-01-17'),
(31, 7, 'banuka', 'asdasd', 11341, 'uploads/1768756783_car2.jpg', 0, '2026-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ad_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 26, 8, 'nice car', '2026-01-17 07:02:39'),
(2, 27, 8, 'nice', '2026-01-17 07:14:22'),
(3, 23, 7, 'nice car', '2026-01-18 17:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','resolved','dismissed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `ad_id`, `user_id`, `reason`, `status`, `created_at`) VALUES
(1, 27, 8, 'fake post', 'pending', '2026-01-17 07:03:13'),
(2, 30, 7, 'modabanuka', 'pending', '2026-01-18 17:20:48'),
(3, 31, 7, 'asd', 'pending', '2026-01-18 17:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `status` enum('active','banned') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `status`) VALUES
(6, 'Amarabandu', 'test@gmail.com', '$2y$10$BW1dQnFsM3kUSGW2cFlIp.LPtUF5vrLW.D4Wwm.rZ0oGoL329tOuC', 0, '0000-00-00', 'active'),
(7, 'admin', 'admin@gmail.com', '$2y$10$Mj4mxN3ic3sB6mMEhLeGGe8s896SZwxPwnv4vOuZfcz9I9AK9jU1u', 1, '0000-00-00', 'active'),
(8, 'user', 'user@gmail.com', '$2y$10$xqWcguHv02652xGBaRjXDue/oVIlaSvMJWKgDjuTJkOCgDB47fe5u', 0, '0000-00-00', 'active'),
(9, 'sad', 'as@gmail.com', '$2y$10$WLFTp9jO9.GxajU0cWkyGOOv9aJg.2qtHY9gTxq6ghv.sU85DKK7m', 0, '0000-00-00', 'active'),
(10, 'Bimal', 'bimal@gmail.com', '$2y$10$/4zjeEkpY53Vc.6em2b1bOT/TLKFIhCgAovMW43Aq5b4QfR5mtffa', 0, '0000-00-00', 'active'),
(11, 'bimal', 'asd@hgasd.cc', '$2y$10$7CZo/5tIRhWio6LLz5S1ReGwu6OGzaNGtKCQl8Nq/g7wgrOJnWbYa', 0, '0000-00-00', 'active'),
(12, 'bimal', 'test@gmail.com', '$2y$10$AGs.FuvXHPt0vZ8kPJ3plOvvA859YkFnbMAxqopYIRFwd53YcxAw6', 0, '0000-00-00', 'active'),
(13, 'admin', 'test@gmail.com', '$2y$10$X.nXL2x19NY1d83kZjqfV.b7CCD/qrWTG8w05YWFPMfLb8bZl5mM6', 0, '0000-00-00', 'active'),
(14, 'admin', 'test@gmail.com', '$2y$10$x1MpMePnbHSOaW6fZ/poN.BowhkIILnd6/ovE.jkj97LkH4rLuWTC', 0, '0000-00-00', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_id` (`ad_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_id` (`ad_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `advertisements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
