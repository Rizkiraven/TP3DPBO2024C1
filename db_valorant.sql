-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 11:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_valorant`
--

-- --------------------------------------------------------

--
-- Table structure for table `creature`
--

CREATE TABLE `creature` (
  `creature_id` int(11) NOT NULL,
  `creature_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `creature`
--

INSERT INTO `creature` (`creature_id`, `creature_nama`) VALUES
(1, 'Human'),
(2, 'Radiant'),
(3, 'Cybernetic'),
(4, 'Unconfirmed'),
(5, 'Tech User');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `profile_foto` varchar(255) NOT NULL,
  `profile_ign` varchar(100) NOT NULL,
  `profile_realname` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `creature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_foto`, `profile_ign`, `profile_realname`, `role_id`, `creature_id`) VALUES
(1, 'brim.png', 'Brimstone', 'Liam Byrne', 3, 1),
(2, 'viper.png', 'Viper', 'Sabine Callas', 3, 1),
(3, 'omen.png', 'Omen', 'Unknown', 3, 2),
(4, 'killjoy.png', 'Killjoy', 'Klara Böhringer', 4, 1),
(5, 'cypher.png', 'Cypher', 'Amir El Amari', 4, 1),
(6, 'sova.png', 'Sova', 'Sasha Novikov', 2, 1),
(7, 'sage.png', 'Sage', 'Wei Lingying', 4, 2),
(8, 'phoenix.png', 'Phoenix', 'Jamie Adeyemi', 1, 2),
(9, 'jett.png', 'Jett', 'Han Sunwoo', 1, 2),
(10, 'reyna.png', 'Reyna', 'Zyanya Mondragón', 1, 2),
(11, 'raze.png', 'Raze', 'Tayane Alves', 1, 5),
(12, 'breach.png', 'Breach', 'Erik Torsten', 2, 1),
(13, 'skye.png', 'Skye', 'Kirra Foster', 2, 2),
(14, 'yoru.png', 'Yoru', 'Kiritani Ryo', 1, 2),
(15, 'astra.png', 'Astra', 'Efia Danso', 3, 2),
(16, 'kayo.png', 'Kayo', 'Unknown', 2, 3),
(17, 'chamber.png', 'Chamber', 'Vincent Fabron', 4, 1),
(18, 'neon.png', 'Neon', 'Tala Nicole Dimaapi Valdez', 1, 2),
(19, 'fade.png', 'Fade', 'Hazal Eyletmez', 2, 2),
(20, 'harbor.png', 'Harbor', 'Varun Batra', 3, 1),
(21, 'gekko.png', 'Gekko', 'Mateo Armendáriz De la Fuente', 2, 4),
(22, 'deadlock.png', 'Deadlock', 'Iselin', 4, 1),
(23, 'iso.png', 'Iso', 'Li Zhaoyu', 1, 2),
(24, 'clove.png', 'Clove', 'Scotland', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_nama`) VALUES
(1, 'Duelist'),
(2, 'Initiator'),
(3, 'Controller'),
(4, 'Sentinel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creature`
--
ALTER TABLE `creature`
  ADD PRIMARY KEY (`creature_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `ROLE_C` (`role_id`),
  ADD KEY `CREATURE_C` (`creature_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creature`
--
ALTER TABLE `creature`
  MODIFY `creature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`creature_id`) REFERENCES `creature` (`creature_id`),
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
