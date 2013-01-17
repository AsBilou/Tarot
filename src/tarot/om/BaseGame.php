<?php


/**
 * Base class that represents a row from the 'game' table.
 *
 *
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseGame extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'GamePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        GamePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the call_id field.
     * @var        int
     */
    protected $call_id;

    /**
     * The value for the called_id field.
     * @var        int
     */
    protected $called_id;

    /**
     * The value for the tournament_id field.
     * @var        int
     */
    protected $tournament_id;

    /**
     * The value for the bids field.
     * @var        string
     */
    protected $bids;

    /**
     * The value for the score field.
     * @var        int
     */
    protected $score;

    /**
     * @var        Tournament
     */
    protected $aTournament;

    /**
     * @var        Player
     */
    protected $acaller;

    /**
     * @var        Player
     */
    protected $acalled;

    /**
     * @var        PropelObjectCollection|GamePlayer[] Collection to store aggregation of GamePlayer objects.
     */
    protected $collGamePlayers;
    protected $collGamePlayersPartial;

    /**
     * @var        PropelObjectCollection|Bonus[] Collection to store aggregation of Bonus objects.
     */
    protected $collBonuses;

    /**
     * @var        PropelObjectCollection|Player[] Collection to store aggregation of Player objects.
     */
    protected $collPlayers;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonusesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $playersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gamePlayersScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [call_id] column value.
     *
     * @return int
     */
    public function getCallId()
    {
        return $this->call_id;
    }

    /**
     * Get the [called_id] column value.
     *
     * @return int
     */
    public function getCalledId()
    {
        return $this->called_id;
    }

    /**
     * Get the [tournament_id] column value.
     *
     * @return int
     */
    public function getTournamentId()
    {
        return $this->tournament_id;
    }

    /**
     * Get the [bids] column value.
     *
     * @return string
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * Get the [score] column value.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = GamePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [call_id] column.
     *
     * @param int $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setCallId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->call_id !== $v) {
            $this->call_id = $v;
            $this->modifiedColumns[] = GamePeer::CALL_ID;
        }

        if ($this->acaller !== null && $this->acaller->getId() !== $v) {
            $this->acaller = null;
        }


        return $this;
    } // setCallId()

    /**
     * Set the value of [called_id] column.
     *
     * @param int $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setCalledId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->called_id !== $v) {
            $this->called_id = $v;
            $this->modifiedColumns[] = GamePeer::CALLED_ID;
        }

        if ($this->acalled !== null && $this->acalled->getId() !== $v) {
            $this->acalled = null;
        }


        return $this;
    } // setCalledId()

    /**
     * Set the value of [tournament_id] column.
     *
     * @param int $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setTournamentId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->tournament_id !== $v) {
            $this->tournament_id = $v;
            $this->modifiedColumns[] = GamePeer::TOURNAMENT_ID;
        }

        if ($this->aTournament !== null && $this->aTournament->getId() !== $v) {
            $this->aTournament = null;
        }


        return $this;
    } // setTournamentId()

    /**
     * Set the value of [bids] column.
     *
     * @param string $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setBids($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->bids !== $v) {
            $this->bids = $v;
            $this->modifiedColumns[] = GamePeer::BIDS;
        }


        return $this;
    } // setBids()

    /**
     * Set the value of [score] column.
     *
     * @param int $v new value
     * @return Game The current object (for fluent API support)
     */
    public function setScore($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->score !== $v) {
            $this->score = $v;
            $this->modifiedColumns[] = GamePeer::SCORE;
        }


        return $this;
    } // setScore()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->call_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->called_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->tournament_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->bids = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->score = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 6; // 6 = GamePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Game object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->acaller !== null && $this->call_id !== $this->acaller->getId()) {
            $this->acaller = null;
        }
        if ($this->acalled !== null && $this->called_id !== $this->acalled->getId()) {
            $this->acalled = null;
        }
        if ($this->aTournament !== null && $this->tournament_id !== $this->aTournament->getId()) {
            $this->aTournament = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = GamePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTournament = null;
            $this->acaller = null;
            $this->acalled = null;
            $this->collGamePlayers = null;

            $this->collBonuses = null;
            $this->collPlayers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = GameQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(GamePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                GamePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTournament !== null) {
                if ($this->aTournament->isModified() || $this->aTournament->isNew()) {
                    $affectedRows += $this->aTournament->save($con);
                }
                $this->setTournament($this->aTournament);
            }

            if ($this->acaller !== null) {
                if ($this->acaller->isModified() || $this->acaller->isNew()) {
                    $affectedRows += $this->acaller->save($con);
                }
                $this->setcaller($this->acaller);
            }

            if ($this->acalled !== null) {
                if ($this->acalled->isModified() || $this->acalled->isNew()) {
                    $affectedRows += $this->acalled->save($con);
                }
                $this->setcalled($this->acalled);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->bonusesScheduledForDeletion !== null) {
                if (!$this->bonusesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->bonusesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    GamePlayerQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->bonusesScheduledForDeletion = null;
                }

                foreach ($this->getBonuses() as $bonus) {
                    if ($bonus->isModified()) {
                        $bonus->save($con);
                    }
                }
            } elseif ($this->collBonuses) {
                foreach ($this->collBonuses as $bonus) {
                    if ($bonus->isModified()) {
                        $bonus->save($con);
                    }
                }
            }

            if ($this->playersScheduledForDeletion !== null) {
                if (!$this->playersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->playersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    GamePlayerQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->playersScheduledForDeletion = null;
                }

                foreach ($this->getPlayers() as $player) {
                    if ($player->isModified()) {
                        $player->save($con);
                    }
                }
            } elseif ($this->collPlayers) {
                foreach ($this->collPlayers as $player) {
                    if ($player->isModified()) {
                        $player->save($con);
                    }
                }
            }

            if ($this->gamePlayersScheduledForDeletion !== null) {
                if (!$this->gamePlayersScheduledForDeletion->isEmpty()) {
                    GamePlayerQuery::create()
                        ->filterByPrimaryKeys($this->gamePlayersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gamePlayersScheduledForDeletion = null;
                }
            }

            if ($this->collGamePlayers !== null) {
                foreach ($this->collGamePlayers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = GamePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GamePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GamePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(GamePeer::CALL_ID)) {
            $modifiedColumns[':p' . $index++]  = '`call_id`';
        }
        if ($this->isColumnModified(GamePeer::CALLED_ID)) {
            $modifiedColumns[':p' . $index++]  = '`called_id`';
        }
        if ($this->isColumnModified(GamePeer::TOURNAMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`tournament_id`';
        }
        if ($this->isColumnModified(GamePeer::BIDS)) {
            $modifiedColumns[':p' . $index++]  = '`bids`';
        }
        if ($this->isColumnModified(GamePeer::SCORE)) {
            $modifiedColumns[':p' . $index++]  = '`score`';
        }

        $sql = sprintf(
            'INSERT INTO `game` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`call_id`':
                        $stmt->bindValue($identifier, $this->call_id, PDO::PARAM_INT);
                        break;
                    case '`called_id`':
                        $stmt->bindValue($identifier, $this->called_id, PDO::PARAM_INT);
                        break;
                    case '`tournament_id`':
                        $stmt->bindValue($identifier, $this->tournament_id, PDO::PARAM_INT);
                        break;
                    case '`bids`':
                        $stmt->bindValue($identifier, $this->bids, PDO::PARAM_STR);
                        break;
                    case '`score`':
                        $stmt->bindValue($identifier, $this->score, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aTournament !== null) {
                if (!$this->aTournament->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTournament->getValidationFailures());
                }
            }

            if ($this->acaller !== null) {
                if (!$this->acaller->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->acaller->getValidationFailures());
                }
            }

            if ($this->acalled !== null) {
                if (!$this->acalled->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->acalled->getValidationFailures());
                }
            }


            if (($retval = GamePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGamePlayers !== null) {
                    foreach ($this->collGamePlayers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_FIELDNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_FIELDNAME)
    {
        $pos = GamePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCallId();
                break;
            case 2:
                return $this->getCalledId();
                break;
            case 3:
                return $this->getTournamentId();
                break;
            case 4:
                return $this->getBids();
                break;
            case 5:
                return $this->getScore();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_FIELDNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_FIELDNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Game'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Game'][$this->getPrimaryKey()] = true;
        $keys = GamePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCallId(),
            $keys[2] => $this->getCalledId(),
            $keys[3] => $this->getTournamentId(),
            $keys[4] => $this->getBids(),
            $keys[5] => $this->getScore(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTournament) {
                $result['Tournament'] = $this->aTournament->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->acaller) {
                $result['caller'] = $this->acaller->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->acalled) {
                $result['called'] = $this->acalled->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collGamePlayers) {
                $result['GamePlayers'] = $this->collGamePlayers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_FIELDNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_FIELDNAME)
    {
        $pos = GamePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCallId($value);
                break;
            case 2:
                $this->setCalledId($value);
                break;
            case 3:
                $this->setTournamentId($value);
                break;
            case 4:
                $this->setBids($value);
                break;
            case 5:
                $this->setScore($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_FIELDNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_FIELDNAME)
    {
        $keys = GamePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setCallId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCalledId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTournamentId($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBids($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setScore($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GamePeer::DATABASE_NAME);

        if ($this->isColumnModified(GamePeer::ID)) $criteria->add(GamePeer::ID, $this->id);
        if ($this->isColumnModified(GamePeer::CALL_ID)) $criteria->add(GamePeer::CALL_ID, $this->call_id);
        if ($this->isColumnModified(GamePeer::CALLED_ID)) $criteria->add(GamePeer::CALLED_ID, $this->called_id);
        if ($this->isColumnModified(GamePeer::TOURNAMENT_ID)) $criteria->add(GamePeer::TOURNAMENT_ID, $this->tournament_id);
        if ($this->isColumnModified(GamePeer::BIDS)) $criteria->add(GamePeer::BIDS, $this->bids);
        if ($this->isColumnModified(GamePeer::SCORE)) $criteria->add(GamePeer::SCORE, $this->score);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(GamePeer::DATABASE_NAME);
        $criteria->add(GamePeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Game (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCallId($this->getCallId());
        $copyObj->setCalledId($this->getCalledId());
        $copyObj->setTournamentId($this->getTournamentId());
        $copyObj->setBids($this->getBids());
        $copyObj->setScore($this->getScore());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getGamePlayers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGamePlayer($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Game Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return GamePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new GamePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Tournament object.
     *
     * @param             Tournament $v
     * @return Game The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTournament(Tournament $v = null)
    {
        if ($v === null) {
            $this->setTournamentId(NULL);
        } else {
            $this->setTournamentId($v->getId());
        }

        $this->aTournament = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Tournament object, it will not be re-added.
        if ($v !== null) {
            $v->addGame($this);
        }


        return $this;
    }


    /**
     * Get the associated Tournament object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Tournament The associated Tournament object.
     * @throws PropelException
     */
    public function getTournament(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTournament === null && ($this->tournament_id !== null) && $doQuery) {
            $this->aTournament = TournamentQuery::create()->findPk($this->tournament_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTournament->addGames($this);
             */
        }

        return $this->aTournament;
    }

    /**
     * Declares an association between this object and a Player object.
     *
     * @param             Player $v
     * @return Game The current object (for fluent API support)
     * @throws PropelException
     */
    public function setcaller(Player $v = null)
    {
        if ($v === null) {
            $this->setCallId(NULL);
        } else {
            $this->setCallId($v->getId());
        }

        $this->acaller = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Player object, it will not be re-added.
        if ($v !== null) {
            $v->addpCaller($this);
        }


        return $this;
    }


    /**
     * Get the associated Player object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Player The associated Player object.
     * @throws PropelException
     */
    public function getcaller(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->acaller === null && ($this->call_id !== null) && $doQuery) {
            $this->acaller = PlayerQuery::create()->findPk($this->call_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->acaller->addpCallers($this);
             */
        }

        return $this->acaller;
    }

    /**
     * Declares an association between this object and a Player object.
     *
     * @param             Player $v
     * @return Game The current object (for fluent API support)
     * @throws PropelException
     */
    public function setcalled(Player $v = null)
    {
        if ($v === null) {
            $this->setCalledId(NULL);
        } else {
            $this->setCalledId($v->getId());
        }

        $this->acalled = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Player object, it will not be re-added.
        if ($v !== null) {
            $v->addpCalled($this);
        }


        return $this;
    }


    /**
     * Get the associated Player object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Player The associated Player object.
     * @throws PropelException
     */
    public function getcalled(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->acalled === null && ($this->called_id !== null) && $doQuery) {
            $this->acalled = PlayerQuery::create()->findPk($this->called_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->acalled->addpCalleds($this);
             */
        }

        return $this->acalled;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('GamePlayer' == $relationName) {
            $this->initGamePlayers();
        }
    }

    /**
     * Clears out the collGamePlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Game The current object (for fluent API support)
     * @see        addGamePlayers()
     */
    public function clearGamePlayers()
    {
        $this->collGamePlayers = null; // important to set this to null since that means it is uninitialized
        $this->collGamePlayersPartial = null;

        return $this;
    }

    /**
     * reset is the collGamePlayers collection loaded partially
     *
     * @return void
     */
    public function resetPartialGamePlayers($v = true)
    {
        $this->collGamePlayersPartial = $v;
    }

    /**
     * Initializes the collGamePlayers collection.
     *
     * By default this just sets the collGamePlayers collection to an empty array (like clearcollGamePlayers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGamePlayers($overrideExisting = true)
    {
        if (null !== $this->collGamePlayers && !$overrideExisting) {
            return;
        }
        $this->collGamePlayers = new PropelObjectCollection();
        $this->collGamePlayers->setModel('GamePlayer');
    }

    /**
     * Gets an array of GamePlayer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Game is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|GamePlayer[] List of GamePlayer objects
     * @throws PropelException
     */
    public function getGamePlayers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGamePlayersPartial && !$this->isNew();
        if (null === $this->collGamePlayers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGamePlayers) {
                // return empty collection
                $this->initGamePlayers();
            } else {
                $collGamePlayers = GamePlayerQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGamePlayersPartial && count($collGamePlayers)) {
                      $this->initGamePlayers(false);

                      foreach($collGamePlayers as $obj) {
                        if (false == $this->collGamePlayers->contains($obj)) {
                          $this->collGamePlayers->append($obj);
                        }
                      }

                      $this->collGamePlayersPartial = true;
                    }

                    $collGamePlayers->getInternalIterator()->rewind();
                    return $collGamePlayers;
                }

                if($partial && $this->collGamePlayers) {
                    foreach($this->collGamePlayers as $obj) {
                        if($obj->isNew()) {
                            $collGamePlayers[] = $obj;
                        }
                    }
                }

                $this->collGamePlayers = $collGamePlayers;
                $this->collGamePlayersPartial = false;
            }
        }

        return $this->collGamePlayers;
    }

    /**
     * Sets a collection of GamePlayer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $gamePlayers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Game The current object (for fluent API support)
     */
    public function setGamePlayers(PropelCollection $gamePlayers, PropelPDO $con = null)
    {
        $gamePlayersToDelete = $this->getGamePlayers(new Criteria(), $con)->diff($gamePlayers);

        $this->gamePlayersScheduledForDeletion = unserialize(serialize($gamePlayersToDelete));

        foreach ($gamePlayersToDelete as $gamePlayerRemoved) {
            $gamePlayerRemoved->setGame(null);
        }

        $this->collGamePlayers = null;
        foreach ($gamePlayers as $gamePlayer) {
            $this->addGamePlayer($gamePlayer);
        }

        $this->collGamePlayers = $gamePlayers;
        $this->collGamePlayersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GamePlayer objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related GamePlayer objects.
     * @throws PropelException
     */
    public function countGamePlayers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGamePlayersPartial && !$this->isNew();
        if (null === $this->collGamePlayers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGamePlayers) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getGamePlayers());
            }
            $query = GamePlayerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collGamePlayers);
    }

    /**
     * Method called to associate a GamePlayer object to this object
     * through the GamePlayer foreign key attribute.
     *
     * @param    GamePlayer $l GamePlayer
     * @return Game The current object (for fluent API support)
     */
    public function addGamePlayer(GamePlayer $l)
    {
        if ($this->collGamePlayers === null) {
            $this->initGamePlayers();
            $this->collGamePlayersPartial = true;
        }
        if (!in_array($l, $this->collGamePlayers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGamePlayer($l);
        }

        return $this;
    }

    /**
     * @param	GamePlayer $gamePlayer The gamePlayer object to add.
     */
    protected function doAddGamePlayer($gamePlayer)
    {
        $this->collGamePlayers[]= $gamePlayer;
        $gamePlayer->setGame($this);
    }

    /**
     * @param	GamePlayer $gamePlayer The gamePlayer object to remove.
     * @return Game The current object (for fluent API support)
     */
    public function removeGamePlayer($gamePlayer)
    {
        if ($this->getGamePlayers()->contains($gamePlayer)) {
            $this->collGamePlayers->remove($this->collGamePlayers->search($gamePlayer));
            if (null === $this->gamePlayersScheduledForDeletion) {
                $this->gamePlayersScheduledForDeletion = clone $this->collGamePlayers;
                $this->gamePlayersScheduledForDeletion->clear();
            }
            $this->gamePlayersScheduledForDeletion[]= clone $gamePlayer;
            $gamePlayer->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related GamePlayers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GamePlayer[] List of GamePlayer objects
     */
    public function getGamePlayersJoinBonus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GamePlayerQuery::create(null, $criteria);
        $query->joinWith('Bonus', $join_behavior);

        return $this->getGamePlayers($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related GamePlayers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GamePlayer[] List of GamePlayer objects
     */
    public function getGamePlayersJoinPlayer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GamePlayerQuery::create(null, $criteria);
        $query->joinWith('Player', $join_behavior);

        return $this->getGamePlayers($query, $con);
    }

    /**
     * Clears out the collBonuses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Game The current object (for fluent API support)
     * @see        addBonuses()
     */
    public function clearBonuses()
    {
        $this->collBonuses = null; // important to set this to null since that means it is uninitialized
        $this->collBonusesPartial = null;

        return $this;
    }

    /**
     * Initializes the collBonuses collection.
     *
     * By default this just sets the collBonuses collection to an empty collection (like clearBonuses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBonuses()
    {
        $this->collBonuses = new PropelObjectCollection();
        $this->collBonuses->setModel('Bonus');
    }

    /**
     * Gets a collection of Bonus objects related by a many-to-many relationship
     * to the current object by way of the game_player cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Game is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Bonus[] List of Bonus objects
     */
    public function getBonuses($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBonuses || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonuses) {
                // return empty collection
                $this->initBonuses();
            } else {
                $collBonuses = BonusQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBonuses;
                }
                $this->collBonuses = $collBonuses;
            }
        }

        return $this->collBonuses;
    }

    /**
     * Sets a collection of Bonus objects related by a many-to-many relationship
     * to the current object by way of the game_player cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonuses A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Game The current object (for fluent API support)
     */
    public function setBonuses(PropelCollection $bonuses, PropelPDO $con = null)
    {
        $this->clearBonuses();
        $currentBonuses = $this->getBonuses();

        $this->bonusesScheduledForDeletion = $currentBonuses->diff($bonuses);

        foreach ($bonuses as $bonus) {
            if (!$currentBonuses->contains($bonus)) {
                $this->doAddBonus($bonus);
            }
        }

        $this->collBonuses = $bonuses;

        return $this;
    }

    /**
     * Gets the number of Bonus objects related by a many-to-many relationship
     * to the current object by way of the game_player cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Bonus objects
     */
    public function countBonuses($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBonuses || null !== $criteria) {
            if ($this->isNew() && null === $this->collBonuses) {
                return 0;
            } else {
                $query = BonusQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByGame($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonuses);
        }
    }

    /**
     * Associate a Bonus object to this object
     * through the game_player cross reference table.
     *
     * @param  Bonus $bonus The GamePlayer object to relate
     * @return Game The current object (for fluent API support)
     */
    public function addBonus(Bonus $bonus)
    {
        if ($this->collBonuses === null) {
            $this->initBonuses();
        }
        if (!$this->collBonuses->contains($bonus)) { // only add it if the **same** object is not already associated
            $this->doAddBonus($bonus);

            $this->collBonuses[]= $bonus;
        }

        return $this;
    }

    /**
     * @param	Bonus $bonus The bonus object to add.
     */
    protected function doAddBonus($bonus)
    {
        $gamePlayer = new GamePlayer();
        $gamePlayer->setBonus($bonus);
        $this->addGamePlayer($gamePlayer);
    }

    /**
     * Remove a Bonus object to this object
     * through the game_player cross reference table.
     *
     * @param Bonus $bonus The GamePlayer object to relate
     * @return Game The current object (for fluent API support)
     */
    public function removeBonus(Bonus $bonus)
    {
        if ($this->getBonuses()->contains($bonus)) {
            $this->collBonuses->remove($this->collBonuses->search($bonus));
            if (null === $this->bonusesScheduledForDeletion) {
                $this->bonusesScheduledForDeletion = clone $this->collBonuses;
                $this->bonusesScheduledForDeletion->clear();
            }
            $this->bonusesScheduledForDeletion[]= $bonus;
        }

        return $this;
    }

    /**
     * Clears out the collPlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Game The current object (for fluent API support)
     * @see        addPlayers()
     */
    public function clearPlayers()
    {
        $this->collPlayers = null; // important to set this to null since that means it is uninitialized
        $this->collPlayersPartial = null;

        return $this;
    }

    /**
     * Initializes the collPlayers collection.
     *
     * By default this just sets the collPlayers collection to an empty collection (like clearPlayers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPlayers()
    {
        $this->collPlayers = new PropelObjectCollection();
        $this->collPlayers->setModel('Player');
    }

    /**
     * Gets a collection of Player objects related by a many-to-many relationship
     * to the current object by way of the game_player cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Game is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Player[] List of Player objects
     */
    public function getPlayers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPlayers || null !== $criteria) {
            if ($this->isNew() && null === $this->collPlayers) {
                // return empty collection
                $this->initPlayers();
            } else {
                $collPlayers = PlayerQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPlayers;
                }
                $this->collPlayers = $collPlayers;
            }
        }

        return $this->collPlayers;
    }

    /**
     * Sets a collection of Player objects related by a many-to-many relationship
     * to the current object by way of the game_player cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $players A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Game The current object (for fluent API support)
     */
    public function setPlayers(PropelCollection $players, PropelPDO $con = null)
    {
        $this->clearPlayers();
        $currentPlayers = $this->getPlayers();

        $this->playersScheduledForDeletion = $currentPlayers->diff($players);

        foreach ($players as $player) {
            if (!$currentPlayers->contains($player)) {
                $this->doAddPlayer($player);
            }
        }

        $this->collPlayers = $players;

        return $this;
    }

    /**
     * Gets the number of Player objects related by a many-to-many relationship
     * to the current object by way of the game_player cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Player objects
     */
    public function countPlayers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPlayers || null !== $criteria) {
            if ($this->isNew() && null === $this->collPlayers) {
                return 0;
            } else {
                $query = PlayerQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByGame($this)
                    ->count($con);
            }
        } else {
            return count($this->collPlayers);
        }
    }

    /**
     * Associate a Player object to this object
     * through the game_player cross reference table.
     *
     * @param  Player $player The GamePlayer object to relate
     * @return Game The current object (for fluent API support)
     */
    public function addPlayer(Player $player)
    {
        if ($this->collPlayers === null) {
            $this->initPlayers();
        }
        if (!$this->collPlayers->contains($player)) { // only add it if the **same** object is not already associated
            $this->doAddPlayer($player);

            $this->collPlayers[]= $player;
        }

        return $this;
    }

    /**
     * @param	Player $player The player object to add.
     */
    protected function doAddPlayer($player)
    {
        $gamePlayer = new GamePlayer();
        $gamePlayer->setPlayer($player);
        $this->addGamePlayer($gamePlayer);
    }

    /**
     * Remove a Player object to this object
     * through the game_player cross reference table.
     *
     * @param Player $player The GamePlayer object to relate
     * @return Game The current object (for fluent API support)
     */
    public function removePlayer(Player $player)
    {
        if ($this->getPlayers()->contains($player)) {
            $this->collPlayers->remove($this->collPlayers->search($player));
            if (null === $this->playersScheduledForDeletion) {
                $this->playersScheduledForDeletion = clone $this->collPlayers;
                $this->playersScheduledForDeletion->clear();
            }
            $this->playersScheduledForDeletion[]= $player;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->call_id = null;
        $this->called_id = null;
        $this->tournament_id = null;
        $this->bids = null;
        $this->score = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collGamePlayers) {
                foreach ($this->collGamePlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonuses) {
                foreach ($this->collBonuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPlayers) {
                foreach ($this->collPlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aTournament instanceof Persistent) {
              $this->aTournament->clearAllReferences($deep);
            }
            if ($this->acaller instanceof Persistent) {
              $this->acaller->clearAllReferences($deep);
            }
            if ($this->acalled instanceof Persistent) {
              $this->acalled->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collGamePlayers instanceof PropelCollection) {
            $this->collGamePlayers->clearIterator();
        }
        $this->collGamePlayers = null;
        if ($this->collBonuses instanceof PropelCollection) {
            $this->collBonuses->clearIterator();
        }
        $this->collBonuses = null;
        if ($this->collPlayers instanceof PropelCollection) {
            $this->collPlayers->clearIterator();
        }
        $this->collPlayers = null;
        $this->aTournament = null;
        $this->acaller = null;
        $this->acalled = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GamePeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
