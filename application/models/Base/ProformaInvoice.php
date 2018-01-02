<?php

namespace Base;

use \Currency as ChildCurrency;
use \CurrencyQuery as ChildCurrencyQuery;
use \Partner as ChildPartner;
use \PartnerQuery as ChildPartnerQuery;
use \ProformaInvoice as ChildProformaInvoice;
use \ProformaInvoiceLine as ChildProformaInvoiceLine;
use \ProformaInvoiceLineQuery as ChildProformaInvoiceLineQuery;
use \ProformaInvoiceQuery as ChildProformaInvoiceQuery;
use \PurchaseOrder as ChildPurchaseOrder;
use \PurchaseOrderQuery as ChildPurchaseOrderQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ProformaInvoiceLineTableMap;
use Map\ProformaInvoiceTableMap;
use Map\PurchaseOrderTableMap;
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
 * Base class that represents a row from the 'proforma_invoice' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class ProformaInvoice implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProformaInvoiceTableMap';


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
     * The value for the currency_id field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $currency_id;

    /**
     * The value for the customer_id field.
     *
     * @var        int
     */
    protected $customer_id;

    /**
     * The value for the date field.
     *
     * @var        DateTime
     */
    protected $date;

    /**
     * The value for the confirm_date field.
     *
     * @var        DateTime
     */
    protected $confirm_date;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the total_cubic_dimension field.
     *
     * @var        double
     */
    protected $total_cubic_dimension;

    /**
     * The value for the total_price field.
     *
     * @var        double
     */
    protected $total_price;

    /**
     * The value for the state field.
     *
     * Note: this column has a database default value of: 'draft'
     * @var        string
     */
    protected $state;

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
     * @var        ChildPartner
     */
    protected $aPartner;

    /**
     * @var        ChildCurrency
     */
    protected $aCurrency;

    /**
     * @var        ObjectCollection|ChildProformaInvoiceLine[] Collection to store aggregation of ChildProformaInvoiceLine objects.
     */
    protected $collProformaInvoiceLines;
    protected $collProformaInvoiceLinesPartial;

    /**
     * @var        ObjectCollection|ChildPurchaseOrder[] Collection to store aggregation of ChildPurchaseOrder objects.
     */
    protected $collPurchaseOrders;
    protected $collPurchaseOrdersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProformaInvoiceLine[]
     */
    protected $proformaInvoiceLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPurchaseOrder[]
     */
    protected $purchaseOrdersScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->currency_id = 1;
        $this->state = 'draft';
    }

    /**
     * Initializes internal state of Base\ProformaInvoice object.
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
     * Compares this with another <code>ProformaInvoice</code> instance.  If
     * <code>obj</code> is an instance of <code>ProformaInvoice</code>, delegates to
     * <code>equals(ProformaInvoice)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|ProformaInvoice The current object, for fluid interface
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
     * Get the [currency_id] column value.
     *
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * Get the [customer_id] column value.
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Get the [optionally formatted] temporal [date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = NULL)
    {
        if ($format === null) {
            return $this->date;
        } else {
            return $this->date instanceof \DateTimeInterface ? $this->date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [confirm_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getConfirmDate($format = NULL)
    {
        if ($format === null) {
            return $this->confirm_date;
        } else {
            return $this->confirm_date instanceof \DateTimeInterface ? $this->confirm_date->format($format) : null;
        }
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
     * Get the [total_cubic_dimension] column value.
     *
     * @return double
     */
    public function getTotalCubicDimension()
    {
        return $this->total_cubic_dimension;
    }

    /**
     * Get the [total_price] column value.
     *
     * @return double
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * Get the [state] column value.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
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
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [currency_id] column.
     *
     * @param int $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setCurrencyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->currency_id !== $v) {
            $this->currency_id = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_CURRENCY_ID] = true;
        }

        if ($this->aCurrency !== null && $this->aCurrency->getId() !== $v) {
            $this->aCurrency = null;
        }

        return $this;
    } // setCurrencyId()

    /**
     * Set the value of [customer_id] column.
     *
     * @param int $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setCustomerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->customer_id !== $v) {
            $this->customer_id = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_CUSTOMER_ID] = true;
        }

        if ($this->aPartner !== null && $this->aPartner->getId() !== $v) {
            $this->aPartner = null;
        }

        return $this;
    } // setCustomerId()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            if ($this->date === null || $dt === null || $dt->format("Y-m-d") !== $this->date->format("Y-m-d")) {
                $this->date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProformaInvoiceTableMap::COL_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDate()

    /**
     * Sets the value of [confirm_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setConfirmDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->confirm_date !== null || $dt !== null) {
            if ($this->confirm_date === null || $dt === null || $dt->format("Y-m-d") !== $this->confirm_date->format("Y-m-d")) {
                $this->confirm_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProformaInvoiceTableMap::COL_CONFIRM_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setConfirmDate()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [total_cubic_dimension] column.
     *
     * @param double $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setTotalCubicDimension($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_cubic_dimension !== $v) {
            $this->total_cubic_dimension = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION] = true;
        }

        return $this;
    } // setTotalCubicDimension()

    /**
     * Set the value of [total_price] column.
     *
     * @param double $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setTotalPrice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_price !== $v) {
            $this->total_price = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_TOTAL_PRICE] = true;
        }

        return $this;
    } // setTotalPrice()

    /**
     * Set the value of [state] column.
     *
     * @param string $v new value
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->state !== $v) {
            $this->state = $v;
            $this->modifiedColumns[ProformaInvoiceTableMap::COL_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProformaInvoiceTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProformaInvoiceTableMap::COL_UPDATED_AT] = true;
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
            if ($this->currency_id !== 1) {
                return false;
            }

            if ($this->state !== 'draft') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProformaInvoiceTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProformaInvoiceTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProformaInvoiceTableMap::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProformaInvoiceTableMap::translateFieldName('CustomerId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProformaInvoiceTableMap::translateFieldName('Date', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProformaInvoiceTableMap::translateFieldName('ConfirmDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->confirm_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProformaInvoiceTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProformaInvoiceTableMap::translateFieldName('TotalCubicDimension', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_cubic_dimension = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProformaInvoiceTableMap::translateFieldName('TotalPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_price = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProformaInvoiceTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProformaInvoiceTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ProformaInvoiceTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = ProformaInvoiceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\ProformaInvoice'), 0, $e);
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
        if ($this->aCurrency !== null && $this->currency_id !== $this->aCurrency->getId()) {
            $this->aCurrency = null;
        }
        if ($this->aPartner !== null && $this->customer_id !== $this->aPartner->getId()) {
            $this->aPartner = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProformaInvoiceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPartner = null;
            $this->aCurrency = null;
            $this->collProformaInvoiceLines = null;

            $this->collPurchaseOrders = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see ProformaInvoice::setDeleted()
     * @see ProformaInvoice::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProformaInvoiceQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceTableMap::DATABASE_NAME);
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
                ProformaInvoiceTableMap::addInstanceToPool($this);
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

            if ($this->aPartner !== null) {
                if ($this->aPartner->isModified() || $this->aPartner->isNew()) {
                    $affectedRows += $this->aPartner->save($con);
                }
                $this->setPartner($this->aPartner);
            }

            if ($this->aCurrency !== null) {
                if ($this->aCurrency->isModified() || $this->aCurrency->isNew()) {
                    $affectedRows += $this->aCurrency->save($con);
                }
                $this->setCurrency($this->aCurrency);
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

            if ($this->proformaInvoiceLinesScheduledForDeletion !== null) {
                if (!$this->proformaInvoiceLinesScheduledForDeletion->isEmpty()) {
                    \ProformaInvoiceLineQuery::create()
                        ->filterByPrimaryKeys($this->proformaInvoiceLinesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->proformaInvoiceLinesScheduledForDeletion = null;
                }
            }

            if ($this->collProformaInvoiceLines !== null) {
                foreach ($this->collProformaInvoiceLines as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->purchaseOrdersScheduledForDeletion !== null) {
                if (!$this->purchaseOrdersScheduledForDeletion->isEmpty()) {
                    foreach ($this->purchaseOrdersScheduledForDeletion as $purchaseOrder) {
                        // need to save related object because we set the relation to null
                        $purchaseOrder->save($con);
                    }
                    $this->purchaseOrdersScheduledForDeletion = null;
                }
            }

            if ($this->collPurchaseOrders !== null) {
                foreach ($this->collPurchaseOrders as $referrerFK) {
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

        $this->modifiedColumns[ProformaInvoiceTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProformaInvoiceTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CURRENCY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'currency_id';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CUSTOMER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'customer_id';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'date';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CONFIRM_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'confirm_date';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION)) {
            $modifiedColumns[':p' . $index++]  = 'total_cubic_dimension';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_TOTAL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'total_price';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'state';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO proforma_invoice (%s) VALUES (%s)',
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
                    case 'currency_id':
                        $stmt->bindValue($identifier, $this->currency_id, PDO::PARAM_INT);
                        break;
                    case 'customer_id':
                        $stmt->bindValue($identifier, $this->customer_id, PDO::PARAM_INT);
                        break;
                    case 'date':
                        $stmt->bindValue($identifier, $this->date ? $this->date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'confirm_date':
                        $stmt->bindValue($identifier, $this->confirm_date ? $this->confirm_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'total_cubic_dimension':
                        $stmt->bindValue($identifier, $this->total_cubic_dimension, PDO::PARAM_STR);
                        break;
                    case 'total_price':
                        $stmt->bindValue($identifier, $this->total_price, PDO::PARAM_STR);
                        break;
                    case 'state':
                        $stmt->bindValue($identifier, $this->state, PDO::PARAM_STR);
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
        $pos = ProformaInvoiceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCurrencyId();
                break;
            case 3:
                return $this->getCustomerId();
                break;
            case 4:
                return $this->getDate();
                break;
            case 5:
                return $this->getConfirmDate();
                break;
            case 6:
                return $this->getDescription();
                break;
            case 7:
                return $this->getTotalCubicDimension();
                break;
            case 8:
                return $this->getTotalPrice();
                break;
            case 9:
                return $this->getState();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
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

        if (isset($alreadyDumpedObjects['ProformaInvoice'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ProformaInvoice'][$this->hashCode()] = true;
        $keys = ProformaInvoiceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getCurrencyId(),
            $keys[3] => $this->getCustomerId(),
            $keys[4] => $this->getDate(),
            $keys[5] => $this->getConfirmDate(),
            $keys[6] => $this->getDescription(),
            $keys[7] => $this->getTotalCubicDimension(),
            $keys[8] => $this->getTotalPrice(),
            $keys[9] => $this->getState(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        );
        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
            if (null !== $this->aCurrency) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'currency';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'currency';
                        break;
                    default:
                        $key = 'Currency';
                }

                $result[$key] = $this->aCurrency->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collProformaInvoiceLines) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'proformaInvoiceLines';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'proforma_invoice_lines';
                        break;
                    default:
                        $key = 'ProformaInvoiceLines';
                }

                $result[$key] = $this->collProformaInvoiceLines->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPurchaseOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'purchaseOrders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'purchase_orders';
                        break;
                    default:
                        $key = 'PurchaseOrders';
                }

                $result[$key] = $this->collPurchaseOrders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\ProformaInvoice
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProformaInvoiceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\ProformaInvoice
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
                $this->setCurrencyId($value);
                break;
            case 3:
                $this->setCustomerId($value);
                break;
            case 4:
                $this->setDate($value);
                break;
            case 5:
                $this->setConfirmDate($value);
                break;
            case 6:
                $this->setDescription($value);
                break;
            case 7:
                $this->setTotalCubicDimension($value);
                break;
            case 8:
                $this->setTotalPrice($value);
                break;
            case 9:
                $this->setState($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
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
        $keys = ProformaInvoiceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCurrencyId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCustomerId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setConfirmDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescription($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setTotalCubicDimension($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTotalPrice($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setState($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
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
     * @return $this|\ProformaInvoice The current object, for fluid interface
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
        $criteria = new Criteria(ProformaInvoiceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_ID)) {
            $criteria->add(ProformaInvoiceTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_NAME)) {
            $criteria->add(ProformaInvoiceTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CURRENCY_ID)) {
            $criteria->add(ProformaInvoiceTableMap::COL_CURRENCY_ID, $this->currency_id);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CUSTOMER_ID)) {
            $criteria->add(ProformaInvoiceTableMap::COL_CUSTOMER_ID, $this->customer_id);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_DATE)) {
            $criteria->add(ProformaInvoiceTableMap::COL_DATE, $this->date);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CONFIRM_DATE)) {
            $criteria->add(ProformaInvoiceTableMap::COL_CONFIRM_DATE, $this->confirm_date);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_DESCRIPTION)) {
            $criteria->add(ProformaInvoiceTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION)) {
            $criteria->add(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION, $this->total_cubic_dimension);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_TOTAL_PRICE)) {
            $criteria->add(ProformaInvoiceTableMap::COL_TOTAL_PRICE, $this->total_price);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_STATE)) {
            $criteria->add(ProformaInvoiceTableMap::COL_STATE, $this->state);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_CREATED_AT)) {
            $criteria->add(ProformaInvoiceTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ProformaInvoiceTableMap::COL_UPDATED_AT)) {
            $criteria->add(ProformaInvoiceTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildProformaInvoiceQuery::create();
        $criteria->add(ProformaInvoiceTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \ProformaInvoice (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setCurrencyId($this->getCurrencyId());
        $copyObj->setCustomerId($this->getCustomerId());
        $copyObj->setDate($this->getDate());
        $copyObj->setConfirmDate($this->getConfirmDate());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setTotalCubicDimension($this->getTotalCubicDimension());
        $copyObj->setTotalPrice($this->getTotalPrice());
        $copyObj->setState($this->getState());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getProformaInvoiceLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProformaInvoiceLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPurchaseOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchaseOrder($relObj->copy($deepCopy));
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
     * @return \ProformaInvoice Clone of current object.
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
     * Declares an association between this object and a ChildPartner object.
     *
     * @param  ChildPartner $v
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPartner(ChildPartner $v = null)
    {
        if ($v === null) {
            $this->setCustomerId(NULL);
        } else {
            $this->setCustomerId($v->getId());
        }

        $this->aPartner = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPartner object, it will not be re-added.
        if ($v !== null) {
            $v->addProformaInvoice($this);
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
        if ($this->aPartner === null && ($this->customer_id != 0)) {
            $this->aPartner = ChildPartnerQuery::create()->findPk($this->customer_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPartner->addProformaInvoices($this);
             */
        }

        return $this->aPartner;
    }

    /**
     * Declares an association between this object and a ChildCurrency object.
     *
     * @param  ChildCurrency $v
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCurrency(ChildCurrency $v = null)
    {
        if ($v === null) {
            $this->setCurrencyId(1);
        } else {
            $this->setCurrencyId($v->getId());
        }

        $this->aCurrency = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCurrency object, it will not be re-added.
        if ($v !== null) {
            $v->addProformaInvoice($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCurrency object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCurrency The associated ChildCurrency object.
     * @throws PropelException
     */
    public function getCurrency(ConnectionInterface $con = null)
    {
        if ($this->aCurrency === null && ($this->currency_id != 0)) {
            $this->aCurrency = ChildCurrencyQuery::create()->findPk($this->currency_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrency->addProformaInvoices($this);
             */
        }

        return $this->aCurrency;
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
        if ('ProformaInvoiceLine' == $relationName) {
            $this->initProformaInvoiceLines();
            return;
        }
        if ('PurchaseOrder' == $relationName) {
            $this->initPurchaseOrders();
            return;
        }
    }

    /**
     * Clears out the collProformaInvoiceLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProformaInvoiceLines()
     */
    public function clearProformaInvoiceLines()
    {
        $this->collProformaInvoiceLines = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProformaInvoiceLines collection loaded partially.
     */
    public function resetPartialProformaInvoiceLines($v = true)
    {
        $this->collProformaInvoiceLinesPartial = $v;
    }

    /**
     * Initializes the collProformaInvoiceLines collection.
     *
     * By default this just sets the collProformaInvoiceLines collection to an empty array (like clearcollProformaInvoiceLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProformaInvoiceLines($overrideExisting = true)
    {
        if (null !== $this->collProformaInvoiceLines && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProformaInvoiceLineTableMap::getTableMap()->getCollectionClassName();

        $this->collProformaInvoiceLines = new $collectionClassName;
        $this->collProformaInvoiceLines->setModel('\ProformaInvoiceLine');
    }

    /**
     * Gets an array of ChildProformaInvoiceLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProformaInvoice is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProformaInvoiceLine[] List of ChildProformaInvoiceLine objects
     * @throws PropelException
     */
    public function getProformaInvoiceLines(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProformaInvoiceLinesPartial && !$this->isNew();
        if (null === $this->collProformaInvoiceLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProformaInvoiceLines) {
                // return empty collection
                $this->initProformaInvoiceLines();
            } else {
                $collProformaInvoiceLines = ChildProformaInvoiceLineQuery::create(null, $criteria)
                    ->filterByProformaInvoice($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProformaInvoiceLinesPartial && count($collProformaInvoiceLines)) {
                        $this->initProformaInvoiceLines(false);

                        foreach ($collProformaInvoiceLines as $obj) {
                            if (false == $this->collProformaInvoiceLines->contains($obj)) {
                                $this->collProformaInvoiceLines->append($obj);
                            }
                        }

                        $this->collProformaInvoiceLinesPartial = true;
                    }

                    return $collProformaInvoiceLines;
                }

                if ($partial && $this->collProformaInvoiceLines) {
                    foreach ($this->collProformaInvoiceLines as $obj) {
                        if ($obj->isNew()) {
                            $collProformaInvoiceLines[] = $obj;
                        }
                    }
                }

                $this->collProformaInvoiceLines = $collProformaInvoiceLines;
                $this->collProformaInvoiceLinesPartial = false;
            }
        }

        return $this->collProformaInvoiceLines;
    }

    /**
     * Sets a collection of ChildProformaInvoiceLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $proformaInvoiceLines A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProformaInvoice The current object (for fluent API support)
     */
    public function setProformaInvoiceLines(Collection $proformaInvoiceLines, ConnectionInterface $con = null)
    {
        /** @var ChildProformaInvoiceLine[] $proformaInvoiceLinesToDelete */
        $proformaInvoiceLinesToDelete = $this->getProformaInvoiceLines(new Criteria(), $con)->diff($proformaInvoiceLines);


        $this->proformaInvoiceLinesScheduledForDeletion = $proformaInvoiceLinesToDelete;

        foreach ($proformaInvoiceLinesToDelete as $proformaInvoiceLineRemoved) {
            $proformaInvoiceLineRemoved->setProformaInvoice(null);
        }

        $this->collProformaInvoiceLines = null;
        foreach ($proformaInvoiceLines as $proformaInvoiceLine) {
            $this->addProformaInvoiceLine($proformaInvoiceLine);
        }

        $this->collProformaInvoiceLines = $proformaInvoiceLines;
        $this->collProformaInvoiceLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProformaInvoiceLine objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProformaInvoiceLine objects.
     * @throws PropelException
     */
    public function countProformaInvoiceLines(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProformaInvoiceLinesPartial && !$this->isNew();
        if (null === $this->collProformaInvoiceLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProformaInvoiceLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProformaInvoiceLines());
            }

            $query = ChildProformaInvoiceLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProformaInvoice($this)
                ->count($con);
        }

        return count($this->collProformaInvoiceLines);
    }

    /**
     * Method called to associate a ChildProformaInvoiceLine object to this object
     * through the ChildProformaInvoiceLine foreign key attribute.
     *
     * @param  ChildProformaInvoiceLine $l ChildProformaInvoiceLine
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function addProformaInvoiceLine(ChildProformaInvoiceLine $l)
    {
        if ($this->collProformaInvoiceLines === null) {
            $this->initProformaInvoiceLines();
            $this->collProformaInvoiceLinesPartial = true;
        }

        if (!$this->collProformaInvoiceLines->contains($l)) {
            $this->doAddProformaInvoiceLine($l);

            if ($this->proformaInvoiceLinesScheduledForDeletion and $this->proformaInvoiceLinesScheduledForDeletion->contains($l)) {
                $this->proformaInvoiceLinesScheduledForDeletion->remove($this->proformaInvoiceLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProformaInvoiceLine $proformaInvoiceLine The ChildProformaInvoiceLine object to add.
     */
    protected function doAddProformaInvoiceLine(ChildProformaInvoiceLine $proformaInvoiceLine)
    {
        $this->collProformaInvoiceLines[]= $proformaInvoiceLine;
        $proformaInvoiceLine->setProformaInvoice($this);
    }

    /**
     * @param  ChildProformaInvoiceLine $proformaInvoiceLine The ChildProformaInvoiceLine object to remove.
     * @return $this|ChildProformaInvoice The current object (for fluent API support)
     */
    public function removeProformaInvoiceLine(ChildProformaInvoiceLine $proformaInvoiceLine)
    {
        if ($this->getProformaInvoiceLines()->contains($proformaInvoiceLine)) {
            $pos = $this->collProformaInvoiceLines->search($proformaInvoiceLine);
            $this->collProformaInvoiceLines->remove($pos);
            if (null === $this->proformaInvoiceLinesScheduledForDeletion) {
                $this->proformaInvoiceLinesScheduledForDeletion = clone $this->collProformaInvoiceLines;
                $this->proformaInvoiceLinesScheduledForDeletion->clear();
            }
            $this->proformaInvoiceLinesScheduledForDeletion[]= clone $proformaInvoiceLine;
            $proformaInvoiceLine->setProformaInvoice(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProformaInvoice is new, it will return
     * an empty collection; or if this ProformaInvoice has previously
     * been saved, it will retrieve related ProformaInvoiceLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProformaInvoice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProformaInvoiceLine[] List of ChildProformaInvoiceLine objects
     */
    public function getProformaInvoiceLinesJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProformaInvoiceLineQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProformaInvoiceLines($query, $con);
    }

    /**
     * Clears out the collPurchaseOrders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPurchaseOrders()
     */
    public function clearPurchaseOrders()
    {
        $this->collPurchaseOrders = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPurchaseOrders collection loaded partially.
     */
    public function resetPartialPurchaseOrders($v = true)
    {
        $this->collPurchaseOrdersPartial = $v;
    }

    /**
     * Initializes the collPurchaseOrders collection.
     *
     * By default this just sets the collPurchaseOrders collection to an empty array (like clearcollPurchaseOrders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPurchaseOrders($overrideExisting = true)
    {
        if (null !== $this->collPurchaseOrders && !$overrideExisting) {
            return;
        }

        $collectionClassName = PurchaseOrderTableMap::getTableMap()->getCollectionClassName();

        $this->collPurchaseOrders = new $collectionClassName;
        $this->collPurchaseOrders->setModel('\PurchaseOrder');
    }

    /**
     * Gets an array of ChildPurchaseOrder objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProformaInvoice is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPurchaseOrder[] List of ChildPurchaseOrder objects
     * @throws PropelException
     */
    public function getPurchaseOrders(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPurchaseOrdersPartial && !$this->isNew();
        if (null === $this->collPurchaseOrders || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPurchaseOrders) {
                // return empty collection
                $this->initPurchaseOrders();
            } else {
                $collPurchaseOrders = ChildPurchaseOrderQuery::create(null, $criteria)
                    ->filterByProformaInvoice($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPurchaseOrdersPartial && count($collPurchaseOrders)) {
                        $this->initPurchaseOrders(false);

                        foreach ($collPurchaseOrders as $obj) {
                            if (false == $this->collPurchaseOrders->contains($obj)) {
                                $this->collPurchaseOrders->append($obj);
                            }
                        }

                        $this->collPurchaseOrdersPartial = true;
                    }

                    return $collPurchaseOrders;
                }

                if ($partial && $this->collPurchaseOrders) {
                    foreach ($this->collPurchaseOrders as $obj) {
                        if ($obj->isNew()) {
                            $collPurchaseOrders[] = $obj;
                        }
                    }
                }

                $this->collPurchaseOrders = $collPurchaseOrders;
                $this->collPurchaseOrdersPartial = false;
            }
        }

        return $this->collPurchaseOrders;
    }

    /**
     * Sets a collection of ChildPurchaseOrder objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $purchaseOrders A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProformaInvoice The current object (for fluent API support)
     */
    public function setPurchaseOrders(Collection $purchaseOrders, ConnectionInterface $con = null)
    {
        /** @var ChildPurchaseOrder[] $purchaseOrdersToDelete */
        $purchaseOrdersToDelete = $this->getPurchaseOrders(new Criteria(), $con)->diff($purchaseOrders);


        $this->purchaseOrdersScheduledForDeletion = $purchaseOrdersToDelete;

        foreach ($purchaseOrdersToDelete as $purchaseOrderRemoved) {
            $purchaseOrderRemoved->setProformaInvoice(null);
        }

        $this->collPurchaseOrders = null;
        foreach ($purchaseOrders as $purchaseOrder) {
            $this->addPurchaseOrder($purchaseOrder);
        }

        $this->collPurchaseOrders = $purchaseOrders;
        $this->collPurchaseOrdersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PurchaseOrder objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PurchaseOrder objects.
     * @throws PropelException
     */
    public function countPurchaseOrders(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPurchaseOrdersPartial && !$this->isNew();
        if (null === $this->collPurchaseOrders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPurchaseOrders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPurchaseOrders());
            }

            $query = ChildPurchaseOrderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProformaInvoice($this)
                ->count($con);
        }

        return count($this->collPurchaseOrders);
    }

    /**
     * Method called to associate a ChildPurchaseOrder object to this object
     * through the ChildPurchaseOrder foreign key attribute.
     *
     * @param  ChildPurchaseOrder $l ChildPurchaseOrder
     * @return $this|\ProformaInvoice The current object (for fluent API support)
     */
    public function addPurchaseOrder(ChildPurchaseOrder $l)
    {
        if ($this->collPurchaseOrders === null) {
            $this->initPurchaseOrders();
            $this->collPurchaseOrdersPartial = true;
        }

        if (!$this->collPurchaseOrders->contains($l)) {
            $this->doAddPurchaseOrder($l);

            if ($this->purchaseOrdersScheduledForDeletion and $this->purchaseOrdersScheduledForDeletion->contains($l)) {
                $this->purchaseOrdersScheduledForDeletion->remove($this->purchaseOrdersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPurchaseOrder $purchaseOrder The ChildPurchaseOrder object to add.
     */
    protected function doAddPurchaseOrder(ChildPurchaseOrder $purchaseOrder)
    {
        $this->collPurchaseOrders[]= $purchaseOrder;
        $purchaseOrder->setProformaInvoice($this);
    }

    /**
     * @param  ChildPurchaseOrder $purchaseOrder The ChildPurchaseOrder object to remove.
     * @return $this|ChildProformaInvoice The current object (for fluent API support)
     */
    public function removePurchaseOrder(ChildPurchaseOrder $purchaseOrder)
    {
        if ($this->getPurchaseOrders()->contains($purchaseOrder)) {
            $pos = $this->collPurchaseOrders->search($purchaseOrder);
            $this->collPurchaseOrders->remove($pos);
            if (null === $this->purchaseOrdersScheduledForDeletion) {
                $this->purchaseOrdersScheduledForDeletion = clone $this->collPurchaseOrders;
                $this->purchaseOrdersScheduledForDeletion->clear();
            }
            $this->purchaseOrdersScheduledForDeletion[]= $purchaseOrder;
            $purchaseOrder->setProformaInvoice(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProformaInvoice is new, it will return
     * an empty collection; or if this ProformaInvoice has previously
     * been saved, it will retrieve related PurchaseOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProformaInvoice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrder[] List of ChildPurchaseOrder objects
     */
    public function getPurchaseOrdersJoinPackingList(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderQuery::create(null, $criteria);
        $query->joinWith('PackingList', $joinBehavior);

        return $this->getPurchaseOrders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProformaInvoice is new, it will return
     * an empty collection; or if this ProformaInvoice has previously
     * been saved, it will retrieve related PurchaseOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProformaInvoice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrder[] List of ChildPurchaseOrder objects
     */
    public function getPurchaseOrdersJoinDownPayment(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderQuery::create(null, $criteria);
        $query->joinWith('DownPayment', $joinBehavior);

        return $this->getPurchaseOrders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProformaInvoice is new, it will return
     * an empty collection; or if this ProformaInvoice has previously
     * been saved, it will retrieve related PurchaseOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProformaInvoice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrder[] List of ChildPurchaseOrder objects
     */
    public function getPurchaseOrdersJoinCurrency(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getPurchaseOrders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ProformaInvoice is new, it will return
     * an empty collection; or if this ProformaInvoice has previously
     * been saved, it will retrieve related PurchaseOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ProformaInvoice.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrder[] List of ChildPurchaseOrder objects
     */
    public function getPurchaseOrdersJoinSupplier(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderQuery::create(null, $criteria);
        $query->joinWith('Supplier', $joinBehavior);

        return $this->getPurchaseOrders($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPartner) {
            $this->aPartner->removeProformaInvoice($this);
        }
        if (null !== $this->aCurrency) {
            $this->aCurrency->removeProformaInvoice($this);
        }
        $this->id = null;
        $this->name = null;
        $this->currency_id = null;
        $this->customer_id = null;
        $this->date = null;
        $this->confirm_date = null;
        $this->description = null;
        $this->total_cubic_dimension = null;
        $this->total_price = null;
        $this->state = null;
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
            if ($this->collProformaInvoiceLines) {
                foreach ($this->collProformaInvoiceLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchaseOrders) {
                foreach ($this->collPurchaseOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProformaInvoiceLines = null;
        $this->collPurchaseOrders = null;
        $this->aPartner = null;
        $this->aCurrency = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProformaInvoiceTableMap::DEFAULT_STRING_FORMAT);
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
