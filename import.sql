--
-- Contenu de la table `bonus`
--

INSERT INTO `bonus` (`id`, `name`, `value`) VALUES
(0, 'neutral', 0);

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`id`, `call_id`, `called_id`, `tournament_id`, `bids`, `score`) VALUES
(1, 1, 1, 12, 'garde', -10),
(2, 2, 1, 12, 'prise', 15),
(3, 3, 1, 12, 'garde', 12),
(4, 1, 1, 11, 'prise', -12),
(5, 2, 1, 11, 'garde', 14);

--
-- Contenu de la table `game_player`
--

INSERT INTO `game_player` (`game_id`, `player_id`, `bonus_id`, `type`, `score`) VALUES
(1, 3, 0, 'player', '70'),
(1, 8, 0, 'player', '70'),
(1, 9, 0, 'player', '70'),
(1, 1, 0, 'caller', '-140'),
(1, 2, 0, 'called', '-70'),
(2, 1, 0, 'called', '40'),
(2, 3, 0, 'player', '-40'),
(2, 9, 0, 'player', '-40'),
(2, 2, 0, 'caller', '80'),
(2, 8, 0, 'player', '-40'),
(3, 2, 0, 'player', '-74'),
(3, 9, 0, 'player', '-74'),
(3, 10, 0,'player', '-74'),
(3, 1, 0, 'called', '74'),
(3, 3, 0, 'caller', '148');

--
-- Contenu de la table `player`
--

INSERT INTO `player` (`id`, `name`, `mail`) VALUES
(1, 'Bilou', 'bilou@yopmail.com'),
(2, 'Quentin', 'quentin@yopmail.com'),
(3, 'Aurelien', 'aurelien@yopmail.com'),
(10, 'Cedric', 'cedric@yopmail.com'),
(9, 'Julien', 'julien@yopmail.com'),
(8, 'Toto', 'bileu@yeupmeul.ceum');

--
-- Contenu de la table `tournament`
--

INSERT INTO `tournament` (`id`, `start`, `active`, `winner_id`) VALUES
(1, '2013-01-17 09:16:28', 0, 1),
(2, '2013-01-17 09:16:29', 0, 1),
(3, '2013-01-17 09:16:32', 0, 1),
(4, '2013-01-17 09:16:33', 0, 1),
(5, '2013-01-17 09:16:33', 0, 1),
(6, '2013-01-17 09:16:33', 0, 1),
(7, '2013-01-17 09:16:33', 0, 1),
(8, '2013-01-17 09:16:44', 0, 1),
(9, '2013-01-17 09:18:17', 0, 1),
(10, '2013-01-17 09:41:32', 0, 1),
(11, '2013-01-17 09:41:55', 0, 1),
(12, '2013-01-17 09:41:56', 1, 1);

--
-- Contenu de la table `tournament_player`
--

INSERT INTO `tournament_player` (`tournament_id`, `player_id`, `score`) VALUES
(12, 1, -26),
(12, 2, -64),
(12, 3, 178),
(12, 8, 30),
(12, 9, -44),
(12, 10, -74);