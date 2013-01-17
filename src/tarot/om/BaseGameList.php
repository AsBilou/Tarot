<?php


/**
 * Base class that represents a row from the 'Game_List' table.
 *
 *
 *
 * @package    propel.generator.tarot.om
 */
abstract class BaseGameList extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'GameListPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        GameListPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the idgame field.
     * @var        int
     */
    protected $idgame;

    /**
     * The value for the idplayer field.
     * @var        int
     */
    protected $idplayer;

    /**
     * The value for the idbonus field.
     * @var        int
     */
    protected $idbonus;

    /**
     * @var        Bonus
     */
    protected $aBonus;

    /**
     * @var        Player
     */
    protected $aPlayer;

    /**
     * @var        Game
     */
    protected $aGameRelatedByIdgame;

    /**
     * @var        Game one-to-one related Game object
     */
    protected $singleGameRelatedByIdgame;

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
    protected $gamesRelatedByIdgameScheduledForDeletion = null;

    /**
     * Get the [idgame] column value.
     *
     * @return int
     */
    public function getIdgame()
    {
        return $this->idgame;
    }

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
     * Get the [idbonus] column value.
     *
     * @return int
     */
    public function getIdbonus()
    {
        return $this->idbonus;
    }

    /**
     * Set the value of [idgame] column.
     *
     * @param int $v new value
     * @return GameList The current object (for fluent API support)
     */
    public function setIdgame($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->idgame !== $v) {
            $this->idgame = $v;
            $this->modifiedColumns[] = GameListPeer::IDGAME;
        }

        if ($this->aGameRelatedByIdgame !== null && $this->aGameRelatedByIdgame->getIdgame() !== $v) {
            $this->aGameRelatedByIdgame = null;
        }


        return $this;
    } // setIdgame()

    /**
     * Set the value of [idplayer] column.
     *
     * @param int $v new value
     * @return GameList The current object (for fluent API support)
     */
    public function setIdplayer($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->idplayer !== $v) {
            $this->idplayer = $v;
            $this->modifiedColumns[] = GameListPeer::IDPLAYER;
        }

        if ($this->aPlayer !== null && $this->aPlayer->getIdplayer() !== $v) {
            $this->aPlayer = null;
        }


        return $this;
    } // setIdplayer()

    /**
     * Set the value of [idbonus] column.
     *
     * @param int $v new value
     * @return GameList The current object (for fluent API support)
     */
    public function setIdbonus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->idbonus !== $v) {
            $this->idbonus = $v;
            $this->modifiedColumns[] = GameListPeer::IDBONUS;
        }

        if ($this->aBonus !== null && $this->aBonus->getIdbonus() !== $v) {
            $this->aBonus = null;
        }


        return $this;
    } // setIdbonus()

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

            $this->idgame = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->idplayer = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->idbonus = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = GameListPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating GameList object", $e);
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

        if ($this->aGameRelatedByIdgame !== null && $this->idgame !== $this->aGameRelatedByIdgame->getIdgame()) {
            $this->aGameRelatedByIdgame = null;
        }
        if ($this->aPlayer !== null && $this->idplayer !== $this->aPlayer->getIdplayer()) {
            $this->aPlayer = null;
        }
        if ($this->aBonus !== null && $this->idbonus !== $this->aBonus->getIdbonus()) {
            $this->aBonus = null;
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
            $con = Propel::getConnection(GameListPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = GameListPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBonus = null;
            $this->aPlayer = null;
            $this->aGameRelatedByIdgame = null;
            $this->singleGameRelatedByIdgame = null;

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
            $con = Propel::getConnection(GameListPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = GameListQuery::create()
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
            $con = Propel::getConnection(GameListPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                GameListPeer::addInstanceToPool($this);
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

            if ($this->aBonus !== null) {
                if ($this->aBonus->isModified() || $this->aBonus->isNew()) {
                    $affectedRows += $this->aBonus->save($con);
                }
                $this->setBonus($this->aBonus);
            }

            if ($this->aPlayer !== null) {
                if ($this->aPlayer->isModified() || $this->aPlayer->isNew()) {
                    $affectedRows += $this->aPlayer->save($con);
                }
                $this->setPlayer($this->aPlayer);
            }

            if ($this->aGameRelatedByIdgame !== null) {
                if ($this->aGameRelatedByIdgame->isModified() || $this->aGameRelatedByIdgame->isNew()) {
                    $affectedRows += $this->aGameRelatedByIdgame->save($con);
                }
                $this->setGameRelatedByIdgame($this->aGameRelatedByIdgame);
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

            if ($this->playersScheduledForDeletion !== null) {
                if (!$this->playersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->playersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    GameRelatedByIdgameQuery::create()
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

            if ($this->gamesRelatedByIdgameScheduledForDeletion !== null) {
                if (!$this->gamesRelatedByIdgameScheduledForDeletion->isEmpty()) {
                    GameQuery::create()
                        ->filterByPrimaryKeys($this->gamesRelatedByIdgameScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gamesRelatedByIdgameScheduledForDeletion = null;
                }
            }

            if ($this->singleGameRelatedByIdgame !== null) {
                if (!$this->singleGameRelatedByIdgame->isDeleted() && ($this->singleGameRelatedByIdgame->isNew() || $this->singleGameRelatedByIdgame->isModified())) {
                        $affectedRows += $this->singleGameRelatedByIdgame->save($con);
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

        $this->modifiedColumns[] = GameListPeer::IDGAME;
        if (null !== $this->idgame) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GameListPeer::IDGAME . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GameListPeer::IDGAME)) {
            $modifiedColumns[':p' . $index++]  = '`idGame`';
        }
        if ($this->isColumnModified(GameListPeer::IDPLAYER)) {
            $modifiedColumns[':p' . $index++]  = '`idPlayer`';
        }
        if ($this->isColumnModified(GameListPeer::IDBONUS)) {
            $modifiedColumns[':p' . $index++]  = '`idBonus`';
        }

        $sql = sprintf(
            'INSERT INTO `Game_List` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`idGame`':
                        $stmt->bindValue($identifier, $this->idgame, PDO::PARAM_INT);
                        break;
                    case '`idPlayer`':
                        $stmt->bindValue($identifier, $this->idplayer, PDO::PARAM_INT);
                        break;
                    case '`idBonus`':
                        $stmt->bindValue($identifier, $this->idbonus, PDO::PARAM_INT);
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
        $this->setIdgame($pk);

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

            if ($this->aBonus !== null) {
                if (!$this->aBonus->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBonus->getValidationFailures());
                }
            }

            if ($this->aPlayer !== null) {
                if (!$this->aPlayer->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aPlayer->getValidationFailures());
                }
            }

            if ($this->aGameRelatedByIdgame !== null) {
                if (!$this->aGameRelatedByIdgame->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aGameRelatedByIdgame->getValidationFailures());
                }
            }


            if (($retval = GameListPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->singleGameRelatedByIdgame !== null) {
                    if (!$this->singleGameRelatedByIdgame->validate($columns)) {
                        $failureMap = array_merge($failureMap, $this->singleGameRelatedByIdgame->getValidationFailures());
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
        $pos = GameListPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIdgame();
                break;
            case 1:
                return $this->getIdplayer();
                break;
            case 2:
                return $this->getIdbonus();
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
        if (isset($alreadyDumpedObjects['GameList'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['GameList'][serialize($this->getPrimaryKey())] = true;
        $keys = GameListPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdgame(),
            $keys[1] => $this->getIdplayer(),
            $keys[2] => $this->getIdbonus(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aBonus) {
                $result['Bonus'] = $this->aBonus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPlayer) {
                $result['Player'] = $this->aPlayer->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGameRelatedByIdgame) {
                $result['GameRelatedByIdgame'] = $this->aGameRelatedByIdgame->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->singleGameRelatedByIdgame) {
                $result['GameRelatedByIdgame'] = $this->singleGameRelatedByIdgame->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
        $pos = GameListPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdgame($value);
                break;
            case 1:
                $this->setIdplayer($value);
                break;
            case 2:
                $this->setIdbonus($value);
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
        $keys = GameListPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdgame($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setIdplayer($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setIdbonus($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GameListPeer::DATABASE_NAME);

        if ($this->isColumnModified(GameListPeer::IDGAME)) $criteria->add(GameListPeer::IDGAME, $this->idgame);
        if ($this->isColumnModified(GameListPeer::IDPLAYER)) $criteria->add(GameListPeer::IDPLAYER, $this->idplayer);
        if ($this->isColumnModified(GameListPeer::IDBONUS)) $criteria->add(GameListPeer::IDBONUS, $this->idbonus);

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
        $criteria = new Criteria(GameListPeer::DATABASE_NAME);
        $criteria->add(GameListPeer::IDGAME, $this->idgame);
        $criteria->add(GameListPeer::IDPLAYER, $this->idplayer);
        $criteria->add(GameListPeer::IDBONUS, $this->idbonus);

        return $criteria;
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getIdgame();
        $pks[1] = $this->getIdplayer();
        $pks[2] = $this->getIdbonus();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setIdgame($keys[0]);
        $this->setIdplayer($keys[1]);
        $this->setIdbonus($keys[2]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getIdgame()) && (null === $this->getIdplayer()) && (null === $this->getIdbonus());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of GameList (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdplayer($this->getIdplayer());
        $copyObj->setIdbonus($this->getIdbonus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            $relObj = $this->getGameRelatedByIdgame();
            if ($relObj) {
                $copyObj->setGameRelatedByIdgame($relObj->copy($deepCopy));
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdgame(NULL); // this is a auto-increment column, so set to default value
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
     * @return GameList Clone of current object.
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
     * @return GameListPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new GameListPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Bonus object.
     *
     * @param             Bonus $v
     * @return GameList The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBonus(Bonus $v = null)
    {
        if ($v === null) {
            $this->setIdbonus(NULL);
        } else {
            $this->setIdbonus($v->getIdbonus());
        }

        $this->aBonus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Bonus object, it will not be re-added.
        if ($v !== null) {
            $v->addGameList($this);
        }


        return $this;
    }


    /**
     * Get the associated Bonus object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Bonus The associated Bonus object.
     * @throws PropelException
     */
    public function getBonus(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBonus === null && ($this->idbonus !== null) && $doQuery) {
            $this->aBonus = BonusQuery::create()->findPk($this->idbonus, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBonus->addGameLists($this);
             */
        }

        return $this->aBonus;
    }

    /**
     * Declares an association between this object and a Player object.
     *
     * @param             Player $v
     * @return GameList The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPlayer(Player $v = null)
    {
        if ($v === null) {
            $this->setIdplayer(NULL);
        } else {
            $this->setIdplayer($v->getIdplayer());
        }

        $this->aPlayer = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Player object, it will not be re-added.
        if ($v !== null) {
            $v->addGameList($this);
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
    public function getPlayer(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aPlayer === null && ($this->idplayer !== null) && $doQuery) {
            $this->aPlayer = PlayerQuery::create()->findPk($this->idplayer, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPlayer->addGameLists($this);
             */
        }

        return $this->aPlayer;
    }

    /**
     * Declares an association between this object and a Game object.
     *
     * @param             Game $v
     * @return GameList The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGameRelatedByIdgame(Game $v = null)
    {
        if ($v === null) {
            $this->setIdgame(NULL);
        } else {
            $this->setIdgame($v->getIdgame());
        }

        $this->aGameRelatedByIdgame = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Game object, it will not be re-added.
        if ($v !== null) {
            $v->addGameListRelatedByIdgame($this);
        }


        return $this;
    }


    /**
     * Get the associated Game object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Game The associated Game object.
     * @throws PropelException
     */
    public function getGameRelatedByIdgame(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aGameRelatedByIdgame === null && ($this->idgame !== null) && $doQuery) {
            $this->aGameRelatedByIdgame = GameQuery::create()->findPk($this->idgame, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGameRelatedByIdgame->addGameListsRelatedByIdgame($this);
             */
        }

        return $this->aGameRelatedByIdgame;
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
    }

    /**
     * Gets a single Game object, which is related to this object by a one-to-one relationship.
     *
     * @param PropelPDO $con optional connection object
     * @return Game
     * @throws PropelException
     */
    public function getGameRelatedByIdgame(PropelPDO $con = null)
    {

        if ($this->singleGameRelatedByIdgame === null && !$this->isNew()) {
            $this->singleGameRelatedByIdgame = GameQuery::create()->findPk($this->getPrimaryKey(), $con);
        }

        return $this->singleGameRelatedByIdgame;
    }

    /**
     * Sets a single Game object as related to this object by a one-to-one relationship.
     *
     * @param             Game $v Game
     * @return GameList The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGameRelatedByIdgame(Game $v = null)
    {
        $this->singleGameRelatedByIdgame = $v;

        // Make sure that that the passed-in Game isn't already associated with this object
        if ($v !== null && $v->getGameListRelatedByIdgame(null, false) === null) {
            $v->setGameListRelatedByIdgame($this);
        }

        return $this;
    }

    /**
     * Clears out the collPlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return GameList The current object (for fluent API support)
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
     * to the current object by way of the Game cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this GameList is new, it will return
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
                    ->filterByGameListRelatedByIdgame($this)
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
     * to the current object by way of the Game cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $players A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return GameList The current object (for fluent API support)
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
     * to the current object by way of the Game cross-reference table.
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
                    ->filterByGameListRelatedByIdgame($this)
                    ->count($con);
            }
        } else {
            return count($this->collPlayers);
        }
    }

    /**
     * Associate a Player object to this object
     * through the Game cross reference table.
     *
     * @param  Player $player The Game object to relate
     * @return GameList The current object (for fluent API support)
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
        $game = new Game();
        $game->setPlayer($player);
        $this->addGameRelatedByIdgame($game);
    }

    /**
     * Remove a Player object to this object
     * through the Game cross reference table.
     *
     * @param Player $player The Game object to relate
     * @return GameList The current object (for fluent API support)
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
        $this->idgame = null;
        $this->idplayer = null;
        $this->idbonus = null;
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
            if ($this->singleGameRelatedByIdgame) {
                $this->singleGameRelatedByIdgame->clearAllReferences($deep);
            }
            if ($this->collPlayers) {
                foreach ($this->collPlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aBonus instanceof Persistent) {
              $this->aBonus->clearAllReferences($deep);
            }
            if ($this->aPlayer instanceof Persistent) {
              $this->aPlayer->clearAllReferences($deep);
            }
            if ($this->aGameRelatedByIdgame instanceof Persistent) {
              $this->aGameRelatedByIdgame->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->singleGameRelatedByIdgame instanceof PropelCollection) {
            $this->singleGameRelatedByIdgame->clearIterator();
        }
        $this->singleGameRelatedByIdgame = null;
        if ($this->collPlayers instanceof PropelCollection) {
            $this->collPlayers->clearIterator();
        }
        $this->collPlayers = null;
        $this->aBonus = null;
        $this->aPlayer = null;
        $this->aGameRelatedByIdgame = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GameListPeer::DEFAULT_STRING_FORMAT);
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
