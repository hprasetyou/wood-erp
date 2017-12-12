<?php

namespace Map;

use \ProformaInvoice;
use \ProformaInvoiceQuery;
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
 * This class defines the structure of the 'proforma_invoice' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProformaInvoiceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProformaInvoiceTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'proforma_invoice';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ProformaInvoice';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ProformaInvoice';

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
    const COL_ID = 'proforma_invoice.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'proforma_invoice.name';

    /**
     * the column name for the currency_id field
     */
    const COL_CURRENCY_ID = 'proforma_invoice.currency_id';

    /**
     * the column name for the customer_id field
     */
    const COL_CUSTOMER_ID = 'proforma_invoice.customer_id';

    /**
     * the column name for the date field
     */
    const COL_DATE = 'proforma_invoice.date';

    /**
     * the column name for the confirm_date field
     */
    const COL_CONFIRM_DATE = 'proforma_invoice.confirm_date';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'proforma_invoice.description';

    /**
     * the column name for the total_cubic_dimension field
     */
    const COL_TOTAL_CUBIC_DIMENSION = 'proforma_invoice.total_cubic_dimension';

    /**
     * the column name for the total_price field
     */
    const COL_TOTAL_PRICE = 'proforma_invoice.total_price';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'proforma_invoice.state';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'proforma_invoice.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'proforma_invoice.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'CurrencyId', 'CustomerId', 'Date', 'ConfirmDate', 'Description', 'TotalCubicDimension', 'TotalPrice', 'State', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'currencyId', 'customerId', 'date', 'confirmDate', 'description', 'totalCubicDimension', 'totalPrice', 'state', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProformaInvoiceTableMap::COL_ID, ProformaInvoiceTableMap::COL_NAME, ProformaInvoiceTableMap::COL_CURRENCY_ID, ProformaInvoiceTableMap::COL_CUSTOMER_ID, ProformaInvoiceTableMap::COL_DATE, ProformaInvoiceTableMap::COL_CONFIRM_DATE, ProformaInvoiceTableMap::COL_DESCRIPTION, ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION, ProformaInvoiceTableMap::COL_TOTAL_PRICE, ProformaInvoiceTableMap::COL_STATE, ProformaInvoiceTableMap::COL_CREATED_AT, ProformaInvoiceTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'currency_id', 'customer_id', 'date', 'confirm_date', 'description', 'total_cubic_dimension', 'total_price', 'state', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'CurrencyId' => 2, 'CustomerId' => 3, 'Date' => 4, 'ConfirmDate' => 5, 'Description' => 6, 'TotalCubicDimension' => 7, 'TotalPrice' => 8, 'State' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'currencyId' => 2, 'customerId' => 3, 'date' => 4, 'confirmDate' => 5, 'description' => 6, 'totalCubicDimension' => 7, 'totalPrice' => 8, 'state' => 9, 'createdAt' => 10, 'updatedAt' => 11, ),
        self::TYPE_COLNAME       => array(ProformaInvoiceTableMap::COL_ID => 0, ProformaInvoiceTableMap::COL_NAME => 1, ProformaInvoiceTableMap::COL_CURRENCY_ID => 2, ProformaInvoiceTableMap::COL_CUSTOMER_ID => 3, ProformaInvoiceTableMap::COL_DATE => 4, ProformaInvoiceTableMap::COL_CONFIRM_DATE => 5, ProformaInvoiceTableMap::COL_DESCRIPTION => 6, ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION => 7, ProformaInvoiceTableMap::COL_TOTAL_PRICE => 8, ProformaInvoiceTableMap::COL_STATE => 9, ProformaInvoiceTableMap::COL_CREATED_AT => 10, ProformaInvoiceTableMap::COL_UPDATED_AT => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'currency_id' => 2, 'customer_id' => 3, 'date' => 4, 'confirm_date' => 5, 'description' => 6, 'total_cubic_dimension' => 7, 'total_price' => 8, 'state' => 9, 'created_at' => 10, 'updated_at' => 11, ),
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
        $this->setName('proforma_invoice');
        $this->setPhpName('ProformaInvoice');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ProformaInvoice');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addForeignKey('currency_id', 'CurrencyId', 'INTEGER', 'currency', 'id', true, null, 1);
        $this->addForeignKey('customer_id', 'CustomerId', 'INTEGER', 'partner', 'id', true, null, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('confirm_date', 'ConfirmDate', 'DATE', false, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('total_cubic_dimension', 'TotalCubicDimension', 'FLOAT', false, null, null);
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
        $this->addRelation('Partner', '\\Partner', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':customer_id',
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
        $this->addRelation('ProformaInvoiceLine', '\\ProformaInvoiceLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':proforma_invoice_id',
    1 => ':id',
  ),
), null, null, 'ProformaInvoiceLines', false);
        $this->addRelation('PurchaseOrder', '\\PurchaseOrder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':proforma_invoice_id',
    1 => ':id',
  ),
), null, null, 'PurchaseOrders', false);
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
        return $withPrefix ? ProformaInvoiceTableMap::CLASS_DEFAULT : ProformaInvoiceTableMap::OM_CLASS;
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
     * @return array           (ProformaInvoice object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProformaInvoiceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProformaInvoiceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProformaInvoiceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProformaInvoiceTableMap::OM_CLASS;
            /** @var ProformaInvoice $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProformaInvoiceTableMap::addInstanceToPool($obj, $key);
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
            $key = ProformaInvoiceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProformaInvoiceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProformaInvoice $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProformaInvoiceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_ID);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_NAME);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_CURRENCY_ID);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_CUSTOMER_ID);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_DATE);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_CONFIRM_DATE);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_TOTAL_PRICE);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_STATE);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProformaInvoiceTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.currency_id');
            $criteria->addSelectColumn($alias . '.customer_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.confirm_date');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.total_cubic_dimension');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProformaInvoiceTableMap::DATABASE_NAME)->getTable(ProformaInvoiceTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProformaInvoiceTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProformaInvoiceTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProformaInvoiceTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ProformaInvoice or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ProformaInvoice object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ProformaInvoice) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProformaInvoiceTableMap::DATABASE_NAME);
            $criteria->add(ProformaInvoiceTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProformaInvoiceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProformaInvoiceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProformaInvoiceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the proforma_invoice table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProformaInvoiceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProformaInvoice or Criteria object.
     *
     * @param mixed               $criteria Criteria or ProformaInvoice object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProformaInvoice object
        }

        if ($criteria->containsKey(ProformaInvoiceTableMap::COL_ID) && $criteria->keyContainsValue(ProformaInvoiceTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProformaInvoiceTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProformaInvoiceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProformaInvoiceTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProformaInvoiceTableMap::buildTableMap();
