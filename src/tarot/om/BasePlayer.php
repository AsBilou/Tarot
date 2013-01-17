<?php


/**
 * Base class that represents a row from the 'Player' table.
 *
 *
 *
 * @package    propel.generator.tarot.om
 */
abstract class BasePlayer extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'PlayerPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PlayerPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the idplayer field.
     * @var        int
     */
    protected $idplayer;

    /**
     * The value for the nameplayer field.
     * @var        string
     */
    protected $nameplayer;

    /**
     * The value for the mailplayer field.
     * @var        string
     */
    protected $mailplayer;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collGames;
    protected $collGamesPartial;

    /**
     * @var        PropelObjectCollection|GameList[] Collection to store aggregation of GameList objects.
     */
    protected $collGameLists;
    protected $collGameListsPartial;

    /**
     * @var        PropelObjectCollection|GameList[] Collection to store aggregation of GameList objects.
     */
    protected $collGameListsRelatedByIdgame;

    /**
     * @var        PropelObjectCollection|Bonus[] Collection to store aggregation of Bonus objects.
     */
    protected $collBonuses;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collGamesRelatedByIdgame;

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
    protected $gameListsRelatedByIdgameScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bonusesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gamesRelatedByIdgameScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gamesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gameListsScheduledForDeletion = null;

    /**
     * Get the [idplayer] column value.
     *
     * @return int
     */
    public function getIdplayer()
    {
        return $this->idplayer;
    }

    /**
     * Get the [nameplayer] column value.
     *
     * @return string
     */
    public function getNameplayer()
    {
        return $this->nameplayer;
    }

    /**
     * Get the [mailplayer] column value.
     *
     * @return string
     */
    public function getMailplayer()
    {
        return $this->mailplayer;
    }

    /**
     * Set the value of [idplayer] column.
     *
     * @param int $v new value
     * @return Player The current object (for fluent API support)
     */
    public function setIdplayer($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->idplayer !== $v) {
            $this->idplayer = $v;
            $this->modifiedColumns[] = PlayerPeer::IDPLAYER;
        }


        return $this;
    } // setIdplayer()

    /**
     * Set the value of [nameplayer] column.
     *
     * @param string $v new value
     * @return Player The current object (for fluent API support)
     */
    public function setNameplayer($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nameplayer !== $v) {
            $this->nameplayer = $v;
            $this->modifiedColumns[] = PlayerPeer::NAMEPLAYER;
        }


        return $this;
    } // setNameplayer()

    /**
     * Set the value of [mailplayer] column.
     *
     * @param string $v new value
     * @return Player The current object (for fluent API support)
     */
    public function setMailplayer($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->mailplayer !== $v) {
            $this->mailplayer = $v;
            $this->modifiedColumns[] = PlayerPeer::MAILPLAYER;
        }


        return $this;
    } // setMailplayer()

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

            $this->idplayer = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->nameplayer = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->mailplayer = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = PlayerPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Player object", $e);
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
            $con = Propel::getConnection(PlayerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PlayerPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGames = null;

            $this->collGameLists = null;

            $this->collGameListsRelatedByIdgame = null;
            $this->collBonuses = null;
            $this->collGamesRelatedByIdgame = null;
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
            $con = Propel::getConnection(PlayerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PlayerQuery::create()
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
            $con = Propel::getConnection(PlayerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                PlayerPeer::addInstanceToPool($this);
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

            if ($this->gameListsRelatedByIdgameScheduledForDeletion !== null) {
                if (!$this->gameListsRelatedByIdgameScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->gameListsRelatedByIdgameScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    GameQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->gameListsRelatedByIdgameScheduledForDeletion = null;
                }

                foreach ($this->getGameListsRelatedByIdgame() as $gameListRelatedByIdgame) {
                    if ($gameListRelatedByIdgame->isModified()) {
                        $gameListRelatedByIdgame->save($con);
                    }
                }
            } elseif ($this->collGameListsRelatedByIdgame) {
                foreach ($this->collGameListsRelatedByIdgame as $gameListRelatedByIdgame) {
                    if ($gameListRelatedByIdgame->isModified()) {
                        $gameListRelatedByIdgame->save($con);
                    }
                }
            }

            if ($this->bonusesScheduledForDeletion !== null) {
                if (!$this->bonusesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->bonusesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    GameListQuery::create()
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

            if ($this->gamesRelatedByIdgameScheduledForDeletion !== null) {
                if (!$this->gamesRelatedByIdgameScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->gamesRelatedByIdgameScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    GameListQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->gamesRelatedByIdgameScheduledForDeletion = null;
                }

                foreach ($this->getGamesRelatedByIdgame() as $gameRelatedByIdgame) {
                    if ($gameRelatedByIdgame->isModified()) {
                        $gameRelatedByIdgame->save($con);
                    }
                }
            } elseif ($this->collGamesRelatedByIdgame) {
                foreach ($this->collGamesRelatedByIdgame as $gameRelatedByIdgame) {
                    if ($gameRelatedByIdgame->isModified()) {
                        $gameRelatedByIdgame->save($con);
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

            if ($this->gameListsScheduledForDeletion !== null) {
                if (!$this->gameListsScheduledForDeletion->isEmpty()) {
                    GameListQuery::create()
                        ->filterByPrimaryKeys($this->gameListsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gameListsScheduledForDeletion = null;
                }
            }

            if ($this->collGameLists !== null) {
                foreach ($this->collGameLists as $referrerFK) {
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

        $this->modifiedColumns[] = PlayerPeer::IDPLAYER;
        if (null !== $this->idplayer) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PlayerPeer::IDPLAYER . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PlayerPeer::IDPLAYER)) {
            $modifiedColumns[':p' . $index++]  = '`idPlayer`';
        }
        if ($this->isColumnModified(PlayerPeer::NAMEPLAYER)) {
            $modifiedColumns[':p' . $index++]  = '`namePlayer`';
        }
        if ($this->isColumnModified(PlayerPeer::MAILPLAYER)) {
            $modifiedColumns[':p' . $index++]  = '`mailPlayer`';
        }

        $sql = sprintf(
            'INSERT INTO `Player` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`idPlayer`':
                        $stmt->bindValue($identifier, $this->idplayer, PDO::PARAM_INT);
                        break;
                    case '`namePlayer`':
                        $stmt->bindValue($identifier, $this->nameplayer, PDO::PARAM_STR);
                        break;
                    case '`mailPlayer`':
                        $stmt->bindValue($identifier, $this->mailplayer, PDO::PARAM_STR);
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
        $this->setIdplayer($pk);

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


            if (($retval = PlayerPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGames !== null) {
                    foreach ($this->collGames as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collGameLists !== null) {
                    foreach ($this->collGameLists as $referrerFK) {
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
        $pos = PlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIdplayer();
                break;
            case 1:
                return $this->getNameplayer();
                break;
            case 2:
                return $this->getMailplayer();
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
        if (isset($alreadyDumpedObjects['Player'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Player'][$this->getPrimaryKey()] = true;
        $keys = PlayerPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdplayer(),
            $keys[1] => $this->getNameplayer(),
            $keys[2] => $this->getMailplayer(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collGames) {
                $result['Games'] = $this->collGames->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGameLists) {
                $result['GameLists'] = $this->collGameLists->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = PlayerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdplayer($value);
                break;
            case 1:
                $this->setNameplayer($value);
                break;
            case 2:
                $this->setMailplayer($value);
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
        $keys = PlayerPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdplayer($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNameplayer($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setMailplayer($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PlayerPeer::DATABASE_NAME);

        if ($this->isColumnModified(PlayerPeer::IDPLAYER)) $criteria->add(PlayerPeer::IDPLAYER, $this->idplayer);
        if ($this->isColumnModified(PlayerPeer::NAMEPLAYER)) $criteria->add(PlayerPeer::NAMEPLAYER, $this->nameplayer);
        if ($this->isColumnModified(PlayerPeer::MAILPLAYER)) $criteria->add(PlayerPeer::MAILPLAYER, $this->mailplayer);

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
        $criteria = new Criteria(PlayerPeer::DATABASE_NAME);
        $criteria->add(PlayerPeer::IDPLAYER, $this->idplayer);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdplayer();
    }

    /**
     * Generic method to set the primary key (idplayer column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdplayer($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdplayer();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Player (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNameplayer($this->getNameplayer());
        $copyObj->setMailplayer($this->getMailplayer());

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

            foreach ($this->getGameLists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGameList($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdplayer(NULL); // this is a auto-increment column, so set to default value
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
     * @return Player Clone of current object.
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
     * @return PlayerPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PlayerPeer();
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
        if ('GameList' == $relationName) {
            $this->initGameLists();
        }
    }

    /**
     * Clears out the collGames collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
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
     * If this Player is new, it will return
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
                    ->filterByPlayer($this)
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
     * @return Player The current object (for fluent API support)
     */
    public function setGames(PropelCollection $games, PropelPDO $con = null)
    {
        $gamesToDelete = $this->getGames(new Criteria(), $con)->diff($games);

        $this->gamesScheduledForDeletion = unserialize(serialize($gamesToDelete));

        foreach ($gamesToDelete as $gameRemoved) {
            $gameRemoved->setPlayer(null);
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
                ->filterByPlayer($this)
                ->count($con);
        }

        return count($this->collGames);
    }

    /**
     * Method called to associate a Game object to this object
     * through the Game foreign key attribute.
     *
     * @param    Game $l Game
     * @return Player The current object (for fluent API support)
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
        $game->setPlayer($this);
    }

    /**
     * @param	Game $game The game object to remove.
     * @return Player The current object (for fluent API support)
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
            $game->setPlayer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related Games from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Player.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Game[] List of Game objects
     */
    public function getGamesJoinGameListRelatedByIdgame($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameQuery::create(null, $criteria);
        $query->joinWith('GameListRelatedByIdgame', $join_behavior);

        return $this->getGames($query, $con);
    }

    /**
     * Clears out the collGameLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
     * @see        addGameLists()
     */
    public function clearGameLists()
    {
        $this->collGameLists = null; // important to set this to null since that means it is uninitialized
        $this->collGameListsPartial = null;

        return $this;
    }

    /**
     * reset is the collGameLists collection loaded partially
     *
     * @return void
     */
    public function resetPartialGameLists($v = true)
    {
        $this->collGameListsPartial = $v;
    }

    /**
     * Initializes the collGameLists collection.
     *
     * By default this just sets the collGameLists collection to an empty array (like clearcollGameLists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGameLists($overrideExisting = true)
    {
        if (null !== $this->collGameLists && !$overrideExisting) {
            return;
        }
        $this->collGameLists = new PropelObjectCollection();
        $this->collGameLists->setModel('GameList');
    }

    /**
     * Gets an array of GameList objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Player is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|GameList[] List of GameList objects
     * @throws PropelException
     */
    public function getGameLists($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGameListsPartial && !$this->isNew();
        if (null === $this->collGameLists || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGameLists) {
                // return empty collection
                $this->initGameLists();
            } else {
                $collGameLists = GameListQuery::create(null, $criteria)
                    ->filterByPlayer($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGameListsPartial && count($collGameLists)) {
                      $this->initGameLists(false);

                      foreach($collGameLists as $obj) {
                        if (false == $this->collGameLists->contains($obj)) {
                          $this->collGameLists->append($obj);
                        }
                      }

                      $this->collGameListsPartial = true;
                    }

                    $collGameLists->getInternalIterator()->rewind();
                    return $collGameLists;
                }

                if($partial && $this->collGameLists) {
                    foreach($this->collGameLists as $obj) {
                        if($obj->isNew()) {
                            $collGameLists[] = $obj;
                        }
                    }
                }

                $this->collGameLists = $collGameLists;
                $this->collGameListsPartial = false;
            }
        }

        return $this->collGameLists;
    }

    /**
     * Sets a collection of GameList objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $gameLists A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
     */
    public function setGameLists(PropelCollection $gameLists, PropelPDO $con = null)
    {
        $gameListsToDelete = $this->getGameLists(new Criteria(), $con)->diff($gameLists);

        $this->gameListsScheduledForDeletion = unserialize(serialize($gameListsToDelete));

        foreach ($gameListsToDelete as $gameListRemoved) {
            $gameListRemoved->setPlayer(null);
        }

        $this->collGameLists = null;
        foreach ($gameLists as $gameList) {
            $this->addGameList($gameList);
        }

        $this->collGameLists = $gameLists;
        $this->collGameListsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GameList objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related GameList objects.
     * @throws PropelException
     */
    public function countGameLists(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGameListsPartial && !$this->isNew();
        if (null === $this->collGameLists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGameLists) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getGameLists());
            }
            $query = GameListQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPlayer($this)
                ->count($con);
        }

        return count($this->collGameLists);
    }

    /**
     * Method called to associate a GameList object to this object
     * through the GameList foreign key attribute.
     *
     * @param    GameList $l GameList
     * @return Player The current object (for fluent API support)
     */
    public function addGameList(GameList $l)
    {
        if ($this->collGameLists === null) {
            $this->initGameLists();
            $this->collGameListsPartial = true;
        }
        if (!in_array($l, $this->collGameLists->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGameList($l);
        }

        return $this;
    }

    /**
     * @param	GameList $gameList The gameList object to add.
     */
    protected function doAddGameList($gameList)
    {
        $this->collGameLists[]= $gameList;
        $gameList->setPlayer($this);
    }

    /**
     * @param	GameList $gameList The gameList object to remove.
     * @return Player The current object (for fluent API support)
     */
    public function removeGameList($gameList)
    {
        if ($this->getGameLists()->contains($gameList)) {
            $this->collGameLists->remove($this->collGameLists->search($gameList));
            if (null === $this->gameListsScheduledForDeletion) {
                $this->gameListsScheduledForDeletion = clone $this->collGameLists;
                $this->gameListsScheduledForDeletion->clear();
            }
            $this->gameListsScheduledForDeletion[]= clone $gameList;
            $gameList->setPlayer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related GameLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Player.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GameList[] List of GameList objects
     */
    public function getGameListsJoinBonus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameListQuery::create(null, $criteria);
        $query->joinWith('Bonus', $join_behavior);

        return $this->getGameLists($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related GameLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Player.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GameList[] List of GameList objects
     */
    public function getGameListsJoinGameRelatedByIdgame($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameListQuery::create(null, $criteria);
        $query->joinWith('GameRelatedByIdgame', $join_behavior);

        return $this->getGameLists($query, $con);
    }

    /**
     * Clears out the collGameListsRelatedByIdgame collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
     * @see        addGameListsRelatedByIdgame()
     */
    public function clearGameListsRelatedByIdgame()
    {
        $this->collGameListsRelatedByIdgame = null; // important to set this to null since that means it is uninitialized
        $this->collGameListsRelatedByIdgamePartial = null;

        return $this;
    }

    /**
     * Initializes the collGameListsRelatedByIdgame collection.
     *
     * By default this just sets the collGameListsRelatedByIdgame collection to an empty collection (like clearGameListsRelatedByIdgame());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initGameListsRelatedByIdgame()
    {
        $this->collGameListsRelatedByIdgame = new PropelObjectCollection();
        $this->collGameListsRelatedByIdgame->setModel('GameList');
    }

    /**
     * Gets a collection of GameList objects related by a many-to-many relationship
     * to the current object by way of the Game cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Player is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|GameList[] List of GameList objects
     */
    public function getGameListsRelatedByIdgame($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collGameListsRelatedByIdgame || null !== $criteria) {
            if ($this->isNew() && null === $this->collGameListsRelatedByIdgame) {
                // return empty collection
                $this->initGameListsRelatedByIdgame();
            } else {
                $collGameListsRelatedByIdgame = GameListQuery::create(null, $criteria)
                    ->filterByPlayer($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collGameListsRelatedByIdgame;
                }
                $this->collGameListsRelatedByIdgame = $collGameListsRelatedByIdgame;
            }
        }

        return $this->collGameListsRelatedByIdgame;
    }

    /**
     * Sets a collection of GameList objects related by a many-to-many relationship
     * to the current object by way of the Game cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $gameListsRelatedByIdgame A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
     */
    public function setGameListsRelatedByIdgame(PropelCollection $gameListsRelatedByIdgame, PropelPDO $con = null)
    {
        $this->clearGameListsRelatedByIdgame();
        $currentGameListsRelatedByIdgame = $this->getGameListsRelatedByIdgame();

        $this->gameListsRelatedByIdgameScheduledForDeletion = $currentGameListsRelatedByIdgame->diff($gameListsRelatedByIdgame);

        foreach ($gameListsRelatedByIdgame as $gameListRelatedByIdgame) {
            if (!$currentGameListsRelatedByIdgame->contains($gameListRelatedByIdgame)) {
                $this->doAddGameListRelatedByIdgame($gameListRelatedByIdgame);
            }
        }

        $this->collGameListsRelatedByIdgame = $gameListsRelatedByIdgame;

        return $this;
    }

    /**
     * Gets the number of GameList objects related by a many-to-many relationship
     * to the current object by way of the Game cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related GameList objects
     */
    public function countGameListsRelatedByIdgame($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collGameListsRelatedByIdgame || null !== $criteria) {
            if ($this->isNew() && null === $this->collGameListsRelatedByIdgame) {
                return 0;
            } else {
                $query = GameListQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPlayer($this)
                    ->count($con);
            }
        } else {
            return count($this->collGameListsRelatedByIdgame);
        }
    }

    /**
     * Associate a GameList object to this object
     * through the Game cross reference table.
     *
     * @param  GameList $gameList The Game object to relate
     * @return Player The current object (for fluent API support)
     */
    public function addGameListRelatedByIdgame(GameList $gameList)
    {
        if ($this->collGameListsRelatedByIdgame === null) {
            $this->initGameListsRelatedByIdgame();
        }
        if (!$this->collGameListsRelatedByIdgame->contains($gameList)) { // only add it if the **same** object is not already associated
            $this->doAddGameListRelatedByIdgame($gameList);

            $this->collGameListsRelatedByIdgame[]= $gameList;
        }

        return $this;
    }

    /**
     * @param	GameListRelatedByIdgame $gameListRelatedByIdgame The gameListRelatedByIdgame object to add.
     */
    protected function doAddGameListRelatedByIdgame($gameListRelatedByIdgame)
    {
        $game = new Game();
        $game->setGameListRelatedByIdgame($gameListRelatedByIdgame);
        $this->addGame($game);
    }

    /**
     * Remove a GameList object to this object
     * through the Game cross reference table.
     *
     * @param GameList $gameList The Game object to relate
     * @return Player The current object (for fluent API support)
     */
    public function removeGameListRelatedByIdgame(GameList $gameList)
    {
        if ($this->getGameListsRelatedByIdgame()->contains($gameList)) {
            $this->collGameListsRelatedByIdgame->remove($this->collGameListsRelatedByIdgame->search($gameList));
            if (null === $this->gameListsRelatedByIdgameScheduledForDeletion) {
                $this->gameListsRelatedByIdgameScheduledForDeletion = clone $this->collGameListsRelatedByIdgame;
                $this->gameListsRelatedByIdgameScheduledForDeletion->clear();
            }
            $this->gameListsRelatedByIdgameScheduledForDeletion[]= $gameList;
        }

        return $this;
    }

    /**
     * Clears out the collBonuses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
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
     * to the current object by way of the Game_List cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Player is new, it will return
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
                    ->filterByPlayer($this)
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
     * to the current object by way of the Game_List cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bonuses A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
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
     * to the current object by way of the Game_List cross-reference table.
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
                    ->filterByPlayer($this)
                    ->count($con);
            }
        } else {
            return count($this->collBonuses);
        }
    }

    /**
     * Associate a Bonus object to this object
     * through the Game_List cross reference table.
     *
     * @param  Bonus $bonus The GameList object to relate
     * @return Player The current object (for fluent API support)
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
        $gameList = new GameList();
        $gameList->setBonus($bonus);
        $this->addGameList($gameList);
    }

    /**
     * Remove a Bonus object to this object
     * through the Game_List cross reference table.
     *
     * @param Bonus $bonus The GameList object to relate
     * @return Player The current object (for fluent API support)
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
     * Clears out the collGamesRelatedByIdgame collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
     * @see        addGamesRelatedByIdgame()
     */
    public function clearGamesRelatedByIdgame()
    {
        $this->collGamesRelatedByIdgame = null; // important to set this to null since that means it is uninitialized
        $this->collGamesRelatedByIdgamePartial = null;

        return $this;
    }

    /**
     * Initializes the collGamesRelatedByIdgame collection.
     *
     * By default this just sets the collGamesRelatedByIdgame collection to an empty collection (like clearGamesRelatedByIdgame());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initGamesRelatedByIdgame()
    {
        $this->collGamesRelatedByIdgame = new PropelObjectCollection();
        $this->collGamesRelatedByIdgame->setModel('Game');
    }

    /**
     * Gets a collection of Game objects related by a many-to-many relationship
     * to the current object by way of the Game_List cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Player is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Game[] List of Game objects
     */
    public function getGamesRelatedByIdgame($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collGamesRelatedByIdgame || null !== $criteria) {
            if ($this->isNew() && null === $this->collGamesRelatedByIdgame) {
                // return empty collection
                $this->initGamesRelatedByIdgame();
            } else {
                $collGamesRelatedByIdgame = GameQuery::create(null, $criteria)
                    ->filterByPlayer($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collGamesRelatedByIdgame;
                }
                $this->collGamesRelatedByIdgame = $collGamesRelatedByIdgame;
            }
        }

        return $this->collGamesRelatedByIdgame;
    }

    /**
     * Sets a collection of Game objects related by a many-to-many relationship
     * to the current object by way of the Game_List cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $gamesRelatedByIdgame A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
     */
    public function setGamesRelatedByIdgame(PropelCollection $gamesRelatedByIdgame, PropelPDO $con = null)
    {
        $this->clearGamesRelatedByIdgame();
        $currentGamesRelatedByIdgame = $this->getGamesRelatedByIdgame();

        $this->gamesRelatedByIdgameScheduledForDeletion = $currentGamesRelatedByIdgame->diff($gamesRelatedByIdgame);

        foreach ($gamesRelatedByIdgame as $gameRelatedByIdgame) {
            if (!$currentGamesRelatedByIdgame->contains($gameRelatedByIdgame)) {
                $this->doAddGameRelatedByIdgame($gameRelatedByIdgame);
            }
        }

        $this->collGamesRelatedByIdgame = $gamesRelatedByIdgame;

        return $this;
    }

    /**
     * Gets the number of Game objects related by a many-to-many relationship
     * to the current object by way of the Game_List cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Game objects
     */
    public function countGamesRelatedByIdgame($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collGamesRelatedByIdgame || null !== $criteria) {
            if ($this->isNew() && null === $this->collGamesRelatedByIdgame) {
                return 0;
            } else {
                $query = GameQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPlayer($this)
                    ->count($con);
            }
        } else {
            return count($this->collGamesRelatedByIdgame);
        }
    }

    /**
     * Associate a Game object to this object
     * through the Game_List cross reference table.
     *
     * @param  Game $game The GameList object to relate
     * @return Player The current object (for fluent API support)
     */
    public function addGameRelatedByIdgame(Game $game)
    {
        if ($this->collGamesRelatedByIdgame === null) {
            $this->initGamesRelatedByIdgame();
        }
        if (!$this->collGamesRelatedByIdgame->contains($game)) { // only add it if the **same** object is not already associated
            $this->doAddGameRelatedByIdgame($game);

            $this->collGamesRelatedByIdgame[]= $game;
        }

        return $this;
    }

    /**
     * @param	GameRelatedByIdgame $gameRelatedByIdgame The gameRelatedByIdgame object to add.
     */
    protected function doAddGameRelatedByIdgame($gameRelatedByIdgame)
    {
        $gameList = new GameList();
        $gameList->setGameRelatedByIdgame($gameRelatedByIdgame);
        $this->addGameList($gameList);
    }

    /**
     * Remove a Game object to this object
     * through the Game_List cross reference table.
     *
     * @param Game $game The GameList object to relate
     * @return Player The current object (for fluent API support)
     */
    public function removeGameRelatedByIdgame(Game $game)
    {
        if ($this->getGamesRelatedByIdgame()->contains($game)) {
            $this->collGamesRelatedByIdgame->remove($this->collGamesRelatedByIdgame->search($game));
            if (null === $this->gamesRelatedByIdgameScheduledForDeletion) {
                $this->gamesRelatedByIdgameScheduledForDeletion = clone $this->collGamesRelatedByIdgame;
                $this->gamesRelatedByIdgameScheduledForDeletion->clear();
            }
            $this->gamesRelatedByIdgameScheduledForDeletion[]= $game;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->idplayer = null;
        $this->nameplayer = null;
        $this->mailplayer = null;
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
            if ($this->collGameLists) {
                foreach ($this->collGameLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGameListsRelatedByIdgame) {
                foreach ($this->collGameListsRelatedByIdgame as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonuses) {
                foreach ($this->collBonuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGamesRelatedByIdgame) {
                foreach ($this->collGamesRelatedByIdgame as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collGames instanceof PropelCollection) {
            $this->collGames->clearIterator();
        }
        $this->collGames = null;
        if ($this->collGameLists instanceof PropelCollection) {
            $this->collGameLists->clearIterator();
        }
        $this->collGameLists = null;
        if ($this->collGameListsRelatedByIdgame instanceof PropelCollection) {
            $this->collGameListsRelatedByIdgame->clearIterator();
        }
        $this->collGameListsRelatedByIdgame = null;
        if ($this->collBonuses instanceof PropelCollection) {
            $this->collBonuses->clearIterator();
        }
        $this->collBonuses = null;
        if ($this->collGamesRelatedByIdgame instanceof PropelCollection) {
            $this->collGamesRelatedByIdgame->clearIterator();
        }
        $this->collGamesRelatedByIdgame = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PlayerPeer::DEFAULT_STRING_FORMAT);
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
