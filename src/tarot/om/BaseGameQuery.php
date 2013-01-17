<?php


/**
 * Base class that represents a query for the 'game' table.
 *
 *
 *
 * @method GameQuery orderById($order = Criteria::ASC) Order by the id column
 * @method GameQuery orderByCallId($order = Criteria::ASC) Order by the call_id column
 * @method GameQuery orderByCalledId($order = Criteria::ASC) Order by the called_id column
 * @method GameQuery orderByTournamentId($order = Criteria::ASC) Order by the tournament_id column
 * @method GameQuery orderByBids($order = Criteria::ASC) Order by the bids column
 * @method GameQuery orderByScore($order = Criteria::ASC) Order by the score column
 *
 * @method GameQuery groupById() Group by the id column
 * @method GameQuery groupByCallId() Group by the call_id column
 * @method GameQuery groupByCalledId() Group by the called_id column
 * @method GameQuery groupByTournamentId() Group by the tournament_id column
 * @method GameQuery groupByBids() Group by the bids column
 * @method GameQuery groupByScore() Group by the score column
 *
 * @method GameQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GameQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GameQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GameQuery leftJoinTournament($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tournament relation
 * @method GameQuery rightJoinTournament($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tournament relation
 * @method GameQuery innerJoinTournament($relationAlias = null) Adds a INNER JOIN clause to the query using the Tournament relation
 *
 * @method GameQuery leftJoincaller($relationAlias = null) Adds a LEFT JOIN clause to the query using the caller relation
 * @method GameQuery rightJoincaller($relationAlias = null) Adds a RIGHT JOIN clause to the query using the caller relation
 * @method GameQuery innerJoincaller($relationAlias = null) Adds a INNER JOIN clause to the query using the caller relation
 *
 * @method GameQuery leftJoincalled($relationAlias = null) Adds a LEFT JOIN clause to the query using the called relation
 * @method GameQuery rightJoincalled($relationAlias = null) Adds a RIGHT JOIN clause to the query using the called relation
 * @method GameQuery innerJoincalled($relationAlias = null) Adds a INNER JOIN clause to the query using the called relation
 *
 * @method GameQuery leftJoinGamePlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the GamePlayer relation
 * @method GameQuery rightJoinGamePlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GamePlayer relation
 * @method GameQuery innerJoinGamePlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the GamePlayer relation
 *
 * @method Game findOne(PropelPDO $con = null) Return the first Game matching the query
 * @method Game findOneOrCreate(PropelPDO $con = null) Return the first Game matching the query, or a new Game object populated from the query conditions when no match is found
 *
 * @method Game findOneByCallId(int $call_id) Return the first Game filtered by the call_id column
 * @method Game findOneByCalledId(int $called_id) Return the first Game filtered by the called_id column
 * @method Game findOneByTournamentId(int $tournament_id) Return the first Game filtered by the tournament_id column
 * @method Game findOneByBids(string $bids) Return the first Game filtered by the bids column
 * @method Game findOneByScore(int $score) Return the first Game filtered by the score column
 *
 * @method array findById(int $id) Return Game objects filtered by the id column
 * @method array findByCallId(int $call_id) Return Game objects filtered by the call_id column
 * @method array findByCalledId(int $called_id) Return Game objects filtered by the called_id column
 * @method array findByTournamentId(int $tournament_id) Return Game objects filtered by the tournament_id column
 * @method array findByBids(string $bids) Return Game objects filtered by the bids column
 * @method array findByScore(int $score) Return Game objects filtered by the score column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseGameQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGameQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'Game', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GameQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GameQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GameQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GameQuery) {
            return $criteria;
        }
        $query = new GameQuery();
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
     * @return   Game|Game[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GamePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Game A model object, or null if the key is not found
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
     * @return                 Game A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `call_id`, `called_id`, `tournament_id`, `bids`, `score` FROM `game` WHERE `id` = :p0';
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
            $obj = new Game();
            $obj->hydrate($row);
            GamePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Game|Game[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Game[]|mixed the list of results, formatted by the current formatter
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
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GamePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GamePeer::ID, $keys, Criteria::IN);
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
     * @return GameQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GamePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GamePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the call_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCallId(1234); // WHERE call_id = 1234
     * $query->filterByCallId(array(12, 34)); // WHERE call_id IN (12, 34)
     * $query->filterByCallId(array('min' => 12)); // WHERE call_id >= 12
     * $query->filterByCallId(array('max' => 12)); // WHERE call_id <= 12
     * </code>
     *
     * @see       filterBycaller()
     *
     * @param     mixed $callId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByCallId($callId = null, $comparison = null)
    {
        if (is_array($callId)) {
            $useMinMax = false;
            if (isset($callId['min'])) {
                $this->addUsingAlias(GamePeer::CALL_ID, $callId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($callId['max'])) {
                $this->addUsingAlias(GamePeer::CALL_ID, $callId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::CALL_ID, $callId, $comparison);
    }

    /**
     * Filter the query on the called_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCalledId(1234); // WHERE called_id = 1234
     * $query->filterByCalledId(array(12, 34)); // WHERE called_id IN (12, 34)
     * $query->filterByCalledId(array('min' => 12)); // WHERE called_id >= 12
     * $query->filterByCalledId(array('max' => 12)); // WHERE called_id <= 12
     * </code>
     *
     * @see       filterBycalled()
     *
     * @param     mixed $calledId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByCalledId($calledId = null, $comparison = null)
    {
        if (is_array($calledId)) {
            $useMinMax = false;
            if (isset($calledId['min'])) {
                $this->addUsingAlias(GamePeer::CALLED_ID, $calledId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calledId['max'])) {
                $this->addUsingAlias(GamePeer::CALLED_ID, $calledId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::CALLED_ID, $calledId, $comparison);
    }

    /**
     * Filter the query on the tournament_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTournamentId(1234); // WHERE tournament_id = 1234
     * $query->filterByTournamentId(array(12, 34)); // WHERE tournament_id IN (12, 34)
     * $query->filterByTournamentId(array('min' => 12)); // WHERE tournament_id >= 12
     * $query->filterByTournamentId(array('max' => 12)); // WHERE tournament_id <= 12
     * </code>
     *
     * @see       filterByTournament()
     *
     * @param     mixed $tournamentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByTournamentId($tournamentId = null, $comparison = null)
    {
        if (is_array($tournamentId)) {
            $useMinMax = false;
            if (isset($tournamentId['min'])) {
                $this->addUsingAlias(GamePeer::TOURNAMENT_ID, $tournamentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tournamentId['max'])) {
                $this->addUsingAlias(GamePeer::TOURNAMENT_ID, $tournamentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::TOURNAMENT_ID, $tournamentId, $comparison);
    }

    /**
     * Filter the query on the bids column
     *
     * Example usage:
     * <code>
     * $query->filterByBids('fooValue');   // WHERE bids = 'fooValue'
     * $query->filterByBids('%fooValue%'); // WHERE bids LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bids The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByBids($bids = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bids)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bids)) {
                $bids = str_replace('*', '%', $bids);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GamePeer::BIDS, $bids, $comparison);
    }

    /**
     * Filter the query on the score column
     *
     * Example usage:
     * <code>
     * $query->filterByScore(1234); // WHERE score = 1234
     * $query->filterByScore(array(12, 34)); // WHERE score IN (12, 34)
     * $query->filterByScore(array('min' => 12)); // WHERE score >= 12
     * $query->filterByScore(array('max' => 12)); // WHERE score <= 12
     * </code>
     *
     * @param     mixed $score The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByScore($score = null, $comparison = null)
    {
        if (is_array($score)) {
            $useMinMax = false;
            if (isset($score['min'])) {
                $this->addUsingAlias(GamePeer::SCORE, $score['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($score['max'])) {
                $this->addUsingAlias(GamePeer::SCORE, $score['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::SCORE, $score, $comparison);
    }

    /**
     * Filter the query by a related Tournament object
     *
     * @param   Tournament|PropelObjectCollection $tournament The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTournament($tournament, $comparison = null)
    {
        if ($tournament instanceof Tournament) {
            return $this
                ->addUsingAlias(GamePeer::TOURNAMENT_ID, $tournament->getId(), $comparison);
        } elseif ($tournament instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePeer::TOURNAMENT_ID, $tournament->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTournament() only accepts arguments of type Tournament or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tournament relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joinTournament($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tournament');

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
            $this->addJoinObject($join, 'Tournament');
        }

        return $this;
    }

    /**
     * Use the Tournament relation Tournament object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TournamentQuery A secondary query class using the current class as primary query
     */
    public function useTournamentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTournament($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tournament', 'TournamentQuery');
    }

    /**
     * Filter the query by a related Player object
     *
     * @param   Player|PropelObjectCollection $player The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBycaller($player, $comparison = null)
    {
        if ($player instanceof Player) {
            return $this
                ->addUsingAlias(GamePeer::CALL_ID, $player->getId(), $comparison);
        } elseif ($player instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePeer::CALL_ID, $player->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBycaller() only accepts arguments of type Player or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the caller relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joincaller($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('caller');

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
            $this->addJoinObject($join, 'caller');
        }

        return $this;
    }

    /**
     * Use the caller relation Player object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   PlayerQuery A secondary query class using the current class as primary query
     */
    public function usecallerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joincaller($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'caller', 'PlayerQuery');
    }

    /**
     * Filter the query by a related Player object
     *
     * @param   Player|PropelObjectCollection $player The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBycalled($player, $comparison = null)
    {
        if ($player instanceof Player) {
            return $this
                ->addUsingAlias(GamePeer::CALLED_ID, $player->getId(), $comparison);
        } elseif ($player instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePeer::CALLED_ID, $player->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBycalled() only accepts arguments of type Player or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the called relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joincalled($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('called');

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
            $this->addJoinObject($join, 'called');
        }

        return $this;
    }

    /**
     * Use the called relation Player object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   PlayerQuery A secondary query class using the current class as primary query
     */
    public function usecalledQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joincalled($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'called', 'PlayerQuery');
    }

    /**
     * Filter the query by a related GamePlayer object
     *
     * @param   GamePlayer|PropelObjectCollection $gamePlayer  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGamePlayer($gamePlayer, $comparison = null)
    {
        if ($gamePlayer instanceof GamePlayer) {
            return $this
                ->addUsingAlias(GamePeer::ID, $gamePlayer->getGameId(), $comparison);
        } elseif ($gamePlayer instanceof PropelObjectCollection) {
            return $this
                ->useGamePlayerQuery()
                ->filterByPrimaryKeys($gamePlayer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGamePlayer() only accepts arguments of type GamePlayer or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GamePlayer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joinGamePlayer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GamePlayer');

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
            $this->addJoinObject($join, 'GamePlayer');
        }

        return $this;
    }

    /**
     * Use the GamePlayer relation GamePlayer object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GamePlayerQuery A secondary query class using the current class as primary query
     */
    public function useGamePlayerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGamePlayer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GamePlayer', 'GamePlayerQuery');
    }

    /**
     * Filter the query by a related Bonus object
     * using the game_player table as cross reference
     *
     * @param   Bonus $bonus the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GameQuery The current query, for fluid interface
     */
    public function filterByBonus($bonus, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGamePlayerQuery()
            ->filterByBonus($bonus, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Player object
     * using the game_player table as cross reference
     *
     * @param   Player $player the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GameQuery The current query, for fluid interface
     */
    public function filterByPlayer($player, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGamePlayerQuery()
            ->filterByPlayer($player, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Game $game Object to remove from the list of results
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function prune($game = null)
    {
        if ($game) {
            $this->addUsingAlias(GamePeer::ID, $game->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
