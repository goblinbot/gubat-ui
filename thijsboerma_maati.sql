-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 10 nov 2016 om 16:41
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `thijsboerma_maati`
--
CREATE DATABASE IF NOT EXISTS `thijsboerma_maati` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `thijsboerma_maati`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
`agent_id` int(11) NOT NULL,
  `name` varchar(38) COLLATE utf8_unicode_ci NOT NULL,
  `callsign` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rank` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(13) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  `orders` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `backup` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '> 24H',
  `agent_pin` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `rip_timestamp` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OC` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `agents`
--

INSERT INTO `agents` (`agent_id`, `name`, `callsign`, `rank`, `status`, `orders`, `backup`, `agent_pin`, `rip_timestamp`, `OC`) VALUES
(1, 'MAYUMI MAGALIT SUBAL', 'Gunsmith', 'TANGKAY / LIMAR', 'online', 'combat prep', '+ 24H', '80085', '', 'jamey'),
(5, 'TAHIMIK KARAYO TINIK', 'Ramshackle', 'TALIM / KASAPI', 'online', 'fabricating', '+ 24H', '49436', '', 'bruno'),
(3, 'DULO KALASAG PADER', 'Parish', 'TALIM / ANIMAR', 'online', 'executing', '+ 24H', '40135', '', 'PJ'),
(4, 'MAATI INFOR DANAM', '', 'HASA / WALA', 'hosting', 'Sysadmin', '+ 5M', '00451', '', 'thijs(2nd)'),
(9, 'Rodney', '', 'BALATO / KASAPI', 'inactive', 'none', '> 24H', '62733', '', 'rodney'),
(2, 'DAISUKE ABUTIN LIEZEL', 'Magician', 'TANOD / ANIMAR', 'online', 'â˜•', '+ 24H', '10069', '', 'Fhant'),
(7, 'BA&#39;SO UNAIRU SADATAN', '', 'TALIM / BAGUHAN', 'critical', 'ðÿ”¥', '+ 24H', '11112', '', 'joeri(2nd)'),
(8, 'SHINO MAGALIT DAMOLAO SUBAL', '', 'NONSTANDARD', 'inactive', 'Travel', 'none', '31445', '', 'charlie'),
(10, 'Mahiwaga Hukay Kapatas', '', 'TALIM / BAGUHAN', 'inactive', 'none', '> 24H', 'dasdas', '', 'colin?'),
(22, 'ADOC DAOMILLAS HILOM', 'Princess', 'BAINA / ???', 'MIA', 'none', 'none', 'afafaf', '+ 11 NOV 239NT', 'tim'),
(23, 'NUAI SUYA TUSEN', 'STITCHES', 'TALIM / BAGUHAN', 'MIA', 'none', 'none', 'fefrfr', '+ 18 NOV 239NT', 'massaut'),
(25, 'BAKAL DUGUAN TULOS', 'WOODSMAN', 'TANOD / ANIMAR', 'deceased', 'none', '&ERR&;', 'HALbRd', '+ 30 DEC 240NT', 'thijs(1st)'),
(26, 'IGNIS TIBAY LUGUE', 'WEATHERMAN', 'BALATO / KASAPI', 'deceased', 'none', 'none', 'qasda2', '+ 30 DEC 240NT', 'joeri(1st)'),
(24, 'KAIKO TENISAFAFI LAHAHANA', NULL, 'BALATO / KASAPI', 'unknown', 'Patrol', 'none', '01332', '', 'niek'),
(30, '', NULL, '', 'inactive', 'none', 'none', 'LEDDIT', NULL, 'teun'),
(31, '', NULL, '', 'inactive', 'none', 'none', 'ayylm4', NULL, 'Fjodor'),
(32, 'mcwizard', NULL, '', 'inactive', 'none', 'none', 'PAPYRU', NULL, 'Coensy'),
(33, 'HIMEKO KAYABALAN-HANGARIN BUGAOISA', NULL, 'Talim / Baguhan', 'offworld', 'Travel', '> 24H', '50205', NULL, 'Olga'),
(34, 'AKIZUKI TIBAY ISKUDO', NULL, 'BALATO / KASAPI', 'offworld', 'Travel', '> 24H', '22994', NULL, 'Nick AVALON'),
(35, 'SOMA MAGALIT LOBOS', NULL, 'unknown', 'offworld', 'Travel', '> 24H', '51331', NULL, 'Nick(neefje)');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agents_awarded`
--

DROP TABLE IF EXISTS `agents_awarded`;
CREATE TABLE IF NOT EXISTS `agents_awarded` (
`uniqueaward_id` int(11) NOT NULL,
  `award_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `agents_awarded`
--

INSERT INTO `agents_awarded` (`uniqueaward_id`, `award_id`, `agent_id`) VALUES
(1, 1, 33);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `awards`
--

