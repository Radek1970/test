-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Poèítaè: sql.web4u.cz
-- Vygenerováno: Pátek 26. února 2010, 19:41
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
-- Struktura tabulky `ab5_foto`
--

CREATE TABLE IF NOT EXISTS `ab5_foto` (
  `id` varchar(100) NOT NULL default '',
  `jmeno_orig` varchar(200) NOT NULL default '',
  `jmeno_uprav` varchar(200) NOT NULL default '',
  `format_obr` varchar(20) NOT NULL default '',
  `vyska` varchar(20) NOT NULL default '',
  `sirka` varchar(20) NOT NULL default '',
  `ev_c_autora` varchar(200) NOT NULL default ''
) TYPE=MyISAM;

--
-- Vypisuji data pro tabulku `ab5_foto`
--

INSERT INTO `ab5_foto` (`id`, `jmeno_orig`, `jmeno_uprav`, `format_obr`, `vyska`, `sirka`, `ev_c_autora`) VALUES
('14022010172659', '12_zbraslav_NN 1 èøž', '12_zbraslav_nn_1_crz', '.jpg', '347', '500', '200902'),
('19022010223343', 'gramofon', 'gramofon', '.jpg', '119', '120', '200903'),
('14022010172750', '293720130_cb66820645', '293720130_cb66820645', '.jpg', '500', '500', '200902'),
('14022010201602', 'poster-brick-excl-joblo', 'poster-brick-excl-joblo', '.jpg', '350', '518', '200902'),
('20022010110453', 'zzj_06 - Kopie', 'zzj_06_-_kopie', '.jpg', '630', '324', '200902'),
('15022010222916', '159446', '159446', '.jpg', '590', '443', '200903'),
('15022010223614', 'c8bb7888393cc67f7da646de1faf84c0', 'c8bb7888393cc67f7da646de1faf84c0', '.jpg', '461', '635', '200901'),
('14022010203446', 'obraz (205)', 'obraz_(205)', '.jpg', '448', '320', '200902'),
('16022010180405', '905veteran', '905veteran', '.jpg', '494', '650', '200903'),
('16022010181635', 'foto125b', 'foto125b', '.jpg', '305', '278', '200901'),
('25022010213021', '5P', '5p', '.jpg', '156', '235', '200902');
