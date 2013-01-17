<?php



/**
 * This class defines the structure of the 'Game_List' table.
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
class GameListTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.GameListTableMap';

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
        $this->setName('Game_List');
        $this->setPhpName('GameList');
        $this->setClassname('GameList');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('idGame', 'Idgame', 'INTEGER' , 'Game', 'idGame', true, null, null);
        $this->addForeignPrimaryKey('idPlayer', 'Idplayer', 'INTEGER' , 'Player', 'idPlayer', true, null, null);
        $this->addForeignPrimaryKey('idBonus', 'Idbonus', 'INTEGER' , 'Bonus', 'idBonus', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Bonus', 'Bonus', RelationMap::MANY_TO_ONE, array('idBonus' => 'idBonus', ), 'CASCADE', null);
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_ONE, array('idPlayer' => 'idPlayer', ), 'CASCADE', null);
        $this->addRelation('GameRelatedByIdgame', 'Game', RelationMap::MANY_TO_ONE, array('idGame' => 'idGame', ), 'CASCADE', null);
        $this->addRelation('GameRelatedByIdgame', 'Game', RelationMap::ONE_TO_ONE, array('idGame' => 'idGame', ), 'CASCADE', null);
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Players');
    } // buildRelations()

} // GameListTableMap
