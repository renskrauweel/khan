-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 04 okt 2016 om 13:41
-- Serverversie: 5.7.11
-- PHP-versie: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaderboard`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `session`
--

INSERT INTO `session` (`id`, `session`) VALUES
(3, 'a:1:{s:22:"oauth_5xLdMmpejfNeYvbw";a:10:{s:12:"consumer_key";s:16:"5xLdMmpejfNeYvbw";s:15:"consumer_secret";s:16:"r5czsqpG5cUsXW9K";s:17:"signature_methods";a:1:{i:0;s:9:"HMAC-SHA1";}s:10:"server_uri";s:27:"https:dit teken kan er niet inwww.khanacademy.org";s:17:"request_token_uri";s:50:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/request_token";s:13:"authorize_uri";s:46:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/authorize";s:16:"access_token_uri";s:49:"https:dit teken kan er niet inwww.khanacademy.org/api/auth/access_token";s:10:"token_type";s:6:"access";s:5:"token";s:17:"t5185247058460672";s:12:"token_secret";s:16:"hEc5NARkfrYnPuAy";}}');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
