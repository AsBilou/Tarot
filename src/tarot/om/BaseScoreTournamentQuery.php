<?php


/**
 * Base class that represents a query for the 'Score_Tournament' table.
 *
 *
 *
 * @method ScoreTournamentQuery orderByIdtournament($order = Criteria::ASC) Order by the idTournament column
 * @method ScoreTournamentQuery orderByIdplayer($order = Criteria::ASC) Order by the idPlayer column
 * @method ScoreTournamentQuery orderByScore($order = Criteria::ASC) Order by the score column
 *
 * @method ScoreTournamentQuery groupByIdtournament() Group by the idTournament column
 * @method ScoreTournamentQuery groupByIdplayer() Group by the idPlayer column
 * @method ScoreTournamentQuery groupByScore() Group by the score column
 *
 * @method ScoreTournamentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ScoreTournamentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ScoreTournamentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ScoreTournamentQuery leftJoinTournament($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tournament relation
 * @method ScoreTournamentQuery rightJoinTournament($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tournament relation
 * @method ScoreTournamentQuery innerJoinTournament($relationAlias = null) Adds a INNER JOIN clause to the query using the Tournament relation
 *
 * @method ScoreTournamentQuery leftJoinPlayer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Player relation
 * @method ScoreTournamentQuery rightJoinPlayer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Player relation
 * @method ScoreTournamentQuery innerJoinPlayer($relationAlias = null) Adds a INNER JOIN clause to the query using the Player relation
 *
 * @method ScoreTournament findOne(PropelPDO $con = null) Return the first ScoreTournament matching the query
 * @method ScoreTournament findOneOrCreate(PropelPDO $con = null) Return the first ScoreTournament matching the query, or a new ScoreTournament object populated from the query conditions when no match is found
 *
 * @method ScoreTournament findOneByIdtournament(int $idTournament) Return the first ScoreTournament filtered by the idTournament column
 * @method ScoreTournament findOneByIdplayer(int $idPlayer) Return the first ScoreTournament filtered by the idPlayer column
 * @method ScoreTournament findOneByScore(int $score) Return the first ScoreTournament filtered by the score column
 *
 * @method array findByIdtournament(int $idTournament) Return ScoreTournament objects filtered by the idTournament column
 * @method array findByIdplayer(int $idPlayer) Return ScoreTournament objects filtered by the idPlayer column
 * @method array findByScore(int $score) Return ScoreTournament objects filtered by the score column
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseScoreTournamentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseScoreTournamentQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tarot', $modelName = 'ScoreTournament', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ScoreTournamentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ScoreTournamentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ScoreTournamentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ScoreTournamentQuery) {
            return $criteria;
        }
        $query = new ScoreTournamentQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$idTournament, $idPlayer]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ScoreTournament|ScoreTournament[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ScoreTournamentPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ScoreTournamentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 ScoreTournament A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `idTournament`, `idPlayer`, `score` FROM `Score_Tournament` WHERE `idTournament` = :p0 AND `idPlayer` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new ScoreTournament();
            $obj->hydrate($row);
            ScoreTournamentPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ScoreTournament|ScoreTournament[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ScoreTournament[]|mixed the list of results, formatted by the current formatter
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
     * @return ScoreTournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ScoreTournamentPeer::IDTOURNAMENT, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ScoreTournamentPeer::IDPLAYER, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ScoreTournamentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ScoreTournamentPeer::IDTOURNAMENT, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ScoreTournamentPeer::IDPLAYER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByTournament()
     *
     * @param     mixed $idtournament The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ScoreTournamentQuery The current query, for fluid interface
     */
    public function filterByIdtournament($idtournament = null, $comparison = null)
    {
        if (is_array($idtournament)) {
            $useMinMax = false;
            if (isset($idtournament['min'])) {
                $this->addUsingAlias(ScoreTournamentPeer::IDTOURNAMENT, $idtournament['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtournament['max'])) {
                $this->addUsingAlias(ScoreTournamentPeer::IDTOURNAMENT, $idtournament['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScoreTournamentPeer::IDTOURNAMENT, $idtournament, $comparison);
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
     * @return ScoreTournamentQuery The current query, for fluid interface
     */
    public function filterByIdplayer($idplayer = null, $comparison = null)
    {
        if (is_array($idplayer)) {
            $useMinMax = false;
            if (isset($idplayer['min'])) {
                $this->addUsingAlias(ScoreTournamentPeer::IDPLAYER, $idplayer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idplayer['max'])) {
                $this->addUsingAlias(ScoreTournamentPeer::IDPLAYER, $idplayer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScoreTournamentPeer::IDPLAYER, $idplayer, $comparison);
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
     * @return ScoreTournamentQuery The current query, for fluid interface
     */
    public function filterByScore($score = null, $comparison = null)
    {
        if (is_array($score)) {
            $useMinMax = false;
            if (isset($score['min'])) {
                $this->addUsingAlias(ScoreTournamentPeer::SCORE, $score['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($score['max'])) {
                $this->addUsingAlias(ScoreTournamentPeer::SCORE, $score['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ScoreTournamentPeer::SCORE, $score, $comparison);
    }

    /**
     * Filter the query by a related Tournament object
     *
     * @param   Tournament|PropelObjectCollection $tournament The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ScoreTournamentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTournament($tournament, $comparison = null)
    {
        if ($tournament instanceof Tournament) {
            return $this
                ->addUsingAlias(ScoreTournamentPeer::IDTOURNAMENT, $tournament->getId(), $comparison);
        } elseif ($tournament instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScoreTournamentPeer::IDTOURNAMENT, $tournament->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ScoreTournamentQuery The current query, for fluid interface
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
     * @return                 ScoreTournamentQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlayer($player, $comparison = null)
    {
        if ($player instanceof Player) {
            return $this
                ->addUsingAlias(ScoreTournamentPeer::IDPLAYER, $player->getId(), $comparison);
        } elseif ($player instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScoreTournamentPeer::IDPLAYER, $player->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ScoreTournamentQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ScoreTournament $scoreTournament Object to remove from the list of results
     *
     * @return ScoreTournamentQuery The current query, for fluid interface
     */
    public function prune($scoreTournament = null)
    {
        if ($scoreTournament) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ScoreTournamentPeer::IDTOURNAMENT), $scoreTournament->getIdtournament(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ScoreTournamentPeer::IDPLAYER), $scoreTournament->getIdplayer(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
