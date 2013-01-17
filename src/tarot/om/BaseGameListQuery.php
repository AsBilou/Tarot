<?php


/**
 * Base class that represents a query for the 'Game_List' table.
 *
 *
 *
 * @method GameListQuery orderByIdgame($order = Criteria::ASC) Order by the idGame column
 * @method GameListQuery orderByIdplayer($order = Criteria::ASC) Order by the idPlayer column
 * @method GameListQuery orderByIdbonus($order = Criteria::ASC) Order by the idBonus column
 *
 * @method GameListQuery groupByIdgame() Group by the idGame column
 * @method GameListQuery groupByIdplayer() Group by the idPlayer column
 * @method GameListQuery groupByIdbonus() Group by the idBonus column
 *
 * @method GameListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GameListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GameListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GameListQuery leftJoinBonus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bonus relation
 * @method GameListQuery rightJoinBonus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bonus relation
 * @method GameListQuery innerJoinBonus($relationAlias = null) Adds a INNER JOIN clause to the query using the Bonus relation
 *
 * @method GameListQuery leftJoinPlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Player relation
 * @method GameListQuery rightJoinPlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Player relation
 * @method GameListQuery innerJoinPlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the Player relation
 *
 * @method GameListQuery leftJoinGameRelatedByIdgame($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameRelatedByIdgame relation
 * @method GameListQuery rightJoinGameRelatedByIdgame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameRelatedByIdgame relation
 * @method GameListQuery innerJoinGameRelatedByIdgame($relationAlias = null) Adds a INNER JOIN clause to the query using the GameRelatedByIdgame relation
 *
 * @method GameListQuery leftJoinGameRelatedByIdgame($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameRelatedByIdgame relation
 * @method GameListQuery rightJoinGameRelatedByIdgame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameRelatedByIdgame relation
 * @method GameListQuery innerJoinGameRelatedByIdgame($relationAlias = null) Adds a INNER JOIN clause to the query using the GameRelatedByIdgame relation
 *
 * @method GameList findOne(PropelPDO $con = null) Return the first GameList matching the query
 * @method GameList findOneOrCreate(PropelPDO $con = null) Return the first GameList matching the query, or a new GameList object populated from the query conditions when no match is found
 *
 * @method GameList findOneByIdgame(int $idGame) Return the first GameList filtered by the idGame column
 * @method GameList findOneByIdplayer(int $idPlayer) Return the first GameList filtered by the idPlayer column
 * @method GameList findOneByIdbonus(int $idBonus) Return the first GameList filtered by the idBonus column
 *
 * @method array findByIdgame(int $idGame) Return GameList objects filtered by the idGame column
 * @method array findByIdplayer(int $idPlayer) Return GameList objects filtered by the idPlayer column
 * @method array findByIdbonus(int $idBonus) Return GameList objects filtered by the idBonus column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseGameListQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGameListQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'GameList', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GameListQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GameListQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GameListQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GameListQuery) {
            return $criteria;
        }
        $query = new GameListQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$idGame, $idPlayer, $idBonus]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   GameList|GameList[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GameListPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GameListPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 GameList A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `idGame`, `idPlayer`, `idBonus` FROM `Game_List` WHERE `idGame` = :p0 AND `idPlayer` = :p1 AND `idBonus` = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new GameList();
            $obj->hydrate($row);
            GameListPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return GameList|GameList[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|GameList[]|mixed the list of results, formatted by the current formatter
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
     * @return GameListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(GameListPeer::IDGAME, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(GameListPeer::IDPLAYER, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(GameListPeer::IDBONUS, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(GameListPeer::IDGAME, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(GameListPeer::IDPLAYER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(GameListPeer::IDBONUS, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the idGame column
     *
     * Example usage:
     * <code>
     * $query->filterByIdgame(1234); // WHERE idGame = 1234
     * $query->filterByIdgame(array(12, 34)); // WHERE idGame IN (12, 34)
     * $query->filterByIdgame(array('min' => 12)); // WHERE idGame >= 12
     * $query->filterByIdgame(array('max' => 12)); // WHERE idGame <= 12
     * </code>
     *
     * @see       filterByGameRelatedByIdgame()
     *
     * @param     mixed $idgame The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function filterByIdgame($idgame = null, $comparison = null)
    {
        if (is_array($idgame)) {
            $useMinMax = false;
            if (isset($idgame['min'])) {
                $this->addUsingAlias(GameListPeer::IDGAME, $idgame['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idgame['max'])) {
                $this->addUsingAlias(GameListPeer::IDGAME, $idgame['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameListPeer::IDGAME, $idgame, $comparison);
    }

    /**
     * Filter the query on the idPlayer column
     *
     * Example usage:
     * <code>
     * $query->filterByIdplayer(1234); // WHERE idPlayer = 1234
     * $query->filterByIdplayer(array(12, 34)); // WHERE idPlayer IN (12, 34)
     * $query->filterByIdplayer(array('min' => 12)); // WHERE idPlayer >= 12
     * $query->filterByIdplayer(array('max' => 12)); // WHERE idPlayer <= 12
     * </code>
     *
     * @see       filterByPlayer()
     *
     * @param     mixed $idplayer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function filterByIdplayer($idplayer = null, $comparison = null)
    {
        if (is_array($idplayer)) {
            $useMinMax = false;
            if (isset($idplayer['min'])) {
                $this->addUsingAlias(GameListPeer::IDPLAYER, $idplayer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idplayer['max'])) {
                $this->addUsingAlias(GameListPeer::IDPLAYER, $idplayer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameListPeer::IDPLAYER, $idplayer, $comparison);
    }

    /**
     * Filter the query on the idBonus column
     *
     * Example usage:
     * <code>
     * $query->filterByIdbonus(1234); // WHERE idBonus = 1234
     * $query->filterByIdbonus(array(12, 34)); // WHERE idBonus IN (12, 34)
     * $query->filterByIdbonus(array('min' => 12)); // WHERE idBonus >= 12
     * $query->filterByIdbonus(array('max' => 12)); // WHERE idBonus <= 12
     * </code>
     *
     * @see       filterByBonus()
     *
     * @param     mixed $idbonus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function filterByIdbonus($idbonus = null, $comparison = null)
    {
        if (is_array($idbonus)) {
            $useMinMax = false;
            if (isset($idbonus['min'])) {
                $this->addUsingAlias(GameListPeer::IDBONUS, $idbonus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idbonus['max'])) {
                $this->addUsingAlias(GameListPeer::IDBONUS, $idbonus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameListPeer::IDBONUS, $idbonus, $comparison);
    }

    /**
     * Filter the query by a related Bonus object
     *
     * @param   Bonus|PropelObjectCollection $bonus The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameListQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBonus($bonus, $comparison = null)
    {
        if ($bonus instanceof Bonus) {
            return $this
                ->addUsingAlias(GameListPeer::IDBONUS, $bonus->getIdbonus(), $comparison);
        } elseif ($bonus instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameListPeer::IDBONUS, $bonus->toKeyValue('PrimaryKey', 'Idbonus'), $comparison);
        } else {
            throw new PropelException('filterByBonus() only accepts arguments of type Bonus or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bonus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function joinBonus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bonus');

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
            $this->addJoinObject($join, 'Bonus');
        }

        return $this;
    }

    /**
     * Use the Bonus relation Bonus object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   BonusQuery A secondary query class using the current class as primary query
     */
    public function useBonusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bonus', 'BonusQuery');
    }

    /**
     * Filter the query by a related Player object
     *
     * @param   Player|PropelObjectCollection $player The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameListQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlayer($player, $comparison = null)
    {
        if ($player instanceof Player) {
            return $this
                ->addUsingAlias(GameListPeer::IDPLAYER, $player->getIdplayer(), $comparison);
        } elseif ($player instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameListPeer::IDPLAYER, $player->toKeyValue('PrimaryKey', 'Idplayer'), $comparison);
        } else {
            throw new PropelException('filterByPlayer() only accepts arguments of type Player or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Player relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function joinPlayer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Player');

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
            $this->addJoinObject($join, 'Player');
        }

        return $this;
    }

    /**
     * Use the Player relation Player object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   PlayerQuery A secondary query class using the current class as primary query
     */
    public function usePlayerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlayer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Player', 'PlayerQuery');
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameListQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGameRelatedByIdgame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(GameListPeer::IDGAME, $game->getIdgame(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameListPeer::IDGAME, $game->toKeyValue('PrimaryKey', 'Idgame'), $comparison);
        } else {
            throw new PropelException('filterByGameRelatedByIdgame() only accepts arguments of type Game or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameRelatedByIdgame relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function joinGameRelatedByIdgame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameRelatedByIdgame');

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
            $this->addJoinObject($join, 'GameRelatedByIdgame');
        }

        return $this;
    }

    /**
     * Use the GameRelatedByIdgame relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameQuery A secondary query class using the current class as primary query
     */
    public function useGameRelatedByIdgameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameRelatedByIdgame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameRelatedByIdgame', 'GameQuery');
    }

    /**
     * Filter the query by a related Game object
     *
     * @param   Game|PropelObjectCollection $game  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameListQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGameRelatedByIdgame($game, $comparison = null)
    {
        if ($game instanceof Game) {
            return $this
                ->addUsingAlias(GameListPeer::IDGAME, $game->getIdgame(), $comparison);
        } elseif ($game instanceof PropelObjectCollection) {
            return $this
                ->useGameRelatedByIdgameQuery()
                ->filterByPrimaryKeys($game->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGameRelatedByIdgame() only accepts arguments of type Game or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameRelatedByIdgame relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function joinGameRelatedByIdgame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameRelatedByIdgame');

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
            $this->addJoinObject($join, 'GameRelatedByIdgame');
        }

        return $this;
    }

    /**
     * Use the GameRelatedByIdgame relation Game object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameQuery A secondary query class using the current class as primary query
     */
    public function useGameRelatedByIdgameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameRelatedByIdgame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameRelatedByIdgame', 'GameQuery');
    }

    /**
     * Filter the query by a related Player object
     * using the Game table as cross reference
     *
     * @param   Player $player the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GameListQuery The current query, for fluid interface
     */
    public function filterByPlayer($player, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameRelatedByIdgameQuery()
            ->filterByPlayer($player, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   GameList $gameList Object to remove from the list of results
     *
     * @return GameListQuery The current query, for fluid interface
     */
    public function prune($gameList = null)
    {
        if ($gameList) {
            $this->addCond('pruneCond0', $this->getAliasedColName(GameListPeer::IDGAME), $gameList->getIdgame(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(GameListPeer::IDPLAYER), $gameList->getIdplayer(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(GameListPeer::IDBONUS), $gameList->getIdbonus(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
