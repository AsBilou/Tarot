<?php


/**
 * Base class that represents a query for the 'Bonus' table.
 *
 *
 *
 * @method BonusQuery orderByIdbonus($order = Criteria::ASC) Order by the idBonus column
 * @method BonusQuery orderByNamebonus($order = Criteria::ASC) Order by the nameBonus column
 * @method BonusQuery orderByValuebonus($order = Criteria::ASC) Order by the valueBonus column
 *
 * @method BonusQuery groupByIdbonus() Group by the idBonus column
 * @method BonusQuery groupByNamebonus() Group by the nameBonus column
 * @method BonusQuery groupByValuebonus() Group by the valueBonus column
 *
 * @method BonusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonusQuery leftJoinGameList($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameList relation
 * @method BonusQuery rightJoinGameList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameList relation
 * @method BonusQuery innerJoinGameList($relationAlias = null) Adds a INNER JOIN clause to the query using the GameList relation
 *
 * @method Bonus findOne(PropelPDO $con = null) Return the first Bonus matching the query
 * @method Bonus findOneOrCreate(PropelPDO $con = null) Return the first Bonus matching the query, or a new Bonus object populated from the query conditions when no match is found
 *
 * @method Bonus findOneByNamebonus(string $nameBonus) Return the first Bonus filtered by the nameBonus column
 * @method Bonus findOneByValuebonus(int $valueBonus) Return the first Bonus filtered by the valueBonus column
 *
 * @method array findByIdbonus(int $idBonus) Return Bonus objects filtered by the idBonus column
 * @method array findByNamebonus(string $nameBonus) Return Bonus objects filtered by the nameBonus column
 * @method array findByValuebonus(int $valueBonus) Return Bonus objects filtered by the valueBonus column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseBonusQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonusQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'Bonus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BonusQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonusQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonusQuery) {
            return $criteria;
        }
        $query = new BonusQuery();
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
     * @return   Bonus|Bonus[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonusPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Bonus A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdbonus($key, $con = null)
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
     * @return                 Bonus A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `idBonus`, `nameBonus`, `valueBonus` FROM `Bonus` WHERE `idBonus` = :p0';
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
            $obj = new Bonus();
            $obj->hydrate($row);
            BonusPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Bonus|Bonus[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Bonus[]|mixed the list of results, formatted by the current formatter
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
     * @return BonusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BonusPeer::IDBONUS, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BonusPeer::IDBONUS, $keys, Criteria::IN);
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
     * @param     mixed $idbonus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonusQuery The current query, for fluid interface
     */
    public function filterByIdbonus($idbonus = null, $comparison = null)
    {
        if (is_array($idbonus)) {
            $useMinMax = false;
            if (isset($idbonus['min'])) {
                $this->addUsingAlias(BonusPeer::IDBONUS, $idbonus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idbonus['max'])) {
                $this->addUsingAlias(BonusPeer::IDBONUS, $idbonus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonusPeer::IDBONUS, $idbonus, $comparison);
    }

    /**
     * Filter the query on the nameBonus column
     *
     * Example usage:
     * <code>
     * $query->filterByNamebonus('fooValue');   // WHERE nameBonus = 'fooValue'
     * $query->filterByNamebonus('%fooValue%'); // WHERE nameBonus LIKE '%fooValue%'
     * </code>
     *
     * @param     string $namebonus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonusQuery The current query, for fluid interface
     */
    public function filterByNamebonus($namebonus = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($namebonus)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $namebonus)) {
                $namebonus = str_replace('*', '%', $namebonus);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonusPeer::NAMEBONUS, $namebonus, $comparison);
    }

    /**
     * Filter the query on the valueBonus column
     *
     * Example usage:
     * <code>
     * $query->filterByValuebonus(1234); // WHERE valueBonus = 1234
     * $query->filterByValuebonus(array(12, 34)); // WHERE valueBonus IN (12, 34)
     * $query->filterByValuebonus(array('min' => 12)); // WHERE valueBonus >= 12
     * $query->filterByValuebonus(array('max' => 12)); // WHERE valueBonus <= 12
     * </code>
     *
     * @param     mixed $valuebonus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonusQuery The current query, for fluid interface
     */
    public function filterByValuebonus($valuebonus = null, $comparison = null)
    {
        if (is_array($valuebonus)) {
            $useMinMax = false;
            if (isset($valuebonus['min'])) {
                $this->addUsingAlias(BonusPeer::VALUEBONUS, $valuebonus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valuebonus['max'])) {
                $this->addUsingAlias(BonusPeer::VALUEBONUS, $valuebonus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonusPeer::VALUEBONUS, $valuebonus, $comparison);
    }

    /**
     * Filter the query by a related GameList object
     *
     * @param   GameList|PropelObjectCollection $gameList  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BonusQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGameList($gameList, $comparison = null)
    {
        if ($gameList instanceof GameList) {
            return $this
                ->addUsingAlias(BonusPeer::IDBONUS, $gameList->getIdbonus(), $comparison);
        } elseif ($gameList instanceof PropelObjectCollection) {
            return $this
                ->useGameListQuery()
                ->filterByPrimaryKeys($gameList->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGameList() only accepts arguments of type GameList or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameList relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonusQuery The current query, for fluid interface
     */
    public function joinGameList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameList');

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
            $this->addJoinObject($join, 'GameList');
        }

        return $this;
    }

    /**
     * Use the GameList relation GameList object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameListQuery A secondary query class using the current class as primary query
     */
    public function useGameListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameList', 'GameListQuery');
    }

    /**
     * Filter the query by a related Player object
     * using the Game_List table as cross reference
     *
     * @param   Player $player the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonusQuery The current query, for fluid interface
     */
    public function filterByPlayer($player, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameListQuery()
            ->filterByPlayer($player, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Game object
     * using the Game_List table as cross reference
     *
     * @param   Game $game the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonusQuery The current query, for fluid interface
     */
    public function filterByGameRelatedByIdgame($game, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameListQuery()
            ->filterByGameRelatedByIdgame($game, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Bonus $bonus Object to remove from the list of results
     *
     * @return BonusQuery The current query, for fluid interface
     */
    public function prune($bonus = null)
    {
        if ($bonus) {
            $this->addUsingAlias(BonusPeer::IDBONUS, $bonus->getIdbonus(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
