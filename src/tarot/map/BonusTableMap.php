<?php



/**
 * This class defines the structure of the 'Bonus' table.
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
class BonusTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.BonusTableMap';

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
        $this->setName('Bonus');
        $this->setPhpName('Bonus');
        $this->setClassname('Bonus');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('idBonus', 'Idbonus', 'INTEGER', true, null, null);
        $this->addColumn('nameBonus', 'Namebonus', 'VARCHAR', true, 255, null);
        $this->addColumn('valueBonus', 'Valuebonus', 'INTEGER', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('GameList', 'GameList', RelationMap::ONE_TO_MANY, array('idBonus' => 'idBonus', ), 'CASCADE', null, 'GameLists');
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Players');
        $this->addRelation('GameRelatedByIdgame', 'Game', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'GamesRelatedByIdgame');
    } // buildRelations()

} // BonusTableMap
