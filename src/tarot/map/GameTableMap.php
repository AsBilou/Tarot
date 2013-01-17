<?php



/**
 * This class defines the structure of the 'Game' table.
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
        $this->setName('Game');
        $this->setPhpName('Game');
        $this->setClassname('Game');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('idGame', 'Idgame', 'INTEGER' , 'Game_List', 'idGame', true, null, null);
        $this->addForeignKey('idCall', 'Idcall', 'INTEGER', 'Player', 'idPlayer', true, null, null);
        $this->addForeignKey('idCalled', 'Idcalled', 'INTEGER', 'Player', 'idPlayer', false, null, null);
        $this->addColumn('idTournament', 'Idtournament', 'INTEGER', true, null, null);
        $this->addColumn('bids', 'Bids', 'VARCHAR', true, 255, null);
        $this->addColumn('score', 'Score', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('GameListRelatedByIdgame', 'GameList', RelationMap::MANY_TO_ONE, array('idGame' => 'idGame', ), 'CASCADE', null);
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_ONE, array('idCall' => 'idPlayer', 'idCalled' => 'idPlayer', ), 'CASCADE', null);
        $this->addRelation('GameListRelatedByIdgame', 'GameList', RelationMap::ONE_TO_MANY, array('idGame' => 'idGame', ), 'CASCADE', null, 'GameListsRelatedByIdgame');
        $this->addRelation('Bonus', 'Bonus', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Bonuses');
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Players');
    } // buildRelations()

} // GameTableMap
