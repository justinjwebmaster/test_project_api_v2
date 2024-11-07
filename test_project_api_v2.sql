-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 07, 2024 at 07:59 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_project_api_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` varchar(36) NOT NULL,
  `sender_id` varchar(36) NOT NULL,
  `message` varchar(255) NOT NULL,
  `_state` int(11) NOT NULL,
  `_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_cby` varchar(36) NOT NULL,
  `_mby` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `message`, `_state`, `_created`, `_modified`, `_cby`, `_mby`) VALUES
('ff4f5d2a-9c50-11ef-9444-34b2df4ad13c', 'ff4f5d34-9c50-11ef-9444-34b2df4ad13c', 'Bonjour, voici un message de test pour vérifier l\'API.', 1, '2024-11-06 15:08:36', '2024-11-06 15:08:36', 'ff4f5d48-9c50-11ef-9444-34b2df4ad13c', 'ff4f5d49-9c50-11ef-9444-34b2df4ad13c'),
('ff4f5ffa-9c50-11ef-9444-34b2df4ad13c', 'ff4f6004-9c50-11ef-9444-34b2df4ad13c', 'Message important pour @user1, merci de le lire.', 1, '2024-11-06 15:08:36', '2024-11-06 15:08:36', 'ff4f600e-9c50-11ef-9444-34b2df4ad13c', 'ff4f600f-9c50-11ef-9444-34b2df4ad13c'),
('ff4f60f4-9c50-11ef-9444-34b2df4ad13c', 'ff4f60fe-9c50-11ef-9444-34b2df4ad13c', 'Ceci est un autre exemple de message général.', 1, '2024-11-06 15:08:36', '2024-11-06 15:08:36', 'ff4f6108-9c50-11ef-9444-34b2df4ad13c', 'ff4f6109-9c50-11ef-9444-34b2df4ad13c'),
('ff4f6144-9c50-11ef-9444-34b2df4ad13c', 'ff4f6145-9c50-11ef-9444-34b2df4ad13c', 'Salut @user2 ! Voici une info qui te concerne.', 1, '2024-11-06 15:08:36', '2024-11-06 15:08:36', 'ff4f614e-9c50-11ef-9444-34b2df4ad13c', 'ff4f614f-9c50-11ef-9444-34b2df4ad13c'),
('ff4f6180-9c50-11ef-9444-34b2df4ad13c', 'ff4f6181-9c50-11ef-9444-34b2df4ad13c', 'Dernier message de test pour assurer le bon fonctionnement.', 1, '2024-11-06 15:08:36', '2024-11-06 15:08:36', 'ff4f618a-9c50-11ef-9444-34b2df4ad13c', 'ff4f618b-9c50-11ef-9444-34b2df4ad13c');

-- --------------------------------------------------------

--
-- Table structure for table `senders`
--

CREATE TABLE `senders` (
  `id` char(36) NOT NULL,
  `_state` int(11) DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `_cby` char(36) DEFAULT NULL,
  `_mby` char(36) DEFAULT NULL,
  `_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `_state`, `sender`, `_cby`, `_mby`, `_created`, `_modified`) VALUES
('1504b05a-9c67-11ef-9805-16faa3457061', 1, 'justin', '1504b096-9c67-11ef-9805-16faa3457061', '1504b097-9c67-11ef-9805-16faa3457061', '2024-11-06 17:46:41', '2024-11-06 17:46:41'),
('43da1bb8-9c67-11ef-9805-16faa3457061', 1, 'justin', '43da1bb8-9c67-11ef-9805-16faa3457061', '43da1bb8-9c67-11ef-9805-16faa3457061', '2024-11-06 17:48:00', '2024-11-06 17:48:00'),
('7865a83a-9c66-11ef-9805-16faa3457061', 1, 'Alice', '7865a862-9c66-11ef-9805-16faa3457061', '7865a86c-9c66-11ef-9805-16faa3457061', '2024-11-06 17:42:19', '2024-11-06 17:42:19'),
('7865ac7c-9c66-11ef-9805-16faa3457061', 1, 'Bob', '7865ac86-9c66-11ef-9805-16faa3457061', '7865ac87-9c66-11ef-9805-16faa3457061', '2024-11-06 17:42:19', '2024-11-06 17:42:19'),
('7865ace0-9c66-11ef-9805-16faa3457061', 1, 'Charlie', '7865ace1-9c66-11ef-9805-16faa3457061', '7865ace2-9c66-11ef-9805-16faa3457061', '2024-11-06 17:42:19', '2024-11-06 17:42:19'),
('7865ad08-9c66-11ef-9805-16faa3457061', 1, 'Diana', '7865ad09-9c66-11ef-9805-16faa3457061', '7865ad0a-9c66-11ef-9805-16faa3457061', '2024-11-06 17:42:19', '2024-11-06 17:42:19'),
('7865ad26-9c66-11ef-9805-16faa3457061', 1, 'Eve', '7865ad27-9c66-11ef-9805-16faa3457061', '7865ad28-9c66-11ef-9805-16faa3457061', '2024-11-06 17:42:19', '2024-11-06 17:42:19'),
('c2ac7bbc-9c66-11ef-9805-16faa3457061', 1, 'justin', 'c2ac7be4-9c66-11ef-9805-16faa3457061', 'c2ac7be5-9c66-11ef-9805-16faa3457061', '2024-11-06 17:44:23', '2024-11-06 17:44:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
