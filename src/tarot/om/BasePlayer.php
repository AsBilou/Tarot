<?php


/**
 * Base class that represents a row from the 'player' table.
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
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the mail field.
     * @var        string
     */
    protected $mail;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collpCallers;
    protected $collpCallersPartial;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collpCalleds;
    protected $collpCalledsPartial;

    /**
     * @var        PropelObjectCollection|GamePlayer[] Collection to store aggregation of GamePlayer objects.
     */
    protected $collGamePlayers;
    protected $collGamePlayersPartial;

    /**
     * @var        PropelObjectCollection|TournamentPlayer[] Collection to store aggregation of TournamentPlayer objects.
     */
    protected $collTournamentPlayers;
    protected $collTournamentPlayersPartial;

    /**
     * @var        PropelObjectCollection|Bonus[] Collection to store aggregation of Bonus objects.
     */
    protected $collBonuses;

    /**
     * @var        PropelObjectCollection|Game[] Collection to store aggregation of Game objects.
     */
    protected $collGames;

    /**
     * @var        PropelObjectCollection|Tournament[] Collection to store aggregation of Tournament objects.
     */
    protected $collTournaments;

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
    protected $gamesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tournamentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pCallersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $pCalledsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gamePlayersScheduledForDeletion = null;

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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [mail] column value.
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Player The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = PlayerPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return Player The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = PlayerPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [mail] column.
     *
     * @param string $v new value
     * @return Player The current object (for fluent API support)
     */
    public function setMail($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->mail !== $v) {
            $this->mail = $v;
            $this->modifiedColumns[] = PlayerPeer::MAIL;
        }


        return $this;
    } // setMail()

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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->mail = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
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

            $this->collpCallers = null;

            $this->collpCalleds = null;

            $this->collGamePlayers = null;

            $this->collTournamentPlayers = null;

            $this->collBonuses = null;
            $this->collGames = null;
            $this->collTournaments = null;
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

            if ($this->gamesScheduledForDeletion !== null) {
                if (!$this->gamesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->gamesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    GamePlayerQuery::create()
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

            if ($this->tournamentsScheduledForDeletion !== null) {
                if (!$this->tournamentsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->tournamentsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    TournamentPlayerQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->tournamentsScheduledForDeletion = null;
                }

                foreach ($this->getTournaments() as $tournament) {
                    if ($tournament->isModified()) {
                        $tournament->save($con);
                    }
                }
            } elseif ($this->collTournaments) {
                foreach ($this->collTournaments as $tournament) {
                    if ($tournament->isModified()) {
                        $tournament->save($con);
                    }
                }
            }

            if ($this->pCallersScheduledForDeletion !== null) {
                if (!$this->pCallersScheduledForDeletion->isEmpty()) {
                    GameQuery::create()
                        ->filterByPrimaryKeys($this->pCallersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pCallersScheduledForDeletion = null;
                }
            }

            if ($this->collpCallers !== null) {
                foreach ($this->collpCallers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pCalledsScheduledForDeletion !== null) {
                if (!$this->pCalledsScheduledForDeletion->isEmpty()) {
                    foreach ($this->pCalledsScheduledForDeletion as $pCalled) {
                        // need to save related object because we set the relation to null
                        $pCalled->save($con);
                    }
                    $this->pCalledsScheduledForDeletion = null;
                }
            }

            if ($this->collpCalleds !== null) {
                foreach ($this->collpCalleds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
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

        $this->modifiedColumns[] = PlayerPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PlayerPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PlayerPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(PlayerPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(PlayerPeer::MAIL)) {
            $modifiedColumns[':p' . $index++]  = '`mail`';
        }

        $sql = sprintf(
            'INSERT INTO `player` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`mail`':
                        $stmt->bindValue($identifier, $this->mail, PDO::PARAM_STR);
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


            if (($retval = PlayerPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collpCallers !== null) {
                    foreach ($this->collpCallers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collpCalleds !== null) {
                    foreach ($this->collpCalleds as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collGamePlayers !== null) {
                    foreach ($this->collGamePlayers as $referrerFK) {
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
                return $this->getId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getMail();
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
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getMail(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collpCallers) {
                $result['pCallers'] = $this->collpCallers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collpCalleds) {
                $result['pCalleds'] = $this->collpCalleds->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGamePlayers) {
                $result['GamePlayers'] = $this->collGamePlayers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setMail($value);
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

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setMail($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PlayerPeer::DATABASE_NAME);

        if ($this->isColumnModified(PlayerPeer::ID)) $criteria->add(PlayerPeer::ID, $this->id);
        if ($this->isColumnModified(PlayerPeer::NAME)) $criteria->add(PlayerPeer::NAME, $this->name);
        if ($this->isColumnModified(PlayerPeer::MAIL)) $criteria->add(PlayerPeer::MAIL, $this->mail);

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
        $criteria->add(PlayerPeer::ID, $this->id);

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
     * @param object $copyObj An object of Player (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setMail($this->getMail());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getpCallers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addpCaller($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getpCalleds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addpCalled($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGamePlayers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGamePlayer($relObj->copy($deepCopy));
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
        if ('pCaller' == $relationName) {
            $this->initpCallers();
        }
        if ('pCalled' == $relationName) {
            $this->initpCalleds();
        }
        if ('GamePlayer' == $relationName) {
            $this->initGamePlayers();
        }
        if ('TournamentPlayer' == $relationName) {
            $this->initTournamentPlayers();
        }
    }

    /**
     * Clears out the collpCallers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
     * @see        addpCallers()
     */
    public function clearpCallers()
    {
        $this->collpCallers = null; // important to set this to null since that means it is uninitialized
        $this->collpCallersPartial = null;

        return $this;
    }

    /**
     * reset is the collpCallers collection loaded partially
     *
     * @return void
     */
    public function resetPartialpCallers($v = true)
    {
        $this->collpCallersPartial = $v;
    }

    /**
     * Initializes the collpCallers collection.
     *
     * By default this just sets the collpCallers collection to an empty array (like clearcollpCallers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initpCallers($overrideExisting = true)
    {
        if (null !== $this->collpCallers && !$overrideExisting) {
            return;
        }
        $this->collpCallers = new PropelObjectCollection();
        $this->collpCallers->setModel('Game');
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
    public function getpCallers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collpCallersPartial && !$this->isNew();
        if (null === $this->collpCallers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collpCallers) {
                // return empty collection
                $this->initpCallers();
            } else {
                $collpCallers = GameQuery::create(null, $criteria)
                    ->filterBycaller($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collpCallersPartial && count($collpCallers)) {
                      $this->initpCallers(false);

                      foreach($collpCallers as $obj) {
                        if (false == $this->collpCallers->contains($obj)) {
                          $this->collpCallers->append($obj);
                        }
                      }

                      $this->collpCallersPartial = true;
                    }

                    $collpCallers->getInternalIterator()->rewind();
                    return $collpCallers;
                }

                if($partial && $this->collpCallers) {
                    foreach($this->collpCallers as $obj) {
                        if($obj->isNew()) {
                            $collpCallers[] = $obj;
                        }
                    }
                }

                $this->collpCallers = $collpCallers;
                $this->collpCallersPartial = false;
            }
        }

        return $this->collpCallers;
    }

    /**
     * Sets a collection of pCaller objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pCallers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
     */
    public function setpCallers(PropelCollection $pCallers, PropelPDO $con = null)
    {
        $pCallersToDelete = $this->getpCallers(new Criteria(), $con)->diff($pCallers);

        $this->pCallersScheduledForDeletion = unserialize(serialize($pCallersToDelete));

        foreach ($pCallersToDelete as $pCallerRemoved) {
            $pCallerRemoved->setcaller(null);
        }

        $this->collpCallers = null;
        foreach ($pCallers as $pCaller) {
            $this->addpCaller($pCaller);
        }

        $this->collpCallers = $pCallers;
        $this->collpCallersPartial = false;

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
    public function countpCallers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collpCallersPartial && !$this->isNew();
        if (null === $this->collpCallers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collpCallers) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getpCallers());
            }
            $query = GameQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBycaller($this)
                ->count($con);
        }

        return count($this->collpCallers);
    }

    /**
     * Method called to associate a Game object to this object
     * through the Game foreign key attribute.
     *
     * @param    Game $l Game
     * @return Player The current object (for fluent API support)
     */
    public function addpCaller(Game $l)
    {
        if ($this->collpCallers === null) {
            $this->initpCallers();
            $this->collpCallersPartial = true;
        }
        if (!in_array($l, $this->collpCallers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddpCaller($l);
        }

        return $this;
    }

    /**
     * @param	pCaller $pCaller The pCaller object to add.
     */
    protected function doAddpCaller($pCaller)
    {
        $this->collpCallers[]= $pCaller;
        $pCaller->setcaller($this);
    }

    /**
     * @param	pCaller $pCaller The pCaller object to remove.
     * @return Player The current object (for fluent API support)
     */
    public function removepCaller($pCaller)
    {
        if ($this->getpCallers()->contains($pCaller)) {
            $this->collpCallers->remove($this->collpCallers->search($pCaller));
            if (null === $this->pCallersScheduledForDeletion) {
                $this->pCallersScheduledForDeletion = clone $this->collpCallers;
                $this->pCallersScheduledForDeletion->clear();
            }
            $this->pCallersScheduledForDeletion[]= clone $pCaller;
            $pCaller->setcaller(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related pCallers from storage.
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
    public function getpCallersJoinTournament($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameQuery::create(null, $criteria);
        $query->joinWith('Tournament', $join_behavior);

        return $this->getpCallers($query, $con);
    }

    /**
     * Clears out the collpCalleds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
     * @see        addpCalleds()
     */
    public function clearpCalleds()
    {
        $this->collpCalleds = null; // important to set this to null since that means it is uninitialized
        $this->collpCalledsPartial = null;

        return $this;
    }

    /**
     * reset is the collpCalleds collection loaded partially
     *
     * @return void
     */
    public function resetPartialpCalleds($v = true)
    {
        $this->collpCalledsPartial = $v;
    }

    /**
     * Initializes the collpCalleds collection.
     *
     * By default this just sets the collpCalleds collection to an empty array (like clearcollpCalleds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initpCalleds($overrideExisting = true)
    {
        if (null !== $this->collpCalleds && !$overrideExisting) {
            return;
        }
        $this->collpCalleds = new PropelObjectCollection();
        $this->collpCalleds->setModel('Game');
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
    public function getpCalleds($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collpCalledsPartial && !$this->isNew();
        if (null === $this->collpCalleds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collpCalleds) {
                // return empty collection
                $this->initpCalleds();
            } else {
                $collpCalleds = GameQuery::create(null, $criteria)
                    ->filterBycalled($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collpCalledsPartial && count($collpCalleds)) {
                      $this->initpCalleds(false);

                      foreach($collpCalleds as $obj) {
                        if (false == $this->collpCalleds->contains($obj)) {
                          $this->collpCalleds->append($obj);
                        }
                      }

                      $this->collpCalledsPartial = true;
                    }

                    $collpCalleds->getInternalIterator()->rewind();
                    return $collpCalleds;
                }

                if($partial && $this->collpCalleds) {
                    foreach($this->collpCalleds as $obj) {
                        if($obj->isNew()) {
                            $collpCalleds[] = $obj;
                        }
                    }
                }

                $this->collpCalleds = $collpCalleds;
                $this->collpCalledsPartial = false;
            }
        }

        return $this->collpCalleds;
    }

    /**
     * Sets a collection of pCalled objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pCalleds A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
     */
    public function setpCalleds(PropelCollection $pCalleds, PropelPDO $con = null)
    {
        $pCalledsToDelete = $this->getpCalleds(new Criteria(), $con)->diff($pCalleds);

        $this->pCalledsScheduledForDeletion = unserialize(serialize($pCalledsToDelete));

        foreach ($pCalledsToDelete as $pCalledRemoved) {
            $pCalledRemoved->setcalled(null);
        }

        $this->collpCalleds = null;
        foreach ($pCalleds as $pCalled) {
            $this->addpCalled($pCalled);
        }

        $this->collpCalleds = $pCalleds;
        $this->collpCalledsPartial = false;

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
    public function countpCalleds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collpCalledsPartial && !$this->isNew();
        if (null === $this->collpCalleds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collpCalleds) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getpCalleds());
            }
            $query = GameQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBycalled($this)
                ->count($con);
        }

        return count($this->collpCalleds);
    }

    /**
     * Method called to associate a Game object to this object
     * through the Game foreign key attribute.
     *
     * @param    Game $l Game
     * @return Player The current object (for fluent API support)
     */
    public function addpCalled(Game $l)
    {
        if ($this->collpCalleds === null) {
            $this->initpCalleds();
            $this->collpCalledsPartial = true;
        }
        if (!in_array($l, $this->collpCalleds->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddpCalled($l);
        }

        return $this;
    }

    /**
     * @param	pCalled $pCalled The pCalled object to add.
     */
    protected function doAddpCalled($pCalled)
    {
        $this->collpCalleds[]= $pCalled;
        $pCalled->setcalled($this);
    }

    /**
     * @param	pCalled $pCalled The pCalled object to remove.
     * @return Player The current object (for fluent API support)
     */
    public function removepCalled($pCalled)
    {
        if ($this->getpCalleds()->contains($pCalled)) {
            $this->collpCalleds->remove($this->collpCalleds->search($pCalled));
            if (null === $this->pCalledsScheduledForDeletion) {
                $this->pCalledsScheduledForDeletion = clone $this->collpCalleds;
                $this->pCalledsScheduledForDeletion->clear();
            }
            $this->pCalledsScheduledForDeletion[]= $pCalled;
            $pCalled->setcalled(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related pCalleds from storage.
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
    public function getpCalledsJoinTournament($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GameQuery::create(null, $criteria);
        $query->joinWith('Tournament', $join_behavior);

        return $this->getpCalleds($query, $con);
    }

    /**
     * Clears out the collGamePlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
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
     * If this Player is new, it will return
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
                    ->filterByPlayer($this)
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
     * @return Player The current object (for fluent API support)
     */
    public function setGamePlayers(PropelCollection $gamePlayers, PropelPDO $con = null)
    {
        $gamePlayersToDelete = $this->getGamePlayers(new Criteria(), $con)->diff($gamePlayers);

        $this->gamePlayersScheduledForDeletion = unserialize(serialize($gamePlayersToDelete));

        foreach ($gamePlayersToDelete as $gamePlayerRemoved) {
            $gamePlayerRemoved->setPlayer(null);
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
                ->filterByPlayer($this)
                ->count($con);
        }

        return count($this->collGamePlayers);
    }

    /**
     * Method called to associate a GamePlayer object to this object
     * through the GamePlayer foreign key attribute.
     *
     * @param    GamePlayer $l GamePlayer
     * @return Player The current object (for fluent API support)
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
        $gamePlayer->setPlayer($this);
    }

    /**
     * @param	GamePlayer $gamePlayer The gamePlayer object to remove.
     * @return Player The current object (for fluent API support)
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
            $gamePlayer->setPlayer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related GamePlayers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Player.
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
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related GamePlayers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Player.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|GamePlayer[] List of GamePlayer objects
     */
    public function getGamePlayersJoinGame($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = GamePlayerQuery::create(null, $criteria);
        $query->joinWith('Game', $join_behavior);

        return $this->getGamePlayers($query, $con);
    }

    /**
     * Clears out the collTournamentPlayers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
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
     * If this Player is new, it will return
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
                    ->filterByPlayer($this)
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
     * @return Player The current object (for fluent API support)
     */
    public function setTournamentPlayers(PropelCollection $tournamentPlayers, PropelPDO $con = null)
    {
        $tournamentPlayersToDelete = $this->getTournamentPlayers(new Criteria(), $con)->diff($tournamentPlayers);

        $this->tournamentPlayersScheduledForDeletion = unserialize(serialize($tournamentPlayersToDelete));

        foreach ($tournamentPlayersToDelete as $tournamentPlayerRemoved) {
            $tournamentPlayerRemoved->setPlayer(null);
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
                ->filterByPlayer($this)
                ->count($con);
        }

        return count($this->collTournamentPlayers);
    }

    /**
     * Method called to associate a TournamentPlayer object to this object
     * through the TournamentPlayer foreign key attribute.
     *
     * @param    TournamentPlayer $l TournamentPlayer
     * @return Player The current object (for fluent API support)
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
        $tournamentPlayer->setPlayer($this);
    }

    /**
     * @param	TournamentPlayer $tournamentPlayer The tournamentPlayer object to remove.
     * @return Player The current object (for fluent API support)
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
            $tournamentPlayer->setPlayer(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Player is new, it will return
     * an empty collection; or if this Player has previously
     * been saved, it will retrieve related TournamentPlayers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Player.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TournamentPlayer[] List of TournamentPlayer objects
     */
    public function getTournamentPlayersJoinTournament($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TournamentPlayerQuery::create(null, $criteria);
        $query->joinWith('Tournament', $join_behavior);

        return $this->getTournamentPlayers($query, $con);
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
     * to the current object by way of the game_player cross-reference table.
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
     * to the current object by way of the game_player cross-reference table.
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
                    ->filterByPlayer($this)
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
        $gamePlayer = new GamePlayer();
        $gamePlayer->setBonus($bonus);
        $this->addGamePlayer($gamePlayer);
    }

    /**
     * Remove a Bonus object to this object
     * through the game_player cross reference table.
     *
     * @param Bonus $bonus The GamePlayer object to relate
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
     * to the current object by way of the game_player cross-reference table.
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
    public function getGames($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collGames || null !== $criteria) {
            if ($this->isNew() && null === $this->collGames) {
                // return empty collection
                $this->initGames();
            } else {
                $collGames = GameQuery::create(null, $criteria)
                    ->filterByPlayer($this)
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
     * to the current object by way of the game_player cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $games A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
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
     * to the current object by way of the game_player cross-reference table.
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
                    ->filterByPlayer($this)
                    ->count($con);
            }
        } else {
            return count($this->collGames);
        }
    }

    /**
     * Associate a Game object to this object
     * through the game_player cross reference table.
     *
     * @param  Game $game The GamePlayer object to relate
     * @return Player The current object (for fluent API support)
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
        $gamePlayer = new GamePlayer();
        $gamePlayer->setGame($game);
        $this->addGamePlayer($gamePlayer);
    }

    /**
     * Remove a Game object to this object
     * through the game_player cross reference table.
     *
     * @param Game $game The GamePlayer object to relate
     * @return Player The current object (for fluent API support)
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
     * Clears out the collTournaments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Player The current object (for fluent API support)
     * @see        addTournaments()
     */
    public function clearTournaments()
    {
        $this->collTournaments = null; // important to set this to null since that means it is uninitialized
        $this->collTournamentsPartial = null;

        return $this;
    }

    /**
     * Initializes the collTournaments collection.
     *
     * By default this just sets the collTournaments collection to an empty collection (like clearTournaments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initTournaments()
    {
        $this->collTournaments = new PropelObjectCollection();
        $this->collTournaments->setModel('Tournament');
    }

    /**
     * Gets a collection of Tournament objects related by a many-to-many relationship
     * to the current object by way of the tournament_player cross-reference table.
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
     * @return PropelObjectCollection|Tournament[] List of Tournament objects
     */
    public function getTournaments($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collTournaments || null !== $criteria) {
            if ($this->isNew() && null === $this->collTournaments) {
                // return empty collection
                $this->initTournaments();
            } else {
                $collTournaments = TournamentQuery::create(null, $criteria)
                    ->filterByPlayer($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collTournaments;
                }
                $this->collTournaments = $collTournaments;
            }
        }

        return $this->collTournaments;
    }

    /**
     * Sets a collection of Tournament objects related by a many-to-many relationship
     * to the current object by way of the tournament_player cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tournaments A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Player The current object (for fluent API support)
     */
    public function setTournaments(PropelCollection $tournaments, PropelPDO $con = null)
    {
        $this->clearTournaments();
        $currentTournaments = $this->getTournaments();

        $this->tournamentsScheduledForDeletion = $currentTournaments->diff($tournaments);

        foreach ($tournaments as $tournament) {
            if (!$currentTournaments->contains($tournament)) {
                $this->doAddTournament($tournament);
            }
        }

        $this->collTournaments = $tournaments;

        return $this;
    }

    /**
     * Gets the number of Tournament objects related by a many-to-many relationship
     * to the current object by way of the tournament_player cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related Tournament objects
     */
    public function countTournaments($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collTournaments || null !== $criteria) {
            if ($this->isNew() && null === $this->collTournaments) {
                return 0;
            } else {
                $query = TournamentQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPlayer($this)
                    ->count($con);
            }
        } else {
            return count($this->collTournaments);
        }
    }

    /**
     * Associate a Tournament object to this object
     * through the tournament_player cross reference table.
     *
     * @param  Tournament $tournament The TournamentPlayer object to relate
     * @return Player The current object (for fluent API support)
     */
    public function addTournament(Tournament $tournament)
    {
        if ($this->collTournaments === null) {
            $this->initTournaments();
        }
        if (!$this->collTournaments->contains($tournament)) { // only add it if the **same** object is not already associated
            $this->doAddTournament($tournament);

            $this->collTournaments[]= $tournament;
        }

        return $this;
    }

    /**
     * @param	Tournament $tournament The tournament object to add.
     */
    protected function doAddTournament($tournament)
    {
        $tournamentPlayer = new TournamentPlayer();
        $tournamentPlayer->setTournament($tournament);
        $this->addTournamentPlayer($tournamentPlayer);
    }

    /**
     * Remove a Tournament object to this object
     * through the tournament_player cross reference table.
     *
     * @param Tournament $tournament The TournamentPlayer object to relate
     * @return Player The current object (for fluent API support)
     */
    public function removeTournament(Tournament $tournament)
    {
        if ($this->getTournaments()->contains($tournament)) {
            $this->collTournaments->remove($this->collTournaments->search($tournament));
            if (null === $this->tournamentsScheduledForDeletion) {
                $this->tournamentsScheduledForDeletion = clone $this->collTournaments;
                $this->tournamentsScheduledForDeletion->clear();
            }
            $this->tournamentsScheduledForDeletion[]= $tournament;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->mail = null;
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
            if ($this->collpCallers) {
                foreach ($this->collpCallers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collpCalleds) {
                foreach ($this->collpCalleds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGamePlayers) {
                foreach ($this->collGamePlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTournamentPlayers) {
                foreach ($this->collTournamentPlayers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBonuses) {
                foreach ($this->collBonuses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGames) {
                foreach ($this->collGames as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTournaments) {
                foreach ($this->collTournaments as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collpCallers instanceof PropelCollection) {
            $this->collpCallers->clearIterator();
        }
        $this->collpCallers = null;
        if ($this->collpCalleds instanceof PropelCollection) {
            $this->collpCalleds->clearIterator();
        }
        $this->collpCalleds = null;
        if ($this->collGamePlayers instanceof PropelCollection) {
            $this->collGamePlayers->clearIterator();
        }
        $this->collGamePlayers = null;
        if ($this->collTournamentPlayers instanceof PropelCollection) {
            $this->collTournamentPlayers->clearIterator();
        }
        $this->collTournamentPlayers = null;
        if ($this->collBonuses instanceof PropelCollection) {
            $this->collBonuses->clearIterator();
        }
        $this->collBonuses = null;
        if ($this->collGames instanceof PropelCollection) {
            $this->collGames->clearIterator();
        }
        $this->collGames = null;
        if ($this->collTournaments instanceof PropelCollection) {
            $this->collTournaments->clearIterator();
        }
        $this->collTournaments = null;
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
