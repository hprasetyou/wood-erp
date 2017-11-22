<?php

namespace Base;

use \PackingList as ChildPackingList;
use \PackingListLine as ChildPackingListLine;
use \PackingListLineQuery as ChildPackingListLineQuery;
use \PackingListQuery as ChildPackingListQuery;
use \Partner as ChildPartner;
use \PartnerQuery as ChildPartnerQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\PackingListLineTableMap;
use Map\PackingListTableMap;
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
 * Base class that represents a row from the 'packing_list' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class PackingList implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PackingListTableMap';


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
     * The value for the date field.
     *
     * @var        DateTime
     */
    protected $date;

    /**
     * The value for the loading_date field.
     *
     * @var        DateTime
     */
    protected $loading_date;

    /**
     * The value for the customer_id field.
     *
     * @var        int
     */
    protected $customer_id;

    /**
     * The value for the ocean_vessel field.
     *
     * @var        string
     */
    protected $ocean_vessel;

    /**
     * The value for the src_loc field.
     *
     * @var        string
     */
    protected $src_loc;

    /**
     * The value for the bl_no field.
     *
     * @var        string
     */
    protected $bl_no;

    /**
     * The value for the goods_description field.
     *
     * @var        string
     */
    protected $goods_description;

    /**
     * The value for the cntr_no field.
     *
     * @var        string
     */
    protected $cntr_no;

    /**
     * The value for the seal_no field.
     *
     * @var        string
     */
    protected $seal_no;

    /**
     * The value for the pod field.
     *
     * @var        string
     */
    protected $pod;

    /**
     * The value for the etd_srg field.
     *
     * @var        string
     */
    protected $etd_srg;

    /**
     * The value for the ref_doc field.
     *
     * @var        string
     */
    protected $ref_doc;

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
     * @var        ObjectCollection|ChildPackingListLine[] Collection to store aggregation of ChildPackingListLine objects.
     */
    protected $collPackingListLines;
    protected $collPackingListLinesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPackingListLine[]
     */
    protected $packingListLinesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->state = 'draft';
    }

    /**
     * Initializes internal state of Base\PackingList object.
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
     * Compares this with another <code>PackingList</code> instance.  If
     * <code>obj</code> is an instance of <code>PackingList</code>, delegates to
     * <code>equals(PackingList)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|PackingList The current object, for fluid interface
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
     * Get the [optionally formatted] temporal [loading_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLoadingDate($format = NULL)
    {
        if ($format === null) {
            return $this->loading_date;
        } else {
            return $this->loading_date instanceof \DateTimeInterface ? $this->loading_date->format($format) : null;
        }
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
     * Get the [ocean_vessel] column value.
     *
     * @return string
     */
    public function getOceanVessel()
    {
        return $this->ocean_vessel;
    }

    /**
     * Get the [src_loc] column value.
     *
     * @return string
     */
    public function getSrcLoc()
    {
        return $this->src_loc;
    }

    /**
     * Get the [bl_no] column value.
     *
     * @return string
     */
    public function getBlNo()
    {
        return $this->bl_no;
    }

    /**
     * Get the [goods_description] column value.
     *
     * @return string
     */
    public function getGoodsDescription()
    {
        return $this->goods_description;
    }

    /**
     * Get the [cntr_no] column value.
     *
     * @return string
     */
    public function getCntrNo()
    {
        return $this->cntr_no;
    }

    /**
     * Get the [seal_no] column value.
     *
     * @return string
     */
    public function getSealNo()
    {
        return $this->seal_no;
    }

    /**
     * Get the [pod] column value.
     *
     * @return string
     */
    public function getPod()
    {
        return $this->pod;
    }

    /**
     * Get the [etd_srg] column value.
     *
     * @return string
     */
    public function getEtdSrg()
    {
        return $this->etd_srg;
    }

    /**
     * Get the [ref_doc] column value.
     *
     * @return string
     */
    public function getRefDoc()
    {
        return $this->ref_doc;
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
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PackingListTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[PackingListTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            if ($this->date === null || $dt === null || $dt->format("Y-m-d") !== $this->date->format("Y-m-d")) {
                $this->date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PackingListTableMap::COL_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDate()

    /**
     * Sets the value of [loading_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setLoadingDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->loading_date !== null || $dt !== null) {
            if ($this->loading_date === null || $dt === null || $dt->format("Y-m-d") !== $this->loading_date->format("Y-m-d")) {
                $this->loading_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PackingListTableMap::COL_LOADING_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setLoadingDate()

    /**
     * Set the value of [customer_id] column.
     *
     * @param int $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setCustomerId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->customer_id !== $v) {
            $this->customer_id = $v;
            $this->modifiedColumns[PackingListTableMap::COL_CUSTOMER_ID] = true;
        }

        if ($this->aPartner !== null && $this->aPartner->getId() !== $v) {
            $this->aPartner = null;
        }

        return $this;
    } // setCustomerId()

    /**
     * Set the value of [ocean_vessel] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setOceanVessel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ocean_vessel !== $v) {
            $this->ocean_vessel = $v;
            $this->modifiedColumns[PackingListTableMap::COL_OCEAN_VESSEL] = true;
        }

        return $this;
    } // setOceanVessel()

    /**
     * Set the value of [src_loc] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setSrcLoc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->src_loc !== $v) {
            $this->src_loc = $v;
            $this->modifiedColumns[PackingListTableMap::COL_SRC_LOC] = true;
        }

        return $this;
    } // setSrcLoc()

    /**
     * Set the value of [bl_no] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setBlNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bl_no !== $v) {
            $this->bl_no = $v;
            $this->modifiedColumns[PackingListTableMap::COL_BL_NO] = true;
        }

        return $this;
    } // setBlNo()

    /**
     * Set the value of [goods_description] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setGoodsDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->goods_description !== $v) {
            $this->goods_description = $v;
            $this->modifiedColumns[PackingListTableMap::COL_GOODS_DESCRIPTION] = true;
        }

        return $this;
    } // setGoodsDescription()

    /**
     * Set the value of [cntr_no] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setCntrNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cntr_no !== $v) {
            $this->cntr_no = $v;
            $this->modifiedColumns[PackingListTableMap::COL_CNTR_NO] = true;
        }

        return $this;
    } // setCntrNo()

    /**
     * Set the value of [seal_no] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setSealNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->seal_no !== $v) {
            $this->seal_no = $v;
            $this->modifiedColumns[PackingListTableMap::COL_SEAL_NO] = true;
        }

        return $this;
    } // setSealNo()

    /**
     * Set the value of [pod] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setPod($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pod !== $v) {
            $this->pod = $v;
            $this->modifiedColumns[PackingListTableMap::COL_POD] = true;
        }

        return $this;
    } // setPod()

    /**
     * Set the value of [etd_srg] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setEtdSrg($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->etd_srg !== $v) {
            $this->etd_srg = $v;
            $this->modifiedColumns[PackingListTableMap::COL_ETD_SRG] = true;
        }

        return $this;
    } // setEtdSrg()

    /**
     * Set the value of [ref_doc] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setRefDoc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ref_doc !== $v) {
            $this->ref_doc = $v;
            $this->modifiedColumns[PackingListTableMap::COL_REF_DOC] = true;
        }

        return $this;
    } // setRefDoc()

    /**
     * Set the value of [state] column.
     *
     * @param string $v new value
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->state !== $v) {
            $this->state = $v;
            $this->modifiedColumns[PackingListTableMap::COL_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PackingListTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PackingListTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PackingListTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PackingListTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PackingListTableMap::translateFieldName('Date', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PackingListTableMap::translateFieldName('LoadingDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->loading_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PackingListTableMap::translateFieldName('CustomerId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->customer_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PackingListTableMap::translateFieldName('OceanVessel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ocean_vessel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PackingListTableMap::translateFieldName('SrcLoc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->src_loc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PackingListTableMap::translateFieldName('BlNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bl_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PackingListTableMap::translateFieldName('GoodsDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->goods_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PackingListTableMap::translateFieldName('CntrNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cntr_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PackingListTableMap::translateFieldName('SealNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->seal_no = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PackingListTableMap::translateFieldName('Pod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pod = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PackingListTableMap::translateFieldName('EtdSrg', TableMap::TYPE_PHPNAME, $indexType)];
            $this->etd_srg = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PackingListTableMap::translateFieldName('RefDoc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ref_doc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PackingListTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PackingListTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PackingListTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 17; // 17 = PackingListTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PackingList'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PackingListTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPackingListQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPartner = null;
            $this->collPackingListLines = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PackingList::setDeleted()
     * @see PackingList::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPackingListQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListTableMap::DATABASE_NAME);
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
                PackingListTableMap::addInstanceToPool($this);
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

            if ($this->packingListLinesScheduledForDeletion !== null) {
                if (!$this->packingListLinesScheduledForDeletion->isEmpty()) {
                    \PackingListLineQuery::create()
                        ->filterByPrimaryKeys($this->packingListLinesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->packingListLinesScheduledForDeletion = null;
                }
            }

            if ($this->collPackingListLines !== null) {
                foreach ($this->collPackingListLines as $referrerFK) {
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

        $this->modifiedColumns[PackingListTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PackingListTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PackingListTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'date';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_LOADING_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'loading_date';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_CUSTOMER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'customer_id';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_OCEAN_VESSEL)) {
            $modifiedColumns[':p' . $index++]  = 'ocean_vessel';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_SRC_LOC)) {
            $modifiedColumns[':p' . $index++]  = 'src_loc';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_BL_NO)) {
            $modifiedColumns[':p' . $index++]  = 'bl_no';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_GOODS_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'goods_description';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_CNTR_NO)) {
            $modifiedColumns[':p' . $index++]  = 'cntr_no';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_SEAL_NO)) {
            $modifiedColumns[':p' . $index++]  = 'seal_no';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_POD)) {
            $modifiedColumns[':p' . $index++]  = 'pod';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_ETD_SRG)) {
            $modifiedColumns[':p' . $index++]  = 'etd_srg';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_REF_DOC)) {
            $modifiedColumns[':p' . $index++]  = 'ref_doc';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'state';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PackingListTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO packing_list (%s) VALUES (%s)',
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
                    case 'date':
                        $stmt->bindValue($identifier, $this->date ? $this->date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'loading_date':
                        $stmt->bindValue($identifier, $this->loading_date ? $this->loading_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'customer_id':
                        $stmt->bindValue($identifier, $this->customer_id, PDO::PARAM_INT);
                        break;
                    case 'ocean_vessel':
                        $stmt->bindValue($identifier, $this->ocean_vessel, PDO::PARAM_STR);
                        break;
                    case 'src_loc':
                        $stmt->bindValue($identifier, $this->src_loc, PDO::PARAM_STR);
                        break;
                    case 'bl_no':
                        $stmt->bindValue($identifier, $this->bl_no, PDO::PARAM_STR);
                        break;
                    case 'goods_description':
                        $stmt->bindValue($identifier, $this->goods_description, PDO::PARAM_STR);
                        break;
                    case 'cntr_no':
                        $stmt->bindValue($identifier, $this->cntr_no, PDO::PARAM_STR);
                        break;
                    case 'seal_no':
                        $stmt->bindValue($identifier, $this->seal_no, PDO::PARAM_STR);
                        break;
                    case 'pod':
                        $stmt->bindValue($identifier, $this->pod, PDO::PARAM_STR);
                        break;
                    case 'etd_srg':
                        $stmt->bindValue($identifier, $this->etd_srg, PDO::PARAM_STR);
                        break;
                    case 'ref_doc':
                        $stmt->bindValue($identifier, $this->ref_doc, PDO::PARAM_STR);
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
        $pos = PackingListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDate();
                break;
            case 3:
                return $this->getLoadingDate();
                break;
            case 4:
                return $this->getCustomerId();
                break;
            case 5:
                return $this->getOceanVessel();
                break;
            case 6:
                return $this->getSrcLoc();
                break;
            case 7:
                return $this->getBlNo();
                break;
            case 8:
                return $this->getGoodsDescription();
                break;
            case 9:
                return $this->getCntrNo();
                break;
            case 10:
                return $this->getSealNo();
                break;
            case 11:
                return $this->getPod();
                break;
            case 12:
                return $this->getEtdSrg();
                break;
            case 13:
                return $this->getRefDoc();
                break;
            case 14:
                return $this->getState();
                break;
            case 15:
                return $this->getCreatedAt();
                break;
            case 16:
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

        if (isset($alreadyDumpedObjects['PackingList'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PackingList'][$this->hashCode()] = true;
        $keys = PackingListTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDate(),
            $keys[3] => $this->getLoadingDate(),
            $keys[4] => $this->getCustomerId(),
            $keys[5] => $this->getOceanVessel(),
            $keys[6] => $this->getSrcLoc(),
            $keys[7] => $this->getBlNo(),
            $keys[8] => $this->getGoodsDescription(),
            $keys[9] => $this->getCntrNo(),
            $keys[10] => $this->getSealNo(),
            $keys[11] => $this->getPod(),
            $keys[12] => $this->getEtdSrg(),
            $keys[13] => $this->getRefDoc(),
            $keys[14] => $this->getState(),
            $keys[15] => $this->getCreatedAt(),
            $keys[16] => $this->getUpdatedAt(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('c');
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
            if (null !== $this->collPackingListLines) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packingListLines';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'packing_list_lines';
                        break;
                    default:
                        $key = 'PackingListLines';
                }

                $result[$key] = $this->collPackingListLines->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\PackingList
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PackingListTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\PackingList
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
                $this->setDate($value);
                break;
            case 3:
                $this->setLoadingDate($value);
                break;
            case 4:
                $this->setCustomerId($value);
                break;
            case 5:
                $this->setOceanVessel($value);
                break;
            case 6:
                $this->setSrcLoc($value);
                break;
            case 7:
                $this->setBlNo($value);
                break;
            case 8:
                $this->setGoodsDescription($value);
                break;
            case 9:
                $this->setCntrNo($value);
                break;
            case 10:
                $this->setSealNo($value);
                break;
            case 11:
                $this->setPod($value);
                break;
            case 12:
                $this->setEtdSrg($value);
                break;
            case 13:
                $this->setRefDoc($value);
                break;
            case 14:
                $this->setState($value);
                break;
            case 15:
                $this->setCreatedAt($value);
                break;
            case 16:
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
        $keys = PackingListTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLoadingDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCustomerId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setOceanVessel($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSrcLoc($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setBlNo($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setGoodsDescription($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCntrNo($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setSealNo($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPod($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setEtdSrg($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setRefDoc($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setState($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCreatedAt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setUpdatedAt($arr[$keys[16]]);
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
     * @return $this|\PackingList The current object, for fluid interface
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
        $criteria = new Criteria(PackingListTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PackingListTableMap::COL_ID)) {
            $criteria->add(PackingListTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_NAME)) {
            $criteria->add(PackingListTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_DATE)) {
            $criteria->add(PackingListTableMap::COL_DATE, $this->date);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_LOADING_DATE)) {
            $criteria->add(PackingListTableMap::COL_LOADING_DATE, $this->loading_date);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_CUSTOMER_ID)) {
            $criteria->add(PackingListTableMap::COL_CUSTOMER_ID, $this->customer_id);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_OCEAN_VESSEL)) {
            $criteria->add(PackingListTableMap::COL_OCEAN_VESSEL, $this->ocean_vessel);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_SRC_LOC)) {
            $criteria->add(PackingListTableMap::COL_SRC_LOC, $this->src_loc);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_BL_NO)) {
            $criteria->add(PackingListTableMap::COL_BL_NO, $this->bl_no);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_GOODS_DESCRIPTION)) {
            $criteria->add(PackingListTableMap::COL_GOODS_DESCRIPTION, $this->goods_description);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_CNTR_NO)) {
            $criteria->add(PackingListTableMap::COL_CNTR_NO, $this->cntr_no);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_SEAL_NO)) {
            $criteria->add(PackingListTableMap::COL_SEAL_NO, $this->seal_no);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_POD)) {
            $criteria->add(PackingListTableMap::COL_POD, $this->pod);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_ETD_SRG)) {
            $criteria->add(PackingListTableMap::COL_ETD_SRG, $this->etd_srg);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_REF_DOC)) {
            $criteria->add(PackingListTableMap::COL_REF_DOC, $this->ref_doc);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_STATE)) {
            $criteria->add(PackingListTableMap::COL_STATE, $this->state);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_CREATED_AT)) {
            $criteria->add(PackingListTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PackingListTableMap::COL_UPDATED_AT)) {
            $criteria->add(PackingListTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildPackingListQuery::create();
        $criteria->add(PackingListTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \PackingList (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDate($this->getDate());
        $copyObj->setLoadingDate($this->getLoadingDate());
        $copyObj->setCustomerId($this->getCustomerId());
        $copyObj->setOceanVessel($this->getOceanVessel());
        $copyObj->setSrcLoc($this->getSrcLoc());
        $copyObj->setBlNo($this->getBlNo());
        $copyObj->setGoodsDescription($this->getGoodsDescription());
        $copyObj->setCntrNo($this->getCntrNo());
        $copyObj->setSealNo($this->getSealNo());
        $copyObj->setPod($this->getPod());
        $copyObj->setEtdSrg($this->getEtdSrg());
        $copyObj->setRefDoc($this->getRefDoc());
        $copyObj->setState($this->getState());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPackingListLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPackingListLine($relObj->copy($deepCopy));
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
     * @return \PackingList Clone of current object.
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
     * @return $this|\PackingList The current object (for fluent API support)
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
            $v->addPackingList($this);
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
                $this->aPartner->addPackingLists($this);
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
        if ('PackingListLine' == $relationName) {
            $this->initPackingListLines();
            return;
        }
    }

    /**
     * Clears out the collPackingListLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPackingListLines()
     */
    public function clearPackingListLines()
    {
        $this->collPackingListLines = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPackingListLines collection loaded partially.
     */
    public function resetPartialPackingListLines($v = true)
    {
        $this->collPackingListLinesPartial = $v;
    }

    /**
     * Initializes the collPackingListLines collection.
     *
     * By default this just sets the collPackingListLines collection to an empty array (like clearcollPackingListLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPackingListLines($overrideExisting = true)
    {
        if (null !== $this->collPackingListLines && !$overrideExisting) {
            return;
        }

        $collectionClassName = PackingListLineTableMap::getTableMap()->getCollectionClassName();

        $this->collPackingListLines = new $collectionClassName;
        $this->collPackingListLines->setModel('\PackingListLine');
    }

    /**
     * Gets an array of ChildPackingListLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPackingList is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPackingListLine[] List of ChildPackingListLine objects
     * @throws PropelException
     */
    public function getPackingListLines(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPackingListLinesPartial && !$this->isNew();
        if (null === $this->collPackingListLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPackingListLines) {
                // return empty collection
                $this->initPackingListLines();
            } else {
                $collPackingListLines = ChildPackingListLineQuery::create(null, $criteria)
                    ->filterByPackingList($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPackingListLinesPartial && count($collPackingListLines)) {
                        $this->initPackingListLines(false);

                        foreach ($collPackingListLines as $obj) {
                            if (false == $this->collPackingListLines->contains($obj)) {
                                $this->collPackingListLines->append($obj);
                            }
                        }

                        $this->collPackingListLinesPartial = true;
                    }

                    return $collPackingListLines;
                }

                if ($partial && $this->collPackingListLines) {
                    foreach ($this->collPackingListLines as $obj) {
                        if ($obj->isNew()) {
                            $collPackingListLines[] = $obj;
                        }
                    }
                }

                $this->collPackingListLines = $collPackingListLines;
                $this->collPackingListLinesPartial = false;
            }
        }

        return $this->collPackingListLines;
    }

    /**
     * Sets a collection of ChildPackingListLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $packingListLines A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPackingList The current object (for fluent API support)
     */
    public function setPackingListLines(Collection $packingListLines, ConnectionInterface $con = null)
    {
        /** @var ChildPackingListLine[] $packingListLinesToDelete */
        $packingListLinesToDelete = $this->getPackingListLines(new Criteria(), $con)->diff($packingListLines);


        $this->packingListLinesScheduledForDeletion = $packingListLinesToDelete;

        foreach ($packingListLinesToDelete as $packingListLineRemoved) {
            $packingListLineRemoved->setPackingList(null);
        }

        $this->collPackingListLines = null;
        foreach ($packingListLines as $packingListLine) {
            $this->addPackingListLine($packingListLine);
        }

        $this->collPackingListLines = $packingListLines;
        $this->collPackingListLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PackingListLine objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PackingListLine objects.
     * @throws PropelException
     */
    public function countPackingListLines(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPackingListLinesPartial && !$this->isNew();
        if (null === $this->collPackingListLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPackingListLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPackingListLines());
            }

            $query = ChildPackingListLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPackingList($this)
                ->count($con);
        }

        return count($this->collPackingListLines);
    }

    /**
     * Method called to associate a ChildPackingListLine object to this object
     * through the ChildPackingListLine foreign key attribute.
     *
     * @param  ChildPackingListLine $l ChildPackingListLine
     * @return $this|\PackingList The current object (for fluent API support)
     */
    public function addPackingListLine(ChildPackingListLine $l)
    {
        if ($this->collPackingListLines === null) {
            $this->initPackingListLines();
            $this->collPackingListLinesPartial = true;
        }

        if (!$this->collPackingListLines->contains($l)) {
            $this->doAddPackingListLine($l);

            if ($this->packingListLinesScheduledForDeletion and $this->packingListLinesScheduledForDeletion->contains($l)) {
                $this->packingListLinesScheduledForDeletion->remove($this->packingListLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPackingListLine $packingListLine The ChildPackingListLine object to add.
     */
    protected function doAddPackingListLine(ChildPackingListLine $packingListLine)
    {
        $this->collPackingListLines[]= $packingListLine;
        $packingListLine->setPackingList($this);
    }

    /**
     * @param  ChildPackingListLine $packingListLine The ChildPackingListLine object to remove.
     * @return $this|ChildPackingList The current object (for fluent API support)
     */
    public function removePackingListLine(ChildPackingListLine $packingListLine)
    {
        if ($this->getPackingListLines()->contains($packingListLine)) {
            $pos = $this->collPackingListLines->search($packingListLine);
            $this->collPackingListLines->remove($pos);
            if (null === $this->packingListLinesScheduledForDeletion) {
                $this->packingListLinesScheduledForDeletion = clone $this->collPackingListLines;
                $this->packingListLinesScheduledForDeletion->clear();
            }
            $this->packingListLinesScheduledForDeletion[]= clone $packingListLine;
            $packingListLine->setPackingList(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PackingList is new, it will return
     * an empty collection; or if this PackingList has previously
     * been saved, it will retrieve related PackingListLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PackingList.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPackingListLine[] List of ChildPackingListLine objects
     */
    public function getPackingListLinesJoinProformaInvoiceLine(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPackingListLineQuery::create(null, $criteria);
        $query->joinWith('ProformaInvoiceLine', $joinBehavior);

        return $this->getPackingListLines($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPartner) {
            $this->aPartner->removePackingList($this);
        }
        $this->id = null;
        $this->name = null;
        $this->date = null;
        $this->loading_date = null;
        $this->customer_id = null;
        $this->ocean_vessel = null;
        $this->src_loc = null;
        $this->bl_no = null;
        $this->goods_description = null;
        $this->cntr_no = null;
        $this->seal_no = null;
        $this->pod = null;
        $this->etd_srg = null;
        $this->ref_doc = null;
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
            if ($this->collPackingListLines) {
                foreach ($this->collPackingListLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPackingListLines = null;
        $this->aPartner = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PackingListTableMap::DEFAULT_STRING_FORMAT);
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
