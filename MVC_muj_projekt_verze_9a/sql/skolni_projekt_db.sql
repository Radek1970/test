-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 03. zář 2023, 19:15
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `skolni_projek_db`
--
CREATE DATABASE IF NOT EXISTS `skolni_projek_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;
USE `skolni_projek_db`;
-- --------------------------------------------------------

--
-- Struktura tabulky `kontrakt`
--

CREATE TABLE `kontrakt` (
  `kontrakt_id` int(11) NOT NULL,
  `uzivatel_id` int(11) DEFAULT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `produkt_nazev` varchar(225) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `oddata` text NOT NULL,
  `dodata` text NOT NULL,
  `castka` int(11) NOT NULL,
  `predmet` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `kontrakt`
--

INSERT INTO `kontrakt` (`kontrakt_id`, `uzivatel_id`, `produkt_id`, `produkt_nazev`, `datum`, `oddata`, `dodata`, `castka`, `predmet`) VALUES
(66, 90, 16, 'pojištění uměleckých děl', '2023-08-30 18:58:16', '30.8.2023', '1.12.2023', 70000, 'obraz'),
(67, 90, 3, 'Pojištění vozidla', '2023-08-30 20:34:49', '30.8.2023', '20.7.2024', 70000, 'moped'),
(68, 91, 10, 'penzijní pojištěni', '2023-09-02 12:47:33', '2.9.2023', '1.9.2050', 100000, 'Penzijní pojištění'),
(69, 91, 16, 'pojištění uměleckých děl', '2023-09-02 12:50:43', '10.9.2023', '10.9.2024', 100000, 'van gogh'),
(70, 91, 3, 'Pojištění vozidla', '2023-09-02 12:53:24', '2.9.2023', '2.9.2024', 90000, 'Nissan');

-- --------------------------------------------------------

--
-- Struktura tabulky `produkt`
--

CREATE TABLE `produkt` (
  `pojistka_id` int(11) NOT NULL,
  `druh_pojistky` varchar(255) NOT NULL,
  `nazev` varchar(225) NOT NULL,
  `popis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `produkt`
--

