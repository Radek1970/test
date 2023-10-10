-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Poèítaè: sql.web4u.cz
-- Vygenerováno: Sobota 17. dubna 2010, 17:10
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
-- Struktura tabulky `ab5_heslo`
--

CREATE TABLE IF NOT EXISTS `ab5_heslo` (
  `user` varchar(100) NOT NULL default '',
  `pass` varchar(100) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `ev_c` varchar(100) NOT NULL default '',
  `funkce` varchar(100) NOT NULL default '',
  `jmeno` varchar(100) NOT NULL default '',
  `prijmeni` varchar(100) NOT NULL default ''
) TYPE=MyISAM;

--
-- Vypisuji data pro tabulku `ab5_heslo`
--

INSERT INTO `ab5_heslo` (`user`, `pass`, `email`, `ev_c`, `funkce`, `jmeno`, `prijmeni`) VALUES
('ravis', 'ravis', 'info@tvorbawebstranek.com', '200901', 'superredaktor', 'Webmaster', 'koder'),
('host', 'test02', 'test@test.cz', '200902', 'redaktor', 'host', 'host'),
('adminx', 'adminx', 'admin@admin.cz', '200903', 'redaktor', 'Adam', 'webster'),
('petr', 'panx', 'pet.pan@click.cz', '20100417163256b25gfg', 'dopisovatel', 'Petr', 'Novák');
