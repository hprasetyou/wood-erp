<?php

namespace Base;

use \ComponentPartner as ChildComponentPartner;
use \ComponentPartnerQuery as ChildComponentPartnerQuery;
use \PackingList as ChildPackingList;
use \PackingListQuery as ChildPackingListQuery;
use \Partner as ChildPartner;
use \PartnerBank as ChildPartnerBank;
use \PartnerBankQuery as ChildPartnerBankQuery;
use \PartnerQuery as ChildPartnerQuery;
use \ProductPartner as ChildProductPartner;
use \ProductPartnerQuery as ChildProductPartnerQuery;
use \ProformaInvoice as ChildProformaInvoice;
use \ProformaInvoiceQuery as ChildProformaInvoiceQuery;
use \PurchaseOrder as ChildPurchaseOrder;
use \PurchaseOrderQuery as ChildPurchaseOrderQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ComponentPartnerTableMap;
use Map\PackingListTableMap;
use Map\PartnerBankTableMap;
use Map\PartnerTableMap;
use Map\ProductPartnerTableMap;
use Map\ProformaInvoiceTableMap;
use Map\PurchaseOrderTableMap;
use Map\UserTableMap;
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
 * Base class that represents a row from the 'partner' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Partner implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PartnerTableMap';


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
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the website field.
     *
     * @var        string
     */
    protected $website;

    /**
     * The value for the fax field.
     *
     * @var        string
     */
    protected $fax;

    /**
     * The value for the image field.
     *
     * @var        string
     */
    protected $image;

    /**
     * The value for the tax_number field.
     *
     * @var        string
     */
    protected $tax_number;

    /**
     * The value for the company_id field.
     *
     * @var        int
     */
    protected $company_id;

    /**
     * The value for the class_key field.
     *
     * @var        int
     */
    protected $class_key;

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
    protected $aCompany;

    /**
     * @var        ObjectCollection|ChildPartner[] Collection to store aggregation of ChildPartner objects.
     */
    protected $collPartnersRelatedById;
    protected $collPartnersRelatedByIdPartial;

    /**
     * @var        ObjectCollection|ChildProductPartner[] Collection to store aggregation of ChildProductPartner objects.
     */
    protected $collProductPartners;
    protected $collProductPartnersPartial;

    /**
     * @var        ObjectCollection|ChildUser[] Collection to store aggregation of ChildUser objects.
     */
    protected $collUsers;
    protected $collUsersPartial;

    /**
     * @var        ObjectCollection|ChildProformaInvoice[] Collection to store aggregation of ChildProformaInvoice objects.
     */
    protected $collProformaInvoices;
    protected $collProformaInvoicesPartial;

    /**
     * @var        ObjectCollection|ChildPackingList[] Collection to store aggregation of ChildPackingList objects.
     */
    protected $collPackingLists;
    protected $collPackingListsPartial;

    /**
     * @var        ObjectCollection|ChildPurchaseOrder[] Collection to store aggregation of ChildPurchaseOrder objects.
     */
    protected $collPurchaseOrders;
    protected $collPurchaseOrdersPartial;

    /**
     * @var        ObjectCollection|ChildComponentPartner[] Collection to store aggregation of ChildComponentPartner objects.
     */
    protected $collComponentPartners;
    protected $collComponentPartnersPartial;

    /**
     * @var        ObjectCollection|ChildPartnerBank[] Collection to store aggregation of ChildPartnerBank objects.
     */
    protected $collPartnerBanks;
    protected $collPartnerBanksPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartner[]
     */
    protected $partnersRelatedByIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductPartner[]
     */
    protected $productPartnersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUser[]
     */
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProformaInvoice[]
     */
    protected $proformaInvoicesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPackingList[]
     */
    protected $packingListsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPurchaseOrder[]
     */
    protected $purchaseOrdersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildComponentPartner[]
     */
    protected $componentPartnersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartnerBank[]
     */
    protected $partnerBanksScheduledForDeletion = null;

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
     * Initializes internal state of Base\Partner object.
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
     * Compares this with another <code>Partner</code> instance.  If
     * <code>obj</code> is an instance of <code>Partner</code>, delegates to
     * <code>equals(Partner)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Partner The current object, for fluid interface
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
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [website] column value.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Get the [fax] column value.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Get the [image] column value.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the [tax_number] column value.
     *
     * @return string
     */
    public function getTaxNumber()
    {
        return $this->tax_number;
    }

    /**
     * Get the [company_id] column value.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * Get the [class_key] column value.
     *
     * @return int
     */
    public function getClassKey()
    {
        return $this->class_key;
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
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PartnerTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[PartnerTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[PartnerTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [address] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[PartnerTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[PartnerTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [website] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setWebsite($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->website !== $v) {
            $this->website = $v;
            $this->modifiedColumns[PartnerTableMap::COL_WEBSITE] = true;
        }

        return $this;
    } // setWebsite()

    /**
     * Set the value of [fax] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setFax($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fax !== $v) {
            $this->fax = $v;
            $this->modifiedColumns[PartnerTableMap::COL_FAX] = true;
        }

        return $this;
    } // setFax()

    /**
     * Set the value of [image] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[PartnerTableMap::COL_IMAGE] = true;
        }

        return $this;
    } // setImage()

    /**
     * Set the value of [tax_number] column.
     *
     * @param string $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setTaxNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tax_number !== $v) {
            $this->tax_number = $v;
            $this->modifiedColumns[PartnerTableMap::COL_TAX_NUMBER] = true;
        }

        return $this;
    } // setTaxNumber()

    /**
     * Set the value of [company_id] column.
     *
     * @param int $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setCompanyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->company_id !== $v) {
            $this->company_id = $v;
            $this->modifiedColumns[PartnerTableMap::COL_COMPANY_ID] = true;
        }

        if ($this->aCompany !== null && $this->aCompany->getId() !== $v) {
            $this->aCompany = null;
        }

        return $this;
    } // setCompanyId()

    /**
     * Set the value of [class_key] column.
     *
     * @param int $v new value
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setClassKey($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->class_key !== $v) {
            $this->class_key = $v;
            $this->modifiedColumns[PartnerTableMap::COL_CLASS_KEY] = true;
        }

        return $this;
    } // setClassKey()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PartnerTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PartnerTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PartnerTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PartnerTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PartnerTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PartnerTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PartnerTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PartnerTableMap::translateFieldName('Website', TableMap::TYPE_PHPNAME, $indexType)];
            $this->website = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PartnerTableMap::translateFieldName('Fax', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fax = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PartnerTableMap::translateFieldName('Image', TableMap::TYPE_PHPNAME, $indexType)];
            $this->image = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PartnerTableMap::translateFieldName('TaxNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tax_number = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PartnerTableMap::translateFieldName('CompanyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->company_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PartnerTableMap::translateFieldName('ClassKey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->class_key = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PartnerTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PartnerTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = PartnerTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Partner'), 0, $e);
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
        if ($this->aCompany !== null && $this->company_id !== $this->aCompany->getId()) {
            $this->aCompany = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PartnerTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPartnerQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompany = null;
            $this->collPartnersRelatedById = null;

            $this->collProductPartners = null;

            $this->collUsers = null;

            $this->collProformaInvoices = null;

            $this->collPackingLists = null;

            $this->collPurchaseOrders = null;

            $this->collComponentPartners = null;

            $this->collPartnerBanks = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Partner::setDeleted()
     * @see Partner::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPartnerQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
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
                PartnerTableMap::addInstanceToPool($this);
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

            if ($this->aCompany !== null) {
                if ($this->aCompany->isModified() || $this->aCompany->isNew()) {
                    $affectedRows += $this->aCompany->save($con);
                }
                $this->setCompany($this->aCompany);
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

            if ($this->partnersRelatedByIdScheduledForDeletion !== null) {
                if (!$this->partnersRelatedByIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->partnersRelatedByIdScheduledForDeletion as $partnerRelatedById) {
                        // need to save related object because we set the relation to null
                        $partnerRelatedById->save($con);
                    }
                    $this->partnersRelatedByIdScheduledForDeletion = null;
                }
            }

            if ($this->collPartnersRelatedById !== null) {
                foreach ($this->collPartnersRelatedById as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productPartnersScheduledForDeletion !== null) {
                if (!$this->productPartnersScheduledForDeletion->isEmpty()) {
                    foreach ($this->productPartnersScheduledForDeletion as $productPartner) {
                        // need to save related object because we set the relation to null
                        $productPartner->save($con);
                    }
                    $this->productPartnersScheduledForDeletion = null;
                }
            }

            if ($this->collProductPartners !== null) {
                foreach ($this->collProductPartners as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    \UserQuery::create()
                        ->filterByPrimaryKeys($this->usersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usersScheduledForDeletion = null;
                }
            }

            if ($this->collUsers !== null) {
                foreach ($this->collUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->proformaInvoicesScheduledForDeletion !== null) {
                if (!$this->proformaInvoicesScheduledForDeletion->isEmpty()) {
                    \ProformaInvoiceQuery::create()
                        ->filterByPrimaryKeys($this->proformaInvoicesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->proformaInvoicesScheduledForDeletion = null;
                }
            }

            if ($this->collProformaInvoices !== null) {
                foreach ($this->collProformaInvoices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->packingListsScheduledForDeletion !== null) {
                if (!$this->packingListsScheduledForDeletion->isEmpty()) {
                    \PackingListQuery::create()
                        ->filterByPrimaryKeys($this->packingListsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->packingListsScheduledForDeletion = null;
                }
            }

            if ($this->collPackingLists !== null) {
                foreach ($this->collPackingLists as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->purchaseOrdersScheduledForDeletion !== null) {
                if (!$this->purchaseOrdersScheduledForDeletion->isEmpty()) {
                    \PurchaseOrderQuery::create()
                        ->filterByPrimaryKeys($this->purchaseOrdersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->partnerBanksScheduledForDeletion !== null) {
                if (!$this->partnerBanksScheduledForDeletion->isEmpty()) {
                    \PartnerBankQuery::create()
                        ->filterByPrimaryKeys($this->partnerBanksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->partnerBanksScheduledForDeletion = null;
                }
            }

            if ($this->collPartnerBanks !== null) {
                foreach ($this->collPartnerBanks as $referrerFK) {
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

        $this->modifiedColumns[PartnerTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PartnerTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PartnerTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_WEBSITE)) {
            $modifiedColumns[':p' . $index++]  = 'website';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_FAX)) {
            $modifiedColumns[':p' . $index++]  = 'fax';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'image';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_TAX_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'tax_number';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_COMPANY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'company_id';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_CLASS_KEY)) {
            $modifiedColumns[':p' . $index++]  = 'class_key';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PartnerTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO partner (%s) VALUES (%s)',
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
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'website':
                        $stmt->bindValue($identifier, $this->website, PDO::PARAM_STR);
                        break;
                    case 'fax':
                        $stmt->bindValue($identifier, $this->fax, PDO::PARAM_STR);
                        break;
                    case 'image':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case 'tax_number':
                        $stmt->bindValue($identifier, $this->tax_number, PDO::PARAM_STR);
                        break;
                    case 'company_id':
                        $stmt->bindValue($identifier, $this->company_id, PDO::PARAM_INT);
                        break;
                    case 'class_key':
                        $stmt->bindValue($identifier, $this->class_key, PDO::PARAM_INT);
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
        $pos = PartnerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEmail();
                break;
            case 3:
                return $this->getAddress();
                break;
            case 4:
                return $this->getPhone();
                break;
            case 5:
                return $this->getWebsite();
                break;
            case 6:
                return $this->getFax();
                break;
            case 7:
                return $this->getImage();
                break;
            case 8:
                return $this->getTaxNumber();
                break;
            case 9:
                return $this->getCompanyId();
                break;
            case 10:
                return $this->getClassKey();
                break;
            case 11:
                return $this->getCreatedAt();
                break;
            case 12:
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

        if (isset($alreadyDumpedObjects['Partner'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Partner'][$this->hashCode()] = true;
        $keys = PartnerTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getAddress(),
            $keys[4] => $this->getPhone(),
            $keys[5] => $this->getWebsite(),
            $keys[6] => $this->getFax(),
            $keys[7] => $this->getImage(),
            $keys[8] => $this->getTaxNumber(),
            $keys[9] => $this->getCompanyId(),
            $keys[10] => $this->getClassKey(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getUpdatedAt(),
        );
        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCompany) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partner';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partner';
                        break;
                    default:
                        $key = 'Company';
                }

                $result[$key] = $this->aCompany->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPartnersRelatedById) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partners';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partners';
                        break;
                    default:
                        $key = 'Partners';
                }

                $result[$key] = $this->collPartnersRelatedById->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductPartners) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productPartners';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_partners';
                        break;
                    default:
                        $key = 'ProductPartners';
                }

                $result[$key] = $this->collProductPartners->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->collUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProformaInvoices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'proformaInvoices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'proforma_invoices';
                        break;
                    default:
                        $key = 'ProformaInvoices';
                }

                $result[$key] = $this->collProformaInvoices->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPackingLists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'packingLists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'packing_lists';
                        break;
                    default:
                        $key = 'PackingLists';
                }

                $result[$key] = $this->collPackingLists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collPartnerBanks) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partnerBanks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partner_banks';
                        break;
                    default:
                        $key = 'PartnerBanks';
                }

                $result[$key] = $this->collPartnerBanks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Partner
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PartnerTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Partner
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
                $this->setEmail($value);
                break;
            case 3:
                $this->setAddress($value);
                break;
            case 4:
                $this->setPhone($value);
                break;
            case 5:
                $this->setWebsite($value);
                break;
            case 6:
                $this->setFax($value);
                break;
            case 7:
                $this->setImage($value);
                break;
            case 8:
                $this->setTaxNumber($value);
                break;
            case 9:
                $this->setCompanyId($value);
                break;
            case 10:
                $this->setClassKey($value);
                break;
            case 11:
                $this->setCreatedAt($value);
                break;
            case 12:
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
        $keys = PartnerTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAddress($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPhone($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setWebsite($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setFax($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setImage($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setTaxNumber($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCompanyId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setClassKey($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCreatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUpdatedAt($arr[$keys[12]]);
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
     * @return $this|\Partner The current object, for fluid interface
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
        $criteria = new Criteria(PartnerTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PartnerTableMap::COL_ID)) {
            $criteria->add(PartnerTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_NAME)) {
            $criteria->add(PartnerTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_EMAIL)) {
            $criteria->add(PartnerTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_ADDRESS)) {
            $criteria->add(PartnerTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_PHONE)) {
            $criteria->add(PartnerTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_WEBSITE)) {
            $criteria->add(PartnerTableMap::COL_WEBSITE, $this->website);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_FAX)) {
            $criteria->add(PartnerTableMap::COL_FAX, $this->fax);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_IMAGE)) {
            $criteria->add(PartnerTableMap::COL_IMAGE, $this->image);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_TAX_NUMBER)) {
            $criteria->add(PartnerTableMap::COL_TAX_NUMBER, $this->tax_number);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_COMPANY_ID)) {
            $criteria->add(PartnerTableMap::COL_COMPANY_ID, $this->company_id);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_CLASS_KEY)) {
            $criteria->add(PartnerTableMap::COL_CLASS_KEY, $this->class_key);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_CREATED_AT)) {
            $criteria->add(PartnerTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PartnerTableMap::COL_UPDATED_AT)) {
            $criteria->add(PartnerTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildPartnerQuery::create();
        $criteria->add(PartnerTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Partner (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setWebsite($this->getWebsite());
        $copyObj->setFax($this->getFax());
        $copyObj->setImage($this->getImage());
        $copyObj->setTaxNumber($this->getTaxNumber());
        $copyObj->setCompanyId($this->getCompanyId());
        $copyObj->setClassKey($this->getClassKey());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPartnersRelatedById() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnerRelatedById($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductPartners() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductPartner($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProformaInvoices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProformaInvoice($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPackingLists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPackingList($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPurchaseOrders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchaseOrder($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getComponentPartners() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComponentPartner($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPartnerBanks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartnerBank($relObj->copy($deepCopy));
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
     * @return \Partner Clone of current object.
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
     * @return $this|\Partner The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCompany(ChildPartner $v = null)
    {
        if ($v === null) {
            $this->setCompanyId(NULL);
        } else {
            $this->setCompanyId($v->getId());
        }

        $this->aCompany = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPartner object, it will not be re-added.
        if ($v !== null) {
            $v->addPartnerRelatedById($this);
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
    public function getCompany(ConnectionInterface $con = null)
    {
        if ($this->aCompany === null && ($this->company_id != 0)) {
            $this->aCompany = ChildPartnerQuery::create()->findPk($this->company_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompany->addPartnersRelatedById($this);
             */
        }

        return $this->aCompany;
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
        if ('PartnerRelatedById' == $relationName) {
            $this->initPartnersRelatedById();
            return;
        }
        if ('ProductPartner' == $relationName) {
            $this->initProductPartners();
            return;
        }
        if ('User' == $relationName) {
            $this->initUsers();
            return;
        }
        if ('ProformaInvoice' == $relationName) {
            $this->initProformaInvoices();
            return;
        }
        if ('PackingList' == $relationName) {
            $this->initPackingLists();
            return;
        }
        if ('PurchaseOrder' == $relationName) {
            $this->initPurchaseOrders();
            return;
        }
        if ('ComponentPartner' == $relationName) {
            $this->initComponentPartners();
            return;
        }
        if ('PartnerBank' == $relationName) {
            $this->initPartnerBanks();
            return;
        }
    }

    /**
     * Clears out the collPartnersRelatedById collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnersRelatedById()
     */
    public function clearPartnersRelatedById()
    {
        $this->collPartnersRelatedById = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnersRelatedById collection loaded partially.
     */
    public function resetPartialPartnersRelatedById($v = true)
    {
        $this->collPartnersRelatedByIdPartial = $v;
    }

    /**
     * Initializes the collPartnersRelatedById collection.
     *
     * By default this just sets the collPartnersRelatedById collection to an empty array (like clearcollPartnersRelatedById());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnersRelatedById($overrideExisting = true)
    {
        if (null !== $this->collPartnersRelatedById && !$overrideExisting) {
            return;
        }

        $collectionClassName = PartnerTableMap::getTableMap()->getCollectionClassName();

        $this->collPartnersRelatedById = new $collectionClassName;
        $this->collPartnersRelatedById->setModel('\Partner');
    }

    /**
     * Gets an array of ChildPartner objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartner[] List of ChildPartner objects
     * @throws PropelException
     */
    public function getPartnersRelatedById(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnersRelatedByIdPartial && !$this->isNew();
        if (null === $this->collPartnersRelatedById || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnersRelatedById) {
                // return empty collection
                $this->initPartnersRelatedById();
            } else {
                $collPartnersRelatedById = ChildPartnerQuery::create(null, $criteria)
                    ->filterByCompany($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnersRelatedByIdPartial && count($collPartnersRelatedById)) {
                        $this->initPartnersRelatedById(false);

                        foreach ($collPartnersRelatedById as $obj) {
                            if (false == $this->collPartnersRelatedById->contains($obj)) {
                                $this->collPartnersRelatedById->append($obj);
                            }
                        }

                        $this->collPartnersRelatedByIdPartial = true;
                    }

                    return $collPartnersRelatedById;
                }

                if ($partial && $this->collPartnersRelatedById) {
                    foreach ($this->collPartnersRelatedById as $obj) {
                        if ($obj->isNew()) {
                            $collPartnersRelatedById[] = $obj;
                        }
                    }
                }

                $this->collPartnersRelatedById = $collPartnersRelatedById;
                $this->collPartnersRelatedByIdPartial = false;
            }
        }

        return $this->collPartnersRelatedById;
    }

    /**
     * Sets a collection of ChildPartner objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnersRelatedById A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setPartnersRelatedById(Collection $partnersRelatedById, ConnectionInterface $con = null)
    {
        /** @var ChildPartner[] $partnersRelatedByIdToDelete */
        $partnersRelatedByIdToDelete = $this->getPartnersRelatedById(new Criteria(), $con)->diff($partnersRelatedById);


        $this->partnersRelatedByIdScheduledForDeletion = $partnersRelatedByIdToDelete;

        foreach ($partnersRelatedByIdToDelete as $partnerRelatedByIdRemoved) {
            $partnerRelatedByIdRemoved->setCompany(null);
        }

        $this->collPartnersRelatedById = null;
        foreach ($partnersRelatedById as $partnerRelatedById) {
            $this->addPartnerRelatedById($partnerRelatedById);
        }

        $this->collPartnersRelatedById = $partnersRelatedById;
        $this->collPartnersRelatedByIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Partner objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Partner objects.
     * @throws PropelException
     */
    public function countPartnersRelatedById(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnersRelatedByIdPartial && !$this->isNew();
        if (null === $this->collPartnersRelatedById || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnersRelatedById) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnersRelatedById());
            }

            $query = ChildPartnerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCompany($this)
                ->count($con);
        }

        return count($this->collPartnersRelatedById);
    }

    /**
     * Method called to associate a ChildPartner object to this object
     * through the ChildPartner foreign key attribute.
     *
     * @param  ChildPartner $l ChildPartner
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function addPartnerRelatedById(ChildPartner $l)
    {
        if ($this->collPartnersRelatedById === null) {
            $this->initPartnersRelatedById();
            $this->collPartnersRelatedByIdPartial = true;
        }

        if (!$this->collPartnersRelatedById->contains($l)) {
            $this->doAddPartnerRelatedById($l);

            if ($this->partnersRelatedByIdScheduledForDeletion and $this->partnersRelatedByIdScheduledForDeletion->contains($l)) {
                $this->partnersRelatedByIdScheduledForDeletion->remove($this->partnersRelatedByIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPartner $partnerRelatedById The ChildPartner object to add.
     */
    protected function doAddPartnerRelatedById(ChildPartner $partnerRelatedById)
    {
        $this->collPartnersRelatedById[]= $partnerRelatedById;
        $partnerRelatedById->setCompany($this);
    }

    /**
     * @param  ChildPartner $partnerRelatedById The ChildPartner object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function removePartnerRelatedById(ChildPartner $partnerRelatedById)
    {
        if ($this->getPartnersRelatedById()->contains($partnerRelatedById)) {
            $pos = $this->collPartnersRelatedById->search($partnerRelatedById);
            $this->collPartnersRelatedById->remove($pos);
            if (null === $this->partnersRelatedByIdScheduledForDeletion) {
                $this->partnersRelatedByIdScheduledForDeletion = clone $this->collPartnersRelatedById;
                $this->partnersRelatedByIdScheduledForDeletion->clear();
            }
            $this->partnersRelatedByIdScheduledForDeletion[]= $partnerRelatedById;
            $partnerRelatedById->setCompany(null);
        }

        return $this;
    }

    /**
     * Clears out the collProductPartners collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductPartners()
     */
    public function clearProductPartners()
    {
        $this->collProductPartners = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductPartners collection loaded partially.
     */
    public function resetPartialProductPartners($v = true)
    {
        $this->collProductPartnersPartial = $v;
    }

    /**
     * Initializes the collProductPartners collection.
     *
     * By default this just sets the collProductPartners collection to an empty array (like clearcollProductPartners());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductPartners($overrideExisting = true)
    {
        if (null !== $this->collProductPartners && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductPartnerTableMap::getTableMap()->getCollectionClassName();

        $this->collProductPartners = new $collectionClassName;
        $this->collProductPartners->setModel('\ProductPartner');
    }

    /**
     * Gets an array of ChildProductPartner objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductPartner[] List of ChildProductPartner objects
     * @throws PropelException
     */
    public function getProductPartners(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductPartnersPartial && !$this->isNew();
        if (null === $this->collProductPartners || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductPartners) {
                // return empty collection
                $this->initProductPartners();
            } else {
                $collProductPartners = ChildProductPartnerQuery::create(null, $criteria)
                    ->filterByPartner($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductPartnersPartial && count($collProductPartners)) {
                        $this->initProductPartners(false);

                        foreach ($collProductPartners as $obj) {
                            if (false == $this->collProductPartners->contains($obj)) {
                                $this->collProductPartners->append($obj);
                            }
                        }

                        $this->collProductPartnersPartial = true;
                    }

                    return $collProductPartners;
                }

                if ($partial && $this->collProductPartners) {
                    foreach ($this->collProductPartners as $obj) {
                        if ($obj->isNew()) {
                            $collProductPartners[] = $obj;
                        }
                    }
                }

                $this->collProductPartners = $collProductPartners;
                $this->collProductPartnersPartial = false;
            }
        }

        return $this->collProductPartners;
    }

    /**
     * Sets a collection of ChildProductPartner objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productPartners A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setProductPartners(Collection $productPartners, ConnectionInterface $con = null)
    {
        /** @var ChildProductPartner[] $productPartnersToDelete */
        $productPartnersToDelete = $this->getProductPartners(new Criteria(), $con)->diff($productPartners);


        $this->productPartnersScheduledForDeletion = $productPartnersToDelete;

        foreach ($productPartnersToDelete as $productPartnerRemoved) {
            $productPartnerRemoved->setPartner(null);
        }

        $this->collProductPartners = null;
        foreach ($productPartners as $productPartner) {
            $this->addProductPartner($productPartner);
        }

        $this->collProductPartners = $productPartners;
        $this->collProductPartnersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductPartner objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductPartner objects.
     * @throws PropelException
     */
    public function countProductPartners(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductPartnersPartial && !$this->isNew();
        if (null === $this->collProductPartners || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductPartners) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductPartners());
            }

            $query = ChildProductPartnerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPartner($this)
                ->count($con);
        }

        return count($this->collProductPartners);
    }

    /**
     * Method called to associate a ChildProductPartner object to this object
     * through the ChildProductPartner foreign key attribute.
     *
     * @param  ChildProductPartner $l ChildProductPartner
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function addProductPartner(ChildProductPartner $l)
    {
        if ($this->collProductPartners === null) {
            $this->initProductPartners();
            $this->collProductPartnersPartial = true;
        }

        if (!$this->collProductPartners->contains($l)) {
            $this->doAddProductPartner($l);

            if ($this->productPartnersScheduledForDeletion and $this->productPartnersScheduledForDeletion->contains($l)) {
                $this->productPartnersScheduledForDeletion->remove($this->productPartnersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductPartner $productPartner The ChildProductPartner object to add.
     */
    protected function doAddProductPartner(ChildProductPartner $productPartner)
    {
        $this->collProductPartners[]= $productPartner;
        $productPartner->setPartner($this);
    }

    /**
     * @param  ChildProductPartner $productPartner The ChildProductPartner object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function removeProductPartner(ChildProductPartner $productPartner)
    {
        if ($this->getProductPartners()->contains($productPartner)) {
            $pos = $this->collProductPartners->search($productPartner);
            $this->collProductPartners->remove($pos);
            if (null === $this->productPartnersScheduledForDeletion) {
                $this->productPartnersScheduledForDeletion = clone $this->collProductPartners;
                $this->productPartnersScheduledForDeletion->clear();
            }
            $this->productPartnersScheduledForDeletion[]= $productPartner;
            $productPartner->setPartner(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Partner is new, it will return
     * an empty collection; or if this Partner has previously
     * been saved, it will retrieve related ProductPartners from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Partner.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductPartner[] List of ChildProductPartner objects
     */
    public function getProductPartnersJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductPartnerQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getProductPartners($query, $con);
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsers collection loaded partially.
     */
    public function resetPartialUsers($v = true)
    {
        $this->collUsersPartial = $v;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty array (like clearcollUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsers($overrideExisting = true)
    {
        if (null !== $this->collUsers && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserTableMap::getTableMap()->getCollectionClassName();

        $this->collUsers = new $collectionClassName;
        $this->collUsers->setModel('\User');
    }

    /**
     * Gets an array of ChildUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUser[] List of ChildUser objects
     * @throws PropelException
     */
    public function getUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = ChildUserQuery::create(null, $criteria)
                    ->filterByPartner($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsersPartial && count($collUsers)) {
                        $this->initUsers(false);

                        foreach ($collUsers as $obj) {
                            if (false == $this->collUsers->contains($obj)) {
                                $this->collUsers->append($obj);
                            }
                        }

                        $this->collUsersPartial = true;
                    }

                    return $collUsers;
                }

                if ($partial && $this->collUsers) {
                    foreach ($this->collUsers as $obj) {
                        if ($obj->isNew()) {
                            $collUsers[] = $obj;
                        }
                    }
                }

                $this->collUsers = $collUsers;
                $this->collUsersPartial = false;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of ChildUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $users A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setUsers(Collection $users, ConnectionInterface $con = null)
    {
        /** @var ChildUser[] $usersToDelete */
        $usersToDelete = $this->getUsers(new Criteria(), $con)->diff($users);


        $this->usersScheduledForDeletion = $usersToDelete;

        foreach ($usersToDelete as $userRemoved) {
            $userRemoved->setPartner(null);
        }

        $this->collUsers = null;
        foreach ($users as $user) {
            $this->addUser($user);
        }

        $this->collUsers = $users;
        $this->collUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsersPartial && !$this->isNew();
        if (null === $this->collUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsers());
            }

            $query = ChildUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPartner($this)
                ->count($con);
        }

        return count($this->collUsers);
    }

    /**
     * Method called to associate a ChildUser object to this object
     * through the ChildUser foreign key attribute.
     *
     * @param  ChildUser $l ChildUser
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function addUser(ChildUser $l)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
            $this->collUsersPartial = true;
        }

        if (!$this->collUsers->contains($l)) {
            $this->doAddUser($l);

            if ($this->usersScheduledForDeletion and $this->usersScheduledForDeletion->contains($l)) {
                $this->usersScheduledForDeletion->remove($this->usersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUser $user The ChildUser object to add.
     */
    protected function doAddUser(ChildUser $user)
    {
        $this->collUsers[]= $user;
        $user->setPartner($this);
    }

    /**
     * @param  ChildUser $user The ChildUser object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function removeUser(ChildUser $user)
    {
        if ($this->getUsers()->contains($user)) {
            $pos = $this->collUsers->search($user);
            $this->collUsers->remove($pos);
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= clone $user;
            $user->setPartner(null);
        }

        return $this;
    }

    /**
     * Clears out the collProformaInvoices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProformaInvoices()
     */
    public function clearProformaInvoices()
    {
        $this->collProformaInvoices = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProformaInvoices collection loaded partially.
     */
    public function resetPartialProformaInvoices($v = true)
    {
        $this->collProformaInvoicesPartial = $v;
    }

    /**
     * Initializes the collProformaInvoices collection.
     *
     * By default this just sets the collProformaInvoices collection to an empty array (like clearcollProformaInvoices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProformaInvoices($overrideExisting = true)
    {
        if (null !== $this->collProformaInvoices && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProformaInvoiceTableMap::getTableMap()->getCollectionClassName();

        $this->collProformaInvoices = new $collectionClassName;
        $this->collProformaInvoices->setModel('\ProformaInvoice');
    }

    /**
     * Gets an array of ChildProformaInvoice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProformaInvoice[] List of ChildProformaInvoice objects
     * @throws PropelException
     */
    public function getProformaInvoices(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProformaInvoicesPartial && !$this->isNew();
        if (null === $this->collProformaInvoices || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProformaInvoices) {
                // return empty collection
                $this->initProformaInvoices();
            } else {
                $collProformaInvoices = ChildProformaInvoiceQuery::create(null, $criteria)
                    ->filterByPartner($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProformaInvoicesPartial && count($collProformaInvoices)) {
                        $this->initProformaInvoices(false);

                        foreach ($collProformaInvoices as $obj) {
                            if (false == $this->collProformaInvoices->contains($obj)) {
                                $this->collProformaInvoices->append($obj);
                            }
                        }

                        $this->collProformaInvoicesPartial = true;
                    }

                    return $collProformaInvoices;
                }

                if ($partial && $this->collProformaInvoices) {
                    foreach ($this->collProformaInvoices as $obj) {
                        if ($obj->isNew()) {
                            $collProformaInvoices[] = $obj;
                        }
                    }
                }

                $this->collProformaInvoices = $collProformaInvoices;
                $this->collProformaInvoicesPartial = false;
            }
        }

        return $this->collProformaInvoices;
    }

    /**
     * Sets a collection of ChildProformaInvoice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $proformaInvoices A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setProformaInvoices(Collection $proformaInvoices, ConnectionInterface $con = null)
    {
        /** @var ChildProformaInvoice[] $proformaInvoicesToDelete */
        $proformaInvoicesToDelete = $this->getProformaInvoices(new Criteria(), $con)->diff($proformaInvoices);


        $this->proformaInvoicesScheduledForDeletion = $proformaInvoicesToDelete;

        foreach ($proformaInvoicesToDelete as $proformaInvoiceRemoved) {
            $proformaInvoiceRemoved->setPartner(null);
        }

        $this->collProformaInvoices = null;
        foreach ($proformaInvoices as $proformaInvoice) {
            $this->addProformaInvoice($proformaInvoice);
        }

        $this->collProformaInvoices = $proformaInvoices;
        $this->collProformaInvoicesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProformaInvoice objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProformaInvoice objects.
     * @throws PropelException
     */
    public function countProformaInvoices(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProformaInvoicesPartial && !$this->isNew();
        if (null === $this->collProformaInvoices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProformaInvoices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProformaInvoices());
            }

            $query = ChildProformaInvoiceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPartner($this)
                ->count($con);
        }

        return count($this->collProformaInvoices);
    }

    /**
     * Method called to associate a ChildProformaInvoice object to this object
     * through the ChildProformaInvoice foreign key attribute.
     *
     * @param  ChildProformaInvoice $l ChildProformaInvoice
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function addProformaInvoice(ChildProformaInvoice $l)
    {
        if ($this->collProformaInvoices === null) {
            $this->initProformaInvoices();
            $this->collProformaInvoicesPartial = true;
        }

        if (!$this->collProformaInvoices->contains($l)) {
            $this->doAddProformaInvoice($l);

            if ($this->proformaInvoicesScheduledForDeletion and $this->proformaInvoicesScheduledForDeletion->contains($l)) {
                $this->proformaInvoicesScheduledForDeletion->remove($this->proformaInvoicesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProformaInvoice $proformaInvoice The ChildProformaInvoice object to add.
     */
    protected function doAddProformaInvoice(ChildProformaInvoice $proformaInvoice)
    {
        $this->collProformaInvoices[]= $proformaInvoice;
        $proformaInvoice->setPartner($this);
    }

    /**
     * @param  ChildProformaInvoice $proformaInvoice The ChildProformaInvoice object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function removeProformaInvoice(ChildProformaInvoice $proformaInvoice)
    {
        if ($this->getProformaInvoices()->contains($proformaInvoice)) {
            $pos = $this->collProformaInvoices->search($proformaInvoice);
            $this->collProformaInvoices->remove($pos);
            if (null === $this->proformaInvoicesScheduledForDeletion) {
                $this->proformaInvoicesScheduledForDeletion = clone $this->collProformaInvoices;
                $this->proformaInvoicesScheduledForDeletion->clear();
            }
            $this->proformaInvoicesScheduledForDeletion[]= clone $proformaInvoice;
            $proformaInvoice->setPartner(null);
        }

        return $this;
    }

    /**
     * Clears out the collPackingLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPackingLists()
     */
    public function clearPackingLists()
    {
        $this->collPackingLists = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPackingLists collection loaded partially.
     */
    public function resetPartialPackingLists($v = true)
    {
        $this->collPackingListsPartial = $v;
    }

    /**
     * Initializes the collPackingLists collection.
     *
     * By default this just sets the collPackingLists collection to an empty array (like clearcollPackingLists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPackingLists($overrideExisting = true)
    {
        if (null !== $this->collPackingLists && !$overrideExisting) {
            return;
        }

        $collectionClassName = PackingListTableMap::getTableMap()->getCollectionClassName();

        $this->collPackingLists = new $collectionClassName;
        $this->collPackingLists->setModel('\PackingList');
    }

    /**
     * Gets an array of ChildPackingList objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPackingList[] List of ChildPackingList objects
     * @throws PropelException
     */
    public function getPackingLists(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPackingListsPartial && !$this->isNew();
        if (null === $this->collPackingLists || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPackingLists) {
                // return empty collection
                $this->initPackingLists();
            } else {
                $collPackingLists = ChildPackingListQuery::create(null, $criteria)
                    ->filterByPartner($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPackingListsPartial && count($collPackingLists)) {
                        $this->initPackingLists(false);

                        foreach ($collPackingLists as $obj) {
                            if (false == $this->collPackingLists->contains($obj)) {
                                $this->collPackingLists->append($obj);
                            }
                        }

                        $this->collPackingListsPartial = true;
                    }

                    return $collPackingLists;
                }

                if ($partial && $this->collPackingLists) {
                    foreach ($this->collPackingLists as $obj) {
                        if ($obj->isNew()) {
                            $collPackingLists[] = $obj;
                        }
                    }
                }

                $this->collPackingLists = $collPackingLists;
                $this->collPackingListsPartial = false;
            }
        }

        return $this->collPackingLists;
    }

    /**
     * Sets a collection of ChildPackingList objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $packingLists A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setPackingLists(Collection $packingLists, ConnectionInterface $con = null)
    {
        /** @var ChildPackingList[] $packingListsToDelete */
        $packingListsToDelete = $this->getPackingLists(new Criteria(), $con)->diff($packingLists);


        $this->packingListsScheduledForDeletion = $packingListsToDelete;

        foreach ($packingListsToDelete as $packingListRemoved) {
            $packingListRemoved->setPartner(null);
        }

        $this->collPackingLists = null;
        foreach ($packingLists as $packingList) {
            $this->addPackingList($packingList);
        }

        $this->collPackingLists = $packingLists;
        $this->collPackingListsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PackingList objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PackingList objects.
     * @throws PropelException
     */
    public function countPackingLists(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPackingListsPartial && !$this->isNew();
        if (null === $this->collPackingLists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPackingLists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPackingLists());
            }

            $query = ChildPackingListQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPartner($this)
                ->count($con);
        }

        return count($this->collPackingLists);
    }

    /**
     * Method called to associate a ChildPackingList object to this object
     * through the ChildPackingList foreign key attribute.
     *
     * @param  ChildPackingList $l ChildPackingList
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function addPackingList(ChildPackingList $l)
    {
        if ($this->collPackingLists === null) {
            $this->initPackingLists();
            $this->collPackingListsPartial = true;
        }

        if (!$this->collPackingLists->contains($l)) {
            $this->doAddPackingList($l);

            if ($this->packingListsScheduledForDeletion and $this->packingListsScheduledForDeletion->contains($l)) {
                $this->packingListsScheduledForDeletion->remove($this->packingListsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPackingList $packingList The ChildPackingList object to add.
     */
    protected function doAddPackingList(ChildPackingList $packingList)
    {
        $this->collPackingLists[]= $packingList;
        $packingList->setPartner($this);
    }

    /**
     * @param  ChildPackingList $packingList The ChildPackingList object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function removePackingList(ChildPackingList $packingList)
    {
        if ($this->getPackingLists()->contains($packingList)) {
            $pos = $this->collPackingLists->search($packingList);
            $this->collPackingLists->remove($pos);
            if (null === $this->packingListsScheduledForDeletion) {
                $this->packingListsScheduledForDeletion = clone $this->collPackingLists;
                $this->packingListsScheduledForDeletion->clear();
            }
            $this->packingListsScheduledForDeletion[]= clone $packingList;
            $packingList->setPartner(null);
        }

        return $this;
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
     * If this ChildPartner is new, it will return
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
                    ->filterBySupplier($this)
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
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setPurchaseOrders(Collection $purchaseOrders, ConnectionInterface $con = null)
    {
        /** @var ChildPurchaseOrder[] $purchaseOrdersToDelete */
        $purchaseOrdersToDelete = $this->getPurchaseOrders(new Criteria(), $con)->diff($purchaseOrders);


        $this->purchaseOrdersScheduledForDeletion = $purchaseOrdersToDelete;

        foreach ($purchaseOrdersToDelete as $purchaseOrderRemoved) {
            $purchaseOrderRemoved->setSupplier(null);
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
                ->filterBySupplier($this)
                ->count($con);
        }

        return count($this->collPurchaseOrders);
    }

    /**
     * Method called to associate a ChildPurchaseOrder object to this object
     * through the ChildPurchaseOrder foreign key attribute.
     *
     * @param  ChildPurchaseOrder $l ChildPurchaseOrder
     * @return $this|\Partner The current object (for fluent API support)
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
        $purchaseOrder->setSupplier($this);
    }

    /**
     * @param  ChildPurchaseOrder $purchaseOrder The ChildPurchaseOrder object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
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
            $this->purchaseOrdersScheduledForDeletion[]= clone $purchaseOrder;
            $purchaseOrder->setSupplier(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Partner is new, it will return
     * an empty collection; or if this Partner has previously
     * been saved, it will retrieve related PurchaseOrders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Partner.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrder[] List of ChildPurchaseOrder objects
     */
    public function getPurchaseOrdersJoinProformaInvoice(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderQuery::create(null, $criteria);
        $query->joinWith('ProformaInvoice', $joinBehavior);

        return $this->getPurchaseOrders($query, $con);
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
     * If this ChildPartner is new, it will return
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
                    ->filterByPartner($this)
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
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setComponentPartners(Collection $componentPartners, ConnectionInterface $con = null)
    {
        /** @var ChildComponentPartner[] $componentPartnersToDelete */
        $componentPartnersToDelete = $this->getComponentPartners(new Criteria(), $con)->diff($componentPartners);


        $this->componentPartnersScheduledForDeletion = $componentPartnersToDelete;

        foreach ($componentPartnersToDelete as $componentPartnerRemoved) {
            $componentPartnerRemoved->setPartner(null);
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
                ->filterByPartner($this)
                ->count($con);
        }

        return count($this->collComponentPartners);
    }

    /**
     * Method called to associate a ChildComponentPartner object to this object
     * through the ChildComponentPartner foreign key attribute.
     *
     * @param  ChildComponentPartner $l ChildComponentPartner
     * @return $this|\Partner The current object (for fluent API support)
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
        $componentPartner->setPartner($this);
    }

    /**
     * @param  ChildComponentPartner $componentPartner The ChildComponentPartner object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
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
            $componentPartner->setPartner(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Partner is new, it will return
     * an empty collection; or if this Partner has previously
     * been saved, it will retrieve related ComponentPartners from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Partner.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildComponentPartner[] List of ChildComponentPartner objects
     */
    public function getComponentPartnersJoinComponent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildComponentPartnerQuery::create(null, $criteria);
        $query->joinWith('Component', $joinBehavior);

        return $this->getComponentPartners($query, $con);
    }

    /**
     * Clears out the collPartnerBanks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartnerBanks()
     */
    public function clearPartnerBanks()
    {
        $this->collPartnerBanks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartnerBanks collection loaded partially.
     */
    public function resetPartialPartnerBanks($v = true)
    {
        $this->collPartnerBanksPartial = $v;
    }

    /**
     * Initializes the collPartnerBanks collection.
     *
     * By default this just sets the collPartnerBanks collection to an empty array (like clearcollPartnerBanks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartnerBanks($overrideExisting = true)
    {
        if (null !== $this->collPartnerBanks && !$overrideExisting) {
            return;
        }

        $collectionClassName = PartnerBankTableMap::getTableMap()->getCollectionClassName();

        $this->collPartnerBanks = new $collectionClassName;
        $this->collPartnerBanks->setModel('\PartnerBank');
    }

    /**
     * Gets an array of ChildPartnerBank objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPartner is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartnerBank[] List of ChildPartnerBank objects
     * @throws PropelException
     */
    public function getPartnerBanks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnerBanksPartial && !$this->isNew();
        if (null === $this->collPartnerBanks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartnerBanks) {
                // return empty collection
                $this->initPartnerBanks();
            } else {
                $collPartnerBanks = ChildPartnerBankQuery::create(null, $criteria)
                    ->filterByPartner($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartnerBanksPartial && count($collPartnerBanks)) {
                        $this->initPartnerBanks(false);

                        foreach ($collPartnerBanks as $obj) {
                            if (false == $this->collPartnerBanks->contains($obj)) {
                                $this->collPartnerBanks->append($obj);
                            }
                        }

                        $this->collPartnerBanksPartial = true;
                    }

                    return $collPartnerBanks;
                }

                if ($partial && $this->collPartnerBanks) {
                    foreach ($this->collPartnerBanks as $obj) {
                        if ($obj->isNew()) {
                            $collPartnerBanks[] = $obj;
                        }
                    }
                }

                $this->collPartnerBanks = $collPartnerBanks;
                $this->collPartnerBanksPartial = false;
            }
        }

        return $this->collPartnerBanks;
    }

    /**
     * Sets a collection of ChildPartnerBank objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partnerBanks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function setPartnerBanks(Collection $partnerBanks, ConnectionInterface $con = null)
    {
        /** @var ChildPartnerBank[] $partnerBanksToDelete */
        $partnerBanksToDelete = $this->getPartnerBanks(new Criteria(), $con)->diff($partnerBanks);


        $this->partnerBanksScheduledForDeletion = $partnerBanksToDelete;

        foreach ($partnerBanksToDelete as $partnerBankRemoved) {
            $partnerBankRemoved->setPartner(null);
        }

        $this->collPartnerBanks = null;
        foreach ($partnerBanks as $partnerBank) {
            $this->addPartnerBank($partnerBank);
        }

        $this->collPartnerBanks = $partnerBanks;
        $this->collPartnerBanksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PartnerBank objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PartnerBank objects.
     * @throws PropelException
     */
    public function countPartnerBanks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartnerBanksPartial && !$this->isNew();
        if (null === $this->collPartnerBanks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartnerBanks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartnerBanks());
            }

            $query = ChildPartnerBankQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPartner($this)
                ->count($con);
        }

        return count($this->collPartnerBanks);
    }

    /**
     * Method called to associate a ChildPartnerBank object to this object
     * through the ChildPartnerBank foreign key attribute.
     *
     * @param  ChildPartnerBank $l ChildPartnerBank
     * @return $this|\Partner The current object (for fluent API support)
     */
    public function addPartnerBank(ChildPartnerBank $l)
    {
        if ($this->collPartnerBanks === null) {
            $this->initPartnerBanks();
            $this->collPartnerBanksPartial = true;
        }

        if (!$this->collPartnerBanks->contains($l)) {
            $this->doAddPartnerBank($l);

            if ($this->partnerBanksScheduledForDeletion and $this->partnerBanksScheduledForDeletion->contains($l)) {
                $this->partnerBanksScheduledForDeletion->remove($this->partnerBanksScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPartnerBank $partnerBank The ChildPartnerBank object to add.
     */
    protected function doAddPartnerBank(ChildPartnerBank $partnerBank)
    {
        $this->collPartnerBanks[]= $partnerBank;
        $partnerBank->setPartner($this);
    }

    /**
     * @param  ChildPartnerBank $partnerBank The ChildPartnerBank object to remove.
     * @return $this|ChildPartner The current object (for fluent API support)
     */
    public function removePartnerBank(ChildPartnerBank $partnerBank)
    {
        if ($this->getPartnerBanks()->contains($partnerBank)) {
            $pos = $this->collPartnerBanks->search($partnerBank);
            $this->collPartnerBanks->remove($pos);
            if (null === $this->partnerBanksScheduledForDeletion) {
                $this->partnerBanksScheduledForDeletion = clone $this->collPartnerBanks;
                $this->partnerBanksScheduledForDeletion->clear();
            }
            $this->partnerBanksScheduledForDeletion[]= clone $partnerBank;
            $partnerBank->setPartner(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Partner is new, it will return
     * an empty collection; or if this Partner has previously
     * been saved, it will retrieve related PartnerBanks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Partner.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartnerBank[] List of ChildPartnerBank objects
     */
    public function getPartnerBanksJoinBank(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartnerBankQuery::create(null, $criteria);
        $query->joinWith('Bank', $joinBehavior);

        return $this->getPartnerBanks($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCompany) {
            $this->aCompany->removePartnerRelatedById($this);
        }
        $this->id = null;
        $this->name = null;
        $this->email = null;
        $this->address = null;
        $this->phone = null;
        $this->website = null;
        $this->fax = null;
        $this->image = null;
        $this->tax_number = null;
        $this->company_id = null;
        $this->class_key = null;
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
            if ($this->collPartnersRelatedById) {
                foreach ($this->collPartnersRelatedById as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductPartners) {
                foreach ($this->collProductPartners as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProformaInvoices) {
                foreach ($this->collProformaInvoices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPackingLists) {
                foreach ($this->collPackingLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchaseOrders) {
                foreach ($this->collPurchaseOrders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collComponentPartners) {
                foreach ($this->collComponentPartners as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPartnerBanks) {
                foreach ($this->collPartnerBanks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPartnersRelatedById = null;
        $this->collProductPartners = null;
        $this->collUsers = null;
        $this->collProformaInvoices = null;
        $this->collPackingLists = null;
        $this->collPurchaseOrders = null;
        $this->collComponentPartners = null;
        $this->collPartnerBanks = null;
        $this->aCompany = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PartnerTableMap::DEFAULT_STRING_FORMAT);
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
