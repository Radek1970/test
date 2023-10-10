-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Poèítaè: sql.web4u.cz
-- Vygenerováno: Sobota 17. dubna 2010, 17:07
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
-- Struktura tabulky `ab5_side_right`
--

CREATE TABLE IF NOT EXISTS `ab5_side_right` (
  `id` varchar(100) NOT NULL default '',
  `nadpis` varchar(200) NOT NULL default '',
  `text` text NOT NULL,
  `obraz` varchar(100) NOT NULL default '',
  `foto` varchar(100) NOT NULL default '',
  `vyska` char(3) NOT NULL default '',
  `delka` char(3) NOT NULL default '',
  `pozice` varchar(10) NOT NULL default '',
  `popis` varchar(200) NOT NULL default '',
  `ev_c_autora` varchar(200) NOT NULL default ''
) TYPE=MyISAM;

--
-- Vypisuji data pro tabulku `ab5_side_right`
--

INSERT INTO `ab5_side_right` (`id`, `nadpis`, `text`, `obraz`, `foto`, `vyska`, `delka`, `pozice`, `popis`, `ev_c_autora`) VALUES
('20100131929391262543379', 'Kvalita je naší nejvyšší prioritou', '<span></span><span></span>Dlouhodobé zkušenosti a praxe pøekladatelù zaruèuje nejvyšší možnou kvalitu.', 'ne', 'bez', '', '', 'prava', '', '200901'),
('20100212244401265060680', 'odkazy', 'Pøeklady | \r\nAngliètina - <a href="http://www.preklady-anglictina.kvalitne.cz/">www.preklady-anglictina.kvalitne.cz</a> | email : \r\n<a href="mailto:mojeanglictina@seznam.cz">mojeanglictina@seznam.cz</a>&nbsp;', 'ne', 'bez', '', '', 'prava', '', '200901');
