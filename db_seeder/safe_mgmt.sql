-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Aug 21, 2022 at 02:31 PM
-- Server version: 10.8.3-MariaDB-1:10.8.3+maria~jammy
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `item_number` bigint(20) UNSIGNED NOT NULL,
  `imported_item_number` text DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `key_types`
--

CREATE TABLE `key_types` (
  `id` int(11) NOT NULL,
  `key_type_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `key_types`
--

INSERT INTO `key_types` (`id`, `key_type_name`) VALUES
(1, 'RLMK'),
(2, 'LMK'),
(3, 'ZMK (KEK)'),
(4, 'ZPK (PEK, PTK, PPK)'),
(5, 'CVK'),
(6, 'PVK'),
(7, 'HSM physical'),
(8, 'Padlock physical'),
(9, 'Rack physical'),
(10, 'BACS KM/CO'),
(11, 'Admin card'),
(12, 'Operator card'),
(13, 'Master card'),
(14, 'Feature enablement'),
(15, 'Shareholder card'),
(16, 'Blank card'),
(17, 'RFID'),
(18, 'Password'),
(19, 'Session keys'),
(20, 'Bootstrap files'),
(21, 'Veeam'),
(22, 'BackupExec'),
(23, 'Netbackup'),
(24, 'N/A'),
(25, 'Data domain'),
(26, 'HSM RACC'),
(27, 'HSM CTA'),
(28, 'HSM HRK');

-- --------------------------------------------------------

--
-- Table structure for table `media_types`
--

CREATE TABLE `media_types` (
  `id` int(11) NOT NULL,
  `media_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `safes`
--

CREATE TABLE `safes` (
  `id` int(11) NOT NULL,
  `safe_name` varchar(20) NOT NULL,
  `safe_location` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_roles` varchar(255) DEFAULT NULL,
  `account_disabled` tinyint(1) NOT NULL DEFAULT 1,
  `password_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `username`, `password`, `email`, `user_roles`, `account_disabled`, `password_expiry`) VALUES
(1, 'test', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com', '2', 0, '2022-08-21 00:00:00'),
(2, 'key_admin', '$2y$10$eqEabP6tkkfuQEBjk.dYqOdZmQNw5/Df/w/.v.W.VxPxdZTgdaYbe', 'key_admin@test.com', '1', 0, '2022-11-19 00:00:00'),
(3, 'safe_viewonly', '$2y$10$MLggX8S.EJHpKNAAuSrcNeSG3yGavs1w7A7eAWd8bRWvB9SUUfDK6', 'safe_viewonly@test.com', '2', 0, '2022-11-19 00:00:00'),
(4, 'custodian', '$2y$10$k7KD9hA6uQhDIlUDwi3VUekrdWfkqhmViaPv2gysbdGzQeJAyAw8e', 'custodian@test.com', '3', 0, '2022-11-19 00:00:00'),
(5, 'inventory', '$2y$10$z/6k92nyQVQie2UCcBv02.vA0b9Ega.iD/TUuoo8kKyb.Vv1ufvle', 'inventory@test.com', '4', 0, '2022-11-19 00:00:00'),
(6, 'audit_log', '$2y$10$O5zElYOgEWxf7RsTehorK.5s2SLlxzlt0dkRgC5NSQBcVnRh/JSWa', 'audit_log@test.com', '5', 0, '2022-11-19 00:00:00');

--
-- Triggers `user_accounts`
--
DELIMITER $$
CREATE TRIGGER `setDefaultDate` BEFORE INSERT ON `user_accounts` FOR EACH ROW SET NEW.password_expiry = ADDDATE(curdate(), INTERVAL 90 DAY)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `description`) VALUES
(1, 'key_admin', 'Can manage/create user account, assign roles, manage safes (but not items), manage key types, manage media types, manage systems'),
(2, 'safe_viewonly', 'Can view all safe records'),
(3, 'custodian', 'Can pull, return and add keys safe items'),
(4, 'inventory', 'Can perform safe inventories'),
(5, 'audit_log', 'Can view the audit log');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keys`
--
ALTER TABLE `keys`
  ADD CONSTRAINT `key_types` FOREIGN KEY (`key_type_name`) REFERENCES `key_types` (`id`),
  ADD CONSTRAINT `media_types` FOREIGN KEY (`media_type_name`) REFERENCES `media_types` (`id`),
  ADD CONSTRAINT `regions` FOREIGN KEY (`region_name`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `safes` FOREIGN KEY (`safe_name`) REFERENCES `safes` (`id`),
  ADD CONSTRAINT `systems` FOREIGN KEY (`system_name`) REFERENCES `systems` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
