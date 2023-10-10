-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Poèítaè: sql.web4u.cz
-- Vygenerováno: Nedìle 30. kvìtna 2010, 14:45
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
-- Struktura tabulky `ab5_menu`
--

CREATE TABLE IF NOT EXISTS `ab5_menu` (
  `id` varchar(100) NOT NULL default '',
  `link` varchar(200) NOT NULL default '',
  `jmeno` varchar(100) NOT NULL default '',
  `jmeno_title` varchar(100) NOT NULL default '',
  `key_sl` varchar(100) NOT NULL default '',
  `formul_kontakt` varchar(10) NOT NULL default '',
  `galerie` varchar(10) NOT NULL default ''
) TYPE=MyISAM;

--
-- Vypisuji data pro tabulku `ab5_menu`
--

INSERT INTO `ab5_menu` (`id`, `link`, `jmeno`, `jmeno_title`, `key_sl`, `formul_kontakt`, `galerie`) VALUES
('1', 'side1', 'úvod', 'úvodní stránka', '', 'ne', 'ne'),
('201004171732051271518325', 'kontakt', 'kontakt', 'kantakt', '', 'ano', 'ne'),
('201004271943201272390200', 'o_spolecnosti', 'o spoleènosti', 'o naší spoleènosti', '', 'ne', 'ne'),
('20100521329451272799785', 'dovolena_leto_2009', 'dovolená leto 2009', 'dovolena 2009', '', '', 'ano'),
('201004301805371272643537', 'public_relations', 'Public relations', 'PR (Public relations)', 'Copywrite,propagace,text', 'ne', 'ne'),
('20100551123211273051401', 'pivni_slavnosti_2009', 'pivní slavnosti 2009', 'pivní slavnosti 2009', '', 'ne', 'ano'),
('20100551128291273051709', 'copywrite', 'Copywrite', 'Copywrite je kvalitní propagaèní text', 'Public,relations', 'ne', 'ne');
