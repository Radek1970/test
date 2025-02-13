--
-- Struktura tabulky `seznam`
--

CREATE TABLE `seznam` (
  `id` int(11) NOT NULL,
  `skupina` varchar(255) NOT NULL,
  `zanr` varchar(255) NOT NULL,
  `nazev` varchar(225) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `rok` year(4) NOT NULL DEFAULT current_timestamp(),
  `popis` text NOT NULL,
  `stav` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


--
-- Indexy pro tabulku `seznam`
--
  ALTER TABLE `seznam`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT pro tabulku `produkt`
--
  ALTER TABLE `seznam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO seznam (skupina, zanr, nazev, autor, rok, popis, stav, statut)VALUES
('CD', 'Rock and Pop', 'The Album 1', 'John Doe', '2005', 'Great rock music - Lorem ipsum doio ipsam et necessitatibus non', '', 1),
('KNIHA', 'Mystery', 'The Mystery Book 3', 'Alice Johnson', '2018', 'A mysterious novel.', 'New', 2),
('KNIHA', 'Science Fiction', 'Future World 6', 'Eva White', '2012', 'An epic sci-fi adventure.', 'Like New', 2),
('CD', 'Jazz', 'Smooth Jazz 10', 'Michael Davis', '2007', 'Relaxing jazz melodies.', 'Very Good', 2),
('CD', 'pop', 'Manéž', 'Abraxas', '1989', 'druhá deska', '', 1),
('DVD', 'detektivka', 'Vím že jsi vrah', 'Vávra', '1960', 'retro', '', 1),
('CD', 'Rock', 'Hells bells', 'AC/DC', '1982', 'rock clasic', '', 1),
('DVD', 'komedie', 'Slunce, seno a jahody', 'Troška', '1989', 'česká komedie', '', 1),
('CD', 'Rock and Pop', 'test22', 'Troška', '2023', '', '', 1),
('DVD', 'komedie', 'Slunce, seno a pár facek', 'Troška', '1995', 'česká komedie druhý díl.', '', 1);