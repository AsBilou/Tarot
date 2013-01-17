
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Player
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Player`;

CREATE TABLE `Player`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `namePlayer` VARCHAR(255) NOT NULL,
    `mailPlayer` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Bonus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Bonus`;

CREATE TABLE `Bonus`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nameBonus` VARCHAR(255) NOT NULL,
    `valueBonus` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Tournament
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Tournament`;

CREATE TABLE `Tournament`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `dateStart` DATETIME NOT NULL,
    `active` TINYINT(1) NOT NULL,
    `idWinner` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `Tournament_FI_1` (`idWinner`),
    CONSTRAINT `Tournament_FK_1`
        FOREIGN KEY (`idWinner`)
        REFERENCES `Player` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Game
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Game`;

CREATE TABLE `Game`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `idCall` INTEGER NOT NULL,
    `idCalled` INTEGER,
    `idTournament` INTEGER NOT NULL,
    `bids` VARCHAR(255) NOT NULL,
    `score` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `Game_FI_1` (`idTournament`),
    INDEX `Game_FI_2` (`idCall`, `idCalled`),
    CONSTRAINT `Game_FK_1`
        FOREIGN KEY (`idTournament`)
        REFERENCES `Tournament` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `Game_FK_2`
        FOREIGN KEY (`idCall`,`idCalled`)
        REFERENCES `Player` (`id`,`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Game_List
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Game_List`;

CREATE TABLE `Game_List`
(
    `idGame` INTEGER NOT NULL,
    `idPlayer` INTEGER NOT NULL,
    `idBonus` INTEGER NOT NULL,
    PRIMARY KEY (`idGame`,`idPlayer`,`idBonus`),
    INDEX `Game_List_FI_1` (`idBonus`),
    INDEX `Game_List_FI_2` (`idPlayer`),
    CONSTRAINT `Game_List_FK_1`
        FOREIGN KEY (`idBonus`)
        REFERENCES `Bonus` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `Game_List_FK_2`
        FOREIGN KEY (`idPlayer`)
        REFERENCES `Player` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `Game_List_FK_3`
        FOREIGN KEY (`idGame`)
        REFERENCES `Game` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- Score_Tournament
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Score_Tournament`;

CREATE TABLE `Score_Tournament`
(
    `idTournament` INTEGER NOT NULL,
    `idPlayer` INTEGER NOT NULL,
    `score` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`idTournament`,`idPlayer`),
    INDEX `Score_Tournament_FI_2` (`idPlayer`),
    CONSTRAINT `Score_Tournament_FK_1`
        FOREIGN KEY (`idTournament`)
        REFERENCES `Tournament` (`id`)
        ON DELETE CASCADE,
    CONSTRAINT `Score_Tournament_FK_2`
        FOREIGN KEY (`idPlayer`)
        REFERENCES `Player` (`id`)
        ON DELETE CASCADE
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
