<?php



/**
 * This class defines the structure of the 'game' table.
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
class GameTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.GameTableMap';

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
        $this->setName('game');
        $this->setPhpName('Game');
        $this->setClassname('Game');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('call_id', 'CallId', 'INTEGER', 'player', 'id', true, null, null);
        $this->addForeignKey('called_id', 'CalledId', 'INTEGER', 'player', 'id', false, null, null);
        $this->addForeignKey('tournament_id', 'TournamentId', 'INTEGER', 'tournament', 'id', true, null, null);
        $this->addColumn('bids', 'Bids', 'VARCHAR', true, 255, null);
        $this->addColumn('score', 'Score', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Tournament', 'Tournament', RelationMap::MANY_TO_ONE, array('tournament_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('caller', 'Player', RelationMap::MANY_TO_ONE, array('call_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('called', 'Player', RelationMap::MANY_TO_ONE, array('called_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('GamePlayer', 'GamePlayer', RelationMap::ONE_TO_MANY, array('id' => 'game_id', ), 'CASCADE', null, 'GamePlayers');
        $this->addRelation('Bonus', 'Bonus', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Bonuses');
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Players');
    } // buildRelations()

} // GameTableMap
