<?php



/**
 * This class defines the structure of the 'player' table.
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
        $this->setName('player');
        $this->setPhpName('Player');
        $this->setClassname('Player');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('mail', 'Mail', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('pCaller', 'Game', RelationMap::ONE_TO_MANY, array('id' => 'call_id', ), 'CASCADE', null, 'pCallers');
        $this->addRelation('pCalled', 'Game', RelationMap::ONE_TO_MANY, array('id' => 'called_id', ), 'CASCADE', null, 'pCalleds');
        $this->addRelation('GamePlayer', 'GamePlayer', RelationMap::ONE_TO_MANY, array('id' => 'player_id', ), 'CASCADE', null, 'GamePlayers');
        $this->addRelation('TournamentPlayer', 'TournamentPlayer', RelationMap::ONE_TO_MANY, array('id' => 'player_id', ), 'CASCADE', null, 'TournamentPlayers');
        $this->addRelation('Bonus', 'Bonus', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Bonuses');
        $this->addRelation('Game', 'Game', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Games');
        $this->addRelation('Tournament', 'Tournament', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Tournaments');
    } // buildRelations()

} // PlayerTableMap
