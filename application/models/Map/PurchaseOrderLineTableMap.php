<?php

namespace Map;

use \PurchaseOrderLine;
use \PurchaseOrderLineQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'purchase_order_line' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PurchaseOrderLineTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PurchaseOrderLineTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'purchase_order_line';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PurchaseOrderLine';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PurchaseOrderLine';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    const COL_ID = 'purchase_order_line.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'purchase_order_line.name';

    /**
     * the column name for the purchase_order_id field
     */
    const COL_PURCHASE_ORDER_ID = 'purchase_order_line.purchase_order_id';

    /**
     * the column name for the proforma_invoice_line_id field
     */
    const COL_PROFORMA_INVOICE_LINE_ID = 'purchase_order_line.proforma_invoice_line_id';

    /**
     * the column name for the product_id field
     */
    const COL_PRODUCT_ID = 'purchase_order_line.product_id';

    /**
     * the column name for the note field
     */
    const COL_NOTE = 'purchase_order_line.note';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'purchase_order_line.price';

    /**
     * the column name for the total_price field
     */
    const COL_TOTAL_PRICE = 'purchase_order_line.total_price';

    /**
     * the column name for the qty field
     */
    const COL_QTY = 'purchase_order_line.qty';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'purchase_order_line.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'purchase_order_line.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'purchase_order_line.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Name', 'PurchaseOrderId', 'ProformaInvoiceLineId', 'ProductId', 'Note', 'Price', 'TotalPrice', 'Qty', 'Active', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'purchaseOrderId', 'proformaInvoiceLineId', 'productId', 'note', 'price', 'totalPrice', 'qty', 'active', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PurchaseOrderLineTableMap::COL_ID, PurchaseOrderLineTableMap::COL_NAME, PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID, PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, PurchaseOrderLineTableMap::COL_PRODUCT_ID, PurchaseOrderLineTableMap::COL_NOTE, PurchaseOrderLineTableMap::COL_PRICE, PurchaseOrderLineTableMap::COL_TOTAL_PRICE, PurchaseOrderLineTableMap::COL_QTY, PurchaseOrderLineTableMap::COL_ACTIVE, PurchaseOrderLineTableMap::COL_CREATED_AT, PurchaseOrderLineTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'purchase_order_id', 'proforma_invoice_line_id', 'product_id', 'note', 'price', 'total_price', 'qty', 'active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'PurchaseOrderId' => 2, 'ProformaInvoiceLineId' => 3, 'ProductId' => 4, 'Note' => 5, 'Price' => 6, 'TotalPrice' => 7, 'Qty' => 8, 'Active' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'purchaseOrderId' => 2, 'proformaInvoiceLineId' => 3, 'productId' => 4, 'note' => 5, 'price' => 6, 'totalPrice' => 7, 'qty' => 8, 'active' => 9, 'createdAt' => 10, 'updatedAt' => 11, ),
        self::TYPE_COLNAME       => array(PurchaseOrderLineTableMap::COL_ID => 0, PurchaseOrderLineTableMap::COL_NAME => 1, PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID => 2, PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID => 3, PurchaseOrderLineTableMap::COL_PRODUCT_ID => 4, PurchaseOrderLineTableMap::COL_NOTE => 5, PurchaseOrderLineTableMap::COL_PRICE => 6, PurchaseOrderLineTableMap::COL_TOTAL_PRICE => 7, PurchaseOrderLineTableMap::COL_QTY => 8, PurchaseOrderLineTableMap::COL_ACTIVE => 9, PurchaseOrderLineTableMap::COL_CREATED_AT => 10, PurchaseOrderLineTableMap::COL_UPDATED_AT => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'purchase_order_id' => 2, 'proforma_invoice_line_id' => 3, 'product_id' => 4, 'note' => 5, 'price' => 6, 'total_price' => 7, 'qty' => 8, 'active' => 9, 'created_at' => 10, 'updated_at' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('purchase_order_line');
        $this->setPhpName('PurchaseOrderLine');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PurchaseOrderLine');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addForeignKey('purchase_order_id', 'PurchaseOrderId', 'INTEGER', 'purchase_order', 'id', true, null, null);
        $this->addForeignKey('proforma_invoice_line_id', 'ProformaInvoiceLineId', 'INTEGER', 'proforma_invoice_line', 'id', false, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'id', true, null, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, null, null);
        $this->addColumn('price', 'Price', 'FLOAT', false, null, null);
        $this->addColumn('total_price', 'TotalPrice', 'FLOAT', false, null, null);
        $this->addColumn('qty', 'Qty', 'FLOAT', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PurchaseOrder', '\\PurchaseOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':purchase_order_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ProformaInvoiceLine', '\\ProformaInvoiceLine', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':proforma_invoice_line_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Product', '\\Product', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PurchaseOrderLineTableMap::CLASS_DEFAULT : PurchaseOrderLineTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (PurchaseOrderLine object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PurchaseOrderLineTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PurchaseOrderLineTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PurchaseOrderLineTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PurchaseOrderLineTableMap::OM_CLASS;
            /** @var PurchaseOrderLine $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PurchaseOrderLineTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PurchaseOrderLineTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PurchaseOrderLineTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PurchaseOrderLine $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PurchaseOrderLineTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_ID);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_NAME);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_NOTE);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_PRICE);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_TOTAL_PRICE);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_QTY);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PurchaseOrderLineTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.purchase_order_id');
            $criteria->addSelectColumn($alias . '.proforma_invoice_line_id');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.total_price');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PurchaseOrderLineTableMap::DATABASE_NAME)->getTable(PurchaseOrderLineTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PurchaseOrderLineTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PurchaseOrderLineTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PurchaseOrderLineTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PurchaseOrderLine or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PurchaseOrderLine object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderLineTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PurchaseOrderLine) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PurchaseOrderLineTableMap::DATABASE_NAME);
            $criteria->add(PurchaseOrderLineTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PurchaseOrderLineQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PurchaseOrderLineTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PurchaseOrderLineTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the purchase_order_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PurchaseOrderLineQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PurchaseOrderLine or Criteria object.
     *
     * @param mixed               $criteria Criteria or PurchaseOrderLine object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderLineTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PurchaseOrderLine object
        }

        if ($criteria->containsKey(PurchaseOrderLineTableMap::COL_ID) && $criteria->keyContainsValue(PurchaseOrderLineTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PurchaseOrderLineTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PurchaseOrderLineQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PurchaseOrderLineTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PurchaseOrderLineTableMap::buildTableMap();
