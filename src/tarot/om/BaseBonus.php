<?php


/**
 * Base class that represents a row from the 'Bonus' table.
 *
 *
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseBonus extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'BonusPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BonusPeer
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
     * The value for the namebonus field.
     * @var        string
     */
    protected $namebonus;

    /**
     * The value for the valuebonus field.
     * @var        int
     */
    protected $valuebonus;

    /**
     * @var        PropelObjectCollection|GameList[] Collection to store aggregation of GameList objects.
     */
    protected $collGameLists;
    protected $collGameListsPartial;

    /**
     * @var        PropelObjectCollection|Player[] Collection to store aggregation of Player objects.
     */
    protected $collPlayers;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collGames;

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
    protected $gameListsScheduledForDeletion = null;

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
     * Get the [namebonus] column value.
     *
     * @return string
     */
    public function getNamebonus()
    {
        return $this->namebonus;
    }

    /**
     * Get the [valuebonus] column value.
     *
     * @return int
     */
    public function getValuebonus()
    {
        return $this->valuebonus;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Bonus The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BonusPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [namebonus] column.
     *
     * @param string $v new value
     * @return Bonus The current object (for fluent API support)
     */
    public function setNamebonus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->namebonus !== $v) {
            $this->namebonus = $v;
            $this->modifiedColumns[] = BonusPeer::NAMEBONUS;
        }


        return $this;
    } // setNamebonus()

    /**
     * Set the value of [valuebonus] column.
     *
     * @param int $v new value
     * @return Bonus The current object (for fluent API support)
     */
    public function setValuebonus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->valuebonus !== $v) {
            $this->valuebonus = $v;
            $this->modifiedColumns[] = BonusPeer::VALUEBONUS;
        }


        return $this;
    } // setValuebonus()

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
            $this->namebonus = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->valuebonus = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = BonusPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Bonus object", $e);
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
            $con = Propel::getConnection(BonusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BonusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGameLists = null;

            $this->collPlayers = null;
            $this->collGames = null;
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
            $con = Propel::getConnection(BonusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BonusQuery::create()
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
            $con = Propel::getConnection(BonusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                BonusPeer::addInstanceToPool($this);
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
                    GameListQuery::create()
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
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->gamesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    GameListQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->gamesScheduledForDeletion = null;
                }

                foreach ($this->getGames() as $game) {
                    if ($game->isModified()) {
                        $game->save($con);
                    }
                }
            } elseif ($this->collGames) {
                foreach ($this->collGames as $game) {
                    if ($game->isModified()) {
                        $game->save($con);
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

        $this->modifiedColumns[] = BonusPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BonusPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BonusPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(BonusPeer::NAMEBONUS)) {
            $modifiedColumns[':p' . $index++]  = '`nameBonus`';
        }
        if ($this->isColumnModified(BonusPeer::VALUEBONUS)) {
            $modifiedColumns[':p' . $index++]  = '`valueBonus`';
        }

        $sql = sprintf(
            'INSERT INTO `Bonus` (%s) VALUES (%s)',
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
                    case '`nameBonus`':
                        $stmt->bindValue($identifier, $this->namebonus, PDO::PARAM_STR);
                        break;
                    case '`valueBonus`':
                        $stmt->bindValue($identifier, $this->valuebonus, PDO::PARAM_INT);
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


            if (($retval = BonusPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = BonusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getNamebonus();
                break;
            case 2:
                return $this->getValuebonus();
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
        if (isset($alreadyDumpedObjects['Bonus'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Bonus'][$this->getPrimaryKey()] = true;
        $keys = BonusPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNamebonus(),
            $keys[2] => $this->getValuebonus(),
        );
        if ($includeForeignObjects) {
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
        $pos = BonusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setNamebonus($value);
                break;
            case 2:
                $this->setValuebonus($value);
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
        $keys = BonusPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNamebonus($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setValuebonus($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BonusPeer::DATABASE_NAME);

        if ($this->isColumnModified(BonusPeer::ID)) $criteria->add(BonusPeer::ID, $this->id);
        if ($this->isColumnModified(BonusPeer::NAMEBONUS)) $criteria->add(BonusPeer::NAMEBONUS, $this->namebonus);
        if ($this->isColumnModified(BonusPeer::VALUEBONUS)) $criteria->add(BonusPeer::VALUEBONUS, $this->valuebonus);

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
        $criteria = new Criteria(BonusPeer::DATABASE_NAME);
        $criteria->add(BonusPeer::ID, $this->id);

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
     * @param object $copyObj An object of Bonus (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNamebonus($this->getNamebonus());
        $copyObj->setValuebonus($this->getValuebonus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return Bonus Clone of current object.
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
     * @return BonusPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BonusPeer();
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
        if ('GameList' == $relationName) {
            $this->initGameLists();
        }
    }

    /**
     * Clears out the collGameLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Bonus The current object (for fluent API support)
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
     * If this Bonus is new, it will return
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
                    ->filterByBonus($this)
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
     * @return Bonus The current object (for fluent API support)
     */
    public function setGameLists(PropelCollection $gameLists, PropelPDO $con = null)
    {
        $gameListsToDelete = $this->getGameLists(new Criteria(), $con)->diff($gameLists);

        $this->gameListsScheduledForDeletion = unserialize(serialize($gameListsToDelete));

        foreach ($gameListsToDelete as $gameListRemoved) {
            $gameListRemoved->setBonus(null);
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
                ->filterByBonus($this)
                ->count($con);
        }

        return count($this->collGameLists);
    }

    /**
     * Method called to associate a GameList object to this object
     * through the GameList foreign key attribute.
     *
     * @param    GameList $l GameList
     * @return Bonus The current object (for fluent API support)
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
        $gameList->setBonus($this);
    }

    /**
     * @param	GameList $gameList The gameList object to remove.
     * @return Bonus The current object (for fluent API support)
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
            $gameList->setBonus(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bonus is new, it will return
     * an empty collection; or if this Bonus has previously
     * been saved, it will retrieve related GameLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bonus.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GameList[] List of GameList objects
     */
    public function getGameListsJoinPlayer($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameListQuery::create(null, $criteria);
        $query->joinWith('Player', $join_behavior);

        return $this->getGameLists($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Bonus is new, it will return
     * an empty collection; or if this Bonus has previously
     * been saved, it will retrieve related GameLists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Bonus.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GameList[] List of GameList objects
     */
    public function getGameListsJoinGame($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameListQuery::create(null, $criteria);
        $query->joinWith('Game', $join_behavior);

        return $this->getGameLists($query, $con);
    }

    /**
     * Clears out the collPlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Bonus The current object (for fluent API support)
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
     * to the current object by way of the Game_List cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Bonus is new, it will return
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
                    ->filterByBonus($this)
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
     * to the current object by way of the Game_List cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $players A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Bonus The current object (for fluent API support)
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
     * to the current object by way of the Game_List cross-reference table.
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
                    ->filterByBonus($this)
                    ->count($con);
            }
        } else {
            return count($this->collPlayers);
        }
    }

    /**
     * Associate a Player object to this object
     * through the Game_List cross reference table.
     *
     * @param  Player $player The GameList object to relate
     * @return Bonus The current object (for fluent API support)
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
        $gameList = new GameList();
        $gameList->setPlayer($player);
        $this->addGameList($gameList);
    }

    /**
     * Remove a Player object to this object
     * through the Game_List cross reference table.
     *
     * @param Player $player The GameList object to relate
     * @return Bonus The current object (for fluent API support)
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
     * Clears out the collGames collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Bonus The current object (for fluent API support)
     * @see        addGames()
     */
    public function clearGames()
    {
        $this->collGames = null; // important to set this to null since that means it is uninitialized
        $this->collGamesPartial = null;

        return $this;
    }

    /**
     * Initializes the collGames collection.
     *
     * By default this just sets the collGames collection to an empty collection (like clearGames());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initGames()
    {
        $this->collGames = new PropelObjectCollection();
        $this->collGames->setModel('Game');
    }

    /**
     * Gets a collection of Game objects related by a many-to-many relationship
     * to the current object by way of the Game_List cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Bonus is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|Game[] List of Game objects
     */
    public function getGames($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collGames || null !== $criteria) {
            if ($this->isNew() && null === $this->collGames) {
                // return empty collection
                $this->initGames();
            } else {
                $collGames = GameQuery::create(null, $criteria)
                    ->filterByBonus($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collGames;
                }
                $this->collGames = $collGames;
            }
        }

        return $this->collGames;
    }

    /**
     * Sets a collection of Game objects related by a many-to-many relationship
     * to the current object by way of the Game_List cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $games A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Bonus The current object (for fluent API support)
     */
    public function setGames(PropelCollection $games, PropelPDO $con = null)
    {
        $this->clearGames();
        $currentGames = $this->getGames();

        $this->gamesScheduledForDeletion = $currentGames->diff($games);

        foreach ($games as $game) {
            if (!$currentGames->contains($game)) {
                $this->doAddGame($game);
            }
        }

        $this->collGames = $games;

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
    public function countGames($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collGames || null !== $criteria) {
            if ($this->isNew() && null === $this->collGames) {
                return 0;
            } else {
                $query = GameQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBonus($this)
                    ->count($con);
            }
        } else {
            return count($this->collGames);
        }
    }

    /**
     * Associate a Game object to this object
     * through the Game_List cross reference table.
     *
     * @param  Game $game The GameList object to relate
     * @return Bonus The current object (for fluent API support)
     */
    public function addGame(Game $game)
    {
        if ($this->collGames === null) {
            $this->initGames();
        }
        if (!$this->collGames->contains($game)) { // only add it if the **same** object is not already associated
            $this->doAddGame($game);

            $this->collGames[]= $game;
        }

        return $this;
    }

    /**
     * @param	Game $game The game object to add.
     */
    protected function doAddGame($game)
    {
        $gameList = new GameList();
        $gameList->setGame($game);
        $this->addGameList($gameList);
    }

    /**
     * Remove a Game object to this object
     * through the Game_List cross reference table.
     *
     * @param Game $game The GameList object to relate
     * @return Bonus The current object (for fluent API support)
     */
    public function removeGame(Game $game)
    {
        if ($this->getGames()->contains($game)) {
            $this->collGames->remove($this->collGames->search($game));
            if (null === $this->gamesScheduledForDeletion) {
                $this->gamesScheduledForDeletion = clone $this->collGames;
                $this->gamesScheduledForDeletion->clear();
            }
            $this->gamesScheduledForDeletion[]= $game;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->namebonus = null;
        $this->valuebonus = null;
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
            if ($this->collGameLists) {
                foreach ($this->collGameLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPlayers) {
                foreach ($this->collPlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGames) {
                foreach ($this->collGames as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collGameLists instanceof PropelCollection) {
            $this->collGameLists->clearIterator();
        }
        $this->collGameLists = null;
        if ($this->collPlayers instanceof PropelCollection) {
            $this->collPlayers->clearIterator();
        }
        $this->collPlayers = null;
        if ($this->collGames instanceof PropelCollection) {
            $this->collGames->clearIterator();
        }
        $this->collGames = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BonusPeer::DEFAULT_STRING_FORMAT);
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
