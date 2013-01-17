<?php


/**
 * Base class that represents a query for the 'player' table.
 *
 *
 *
 * @method PlayerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PlayerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method PlayerQuery orderByMail($order = Criteria::ASC) Order by the mail column
 *
 * @method PlayerQuery groupById() Group by the id column
 * @method PlayerQuery groupByName() Group by the name column
 * @method PlayerQuery groupByMail() Group by the mail column
 *
 * @method PlayerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PlayerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PlayerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PlayerQuery leftJoinpCaller($relationAlias = null) Adds a LEFT JOIN clause to the query using the pCaller relation
 * @method PlayerQuery rightJoinpCaller($relationAlias = null) Adds a RIGHT JOIN clause to the query using the pCaller relation
 * @method PlayerQuery innerJoinpCaller($relationAlias = null) Adds a INNER JOIN clause to the query using the pCaller relation
 *
 * @method PlayerQuery leftJoinpCalled($relationAlias = null) Adds a LEFT JOIN clause to the query using the pCalled relation
 * @method PlayerQuery rightJoinpCalled($relationAlias = null) Adds a RIGHT JOIN clause to the query using the pCalled relation
 * @method PlayerQuery innerJoinpCalled($relationAlias = null) Adds a INNER JOIN clause to the query using the pCalled relation
 *
 * @method PlayerQuery leftJoinGamePlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the GamePlayer relation
 * @method PlayerQuery rightJoinGamePlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GamePlayer relation
 * @method PlayerQuery innerJoinGamePlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the GamePlayer relation
 *
 * @method PlayerQuery leftJoinTournamentPlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the TournamentPlayer relation
 * @method PlayerQuery rightJoinTournamentPlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TournamentPlayer relation
 * @method PlayerQuery innerJoinTournamentPlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the TournamentPlayer relation
 *
 * @method Player findOne(PropelPDO $con = null) Return the first Player matching the query
 * @method Player findOneOrCreate(PropelPDO $con = null) Return the first Player matching the query, or a new Player object populated from the query conditions when no match is found
 *
 * @method Player findOneByName(string $name) Return the first Player filtered by the name column
 * @method Player findOneByMail(string $mail) Return the first Player filtered by the mail column
 *
 * @method array findById(int $id) Return Player objects filtered by the id column
 * @method array findByName(string $name) Return Player objects filtered by the name column
 * @method array findByMail(string $mail) Return Player objects filtered by the mail column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BasePlayerQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePlayerQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'Player', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PlayerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PlayerQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PlayerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PlayerQuery) {
            return $criteria;
        }
        $query = new PlayerQuery();
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
     * @return   Player|Player[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PlayerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PlayerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Player A model object, or null if the key is not found
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
     * @return                 Player A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `mail` FROM `player` WHERE `id` = :p0';
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
            $obj = new Player();
            $obj->hydrate($row);
            PlayerPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Player|Player[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Player[]|mixed the list of results, formatted by the current formatter
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
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlayerPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlayerPeer::ID, $keys, Criteria::IN);
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
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PlayerPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PlayerPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlayerPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the mail column
     *
     * Example usage:
     * <code>
     * $query->filterByMail('fooValue');   // WHERE mail = 'fooValue'
     * $query->filterByMail('%fooValue%'); // WHERE mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function filterByMail($mail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mail)) {
                $mail = str_replace('*', '%', $mail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlayerPeer::MAIL, $mail, $comparison);
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBypCaller($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(PlayerPeer::ID, $game->getCallId(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            return $this
                ->usepCallerQuery()
                ->filterByPrimaryKeys($game->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBypCaller() only accepts arguments of type Game or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the pCaller relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function joinpCaller($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('pCaller');

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
            $this->addJoinObject($join, 'pCaller');
        }

        return $this;
    }

    /**
     * Use the pCaller relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameQuery A secondary query class using the current class as primary query
     */
    public function usepCallerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinpCaller($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'pCaller', 'GameQuery');
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBypCalled($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(PlayerPeer::ID, $game->getCalledId(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            return $this
                ->usepCalledQuery()
                ->filterByPrimaryKeys($game->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBypCalled() only accepts arguments of type Game or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the pCalled relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function joinpCalled($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('pCalled');

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
            $this->addJoinObject($join, 'pCalled');
        }

        return $this;
    }

    /**
     * Use the pCalled relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameQuery A secondary query class using the current class as primary query
     */
    public function usepCalledQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinpCalled($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'pCalled', 'GameQuery');
    }

    /**
     * Filter the query by a related GamePlayer object
     *
     * @param   GamePlayer|PropelObjectCollection $gamePlayer  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGamePlayer($gamePlayer, $comparison = null)
    {
        if ($gamePlayer instanceof GamePlayer) {
            return $this
                ->addUsingAlias(PlayerPeer::ID, $gamePlayer->getPlayerId(), $comparison);
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
     * @return PlayerQuery The current query, for fluid interface
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
     * Filter the query by a related TournamentPlayer object
     *
     * @param   TournamentPlayer|PropelObjectCollection $tournamentPlayer  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTournamentPlayer($tournamentPlayer, $comparison = null)
    {
        if ($tournamentPlayer instanceof TournamentPlayer) {
            return $this
                ->addUsingAlias(PlayerPeer::ID, $tournamentPlayer->getPlayerId(), $comparison);
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
     * @return PlayerQuery The current query, for fluid interface
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
     * Filter the query by a related Bonus object
     * using the game_player table as cross reference
     *
     * @param   Bonus $bonus the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlayerQuery The current query, for fluid interface
     */
    public function filterByBonus($bonus, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGamePlayerQuery()
            ->filterByBonus($bonus, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Game object
     * using the game_player table as cross reference
     *
     * @param   Game $game the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlayerQuery The current query, for fluid interface
     */
    public function filterByGame($game, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGamePlayerQuery()
            ->filterByGame($game, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Tournament object
     * using the tournament_player table as cross reference
     *
     * @param   Tournament $tournament the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PlayerQuery The current query, for fluid interface
     */
    public function filterByTournament($tournament, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useTournamentPlayerQuery()
            ->filterByTournament($tournament, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Player $player Object to remove from the list of results
     *
     * @return PlayerQuery The current query, for fluid interface
     */
    public function prune($player = null)
    {
        if ($player) {
            $this->addUsingAlias(PlayerPeer::ID, $player->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
