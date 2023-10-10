-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Po��ta�: sql.web4u.cz
-- Vygenerov�no: Sobota 17. dubna 2010, 17:07
-- Verze MySQL: 4.0.25
-- Verze PHP: 5.2.11



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin2 */;

--
-- Datab�ze: `zbraslavh`
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
('201004132113031271185983', 'Angli�tina rychle, kvalitn� a levn�. Ji� od 185 K�/NS', '<P>Jsme skupina <SPAN style="FONT-WEIGHT: bold">p�ekladatel�</SPAN> a nab�z�me kompletn� servis slu�eb co se t��e p�eklad� do angli�tiny a z angli�tiny.P�eklady do angli�tiny jsme schopni zhotovit velice rychle v r�mci tzv. slu�by - angli�tina on-line (rychl� komunikace internetov�mi kan�ly).M�me bohat� zku�enosti s p�eklady pr�vn�ch, ekonomick�ch, technick�ch a jin�ch text� (jak jednoduch�ch tak i velmi odborn�ch).</P>', 'ne', 'bez', '', '', 'prava', '', '200903'),
('201004142223511271276631', 'D�le nab�z�me tlumo�en� na obchodn�ch jedn�n�ch atd', '<p>Zajist�me kvalitn� slu�by na �zem� �esk� Republiky i v cizin�.Pokud chcete \r\nz�skat kvalitn� slu�by za rozumnou cenu, jsme tu pro V�s - P�eklady \r\nangli�tina.</p>', 'ne', 'bez', '', '', 'prava', '', '200903'),
('201004132043511271184231', 'Pozv�nka na prvn� ro�n�k konference Internet Developer Forum', '<p>IDF 2010 je nov� celodenn� konference od Internet Infa, tentokr�t zam��en� na p�edev��m na webov� v�voj��e a ty, kte�� s nimi p�ich�zej� do styku.</p>', 'ne', 'bez', '', '', 'prava', '', '200903'),
('201004142227421271276862', 'Kniha U�ivatelsky p��v�tiv� rozhran�', '<p><font size="2">Vy�el prvn� �esk� sborn�k text� o interakci �lov�ka s po��ta�em (HCI) a \r\npou�itelnosti u�ivatelsk�ch rozhran�. Jednou kapitolou p�isp�l i Dobr� web.</font></p>', 'ne', 'bez', '', '', 'prava', '', '200903');