DROP TABLE IF EXISTS `awards`;
CREATE TABLE IF NOT EXISTS `awards` (
`award_id` int(11) NOT NULL,
  `icon` int(2) NOT NULL,
  `title` varchar(24) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `awards`
--

INSERT INTO `awards` (`award_id`, `icon`, `title`, `description`) VALUES
(1, 3, 'Lady Who?', 'Awarded for having such a long name that Maati had to increase the character limit.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bulletin`
--

DROP TABLE IF EXISTS `bulletin`;
CREATE TABLE IF NOT EXISTS `bulletin` (
`id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `icon` tinyint(4) DEFAULT '1',
  `priority` tinyint(4) NOT NULL DEFAULT '4'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bulletin`
--

INSERT INTO `bulletin` (`id`, `title`, `content`, `icon`, `priority`) VALUES
(1, 'DOCTRINE UPDATE', '- NEW ARMOR MATERIALS - will be introduced&&used.<br/>- BOARDING TRAINING - postponed due to EMP accidents.', 1, 4),
(3, 'REQUEST FROM: PANDAC CATAMBAY', 'Sir Catambay desires personal contact with ''Drake Agathi''. <br> Please keep an eye open for said individual and point him/her in the right direction.', 4, 2),
(4, 'November ROOKIE.SEASON', 'Newcomers should be arriving this weekend. Please do not harm the newcomers.', 5, 3),
(5, 'BRAIN IN A BOX IS NOW ONLINE', 'Internal Communications now operate by bluespace beacon. We have taken the liberty of updating bionics && comm. devices during the graveyard shift.', 6, 4),
(6, 'SCOREBOARD', 'The scoreboard is currently suffering from technical difficulties.<br/>\r\n<em>\r\nBeating challenges, impossible odds, showing strong initiative and honorable behaviour will be rewarded with a point system and bragging rights.</em>', 6, 4),
(8, 'AAR: BREACH/CLEAR NEW COLONY', 'Pendzal arrived first, couldn''t advance due to heavy gunner. 808 GUBAT arrived, cleared gunner, rescued captives from portal room. Breach//Clear''d rooms with Aquila Personnel + Pendzali EOD. Destroyed a humanoid robot.\r\n<br/><br/>\r\nLesson of the day: obtain more EOD personnel.<br/>\r\nTangkay Subal has made full recovery.', 2, 4),
(999, 'ANIM 807 (STICKY)', '15 agents of ANIM 807 were stationed on what is now our new colony. They have been gifted to Khomar and are to be located. <span class="Alt">This is a high priority.</span><br/><br/>Not only is the honour of the 15 lost Karangalan at stake, but also the honour of valued allies.', 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
`config_id` int(11) NOT NULL,
  `brightness` int(11) NOT NULL,
  `defaultcolor` int(11) NOT NULL,
  `spaceships` int(11) NOT NULL,
  `web_status` int(11) NOT NULL,
  `MALF` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `config`
--

INSERT INTO `config` (`config_id`, `brightness`, `defaultcolor`, `spaceships`, `web_status`, `MALF`) VALUES
(1, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
`stats_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `range_kills` int(11) NOT NULL DEFAULT '0',
  `melee_kills` int(11) NOT NULL DEFAULT '0',
  `misc_kills` int(11) NOT NULL DEFAULT '0',
  `non_lethals` int(11) NOT NULL DEFAULT '0',
  `blood_donated` int(11) NOT NULL DEFAULT '0',
  `medbay_visits` int(11) NOT NULL DEFAULT '0',
  `duels_won` int(11) NOT NULL DEFAULT '0',
  `angry_nobles` int(11) NOT NULL DEFAULT '0',
  `accidents` int(11) NOT NULL DEFAULT '0',
  `bad_choices` int(11) NOT NULL DEFAULT '0',
  `expl_taken` int(11) NOT NULL DEFAULT '0',
  `pol_inc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `stats`
--

INSERT INTO `stats` (`stats_id`, `agent_id`, `range_kills`, `melee_kills`, `misc_kills`, `non_lethals`, `blood_donated`, `medbay_visits`, `duels_won`, `angry_nobles`, `accidents`, `bad_choices`, `expl_taken`, `pol_inc`) VALUES
(1, 1, 18, 18, 0, 1, 4, 3, 3, 1, 1, 1, 0, 0),
(2, 2, 12, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(3, 3, 15, 12, 0, 0, 0, 0, 0, 2, 1, 1, 0, 0),
(4, 4, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 2),
(5, 5, 6, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(6, 7, 3, 0, 0, 0, 1, 0, 0, 2, 5, 0, 0, 0),
(7, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 22, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 23, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 25, 4, 19, 6, 0, 10, 3, 1, 0, 6, 3, 3, 0),
(13, 26, 25, 0, 0, 0, 7, 2, 0, 0, 0, 0, 2, 0),
(14, 33, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `agents`
--
ALTER TABLE `agents`
 ADD PRIMARY KEY (`agent_id`), ADD UNIQUE KEY `agent_pin` (`agent_pin`);

--
-- Indexen voor tabel `agents_awarded`
--
ALTER TABLE `agents_awarded`
 ADD PRIMARY KEY (`uniqueaward_id`), ADD KEY `award_id` (`award_id`,`agent_id`);

--
-- Indexen voor tabel `awards`
--
ALTER TABLE `awards`
 ADD PRIMARY KEY (`award_id`);

--
-- Indexen voor tabel `bulletin`
--
ALTER TABLE `bulletin`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`config_id`);

--
-- Indexen voor tabel `stats`
--
ALTER TABLE `stats`
 ADD PRIMARY KEY (`stats_id`), ADD KEY `agent_id` (`agent_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `agents`
--
ALTER TABLE `agents`
MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT voor een tabel `agents_awarded`
--
ALTER TABLE `agents_awarded`
MODIFY `uniqueaward_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `awards`
--
ALTER TABLE `awards`
MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `bulletin`
--
ALTER TABLE `bulletin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `config`
--
ALTER TABLE `config`
MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `stats`
--
ALTER TABLE `stats`
MODIFY `stats_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
