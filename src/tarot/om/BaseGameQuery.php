<?php


/**
 * Base class that represents a query for the 'Game' table.
 *
 *
 *
 * @method GameQuery orderByIdgame($order = Criteria::ASC) Order by the idGame column
 * @method GameQuery orderByIdcall($order = Criteria::ASC) Order by the idCall column
 * @method GameQuery orderByIdcalled($order = Criteria::ASC) Order by the idCalled column
 * @method GameQuery orderByIdtournament($order = Criteria::ASC) Order by the idTournament column
 * @method GameQuery orderByBids($order = Criteria::ASC) Order by the bids column
 * @method GameQuery orderByScore($order = Criteria::ASC) Order by the score column
 *
 * @method GameQuery groupByIdgame() Group by the idGame column
 * @method GameQuery groupByIdcall() Group by the idCall column
 * @method GameQuery groupByIdcalled() Group by the idCalled column
 * @method GameQuery groupByIdtournament() Group by the idTournament column
 * @method GameQuery groupByBids() Group by the bids column
 * @method GameQuery groupByScore() Group by the score column
 *
 * @method GameQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GameQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GameQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GameQuery leftJoinGameListRelatedByIdgame($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameListRelatedByIdgame relation
 * @method GameQuery rightJoinGameListRelatedByIdgame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameListRelatedByIdgame relation
 * @method GameQuery innerJoinGameListRelatedByIdgame($relationAlias = null) Adds a INNER JOIN clause to the query using the GameListRelatedByIdgame relation
 *
 * @method GameQuery leftJoinPlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Player relation
 * @method GameQuery rightJoinPlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Player relation
 * @method GameQuery innerJoinPlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the Player relation
 *
 * @method GameQuery leftJoinGameListRelatedByIdgame($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameListRelatedByIdgame relation
 * @method GameQuery rightJoinGameListRelatedByIdgame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameListRelatedByIdgame relation
 * @method GameQuery innerJoinGameListRelatedByIdgame($relationAlias = null) Adds a INNER JOIN clause to the query using the GameListRelatedByIdgame relation
 *
 * @method Game findOne(PropelPDO $con = null) Return the first Game matching the query
 * @method Game findOneOrCreate(PropelPDO $con = null) Return the first Game matching the query, or a new Game object populated from the query conditions when no match is found
 *
 * @method Game findOneByIdcall(int $idCall) Return the first Game filtered by the idCall column
 * @method Game findOneByIdcalled(int $idCalled) Return the first Game filtered by the idCalled column
 * @method Game findOneByIdtournament(int $idTournament) Return the first Game filtered by the idTournament column
 * @method Game findOneByBids(string $bids) Return the first Game filtered by the bids column
 * @method Game findOneByScore(int $score) Return the first Game filtered by the score column
 *
 * @method array findByIdgame(int $idGame) Return Game objects filtered by the idGame column
 * @method array findByIdcall(int $idCall) Return Game objects filtered by the idCall column
 * @method array findByIdcalled(int $idCalled) Return Game objects filtered by the idCalled column
 * @method array findByIdtournament(int $idTournament) Return Game objects filtered by the idTournament column
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
     public function findOneByIdgame($key, $con = null)
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
        $sql = 'SELECT `idGame`, `idCall`, `idCalled`, `idTournament`, `bids`, `score` FROM `Game` WHERE `idGame` = :p0';
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

        return $this->addUsingAlias(GamePeer::IDGAME, $key, Criteria::EQUAL);
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

        return $this->addUsingAlias(GamePeer::IDGAME, $keys, Criteria::IN);
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
     * @see       filterByGameListRelatedByIdgame()
     *
     * @param     mixed $idgame The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByIdgame($idgame = null, $comparison = null)
    {
        if (is_array($idgame)) {
            $useMinMax = false;
            if (isset($idgame['min'])) {
                $this->addUsingAlias(GamePeer::IDGAME, $idgame['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idgame['max'])) {
                $this->addUsingAlias(GamePeer::IDGAME, $idgame['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::IDGAME, $idgame, $comparison);
    }

    /**
     * Filter the query on the idCall column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcall(1234); // WHERE idCall = 1234
     * $query->filterByIdcall(array(12, 34)); // WHERE idCall IN (12, 34)
     * $query->filterByIdcall(array('min' => 12)); // WHERE idCall >= 12
     * $query->filterByIdcall(array('max' => 12)); // WHERE idCall <= 12
     * </code>
     *
     * @see       filterByPlayer()
     *
     * @param     mixed $idcall The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByIdcall($idcall = null, $comparison = null)
    {
        if (is_array($idcall)) {
            $useMinMax = false;
            if (isset($idcall['min'])) {
                $this->addUsingAlias(GamePeer::IDCALL, $idcall['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcall['max'])) {
                $this->addUsingAlias(GamePeer::IDCALL, $idcall['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::IDCALL, $idcall, $comparison);
    }

    /**
     * Filter the query on the idCalled column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcalled(1234); // WHERE idCalled = 1234
     * $query->filterByIdcalled(array(12, 34)); // WHERE idCalled IN (12, 34)
     * $query->filterByIdcalled(array('min' => 12)); // WHERE idCalled >= 12
     * $query->filterByIdcalled(array('max' => 12)); // WHERE idCalled <= 12
     * </code>
     *
     * @see       filterByPlayer()
     *
     * @param     mixed $idcalled The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByIdcalled($idcalled = null, $comparison = null)
    {
        if (is_array($idcalled)) {
            $useMinMax = false;
            if (isset($idcalled['min'])) {
                $this->addUsingAlias(GamePeer::IDCALLED, $idcalled['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcalled['max'])) {
                $this->addUsingAlias(GamePeer::IDCALLED, $idcalled['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::IDCALLED, $idcalled, $comparison);
    }

    /**
     * Filter the query on the idTournament column
     *
     * Example usage:
     * <code>
     * $query->filterByIdtournament(1234); // WHERE idTournament = 1234
     * $query->filterByIdtournament(array(12, 34)); // WHERE idTournament IN (12, 34)
     * $query->filterByIdtournament(array('min' => 12)); // WHERE idTournament >= 12
     * $query->filterByIdtournament(array('max' => 12)); // WHERE idTournament <= 12
     * </code>
     *
     * @param     mixed $idtournament The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function filterByIdtournament($idtournament = null, $comparison = null)
    {
        if (is_array($idtournament)) {
            $useMinMax = false;
            if (isset($idtournament['min'])) {
                $this->addUsingAlias(GamePeer::IDTOURNAMENT, $idtournament['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtournament['max'])) {
                $this->addUsingAlias(GamePeer::IDTOURNAMENT, $idtournament['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePeer::IDTOURNAMENT, $idtournament, $comparison);
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
     * Filter the query by a related GameList object
     *
     * @param   GameList|PropelObjectCollection $gameList The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGameListRelatedByIdgame($gameList, $comparison = null)
    {
        if ($gameList instanceof GameList) {
            return $this
                ->addUsingAlias(GamePeer::IDGAME, $gameList->getIdgame(), $comparison);
        } elseif ($gameList instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePeer::IDGAME, $gameList->toKeyValue('Idgame', 'Idgame'), $comparison);
        } else {
            throw new PropelException('filterByGameListRelatedByIdgame() only accepts arguments of type GameList or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameListRelatedByIdgame relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joinGameListRelatedByIdgame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameListRelatedByIdgame');

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
            $this->addJoinObject($join, 'GameListRelatedByIdgame');
        }

        return $this;
    }

    /**
     * Use the GameListRelatedByIdgame relation GameList object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameListQuery A secondary query class using the current class as primary query
     */
    public function useGameListRelatedByIdgameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameListRelatedByIdgame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameListRelatedByIdgame', 'GameListQuery');
    }

    /**
     * Filter the query by a related Player object
     *
     * @param   Player $player The related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlayer($player, $comparison = null)
    {
        if ($player instanceof Player) {
            return $this
                ->addUsingAlias(GamePeer::IDCALL, $player->getIdplayer(), $comparison)
                ->addUsingAlias(GamePeer::IDCALLED, $player->getIdplayer(), $comparison);
        } else {
            throw new PropelException('filterByPlayer() only accepts arguments of type Player');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Player relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joinPlayer($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePlayerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPlayer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Player', 'PlayerQuery');
    }

    /**
     * Filter the query by a related GameList object
     *
     * @param   GameList|PropelObjectCollection $gameList  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GameQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGameListRelatedByIdgame($gameList, $comparison = null)
    {
        if ($gameList instanceof GameList) {
            return $this
                ->addUsingAlias(GamePeer::IDGAME, $gameList->getIdgame(), $comparison);
        } elseif ($gameList instanceof PropelObjectCollection) {
            return $this
                ->useGameListRelatedByIdgameQuery()
                ->filterByPrimaryKeys($gameList->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGameListRelatedByIdgame() only accepts arguments of type GameList or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameListRelatedByIdgame relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GameQuery The current query, for fluid interface
     */
    public function joinGameListRelatedByIdgame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameListRelatedByIdgame');

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
            $this->addJoinObject($join, 'GameListRelatedByIdgame');
        }

        return $this;
    }

    /**
     * Use the GameListRelatedByIdgame relation GameList object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GameListQuery A secondary query class using the current class as primary query
     */
    public function useGameListRelatedByIdgameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameListRelatedByIdgame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameListRelatedByIdgame', 'GameListQuery');
    }

    /**
     * Filter the query by a related Bonus object
     * using the Game_List table as cross reference
     *
     * @param   Bonus $bonus the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GameQuery The current query, for fluid interface
     */
    public function filterByBonus($bonus, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameListRelatedByIdgameQuery()
            ->filterByBonus($bonus, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Player object
     * using the Game_List table as cross reference
     *
     * @param   Player $player the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   GameQuery The current query, for fluid interface
     */
    public function filterByPlayer($player, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGameListRelatedByIdgameQuery()
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
            $this->addUsingAlias(GamePeer::IDGAME, $game->getIdgame(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
