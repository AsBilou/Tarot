
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- player
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `player`;

CREATE TABLE `player`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `mail` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- bonus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bonus`;

CREATE TABLE `bonus`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `value` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tournament
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tournament`;

CREATE TABLE `tournament`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `start` DATETIME NOT NULL,
    `active` TINYINT(1) NOT NULL,
    `winner_id` INTEGER,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- game
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `call_id` INTEGER NOT NULL,
    `called_id` INTEGER,
    `tournament_id` INTEGER NOT NULL,
    `bids` VARCHAR(255) NOT NULL,
    `score` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `game_FI_1` (`tournament_id`),
    INDEX `game_FI_2` (`call_id`),
    INDEX `game_FI_3` (`called_id`),
    CONSTRAINT `game_FK_1`
        FOREIGN KEY (`tournament_id`)
        REFERENCES `tournament` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `game_FK_2`
        FOREIGN KEY (`call_id`)
        REFERENCES `player` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `game_FK_3`
        FOREIGN KEY (`called_id`)
        REFERENCES `player` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- game_player
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `game_player`;

CREATE TABLE `game_player`
(
    `game_id` INTEGER NOT NULL,
    `player_id` INTEGER NOT NULL,
    `bonus_id` INTEGER NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `score` INTEGER(255) NOT NULL,
    PRIMARY KEY (`game_id`,`player_id`,`bonus_id`),
    INDEX `game_player_FI_1` (`bonus_id`),
    INDEX `game_player_FI_2` (`player_id`),
    CONSTRAINT `game_player_FK_1`
        FOREIGN KEY (`bonus_id`)
        REFERENCES `bonus` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `game_player_FK_2`
        FOREIGN KEY (`player_id`)
        REFERENCES `player` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `game_player_FK_3`
        FOREIGN KEY (`game_id`)
        REFERENCES `game` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tournament_player
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tournament_player`;

CREATE TABLE `tournament_player`
(
    `tournament_id` INTEGER NOT NULL,
    `player_id` INTEGER NOT NULL,
    `score` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`tournament_id`,`player_id`),
    INDEX `tournament_player_FI_2` (`player_id`),
    CONSTRAINT `tournament_player_FK_1`
        FOREIGN KEY (`tournament_id`)
        REFERENCES `tournament` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `tournament_player_FK_2`
        FOREIGN KEY (`player_id`)
        REFERENCES `player` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
