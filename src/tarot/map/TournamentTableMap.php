<?php



/**
 * This class defines the structure of the 'Tournament' table.
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
class TournamentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'tarot.map.TournamentTableMap';

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
        $this->setName('Tournament');
        $this->setPhpName('Tournament');
        $this->setClassname('Tournament');
        $this->setPackage('tarot');
        $this->setUseIdGenerator(true);
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('idTournament', 'Idtournament', 'INTEGER', true, null, null);
        $this->addColumn('dateStart', 'Datestart', 'TIMESTAMP', true, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // TournamentTableMap