INSERT INTO `produkt` (`pojistka_id`, `druh_pojistky`, `nazev`, `popis`) VALUES
(2, 'cestování', 'cestovní pojištěni v EU', 'Cestovní pojištěni  se vztahuje na státy EU a státy v Schengenském prostoru. Nabízíme i cestovní pojištění s neomezeným krytím léčebných výloh. Limity Vás tedy trápit nemusí. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos voluptatem itaque a odio debitis? Rem totam culpa ex corrupti magnam, quam neque nostrum a aperiam ipsum qui placeat nesciunt alias?'),
(3, 'auto moto', 'Pojištění vozidla', 'Pojistka s povinným ručením a základní asistencí zdarma plus komplexní balíček, který zahrnuje většinu rizik, se kterými se můžete setkat.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit.'),
(10, 'penze', 'penzijní pojištěni', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit.Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio ipsam et necessitatibus non odit modi tempore fugiat tempora facere alias. Explicabo delectus, molestiae reiciendis porro quas rem natus. At, fugit.'),
(16, 'art', 'pojištění uměleckých děl', 'pojištění obrazu, soch, sběratelských sbírek. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos voluptatem itaque a odio debitis? Rem totam culpa ex corrupti magnam, quam neque nostrum a aperiam ipsum qui placeat nesciunt alias?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos voluptatem itaque a odio debitis? Rem totam culpa ex corrupti magnam, quam neque nostrum a aperiam ipsum qui placeat nesciunt alias?Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos voluptatem itaque a odio debitis? Rem totam culpa ex corrupti magnam, quam neque nostrum a aperiam ipsum qui placeat nesciunt alias?');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `uzivatele_id` int(11) NOT NULL,
  `jmeno` varchar(255) NOT NULL,
  `prijmeni` varchar(255) NOT NULL,
  `datum_narozeni` date NOT NULL,
  `email` varchar(225) NOT NULL,
  `telefon` varchar(100) NOT NULL,
  `ulice` varchar(225) NOT NULL,
  `mesto` varchar(225) NOT NULL,
  `psc` int(100) NOT NULL,
  `heslo` varchar(225) NOT NULL,
  `razitko` varchar(100) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `cislo_uctu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`uzivatele_id`, `jmeno`, `prijmeni`, `datum_narozeni`, `email`, `telefon`, `ulice`, `mesto`, `psc`, `heslo`, `razitko`, `admin`, `cislo_uctu`) VALUES
(19, 'Radek', 'Svoboda', '1970-09-10', 'rsb.rsb@seznam.cz', '+420123123123', 'Jahodová 2889/42', 'Praha 10 Zaběhlice 12', 10600, '$2y$10$dbaGJkM1KV1ZU0yLn3iXrunycW1ppgkxeaQWvEpUuQ/GfpJqT7hVm', 'EDIT2023_08_30_18_53_40', 1, '0'),
(90, 'Alfons', 'Mucha', '1930-05-01', 'afm@seznam.cz', '+420332547898', 'U náhonu 252/a2', 'Pardubice', 25622, '$2y$10$cgXFlDFjL75ySp6bsEz.k.chDn1gxlKLnhMOpP1tQgugusZoQn7kq', 'EDIT2023_09_02_12_06_33', 0, '20230830185559744'),
(91, 'Zuzana', 'Fišerová', '1974-04-25', 'zuzana.fiser@gmail.com', '+420776214341', 'Zahradnická 99', 'Strmilov', 37800, '$2y$10$xjbHH52TsmFUbDa4mh9/NOdCbPgEq2h6B.jFffkwYFtE0EohwgO9u', 'EDIT2023_09_02_12_40_36', 0, '20230902123914528'),
(92, 'Petr', 'Vopálka', '1995-06-15', 'pevo@seznam.cz', '+420159456456', 'Dlouhá 5', 'Pardubice', 25800, '$2y$10$qZNIsAqQdl4CSQr7lx7V3emYGzFPKVWo4DYVlwYN46SizqAlfeoeG', '2023_09_03_18_57_36', 0, '20230903185736306'),
(93, 'jana', 'Malá', '1985-05-07', 'janam@gmail.com', '+420784652123', 'Písková', 'Praha 12', 143000, '$2y$10$00TIupZTmqi2EP3XltolmeAyAQMuBcAUnxw8EuS.qyuqC1yc/ezGW', '2023_09_03_18_59_58', 0, '20230903185958492'),
(94, 'Roman', 'Holý', '1978-09-12', 'roho@seznma.cz', '+420456123258', 'Krátká 3', 'Beroun', 36500, '$2y$10$opM1zyrrOk15A.K.NHwTfeGzG9tCEGkr/FGuH7XKAd9ge.uo2MHMS', '2023_09_03_19_01_49', 0, '20230903190149340'),
(95, 'Marcela', 'Kovářová', '1971-08-15', 'mako@seznam.cz', '+42036939123', 'U náhonu 222', 'Benešov', 85000, '$2y$10$a2IWmMi.zlNRff9nvFWUruGb2QvG2U3Rtkg8MvMp1i/njPR/HsZDq', '2023_09_03_19_03_44', 0, '20230903190344853'),
(96, 'Petr', 'Novák', '1965-05-01', 'peno@seznam.cz', '+420365159789', 'Za rohem 23 b2', 'Humpolec', 95033, '$2y$10$NZ0hfn06XgKZKE2lI2UNA.vc4Ho66Et7PiYAUElDpcGEZkeV9dBgi', '2023_09_03_19_05_40', 0, '20230903190540689'),
(97, 'Jan', 'Macháček', '1985-05-08', 'janma@seznam.cz', '+420159789123', 'Krátká 3', 'Kralupy 2', 74000, '$2y$10$6gBZy0WuhJuzs2ppRK5qhuko1fv0zfyHejgAAMwSvQKirylT.Z0yO', '2023_09_03_19_07_31', 0, '20230903190731538'),
(98, 'Blanka', 'Plachá', '1976-08-22', 'blankap@seznam.cz', '+420365123123', 'Vojtěšská 5', 'Praha 1', 11000, '$2y$10$18TiITRwM89rqKxrGGKTW.w1/EI40vpvjM9nXPdZNfxqwJyZiz7jG', '2023_09_03_19_09_23', 0, '20230903190923512'),
(99, 'Norbert', 'Holý', '1973-05-01', 'noho@seznam.cz', '+420369123159', 'U Dubu 3', 'Jihlava', 45000, '$2y$10$n1.wO5AotmKRlm0kIZNRaeLdk48Du.jM4spNYCDGvRJk2PEf2xXDq', '2023_09_03_19_11_49', 0, '20230903191149256'),
(100, 'Michal', 'Dlouhý', '1978-06-05', 'midlo@seznam.cz', '+420123123654', 'Ječná 3', 'Praha 2', 12000, '$2y$10$V2ew3IZd7mLCJZLTolLe..WgLA4.d0w/YN6hONu7aRuZyh5/HPUw2', '2023_09_03_19_13_23', 0, '20230903191323305');
(101, 'Rudolf', 'Suchý', '1979-09-02', 'ruda@gmail.com', '+420369123369', 'U Dubu 3', 'Písek', 25300, '$2y$10$j0bvWbp8YHig49YM7/GBTOebbsX3ACFoTA9zXxPonR1betxfSyiD6', '2023_09_03_19_28_43', 0, '20230903192843374');
--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `kontrakt`
--
ALTER TABLE `kontrakt`
  ADD PRIMARY KEY (`kontrakt_id`);

--
-- Indexy pro tabulku `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`pojistka_id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`uzivatele_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kontrakt`
--
ALTER TABLE `kontrakt`
  MODIFY `kontrakt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pro tabulku `produkt`
--
ALTER TABLE `produkt`
  MODIFY `pojistka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `uzivatele_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
