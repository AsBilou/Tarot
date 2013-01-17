<?php


/**
 * Base class that represents a query for the 'tournament' table.
 *
 *
 *
 * @method TournamentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TournamentQuery orderByStart($order = Criteria::ASC) Order by the start column
 * @method TournamentQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method TournamentQuery orderByWinnerId($order = Criteria::ASC) Order by the winner_id column
 *
 * @method TournamentQuery groupById() Group by the id column
 * @method TournamentQuery groupByStart() Group by the start column
 * @method TournamentQuery groupByActive() Group by the active column
 * @method TournamentQuery groupByWinnerId() Group by the winner_id column
 *
 * @method TournamentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TournamentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TournamentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TournamentQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method TournamentQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method TournamentQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method TournamentQuery leftJoinTournamentPlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TournamentPlayer relation
 * @method TournamentQuery rightJoinTournamentPlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TournamentPlayer relation
 * @method TournamentQuery innerJoinTournamentPlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the TournamentPlayer relation
 *
 * @method Tournament findOne(PropelPDO $con = null) Return the first Tournament matching the query
 * @method Tournament findOneOrCreate(PropelPDO $con = null) Return the first Tournament matching the query, or a new Tournament object populated from the query conditions when no match is found
 *
 * @method Tournament findOneByStart(string $start) Return the first Tournament filtered by the start column
 * @method Tournament findOneByActive(boolean $active) Return the first Tournament filtered by the active column
 * @method Tournament findOneByWinnerId(int $winner_id) Return the first Tournament filtered by the winner_id column
 *
 * @method array findById(int $id) Return Tournament objects filtered by the id column
 * @method array findByStart(string $start) Return Tournament objects filtered by the start column
 * @method array findByActive(boolean $active) Return Tournament objects filtered by the active column
 * @method array findByWinnerId(int $winner_id) Return Tournament objects filtered by the winner_id column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseTournamentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTournamentQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'Tournament', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TournamentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TournamentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TournamentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TournamentQuery) {
            return $criteria;
        }
        $query = new TournamentQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Tournament|Tournament[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TournamentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TournamentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Tournament A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Tournament A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `start`, `active`, `winner_id` FROM `tournament` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Tournament();
            $obj->hydrate($row);
            TournamentPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Tournament|Tournament[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Tournament[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TournamentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TournamentPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TournamentPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TournamentPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart('2011-03-14'); // WHERE start = '2011-03-14'
     * $query->filterByStart('now'); // WHERE start = '2011-03-14'
     * $query->filterByStart(array('max' => 'yesterday')); // WHERE start > '2011-03-13'
     * </code>
     *
     * @param     mixed $start The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (is_array($start)) {
            $useMinMax = false;
            if (isset($start['min'])) {
                $this->addUsingAlias(TournamentPeer::START, $start['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($start['max'])) {
                $this->addUsingAlias(TournamentPeer::START, $start['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentPeer::START, $start, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TournamentPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the winner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByWinnerId(1234); // WHERE winner_id = 1234
     * $query->filterByWinnerId(array(12, 34)); // WHERE winner_id IN (12, 34)
     * $query->filterByWinnerId(array('min' => 12)); // WHERE winner_id >= 12
     * $query->filterByWinnerId(array('max' => 12)); // WHERE winner_id <= 12
     * </code>
     *
     * @param     mixed $winnerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function filterByWinnerId($winnerId = null, $comparison = null)
    {
        if (is_array($winnerId)) {
            $useMinMax = false;
            if (isset($winnerId['min'])) {
                $this->addUsingAlias(TournamentPeer::WINNER_ID, $winnerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($winnerId['max'])) {
                $this->addUsingAlias(TournamentPeer::WINNER_ID, $winnerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TournamentPeer::WINNER_ID, $winnerId, $comparison);
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TournamentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(TournamentPeer::ID, $game->getTournamentId(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            return $this
                ->useGameQuery()
                ->filterByPrimaryKeys($game->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGame() only accepts arguments of type Game or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Game relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function joinGame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Game');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Game');
        }

        return $this;
    }

    /**
     * Use the Game relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameQuery A secondary query class using the current class as primary query
     */
    public function useGameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Game', 'GameQuery');
    }

    /**
     * Filter the query by a related TournamentPlayer object
     *
     * @param   TournamentPlayer|PropelObjectCollection $tournamentPlayer  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TournamentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTournamentPlayer($tournamentPlayer, $comparison = null)
    {
        if ($tournamentPlayer instanceof TournamentPlayer) {
            return $this
                ->addUsingAlias(TournamentPeer::ID, $tournamentPlayer->getTournamentId(), $comparison);
        } elseif ($tournamentPlayer instanceof PropelObjectCollection) {
            return $this
                ->useTournamentPlayerQuery()
                ->filterByPrimaryKeys($tournamentPlayer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTournamentPlayer() only accepts arguments of type TournamentPlayer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TournamentPlayer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function joinTournamentPlayer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TournamentPlayer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'TournamentPlayer');
        }

        return $this;
    }

    /**
     * Use the TournamentPlayer relation TournamentPlayer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TournamentPlayerQuery A secondary query class using the current class as primary query
     */
    public function useTournamentPlayerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTournamentPlayer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TournamentPlayer', 'TournamentPlayerQuery');
    }

    /**
     * Filter the query by a related Player object
     * using the tournament_player table as cross reference
     *
     * @param   Player $player the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TournamentQuery The current query, for fluid interface
     */
    public function filterByPlayer($player, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useTournamentPlayerQuery()
            ->filterByPlayer($player, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Tournament $tournament Object to remove from the list of results
     *
     * @return TournamentQuery The current query, for fluid interface
     */
    public function prune($tournament = null)
    {
        if ($tournament) {
            $this->addUsingAlias(TournamentPeer::ID, $tournament->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
