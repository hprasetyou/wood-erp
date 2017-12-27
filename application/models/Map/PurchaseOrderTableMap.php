<?php

namespace Map;

use \PurchaseOrder;
use \PurchaseOrderQuery;
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
 * This class defines the structure of the 'purchase_order' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PurchaseOrderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PurchaseOrderTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'purchase_order';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PurchaseOrder';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PurchaseOrder';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'purchase_order.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'purchase_order.name';

    /**
     * the column name for the proforma_invoice_id field
     */
    const COL_PROFORMA_INVOICE_ID = 'purchase_order.proforma_invoice_id';

    /**
     * the column name for the packing_list_id field
     */
    const COL_PACKING_LIST_ID = 'purchase_order.packing_list_id';

    /**
     * the column name for the supplier_id field
     */
    const COL_SUPPLIER_ID = 'purchase_order.supplier_id';

    /**
     * the column name for the currency_id field
     */
    const COL_CURRENCY_ID = 'purchase_order.currency_id';

    /**
     * the column name for the note field
     */
    const COL_NOTE = 'purchase_order.note';

    /**
     * the column name for the date field
     */
    const COL_DATE = 'purchase_order.date';

    /**
     * the column name for the payment_term field
     */
    const COL_PAYMENT_TERM = 'purchase_order.payment_term';

    /**
     * the column name for the down_payment_id field
     */
    const COL_DOWN_PAYMENT_ID = 'purchase_order.down_payment_id';

    /**
     * the column name for the down_payment_amount field
     */
    const COL_DOWN_PAYMENT_AMOUNT = 'purchase_order.down_payment_amount';

    /**
     * the column name for the down_payment_deadline field
     */
    const COL_DOWN_PAYMENT_DEADLINE = 'purchase_order.down_payment_deadline';

    /**
     * the column name for the total_price field
     */
    const COL_TOTAL_PRICE = 'purchase_order.total_price';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'purchase_order.state';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'purchase_order.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'purchase_order.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'ProformaInvoiceId', 'PackingListId', 'SupplierId', 'CurrencyId', 'Note', 'Date', 'PaymentTerm', 'DownPaymentId', 'DownPaymentAmount', 'DownPaymentDeadline', 'TotalPrice', 'State', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'proformaInvoiceId', 'packingListId', 'supplierId', 'currencyId', 'note', 'date', 'paymentTerm', 'downPaymentId', 'downPaymentAmount', 'downPaymentDeadline', 'totalPrice', 'state', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PurchaseOrderTableMap::COL_ID, PurchaseOrderTableMap::COL_NAME, PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, PurchaseOrderTableMap::COL_PACKING_LIST_ID, PurchaseOrderTableMap::COL_SUPPLIER_ID, PurchaseOrderTableMap::COL_CURRENCY_ID, PurchaseOrderTableMap::COL_NOTE, PurchaseOrderTableMap::COL_DATE, PurchaseOrderTableMap::COL_PAYMENT_TERM, PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID, PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT, PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE, PurchaseOrderTableMap::COL_TOTAL_PRICE, PurchaseOrderTableMap::COL_STATE, PurchaseOrderTableMap::COL_CREATED_AT, PurchaseOrderTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'proforma_invoice_id', 'packing_list_id', 'supplier_id', 'currency_id', 'note', 'date', 'payment_term', 'down_payment_id', 'down_payment_amount', 'down_payment_deadline', 'total_price', 'state', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'ProformaInvoiceId' => 2, 'PackingListId' => 3, 'SupplierId' => 4, 'CurrencyId' => 5, 'Note' => 6, 'Date' => 7, 'PaymentTerm' => 8, 'DownPaymentId' => 9, 'DownPaymentAmount' => 10, 'DownPaymentDeadline' => 11, 'TotalPrice' => 12, 'State' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'proformaInvoiceId' => 2, 'packingListId' => 3, 'supplierId' => 4, 'currencyId' => 5, 'note' => 6, 'date' => 7, 'paymentTerm' => 8, 'downPaymentId' => 9, 'downPaymentAmount' => 10, 'downPaymentDeadline' => 11, 'totalPrice' => 12, 'state' => 13, 'createdAt' => 14, 'updatedAt' => 15, ),
        self::TYPE_COLNAME       => array(PurchaseOrderTableMap::COL_ID => 0, PurchaseOrderTableMap::COL_NAME => 1, PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID => 2, PurchaseOrderTableMap::COL_PACKING_LIST_ID => 3, PurchaseOrderTableMap::COL_SUPPLIER_ID => 4, PurchaseOrderTableMap::COL_CURRENCY_ID => 5, PurchaseOrderTableMap::COL_NOTE => 6, PurchaseOrderTableMap::COL_DATE => 7, PurchaseOrderTableMap::COL_PAYMENT_TERM => 8, PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID => 9, PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT => 10, PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE => 11, PurchaseOrderTableMap::COL_TOTAL_PRICE => 12, PurchaseOrderTableMap::COL_STATE => 13, PurchaseOrderTableMap::COL_CREATED_AT => 14, PurchaseOrderTableMap::COL_UPDATED_AT => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'proforma_invoice_id' => 2, 'packing_list_id' => 3, 'supplier_id' => 4, 'currency_id' => 5, 'note' => 6, 'date' => 7, 'payment_term' => 8, 'down_payment_id' => 9, 'down_payment_amount' => 10, 'down_payment_deadline' => 11, 'total_price' => 12, 'state' => 13, 'created_at' => 14, 'updated_at' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('purchase_order');
        $this->setPhpName('PurchaseOrder');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PurchaseOrder');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addForeignKey('proforma_invoice_id', 'ProformaInvoiceId', 'INTEGER', 'proforma_invoice', 'id', false, null, null);
        $this->addColumn('packing_list_id', 'PackingListId', 'INTEGER', false, null, null);
        $this->addForeignKey('supplier_id', 'SupplierId', 'INTEGER', 'partner', 'id', true, null, null);
        $this->addForeignKey('currency_id', 'CurrencyId', 'INTEGER', 'currency', 'id', true, null, 1);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, null, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('payment_term', 'PaymentTerm', 'VARCHAR', false, 255, null);
        $this->addForeignKey('down_payment_id', 'DownPaymentId', 'INTEGER', 'down_payment', 'id', false, null, null);
        $this->addColumn('down_payment_amount', 'DownPaymentAmount', 'FLOAT', false, null, null);
        $this->addColumn('down_payment_deadline', 'DownPaymentDeadline', 'DATE', false, null, null);
        $this->addColumn('total_price', 'TotalPrice', 'FLOAT', false, null, null);
        $this->addColumn('state', 'State', 'CHAR', false, null, 'draft');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ProformaInvoice', '\\ProformaInvoice', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':proforma_invoice_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('DownPayment', '\\DownPayment', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':down_payment_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Currency', '\\Currency', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':currency_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Supplier', '\\Partner', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':supplier_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('PurchaseOrderLine', '\\PurchaseOrderLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':purchase_order_id',
    1 => ':id',
  ),
), null, null, 'PurchaseOrderLines', false);
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
        return $withPrefix ? PurchaseOrderTableMap::CLASS_DEFAULT : PurchaseOrderTableMap::OM_CLASS;
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
     * @return array           (PurchaseOrder object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PurchaseOrderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PurchaseOrderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PurchaseOrderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PurchaseOrderTableMap::OM_CLASS;
            /** @var PurchaseOrder $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PurchaseOrderTableMap::addInstanceToPool($obj, $key);
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
            $key = PurchaseOrderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PurchaseOrderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PurchaseOrder $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PurchaseOrderTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_ID);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_NAME);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_PACKING_LIST_ID);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_SUPPLIER_ID);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_CURRENCY_ID);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_NOTE);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_DATE);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_PAYMENT_TERM);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_DOWN_PAYMENT_ID);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_DOWN_PAYMENT_AMOUNT);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_TOTAL_PRICE);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_STATE);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PurchaseOrderTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.proforma_invoice_id');
            $criteria->addSelectColumn($alias . '.packing_list_id');
            $criteria->addSelectColumn($alias . '.supplier_id');
            $criteria->addSelectColumn($alias . '.currency_id');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.payment_term');
            $criteria->addSelectColumn($alias . '.down_payment_id');
            $criteria->addSelectColumn($alias . '.down_payment_amount');
            $criteria->addSelectColumn($alias . '.down_payment_deadline');
            $criteria->addSelectColumn($alias . '.total_price');
            $criteria->addSelectColumn($alias . '.state');
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
        return Propel::getServiceContainer()->getDatabaseMap(PurchaseOrderTableMap::DATABASE_NAME)->getTable(PurchaseOrderTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PurchaseOrderTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PurchaseOrderTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PurchaseOrderTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PurchaseOrder or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PurchaseOrder object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PurchaseOrder) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PurchaseOrderTableMap::DATABASE_NAME);
            $criteria->add(PurchaseOrderTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PurchaseOrderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PurchaseOrderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PurchaseOrderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the purchase_order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PurchaseOrderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PurchaseOrder or Criteria object.
     *
     * @param mixed               $criteria Criteria or PurchaseOrder object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PurchaseOrder object
        }

        if ($criteria->containsKey(PurchaseOrderTableMap::COL_ID) && $criteria->keyContainsValue(PurchaseOrderTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PurchaseOrderTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PurchaseOrderQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PurchaseOrderTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PurchaseOrderTableMap::buildTableMap();
