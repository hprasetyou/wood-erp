<?php

namespace Base;

use \Component as ChildComponent;
use \ComponentPartner as ChildComponentPartner;
use \ComponentPartnerQuery as ChildComponentPartnerQuery;
use \ComponentQuery as ChildComponentQuery;
use \Material as ChildMaterial;
use \MaterialQuery as ChildMaterialQuery;
use \ProductComponent as ChildProductComponent;
use \ProductComponentQuery as ChildProductComponentQuery;
use \PurchaseOrderLine as ChildPurchaseOrderLine;
use \PurchaseOrderLineQuery as ChildPurchaseOrderLineQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ComponentPartnerTableMap;
use Map\ComponentTableMap;
use Map\ProductComponentTableMap;
use Map\PurchaseOrderLineTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'component' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Component implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ComponentTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the material_id field.
     *
     * @var        int
     */
    protected $material_id;

    /**
     * The value for the type field.
     *
     * Note: this column has a database default value of: 'component'
     * @var        string
     */
    protected $type;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $updated_at;

    /**
     * @var        ChildMaterial
     */
    protected $aMaterial;

    /**
     * @var        ObjectCollection|ChildProductComponent[] Collection to store aggregation of ChildProductComponent objects.
     */
    protected $collProductComponents;
    protected $collProductComponentsPartial;

    /**
     * @var        ObjectCollection|ChildPurchaseOrderLine[] Collection to store aggregation of ChildPurchaseOrderLine objects.
     */
    protected $collPurchaseOrderLines;
    protected $collPurchaseOrderLinesPartial;

    /**
     * @var        ObjectCollection|ChildComponentPartner[] Collection to store aggregation of ChildComponentPartner objects.
     */
    protected $collComponentPartners;
    protected $collComponentPartnersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductComponent[]
     */
    protected $productComponentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPurchaseOrderLine[]
     */
    protected $purchaseOrderLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildComponentPartner[]
     */
    protected $componentPartnersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->type = 'component';
    }

    /**
     * Initializes internal state of Base\Component object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Component</code> instance.  If
     * <code>obj</code> is an instance of <code>Component</code>, delegates to
     * <code>equals(Component)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Component The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

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
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [material_id] column value.
     *
     * @return int
     */
    public function getMaterialId()
    {
        return $this->material_id;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ComponentTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[ComponentTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ComponentTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [material_id] column.
     *
     * @param int $v new value
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setMaterialId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->material_id !== $v) {
            $this->material_id = $v;
            $this->modifiedColumns[ComponentTableMap::COL_MATERIAL_ID] = true;
        }

        if ($this->aMaterial !== null && $this->aMaterial->getId() !== $v) {
            $this->aMaterial = null;
        }

        return $this;
    } // setMaterialId()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[ComponentTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ComponentTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Component The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ComponentTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

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
            if ($this->type !== 'component') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ComponentTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ComponentTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ComponentTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ComponentTableMap::translateFieldName('MaterialId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->material_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ComponentTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ComponentTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ComponentTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = ComponentTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Component'), 0, $e);
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
        if ($this->aMaterial !== null && $this->material_id !== $this->aMaterial->getId()) {
            $this->aMaterial = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ComponentTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildComponentQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMaterial = null;
            $this->collProductComponents = null;

            $this->collPurchaseOrderLines = null;

            $this->collComponentPartners = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Component::setDeleted()
     * @see Component::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildComponentQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                ComponentTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aMaterial !== null) {
                if ($this->aMaterial->isModified() || $this->aMaterial->isNew()) {
                    $affectedRows += $this->aMaterial->save($con);
                }
                $this->setMaterial($this->aMaterial);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->productComponentsScheduledForDeletion !== null) {
                if (!$this->productComponentsScheduledForDeletion->isEmpty()) {
                    \ProductComponentQuery::create()
                        ->filterByPrimaryKeys($this->productComponentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productComponentsScheduledForDeletion = null;
                }
            }

            if ($this->collProductComponents !== null) {
                foreach ($this->collProductComponents as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->purchaseOrderLinesScheduledForDeletion !== null) {
                if (!$this->purchaseOrderLinesScheduledForDeletion->isEmpty()) {
                    foreach ($this->purchaseOrderLinesScheduledForDeletion as $purchaseOrderLine) {
                        // need to save related object because we set the relation to null
                        $purchaseOrderLine->save($con);
                    }
                    $this->purchaseOrderLinesScheduledForDeletion = null;
                }
            }

            if ($this->collPurchaseOrderLines !== null) {
                foreach ($this->collPurchaseOrderLines as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->componentPartnersScheduledForDeletion !== null) {
                if (!$this->componentPartnersScheduledForDeletion->isEmpty()) {
                    \ComponentPartnerQuery::create()
                        ->filterByPrimaryKeys($this->componentPartnersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->componentPartnersScheduledForDeletion = null;
                }
            }

            if ($this->collComponentPartners !== null) {
                foreach ($this->collComponentPartners as $referrerFK) {
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
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ComponentTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ComponentTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ComponentTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ComponentTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ComponentTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ComponentTableMap::COL_MATERIAL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'material_id';
        }
        if ($this->isColumnModified(ComponentTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(ComponentTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ComponentTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO component (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'material_id':
                        $stmt->bindValue($identifier, $this->material_id, PDO::PARAM_INT);
                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ComponentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
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
                return $this->getDescription();
                break;
            case 3:
                return $this->getMaterialId();
                break;
            case 4:
                return $this->getType();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getUpdatedAt();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Component'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Component'][$this->hashCode()] = true;
        $keys = ComponentTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getMaterialId(),
            $keys[4] => $this->getType(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getUpdatedAt(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aMaterial) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'material';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'material';
                        break;
                    default:
                        $key = 'Material';
                }

                $result[$key] = $this->aMaterial->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductComponents) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productComponents';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_components';
                        break;
                    default:
                        $key = 'ProductComponents';
                }

                $result[$key] = $this->collProductComponents->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPurchaseOrderLines) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'purchaseOrderLines';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'purchase_order_lines';
                        break;
                    default:
                        $key = 'PurchaseOrderLines';
                }

                $result[$key] = $this->collPurchaseOrderLines->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collComponentPartners) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'componentPartners';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'component_partners';
                        break;
                    default:
                        $key = 'ComponentPartners';
                }

                $result[$key] = $this->collComponentPartners->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Component
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ComponentTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Component
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
                $this->setDescription($value);
                break;
            case 3:
                $this->setMaterialId($value);
                break;
            case 4:
                $this->setType($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ComponentTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMaterialId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setType($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpdatedAt($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Component The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ComponentTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ComponentTableMap::COL_ID)) {
            $criteria->add(ComponentTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ComponentTableMap::COL_NAME)) {
            $criteria->add(ComponentTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ComponentTableMap::COL_DESCRIPTION)) {
            $criteria->add(ComponentTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ComponentTableMap::COL_MATERIAL_ID)) {
            $criteria->add(ComponentTableMap::COL_MATERIAL_ID, $this->material_id);
        }
        if ($this->isColumnModified(ComponentTableMap::COL_TYPE)) {
            $criteria->add(ComponentTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(ComponentTableMap::COL_CREATED_AT)) {
            $criteria->add(ComponentTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ComponentTableMap::COL_UPDATED_AT)) {
            $criteria->add(ComponentTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildComponentQuery::create();
        $criteria->add(ComponentTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
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
     * @param       int $key Primary key.
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
     * @param      object $copyObj An object of \Component (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setMaterialId($this->getMaterialId());
        $copyObj->setType($this->getType());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductComponents() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductComponent($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPurchaseOrderLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchaseOrderLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getComponentPartners() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComponentPartner($relObj->copy($deepCopy));
                }
            }

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
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Component Clone of current object.
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
     * Declares an association between this object and a ChildMaterial object.
     *
     * @param  ChildMaterial $v
     * @return $this|\Component The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMaterial(ChildMaterial $v = null)
    {
        if ($v === null) {
            $this->setMaterialId(NULL);
        } else {
            $this->setMaterialId($v->getId());
        }

        $this->aMaterial = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMaterial object, it will not be re-added.
        if ($v !== null) {
            $v->addComponent($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMaterial object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildMaterial The associated ChildMaterial object.
     * @throws PropelException
     */
    public function getMaterial(ConnectionInterface $con = null)
    {
        if ($this->aMaterial === null && ($this->material_id != 0)) {
            $this->aMaterial = ChildMaterialQuery::create()->findPk($this->material_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMaterial->addComponents($this);
             */
        }

        return $this->aMaterial;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ProductComponent' == $relationName) {
            $this->initProductComponents();
            return;
        }
        if ('PurchaseOrderLine' == $relationName) {
            $this->initPurchaseOrderLines();
            return;
        }
        if ('ComponentPartner' == $relationName) {
            $this->initComponentPartners();
            return;
        }
    }

    /**
     * Clears out the collProductComponents collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductComponents()
     */
    public function clearProductComponents()
    {
        $this->collProductComponents = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductComponents collection loaded partially.
     */
    public function resetPartialProductComponents($v = true)
    {
        $this->collProductComponentsPartial = $v;
    }

    /**
     * Initializes the collProductComponents collection.
     *
     * By default this just sets the collProductComponents collection to an empty array (like clearcollProductComponents());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductComponents($overrideExisting = true)
    {
        if (null !== $this->collProductComponents && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductComponentTableMap::getTableMap()->getCollectionClassName();

        $this->collProductComponents = new $collectionClassName;
        $this->collProductComponents->setModel('\ProductComponent');
    }

    /**
     * Gets an array of ChildProductComponent objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildComponent is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductComponent[] List of ChildProductComponent objects
     * @throws PropelException
     */
    public function getProductComponents(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductComponentsPartial && !$this->isNew();
        if (null === $this->collProductComponents || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductComponents) {
                // return empty collection
                $this->initProductComponents();
            } else {
                $collProductComponents = ChildProductComponentQuery::create(null, $criteria)
                    ->filterByComponent($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductComponentsPartial && count($collProductComponents)) {
                        $this->initProductComponents(false);

                        foreach ($collProductComponents as $obj) {
                            if (false == $this->collProductComponents->contains($obj)) {
                                $this->collProductComponents->append($obj);
                            }
                        }

                        $this->collProductComponentsPartial = true;
                    }

                    return $collProductComponents;
                }

                if ($partial && $this->collProductComponents) {
                    foreach ($this->collProductComponents as $obj) {
                        if ($obj->isNew()) {
                            $collProductComponents[] = $obj;
                        }
                    }
                }

                $this->collProductComponents = $collProductComponents;
                $this->collProductComponentsPartial = false;
            }
        }

        return $this->collProductComponents;
    }

    /**
     * Sets a collection of ChildProductComponent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productComponents A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildComponent The current object (for fluent API support)
     */
    public function setProductComponents(Collection $productComponents, ConnectionInterface $con = null)
    {
        /** @var ChildProductComponent[] $productComponentsToDelete */
        $productComponentsToDelete = $this->getProductComponents(new Criteria(), $con)->diff($productComponents);


        $this->productComponentsScheduledForDeletion = $productComponentsToDelete;

        foreach ($productComponentsToDelete as $productComponentRemoved) {
            $productComponentRemoved->setComponent(null);
        }

        $this->collProductComponents = null;
        foreach ($productComponents as $productComponent) {
            $this->addProductComponent($productComponent);
        }

        $this->collProductComponents = $productComponents;
        $this->collProductComponentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductComponent objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductComponent objects.
     * @throws PropelException
     */
    public function countProductComponents(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductComponentsPartial && !$this->isNew();
        if (null === $this->collProductComponents || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductComponents) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductComponents());
            }

            $query = ChildProductComponentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByComponent($this)
                ->count($con);
        }

        return count($this->collProductComponents);
    }

    /**
     * Method called to associate a ChildProductComponent object to this object
     * through the ChildProductComponent foreign key attribute.
     *
     * @param  ChildProductComponent $l ChildProductComponent
     * @return $this|\Component The current object (for fluent API support)
     */
    public function addProductComponent(ChildProductComponent $l)
    {
        if ($this->collProductComponents === null) {
            $this->initProductComponents();
            $this->collProductComponentsPartial = true;
        }

        if (!$this->collProductComponents->contains($l)) {
            $this->doAddProductComponent($l);

            if ($this->productComponentsScheduledForDeletion and $this->productComponentsScheduledForDeletion->contains($l)) {
                $this->productComponentsScheduledForDeletion->remove($this->productComponentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductComponent $productComponent The ChildProductComponent object to add.
     */
    protected function doAddProductComponent(ChildProductComponent $productComponent)
    {
        $this->collProductComponents[]= $productComponent;
        $productComponent->setComponent($this);
    }

    /**
     * @param  ChildProductComponent $productComponent The ChildProductComponent object to remove.
     * @return $this|ChildComponent The current object (for fluent API support)
     */
    public function removeProductComponent(ChildProductComponent $productComponent)
    {
        if ($this->getProductComponents()->contains($productComponent)) {
            $pos = $this->collProductComponents->search($productComponent);
            $this->collProductComponents->remove($pos);
            if (null === $this->productComponentsScheduledForDeletion) {
                $this->productComponentsScheduledForDeletion = clone $this->collProductComponents;
                $this->productComponentsScheduledForDeletion->clear();
            }
            $this->productComponentsScheduledForDeletion[]= clone $productComponent;
            $productComponent->setComponent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Component is new, it will return
     * an empty collection; or if this Component has previously
     * been saved, it will retrieve related ProductComponents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Component.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductComponent[] List of ChildProductComponent objects
     */
    public function getProductComponentsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductComponentQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductComponents($query, $con);
    }

    /**
     * Clears out the collPurchaseOrderLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPurchaseOrderLines()
     */
    public function clearPurchaseOrderLines()
    {
        $this->collPurchaseOrderLines = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPurchaseOrderLines collection loaded partially.
     */
    public function resetPartialPurchaseOrderLines($v = true)
    {
        $this->collPurchaseOrderLinesPartial = $v;
    }

    /**
     * Initializes the collPurchaseOrderLines collection.
     *
     * By default this just sets the collPurchaseOrderLines collection to an empty array (like clearcollPurchaseOrderLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPurchaseOrderLines($overrideExisting = true)
    {
        if (null !== $this->collPurchaseOrderLines && !$overrideExisting) {
            return;
        }

        $collectionClassName = PurchaseOrderLineTableMap::getTableMap()->getCollectionClassName();

        $this->collPurchaseOrderLines = new $collectionClassName;
        $this->collPurchaseOrderLines->setModel('\PurchaseOrderLine');
    }

    /**
     * Gets an array of ChildPurchaseOrderLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildComponent is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPurchaseOrderLine[] List of ChildPurchaseOrderLine objects
     * @throws PropelException
     */
    public function getPurchaseOrderLines(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPurchaseOrderLinesPartial && !$this->isNew();
        if (null === $this->collPurchaseOrderLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPurchaseOrderLines) {
                // return empty collection
                $this->initPurchaseOrderLines();
            } else {
                $collPurchaseOrderLines = ChildPurchaseOrderLineQuery::create(null, $criteria)
                    ->filterByComponent($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPurchaseOrderLinesPartial && count($collPurchaseOrderLines)) {
                        $this->initPurchaseOrderLines(false);

                        foreach ($collPurchaseOrderLines as $obj) {
                            if (false == $this->collPurchaseOrderLines->contains($obj)) {
                                $this->collPurchaseOrderLines->append($obj);
                            }
                        }

                        $this->collPurchaseOrderLinesPartial = true;
                    }

                    return $collPurchaseOrderLines;
                }

                if ($partial && $this->collPurchaseOrderLines) {
                    foreach ($this->collPurchaseOrderLines as $obj) {
                        if ($obj->isNew()) {
                            $collPurchaseOrderLines[] = $obj;
                        }
                    }
                }

                $this->collPurchaseOrderLines = $collPurchaseOrderLines;
                $this->collPurchaseOrderLinesPartial = false;
            }
        }

        return $this->collPurchaseOrderLines;
    }

    /**
     * Sets a collection of ChildPurchaseOrderLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $purchaseOrderLines A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildComponent The current object (for fluent API support)
     */
    public function setPurchaseOrderLines(Collection $purchaseOrderLines, ConnectionInterface $con = null)
    {
        /** @var ChildPurchaseOrderLine[] $purchaseOrderLinesToDelete */
        $purchaseOrderLinesToDelete = $this->getPurchaseOrderLines(new Criteria(), $con)->diff($purchaseOrderLines);


        $this->purchaseOrderLinesScheduledForDeletion = $purchaseOrderLinesToDelete;

        foreach ($purchaseOrderLinesToDelete as $purchaseOrderLineRemoved) {
            $purchaseOrderLineRemoved->setComponent(null);
        }

        $this->collPurchaseOrderLines = null;
        foreach ($purchaseOrderLines as $purchaseOrderLine) {
            $this->addPurchaseOrderLine($purchaseOrderLine);
        }

        $this->collPurchaseOrderLines = $purchaseOrderLines;
        $this->collPurchaseOrderLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PurchaseOrderLine objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PurchaseOrderLine objects.
     * @throws PropelException
     */
    public function countPurchaseOrderLines(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPurchaseOrderLinesPartial && !$this->isNew();
        if (null === $this->collPurchaseOrderLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPurchaseOrderLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPurchaseOrderLines());
            }

            $query = ChildPurchaseOrderLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByComponent($this)
                ->count($con);
        }

        return count($this->collPurchaseOrderLines);
    }

    /**
     * Method called to associate a ChildPurchaseOrderLine object to this object
     * through the ChildPurchaseOrderLine foreign key attribute.
     *
     * @param  ChildPurchaseOrderLine $l ChildPurchaseOrderLine
     * @return $this|\Component The current object (for fluent API support)
     */
    public function addPurchaseOrderLine(ChildPurchaseOrderLine $l)
    {
        if ($this->collPurchaseOrderLines === null) {
            $this->initPurchaseOrderLines();
            $this->collPurchaseOrderLinesPartial = true;
        }

        if (!$this->collPurchaseOrderLines->contains($l)) {
            $this->doAddPurchaseOrderLine($l);

            if ($this->purchaseOrderLinesScheduledForDeletion and $this->purchaseOrderLinesScheduledForDeletion->contains($l)) {
                $this->purchaseOrderLinesScheduledForDeletion->remove($this->purchaseOrderLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPurchaseOrderLine $purchaseOrderLine The ChildPurchaseOrderLine object to add.
     */
    protected function doAddPurchaseOrderLine(ChildPurchaseOrderLine $purchaseOrderLine)
    {
        $this->collPurchaseOrderLines[]= $purchaseOrderLine;
        $purchaseOrderLine->setComponent($this);
    }

    /**
     * @param  ChildPurchaseOrderLine $purchaseOrderLine The ChildPurchaseOrderLine object to remove.
     * @return $this|ChildComponent The current object (for fluent API support)
     */
    public function removePurchaseOrderLine(ChildPurchaseOrderLine $purchaseOrderLine)
    {
        if ($this->getPurchaseOrderLines()->contains($purchaseOrderLine)) {
            $pos = $this->collPurchaseOrderLines->search($purchaseOrderLine);
            $this->collPurchaseOrderLines->remove($pos);
            if (null === $this->purchaseOrderLinesScheduledForDeletion) {
                $this->purchaseOrderLinesScheduledForDeletion = clone $this->collPurchaseOrderLines;
                $this->purchaseOrderLinesScheduledForDeletion->clear();
            }
            $this->purchaseOrderLinesScheduledForDeletion[]= $purchaseOrderLine;
            $purchaseOrderLine->setComponent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Component is new, it will return
     * an empty collection; or if this Component has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Component.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrderLine[] List of ChildPurchaseOrderLine objects
     */
    public function getPurchaseOrderLinesJoinPurchaseOrder(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderLineQuery::create(null, $criteria);
        $query->joinWith('PurchaseOrder', $joinBehavior);

        return $this->getPurchaseOrderLines($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Component is new, it will return
     * an empty collection; or if this Component has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Component.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrderLine[] List of ChildPurchaseOrderLine objects
     */
    public function getPurchaseOrderLinesJoinProformaInvoiceLine(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderLineQuery::create(null, $criteria);
        $query->joinWith('ProformaInvoiceLine', $joinBehavior);

        return $this->getPurchaseOrderLines($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Component is new, it will return
     * an empty collection; or if this Component has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Component.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrderLine[] List of ChildPurchaseOrderLine objects
     */
    public function getPurchaseOrderLinesJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderLineQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getPurchaseOrderLines($query, $con);
    }

    /**
     * Clears out the collComponentPartners collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addComponentPartners()
     */
    public function clearComponentPartners()
    {
        $this->collComponentPartners = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collComponentPartners collection loaded partially.
     */
    public function resetPartialComponentPartners($v = true)
    {
        $this->collComponentPartnersPartial = $v;
    }

    /**
     * Initializes the collComponentPartners collection.
     *
     * By default this just sets the collComponentPartners collection to an empty array (like clearcollComponentPartners());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initComponentPartners($overrideExisting = true)
    {
        if (null !== $this->collComponentPartners && !$overrideExisting) {
            return;
        }

        $collectionClassName = ComponentPartnerTableMap::getTableMap()->getCollectionClassName();

        $this->collComponentPartners = new $collectionClassName;
        $this->collComponentPartners->setModel('\ComponentPartner');
    }

    /**
     * Gets an array of ChildComponentPartner objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildComponent is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildComponentPartner[] List of ChildComponentPartner objects
     * @throws PropelException
     */
    public function getComponentPartners(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collComponentPartnersPartial && !$this->isNew();
        if (null === $this->collComponentPartners || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collComponentPartners) {
                // return empty collection
                $this->initComponentPartners();
            } else {
                $collComponentPartners = ChildComponentPartnerQuery::create(null, $criteria)
                    ->filterByComponent($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collComponentPartnersPartial && count($collComponentPartners)) {
                        $this->initComponentPartners(false);

                        foreach ($collComponentPartners as $obj) {
                            if (false == $this->collComponentPartners->contains($obj)) {
                                $this->collComponentPartners->append($obj);
                            }
                        }

                        $this->collComponentPartnersPartial = true;
                    }

                    return $collComponentPartners;
                }

                if ($partial && $this->collComponentPartners) {
                    foreach ($this->collComponentPartners as $obj) {
                        if ($obj->isNew()) {
                            $collComponentPartners[] = $obj;
                        }
                    }
                }

                $this->collComponentPartners = $collComponentPartners;
                $this->collComponentPartnersPartial = false;
            }
        }

        return $this->collComponentPartners;
    }

    /**
     * Sets a collection of ChildComponentPartner objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $componentPartners A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildComponent The current object (for fluent API support)
     */
    public function setComponentPartners(Collection $componentPartners, ConnectionInterface $con = null)
    {
        /** @var ChildComponentPartner[] $componentPartnersToDelete */
        $componentPartnersToDelete = $this->getComponentPartners(new Criteria(), $con)->diff($componentPartners);


        $this->componentPartnersScheduledForDeletion = $componentPartnersToDelete;

        foreach ($componentPartnersToDelete as $componentPartnerRemoved) {
            $componentPartnerRemoved->setComponent(null);
        }

        $this->collComponentPartners = null;
        foreach ($componentPartners as $componentPartner) {
            $this->addComponentPartner($componentPartner);
        }

        $this->collComponentPartners = $componentPartners;
        $this->collComponentPartnersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ComponentPartner objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ComponentPartner objects.
     * @throws PropelException
     */
    public function countComponentPartners(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collComponentPartnersPartial && !$this->isNew();
        if (null === $this->collComponentPartners || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collComponentPartners) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getComponentPartners());
            }

            $query = ChildComponentPartnerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByComponent($this)
                ->count($con);
        }

        return count($this->collComponentPartners);
    }

    /**
     * Method called to associate a ChildComponentPartner object to this object
     * through the ChildComponentPartner foreign key attribute.
     *
     * @param  ChildComponentPartner $l ChildComponentPartner
     * @return $this|\Component The current object (for fluent API support)
     */
    public function addComponentPartner(ChildComponentPartner $l)
    {
        if ($this->collComponentPartners === null) {
            $this->initComponentPartners();
            $this->collComponentPartnersPartial = true;
        }

        if (!$this->collComponentPartners->contains($l)) {
            $this->doAddComponentPartner($l);

            if ($this->componentPartnersScheduledForDeletion and $this->componentPartnersScheduledForDeletion->contains($l)) {
                $this->componentPartnersScheduledForDeletion->remove($this->componentPartnersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildComponentPartner $componentPartner The ChildComponentPartner object to add.
     */
    protected function doAddComponentPartner(ChildComponentPartner $componentPartner)
    {
        $this->collComponentPartners[]= $componentPartner;
        $componentPartner->setComponent($this);
    }

    /**
     * @param  ChildComponentPartner $componentPartner The ChildComponentPartner object to remove.
     * @return $this|ChildComponent The current object (for fluent API support)
     */
    public function removeComponentPartner(ChildComponentPartner $componentPartner)
    {
        if ($this->getComponentPartners()->contains($componentPartner)) {
            $pos = $this->collComponentPartners->search($componentPartner);
            $this->collComponentPartners->remove($pos);
            if (null === $this->componentPartnersScheduledForDeletion) {
                $this->componentPartnersScheduledForDeletion = clone $this->collComponentPartners;
                $this->componentPartnersScheduledForDeletion->clear();
            }
            $this->componentPartnersScheduledForDeletion[]= clone $componentPartner;
            $componentPartner->setComponent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Component is new, it will return
     * an empty collection; or if this Component has previously
     * been saved, it will retrieve related ComponentPartners from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Component.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildComponentPartner[] List of ChildComponentPartner objects
     */
    public function getComponentPartnersJoinPartner(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildComponentPartnerQuery::create(null, $criteria);
        $query->joinWith('Partner', $joinBehavior);

        return $this->getComponentPartners($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aMaterial) {
            $this->aMaterial->removeComponent($this);
        }
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->material_id = null;
        $this->type = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collProductComponents) {
                foreach ($this->collProductComponents as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchaseOrderLines) {
                foreach ($this->collPurchaseOrderLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collComponentPartners) {
                foreach ($this->collComponentPartners as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductComponents = null;
        $this->collPurchaseOrderLines = null;
        $this->collComponentPartners = null;
        $this->aMaterial = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ComponentTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
