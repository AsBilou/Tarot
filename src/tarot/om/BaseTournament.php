<?php


/**
 * Base class that represents a row from the 'tournament' table.
 *
 *
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseTournament extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TournamentPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TournamentPeer
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
     * The value for the start field.
     * @var        string
     */
    protected $start;

    /**
     * The value for the active field.
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the winner_id field.
     * @var        int
     */
    protected $winner_id;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collGames;
    protected $collGamesPartial;

    /**
     * @var        PropelObjectCollection|TournamentPlayer[] Collection to store aggregation of TournamentPlayer objects.
     */
    protected $collTournamentPlayers;
    protected $collTournamentPlayersPartial;

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
    protected $playersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gamesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tournamentPlayersScheduledForDeletion = null;

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
     * Get the [optionally formatted] temporal [start] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStart($format = null)
    {
        if ($this->start === null) {
            return null;
        }

        if ($this->start === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->start);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->start, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [winner_id] column value.
     *
     * @return int
     */
    public function getWinnerId()
    {
        return $this->winner_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Tournament The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = TournamentPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of [start] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Tournament The current object (for fluent API support)
     */
    public function setStart($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->start !== null || $dt !== null) {
            $currentDateAsString = ($this->start !== null && $tmpDt = new DateTime($this->start)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->start = $newDateAsString;
                $this->modifiedColumns[] = TournamentPeer::START;
            }
        } // if either are not null


        return $this;
    } // setStart()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Tournament The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = TournamentPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Set the value of [winner_id] column.
     *
     * @param int $v new value
     * @return Tournament The current object (for fluent API support)
     */
    public function setWinnerId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->winner_id !== $v) {
            $this->winner_id = $v;
            $this->modifiedColumns[] = TournamentPeer::WINNER_ID;
        }


        return $this;
    } // setWinnerId()

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
            $this->start = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->winner_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 4; // 4 = TournamentPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Tournament object", $e);
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
            $con = Propel::getConnection(TournamentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TournamentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGames = null;

            $this->collTournamentPlayers = null;

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
            $con = Propel::getConnection(TournamentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TournamentQuery::create()
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
            $con = Propel::getConnection(TournamentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                TournamentPeer::addInstanceToPool($this);
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

            if ($this->playersScheduledForDeletion !== null) {
                if (!$this->playersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->playersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    TournamentPlayerQuery::create()
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

            if ($this->gamesScheduledForDeletion !== null) {
                if (!$this->gamesScheduledForDeletion->isEmpty()) {
                    GameQuery::create()
                        ->filterByPrimaryKeys($this->gamesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gamesScheduledForDeletion = null;
                }
            }

            if ($this->collGames !== null) {
                foreach ($this->collGames as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->tournamentPlayersScheduledForDeletion !== null) {
                if (!$this->tournamentPlayersScheduledForDeletion->isEmpty()) {
                    TournamentPlayerQuery::create()
                        ->filterByPrimaryKeys($this->tournamentPlayersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->tournamentPlayersScheduledForDeletion = null;
                }
            }

            if ($this->collTournamentPlayers !== null) {
                foreach ($this->collTournamentPlayers as $referrerFK) {
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

        $this->modifiedColumns[] = TournamentPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TournamentPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TournamentPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(TournamentPeer::START)) {
            $modifiedColumns[':p' . $index++]  = '`start`';
        }
        if ($this->isColumnModified(TournamentPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(TournamentPeer::WINNER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`winner_id`';
        }

        $sql = sprintf(
            'INSERT INTO `tournament` (%s) VALUES (%s)',
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
                    case '`start`':
                        $stmt->bindValue($identifier, $this->start, PDO::PARAM_STR);
                        break;
                    case '`active`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case '`winner_id`':
                        $stmt->bindValue($identifier, $this->winner_id, PDO::PARAM_INT);
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


            if (($retval = TournamentPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGames !== null) {
                    foreach ($this->collGames as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTournamentPlayers !== null) {
                    foreach ($this->collTournamentPlayers as $referrerFK) {
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
        $pos = TournamentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getStart();
                break;
            case 2:
                return $this->getActive();
                break;
            case 3:
                return $this->getWinnerId();
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
        if (isset($alreadyDumpedObjects['Tournament'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Tournament'][$this->getPrimaryKey()] = true;
        $keys = TournamentPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getStart(),
            $keys[2] => $this->getActive(),
            $keys[3] => $this->getWinnerId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collGames) {
                $result['Games'] = $this->collGames->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTournamentPlayers) {
                $result['TournamentPlayers'] = $this->collTournamentPlayers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = TournamentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setStart($value);
                break;
            case 2:
                $this->setActive($value);
                break;
            case 3:
                $this->setWinnerId($value);
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
        $keys = TournamentPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setStart($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setActive($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setWinnerId($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TournamentPeer::DATABASE_NAME);

        if ($this->isColumnModified(TournamentPeer::ID)) $criteria->add(TournamentPeer::ID, $this->id);
        if ($this->isColumnModified(TournamentPeer::START)) $criteria->add(TournamentPeer::START, $this->start);
        if ($this->isColumnModified(TournamentPeer::ACTIVE)) $criteria->add(TournamentPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(TournamentPeer::WINNER_ID)) $criteria->add(TournamentPeer::WINNER_ID, $this->winner_id);

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
        $criteria = new Criteria(TournamentPeer::DATABASE_NAME);
        $criteria->add(TournamentPeer::ID, $this->id);

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
     * @param object $copyObj An object of Tournament (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setStart($this->getStart());
        $copyObj->setActive($this->getActive());
        $copyObj->setWinnerId($this->getWinnerId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getGames() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGame($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTournamentPlayers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTournamentPlayer($relObj->copy($deepCopy));
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
     * @return Tournament Clone of current object.
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
     * @return TournamentPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TournamentPeer();
        }

        return self::$peer;
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
        if ('Game' == $relationName) {
            $this->initGames();
        }
        if ('TournamentPlayer' == $relationName) {
            $this->initTournamentPlayers();
        }
    }

    /**
     * Clears out the collGames collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tournament The current object (for fluent API support)
     * @see        addGames()
     */
    public function clearGames()
    {
        $this->collGames = null; // important to set this to null since that means it is uninitialized
        $this->collGamesPartial = null;

        return $this;
    }

    /**
     * reset is the collGames collection loaded partially
     *
     * @return void
     */
    public function resetPartialGames($v = true)
    {
        $this->collGamesPartial = $v;
    }

    /**
     * Initializes the collGames collection.
     *
     * By default this just sets the collGames collection to an empty array (like clearcollGames());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGames($overrideExisting = true)
    {
        if (null !== $this->collGames && !$overrideExisting) {
            return;
        }
        $this->collGames = new PropelObjectCollection();
        $this->collGames->setModel('Game');
    }

    /**
     * Gets an array of Game objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tournament is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Game[] List of Game objects
     * @throws PropelException
     */
    public function getGames($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGamesPartial && !$this->isNew();
        if (null === $this->collGames || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGames) {
                // return empty collection
                $this->initGames();
            } else {
                $collGames = GameQuery::create(null, $criteria)
                    ->filterByTournament($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGamesPartial && count($collGames)) {
                      $this->initGames(false);

                      foreach($collGames as $obj) {
                        if (false == $this->collGames->contains($obj)) {
                          $this->collGames->append($obj);
                        }
                      }

                      $this->collGamesPartial = true;
                    }

                    $collGames->getInternalIterator()->rewind();
                    return $collGames;
                }

                if($partial && $this->collGames) {
                    foreach($this->collGames as $obj) {
                        if($obj->isNew()) {
                            $collGames[] = $obj;
                        }
                    }
                }

                $this->collGames = $collGames;
                $this->collGamesPartial = false;
            }
        }

        return $this->collGames;
    }

    /**
     * Sets a collection of Game objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $games A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tournament The current object (for fluent API support)
     */
    public function setGames(PropelCollection $games, PropelPDO $con = null)
    {
        $gamesToDelete = $this->getGames(new Criteria(), $con)->diff($games);

        $this->gamesScheduledForDeletion = unserialize(serialize($gamesToDelete));

        foreach ($gamesToDelete as $gameRemoved) {
            $gameRemoved->setTournament(null);
        }

        $this->collGames = null;
        foreach ($games as $game) {
            $this->addGame($game);
        }

        $this->collGames = $games;
        $this->collGamesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Game objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Game objects.
     * @throws PropelException
     */
    public function countGames(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGamesPartial && !$this->isNew();
        if (null === $this->collGames || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGames) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getGames());
            }
            $query = GameQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTournament($this)
                ->count($con);
        }

        return count($this->collGames);
    }

    /**
     * Method called to associate a Game object to this object
     * through the Game foreign key attribute.
     *
     * @param    Game $l Game
     * @return Tournament The current object (for fluent API support)
     */
    public function addGame(Game $l)
    {
        if ($this->collGames === null) {
            $this->initGames();
            $this->collGamesPartial = true;
        }
        if (!in_array($l, $this->collGames->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGame($l);
        }

        return $this;
    }

    /**
     * @param	Game $game The game object to add.
     */
    protected function doAddGame($game)
    {
        $this->collGames[]= $game;
        $game->setTournament($this);
    }

    /**
     * @param	Game $game The game object to remove.
     * @return Tournament The current object (for fluent API support)
     */
    public function removeGame($game)
    {
        if ($this->getGames()->contains($game)) {
            $this->collGames->remove($this->collGames->search($game));
            if (null === $this->gamesScheduledForDeletion) {
                $this->gamesScheduledForDeletion = clone $this->collGames;
                $this->gamesScheduledForDeletion->clear();
            }
            $this->gamesScheduledForDeletion[]= clone $game;
            $game->setTournament(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tournament is new, it will return
     * an empty collection; or if this Tournament has previously
     * been saved, it will retrieve related Games from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tournament.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Game[] List of Game objects
     */
    public function getGamesJoincaller($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameQuery::create(null, $criteria);
        $query->joinWith('caller', $join_behavior);

        return $this->getGames($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tournament is new, it will return
     * an empty collection; or if this Tournament has previously
     * been saved, it will retrieve related Games from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tournament.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Game[] List of Game objects
     */
    public function getGamesJoincalled($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameQuery::create(null, $criteria);
        $query->joinWith('called', $join_behavior);

        return $this->getGames($query, $con);
    }

    /**
     * Clears out the collTournamentPlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tournament The current object (for fluent API support)
     * @see        addTournamentPlayers()
     */
    public function clearTournamentPlayers()
    {
        $this->collTournamentPlayers = null; // important to set this to null since that means it is uninitialized
        $this->collTournamentPlayersPartial = null;

        return $this;
    }

    /**
     * reset is the collTournamentPlayers collection loaded partially
     *
     * @return void
     */
    public function resetPartialTournamentPlayers($v = true)
    {
        $this->collTournamentPlayersPartial = $v;
    }

    /**
     * Initializes the collTournamentPlayers collection.
     *
     * By default this just sets the collTournamentPlayers collection to an empty array (like clearcollTournamentPlayers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTournamentPlayers($overrideExisting = true)
    {
        if (null !== $this->collTournamentPlayers && !$overrideExisting) {
            return;
        }
        $this->collTournamentPlayers = new PropelObjectCollection();
        $this->collTournamentPlayers->setModel('TournamentPlayer');
    }

    /**
     * Gets an array of TournamentPlayer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tournament is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TournamentPlayer[] List of TournamentPlayer objects
     * @throws PropelException
     */
    public function getTournamentPlayers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTournamentPlayersPartial && !$this->isNew();
        if (null === $this->collTournamentPlayers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTournamentPlayers) {
                // return empty collection
                $this->initTournamentPlayers();
            } else {
                $collTournamentPlayers = TournamentPlayerQuery::create(null, $criteria)
                    ->filterByTournament($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTournamentPlayersPartial && count($collTournamentPlayers)) {
                      $this->initTournamentPlayers(false);

                      foreach($collTournamentPlayers as $obj) {
                        if (false == $this->collTournamentPlayers->contains($obj)) {
                          $this->collTournamentPlayers->append($obj);
                        }
                      }

                      $this->collTournamentPlayersPartial = true;
                    }

                    $collTournamentPlayers->getInternalIterator()->rewind();
                    return $collTournamentPlayers;
                }

                if($partial && $this->collTournamentPlayers) {
                    foreach($this->collTournamentPlayers as $obj) {
                        if($obj->isNew()) {
                            $collTournamentPlayers[] = $obj;
                        }
                    }
                }

                $this->collTournamentPlayers = $collTournamentPlayers;
                $this->collTournamentPlayersPartial = false;
            }
        }

        return $this->collTournamentPlayers;
    }

    /**
     * Sets a collection of TournamentPlayer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tournamentPlayers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tournament The current object (for fluent API support)
     */
    public function setTournamentPlayers(PropelCollection $tournamentPlayers, PropelPDO $con = null)
    {
        $tournamentPlayersToDelete = $this->getTournamentPlayers(new Criteria(), $con)->diff($tournamentPlayers);

        $this->tournamentPlayersScheduledForDeletion = unserialize(serialize($tournamentPlayersToDelete));

        foreach ($tournamentPlayersToDelete as $tournamentPlayerRemoved) {
            $tournamentPlayerRemoved->setTournament(null);
        }

        $this->collTournamentPlayers = null;
        foreach ($tournamentPlayers as $tournamentPlayer) {
            $this->addTournamentPlayer($tournamentPlayer);
        }

        $this->collTournamentPlayers = $tournamentPlayers;
        $this->collTournamentPlayersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TournamentPlayer objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TournamentPlayer objects.
     * @throws PropelException
     */
    public function countTournamentPlayers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTournamentPlayersPartial && !$this->isNew();
        if (null === $this->collTournamentPlayers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTournamentPlayers) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTournamentPlayers());
            }
            $query = TournamentPlayerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTournament($this)
                ->count($con);
        }

        return count($this->collTournamentPlayers);
    }

    /**
     * Method called to associate a TournamentPlayer object to this object
     * through the TournamentPlayer foreign key attribute.
     *
     * @param    TournamentPlayer $l TournamentPlayer
     * @return Tournament The current object (for fluent API support)
     */
    public function addTournamentPlayer(TournamentPlayer $l)
    {
        if ($this->collTournamentPlayers === null) {
            $this->initTournamentPlayers();
            $this->collTournamentPlayersPartial = true;
        }
        if (!in_array($l, $this->collTournamentPlayers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTournamentPlayer($l);
        }

        return $this;
    }

    /**
     * @param	TournamentPlayer $tournamentPlayer The tournamentPlayer object to add.
     */
    protected function doAddTournamentPlayer($tournamentPlayer)
    {
        $this->collTournamentPlayers[]= $tournamentPlayer;
        $tournamentPlayer->setTournament($this);
    }

    /**
     * @param	TournamentPlayer $tournamentPlayer The tournamentPlayer object to remove.
     * @return Tournament The current object (for fluent API support)
     */
    public function removeTournamentPlayer($tournamentPlayer)
    {
        if ($this->getTournamentPlayers()->contains($tournamentPlayer)) {
            $this->collTournamentPlayers->remove($this->collTournamentPlayers->search($tournamentPlayer));
            if (null === $this->tournamentPlayersScheduledForDeletion) {
                $this->tournamentPlayersScheduledForDeletion = clone $this->collTournamentPlayers;
                $this->tournamentPlayersScheduledForDeletion->clear();
            }
            $this->tournamentPlayersScheduledForDeletion[]= clone $tournamentPlayer;
            $tournamentPlayer->setTournament(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tournament is new, it will return
     * an empty collection; or if this Tournament has previously
     * been saved, it will retrieve related TournamentPlayers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tournament.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TournamentPlayer[] List of TournamentPlayer objects
     */
    public function getTournamentPlayersJoinPlayer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TournamentPlayerQuery::create(null, $criteria);
        $query->joinWith('Player', $join_behavior);

        return $this->getTournamentPlayers($query, $con);
    }

    /**
     * Clears out the collPlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Tournament The current object (for fluent API support)
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
     * to the current object by way of the tournament_player cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Tournament is new, it will return
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
                    ->filterByTournament($this)
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
     * to the current object by way of the tournament_player cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $players A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Tournament The current object (for fluent API support)
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
     * to the current object by way of the tournament_player cross-reference table.
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
                    ->filterByTournament($this)
                    ->count($con);
            }
        } else {
            return count($this->collPlayers);
        }
    }

    /**
     * Associate a Player object to this object
     * through the tournament_player cross reference table.
     *
     * @param  Player $player The TournamentPlayer object to relate
     * @return Tournament The current object (for fluent API support)
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
        $tournamentPlayer = new TournamentPlayer();
        $tournamentPlayer->setPlayer($player);
        $this->addTournamentPlayer($tournamentPlayer);
    }

    /**
     * Remove a Player object to this object
     * through the tournament_player cross reference table.
     *
     * @param Player $player The TournamentPlayer object to relate
     * @return Tournament The current object (for fluent API support)
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
        $this->start = null;
        $this->active = null;
        $this->winner_id = null;
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
            if ($this->collGames) {
                foreach ($this->collGames as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTournamentPlayers) {
                foreach ($this->collTournamentPlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPlayers) {
                foreach ($this->collPlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collGames instanceof PropelCollection) {
            $this->collGames->clearIterator();
        }
        $this->collGames = null;
        if ($this->collTournamentPlayers instanceof PropelCollection) {
            $this->collTournamentPlayers->clearIterator();
        }
        $this->collTournamentPlayers = null;
        if ($this->collPlayers instanceof PropelCollection) {
            $this->collPlayers->clearIterator();
        }
        $this->collPlayers = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TournamentPeer::DEFAULT_STRING_FORMAT);
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
