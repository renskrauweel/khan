-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                10.1.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Versie:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Databasestructuur van leaderboard wordt geschreven
CREATE DATABASE IF NOT EXISTS `leaderboard` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `leaderboard`;


-- Structuur van  tabel leaderboard.leaderboard wordt geschreven
CREATE TABLE IF NOT EXISTS `leaderboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `first` varchar(255) COLLATE utf8_bin NOT NULL,
  `second` varchar(255) COLLATE utf8_bin NOT NULL,
  `third` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumpen data van tabel leaderboard.leaderboard: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `leaderboard` DISABLE KEYS */;
INSERT INTO `leaderboard` (`id`, `course`, `description`, `first`, `second`, `third`, `date`) VALUES
	(1, 'engels', 'Leerlingen all time', 'Kris', 'Yousef Abdull Jabar (nils)', 'Rens Krauweel', '2016-09-20 13:50:43');
/*!40000 ALTER TABLE `leaderboard` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
