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
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumpen data van tabel leaderboard.leaderboard: ~28 rows (ongeveer)
/*!40000 ALTER TABLE `leaderboard` DISABLE KEYS */;
INSERT INTO `leaderboard` (`id`, `course`, `description`, `first`, `second`, `third`, `date`) VALUES
	(268, 'Engels', 'Alle leerlingen', 'Laura deboer', 'paulien z', 'Joey Huitema', '2016-10-11 14:39:48'),
	(269, 'Rekenen', 'I4O3A', 'Rens Krauweel', '', '', '2016-10-11 14:39:48'),
	(270, 'Rekenen', 'I4O2A', 'dijkstra.eric', '', '', '2016-10-11 14:39:48'),
	(271, 'Rekenen', 'I4O1A', 'Yousef Abdull Jabar (nils)', 'Rens Krauweel', '', '2016-10-11 14:39:48'),
	(272, 'Engels', 'Alle leerlingen', 'Laura deboer', 'paulien z', 'Joey Huitema', '2016-10-10 14:40:22'),
	(273, 'Rekenen', 'I4O3A', 'Rens Krauweel', '', '', '2016-10-10 14:40:22'),
	(274, 'Rekenen', 'I4O2A', 'dijkstra.eric', '', '', '2016-10-10 14:40:22'),
	(275, 'Rekenen', 'I4O1A', 'Yousef Abdull Jabar (nils)', 'Rens Krauweel', '', '2016-10-10 14:40:22');
/*!40000 ALTER TABLE `leaderboard` ENABLE KEYS */;


-- Structuur van  tabel leaderboard.session wordt geschreven
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumpen data van tabel leaderboard.session: ~1 rows (ongeveer)
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`id`, `session`) VALUES
	(6, 'a:1:{s:22:"oauth_mNQaqSxthyCKEXbP";a:10:{s:12:"consumer_key";s:16:"mNQaqSxthyCKEXbP";s:15:"consumer_secret";s:16:"S4Ar5AVtjsZK5fpj";s:17:"signature_methods";a:1:{i:0;s:9:"HMAC-SHA1";}s:10:"server_uri";s:27:"https:dit teken kan er niet inwww.khanacademy.org";s:17:"request_token_uri";s:50:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/request_token";s:13:"authorize_uri";s:46:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/authorize";s:16:"access_token_uri";s:49:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/access_token";s:10:"token_type";s:6:"access";s:5:"token";s:17:"t6570708280868864";s:12:"token_secret";s:16:"3R5NV9TfjcBw6br3";}}');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
