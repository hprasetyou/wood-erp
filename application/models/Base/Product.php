<?php

namespace Base;

use \Finishing as ChildFinishing;
use \FinishingQuery as ChildFinishingQuery;
use \Material as ChildMaterial;
use \MaterialQuery as ChildMaterialQuery;
use \Product as ChildProduct;
use \ProductComponent as ChildProductComponent;
use \ProductComponentQuery as ChildProductComponentQuery;
use \ProductFinishing as ChildProductFinishing;
use \ProductFinishingQuery as ChildProductFinishingQuery;
use \ProductImage as ChildProductImage;
use \ProductImageQuery as ChildProductImageQuery;
use \ProductPartner as ChildProductPartner;
use \ProductPartnerQuery as ChildProductPartnerQuery;
use \ProductQuery as ChildProductQuery;
use \ProformaInvoiceLine as ChildProformaInvoiceLine;
use \ProformaInvoiceLineQuery as ChildProformaInvoiceLineQuery;
use \PurchaseOrderLine as ChildPurchaseOrderLine;
use \PurchaseOrderLineQuery as ChildPurchaseOrderLineQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\ProductComponentTableMap;
use Map\ProductFinishingTableMap;
use Map\ProductImageTableMap;
use Map\ProductPartnerTableMap;
use Map\ProductTableMap;
use Map\ProformaInvoiceLineTableMap;
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
 * Base class that represents a row from the 'product' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Product implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProductTableMap';


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
     * The value for the is_round field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_round;

    /**
     * The value for the is_kdn field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_kdn;

    /**
     * The value for the is_flegt field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $is_flegt;

    /**
     * The value for the has_component field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $has_component;

    /**
     * The value for the qty_per_pack field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $qty_per_pack;

    /**
     * The value for the list_price field.
     *
     * @var        double
     */
    protected $list_price;

    /**
     * The value for the material_id field.
     *
     * @var        int
     */
    protected $material_id;

    /**
     * The value for the note field.
     *
     * @var        string
     */
    protected $note;

    /**
     * The value for the cubic_asb field.
     *
     * @var        double
     */
    protected $cubic_asb;

    /**
     * The value for the cubic_kdn field.
     *
     * @var        double
     */
    protected $cubic_kdn;

    /**
     * The value for the width_asb field.
     *
     * @var        double
     */
    protected $width_asb;

    /**
     * The value for the height_asb field.
     *
     * @var        double
     */
    protected $height_asb;

    /**
     * The value for the depth_asb field.
     *
     * @var        double
     */
    protected $depth_asb;

    /**
     * The value for the width_kdn field.
     *
     * @var        double
     */
    protected $width_kdn;

    /**
     * The value for the height_kdn field.
     *
     * @var        double
     */
    protected $height_kdn;

    /**
     * The value for the depth_kdn field.
     *
     * @var        double
     */
    protected $depth_kdn;

    /**
     * The value for the net_cubic field.
     *
     * @var        double
     */
    protected $net_cubic;

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
     * @var        ObjectCollection|ChildProductPartner[] Collection to store aggregation of ChildProductPartner objects.
     */
    protected $collProductPartners;
    protected $collProductPartnersPartial;

    /**
     * @var        ObjectCollection|ChildProductFinishing[] Collection to store aggregation of ChildProductFinishing objects.
     */
    protected $collProductFinishings;
    protected $collProductFinishingsPartial;

    /**
     * @var        ObjectCollection|ChildProductImage[] Collection to store aggregation of ChildProductImage objects.
     */
    protected $collProductImages;
    protected $collProductImagesPartial;

    /**
     * @var        ObjectCollection|ChildProformaInvoiceLine[] Collection to store aggregation of ChildProformaInvoiceLine objects.
     */
    protected $collProformaInvoiceLines;
    protected $collProformaInvoiceLinesPartial;

    /**
     * @var        ObjectCollection|ChildPurchaseOrderLine[] Collection to store aggregation of ChildPurchaseOrderLine objects.
     */
    protected $collPurchaseOrderLines;
    protected $collPurchaseOrderLinesPartial;

    /**
     * @var        ObjectCollection|ChildFinishing[] Cross Collection to store aggregation of ChildFinishing objects.
     */
    protected $collFinishings;

    /**
     * @var bool
     */
    protected $collFinishingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFinishing[]
     */
    protected $finishingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductComponent[]
     */
    protected $productComponentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductPartner[]
     */
    protected $productPartnersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductFinishing[]
     */
    protected $productFinishingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProductImage[]
     */
    protected $productImagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildProformaInvoiceLine[]
     */
    protected $proformaInvoiceLinesScheduledForDeletion = null;

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
        $this->is_round = false;
        $this->is_kdn = false;
        $this->is_flegt = false;
        $this->has_component = false;
        $this->qty_per_pack = 1;
    }

    /**
     * Initializes internal state of Base\Product object.
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
     * Compares this with another <code>Product</code> instance.  If
     * <code>obj</code> is an instance of <code>Product</code>, delegates to
     * <code>equals(Product)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Product The current object, for fluid interface
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
     * Get the [is_round] column value.
     *
     * @return boolean
     */
    public function getIsRound()
    {
        return $this->is_round;
    }

    /**
     * Get the [is_round] column value.
     *
     * @return boolean
     */
    public function isRound()
    {
        return $this->getIsRound();
    }

    /**
     * Get the [is_kdn] column value.
     *
     * @return boolean
     */
    public function getIsKdn()
    {
        return $this->is_kdn;
    }

    /**
     * Get the [is_kdn] column value.
     *
     * @return boolean
     */
    public function isKdn()
    {
        return $this->getIsKdn();
    }

    /**
     * Get the [is_flegt] column value.
     *
     * @return boolean
     */
    public function getIsFlegt()
    {
        return $this->is_flegt;
    }

    /**
     * Get the [is_flegt] column value.
     *
     * @return boolean
     */
    public function isFlegt()
    {
        return $this->getIsFlegt();
    }

    /**
     * Get the [has_component] column value.
     *
     * @return boolean
     */
    public function getHasComponent()
    {
        return $this->has_component;
    }

    /**
     * Get the [has_component] column value.
     *
     * @return boolean
     */
    public function hasComponent()
    {
        return $this->getHasComponent();
    }

    /**
     * Get the [qty_per_pack] column value.
     *
     * @return int
     */
    public function getQtyPerPack()
    {
        return $this->qty_per_pack;
    }

    /**
     * Get the [list_price] column value.
     *
     * @return double
     */
    public function getListPrice()
    {
        return $this->list_price;
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
     * Get the [note] column value.
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the [cubic_asb] column value.
     *
     * @return double
     */
    public function getCubicAsb()
    {
        return $this->cubic_asb;
    }

    /**
     * Get the [cubic_kdn] column value.
     *
     * @return double
     */
    public function getCubicKdn()
    {
        return $this->cubic_kdn;
    }

    /**
     * Get the [width_asb] column value.
     *
     * @return double
     */
    public function getWidthAsb()
    {
        return $this->width_asb;
    }

    /**
     * Get the [height_asb] column value.
     *
     * @return double
     */
    public function getHeightAsb()
    {
        return $this->height_asb;
    }

    /**
     * Get the [depth_asb] column value.
     *
     * @return double
     */
    public function getDepthAsb()
    {
        return $this->depth_asb;
    }

    /**
     * Get the [width_kdn] column value.
     *
     * @return double
     */
    public function getWidthKdn()
    {
        return $this->width_kdn;
    }

    /**
     * Get the [height_kdn] column value.
     *
     * @return double
     */
    public function getHeightKdn()
    {
        return $this->height_kdn;
    }

    /**
     * Get the [depth_kdn] column value.
     *
     * @return double
     */
    public function getDepthKdn()
    {
        return $this->depth_kdn;
    }

    /**
     * Get the [net_cubic] column value.
     *
     * @return double
     */
    public function getNetCubic()
    {
        return $this->net_cubic;
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
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ProductTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[ProductTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ProductTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Sets the value of the [is_round] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setIsRound($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_round !== $v) {
            $this->is_round = $v;
            $this->modifiedColumns[ProductTableMap::COL_IS_ROUND] = true;
        }

        return $this;
    } // setIsRound()

    /**
     * Sets the value of the [is_kdn] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setIsKdn($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_kdn !== $v) {
            $this->is_kdn = $v;
            $this->modifiedColumns[ProductTableMap::COL_IS_KDN] = true;
        }

        return $this;
    } // setIsKdn()

    /**
     * Sets the value of the [is_flegt] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setIsFlegt($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->is_flegt !== $v) {
            $this->is_flegt = $v;
            $this->modifiedColumns[ProductTableMap::COL_IS_FLEGT] = true;
        }

        return $this;
    } // setIsFlegt()

    /**
     * Sets the value of the [has_component] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setHasComponent($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->has_component !== $v) {
            $this->has_component = $v;
            $this->modifiedColumns[ProductTableMap::COL_HAS_COMPONENT] = true;
        }

        return $this;
    } // setHasComponent()

    /**
     * Set the value of [qty_per_pack] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setQtyPerPack($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qty_per_pack !== $v) {
            $this->qty_per_pack = $v;
            $this->modifiedColumns[ProductTableMap::COL_QTY_PER_PACK] = true;
        }

        return $this;
    } // setQtyPerPack()

    /**
     * Set the value of [list_price] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setListPrice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->list_price !== $v) {
            $this->list_price = $v;
            $this->modifiedColumns[ProductTableMap::COL_LIST_PRICE] = true;
        }

        return $this;
    } // setListPrice()

    /**
     * Set the value of [material_id] column.
     *
     * @param int $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setMaterialId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->material_id !== $v) {
            $this->material_id = $v;
            $this->modifiedColumns[ProductTableMap::COL_MATERIAL_ID] = true;
        }

        if ($this->aMaterial !== null && $this->aMaterial->getId() !== $v) {
            $this->aMaterial = null;
        }

        return $this;
    } // setMaterialId()

    /**
     * Set the value of [note] column.
     *
     * @param string $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setNote($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->note !== $v) {
            $this->note = $v;
            $this->modifiedColumns[ProductTableMap::COL_NOTE] = true;
        }

        return $this;
    } // setNote()

    /**
     * Set the value of [cubic_asb] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setCubicAsb($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->cubic_asb !== $v) {
            $this->cubic_asb = $v;
            $this->modifiedColumns[ProductTableMap::COL_CUBIC_ASB] = true;
        }

        return $this;
    } // setCubicAsb()

    /**
     * Set the value of [cubic_kdn] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setCubicKdn($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->cubic_kdn !== $v) {
            $this->cubic_kdn = $v;
            $this->modifiedColumns[ProductTableMap::COL_CUBIC_KDN] = true;
        }

        return $this;
    } // setCubicKdn()

    /**
     * Set the value of [width_asb] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setWidthAsb($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->width_asb !== $v) {
            $this->width_asb = $v;
            $this->modifiedColumns[ProductTableMap::COL_WIDTH_ASB] = true;
        }

        return $this;
    } // setWidthAsb()

    /**
     * Set the value of [height_asb] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setHeightAsb($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->height_asb !== $v) {
            $this->height_asb = $v;
            $this->modifiedColumns[ProductTableMap::COL_HEIGHT_ASB] = true;
        }

        return $this;
    } // setHeightAsb()

    /**
     * Set the value of [depth_asb] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDepthAsb($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->depth_asb !== $v) {
            $this->depth_asb = $v;
            $this->modifiedColumns[ProductTableMap::COL_DEPTH_ASB] = true;
        }

        return $this;
    } // setDepthAsb()

    /**
     * Set the value of [width_kdn] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setWidthKdn($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->width_kdn !== $v) {
            $this->width_kdn = $v;
            $this->modifiedColumns[ProductTableMap::COL_WIDTH_KDN] = true;
        }

        return $this;
    } // setWidthKdn()

    /**
     * Set the value of [height_kdn] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setHeightKdn($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->height_kdn !== $v) {
            $this->height_kdn = $v;
            $this->modifiedColumns[ProductTableMap::COL_HEIGHT_KDN] = true;
        }

        return $this;
    } // setHeightKdn()

    /**
     * Set the value of [depth_kdn] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setDepthKdn($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->depth_kdn !== $v) {
            $this->depth_kdn = $v;
            $this->modifiedColumns[ProductTableMap::COL_DEPTH_KDN] = true;
        }

        return $this;
    } // setDepthKdn()

    /**
     * Set the value of [net_cubic] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setNetCubic($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->net_cubic !== $v) {
            $this->net_cubic = $v;
            $this->modifiedColumns[ProductTableMap::COL_NET_CUBIC] = true;
        }

        return $this;
    } // setNetCubic()

    /**
     * Set the value of [net_weight] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setNetWeight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->net_weight !== $v) {
            $this->net_weight = $v;
            $this->modifiedColumns[ProductTableMap::COL_NET_WEIGHT] = true;
        }

        return $this;
    } // setNetWeight()

    /**
     * Set the value of [gross_weight] column.
     *
     * @param double $v new value
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setGrossWeight($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->gross_weight !== $v) {
            $this->gross_weight = $v;
            $this->modifiedColumns[ProductTableMap::COL_GROSS_WEIGHT] = true;
        }

        return $this;
    } // setGrossWeight()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Product The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ProductTableMap::COL_UPDATED_AT] = true;
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
            if ($this->is_round !== false) {
                return false;
            }

            if ($this->is_kdn !== false) {
                return false;
            }

            if ($this->is_flegt !== false) {
                return false;
            }

            if ($this->has_component !== false) {
                return false;
            }

            if ($this->qty_per_pack !== 1) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductTableMap::translateFieldName('IsRound', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_round = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductTableMap::translateFieldName('IsKdn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_kdn = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductTableMap::translateFieldName('IsFlegt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_flegt = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductTableMap::translateFieldName('HasComponent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->has_component = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductTableMap::translateFieldName('QtyPerPack', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qty_per_pack = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductTableMap::translateFieldName('ListPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->list_price = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductTableMap::translateFieldName('MaterialId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->material_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProductTableMap::translateFieldName('Note', TableMap::TYPE_PHPNAME, $indexType)];
            $this->note = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ProductTableMap::translateFieldName('CubicAsb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cubic_asb = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ProductTableMap::translateFieldName('CubicKdn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cubic_kdn = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ProductTableMap::translateFieldName('WidthAsb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->width_asb = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ProductTableMap::translateFieldName('HeightAsb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->height_asb = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ProductTableMap::translateFieldName('DepthAsb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->depth_asb = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ProductTableMap::translateFieldName('WidthKdn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->width_kdn = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ProductTableMap::translateFieldName('HeightKdn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->height_kdn = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ProductTableMap::translateFieldName('DepthKdn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->depth_kdn = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : ProductTableMap::translateFieldName('NetCubic', TableMap::TYPE_PHPNAME, $indexType)];
            $this->net_cubic = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : ProductTableMap::translateFieldName('NetWeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->net_weight = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : ProductTableMap::translateFieldName('GrossWeight', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gross_weight = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : ProductTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : ProductTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 24; // 24 = ProductTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Product'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMaterial = null;
            $this->collProductComponents = null;

            $this->collProductPartners = null;

            $this->collProductFinishings = null;

            $this->collProductImages = null;

            $this->collProformaInvoiceLines = null;

            $this->collPurchaseOrderLines = null;

            $this->collFinishings = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Product::setDeleted()
     * @see Product::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
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
                ProductTableMap::addInstanceToPool($this);
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

            if ($this->finishingsScheduledForDeletion !== null) {
                if (!$this->finishingsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->finishingsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getId();
                        $entryPk[1] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \ProductFinishingQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->finishingsScheduledForDeletion = null;
                }

            }

            if ($this->collFinishings) {
                foreach ($this->collFinishings as $finishing) {
                    if (!$finishing->isDeleted() && ($finishing->isNew() || $finishing->isModified())) {
                        $finishing->save($con);
                    }
                }
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

            if ($this->productFinishingsScheduledForDeletion !== null) {
                if (!$this->productFinishingsScheduledForDeletion->isEmpty()) {
                    \ProductFinishingQuery::create()
                        ->filterByPrimaryKeys($this->productFinishingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productFinishingsScheduledForDeletion = null;
                }
            }

            if ($this->collProductFinishings !== null) {
                foreach ($this->collProductFinishings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->productImagesScheduledForDeletion !== null) {
                if (!$this->productImagesScheduledForDeletion->isEmpty()) {
                    \ProductImageQuery::create()
                        ->filterByPrimaryKeys($this->productImagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->productImagesScheduledForDeletion = null;
                }
            }

            if ($this->collProductImages !== null) {
                foreach ($this->collProductImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[ProductTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ProductTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ProductTableMap::COL_IS_ROUND)) {
            $modifiedColumns[':p' . $index++]  = 'is_round';
        }
        if ($this->isColumnModified(ProductTableMap::COL_IS_KDN)) {
            $modifiedColumns[':p' . $index++]  = 'is_kdn';
        }
        if ($this->isColumnModified(ProductTableMap::COL_IS_FLEGT)) {
            $modifiedColumns[':p' . $index++]  = 'is_flegt';
        }
        if ($this->isColumnModified(ProductTableMap::COL_HAS_COMPONENT)) {
            $modifiedColumns[':p' . $index++]  = 'has_component';
        }
        if ($this->isColumnModified(ProductTableMap::COL_QTY_PER_PACK)) {
            $modifiedColumns[':p' . $index++]  = 'qty_per_pack';
        }
        if ($this->isColumnModified(ProductTableMap::COL_LIST_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'list_price';
        }
        if ($this->isColumnModified(ProductTableMap::COL_MATERIAL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'material_id';
        }
        if ($this->isColumnModified(ProductTableMap::COL_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'note';
        }
        if ($this->isColumnModified(ProductTableMap::COL_CUBIC_ASB)) {
            $modifiedColumns[':p' . $index++]  = 'cubic_asb';
        }
        if ($this->isColumnModified(ProductTableMap::COL_CUBIC_KDN)) {
            $modifiedColumns[':p' . $index++]  = 'cubic_kdn';
        }
        if ($this->isColumnModified(ProductTableMap::COL_WIDTH_ASB)) {
            $modifiedColumns[':p' . $index++]  = 'width_asb';
        }
        if ($this->isColumnModified(ProductTableMap::COL_HEIGHT_ASB)) {
            $modifiedColumns[':p' . $index++]  = 'height_asb';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DEPTH_ASB)) {
            $modifiedColumns[':p' . $index++]  = 'depth_asb';
        }
        if ($this->isColumnModified(ProductTableMap::COL_WIDTH_KDN)) {
            $modifiedColumns[':p' . $index++]  = 'width_kdn';
        }
        if ($this->isColumnModified(ProductTableMap::COL_HEIGHT_KDN)) {
            $modifiedColumns[':p' . $index++]  = 'height_kdn';
        }
        if ($this->isColumnModified(ProductTableMap::COL_DEPTH_KDN)) {
            $modifiedColumns[':p' . $index++]  = 'depth_kdn';
        }
        if ($this->isColumnModified(ProductTableMap::COL_NET_CUBIC)) {
            $modifiedColumns[':p' . $index++]  = 'net_cubic';
        }
        if ($this->isColumnModified(ProductTableMap::COL_NET_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'net_weight';
        }
        if ($this->isColumnModified(ProductTableMap::COL_GROSS_WEIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'gross_weight';
        }
        if ($this->isColumnModified(ProductTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ProductTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO product (%s) VALUES (%s)',
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
                    case 'is_round':
                        $stmt->bindValue($identifier, (int) $this->is_round, PDO::PARAM_INT);
                        break;
                    case 'is_kdn':
                        $stmt->bindValue($identifier, (int) $this->is_kdn, PDO::PARAM_INT);
                        break;
                    case 'is_flegt':
                        $stmt->bindValue($identifier, (int) $this->is_flegt, PDO::PARAM_INT);
                        break;
                    case 'has_component':
                        $stmt->bindValue($identifier, (int) $this->has_component, PDO::PARAM_INT);
                        break;
                    case 'qty_per_pack':
                        $stmt->bindValue($identifier, $this->qty_per_pack, PDO::PARAM_INT);
                        break;
                    case 'list_price':
                        $stmt->bindValue($identifier, $this->list_price, PDO::PARAM_STR);
                        break;
                    case 'material_id':
                        $stmt->bindValue($identifier, $this->material_id, PDO::PARAM_INT);
                        break;
                    case 'note':
                        $stmt->bindValue($identifier, $this->note, PDO::PARAM_STR);
                        break;
                    case 'cubic_asb':
                        $stmt->bindValue($identifier, $this->cubic_asb, PDO::PARAM_STR);
                        break;
                    case 'cubic_kdn':
                        $stmt->bindValue($identifier, $this->cubic_kdn, PDO::PARAM_STR);
                        break;
                    case 'width_asb':
                        $stmt->bindValue($identifier, $this->width_asb, PDO::PARAM_STR);
                        break;
                    case 'height_asb':
                        $stmt->bindValue($identifier, $this->height_asb, PDO::PARAM_STR);
                        break;
                    case 'depth_asb':
                        $stmt->bindValue($identifier, $this->depth_asb, PDO::PARAM_STR);
                        break;
                    case 'width_kdn':
                        $stmt->bindValue($identifier, $this->width_kdn, PDO::PARAM_STR);
                        break;
                    case 'height_kdn':
                        $stmt->bindValue($identifier, $this->height_kdn, PDO::PARAM_STR);
                        break;
                    case 'depth_kdn':
                        $stmt->bindValue($identifier, $this->depth_kdn, PDO::PARAM_STR);
                        break;
                    case 'net_cubic':
                        $stmt->bindValue($identifier, $this->net_cubic, PDO::PARAM_STR);
                        break;
                    case 'net_weight':
                        $stmt->bindValue($identifier, $this->net_weight, PDO::PARAM_STR);
                        break;
                    case 'gross_weight':
                        $stmt->bindValue($identifier, $this->gross_weight, PDO::PARAM_STR);
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
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIsRound();
                break;
            case 4:
                return $this->getIsKdn();
                break;
            case 5:
                return $this->getIsFlegt();
                break;
            case 6:
                return $this->getHasComponent();
                break;
            case 7:
                return $this->getQtyPerPack();
                break;
            case 8:
                return $this->getListPrice();
                break;
            case 9:
                return $this->getMaterialId();
                break;
            case 10:
                return $this->getNote();
                break;
            case 11:
                return $this->getCubicAsb();
                break;
            case 12:
                return $this->getCubicKdn();
                break;
            case 13:
                return $this->getWidthAsb();
                break;
            case 14:
                return $this->getHeightAsb();
                break;
            case 15:
                return $this->getDepthAsb();
                break;
            case 16:
                return $this->getWidthKdn();
                break;
            case 17:
                return $this->getHeightKdn();
                break;
            case 18:
                return $this->getDepthKdn();
                break;
            case 19:
                return $this->getNetCubic();
                break;
            case 20:
                return $this->getNetWeight();
                break;
            case 21:
                return $this->getGrossWeight();
                break;
            case 22:
                return $this->getCreatedAt();
                break;
            case 23:
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

        if (isset($alreadyDumpedObjects['Product'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Product'][$this->hashCode()] = true;
        $keys = ProductTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getIsRound(),
            $keys[4] => $this->getIsKdn(),
            $keys[5] => $this->getIsFlegt(),
            $keys[6] => $this->getHasComponent(),
            $keys[7] => $this->getQtyPerPack(),
            $keys[8] => $this->getListPrice(),
            $keys[9] => $this->getMaterialId(),
            $keys[10] => $this->getNote(),
            $keys[11] => $this->getCubicAsb(),
            $keys[12] => $this->getCubicKdn(),
            $keys[13] => $this->getWidthAsb(),
            $keys[14] => $this->getHeightAsb(),
            $keys[15] => $this->getDepthAsb(),
            $keys[16] => $this->getWidthKdn(),
            $keys[17] => $this->getHeightKdn(),
            $keys[18] => $this->getDepthKdn(),
            $keys[19] => $this->getNetCubic(),
            $keys[20] => $this->getNetWeight(),
            $keys[21] => $this->getGrossWeight(),
            $keys[22] => $this->getCreatedAt(),
            $keys[23] => $this->getUpdatedAt(),
        );
        if ($result[$keys[22]] instanceof \DateTimeInterface) {
            $result[$keys[22]] = $result[$keys[22]]->format('c');
        }

        if ($result[$keys[23]] instanceof \DateTimeInterface) {
            $result[$keys[23]] = $result[$keys[23]]->format('c');
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
            if (null !== $this->collProductFinishings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productFinishings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_finishings';
                        break;
                    default:
                        $key = 'ProductFinishings';
                }

                $result[$key] = $this->collProductFinishings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProductImages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'productImages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'product_images';
                        break;
                    default:
                        $key = 'ProductImages';
                }

                $result[$key] = $this->collProductImages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Product
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Product
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
                $this->setIsRound($value);
                break;
            case 4:
                $this->setIsKdn($value);
                break;
            case 5:
                $this->setIsFlegt($value);
                break;
            case 6:
                $this->setHasComponent($value);
                break;
            case 7:
                $this->setQtyPerPack($value);
                break;
            case 8:
                $this->setListPrice($value);
                break;
            case 9:
                $this->setMaterialId($value);
                break;
            case 10:
                $this->setNote($value);
                break;
            case 11:
                $this->setCubicAsb($value);
                break;
            case 12:
                $this->setCubicKdn($value);
                break;
            case 13:
                $this->setWidthAsb($value);
                break;
            case 14:
                $this->setHeightAsb($value);
                break;
            case 15:
                $this->setDepthAsb($value);
                break;
            case 16:
                $this->setWidthKdn($value);
                break;
            case 17:
                $this->setHeightKdn($value);
                break;
            case 18:
                $this->setDepthKdn($value);
                break;
            case 19:
                $this->setNetCubic($value);
                break;
            case 20:
                $this->setNetWeight($value);
                break;
            case 21:
                $this->setGrossWeight($value);
                break;
            case 22:
                $this->setCreatedAt($value);
                break;
            case 23:
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
        $keys = ProductTableMap::getFieldNames($keyType);

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
            $this->setIsRound($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsKdn($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIsFlegt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setHasComponent($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setQtyPerPack($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setListPrice($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setMaterialId($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setNote($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCubicAsb($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCubicKdn($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setWidthAsb($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setHeightAsb($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setDepthAsb($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setWidthKdn($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setHeightKdn($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setDepthKdn($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setNetCubic($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setNetWeight($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setGrossWeight($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCreatedAt($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setUpdatedAt($arr[$keys[23]]);
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
     * @return $this|\Product The current object, for fluid interface
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
        $criteria = new Criteria(ProductTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductTableMap::COL_ID)) {
            $criteria->add(ProductTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ProductTableMap::COL_NAME)) {
            $criteria->add(ProductTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DESCRIPTION)) {
            $criteria->add(ProductTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ProductTableMap::COL_IS_ROUND)) {
            $criteria->add(ProductTableMap::COL_IS_ROUND, $this->is_round);
        }
        if ($this->isColumnModified(ProductTableMap::COL_IS_KDN)) {
            $criteria->add(ProductTableMap::COL_IS_KDN, $this->is_kdn);
        }
        if ($this->isColumnModified(ProductTableMap::COL_IS_FLEGT)) {
            $criteria->add(ProductTableMap::COL_IS_FLEGT, $this->is_flegt);
        }
        if ($this->isColumnModified(ProductTableMap::COL_HAS_COMPONENT)) {
            $criteria->add(ProductTableMap::COL_HAS_COMPONENT, $this->has_component);
        }
        if ($this->isColumnModified(ProductTableMap::COL_QTY_PER_PACK)) {
            $criteria->add(ProductTableMap::COL_QTY_PER_PACK, $this->qty_per_pack);
        }
        if ($this->isColumnModified(ProductTableMap::COL_LIST_PRICE)) {
            $criteria->add(ProductTableMap::COL_LIST_PRICE, $this->list_price);
        }
        if ($this->isColumnModified(ProductTableMap::COL_MATERIAL_ID)) {
            $criteria->add(ProductTableMap::COL_MATERIAL_ID, $this->material_id);
        }
        if ($this->isColumnModified(ProductTableMap::COL_NOTE)) {
            $criteria->add(ProductTableMap::COL_NOTE, $this->note);
        }
        if ($this->isColumnModified(ProductTableMap::COL_CUBIC_ASB)) {
            $criteria->add(ProductTableMap::COL_CUBIC_ASB, $this->cubic_asb);
        }
        if ($this->isColumnModified(ProductTableMap::COL_CUBIC_KDN)) {
            $criteria->add(ProductTableMap::COL_CUBIC_KDN, $this->cubic_kdn);
        }
        if ($this->isColumnModified(ProductTableMap::COL_WIDTH_ASB)) {
            $criteria->add(ProductTableMap::COL_WIDTH_ASB, $this->width_asb);
        }
        if ($this->isColumnModified(ProductTableMap::COL_HEIGHT_ASB)) {
            $criteria->add(ProductTableMap::COL_HEIGHT_ASB, $this->height_asb);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DEPTH_ASB)) {
            $criteria->add(ProductTableMap::COL_DEPTH_ASB, $this->depth_asb);
        }
        if ($this->isColumnModified(ProductTableMap::COL_WIDTH_KDN)) {
            $criteria->add(ProductTableMap::COL_WIDTH_KDN, $this->width_kdn);
        }
        if ($this->isColumnModified(ProductTableMap::COL_HEIGHT_KDN)) {
            $criteria->add(ProductTableMap::COL_HEIGHT_KDN, $this->height_kdn);
        }
        if ($this->isColumnModified(ProductTableMap::COL_DEPTH_KDN)) {
            $criteria->add(ProductTableMap::COL_DEPTH_KDN, $this->depth_kdn);
        }
        if ($this->isColumnModified(ProductTableMap::COL_NET_CUBIC)) {
            $criteria->add(ProductTableMap::COL_NET_CUBIC, $this->net_cubic);
        }
        if ($this->isColumnModified(ProductTableMap::COL_NET_WEIGHT)) {
            $criteria->add(ProductTableMap::COL_NET_WEIGHT, $this->net_weight);
        }
        if ($this->isColumnModified(ProductTableMap::COL_GROSS_WEIGHT)) {
            $criteria->add(ProductTableMap::COL_GROSS_WEIGHT, $this->gross_weight);
        }
        if ($this->isColumnModified(ProductTableMap::COL_CREATED_AT)) {
            $criteria->add(ProductTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ProductTableMap::COL_UPDATED_AT)) {
            $criteria->add(ProductTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildProductQuery::create();
        $criteria->add(ProductTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Product (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setIsRound($this->getIsRound());
        $copyObj->setIsKdn($this->getIsKdn());
        $copyObj->setIsFlegt($this->getIsFlegt());
        $copyObj->setHasComponent($this->getHasComponent());
        $copyObj->setQtyPerPack($this->getQtyPerPack());
        $copyObj->setListPrice($this->getListPrice());
        $copyObj->setMaterialId($this->getMaterialId());
        $copyObj->setNote($this->getNote());
        $copyObj->setCubicAsb($this->getCubicAsb());
        $copyObj->setCubicKdn($this->getCubicKdn());
        $copyObj->setWidthAsb($this->getWidthAsb());
        $copyObj->setHeightAsb($this->getHeightAsb());
        $copyObj->setDepthAsb($this->getDepthAsb());
        $copyObj->setWidthKdn($this->getWidthKdn());
        $copyObj->setHeightKdn($this->getHeightKdn());
        $copyObj->setDepthKdn($this->getDepthKdn());
        $copyObj->setNetCubic($this->getNetCubic());
        $copyObj->setNetWeight($this->getNetWeight());
        $copyObj->setGrossWeight($this->getGrossWeight());
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

            foreach ($this->getProductPartners() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductPartner($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductFinishings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductFinishing($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProductImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProductImage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProformaInvoiceLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProformaInvoiceLine($relObj->copy($deepCopy));
                }
            }

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
     * @return \Product Clone of current object.
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
     * @return $this|\Product The current object (for fluent API support)
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
            $v->addProduct($this);
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
                $this->aMaterial->addProducts($this);
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
        if ('ProductPartner' == $relationName) {
            $this->initProductPartners();
            return;
        }
        if ('ProductFinishing' == $relationName) {
            $this->initProductFinishings();
            return;
        }
        if ('ProductImage' == $relationName) {
            $this->initProductImages();
            return;
        }
        if ('ProformaInvoiceLine' == $relationName) {
            $this->initProformaInvoiceLines();
            return;
        }
        if ('PurchaseOrderLine' == $relationName) {
            $this->initPurchaseOrderLines();
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductComponents(Collection $productComponents, ConnectionInterface $con = null)
    {
        /** @var ChildProductComponent[] $productComponentsToDelete */
        $productComponentsToDelete = $this->getProductComponents(new Criteria(), $con)->diff($productComponents);


        $this->productComponentsScheduledForDeletion = $productComponentsToDelete;

        foreach ($productComponentsToDelete as $productComponentRemoved) {
            $productComponentRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductComponents);
    }

    /**
     * Method called to associate a ChildProductComponent object to this object
     * through the ChildProductComponent foreign key attribute.
     *
     * @param  ChildProductComponent $l ChildProductComponent
     * @return $this|\Product The current object (for fluent API support)
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
        $productComponent->setProduct($this);
    }

    /**
     * @param  ChildProductComponent $productComponent The ChildProductComponent object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $productComponent->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductComponents from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductComponent[] List of ChildProductComponent objects
     */
    public function getProductComponentsJoinComponent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductComponentQuery::create(null, $criteria);
        $query->joinWith('Component', $joinBehavior);

        return $this->getProductComponents($query, $con);
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductPartners(Collection $productPartners, ConnectionInterface $con = null)
    {
        /** @var ChildProductPartner[] $productPartnersToDelete */
        $productPartnersToDelete = $this->getProductPartners(new Criteria(), $con)->diff($productPartners);


        $this->productPartnersScheduledForDeletion = $productPartnersToDelete;

        foreach ($productPartnersToDelete as $productPartnerRemoved) {
            $productPartnerRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductPartners);
    }

    /**
     * Method called to associate a ChildProductPartner object to this object
     * through the ChildProductPartner foreign key attribute.
     *
     * @param  ChildProductPartner $l ChildProductPartner
     * @return $this|\Product The current object (for fluent API support)
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
        $productPartner->setProduct($this);
    }

    /**
     * @param  ChildProductPartner $productPartner The ChildProductPartner object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $productPartner->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductPartners from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductPartner[] List of ChildProductPartner objects
     */
    public function getProductPartnersJoinPartner(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductPartnerQuery::create(null, $criteria);
        $query->joinWith('Partner', $joinBehavior);

        return $this->getProductPartners($query, $con);
    }

    /**
     * Clears out the collProductFinishings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductFinishings()
     */
    public function clearProductFinishings()
    {
        $this->collProductFinishings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductFinishings collection loaded partially.
     */
    public function resetPartialProductFinishings($v = true)
    {
        $this->collProductFinishingsPartial = $v;
    }

    /**
     * Initializes the collProductFinishings collection.
     *
     * By default this just sets the collProductFinishings collection to an empty array (like clearcollProductFinishings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductFinishings($overrideExisting = true)
    {
        if (null !== $this->collProductFinishings && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductFinishingTableMap::getTableMap()->getCollectionClassName();

        $this->collProductFinishings = new $collectionClassName;
        $this->collProductFinishings->setModel('\ProductFinishing');
    }

    /**
     * Gets an array of ChildProductFinishing objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductFinishing[] List of ChildProductFinishing objects
     * @throws PropelException
     */
    public function getProductFinishings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductFinishingsPartial && !$this->isNew();
        if (null === $this->collProductFinishings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductFinishings) {
                // return empty collection
                $this->initProductFinishings();
            } else {
                $collProductFinishings = ChildProductFinishingQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductFinishingsPartial && count($collProductFinishings)) {
                        $this->initProductFinishings(false);

                        foreach ($collProductFinishings as $obj) {
                            if (false == $this->collProductFinishings->contains($obj)) {
                                $this->collProductFinishings->append($obj);
                            }
                        }

                        $this->collProductFinishingsPartial = true;
                    }

                    return $collProductFinishings;
                }

                if ($partial && $this->collProductFinishings) {
                    foreach ($this->collProductFinishings as $obj) {
                        if ($obj->isNew()) {
                            $collProductFinishings[] = $obj;
                        }
                    }
                }

                $this->collProductFinishings = $collProductFinishings;
                $this->collProductFinishingsPartial = false;
            }
        }

        return $this->collProductFinishings;
    }

    /**
     * Sets a collection of ChildProductFinishing objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productFinishings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductFinishings(Collection $productFinishings, ConnectionInterface $con = null)
    {
        /** @var ChildProductFinishing[] $productFinishingsToDelete */
        $productFinishingsToDelete = $this->getProductFinishings(new Criteria(), $con)->diff($productFinishings);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->productFinishingsScheduledForDeletion = clone $productFinishingsToDelete;

        foreach ($productFinishingsToDelete as $productFinishingRemoved) {
            $productFinishingRemoved->setProduct(null);
        }

        $this->collProductFinishings = null;
        foreach ($productFinishings as $productFinishing) {
            $this->addProductFinishing($productFinishing);
        }

        $this->collProductFinishings = $productFinishings;
        $this->collProductFinishingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductFinishing objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductFinishing objects.
     * @throws PropelException
     */
    public function countProductFinishings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductFinishingsPartial && !$this->isNew();
        if (null === $this->collProductFinishings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductFinishings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductFinishings());
            }

            $query = ChildProductFinishingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductFinishings);
    }

    /**
     * Method called to associate a ChildProductFinishing object to this object
     * through the ChildProductFinishing foreign key attribute.
     *
     * @param  ChildProductFinishing $l ChildProductFinishing
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addProductFinishing(ChildProductFinishing $l)
    {
        if ($this->collProductFinishings === null) {
            $this->initProductFinishings();
            $this->collProductFinishingsPartial = true;
        }

        if (!$this->collProductFinishings->contains($l)) {
            $this->doAddProductFinishing($l);

            if ($this->productFinishingsScheduledForDeletion and $this->productFinishingsScheduledForDeletion->contains($l)) {
                $this->productFinishingsScheduledForDeletion->remove($this->productFinishingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductFinishing $productFinishing The ChildProductFinishing object to add.
     */
    protected function doAddProductFinishing(ChildProductFinishing $productFinishing)
    {
        $this->collProductFinishings[]= $productFinishing;
        $productFinishing->setProduct($this);
    }

    /**
     * @param  ChildProductFinishing $productFinishing The ChildProductFinishing object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductFinishing(ChildProductFinishing $productFinishing)
    {
        if ($this->getProductFinishings()->contains($productFinishing)) {
            $pos = $this->collProductFinishings->search($productFinishing);
            $this->collProductFinishings->remove($pos);
            if (null === $this->productFinishingsScheduledForDeletion) {
                $this->productFinishingsScheduledForDeletion = clone $this->collProductFinishings;
                $this->productFinishingsScheduledForDeletion->clear();
            }
            $this->productFinishingsScheduledForDeletion[]= clone $productFinishing;
            $productFinishing->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProductFinishings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProductFinishing[] List of ChildProductFinishing objects
     */
    public function getProductFinishingsJoinFinishing(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProductFinishingQuery::create(null, $criteria);
        $query->joinWith('Finishing', $joinBehavior);

        return $this->getProductFinishings($query, $con);
    }

    /**
     * Clears out the collProductImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addProductImages()
     */
    public function clearProductImages()
    {
        $this->collProductImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collProductImages collection loaded partially.
     */
    public function resetPartialProductImages($v = true)
    {
        $this->collProductImagesPartial = $v;
    }

    /**
     * Initializes the collProductImages collection.
     *
     * By default this just sets the collProductImages collection to an empty array (like clearcollProductImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProductImages($overrideExisting = true)
    {
        if (null !== $this->collProductImages && !$overrideExisting) {
            return;
        }

        $collectionClassName = ProductImageTableMap::getTableMap()->getCollectionClassName();

        $this->collProductImages = new $collectionClassName;
        $this->collProductImages->setModel('\ProductImage');
    }

    /**
     * Gets an array of ChildProductImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildProductImage[] List of ChildProductImage objects
     * @throws PropelException
     */
    public function getProductImages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collProductImagesPartial && !$this->isNew();
        if (null === $this->collProductImages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProductImages) {
                // return empty collection
                $this->initProductImages();
            } else {
                $collProductImages = ChildProductImageQuery::create(null, $criteria)
                    ->filterByProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collProductImagesPartial && count($collProductImages)) {
                        $this->initProductImages(false);

                        foreach ($collProductImages as $obj) {
                            if (false == $this->collProductImages->contains($obj)) {
                                $this->collProductImages->append($obj);
                            }
                        }

                        $this->collProductImagesPartial = true;
                    }

                    return $collProductImages;
                }

                if ($partial && $this->collProductImages) {
                    foreach ($this->collProductImages as $obj) {
                        if ($obj->isNew()) {
                            $collProductImages[] = $obj;
                        }
                    }
                }

                $this->collProductImages = $collProductImages;
                $this->collProductImagesPartial = false;
            }
        }

        return $this->collProductImages;
    }

    /**
     * Sets a collection of ChildProductImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $productImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProductImages(Collection $productImages, ConnectionInterface $con = null)
    {
        /** @var ChildProductImage[] $productImagesToDelete */
        $productImagesToDelete = $this->getProductImages(new Criteria(), $con)->diff($productImages);


        $this->productImagesScheduledForDeletion = $productImagesToDelete;

        foreach ($productImagesToDelete as $productImageRemoved) {
            $productImageRemoved->setProduct(null);
        }

        $this->collProductImages = null;
        foreach ($productImages as $productImage) {
            $this->addProductImage($productImage);
        }

        $this->collProductImages = $productImages;
        $this->collProductImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProductImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ProductImage objects.
     * @throws PropelException
     */
    public function countProductImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collProductImagesPartial && !$this->isNew();
        if (null === $this->collProductImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProductImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProductImages());
            }

            $query = ChildProductImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProductImages);
    }

    /**
     * Method called to associate a ChildProductImage object to this object
     * through the ChildProductImage foreign key attribute.
     *
     * @param  ChildProductImage $l ChildProductImage
     * @return $this|\Product The current object (for fluent API support)
     */
    public function addProductImage(ChildProductImage $l)
    {
        if ($this->collProductImages === null) {
            $this->initProductImages();
            $this->collProductImagesPartial = true;
        }

        if (!$this->collProductImages->contains($l)) {
            $this->doAddProductImage($l);

            if ($this->productImagesScheduledForDeletion and $this->productImagesScheduledForDeletion->contains($l)) {
                $this->productImagesScheduledForDeletion->remove($this->productImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildProductImage $productImage The ChildProductImage object to add.
     */
    protected function doAddProductImage(ChildProductImage $productImage)
    {
        $this->collProductImages[]= $productImage;
        $productImage->setProduct($this);
    }

    /**
     * @param  ChildProductImage $productImage The ChildProductImage object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function removeProductImage(ChildProductImage $productImage)
    {
        if ($this->getProductImages()->contains($productImage)) {
            $pos = $this->collProductImages->search($productImage);
            $this->collProductImages->remove($pos);
            if (null === $this->productImagesScheduledForDeletion) {
                $this->productImagesScheduledForDeletion = clone $this->collProductImages;
                $this->productImagesScheduledForDeletion->clear();
            }
            $this->productImagesScheduledForDeletion[]= clone $productImage;
            $productImage->setProduct(null);
        }

        return $this;
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setProformaInvoiceLines(Collection $proformaInvoiceLines, ConnectionInterface $con = null)
    {
        /** @var ChildProformaInvoiceLine[] $proformaInvoiceLinesToDelete */
        $proformaInvoiceLinesToDelete = $this->getProformaInvoiceLines(new Criteria(), $con)->diff($proformaInvoiceLines);


        $this->proformaInvoiceLinesScheduledForDeletion = $proformaInvoiceLinesToDelete;

        foreach ($proformaInvoiceLinesToDelete as $proformaInvoiceLineRemoved) {
            $proformaInvoiceLineRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collProformaInvoiceLines);
    }

    /**
     * Method called to associate a ChildProformaInvoiceLine object to this object
     * through the ChildProformaInvoiceLine foreign key attribute.
     *
     * @param  ChildProformaInvoiceLine $l ChildProformaInvoiceLine
     * @return $this|\Product The current object (for fluent API support)
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
        $proformaInvoiceLine->setProduct($this);
    }

    /**
     * @param  ChildProformaInvoiceLine $proformaInvoiceLine The ChildProformaInvoiceLine object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $proformaInvoiceLine->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related ProformaInvoiceLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildProformaInvoiceLine[] List of ChildProformaInvoiceLine objects
     */
    public function getProformaInvoiceLinesJoinProformaInvoice(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildProformaInvoiceLineQuery::create(null, $criteria);
        $query->joinWith('ProformaInvoice', $joinBehavior);

        return $this->getProformaInvoiceLines($query, $con);
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
     * If this ChildProduct is new, it will return
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
                    ->filterByProduct($this)
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
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setPurchaseOrderLines(Collection $purchaseOrderLines, ConnectionInterface $con = null)
    {
        /** @var ChildPurchaseOrderLine[] $purchaseOrderLinesToDelete */
        $purchaseOrderLinesToDelete = $this->getPurchaseOrderLines(new Criteria(), $con)->diff($purchaseOrderLines);


        $this->purchaseOrderLinesScheduledForDeletion = $purchaseOrderLinesToDelete;

        foreach ($purchaseOrderLinesToDelete as $purchaseOrderLineRemoved) {
            $purchaseOrderLineRemoved->setProduct(null);
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
                ->filterByProduct($this)
                ->count($con);
        }

        return count($this->collPurchaseOrderLines);
    }

    /**
     * Method called to associate a ChildPurchaseOrderLine object to this object
     * through the ChildPurchaseOrderLine foreign key attribute.
     *
     * @param  ChildPurchaseOrderLine $l ChildPurchaseOrderLine
     * @return $this|\Product The current object (for fluent API support)
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
        $purchaseOrderLine->setProduct($this);
    }

    /**
     * @param  ChildPurchaseOrderLine $purchaseOrderLine The ChildPurchaseOrderLine object to remove.
     * @return $this|ChildProduct The current object (for fluent API support)
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
            $purchaseOrderLine->setProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
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
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
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
     * Otherwise if this Product is new, it will return
     * an empty collection; or if this Product has previously
     * been saved, it will retrieve related PurchaseOrderLines from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Product.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPurchaseOrderLine[] List of ChildPurchaseOrderLine objects
     */
    public function getPurchaseOrderLinesJoinComponent(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPurchaseOrderLineQuery::create(null, $criteria);
        $query->joinWith('Component', $joinBehavior);

        return $this->getPurchaseOrderLines($query, $con);
    }

    /**
     * Clears out the collFinishings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFinishings()
     */
    public function clearFinishings()
    {
        $this->collFinishings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collFinishings crossRef collection.
     *
     * By default this just sets the collFinishings collection to an empty collection (like clearFinishings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initFinishings()
    {
        $collectionClassName = ProductFinishingTableMap::getTableMap()->getCollectionClassName();

        $this->collFinishings = new $collectionClassName;
        $this->collFinishingsPartial = true;
        $this->collFinishings->setModel('\Finishing');
    }

    /**
     * Checks if the collFinishings collection is loaded.
     *
     * @return bool
     */
    public function isFinishingsLoaded()
    {
        return null !== $this->collFinishings;
    }

    /**
     * Gets a collection of ChildFinishing objects related by a many-to-many relationship
     * to the current object by way of the product_finishing cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildFinishing[] List of ChildFinishing objects
     */
    public function getFinishings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFinishingsPartial && !$this->isNew();
        if (null === $this->collFinishings || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collFinishings) {
                    $this->initFinishings();
                }
            } else {

                $query = ChildFinishingQuery::create(null, $criteria)
                    ->filterByProduct($this);
                $collFinishings = $query->find($con);
                if (null !== $criteria) {
                    return $collFinishings;
                }

                if ($partial && $this->collFinishings) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collFinishings as $obj) {
                        if (!$collFinishings->contains($obj)) {
                            $collFinishings[] = $obj;
                        }
                    }
                }

                $this->collFinishings = $collFinishings;
                $this->collFinishingsPartial = false;
            }
        }

        return $this->collFinishings;
    }

    /**
     * Sets a collection of Finishing objects related by a many-to-many relationship
     * to the current object by way of the product_finishing cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $finishings A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildProduct The current object (for fluent API support)
     */
    public function setFinishings(Collection $finishings, ConnectionInterface $con = null)
    {
        $this->clearFinishings();
        $currentFinishings = $this->getFinishings();

        $finishingsScheduledForDeletion = $currentFinishings->diff($finishings);

        foreach ($finishingsScheduledForDeletion as $toDelete) {
            $this->removeFinishing($toDelete);
        }

        foreach ($finishings as $finishing) {
            if (!$currentFinishings->contains($finishing)) {
                $this->doAddFinishing($finishing);
            }
        }

        $this->collFinishingsPartial = false;
        $this->collFinishings = $finishings;

        return $this;
    }

    /**
     * Gets the number of Finishing objects related by a many-to-many relationship
     * to the current object by way of the product_finishing cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Finishing objects
     */
    public function countFinishings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFinishingsPartial && !$this->isNew();
        if (null === $this->collFinishings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFinishings) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getFinishings());
                }

                $query = ChildFinishingQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByProduct($this)
                    ->count($con);
            }
        } else {
            return count($this->collFinishings);
        }
    }

    /**
     * Associate a ChildFinishing to this object
     * through the product_finishing cross reference table.
     *
     * @param ChildFinishing $finishing
     * @return ChildProduct The current object (for fluent API support)
     */
    public function addFinishing(ChildFinishing $finishing)
    {
        if ($this->collFinishings === null) {
            $this->initFinishings();
        }

        if (!$this->getFinishings()->contains($finishing)) {
            // only add it if the **same** object is not already associated
            $this->collFinishings->push($finishing);
            $this->doAddFinishing($finishing);
        }

        return $this;
    }

    /**
     *
     * @param ChildFinishing $finishing
     */
    protected function doAddFinishing(ChildFinishing $finishing)
    {
        $productFinishing = new ChildProductFinishing();

        $productFinishing->setFinishing($finishing);

        $productFinishing->setProduct($this);

        $this->addProductFinishing($productFinishing);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$finishing->isProductsLoaded()) {
            $finishing->initProducts();
            $finishing->getProducts()->push($this);
        } elseif (!$finishing->getProducts()->contains($this)) {
            $finishing->getProducts()->push($this);
        }

    }

    /**
     * Remove finishing of this object
     * through the product_finishing cross reference table.
     *
     * @param ChildFinishing $finishing
     * @return ChildProduct The current object (for fluent API support)
     */
    public function removeFinishing(ChildFinishing $finishing)
    {
        if ($this->getFinishings()->contains($finishing)) {
            $productFinishing = new ChildProductFinishing();
            $productFinishing->setFinishing($finishing);
            if ($finishing->isProductsLoaded()) {
                //remove the back reference if available
                $finishing->getProducts()->removeObject($this);
            }

            $productFinishing->setProduct($this);
            $this->removeProductFinishing(clone $productFinishing);
            $productFinishing->clear();

            $this->collFinishings->remove($this->collFinishings->search($finishing));

            if (null === $this->finishingsScheduledForDeletion) {
                $this->finishingsScheduledForDeletion = clone $this->collFinishings;
                $this->finishingsScheduledForDeletion->clear();
            }

            $this->finishingsScheduledForDeletion->push($finishing);
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
        if (null !== $this->aMaterial) {
            $this->aMaterial->removeProduct($this);
        }
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->is_round = null;
        $this->is_kdn = null;
        $this->is_flegt = null;
        $this->has_component = null;
        $this->qty_per_pack = null;
        $this->list_price = null;
        $this->material_id = null;
        $this->note = null;
        $this->cubic_asb = null;
        $this->cubic_kdn = null;
        $this->width_asb = null;
        $this->height_asb = null;
        $this->depth_asb = null;
        $this->width_kdn = null;
        $this->height_kdn = null;
        $this->depth_kdn = null;
        $this->net_cubic = null;
        $this->net_weight = null;
        $this->gross_weight = null;
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
            if ($this->collProductPartners) {
                foreach ($this->collProductPartners as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductFinishings) {
                foreach ($this->collProductFinishings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProductImages) {
                foreach ($this->collProductImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProformaInvoiceLines) {
                foreach ($this->collProformaInvoiceLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPurchaseOrderLines) {
                foreach ($this->collPurchaseOrderLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collFinishings) {
                foreach ($this->collFinishings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collProductComponents = null;
        $this->collProductPartners = null;
        $this->collProductFinishings = null;
        $this->collProductImages = null;
        $this->collProformaInvoiceLines = null;
        $this->collPurchaseOrderLines = null;
        $this->collFinishings = null;
        $this->aMaterial = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductTableMap::DEFAULT_STRING_FORMAT);
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
