<?php



/**
 * This class defines the structure of the 'tournament_player' table.
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
class TournamentPlayerTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.TournamentPlayerTableMap';

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
        $this->setName('tournament_player');
        $this->setPhpName('TournamentPlayer');
        $this->setClassname('TournamentPlayer');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('tournament_id', 'TournamentId', 'INTEGER' , 'tournament', 'id', true, null, null);
        $this->addForeignPrimaryKey('player_id', 'PlayerId', 'INTEGER' , 'player', 'id', true, null, null);
        $this->addColumn('score', 'Score', 'INTEGER', true, null, 0);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Tournament', 'Tournament', RelationMap::MANY_TO_ONE, array('tournament_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Player', 'Player', RelationMap::MANY_TO_ONE, array('player_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // TournamentPlayerTableMap
