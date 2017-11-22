<?php

namespace Map;

use \ProformaInvoiceLine;
use \ProformaInvoiceLineQuery;
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
 * This class defines the structure of the 'proforma_invoice_line' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProformaInvoiceLineTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProformaInvoiceLineTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'proforma_invoice_line';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ProformaInvoiceLine';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ProformaInvoiceLine';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id field
     */
    const COL_ID = 'proforma_invoice_line.id';

    /**
     * the column name for the proforma_invoice_id field
     */
    const COL_PROFORMA_INVOICE_ID = 'proforma_invoice_line.proforma_invoice_id';

    /**
     * the column name for the product_customer_id field
     */
    const COL_PRODUCT_CUSTOMER_ID = 'proforma_invoice_line.product_customer_id';

    /**
     * the column name for the product_finishing field
     */
    const COL_PRODUCT_FINISHING = 'proforma_invoice_line.product_finishing';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'proforma_invoice_line.description';

    /**
     * the column name for the qty field
     */
    const COL_QTY = 'proforma_invoice_line.qty';

    /**
     * the column name for the qty_per_pack field
     */
    const COL_QTY_PER_PACK = 'proforma_invoice_line.qty_per_pack';

    /**
     * the column name for the cubic_dimension field
     */
    const COL_CUBIC_DIMENSION = 'proforma_invoice_line.cubic_dimension';

    /**
     * the column name for the total_cubic_dimension field
     */
    const COL_TOTAL_CUBIC_DIMENSION = 'proforma_invoice_line.total_cubic_dimension';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'proforma_invoice_line.price';

    /**
     * the column name for the total_price field
     */
    const COL_TOTAL_PRICE = 'proforma_invoice_line.total_price';

    /**
     * the column name for the is_sample field
     */
    const COL_IS_SAMPLE = 'proforma_invoice_line.is_sample';

    /**
     * the column name for the is_need_box field
     */
    const COL_IS_NEED_BOX = 'proforma_invoice_line.is_need_box';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'proforma_invoice_line.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'proforma_invoice_line.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'ProformaInvoiceId', 'ProductCustomerId', 'ProductFinishing', 'Description', 'Qty', 'QtyPerPack', 'CubicDimension', 'TotalCubicDimension', 'Price', 'TotalPrice', 'IsSample', 'IsNeedBox', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'proformaInvoiceId', 'productCustomerId', 'productFinishing', 'description', 'qty', 'qtyPerPack', 'cubicDimension', 'totalCubicDimension', 'price', 'totalPrice', 'isSample', 'isNeedBox', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProformaInvoiceLineTableMap::COL_ID, ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID, ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID, ProformaInvoiceLineTableMap::COL_PRODUCT_FINISHING, ProformaInvoiceLineTableMap::COL_DESCRIPTION, ProformaInvoiceLineTableMap::COL_QTY, ProformaInvoiceLineTableMap::COL_QTY_PER_PACK, ProformaInvoiceLineTableMap::COL_CUBIC_DIMENSION, ProformaInvoiceLineTableMap::COL_TOTAL_CUBIC_DIMENSION, ProformaInvoiceLineTableMap::COL_PRICE, ProformaInvoiceLineTableMap::COL_TOTAL_PRICE, ProformaInvoiceLineTableMap::COL_IS_SAMPLE, ProformaInvoiceLineTableMap::COL_IS_NEED_BOX, ProformaInvoiceLineTableMap::COL_CREATED_AT, ProformaInvoiceLineTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'proforma_invoice_id', 'product_customer_id', 'product_finishing', 'description', 'qty', 'qty_per_pack', 'cubic_dimension', 'total_cubic_dimension', 'price', 'total_price', 'is_sample', 'is_need_box', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ProformaInvoiceId' => 1, 'ProductCustomerId' => 2, 'ProductFinishing' => 3, 'Description' => 4, 'Qty' => 5, 'QtyPerPack' => 6, 'CubicDimension' => 7, 'TotalCubicDimension' => 8, 'Price' => 9, 'TotalPrice' => 10, 'IsSample' => 11, 'IsNeedBox' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'proformaInvoiceId' => 1, 'productCustomerId' => 2, 'productFinishing' => 3, 'description' => 4, 'qty' => 5, 'qtyPerPack' => 6, 'cubicDimension' => 7, 'totalCubicDimension' => 8, 'price' => 9, 'totalPrice' => 10, 'isSample' => 11, 'isNeedBox' => 12, 'createdAt' => 13, 'updatedAt' => 14, ),
        self::TYPE_COLNAME       => array(ProformaInvoiceLineTableMap::COL_ID => 0, ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID => 1, ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID => 2, ProformaInvoiceLineTableMap::COL_PRODUCT_FINISHING => 3, ProformaInvoiceLineTableMap::COL_DESCRIPTION => 4, ProformaInvoiceLineTableMap::COL_QTY => 5, ProformaInvoiceLineTableMap::COL_QTY_PER_PACK => 6, ProformaInvoiceLineTableMap::COL_CUBIC_DIMENSION => 7, ProformaInvoiceLineTableMap::COL_TOTAL_CUBIC_DIMENSION => 8, ProformaInvoiceLineTableMap::COL_PRICE => 9, ProformaInvoiceLineTableMap::COL_TOTAL_PRICE => 10, ProformaInvoiceLineTableMap::COL_IS_SAMPLE => 11, ProformaInvoiceLineTableMap::COL_IS_NEED_BOX => 12, ProformaInvoiceLineTableMap::COL_CREATED_AT => 13, ProformaInvoiceLineTableMap::COL_UPDATED_AT => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'proforma_invoice_id' => 1, 'product_customer_id' => 2, 'product_finishing' => 3, 'description' => 4, 'qty' => 5, 'qty_per_pack' => 6, 'cubic_dimension' => 7, 'total_cubic_dimension' => 8, 'price' => 9, 'total_price' => 10, 'is_sample' => 11, 'is_need_box' => 12, 'created_at' => 13, 'updated_at' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('proforma_invoice_line');
        $this->setPhpName('ProformaInvoiceLine');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ProformaInvoiceLine');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('proforma_invoice_id', 'ProformaInvoiceId', 'INTEGER', 'proforma_invoice', 'id', true, null, null);
        $this->addForeignKey('product_customer_id', 'ProductCustomerId', 'INTEGER', 'product_customer', 'id', true, null, null);
        $this->addColumn('product_finishing', 'ProductFinishing', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, null, null);
        $this->addColumn('qty_per_pack', 'QtyPerPack', 'INTEGER', false, null, null);
        $this->addColumn('cubic_dimension', 'CubicDimension', 'FLOAT', false, null, null);
        $this->addColumn('total_cubic_dimension', 'TotalCubicDimension', 'FLOAT', false, null, null);
        $this->addColumn('price', 'Price', 'FLOAT', false, null, null);
        $this->addColumn('total_price', 'TotalPrice', 'FLOAT', false, null, null);
        $this->addColumn('is_sample', 'IsSample', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_need_box', 'IsNeedBox', 'BOOLEAN', true, 1, false);
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
        $this->addRelation('ProductCustomer', '\\ProductCustomer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_customer_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('PackingListLine', '\\PackingListLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':proforma_invoice_line_id',
    1 => ':id',
  ),
), null, null, 'PackingListLines', false);
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
        return $withPrefix ? ProformaInvoiceLineTableMap::CLASS_DEFAULT : ProformaInvoiceLineTableMap::OM_CLASS;
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
     * @return array           (ProformaInvoiceLine object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProformaInvoiceLineTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProformaInvoiceLineTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProformaInvoiceLineTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProformaInvoiceLineTableMap::OM_CLASS;
            /** @var ProformaInvoiceLine $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProformaInvoiceLineTableMap::addInstanceToPool($obj, $key);
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
            $key = ProformaInvoiceLineTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProformaInvoiceLineTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ProformaInvoiceLine $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProformaInvoiceLineTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_ID);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_PRODUCT_FINISHING);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_QTY);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_QTY_PER_PACK);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_CUBIC_DIMENSION);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_TOTAL_CUBIC_DIMENSION);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_PRICE);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_TOTAL_PRICE);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_IS_SAMPLE);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_IS_NEED_BOX);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProformaInvoiceLineTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.proforma_invoice_id');
            $criteria->addSelectColumn($alias . '.product_customer_id');
            $criteria->addSelectColumn($alias . '.product_finishing');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.qty_per_pack');
            $criteria->addSelectColumn($alias . '.cubic_dimension');
            $criteria->addSelectColumn($alias . '.total_cubic_dimension');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.total_price');
            $criteria->addSelectColumn($alias . '.is_sample');
            $criteria->addSelectColumn($alias . '.is_need_box');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProformaInvoiceLineTableMap::DATABASE_NAME)->getTable(ProformaInvoiceLineTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProformaInvoiceLineTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProformaInvoiceLineTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProformaInvoiceLineTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ProformaInvoiceLine or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ProformaInvoiceLine object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceLineTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ProformaInvoiceLine) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProformaInvoiceLineTableMap::DATABASE_NAME);
            $criteria->add(ProformaInvoiceLineTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProformaInvoiceLineQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProformaInvoiceLineTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProformaInvoiceLineTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the proforma_invoice_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProformaInvoiceLineQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ProformaInvoiceLine or Criteria object.
     *
     * @param mixed               $criteria Criteria or ProformaInvoiceLine object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceLineTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ProformaInvoiceLine object
        }

        if ($criteria->containsKey(ProformaInvoiceLineTableMap::COL_ID) && $criteria->keyContainsValue(ProformaInvoiceLineTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProformaInvoiceLineTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProformaInvoiceLineQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProformaInvoiceLineTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProformaInvoiceLineTableMap::buildTableMap();
