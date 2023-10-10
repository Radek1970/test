-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Poèítaè: sql.web4u.cz
-- Vygenerováno: Nedìle 30. kvìtna 2010, 13:50
-- Verze MySQL: 4.0.25
-- Verze PHP: 5.2.11



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin2 */;

--
-- Databáze: `zbraslavh`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `ab5_anketa`
--

CREATE TABLE IF NOT EXISTS `ab5_anketa` (
  `id_ankety` int(20) NOT NULL auto_increment,
  `otazka` varchar(100) NOT NULL default '',
  `pocet_otazek` varchar(10) NOT NULL default '',
  `otazka_text_1` varchar(100) NOT NULL default '',
  `otazka_text_2` varchar(100) NOT NULL default '',
  `otazka_text_3` varchar(100) NOT NULL default '',
  `otazka_pocet_1` varchar(100) NOT NULL default '',
  `otazka_pocet_2` varchar(100) NOT NULL default '',
  `otazka_pocet_3` varchar(100) NOT NULL default '',
  `pocet_celkem` varchar(100) NOT NULL default '',
  `aktivace` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id_ankety`)
) TYPE=MyISAM AUTO_INCREMENT=26 ;

--
-- Vypisuji data pro tabulku `ab5_anketa`
--

INSERT INTO `ab5_anketa` (`id_ankety`, `otazka`, `pocet_otazek`, `otazka_text_1`, `otazka_text_2`, `otazka_text_3`, `otazka_pocet_1`, `otazka_pocet_2`, `otazka_pocet_3`, `pocet_celkem`, `aktivace`) VALUES
(1, 'jak se vám líbí web', '2', 'ano', 'ne', '', '40', '25', '', '65', 'aktivni'),
(4, 'jaké se vám líbí auto', '3', 'audi', '¹koda', 'ford', '1', '', '', '1', 'neaktivni'),
(13, 'coje PHP', '2', 'ano', 'ne', '', '0', '0', '0', '0', 'neaktivni'),
(25, 'jedete na festival', '3', 'ano', 'ne', 'nevím', '0', '0', '0', '0', 'neaktivni'),
(7, 'kolik mátepoèítaèù', '2', '3', '1', '', '0', '0', '0', '0', 'neaktivni'),
(21, 'jbhjjgf', '2', 'bb', 'bb', '', '0', '0', '0', '0', 'neaktivni'),
(22, 'nnnnnnnnn', '2', 'hhh', 'nhbh', '', '0', '0', '0', '0', 'neaktivni'),
(23, 'nbb', '2', 'bnbnb', '', '', '0', '0', '0', '0', 'neaktivni'),
(17, 'oooooooooo', '2', 'h', 'f', '', '0', '0', '0', '0', 'neaktivni'),
(20, 'máte rádi ovoce', '2', 'ano', 'ne', '', '17', '30', '0', '47', 'neaktivni'),
(24, 'fe', '2', 'regeg', 'rgreg', '', '0', '0', '0', '0', 'neaktivni');
