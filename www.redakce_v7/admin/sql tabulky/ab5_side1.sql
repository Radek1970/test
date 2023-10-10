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
-- Struktura tabulky `ab5_side1`
--

CREATE TABLE IF NOT EXISTS `ab5_side1` (
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
-- Vypisuji data pro tabulku `ab5_side1`
--

INSERT INTO `ab5_side1` (`id`, `nadpis`, `text`, `obraz`, `foto`, `vyska`, `delka`, `pozice`, `popis`, `ev_c_autora`) VALUES
('201004132113031271185983', 'Angliètina rychle, kvalitnì a levnì. Již od 185 Kè/NS', '<P>Jsme skupina <SPAN style="FONT-WEIGHT: bold">pøekladatelù</SPAN> a nabízíme kompletní servis služeb co se týèe pøekladù do angliètiny a z angliètiny.Pøeklady do angliètiny jsme schopni zhotovit velice rychle v rámci tzv. služby - angliètina on-line (rychlá komunikace internetovými kanály).Máme bohaté zkušenosti s pøeklady právních, ekonomických, technických a jiných textù (jak jednoduchých tak i velmi odborných).</P>', 'ne', 'bez', '', '', 'prava', '', '200903'),
('201004142223511271276631', 'Dále nabízíme tlumoèení na obchodních jednáních atd', '<p>Zajistíme kvalitní služby na území Èeské Republiky i v cizinì.Pokud chcete \r\nzískat kvalitní služby za rozumnou cenu, jsme tu pro Vás - Pøeklady \r\nangliètina.</p>', 'ne', 'bez', '', '', 'prava', '', '200903'),
('201004132043511271184231', 'Pozvánka na první roèník konference Internet Developer Forum', '<p>IDF 2010 je nová celodenní konference od Internet Infa, tentokrát zamìøená na pøedevším na webové vývojáøe a ty, kteøí s nimi pøicházejí do styku.</p>', 'ne', 'bez', '', '', 'prava', '', '200903'),
('201004142227421271276862', 'Kniha Uživatelsky pøívìtivá rozhraní', '<p><font size="2">Vyšel první èeský sborník textù o interakci èlovìka s poèítaèem (HCI) a \r\npoužitelnosti uživatelských rozhraní. Jednou kapitolou pøispìl i Dobrý web.</font></p>', 'ne', 'bez', '', '', 'prava', '', '200903');
