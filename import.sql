--
-- Contenu de la table `Game`
--

INSERT INTO `Game` (`id`, `idCall`, `idCalled`, `idTournament`, `bids`, `score`) VALUES
(1, 1, 2, 12, 'garde', -10),
(2, 2, 8, 12, 'prise', 15),
(3, 3, 1, 12, 'garde', 12);

--
-- Contenu de la table `Game_List`
--

INSERT INTO `Game_List` (`idGame`, `idPlayer`, `idBonus`) VALUES
(1, 3, 0),
(1, 8, 0),
(1, 9, 0),
(2, 1, 0),
(2, 3, 0),
(2, 9, 0),
(3, 2, 0),
(3, 9, 0),
(3, 10, 0);

--
-- Contenu de la table `Player`
--

INSERT INTO `Player` (`id`, `namePlayer`, `mailPlayer`) VALUES
(1, 'Bilou', 'bilou@yopmail.com'),
(2, 'Quentin', 'quentin@yopmail.com'),
(3, 'Aurelien', 'aurelien@yopmail.com'),
(10, 'cedric', 'cedric@yopmail.com'),
(9, 'Julien', 'julien@yopmail.com'),
(8, 'Bileu belleuneu', 'bileu@yeupmeul.ceum');

--
-- Contenu de la table `Tournament`
--

INSERT INTO `Tournament` (`id`, `dateStart`, `active`) VALUES
(1, '2013-01-17 09:16:28', 0),
(2, '2013-01-17 09:16:29', 0),
(3, '2013-01-17 09:16:32', 0),
(4, '2013-01-17 09:16:33', 0),
(5, '2013-01-17 09:16:33', 0),
(6, '2013-01-17 09:16:33', 0),
(7, '2013-01-17 09:16:33', 0),
(8, '2013-01-17 09:16:44', 0),
(9, '2013-01-17 09:18:17', 0),
(10, '2013-01-17 09:41:32', 0),
(11, '2013-01-17 09:41:55', 0),
(12, '2013-01-17 09:41:56', 1);
