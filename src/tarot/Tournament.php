<?php



/**
 * Skeleton subclass for representing a row from the 'tournament' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tarot
 */
class Tournament extends BaseTournament
{
    public function getOrderedPlayers() {
        $query = PlayerQuery::create()
            ->orderByName();
        return parent::getPlayers($query);
    }
}
