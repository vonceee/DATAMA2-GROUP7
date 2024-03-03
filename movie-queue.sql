-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 02:04 PM
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
-- Database: `movie-queue`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `first_name`, `last_name`, `email`) VALUES
(1, 'Juan', 'Dela Cruz', 'delacruzjuan@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movies`
--

CREATE TABLE `tbl_movies` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `movie_rating` enum('G','PG','R13','R16','R18') NOT NULL,
  `release_date` date NOT NULL,
  `run_time` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `youtube_trailer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_movies`
--

INSERT INTO `tbl_movies` (`id`, `movie_name`, `movie_rating`, `release_date`, `run_time`, `genre`, `price`, `youtube_trailer`) VALUES
(1, 'Rewind', 'R18', '2024-02-01', 150, 'Drama', 100.00, '_31Tod1VvLM?si=bhPMfqSU8KdJuTqR'),
(2, 'Demon Slayer', 'PG', '2024-02-01', 120, 'Action', 50.00, 'SXcCdQdcBtw?si=BXc8rrjeVzWp8PKC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `selected_seats` varchar(255) NOT NULL,
  `selected_time` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`reservation_id`, `customer_id`, `movie_id`, `selected_seats`, `selected_time`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '10', '1PM', '2024-03-03 03:23:03', '2024-03-03 03:23:03'),
(3, 1, 1, '1', '1PM', '2024-03-03 03:28:17', '2024-03-03 03:28:17'),
(4, 1, 1, 'A1,A2', '1PM', '2024-03-03 07:17:27', '2024-03-03 07:17:27'),
(5, 1, 2, 'A1', '1PM', '2024-03-03 09:09:34', '2024-03-03 09:09:34'),
(6, 1, 1, 'A1', '1PM', '2024-03-03 09:18:23', '2024-03-03 09:18:23'),
(7, 1, 1, 'A1', '1PM', '2024-03-03 09:21:36', '2024-03-03 09:21:36'),
(8, 1, 2, 'A2', '1PM', '2024-03-03 09:22:48', '2024-03-03 09:22:48'),
(9, 1, 1, 'A1', '1PM', '2024-03-03 12:46:42', '2024-03-03 12:46:42'),
(10, 1, 2, 'A1,A2', '1PM', '2024-03-03 12:56:32', '2024-03-03 12:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seats`
--

CREATE TABLE `tbl_seats` (
  `seat_id` int(11) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `seat_status` enum('available','booked') NOT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seats`
--

INSERT INTO `tbl_seats` (`seat_id`, `seat_number`, `seat_status`, `movie_id`) VALUES
(33, 'A1', 'booked', 1),
(34, 'A2', 'available', 1),
(35, 'A3', 'available', 1),
(36, 'A4', 'available', 1),
(37, 'B1', 'available', 1),
(38, 'B2', 'available', 1),
(39, 'B3', 'available', 1),
(40, 'B4', 'available', 1),
(41, 'C1', 'available', 1),
(42, 'C2', 'available', 1),
(43, 'C3', 'available', 1),
(44, 'C4', 'available', 1),
(45, 'D1', 'available', 1),
(46, 'D2', 'available', 1),
(47, 'D3', 'available', 1),
(48, 'D4', 'available', 1),
(49, 'A1', 'booked', 2),
(50, 'A2', 'booked', 2),
(51, 'A3', 'available', 2),
(52, 'A4', 'available', 2),
(53, 'B1', 'available', 2),
(54, 'B2', 'available', 2),
(55, 'B3', 'available', 2),
(56, 'B4', 'available', 2),
(57, 'C1', 'available', 2),
(58, 'C2', 'available', 2),
(59, 'C3', 'available', 2),
(60, 'C4', 'available', 2),
(61, 'D1', 'available', 2),
(62, 'D2', 'available', 2),
(63, 'D3', 'available', 2),
(64, 'D4', 'available', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD CONSTRAINT `tbl_reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`id`),
  ADD CONSTRAINT `tbl_reservations_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`);

--
-- Constraints for table `tbl_seats`
--
ALTER TABLE `tbl_seats`
  ADD CONSTRAINT `tbl_seats_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
