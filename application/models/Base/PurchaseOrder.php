<?php

namespace Base;

use \Currency as ChildCurrency;
use \CurrencyQuery as ChildCurrencyQuery;
use \DownPayment as ChildDownPayment;
use \DownPaymentQuery as ChildDownPaymentQuery;
use \PackingList as ChildPackingList;
use \PackingListQuery as ChildPackingListQuery;
use \Partner as ChildPartner;
use \PartnerQuery as ChildPartnerQuery;
use \ProformaInvoice as ChildProformaInvoice;
use \ProformaInvoiceQuery as ChildProformaInvoiceQuery;
use \PurchaseOrder as ChildPurchaseOrder;
use \PurchaseOrderLine as ChildPurchaseOrderLine;
use \PurchaseOrderLineQuery as ChildPurchaseOrderLineQuery;
use \PurchaseOrderQuery as ChildPurchaseOrderQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\PurchaseOrderLineTableMap;
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
 * Base class that represents a row from the 'purchase_order' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class PurchaseOrder implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PurchaseOrderTableMap';


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
     * The value for the proforma_invoice_id field.
     *
     * @var        int
     */
    protected $proforma_invoice_id;

    /**
     * The value for the packing_list_id field.
     *
     * @var        int
     */
    protected $packing_list_id;

    /**
     * The value for the supplier_id field.
     *
     * @var        int
     */
    protected $supplier_id;

    /**
     * The value for the currency_id field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $currency_id;

    /**
     * The value for the note field.
     *
     * @var        string
     */
    protected $note;

    /**
     * The value for the date field.
     *
     * @var        DateTime
     */
    protected $date;

    /**
     * The value for the delivery_deadline field.
     *
     * @var        DateTime
     */
    protected $delivery_deadline;

    /**
     * The value for the payment_term field.
     *
     * @var        string
     */
    protected $payment_term;

    /**
     * The value for the down_payment_id field.
     *
     * @var        int
     */
    protected $down_payment_id;

    /**
     * The value for the down_payment_amount field.
     *
     * @var        double
     */
    protected $down_payment_amount;

    /**
     * The value for the down_payment_deadline field.
     *
     * @var        DateTime
     */
    protected $down_payment_deadline;

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
     * The value for the active field.
     *
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

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
     * @var        ChildProformaInvoice
     */
    protected $aProformaInvoice;

    /**
     * @var        ChildPackingList
     */
    protected $aPackingList;

    /**
     * @var        ChildDownPayment
     */
    protected $aDownPayment;

    /**
     * @var        ChildCurrency
     */
    protected $aCurrency;

    /**
     * @var        ChildPartner
     */
    protected $aSupplier;

    /**
     * @var        ObjectCollection|ChildPurchaseOrderLine[] Collection to store aggregation of ChildPurchaseOrderLine objects.
     */
    protected $collPurchaseOrderLines;
    protected $collPurchaseOrderLinesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPurchaseOrderLine[]
     */
    protected $purchaseOrderLinesScheduledForDeletion = null;

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
        $this->active = true;
    }

    /**
     * Initializes internal state of Base\PurchaseOrder object.
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
     * Compares this with another <code>PurchaseOrder</code> instance.  If
     * <code>obj</code> is an instance of <code>PurchaseOrder</code>, delegates to
     * <code>equals(PurchaseOrder)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|PurchaseOrder The current object, for fluid interface
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
     * Get the [proforma_invoice_id] column value.
     *
     * @return int
     */
    public function getProformaInvoiceId()
    {
        return $this->proforma_invoice_id;
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
     * Get the [supplier_id] column value.
     *
     * @return int
     */
    public function getSupplierId()
    {
        return $this->supplier_id;
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
     * Get the [note] column value.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
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
     * Get the [optionally formatted] temporal [delivery_deadline] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDeliveryDeadline($format = NULL)
    {
        if ($format === null) {
            return $this->delivery_deadline;
        } else {
            return $this->delivery_deadline instanceof \DateTimeInterface ? $this->delivery_deadline->format($format) : null;
        }
    }

    /**
     * Get the [payment_term] column value.
     *
     * @return string
     */
    public function getPaymentTerm()
    {
        return $this->payment_term;
    }

    /**
     * Get the [down_payment_id] column value.
     *
     * @return int
     */
    public function getDownPaymentId()
    {
        return $this->down_payment_id;
    }

    /**
     * Get the [down_payment_amount] column value.
     *
     * @return double
     */
    public function getDownPaymentAmount()
    {
        return $this->down_payment_amount;
    }

    /**
     * Get the [optionally formatted] temporal [down_payment_deadline] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDownPaymentDeadline($format = NULL)
    {
        if ($format === null) {
            return $this->down_payment_deadline;
        } else {
            return $this->down_payment_deadline instanceof \DateTimeInterface ? $this->down_payment_deadline->format($format) : null;
        }
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
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [proforma_invoice_id] column.
     *
     * @param int $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setProformaInvoiceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->proforma_invoice_id !== $v) {
            $this->proforma_invoice_id = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID] = true;
        }

        if ($this->aProformaInvoice !== null && $this->aProformaInvoice->getId() !== $v) {
            $this->aProformaInvoice = null;
        }

        return $this;
    } // setProformaInvoiceId()

    /**
     * Set the value of [packing_list_id] column.
     *
     * @param int $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setPackingListId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->packing_list_id !== $v) {
            $this->packing_list_id = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_PACKING_LIST_ID] = true;
        }

        if ($this->aPackingList !== null && $this->aPackingList->getId() !== $v) {
            $this->aPackingList = null;
        }

        return $this;
    } // setPackingListId()

    /**
     * Set the value of [supplier_id] column.
     *
     * @param int $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setSupplierId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->supplier_id !== $v) {
            $this->supplier_id = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_SUPPLIER_ID] = true;
        }

        if ($this->aSupplier !== null && $this->aSupplier->getId() !== $v) {
            $this->aSupplier = null;
        }

        return $this;
    } // setSupplierId()

    /**
     * Set the value of [currency_id] column.
     *
     * @param int $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setCurrencyId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->currency_id !== $v) {
            $this->currency_id = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_CURRENCY_ID] = true;
        }

        if ($this->aCurrency !== null && $this->aCurrency->getId() !== $v) {
            $this->aCurrency = null;
        }

        return $this;
    } // setCurrencyId()

    /**
     * Set the value of [note] column.
     *
     * @param string $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->note !== $v) {
            $this->note = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_NOTE] = true;
        }

        return $this;
    } // setNote()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            if ($this->date === null || $dt === null || $dt->format("Y-m-d") !== $this->date->format("Y-m-d")) {
                $this->date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PurchaseOrderTableMap::COL_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDate()

    /**
     * Sets the value of [delivery_deadline] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setDeliveryDeadline($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->delivery_deadline !== null || $dt !== null) {
            if ($this->delivery_deadline === null || $dt === null || $dt->format("Y-m-d") !== $this->delivery_deadline->format("Y-m-d")) {
                $this->delivery_deadline = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PurchaseOrderTableMap::COL_DELIVERY_DEADLINE] = true;
            }
        } // if either are not null

        return $this;
    } // setDeliveryDeadline()

    /**
     * Set the value of [payment_term] column.
     *
     * @param string $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setPaymentTerm($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payment_term !== $v) {
            $this->payment_term = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_PAYMENT_TERM] = true;
        }

        return $this;
    } // setPaymentTerm()

    /**
     * Set the value of [down_payment_id] column.
     *
     * @param int $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setDownPaymentId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->down_payment_id !== $v) {
            $this->down_payment_id = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID] = true;
        }

        if ($this->aDownPayment !== null && $this->aDownPayment->getId() !== $v) {
            $this->aDownPayment = null;
        }

        return $this;
    } // setDownPaymentId()

    /**
     * Set the value of [down_payment_amount] column.
     *
     * @param double $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setDownPaymentAmount($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->down_payment_amount !== $v) {
            $this->down_payment_amount = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT] = true;
        }

        return $this;
    } // setDownPaymentAmount()

    /**
     * Sets the value of [down_payment_deadline] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setDownPaymentDeadline($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->down_payment_deadline !== null || $dt !== null) {
            if ($this->down_payment_deadline === null || $dt === null || $dt->format("Y-m-d") !== $this->down_payment_deadline->format("Y-m-d")) {
                $this->down_payment_deadline = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE] = true;
            }
        } // if either are not null

        return $this;
    } // setDownPaymentDeadline()

    /**
     * Set the value of [total_price] column.
     *
     * @param double $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setTotalPrice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_price !== $v) {
            $this->total_price = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_TOTAL_PRICE] = true;
        }

        return $this;
    } // setTotalPrice()

    /**
     * Set the value of [state] column.
     *
     * @param string $v new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setState($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->state !== $v) {
            $this->state = $v;
            $this->modifiedColumns[PurchaseOrderTableMap::COL_STATE] = true;
        }

        return $this;
    } // setState()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\PurchaseOrder The current object (for fluent API support)
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
            $this->modifiedColumns[PurchaseOrderTableMap::COL_ACTIVE] = true;
        }

        return $this;
    } // setActive()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PurchaseOrderTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PurchaseOrderTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PurchaseOrderTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PurchaseOrderTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PurchaseOrderTableMap::translateFieldName('ProformaInvoiceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->proforma_invoice_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PurchaseOrderTableMap::translateFieldName('PackingListId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->packing_list_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PurchaseOrderTableMap::translateFieldName('SupplierId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->supplier_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PurchaseOrderTableMap::translateFieldName('CurrencyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->currency_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PurchaseOrderTableMap::translateFieldName('Note', TableMap::TYPE_PHPNAME, $indexType)];
            $this->note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PurchaseOrderTableMap::translateFieldName('Date', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PurchaseOrderTableMap::translateFieldName('DeliveryDeadline', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->delivery_deadline = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : PurchaseOrderTableMap::translateFieldName('PaymentTerm', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_term = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : PurchaseOrderTableMap::translateFieldName('DownPaymentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->down_payment_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : PurchaseOrderTableMap::translateFieldName('DownPaymentAmount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->down_payment_amount = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : PurchaseOrderTableMap::translateFieldName('DownPaymentDeadline', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->down_payment_deadline = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : PurchaseOrderTableMap::translateFieldName('TotalPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_price = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : PurchaseOrderTableMap::translateFieldName('State', TableMap::TYPE_PHPNAME, $indexType)];
            $this->state = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : PurchaseOrderTableMap::translateFieldName('Active', TableMap::TYPE_PHPNAME, $indexType)];
            $this->active = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : PurchaseOrderTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : PurchaseOrderTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = PurchaseOrderTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PurchaseOrder'), 0, $e);
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
        if ($this->aProformaInvoice !== null && $this->proforma_invoice_id !== $this->aProformaInvoice->getId()) {
            $this->aProformaInvoice = null;
        }
        if ($this->aPackingList !== null && $this->packing_list_id !== $this->aPackingList->getId()) {
            $this->aPackingList = null;
        }
        if ($this->aSupplier !== null && $this->supplier_id !== $this->aSupplier->getId()) {
            $this->aSupplier = null;
        }
        if ($this->aCurrency !== null && $this->currency_id !== $this->aCurrency->getId()) {
            $this->aCurrency = null;
        }
        if ($this->aDownPayment !== null && $this->down_payment_id !== $this->aDownPayment->getId()) {
            $this->aDownPayment = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPurchaseOrderQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aProformaInvoice = null;
            $this->aPackingList = null;
            $this->aDownPayment = null;
            $this->aCurrency = null;
            $this->aSupplier = null;
            $this->collPurchaseOrderLines = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see PurchaseOrder::setDeleted()
     * @see PurchaseOrder::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPurchaseOrderQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderTableMap::DATABASE_NAME);
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
                PurchaseOrderTableMap::addInstanceToPool($this);
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

            if ($this->aProformaInvoice !== null) {
                if ($this->aProformaInvoice->isModified() || $this->aProformaInvoice->isNew()) {
                    $affectedRows += $this->aProformaInvoice->save($con);
                }
                $this->setProformaInvoice($this->aProformaInvoice);
            }

            if ($this->aPackingList !== null) {
                if ($this->aPackingList->isModified() || $this->aPackingList->isNew()) {
                    $affectedRows += $this->aPackingList->save($con);
                }
                $this->setPackingList($this->aPackingList);
            }

            if ($this->aDownPayment !== null) {
                if ($this->aDownPayment->isModified() || $this->aDownPayment->isNew()) {
                    $affectedRows += $this->aDownPayment->save($con);
                }
                $this->setDownPayment($this->aDownPayment);
            }

            if ($this->aCurrency !== null) {
                if ($this->aCurrency->isModified() || $this->aCurrency->isNew()) {
                    $affectedRows += $this->aCurrency->save($con);
                }
                $this->setCurrency($this->aCurrency);
            }

            if ($this->aSupplier !== null) {
                if ($this->aSupplier->isModified() || $this->aSupplier->isNew()) {
                    $affectedRows += $this->aSupplier->save($con);
                }
                $this->setSupplier($this->aSupplier);
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

            if ($this->purchaseOrderLinesScheduledForDeletion !== null) {
                if (!$this->purchaseOrderLinesScheduledForDeletion->isEmpty()) {
                    \PurchaseOrderLineQuery::create()
                        ->filterByPrimaryKeys($this->purchaseOrderLinesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

        $this->modifiedColumns[PurchaseOrderTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PurchaseOrderTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'proforma_invoice_id';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_PACKING_LIST_ID)) {
            $modifiedColumns[':p' . $index++]  = 'packing_list_id';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_SUPPLIER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'supplier_id';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_CURRENCY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'currency_id';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'note';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'date';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DELIVERY_DEADLINE)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_deadline';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_PAYMENT_TERM)) {
            $modifiedColumns[':p' . $index++]  = 'payment_term';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'down_payment_id';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'down_payment_amount';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE)) {
            $modifiedColumns[':p' . $index++]  = 'down_payment_deadline';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_TOTAL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'total_price';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_STATE)) {
            $modifiedColumns[':p' . $index++]  = 'state';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'active';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO purchase_order (%s) VALUES (%s)',
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
                    case 'proforma_invoice_id':
                        $stmt->bindValue($identifier, $this->proforma_invoice_id, PDO::PARAM_INT);
                        break;
                    case 'packing_list_id':
                        $stmt->bindValue($identifier, $this->packing_list_id, PDO::PARAM_INT);
                        break;
                    case 'supplier_id':
                        $stmt->bindValue($identifier, $this->supplier_id, PDO::PARAM_INT);
                        break;
                    case 'currency_id':
                        $stmt->bindValue($identifier, $this->currency_id, PDO::PARAM_INT);
                        break;
                    case 'note':
                        $stmt->bindValue($identifier, $this->note, PDO::PARAM_STR);
                        break;
                    case 'date':
                        $stmt->bindValue($identifier, $this->date ? $this->date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'delivery_deadline':
                        $stmt->bindValue($identifier, $this->delivery_deadline ? $this->delivery_deadline->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'payment_term':
                        $stmt->bindValue($identifier, $this->payment_term, PDO::PARAM_STR);
                        break;
                    case 'down_payment_id':
                        $stmt->bindValue($identifier, $this->down_payment_id, PDO::PARAM_INT);
                        break;
                    case 'down_payment_amount':
                        $stmt->bindValue($identifier, $this->down_payment_amount, PDO::PARAM_STR);
                        break;
                    case 'down_payment_deadline':
                        $stmt->bindValue($identifier, $this->down_payment_deadline ? $this->down_payment_deadline->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'total_price':
                        $stmt->bindValue($identifier, $this->total_price, PDO::PARAM_STR);
                        break;
                    case 'state':
                        $stmt->bindValue($identifier, $this->state, PDO::PARAM_STR);
                        break;
                    case 'active':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
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
        $pos = PurchaseOrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getProformaInvoiceId();
                break;
            case 3:
                return $this->getPackingListId();
                break;
            case 4:
                return $this->getSupplierId();
                break;
            case 5:
                return $this->getCurrencyId();
                break;
            case 6:
                return $this->getNote();
                break;
            case 7:
                return $this->getDate();
                break;
            case 8:
                return $this->getDeliveryDeadline();
                break;
            case 9:
                return $this->getPaymentTerm();
                break;
            case 10:
                return $this->getDownPaymentId();
                break;
            case 11:
                return $this->getDownPaymentAmount();
                break;
            case 12:
                return $this->getDownPaymentDeadline();
                break;
            case 13:
                return $this->getTotalPrice();
                break;
            case 14:
                return $this->getState();
                break;
            case 15:
                return $this->getActive();
                break;
            case 16:
                return $this->getCreatedAt();
                break;
            case 17:
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

        if (isset($alreadyDumpedObjects['PurchaseOrder'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['PurchaseOrder'][$this->hashCode()] = true;
        $keys = PurchaseOrderTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getProformaInvoiceId(),
            $keys[3] => $this->getPackingListId(),
            $keys[4] => $this->getSupplierId(),
            $keys[5] => $this->getCurrencyId(),
            $keys[6] => $this->getNote(),
            $keys[7] => $this->getDate(),
            $keys[8] => $this->getDeliveryDeadline(),
            $keys[9] => $this->getPaymentTerm(),
            $keys[10] => $this->getDownPaymentId(),
            $keys[11] => $this->getDownPaymentAmount(),
            $keys[12] => $this->getDownPaymentDeadline(),
            $keys[13] => $this->getTotalPrice(),
            $keys[14] => $this->getState(),
            $keys[15] => $this->getActive(),
            $keys[16] => $this->getCreatedAt(),
            $keys[17] => $this->getUpdatedAt(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('c');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('c');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aProformaInvoice) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'proformaInvoice';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'proforma_invoice';
                        break;
                    default:
                        $key = 'ProformaInvoice';
                }

                $result[$key] = $this->aProformaInvoice->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->aDownPayment) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'downPayment';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'down_payment';
                        break;
                    default:
                        $key = 'DownPayment';
                }

                $result[$key] = $this->aDownPayment->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aSupplier) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'partner';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'partner';
                        break;
                    default:
                        $key = 'Supplier';
                }

                $result[$key] = $this->aSupplier->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\PurchaseOrder
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PurchaseOrderTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\PurchaseOrder
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
                $this->setProformaInvoiceId($value);
                break;
            case 3:
                $this->setPackingListId($value);
                break;
            case 4:
                $this->setSupplierId($value);
                break;
            case 5:
                $this->setCurrencyId($value);
                break;
            case 6:
                $this->setNote($value);
                break;
            case 7:
                $this->setDate($value);
                break;
            case 8:
                $this->setDeliveryDeadline($value);
                break;
            case 9:
                $this->setPaymentTerm($value);
                break;
            case 10:
                $this->setDownPaymentId($value);
                break;
            case 11:
                $this->setDownPaymentAmount($value);
                break;
            case 12:
                $this->setDownPaymentDeadline($value);
                break;
            case 13:
                $this->setTotalPrice($value);
                break;
            case 14:
                $this->setState($value);
                break;
            case 15:
                $this->setActive($value);
                break;
            case 16:
                $this->setCreatedAt($value);
                break;
            case 17:
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
        $keys = PurchaseOrderTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setProformaInvoiceId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPackingListId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSupplierId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCurrencyId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNote($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDeliveryDeadline($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPaymentTerm($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDownPaymentId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setDownPaymentAmount($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDownPaymentDeadline($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTotalPrice($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setState($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setActive($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCreatedAt($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setUpdatedAt($arr[$keys[17]]);
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
     * @return $this|\PurchaseOrder The current object, for fluid interface
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
        $criteria = new Criteria(PurchaseOrderTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PurchaseOrderTableMap::COL_ID)) {
            $criteria->add(PurchaseOrderTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_NAME)) {
            $criteria->add(PurchaseOrderTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID)) {
            $criteria->add(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, $this->proforma_invoice_id);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_PACKING_LIST_ID)) {
            $criteria->add(PurchaseOrderTableMap::COL_PACKING_LIST_ID, $this->packing_list_id);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_SUPPLIER_ID)) {
            $criteria->add(PurchaseOrderTableMap::COL_SUPPLIER_ID, $this->supplier_id);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_CURRENCY_ID)) {
            $criteria->add(PurchaseOrderTableMap::COL_CURRENCY_ID, $this->currency_id);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_NOTE)) {
            $criteria->add(PurchaseOrderTableMap::COL_NOTE, $this->note);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DATE)) {
            $criteria->add(PurchaseOrderTableMap::COL_DATE, $this->date);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DELIVERY_DEADLINE)) {
            $criteria->add(PurchaseOrderTableMap::COL_DELIVERY_DEADLINE, $this->delivery_deadline);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_PAYMENT_TERM)) {
            $criteria->add(PurchaseOrderTableMap::COL_PAYMENT_TERM, $this->payment_term);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID)) {
            $criteria->add(PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID, $this->down_payment_id);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT)) {
            $criteria->add(PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT, $this->down_payment_amount);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE)) {
            $criteria->add(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE, $this->down_payment_deadline);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_TOTAL_PRICE)) {
            $criteria->add(PurchaseOrderTableMap::COL_TOTAL_PRICE, $this->total_price);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_STATE)) {
            $criteria->add(PurchaseOrderTableMap::COL_STATE, $this->state);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_ACTIVE)) {
            $criteria->add(PurchaseOrderTableMap::COL_ACTIVE, $this->active);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_CREATED_AT)) {
            $criteria->add(PurchaseOrderTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(PurchaseOrderTableMap::COL_UPDATED_AT)) {
            $criteria->add(PurchaseOrderTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildPurchaseOrderQuery::create();
        $criteria->add(PurchaseOrderTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \PurchaseOrder (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setProformaInvoiceId($this->getProformaInvoiceId());
        $copyObj->setPackingListId($this->getPackingListId());
        $copyObj->setSupplierId($this->getSupplierId());
        $copyObj->setCurrencyId($this->getCurrencyId());
        $copyObj->setNote($this->getNote());
        $copyObj->setDate($this->getDate());
        $copyObj->setDeliveryDeadline($this->getDeliveryDeadline());
        $copyObj->setPaymentTerm($this->getPaymentTerm());
        $copyObj->setDownPaymentId($this->getDownPaymentId());
        $copyObj->setDownPaymentAmount($this->getDownPaymentAmount());
        $copyObj->setDownPaymentDeadline($this->getDownPaymentDeadline());
        $copyObj->setTotalPrice($this->getTotalPrice());
        $copyObj->setState($this->getState());
        $copyObj->setActive($this->getActive());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPurchaseOrderLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPurchaseOrderLine($relObj->copy($deepCopy));
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
     * @return \PurchaseOrder Clone of current object.
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
     * Declares an association between this object and a ChildProformaInvoice object.
     *
     * @param  ChildProformaInvoice $v
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProformaInvoice(ChildProformaInvoice $v = null)
    {
        if ($v === null) {
            $this->setProformaInvoiceId(NULL);
        } else {
            $this->setProformaInvoiceId($v->getId());
        }

        $this->aProformaInvoice = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProformaInvoice object, it will not be re-added.
        if ($v !== null) {
            $v->addPurchaseOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProformaInvoice object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProformaInvoice The associated ChildProformaInvoice object.
     * @throws PropelException
     */
    public function getProformaInvoice(ConnectionInterface $con = null)
    {
        if ($this->aProformaInvoice === null && ($this->proforma_invoice_id != 0)) {
            $this->aProformaInvoice = ChildProformaInvoiceQuery::create()->findPk($this->proforma_invoice_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProformaInvoice->addPurchaseOrders($this);
             */
        }

        return $this->aProformaInvoice;
    }

    /**
     * Declares an association between this object and a ChildPackingList object.
     *
     * @param  ChildPackingList $v
     * @return $this|\PurchaseOrder The current object (for fluent API support)
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
            $v->addPurchaseOrder($this);
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
                $this->aPackingList->addPurchaseOrders($this);
             */
        }

        return $this->aPackingList;
    }

    /**
     * Declares an association between this object and a ChildDownPayment object.
     *
     * @param  ChildDownPayment $v
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDownPayment(ChildDownPayment $v = null)
    {
        if ($v === null) {
            $this->setDownPaymentId(NULL);
        } else {
            $this->setDownPaymentId($v->getId());
        }

        $this->aDownPayment = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDownPayment object, it will not be re-added.
        if ($v !== null) {
            $v->addPurchaseOrder($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDownPayment object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDownPayment The associated ChildDownPayment object.
     * @throws PropelException
     */
    public function getDownPayment(ConnectionInterface $con = null)
    {
        if ($this->aDownPayment === null && ($this->down_payment_id != 0)) {
            $this->aDownPayment = ChildDownPaymentQuery::create()->findPk($this->down_payment_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDownPayment->addPurchaseOrders($this);
             */
        }

        return $this->aDownPayment;
    }

    /**
     * Declares an association between this object and a ChildCurrency object.
     *
     * @param  ChildCurrency $v
     * @return $this|\PurchaseOrder The current object (for fluent API support)
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
            $v->addPurchaseOrder($this);
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
                $this->aCurrency->addPurchaseOrders($this);
             */
        }

        return $this->aCurrency;
    }

    /**
     * Declares an association between this object and a ChildPartner object.
     *
     * @param  ChildPartner $v
     * @return $this|\PurchaseOrder The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSupplier(ChildPartner $v = null)
    {
        if ($v === null) {
            $this->setSupplierId(NULL);
        } else {
            $this->setSupplierId($v->getId());
        }

        $this->aSupplier = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPartner object, it will not be re-added.
        if ($v !== null) {
            $v->addPurchaseOrder($this);
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
    public function getSupplier(ConnectionInterface $con = null)
    {
        if ($this->aSupplier === null && ($this->supplier_id != 0)) {
            $this->aSupplier = ChildPartnerQuery::create()->findPk($this->supplier_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSupplier->addPurchaseOrders($this);
             */
        }

        return $this->aSupplier;
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
        if ('PurchaseOrderLine' == $relationName) {
            $this->initPurchaseOrderLines();
            return;
        }
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
     * If this ChildPurchaseOrder is new, it will return
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
                    ->filterByPurchaseOrder($this)
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
     * @return $this|ChildPurchaseOrder The current object (for fluent API support)
     */
    public function setPurchaseOrderLines(Collection $purchaseOrderLines, ConnectionInterface $con = null)
    {
        /** @var ChildPurchaseOrderLine[] $purchaseOrderLinesToDelete */
        $purchaseOrderLinesToDelete = $this->getPurchaseOrderLines(new Criteria(), $con)->diff($purchaseOrderLines);


        $this->purchaseOrderLinesScheduledForDeletion = $purchaseOrderLinesToDelete;

        foreach ($purchaseOrderLinesToDelete as $purchaseOrderLineRemoved) {
            $purchaseOrderLineRemoved->setPurchaseOrder(null);
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
                ->filterByPurchaseOrder($this)
                ->count($con);
        }

        return count($this->collPurchaseOrderLines);
    }

    /**
     * Method called to associate a ChildPurchaseOrderLine object to this object
     * through the ChildPurchaseOrderLine foreign key attribute.
     *
     * @param  ChildPurchaseOrderLine $l ChildPurchaseOrderLine
     * @return $this|\PurchaseOrder The current object (for fluent API support)
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
        $purchaseOrderLine->setPurchaseOrder($this);
    }

    /**
     * @param  ChildPurchaseOrderLine $purchaseOrderLine The ChildPurchaseOrderLine object to remove.
     * @return $this|ChildPurchaseOrder The current object (for fluent API support)
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
            $this->purchaseOrderLinesScheduledForDeletion[]= clone $purchaseOrderLine;
            $purchaseOrderLine->setPurchaseOrder(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this PurchaseOrder is new, it will return
     * an empty collection; or if this PurchaseOrder has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PurchaseOrder.
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
     * Otherwise if this PurchaseOrder is new, it will return
     * an empty collection; or if this PurchaseOrder has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in PurchaseOrder.
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aProformaInvoice) {
            $this->aProformaInvoice->removePurchaseOrder($this);
        }
        if (null !== $this->aPackingList) {
            $this->aPackingList->removePurchaseOrder($this);
        }
        if (null !== $this->aDownPayment) {
            $this->aDownPayment->removePurchaseOrder($this);
        }
        if (null !== $this->aCurrency) {
            $this->aCurrency->removePurchaseOrder($this);
        }
        if (null !== $this->aSupplier) {
            $this->aSupplier->removePurchaseOrder($this);
        }
        $this->id = null;
        $this->name = null;
        $this->proforma_invoice_id = null;
        $this->packing_list_id = null;
        $this->supplier_id = null;
        $this->currency_id = null;
        $this->note = null;
        $this->date = null;
        $this->delivery_deadline = null;
        $this->payment_term = null;
        $this->down_payment_id = null;
        $this->down_payment_amount = null;
        $this->down_payment_deadline = null;
        $this->total_price = null;
        $this->state = null;
        $this->active = null;
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
            if ($this->collPurchaseOrderLines) {
                foreach ($this->collPurchaseOrderLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPurchaseOrderLines = null;
        $this->aProformaInvoice = null;
        $this->aPackingList = null;
        $this->aDownPayment = null;
        $this->aCurrency = null;
        $this->aSupplier = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PurchaseOrderTableMap::DEFAULT_STRING_FORMAT);
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
