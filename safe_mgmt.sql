-- phpMyAdmin SQL Dump
-- version 5.2.0-1.fc35
-- https://www.phpmyadmin.net/
--
-- Host: groucho
-- Generation Time: Aug 17, 2022 at 10:44 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safe_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `roles` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`, `roles`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `item_number` bigint(20) UNSIGNED NOT NULL,
  `key_name` varchar(40) NOT NULL,
  `safe` int(11) NOT NULL COMMENT 'id from safes',
  `system` int(30) NOT NULL COMMENT 'id from systems',
  `region` int(10) NOT NULL COMMENT 'id from regions',
  `date_added` date NOT NULL,
  `date_removed` date NOT NULL,
  `date_inventoried` date NOT NULL,
  `comments` varchar(255) NOT NULL,
  `client _name` varchar(30) DEFAULT NULL COMMENT 'Not used',
  `client_number` smallint(6) DEFAULT NULL COMMENT 'Not used',
  `device_serial` varchar(30) NOT NULL,
  `TPE` varchar(12) NOT NULL,
  `key_serial` varchar(30) NOT NULL,
  `Comb_KCV` varchar(6) NOT NULL,
  `bin_number` int(11) DEFAULT NULL COMMENT 'Not used',
  `media_type` int(11) NOT NULL COMMENT 'id from media',
  `key_type` int(11) NOT NULL COMMENT 'id from key_types',
  `hash` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `item_number` bigint(20) UNSIGNED NOT NULL,
  `key_name` varchar(40) NOT NULL,
  `safe_name` int(11) NOT NULL COMMENT 'id from safes',
  `system_name` int(30) NOT NULL COMMENT 'id from systems',
  `region_name` int(10) NOT NULL COMMENT 'id from regions',
  `date_added` date NOT NULL,
  `date_removed` date NOT NULL,
  `date_inventoried` date NOT NULL,
  `comments` varchar(255) NOT NULL,
  `client _name` varchar(30) DEFAULT NULL COMMENT 'Not used',
  `client_number` smallint(6) DEFAULT NULL COMMENT 'Not used',
  `device_serial` varchar(30) NOT NULL,
  `TPE` varchar(12) NOT NULL,
  `key_serial` varchar(30) NOT NULL,
  `Comb_KCV` varchar(6) NOT NULL,
  `bin_number` int(11) DEFAULT NULL COMMENT 'Not used',
  `media_type_name` int(11) NOT NULL COMMENT 'id from media_types',
  `key_type_name` int(11) NOT NULL COMMENT 'id from key_types',
  `hash` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `key_types`
--

CREATE TABLE `key_types` (
  `id` int(11) NOT NULL,
  `key_type_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media_types`
--

CREATE TABLE `media_types` (
  `id` int(11) NOT NULL,
  `media_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_types`
--

INSERT INTO `media_types` (`id`, `media_name`) VALUES
(2, 'Smartcard'),
(3, 'Paper'),
(4, 'Physical key'),
(5, 'Floppy disk1'),
(6, 'USB stick'),
(7, 'Chequebook'),
(8, 'CD/DVD'),
(9, 'Card reader');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `region_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `region_name`) VALUES
(1, 'Prod'),
(2, 'Non-Prod'),
(3, 'DR'),
(4, 'N/A'),
(5, 'QA / DEV');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `safes`
--

CREATE TABLE `safes` (
  `id` int(11) NOT NULL,
  `safe_name` varchar(20) NOT NULL,
  `safe_location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `safes`
--

INSERT INTO `safes` (`id`, `safe_name`, `safe_location`) VALUES
(1, 'Kn A', 'Knaresborough'),
(2, 'Kn B', 'Knaresborough'),
(3, 'Kn C', 'Knaresborough'),
(4, 'Yk A', 'York'),
(5, 'Yk B', 'York'),
(6, 'Yk C', 'York');

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE `systems` (
  `id` int(11) NOT NULL,
  `systems_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `systems_name`) VALUES
(1, 'Atalla'),
(2, 'BACS'),
(3, 'BCSS'),
(4, 'Creditcare'),
(5, 'DSM'),
(6, 'Forum Sentry'),
(7, 'Misc'),
(8, 'P3'),
(9, 'Prepaid'),
(10, 'Prime'),
(11, 'TED / TSS'),
(12, 'TMS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`item_number`),
  ADD UNIQUE KEY `item_number` (`item_number`),
  ADD KEY `safe contraint` (`safe`),
  ADD KEY `system constraint` (`system`),
  ADD KEY `region constraint` (`region`),
  ADD KEY `media_type constraint` (`media_type`),
  ADD KEY `key_type constraint` (`key_type`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`item_number`),
  ADD UNIQUE KEY `item_number` (`item_number`),
  ADD KEY `media_types` (`media_type_name`),
  ADD KEY `key_types` (`key_type_name`),
  ADD KEY `safes` (`safe_name`),
  ADD KEY `systems` (`system_name`),
  ADD KEY `regions` (`region_name`);

--
-- Indexes for table `key_types`
--
ALTER TABLE `key_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_types`
--
ALTER TABLE `media_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safes`
--
ALTER TABLE `safes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `item_number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `item_number` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `key_types`
--
ALTER TABLE `key_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_types`
--
ALTER TABLE `media_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `safes`
--
ALTER TABLE `safes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keys`
--
ALTER TABLE `keys`
  ADD CONSTRAINT `regions` FOREIGN KEY (`region_name`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `key_types` FOREIGN KEY (`key_type_name`) REFERENCES `key_types` (`id`),
  ADD CONSTRAINT `media_types` FOREIGN KEY (`media_type_name`) REFERENCES `media_types` (`id`),
  ADD CONSTRAINT `safes` FOREIGN KEY (`safe_name`) REFERENCES `safes` (`id`),
  ADD CONSTRAINT `systems` FOREIGN KEY (`system_name`) REFERENCES `systems` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
