<?php

namespace Base;

use \PackingList as ChildPackingList;
use \PackingListLineQuery as ChildPackingListLineQuery;
use \PackingListQuery as ChildPackingListQuery;
use \ProformaInvoiceLine as ChildProformaInvoiceLine;
use \ProformaInvoiceLineQuery as ChildProformaInvoiceLineQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\PackingListLineTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'packing_list_line' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class PackingListLine implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PackingListLineTableMap';


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
     * The value for the packing_list_id field.
     *
     * @var        int
     */
    protected $packing_list_id;

    /**
     * The value for the proforma_invoice_line_id field.
     *
     * @var        int
     */
    protected $proforma_invoice_line_id;

    /**
     * The value for the net_weight field.
     *
     * @var        double
     */
    protected $net_weight;

    /**
     * The value for the gross_weight field.
     *
     * @var        double
     */
    protected $gross_weight;

    /**
     * The value for the qty field.
     *
     * @var        int
     */
    protected $qty;

    /**
     * The value for the qty_of_pack field.
     *
     * @var        int
     */
    protected $qty_of_pack;

    /**
     * The value for the cubic_dimension field.
     *
     * @var        double
     */
    protected $cubic_dimension;

    /**
     * The value for the total_cubic_dimension field.
     *
     * @var        double
     */
    protected $total_cubic_dimension;

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
     * @var        ChildPackingList
     */
    protected $aPackingList;

    /**
     * @var        ChildProformaInvoiceLine
     */
    protected $aProformaInvoiceLine;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of Base\PackingListLine object.
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
     * Compares this with another <code>PackingListLine</code> instance.  If
     * <code>obj</code> is an instance of <code>PackingListLine</code>, delegates to
     * <code>equals(PackingListLine)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|PackingListLine The current object, for fluid interface
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
     * Get the [packing_list_id] column value.
     *
     * @return int
     */
    public function getPackingListId()
    {
        return $this->packing_list_id;
    }

    /**
     * Get the [proforma_invoice_line_id] column value.
     *
     * @return int
     */
    public function getProformaInvoiceLineId()
    {
        return $this->proforma_invoice_line_id;
    }

    /**
     * Get the [net_weight] column value.
     *
     * @return double
     */
    public function getNetWeight()
    {
        return $this->net_weight;
    }

    /**
     * Get the [gross_weight] column value.
     *
     * @return double
     */
    public function getGrossWeight()
    {
        return $this->gross_weight;
    }

    /**
     * Get the [qty] column value.
     *
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Get the [qty_of_pack] column value.
     *
     * @return int
     */
    public function getQtyOfPack()
    {
        return $this->qty_of_pack;
    }

    /**
     * Get the [cubic_dimension] column value.
     *
     * @return double
     */
    public function getCubicDimension()
    {
        return $this->cubic_dimension;
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
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [packing_list_id] column.
     *
     * @param int $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setPackingListId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->packing_list_id !== $v) {
            $this->packing_list_id = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_PACKING_LIST_ID] = true;
        }

        if ($this->aPackingList !== null && $this->aPackingList->getId() !== $v) {
            $this->aPackingList = null;
        }

        return $this;
    } // setPackingListId()

    /**
     * Set the value of [proforma_invoice_line_id] column.
     *
     * @param int $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setProformaInvoiceLineId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->proforma_invoice_line_id !== $v) {
            $this->proforma_invoice_line_id = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID] = true;
        }

        if ($this->aProformaInvoiceLine !== null && $this->aProformaInvoiceLine->getId() !== $v) {
            $this->aProformaInvoiceLine = null;
        }

        return $this;
    } // setProformaInvoiceLineId()

    /**
     * Set the value of [net_weight] column.
     *
     * @param double $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setNetWeight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->net_weight !== $v) {
            $this->net_weight = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_NET_WEIGHT] = true;
        }

        return $this;
    } // setNetWeight()

    /**
     * Set the value of [gross_weight] column.
     *
     * @param double $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setGrossWeight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->gross_weight !== $v) {
            $this->gross_weight = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_GROSS_WEIGHT] = true;
        }

        return $this;
    } // setGrossWeight()

    /**
     * Set the value of [qty] column.
     *
     * @param int $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setQty($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qty !== $v) {
            $this->qty = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_QTY] = true;
        }

        return $this;
    } // setQty()

    /**
     * Set the value of [qty_of_pack] column.
     *
     * @param int $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setQtyOfPack($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qty_of_pack !== $v) {
            $this->qty_of_pack = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_QTY_OF_PACK] = true;
        }

        return $this;
    } // setQtyOfPack()

    /**
     * Set the value of [cubic_dimension] column.
     *
     * @param double $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setCubicDimension($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->cubic_dimension !== $v) {
            $this->cubic_dimension = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_CUBIC_DIMENSION] = true;
        }

        return $this;
    } // setCubicDimension()

    /**
     * Set the value of [total_cubic_dimension] column.
     *
     * @param double $v new value
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setTotalCubicDimension($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_cubic_dimension !== $v) {
            $this->total_cubic_dimension = $v;
            $this->modifiedColumns[PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION] = true;
        }

        return $this;
    } // setTotalCubicDimension()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PackingListLineTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PackingListLine The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PackingListLineTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PackingListLineTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PackingListLineTableMap::translateFieldName('PackingListId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->packing_list_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PackingListLineTableMap::translateFieldName('ProformaInvoiceLineId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->proforma_invoice_line_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PackingListLineTableMap::translateFieldName('NetWeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->net_weight = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PackingListLineTableMap::translateFieldName('GrossWeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gross_weight = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PackingListLineTableMap::translateFieldName('Qty', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PackingListLineTableMap::translateFieldName('QtyOfPack', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty_of_pack = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PackingListLineTableMap::translateFieldName('CubicDimension', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cubic_dimension = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PackingListLineTableMap::translateFieldName('TotalCubicDimension', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_cubic_dimension = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PackingListLineTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PackingListLineTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = PackingListLineTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PackingListLine'), 0, $e);
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
        if ($this->aPackingList !== null && $this->packing_list_id !== $this->aPackingList->getId()) {
            $this->aPackingList = null;
        }
        if ($this->aProformaInvoiceLine !== null && $this->proforma_invoice_line_id !== $this->aProformaInvoiceLine->getId()) {
            $this->aProformaInvoiceLine = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPackingListLineQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPackingList = null;
            $this->aProformaInvoiceLine = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PackingListLine::setDeleted()
     * @see PackingListLine::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPackingListLineQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListLineTableMap::DATABASE_NAME);
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
                PackingListLineTableMap::addInstanceToPool($this);
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

            if ($this->aPackingList !== null) {
                if ($this->aPackingList->isModified() || $this->aPackingList->isNew()) {
                    $affectedRows += $this->aPackingList->save($con);
                }
                $this->setPackingList($this->aPackingList);
            }

            if ($this->aProformaInvoiceLine !== null) {
                if ($this->aProformaInvoiceLine->isModified() || $this->aProformaInvoiceLine->isNew()) {
                    $affectedRows += $this->aProformaInvoiceLine->save($con);
                }
                $this->setProformaInvoiceLine($this->aProformaInvoiceLine);
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

        $this->modifiedColumns[PackingListLineTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PackingListLineTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PackingListLineTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_PACKING_LIST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'packing_list_id';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'proforma_invoice_line_id';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_NET_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'net_weight';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_GROSS_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'gross_weight';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_QTY)) {
            $modifiedColumns[':p' . $index++]  = 'qty';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_QTY_OF_PACK)) {
            $modifiedColumns[':p' . $index++]  = 'qty_of_pack';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_CUBIC_DIMENSION)) {
            $modifiedColumns[':p' . $index++]  = 'cubic_dimension';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION)) {
            $modifiedColumns[':p' . $index++]  = 'total_cubic_dimension';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO packing_list_line (%s) VALUES (%s)',
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
                    case 'packing_list_id':
                        $stmt->bindValue($identifier, $this->packing_list_id, PDO::PARAM_INT);
                        break;
                    case 'proforma_invoice_line_id':
                        $stmt->bindValue($identifier, $this->proforma_invoice_line_id, PDO::PARAM_INT);
                        break;
                    case 'net_weight':
                        $stmt->bindValue($identifier, $this->net_weight, PDO::PARAM_STR);
                        break;
                    case 'gross_weight':
                        $stmt->bindValue($identifier, $this->gross_weight, PDO::PARAM_STR);
                        break;
                    case 'qty':
                        $stmt->bindValue($identifier, $this->qty, PDO::PARAM_INT);
                        break;
                    case 'qty_of_pack':
                        $stmt->bindValue($identifier, $this->qty_of_pack, PDO::PARAM_INT);
                        break;
                    case 'cubic_dimension':
                        $stmt->bindValue($identifier, $this->cubic_dimension, PDO::PARAM_STR);
                        break;
                    case 'total_cubic_dimension':
                        $stmt->bindValue($identifier, $this->total_cubic_dimension, PDO::PARAM_STR);
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
        $pos = PackingListLineTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPackingListId();
                break;
            case 2:
                return $this->getProformaInvoiceLineId();
                break;
            case 3:
                return $this->getNetWeight();
                break;
            case 4:
                return $this->getGrossWeight();
                break;
            case 5:
                return $this->getQty();
                break;
            case 6:
                return $this->getQtyOfPack();
                break;
            case 7:
                return $this->getCubicDimension();
                break;
            case 8:
                return $this->getTotalCubicDimension();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
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

        if (isset($alreadyDumpedObjects['PackingListLine'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PackingListLine'][$this->hashCode()] = true;
        $keys = PackingListLineTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPackingListId(),
            $keys[2] => $this->getProformaInvoiceLineId(),
            $keys[3] => $this->getNetWeight(),
            $keys[4] => $this->getGrossWeight(),
            $keys[5] => $this->getQty(),
            $keys[6] => $this->getQtyOfPack(),
            $keys[7] => $this->getCubicDimension(),
            $keys[8] => $this->getTotalCubicDimension(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPackingList) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packingList';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'packing_list';
                        break;
                    default:
                        $key = 'PackingList';
                }

                $result[$key] = $this->aPackingList->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProformaInvoiceLine) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'proformaInvoiceLine';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'proforma_invoice_line';
                        break;
                    default:
                        $key = 'ProformaInvoiceLine';
                }

                $result[$key] = $this->aProformaInvoiceLine->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\PackingListLine
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PackingListLineTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\PackingListLine
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPackingListId($value);
                break;
            case 2:
                $this->setProformaInvoiceLineId($value);
                break;
            case 3:
                $this->setNetWeight($value);
                break;
            case 4:
                $this->setGrossWeight($value);
                break;
            case 5:
                $this->setQty($value);
                break;
            case 6:
                $this->setQtyOfPack($value);
                break;
            case 7:
                $this->setCubicDimension($value);
                break;
            case 8:
                $this->setTotalCubicDimension($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
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
        $keys = PackingListLineTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPackingListId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProformaInvoiceLineId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setNetWeight($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setGrossWeight($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setQty($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setQtyOfPack($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCubicDimension($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTotalCubicDimension($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCreatedAt($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUpdatedAt($arr[$keys[10]]);
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
     * @return $this|\PackingListLine The current object, for fluid interface
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
        $criteria = new Criteria(PackingListLineTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PackingListLineTableMap::COL_ID)) {
            $criteria->add(PackingListLineTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_PACKING_LIST_ID)) {
            $criteria->add(PackingListLineTableMap::COL_PACKING_LIST_ID, $this->packing_list_id);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID)) {
            $criteria->add(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $this->proforma_invoice_line_id);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_NET_WEIGHT)) {
            $criteria->add(PackingListLineTableMap::COL_NET_WEIGHT, $this->net_weight);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_GROSS_WEIGHT)) {
            $criteria->add(PackingListLineTableMap::COL_GROSS_WEIGHT, $this->gross_weight);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_QTY)) {
            $criteria->add(PackingListLineTableMap::COL_QTY, $this->qty);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_QTY_OF_PACK)) {
            $criteria->add(PackingListLineTableMap::COL_QTY_OF_PACK, $this->qty_of_pack);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_CUBIC_DIMENSION)) {
            $criteria->add(PackingListLineTableMap::COL_CUBIC_DIMENSION, $this->cubic_dimension);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION)) {
            $criteria->add(PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION, $this->total_cubic_dimension);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_CREATED_AT)) {
            $criteria->add(PackingListLineTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PackingListLineTableMap::COL_UPDATED_AT)) {
            $criteria->add(PackingListLineTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildPackingListLineQuery::create();
        $criteria->add(PackingListLineTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \PackingListLine (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPackingListId($this->getPackingListId());
        $copyObj->setProformaInvoiceLineId($this->getProformaInvoiceLineId());
        $copyObj->setNetWeight($this->getNetWeight());
        $copyObj->setGrossWeight($this->getGrossWeight());
        $copyObj->setQty($this->getQty());
        $copyObj->setQtyOfPack($this->getQtyOfPack());
        $copyObj->setCubicDimension($this->getCubicDimension());
        $copyObj->setTotalCubicDimension($this->getTotalCubicDimension());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
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
     * @return \PackingListLine Clone of current object.
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
     * Declares an association between this object and a ChildPackingList object.
     *
     * @param  ChildPackingList $v
     * @return $this|\PackingListLine The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPackingList(ChildPackingList $v = null)
    {
        if ($v === null) {
            $this->setPackingListId(NULL);
        } else {
            $this->setPackingListId($v->getId());
        }

        $this->aPackingList = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPackingList object, it will not be re-added.
        if ($v !== null) {
            $v->addPackingListLine($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPackingList object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPackingList The associated ChildPackingList object.
     * @throws PropelException
     */
    public function getPackingList(ConnectionInterface $con = null)
    {
        if ($this->aPackingList === null && ($this->packing_list_id != 0)) {
            $this->aPackingList = ChildPackingListQuery::create()->findPk($this->packing_list_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPackingList->addPackingListLines($this);
             */
        }

        return $this->aPackingList;
    }

    /**
     * Declares an association between this object and a ChildProformaInvoiceLine object.
     *
     * @param  ChildProformaInvoiceLine $v
     * @return $this|\PackingListLine The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProformaInvoiceLine(ChildProformaInvoiceLine $v = null)
    {
        if ($v === null) {
            $this->setProformaInvoiceLineId(NULL);
        } else {
            $this->setProformaInvoiceLineId($v->getId());
        }

        $this->aProformaInvoiceLine = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProformaInvoiceLine object, it will not be re-added.
        if ($v !== null) {
            $v->addPackingListLine($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProformaInvoiceLine object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProformaInvoiceLine The associated ChildProformaInvoiceLine object.
     * @throws PropelException
     */
    public function getProformaInvoiceLine(ConnectionInterface $con = null)
    {
        if ($this->aProformaInvoiceLine === null && ($this->proforma_invoice_line_id != 0)) {
            $this->aProformaInvoiceLine = ChildProformaInvoiceLineQuery::create()->findPk($this->proforma_invoice_line_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProformaInvoiceLine->addPackingListLines($this);
             */
        }

        return $this->aProformaInvoiceLine;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPackingList) {
            $this->aPackingList->removePackingListLine($this);
        }
        if (null !== $this->aProformaInvoiceLine) {
            $this->aProformaInvoiceLine->removePackingListLine($this);
        }
        $this->id = null;
        $this->packing_list_id = null;
        $this->proforma_invoice_line_id = null;
        $this->net_weight = null;
        $this->gross_weight = null;
        $this->qty = null;
        $this->qty_of_pack = null;
        $this->cubic_dimension = null;
        $this->total_cubic_dimension = null;
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
        } // if ($deep)

        $this->aPackingList = null;
        $this->aProformaInvoiceLine = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PackingListLineTableMap::DEFAULT_STRING_FORMAT);
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
