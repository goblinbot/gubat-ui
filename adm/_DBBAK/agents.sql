-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 26 feb 2016 om 16:35
-- Serverversie: 5.4.3-beta-community-log
-- PHP-versie: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `thijsboerma_maati`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `callsign` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rank` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(13) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'offline',
  `orders` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `backup` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT '> 24H',
  `agent_pin` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `rip_timestamp` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OC` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`agent_id`),
  UNIQUE KEY `agent_pin` (`agent_pin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Gegevens worden uitgevoerd voor tabel `agents`
--

INSERT INTO `agents` (`agent_id`, `name`, `callsign`, `rank`, `status`, `orders`, `backup`, `agent_pin`, `rip_timestamp`, `OC`) VALUES
(1, 'MAYUMI MAGALIT SUBAL', 'Gunsmith', 'TANGKAY / LIMAR', 'offline', 'test bois', '> 24H', '42024', '', 'jamey'),
(5, 'TAHIMIK KARAYO TINIK', 'Ramshackle', 'TALIM / KASAPI', 'offline', 'test bois', '> 24H', '02051', '', 'bruno'),
(3, 'DULO KALASAG PADER', 'Parish', 'TALIM / ANIMAR', 'offline', 'test bois', '> 24H', '57180', '', 'PJ'),
(4, 'MAATI INFOR DANAM', '', 'HASA / WALA', 'hosting', 'sloop website', '< 5m', '04510', '', 'thijs(2nd)'),
(9, 'Rodney', '', 'BALATO / KASAPI', 'inactive', 'test bois', '> 24H', '00001', '', 'rodney'),
(2, 'DAISUKE ABUTIN LIEZEL', 'Magician', 'TANOD / ANIMAR', 'offline', 'test bois', '> 24H', '57335', '', 'derek fhant'),
(7, 'BA&#39;SO UNAIRU SADATAN', '', 'TALIM / BAGUHAN', 'offline', 'test bois', '> 24H', '58246', '', 'joeri(3th)'),
(8, 'charlie?', '', 'BAINA / ???', 'inactive', 'test bois', 'none', '', '', 'charlie'),
(10, 'Mahiwaga Hukay Kapatas', '', 'TALIM / BAGUHAN', 'inactive', 'test bois', '> 24H', '00003', '', 'colin?'),
(22, 'ADOC DAOMILLAS HILOM', 'Princess', 'BAINA / ???', 'MIA', 'test bois', 'none', 'afafaf', '+ 11 NOV 239NT', 'tim'),
(23, 'NUAI SUYA TUSEN', 'STITCHES', 'TALIM / BAGUHAN', 'MIA', 'test bois', 'none', 'fefrfr', '+ 18 NOV 239NT', 'massaut'),
(25, 'BAKAL DUGUAN TULOS', 'WOODSMAN', 'TANOD / ANIMAR', 'deceased', 'test bois', '&ERR&;', 'HALbRd', '+ 30 DEC 240NT', 'thijs(1st)'),
(26, 'IGNIS TIBAY LUGUE', 'WEATHERMAN', 'BALATO / KASAPI', 'deceased', 'test bois', 'none', 'qasda2', '+ 30 DEC 240NT', 'joeri(1st)'),
(27, 'MAHIWAGA HUKAY KAPATAS', NULL, 'TALIM / WALA', 'MIA', 'test bois', 'none', 'asdfgh', '+ 1 JAN 240NT', 'joeri(2nd)'),
(28, '&ERR& // Lahahani', NULL, 'TALIM / KASAPI', 'MIA', 'test bois', 'none', 'sn1eks', '+ 1 JAN 294NT', '?iggy?'),
(24, 'Sothern // &ERR&', NULL, 'BALATO / KASAPI', 'MIA', 'test bois', 'none', 'LOLDIX', '+ 2 DEC 239NT', 'niek?'),
(30, '', NULL, '', 'inactive', 'test bois', 'none', 'LEDDIT', NULL, 'teun'),
(31, '', NULL, '', 'inactive', 'test bois', 'none', 'ayylm4', NULL, 'Fjodor'),
(32, 'bone spaghetti mcwizard', NULL, '', 'inactive', 'test bois', 'none', 'PAPYRU', NULL, 'Coensy');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
