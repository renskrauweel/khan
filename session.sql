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

-- Structuur van  tabel leaderboard.session wordt geschreven
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumpen data van tabel leaderboard.session: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`id`, `session`) VALUES
	(4, 'a:2:{s:22:"oauth_5xLdMmpejfNeYvbw";a:10:{s:12:"consumer_key";s:16:"5xLdMmpejfNeYvbw";s:15:"consumer_secret";s:16:"r5czsqpG5cUsXW9K";s:17:"signature_methods";a:1:{i:0;s:9:"HMAC-SHA1";}s:10:"server_uri";s:27:"https:dit teken kan er niet inwww.khanacademy.org";s:17:"request_token_uri";s:50:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/request_token";s:13:"authorize_uri";s:46:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/authorize";s:16:"access_token_uri";s:49:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/access_token";s:10:"token_type";s:6:"access";s:5:"token";s:17:"t5185247058460672";s:12:"token_secret";s:16:"hEc5NARkfrYnPuAy";}s:22:"oauth_YgdmKf7XedvH9UH7";a:10:{s:12:"consumer_key";s:16:"YgdmKf7XedvH9UH7";s:15:"consumer_secret";s:16:"BRgsfmrcKTgJ9qUm";s:17:"signature_methods";a:1:{i:0;s:9:"HMAC-SHA1";}s:10:"server_uri";s:27:"https:dit teken kan er niet inwww.khanacademy.org";s:17:"request_token_uri";s:50:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/request_token";s:13:"authorize_uri";s:46:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/authorize";s:16:"access_token_uri";s:49:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/access_token";s:10:"token_type";s:6:"access";s:5:"token";s:17:"t5107147037605888";s:12:"token_secret";s:16:"CubAwDKAmKvuqVpF";}}');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
