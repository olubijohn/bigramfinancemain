-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 10:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Bi-gramFinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` VARCHAR(256) NOT NULL,
  `username` VARCHAR(256) NOT NULL,
  `email` VARCHAR(256) NOT NULL,
  `password` VARCHAR(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `email`, `password`) VALUES
(1, 'Admin Bi-gramFinance', 'admin', 'admin@gmail.com', '$2y$10$It7/ICPiz09XZTN4EEH3R.ywSgzC7IdcsB3BqM3F/HaBVkHoHeYu.');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `deposit_id` VARCHAR(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `payment_option` VARCHAR(256) NOT NULL,
  `deposit_status` VARCHAR(256) DEFAULT 'pending',
  `deposit_date` int(11) NOT NULL,
  `expiring_days` int(11) NOT NULL,
  `days_spent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `deposit_id`, `user_id`, `amount`, `plan`, `payment_option`, `deposit_status`, `deposit_date`, `expiring_days`, `days_spent`) VALUES
(2, '981906662', 3, 100, 5, 'bitcoin', 'success', 1712920497, 7, 1),
(3, '632652280', 4, 100, 5, 'litecoin', 'success', 1713014322, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` VARCHAR(256) NOT NULL,
  `full_name` VARCHAR(256) NOT NULL,
  `email` VARCHAR(256) NOT NULL,
  `phone_number` VARCHAR(256) NOT NULL,
  `country` VARCHAR(256) NOT NULL,
  `ref` VARCHAR(256) DEFAULT 'none',
  `password` VARCHAR(256) NOT NULL,
  `reg_date` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `phone_number`, `country`, `ref`, `password`, `reg_date`, `last_login`) VALUES
(3, 'codextra', 'Odunayo Babatunde', '001babyboy@gmail.com', '08147636364', 'Nigeria', 'codex', '$2y$10$It7/ICPiz09XZTN4EEH3R.ywSgzC7IdcsB3BqM3F/HaBVkHoHeYu.', 1712793888, 1713013937),
(4, 'joseph', 'Odunayo Babatunde', 'codextrafreelancer@gmail.com', '08147636364', 'Nigeria', 'none', '$2y$10$lgfbqtg11ax5WGsR/nq6LuTd14Rxlcpl4B1J0Q4WDXZJSQiR3Jh5a', 1713014238, 1713014255);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `withdrawal_id` VARCHAR(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `method` VARCHAR(256) NOT NULL,
  `wallet_address` VARCHAR(256) NOT NULL,
  `withdrawal_status` VARCHAR(256) DEFAULT 'pending',
  `withdrawal_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `withdrawal_id`, `user_id`, `amount`, `method`, `wallet_address`, `withdrawal_status`, `withdrawal_date`) VALUES
(6, '55013208', 3, 50, 'ethereum', '0x545D51296a001b989A9b6313B0Abb9474356db0F', 'rejected', 1712956743),
(7, '745160500', 3, 50, 'ethereum', '0x545D51296a001b989A9b6313B0Abb9474356db0F', 'rejected', 1712956955),
(8, '364167761', 4, 50, 'bitcoin', 'TBTnWtBwCfDajfDJTT1atZWp3URH9ZmL5G', 'success', 1713014493);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
