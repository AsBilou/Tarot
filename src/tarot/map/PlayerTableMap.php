<?php



/**
 * This class defines the structure of the 'Player' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.tarot.map
 */
class PlayerTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.PlayerTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Player');
        $this->setPhpName('Player');
        $this->setClassname('Player');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('namePlayer', 'Nameplayer', 'VARCHAR', true, 255, null);
        $this->addColumn('mailPlayer', 'Mailplayer', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Tournament', 'Tournament', RelationMap::ONE_TO_MANY, array('id' => 'idWinner', ), 'CASCADE', null, 'Tournaments');
        $this->addRelation('Game', 'Game', RelationMap::ONE_TO_MANY, array('id' => 'idCalled', ), 'CASCADE', null, 'Games');
        $this->addRelation('GameList', 'GameList', RelationMap::ONE_TO_MANY, array('id' => 'idPlayer', ), 'CASCADE', null, 'GameLists');
        $this->addRelation('ScoreTournament', 'ScoreTournament', RelationMap::ONE_TO_MANY, array('id' => 'idPlayer', ), 'CASCADE', null, 'ScoreTournaments');
        $this->addRelation('Tournament', 'Tournament', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Tournaments');
        $this->addRelation('Bonus', 'Bonus', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Bonuses');
        $this->addRelation('Game', 'Game', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Games');
        $this->addRelation('Tournament', 'Tournament', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Tournaments');
    } // buildRelations()

} // PlayerTableMap
