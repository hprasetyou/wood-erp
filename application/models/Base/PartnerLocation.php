<?php

namespace Base;

use \Country as ChildCountry;
use \CountryQuery as ChildCountryQuery;
use \Partner as ChildPartner;
use \PartnerLocation as ChildPartnerLocation;
use \PartnerLocationQuery as ChildPartnerLocationQuery;
use \PartnerQuery as ChildPartnerQuery;
use \ProductStock as ChildProductStock;
use \ProductStockQuery as ChildProductStockQuery;
use \StockMove as ChildStockMove;
use \StockMoveQuery as ChildStockMoveQuery;
use \Exception;
use \PDO;
use Map\PartnerLocationTableMap;
use Map\ProductStockTableMap;
use Map\StockMoveTableMap;
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

/**
 * Base class that represents a row from the 'partner_location' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class PartnerLocation implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PartnerLocationTableMap';


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
     * The value for the partner_id field.
     *
     * @var        int
     */
    protected $partner_id;

    /**
     * The value for the country_id field.
     *
     * @var        int
     */
    protected $country_id;

    /**
     * The value for the postal field.
     *
     * @var        string
     */
    protected $postal;

    /**
     * The value for the city field.
     *
     * @var        string
     */
    protected $city;

    /**
     * The value for the type field.
     *
     * Note: this column has a database default value of: 'warehouse'
     * @var        string
     */
    protected $type;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * @var        ChildCountry
     */
    protected $aCountry;

    /**
     * @var        ChildPartner
     */
    protected $aPartner;

    /**
     * @var        ObjectCollection|ChildProductStock[] Collection to store aggregation of ChildProductStock objects.
     */
    protected $collProductStocks;
    protected $collProductStocksPartial;

    /**
     * @var        ObjectCollection|ChildStockMove[] Collection to store aggregation of ChildStockMove objects.
     */
    protected $collStockmovesRelatedBySrcId;
    protected $collStockmovesRelatedBySrcIdPartial;

    /**
     * @var        ObjectCollection|ChildStockMove[] Collection to store aggregation of ChildStockMove objects.
     */
    protected $collStockmovesRelatedByDestId;
    protected $collStockmovesRelatedByDestIdPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductStock[]
     */
    protected $productStocksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStockMove[]
     */
    protected $stockmovesRelatedBySrcIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildStockMove[]
     */
    protected $stockmovesRelatedByDestIdScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->type = 'warehouse';
        $this->active = true;
    }

    /**
     * Initializes internal state of Base\PartnerLocation object.
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
     * Compares this with another <code>PartnerLocation</code> instance.  If
     * <code>obj</code> is an instance of <code>PartnerLocation</code>, delegates to
     * <code>equals(PartnerLocation)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|PartnerLocation The current object, for fluid interface
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
     * Get the [partner_id] column value.
     *
     * @return int
     */
    public function getPartnerId()
    {
        return $this->partner_id;
    }

    /**
     * Get the [country_id] column value.
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * Get the [postal] column value.
     *
     * @return string
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
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
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
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
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->getActive();
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [partner_id] column.
     *
     * @param int $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setPartnerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->partner_id !== $v) {
            $this->partner_id = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_PARTNER_ID] = true;
        }

        if ($this->aPartner !== null && $this->aPartner->getId() !== $v) {
            $this->aPartner = null;
        }

        return $this;
    } // setPartnerId()

    /**
     * Set the value of [country_id] column.
     *
     * @param int $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setCountryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->country_id !== $v) {
            $this->country_id = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_COUNTRY_ID] = true;
        }

        if ($this->aCountry !== null && $this->aCountry->getId() !== $v) {
            $this->aCountry = null;
        }

        return $this;
    } // setCountryId()

    /**
     * Set the value of [postal] column.
     *
     * @param string $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setPostal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->postal !== $v) {
            $this->postal = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_POSTAL] = true;
        }

        return $this;
    } // setPostal()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[PartnerLocationTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\PartnerLocation The current object (for fluent API support)
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
            $this->modifiedColumns[PartnerLocationTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

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
            if ($this->type !== 'warehouse') {
                return false;
            }

            if ($this->active !== true) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PartnerLocationTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PartnerLocationTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PartnerLocationTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PartnerLocationTableMap::translateFieldName('PartnerId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->partner_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PartnerLocationTableMap::translateFieldName('CountryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->country_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PartnerLocationTableMap::translateFieldName('Postal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PartnerLocationTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PartnerLocationTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PartnerLocationTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PartnerLocationTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = PartnerLocationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PartnerLocation'), 0, $e);
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
        if ($this->aPartner !== null && $this->partner_id !== $this->aPartner->getId()) {
            $this->aPartner = null;
        }
        if ($this->aCountry !== null && $this->country_id !== $this->aCountry->getId()) {
            $this->aCountry = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PartnerLocationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPartnerLocationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->aPartner = null;
            $this->collProductStocks = null;

            $this->collStockmovesRelatedBySrcId = null;

            $this->collStockmovesRelatedByDestId = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PartnerLocation::setDeleted()
     * @see PartnerLocation::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerLocationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPartnerLocationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerLocationTableMap::DATABASE_NAME);
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
                PartnerLocationTableMap::addInstanceToPool($this);
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

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->aPartner !== null) {
                if ($this->aPartner->isModified() || $this->aPartner->isNew()) {
                    $affectedRows += $this->aPartner->save($con);
                }
                $this->setPartner($this->aPartner);
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

            if ($this->productStocksScheduledForDeletion !== null) {
                if (!$this->productStocksScheduledForDeletion->isEmpty()) {
                    \ProductStockQuery::create()
                        ->filterByPrimaryKeys($this->productStocksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productStocksScheduledForDeletion = null;
                }
            }

            if ($this->collProductStocks !== null) {
                foreach ($this->collProductStocks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockmovesRelatedBySrcIdScheduledForDeletion !== null) {
                if (!$this->stockmovesRelatedBySrcIdScheduledForDeletion->isEmpty()) {
                    \StockMoveQuery::create()
                        ->filterByPrimaryKeys($this->stockmovesRelatedBySrcIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockmovesRelatedBySrcIdScheduledForDeletion = null;
                }
            }

            if ($this->collStockmovesRelatedBySrcId !== null) {
                foreach ($this->collStockmovesRelatedBySrcId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->stockmovesRelatedByDestIdScheduledForDeletion !== null) {
                if (!$this->stockmovesRelatedByDestIdScheduledForDeletion->isEmpty()) {
                    \StockMoveQuery::create()
                        ->filterByPrimaryKeys($this->stockmovesRelatedByDestIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->stockmovesRelatedByDestIdScheduledForDeletion = null;
                }
            }

            if ($this->collStockmovesRelatedByDestId !== null) {
                foreach ($this->collStockmovesRelatedByDestId as $referrerFK) {
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

        $this->modifiedColumns[PartnerLocationTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PartnerLocationTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PartnerLocationTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_PARTNER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'partner_id';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_COUNTRY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'country_id';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_POSTAL)) {
            $modifiedColumns[':p' . $index++]  = 'postal';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'active';
        }

        $sql = sprintf(
            'INSERT INTO partner_location (%s) VALUES (%s)',
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
                    case 'partner_id':
                        $stmt->bindValue($identifier, $this->partner_id, PDO::PARAM_INT);
                        break;
                    case 'country_id':
                        $stmt->bindValue($identifier, $this->country_id, PDO::PARAM_INT);
                        break;
                    case 'postal':
                        $stmt->bindValue($identifier, $this->postal, PDO::PARAM_STR);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'active':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
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
        $pos = PartnerLocationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPartnerId();
                break;
            case 4:
                return $this->getCountryId();
                break;
            case 5:
                return $this->getPostal();
                break;
            case 6:
                return $this->getCity();
                break;
            case 7:
                return $this->getType();
                break;
            case 8:
                return $this->getAddress();
                break;
            case 9:
                return $this->getActive();
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

        if (isset($alreadyDumpedObjects['PartnerLocation'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PartnerLocation'][$this->hashCode()] = true;
        $keys = PartnerLocationTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getPartnerId(),
            $keys[4] => $this->getCountryId(),
            $keys[5] => $this->getPostal(),
            $keys[6] => $this->getCity(),
            $keys[7] => $this->getType(),
            $keys[8] => $this->getAddress(),
            $keys[9] => $this->getActive(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'country';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'country';
                        break;
                    default:
                        $key = 'Country';
                }

                $result[$key] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPartner) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partner';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partner';
                        break;
                    default:
                        $key = 'Partner';
                }

                $result[$key] = $this->aPartner->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProductStocks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productStocks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_stocks';
                        break;
                    default:
                        $key = 'ProductStocks';
                }

                $result[$key] = $this->collProductStocks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockmovesRelatedBySrcId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockmoves';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_moves';
                        break;
                    default:
                        $key = 'Stockmoves';
                }

                $result[$key] = $this->collStockmovesRelatedBySrcId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collStockmovesRelatedByDestId) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'stockmoves';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'stock_moves';
                        break;
                    default:
                        $key = 'Stockmoves';
                }

                $result[$key] = $this->collStockmovesRelatedByDestId->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\PartnerLocation
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PartnerLocationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\PartnerLocation
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
                $this->setPartnerId($value);
                break;
            case 4:
                $this->setCountryId($value);
                break;
            case 5:
                $this->setPostal($value);
                break;
            case 6:
                $this->setCity($value);
                break;
            case 7:
                $this->setType($value);
                break;
            case 8:
                $this->setAddress($value);
                break;
            case 9:
                $this->setActive($value);
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
        $keys = PartnerLocationTableMap::getFieldNames($keyType);

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
            $this->setPartnerId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCountryId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPostal($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCity($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setType($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setAddress($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setActive($arr[$keys[9]]);
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
     * @return $this|\PartnerLocation The current object, for fluid interface
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
        $criteria = new Criteria(PartnerLocationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PartnerLocationTableMap::COL_ID)) {
            $criteria->add(PartnerLocationTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_NAME)) {
            $criteria->add(PartnerLocationTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_DESCRIPTION)) {
            $criteria->add(PartnerLocationTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_PARTNER_ID)) {
            $criteria->add(PartnerLocationTableMap::COL_PARTNER_ID, $this->partner_id);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_COUNTRY_ID)) {
            $criteria->add(PartnerLocationTableMap::COL_COUNTRY_ID, $this->country_id);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_POSTAL)) {
            $criteria->add(PartnerLocationTableMap::COL_POSTAL, $this->postal);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_CITY)) {
            $criteria->add(PartnerLocationTableMap::COL_CITY, $this->city);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_TYPE)) {
            $criteria->add(PartnerLocationTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_ADDRESS)) {
            $criteria->add(PartnerLocationTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(PartnerLocationTableMap::COL_ACTIVE)) {
            $criteria->add(PartnerLocationTableMap::COL_ACTIVE, $this->active);
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
        $criteria = ChildPartnerLocationQuery::create();
        $criteria->add(PartnerLocationTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \PartnerLocation (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setPartnerId($this->getPartnerId());
        $copyObj->setCountryId($this->getCountryId());
        $copyObj->setPostal($this->getPostal());
        $copyObj->setCity($this->getCity());
        $copyObj->setType($this->getType());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setActive($this->getActive());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProductStocks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductStock($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockmovesRelatedBySrcId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockMoveRelatedBySrcId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getStockmovesRelatedByDestId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addStockMoveRelatedByDestId($relObj->copy($deepCopy));
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
     * @return \PartnerLocation Clone of current object.
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
     * Declares an association between this object and a ChildCountry object.
     *
     * @param  ChildCountry $v
     * @return $this|\PartnerLocation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCountry(ChildCountry $v = null)
    {
        if ($v === null) {
            $this->setCountryId(NULL);
        } else {
            $this->setCountryId($v->getId());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCountry object, it will not be re-added.
        if ($v !== null) {
            $v->addPartnerLocation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCountry object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCountry The associated ChildCountry object.
     * @throws PropelException
     */
    public function getCountry(ConnectionInterface $con = null)
    {
        if ($this->aCountry === null && ($this->country_id != 0)) {
            $this->aCountry = ChildCountryQuery::create()->findPk($this->country_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addPartnerLocations($this);
             */
        }

        return $this->aCountry;
    }

    /**
     * Declares an association between this object and a ChildPartner object.
     *
     * @param  ChildPartner $v
     * @return $this|\PartnerLocation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPartner(ChildPartner $v = null)
    {
        if ($v === null) {
            $this->setPartnerId(NULL);
        } else {
            $this->setPartnerId($v->getId());
        }

        $this->aPartner = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPartner object, it will not be re-added.
        if ($v !== null) {
            $v->addPartnerLocation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPartner object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPartner The associated ChildPartner object.
     * @throws PropelException
     */
    public function getPartner(ConnectionInterface $con = null)
    {
        if ($this->aPartner === null && ($this->partner_id != 0)) {
            $this->aPartner = ChildPartnerQuery::create()->findPk($this->partner_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPartner->addPartnerLocations($this);
             */
        }

        return $this->aPartner;
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
        if ('ProductStock' == $relationName) {
            $this->initProductStocks();
            return;
        }
        if ('StockMoveRelatedBySrcId' == $relationName) {
            $this->initStockmovesRelatedBySrcId();
            return;
        }
        if ('StockMoveRelatedByDestId' == $relationName) {
            $this->initStockmovesRelatedByDestId();
            return;
        }
    }

    /**
     * Clears out the collProductStocks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductStocks()
     */
    public function clearProductStocks()
    {
        $this->collProductStocks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductStocks collection loaded partially.
     */
    public function resetPartialProductStocks($v = true)
    {
        $this->collProductStocksPartial = $v;
    }

    /**
     * Initializes the collProductStocks collection.
     *
     * By default this just sets the collProductStocks collection to an empty array (like clearcollProductStocks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductStocks($overrideExisting = true)
    {
        if (null !== $this->collProductStocks && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductStockTableMap::getTableMap()->getCollectionClassName();

        $this->collProductStocks = new $collectionClassName;
        $this->collProductStocks->setModel('\ProductStock');
    }

    /**
     * Gets an array of ChildProductStock objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartnerLocation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductStock[] List of ChildProductStock objects
     * @throws PropelException
     */
    public function getProductStocks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductStocksPartial && !$this->isNew();
        if (null === $this->collProductStocks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductStocks) {
                // return empty collection
                $this->initProductStocks();
            } else {
                $collProductStocks = ChildProductStockQuery::create(null, $criteria)
                    ->filterByPartnerLocation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductStocksPartial && count($collProductStocks)) {
                        $this->initProductStocks(false);

                        foreach ($collProductStocks as $obj) {
                            if (false == $this->collProductStocks->contains($obj)) {
                                $this->collProductStocks->append($obj);
                            }
                        }

                        $this->collProductStocksPartial = true;
                    }

                    return $collProductStocks;
                }

                if ($partial && $this->collProductStocks) {
                    foreach ($this->collProductStocks as $obj) {
                        if ($obj->isNew()) {
                            $collProductStocks[] = $obj;
                        }
                    }
                }

                $this->collProductStocks = $collProductStocks;
                $this->collProductStocksPartial = false;
            }
        }

        return $this->collProductStocks;
    }

    /**
     * Sets a collection of ChildProductStock objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productStocks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartnerLocation The current object (for fluent API support)
     */
    public function setProductStocks(Collection $productStocks, ConnectionInterface $con = null)
    {
        /** @var ChildProductStock[] $productStocksToDelete */
        $productStocksToDelete = $this->getProductStocks(new Criteria(), $con)->diff($productStocks);


        $this->productStocksScheduledForDeletion = $productStocksToDelete;

        foreach ($productStocksToDelete as $productStockRemoved) {
            $productStockRemoved->setPartnerLocation(null);
        }

        $this->collProductStocks = null;
        foreach ($productStocks as $productStock) {
            $this->addProductStock($productStock);
        }

        $this->collProductStocks = $productStocks;
        $this->collProductStocksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductStock objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductStock objects.
     * @throws PropelException
     */
    public function countProductStocks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductStocksPartial && !$this->isNew();
        if (null === $this->collProductStocks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductStocks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductStocks());
            }

            $query = ChildProductStockQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPartnerLocation($this)
                ->count($con);
        }

        return count($this->collProductStocks);
    }

    /**
     * Method called to associate a ChildProductStock object to this object
     * through the ChildProductStock foreign key attribute.
     *
     * @param  ChildProductStock $l ChildProductStock
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function addProductStock(ChildProductStock $l)
    {
        if ($this->collProductStocks === null) {
            $this->initProductStocks();
            $this->collProductStocksPartial = true;
        }

        if (!$this->collProductStocks->contains($l)) {
            $this->doAddProductStock($l);

            if ($this->productStocksScheduledForDeletion and $this->productStocksScheduledForDeletion->contains($l)) {
                $this->productStocksScheduledForDeletion->remove($this->productStocksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductStock $productStock The ChildProductStock object to add.
     */
    protected function doAddProductStock(ChildProductStock $productStock)
    {
        $this->collProductStocks[]= $productStock;
        $productStock->setPartnerLocation($this);
    }

    /**
     * @param  ChildProductStock $productStock The ChildProductStock object to remove.
     * @return $this|ChildPartnerLocation The current object (for fluent API support)
     */
    public function removeProductStock(ChildProductStock $productStock)
    {
        if ($this->getProductStocks()->contains($productStock)) {
            $pos = $this->collProductStocks->search($productStock);
            $this->collProductStocks->remove($pos);
            if (null === $this->productStocksScheduledForDeletion) {
                $this->productStocksScheduledForDeletion = clone $this->collProductStocks;
                $this->productStocksScheduledForDeletion->clear();
            }
            $this->productStocksScheduledForDeletion[]= clone $productStock;
            $productStock->setPartnerLocation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PartnerLocation is new, it will return
     * an empty collection; or if this PartnerLocation has previously
     * been saved, it will retrieve related ProductStocks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PartnerLocation.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductStock[] List of ChildProductStock objects
     */
    public function getProductStocksJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductStockQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductStocks($query, $con);
    }

    /**
     * Clears out the collStockmovesRelatedBySrcId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStockmovesRelatedBySrcId()
     */
    public function clearStockmovesRelatedBySrcId()
    {
        $this->collStockmovesRelatedBySrcId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStockmovesRelatedBySrcId collection loaded partially.
     */
    public function resetPartialStockmovesRelatedBySrcId($v = true)
    {
        $this->collStockmovesRelatedBySrcIdPartial = $v;
    }

    /**
     * Initializes the collStockmovesRelatedBySrcId collection.
     *
     * By default this just sets the collStockmovesRelatedBySrcId collection to an empty array (like clearcollStockmovesRelatedBySrcId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockmovesRelatedBySrcId($overrideExisting = true)
    {
        if (null !== $this->collStockmovesRelatedBySrcId && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockMoveTableMap::getTableMap()->getCollectionClassName();

        $this->collStockmovesRelatedBySrcId = new $collectionClassName;
        $this->collStockmovesRelatedBySrcId->setModel('\StockMove');
    }

    /**
     * Gets an array of ChildStockMove objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartnerLocation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockMove[] List of ChildStockMove objects
     * @throws PropelException
     */
    public function getStockmovesRelatedBySrcId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStockmovesRelatedBySrcIdPartial && !$this->isNew();
        if (null === $this->collStockmovesRelatedBySrcId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collStockmovesRelatedBySrcId) {
                // return empty collection
                $this->initStockmovesRelatedBySrcId();
            } else {
                $collStockmovesRelatedBySrcId = ChildStockMoveQuery::create(null, $criteria)
                    ->filterBySrc($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockmovesRelatedBySrcIdPartial && count($collStockmovesRelatedBySrcId)) {
                        $this->initStockmovesRelatedBySrcId(false);

                        foreach ($collStockmovesRelatedBySrcId as $obj) {
                            if (false == $this->collStockmovesRelatedBySrcId->contains($obj)) {
                                $this->collStockmovesRelatedBySrcId->append($obj);
                            }
                        }

                        $this->collStockmovesRelatedBySrcIdPartial = true;
                    }

                    return $collStockmovesRelatedBySrcId;
                }

                if ($partial && $this->collStockmovesRelatedBySrcId) {
                    foreach ($this->collStockmovesRelatedBySrcId as $obj) {
                        if ($obj->isNew()) {
                            $collStockmovesRelatedBySrcId[] = $obj;
                        }
                    }
                }

                $this->collStockmovesRelatedBySrcId = $collStockmovesRelatedBySrcId;
                $this->collStockmovesRelatedBySrcIdPartial = false;
            }
        }

        return $this->collStockmovesRelatedBySrcId;
    }

    /**
     * Sets a collection of ChildStockMove objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $stockmovesRelatedBySrcId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartnerLocation The current object (for fluent API support)
     */
    public function setStockmovesRelatedBySrcId(Collection $stockmovesRelatedBySrcId, ConnectionInterface $con = null)
    {
        /** @var ChildStockMove[] $stockmovesRelatedBySrcIdToDelete */
        $stockmovesRelatedBySrcIdToDelete = $this->getStockmovesRelatedBySrcId(new Criteria(), $con)->diff($stockmovesRelatedBySrcId);


        $this->stockmovesRelatedBySrcIdScheduledForDeletion = $stockmovesRelatedBySrcIdToDelete;

        foreach ($stockmovesRelatedBySrcIdToDelete as $stockMoveRelatedBySrcIdRemoved) {
            $stockMoveRelatedBySrcIdRemoved->setSrc(null);
        }

        $this->collStockmovesRelatedBySrcId = null;
        foreach ($stockmovesRelatedBySrcId as $stockMoveRelatedBySrcId) {
            $this->addStockMoveRelatedBySrcId($stockMoveRelatedBySrcId);
        }

        $this->collStockmovesRelatedBySrcId = $stockmovesRelatedBySrcId;
        $this->collStockmovesRelatedBySrcIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockMove objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related StockMove objects.
     * @throws PropelException
     */
    public function countStockmovesRelatedBySrcId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStockmovesRelatedBySrcIdPartial && !$this->isNew();
        if (null === $this->collStockmovesRelatedBySrcId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockmovesRelatedBySrcId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockmovesRelatedBySrcId());
            }

            $query = ChildStockMoveQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySrc($this)
                ->count($con);
        }

        return count($this->collStockmovesRelatedBySrcId);
    }

    /**
     * Method called to associate a ChildStockMove object to this object
     * through the ChildStockMove foreign key attribute.
     *
     * @param  ChildStockMove $l ChildStockMove
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function addStockMoveRelatedBySrcId(ChildStockMove $l)
    {
        if ($this->collStockmovesRelatedBySrcId === null) {
            $this->initStockmovesRelatedBySrcId();
            $this->collStockmovesRelatedBySrcIdPartial = true;
        }

        if (!$this->collStockmovesRelatedBySrcId->contains($l)) {
            $this->doAddStockMoveRelatedBySrcId($l);

            if ($this->stockmovesRelatedBySrcIdScheduledForDeletion and $this->stockmovesRelatedBySrcIdScheduledForDeletion->contains($l)) {
                $this->stockmovesRelatedBySrcIdScheduledForDeletion->remove($this->stockmovesRelatedBySrcIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockMove $stockMoveRelatedBySrcId The ChildStockMove object to add.
     */
    protected function doAddStockMoveRelatedBySrcId(ChildStockMove $stockMoveRelatedBySrcId)
    {
        $this->collStockmovesRelatedBySrcId[]= $stockMoveRelatedBySrcId;
        $stockMoveRelatedBySrcId->setSrc($this);
    }

    /**
     * @param  ChildStockMove $stockMoveRelatedBySrcId The ChildStockMove object to remove.
     * @return $this|ChildPartnerLocation The current object (for fluent API support)
     */
    public function removeStockMoveRelatedBySrcId(ChildStockMove $stockMoveRelatedBySrcId)
    {
        if ($this->getStockmovesRelatedBySrcId()->contains($stockMoveRelatedBySrcId)) {
            $pos = $this->collStockmovesRelatedBySrcId->search($stockMoveRelatedBySrcId);
            $this->collStockmovesRelatedBySrcId->remove($pos);
            if (null === $this->stockmovesRelatedBySrcIdScheduledForDeletion) {
                $this->stockmovesRelatedBySrcIdScheduledForDeletion = clone $this->collStockmovesRelatedBySrcId;
                $this->stockmovesRelatedBySrcIdScheduledForDeletion->clear();
            }
            $this->stockmovesRelatedBySrcIdScheduledForDeletion[]= clone $stockMoveRelatedBySrcId;
            $stockMoveRelatedBySrcId->setSrc(null);
        }

        return $this;
    }

    /**
     * Clears out the collStockmovesRelatedByDestId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addStockmovesRelatedByDestId()
     */
    public function clearStockmovesRelatedByDestId()
    {
        $this->collStockmovesRelatedByDestId = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collStockmovesRelatedByDestId collection loaded partially.
     */
    public function resetPartialStockmovesRelatedByDestId($v = true)
    {
        $this->collStockmovesRelatedByDestIdPartial = $v;
    }

    /**
     * Initializes the collStockmovesRelatedByDestId collection.
     *
     * By default this just sets the collStockmovesRelatedByDestId collection to an empty array (like clearcollStockmovesRelatedByDestId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initStockmovesRelatedByDestId($overrideExisting = true)
    {
        if (null !== $this->collStockmovesRelatedByDestId && !$overrideExisting) {
            return;
        }

        $collectionClassName = StockMoveTableMap::getTableMap()->getCollectionClassName();

        $this->collStockmovesRelatedByDestId = new $collectionClassName;
        $this->collStockmovesRelatedByDestId->setModel('\StockMove');
    }

    /**
     * Gets an array of ChildStockMove objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartnerLocation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildStockMove[] List of ChildStockMove objects
     * @throws PropelException
     */
    public function getStockmovesRelatedByDestId(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collStockmovesRelatedByDestIdPartial && !$this->isNew();
        if (null === $this->collStockmovesRelatedByDestId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collStockmovesRelatedByDestId) {
                // return empty collection
                $this->initStockmovesRelatedByDestId();
            } else {
                $collStockmovesRelatedByDestId = ChildStockMoveQuery::create(null, $criteria)
                    ->filterByDest($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collStockmovesRelatedByDestIdPartial && count($collStockmovesRelatedByDestId)) {
                        $this->initStockmovesRelatedByDestId(false);

                        foreach ($collStockmovesRelatedByDestId as $obj) {
                            if (false == $this->collStockmovesRelatedByDestId->contains($obj)) {
                                $this->collStockmovesRelatedByDestId->append($obj);
                            }
                        }

                        $this->collStockmovesRelatedByDestIdPartial = true;
                    }

                    return $collStockmovesRelatedByDestId;
                }

                if ($partial && $this->collStockmovesRelatedByDestId) {
                    foreach ($this->collStockmovesRelatedByDestId as $obj) {
                        if ($obj->isNew()) {
                            $collStockmovesRelatedByDestId[] = $obj;
                        }
                    }
                }

                $this->collStockmovesRelatedByDestId = $collStockmovesRelatedByDestId;
                $this->collStockmovesRelatedByDestIdPartial = false;
            }
        }

        return $this->collStockmovesRelatedByDestId;
    }

    /**
     * Sets a collection of ChildStockMove objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $stockmovesRelatedByDestId A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartnerLocation The current object (for fluent API support)
     */
    public function setStockmovesRelatedByDestId(Collection $stockmovesRelatedByDestId, ConnectionInterface $con = null)
    {
        /** @var ChildStockMove[] $stockmovesRelatedByDestIdToDelete */
        $stockmovesRelatedByDestIdToDelete = $this->getStockmovesRelatedByDestId(new Criteria(), $con)->diff($stockmovesRelatedByDestId);


        $this->stockmovesRelatedByDestIdScheduledForDeletion = $stockmovesRelatedByDestIdToDelete;

        foreach ($stockmovesRelatedByDestIdToDelete as $stockMoveRelatedByDestIdRemoved) {
            $stockMoveRelatedByDestIdRemoved->setDest(null);
        }

        $this->collStockmovesRelatedByDestId = null;
        foreach ($stockmovesRelatedByDestId as $stockMoveRelatedByDestId) {
            $this->addStockMoveRelatedByDestId($stockMoveRelatedByDestId);
        }

        $this->collStockmovesRelatedByDestId = $stockmovesRelatedByDestId;
        $this->collStockmovesRelatedByDestIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related StockMove objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related StockMove objects.
     * @throws PropelException
     */
    public function countStockmovesRelatedByDestId(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collStockmovesRelatedByDestIdPartial && !$this->isNew();
        if (null === $this->collStockmovesRelatedByDestId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collStockmovesRelatedByDestId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getStockmovesRelatedByDestId());
            }

            $query = ChildStockMoveQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDest($this)
                ->count($con);
        }

        return count($this->collStockmovesRelatedByDestId);
    }

    /**
     * Method called to associate a ChildStockMove object to this object
     * through the ChildStockMove foreign key attribute.
     *
     * @param  ChildStockMove $l ChildStockMove
     * @return $this|\PartnerLocation The current object (for fluent API support)
     */
    public function addStockMoveRelatedByDestId(ChildStockMove $l)
    {
        if ($this->collStockmovesRelatedByDestId === null) {
            $this->initStockmovesRelatedByDestId();
            $this->collStockmovesRelatedByDestIdPartial = true;
        }

        if (!$this->collStockmovesRelatedByDestId->contains($l)) {
            $this->doAddStockMoveRelatedByDestId($l);

            if ($this->stockmovesRelatedByDestIdScheduledForDeletion and $this->stockmovesRelatedByDestIdScheduledForDeletion->contains($l)) {
                $this->stockmovesRelatedByDestIdScheduledForDeletion->remove($this->stockmovesRelatedByDestIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildStockMove $stockMoveRelatedByDestId The ChildStockMove object to add.
     */
    protected function doAddStockMoveRelatedByDestId(ChildStockMove $stockMoveRelatedByDestId)
    {
        $this->collStockmovesRelatedByDestId[]= $stockMoveRelatedByDestId;
        $stockMoveRelatedByDestId->setDest($this);
    }

    /**
     * @param  ChildStockMove $stockMoveRelatedByDestId The ChildStockMove object to remove.
     * @return $this|ChildPartnerLocation The current object (for fluent API support)
     */
    public function removeStockMoveRelatedByDestId(ChildStockMove $stockMoveRelatedByDestId)
    {
        if ($this->getStockmovesRelatedByDestId()->contains($stockMoveRelatedByDestId)) {
            $pos = $this->collStockmovesRelatedByDestId->search($stockMoveRelatedByDestId);
            $this->collStockmovesRelatedByDestId->remove($pos);
            if (null === $this->stockmovesRelatedByDestIdScheduledForDeletion) {
                $this->stockmovesRelatedByDestIdScheduledForDeletion = clone $this->collStockmovesRelatedByDestId;
                $this->stockmovesRelatedByDestIdScheduledForDeletion->clear();
            }
            $this->stockmovesRelatedByDestIdScheduledForDeletion[]= clone $stockMoveRelatedByDestId;
            $stockMoveRelatedByDestId->setDest(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCountry) {
            $this->aCountry->removePartnerLocation($this);
        }
        if (null !== $this->aPartner) {
            $this->aPartner->removePartnerLocation($this);
        }
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->partner_id = null;
        $this->country_id = null;
        $this->postal = null;
        $this->city = null;
        $this->type = null;
        $this->address = null;
        $this->active = null;
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
            if ($this->collProductStocks) {
                foreach ($this->collProductStocks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockmovesRelatedBySrcId) {
                foreach ($this->collStockmovesRelatedBySrcId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collStockmovesRelatedByDestId) {
                foreach ($this->collStockmovesRelatedByDestId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductStocks = null;
        $this->collStockmovesRelatedBySrcId = null;
        $this->collStockmovesRelatedByDestId = null;
        $this->aCountry = null;
        $this->aPartner = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PartnerLocationTableMap::DEFAULT_STRING_FORMAT);
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
