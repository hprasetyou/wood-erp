<?php

namespace Map;

use \PackingListLine;
use \PackingListLineQuery;
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
 * This class defines the structure of the 'packing_list_line' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PackingListLineTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PackingListLineTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'packing_list_line';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PackingListLine';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PackingListLine';

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
    const COL_ID = 'packing_list_line.id';

    /**
     * the column name for the packing_list_id field
     */
    const COL_PACKING_LIST_ID = 'packing_list_line.packing_list_id';

    /**
     * the column name for the proforma_invoice_line_id field
     */
    const COL_PROFORMA_INVOICE_LINE_ID = 'packing_list_line.proforma_invoice_line_id';

    /**
     * the column name for the net_weight field
     */
    const COL_NET_WEIGHT = 'packing_list_line.net_weight';

    /**
     * the column name for the gross_weight field
     */
    const COL_GROSS_WEIGHT = 'packing_list_line.gross_weight';

    /**
     * the column name for the qty field
     */
    const COL_QTY = 'packing_list_line.qty';

    /**
     * the column name for the qty_of_pack field
     */
    const COL_QTY_OF_PACK = 'packing_list_line.qty_of_pack';

    /**
     * the column name for the cubic_dimension field
     */
    const COL_CUBIC_DIMENSION = 'packing_list_line.cubic_dimension';

    /**
     * the column name for the total_cubic_dimension field
     */
    const COL_TOTAL_CUBIC_DIMENSION = 'packing_list_line.total_cubic_dimension';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'packing_list_line.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'packing_list_line.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'packing_list_line.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'PackingListId', 'ProformaInvoiceLineId', 'NetWeight', 'GrossWeight', 'Qty', 'QtyOfPack', 'CubicDimension', 'TotalCubicDimension', 'Active', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'packingListId', 'proformaInvoiceLineId', 'netWeight', 'grossWeight', 'qty', 'qtyOfPack', 'cubicDimension', 'totalCubicDimension', 'active', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PackingListLineTableMap::COL_ID, PackingListLineTableMap::COL_PACKING_LIST_ID, PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, PackingListLineTableMap::COL_NET_WEIGHT, PackingListLineTableMap::COL_GROSS_WEIGHT, PackingListLineTableMap::COL_QTY, PackingListLineTableMap::COL_QTY_OF_PACK, PackingListLineTableMap::COL_CUBIC_DIMENSION, PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION, PackingListLineTableMap::COL_ACTIVE, PackingListLineTableMap::COL_CREATED_AT, PackingListLineTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'packing_list_id', 'proforma_invoice_line_id', 'net_weight', 'gross_weight', 'qty', 'qty_of_pack', 'cubic_dimension', 'total_cubic_dimension', 'active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'PackingListId' => 1, 'ProformaInvoiceLineId' => 2, 'NetWeight' => 3, 'GrossWeight' => 4, 'Qty' => 5, 'QtyOfPack' => 6, 'CubicDimension' => 7, 'TotalCubicDimension' => 8, 'Active' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'packingListId' => 1, 'proformaInvoiceLineId' => 2, 'netWeight' => 3, 'grossWeight' => 4, 'qty' => 5, 'qtyOfPack' => 6, 'cubicDimension' => 7, 'totalCubicDimension' => 8, 'active' => 9, 'createdAt' => 10, 'updatedAt' => 11, ),
        self::TYPE_COLNAME       => array(PackingListLineTableMap::COL_ID => 0, PackingListLineTableMap::COL_PACKING_LIST_ID => 1, PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID => 2, PackingListLineTableMap::COL_NET_WEIGHT => 3, PackingListLineTableMap::COL_GROSS_WEIGHT => 4, PackingListLineTableMap::COL_QTY => 5, PackingListLineTableMap::COL_QTY_OF_PACK => 6, PackingListLineTableMap::COL_CUBIC_DIMENSION => 7, PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION => 8, PackingListLineTableMap::COL_ACTIVE => 9, PackingListLineTableMap::COL_CREATED_AT => 10, PackingListLineTableMap::COL_UPDATED_AT => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'packing_list_id' => 1, 'proforma_invoice_line_id' => 2, 'net_weight' => 3, 'gross_weight' => 4, 'qty' => 5, 'qty_of_pack' => 6, 'cubic_dimension' => 7, 'total_cubic_dimension' => 8, 'active' => 9, 'created_at' => 10, 'updated_at' => 11, ),
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
        $this->setName('packing_list_line');
        $this->setPhpName('PackingListLine');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PackingListLine');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('packing_list_id', 'PackingListId', 'INTEGER', 'packing_list', 'id', true, null, null);
        $this->addForeignKey('proforma_invoice_line_id', 'ProformaInvoiceLineId', 'INTEGER', 'proforma_invoice_line', 'id', true, null, null);
        $this->addColumn('net_weight', 'NetWeight', 'FLOAT', false, null, null);
        $this->addColumn('gross_weight', 'GrossWeight', 'FLOAT', false, null, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, null, null);
        $this->addColumn('qty_of_pack', 'QtyOfPack', 'INTEGER', false, null, null);
        $this->addColumn('cubic_dimension', 'CubicDimension', 'FLOAT', false, null, null);
        $this->addColumn('total_cubic_dimension', 'TotalCubicDimension', 'FLOAT', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PackingList', '\\PackingList', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':packing_list_id',
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
        return $withPrefix ? PackingListLineTableMap::CLASS_DEFAULT : PackingListLineTableMap::OM_CLASS;
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
     * @return array           (PackingListLine object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PackingListLineTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PackingListLineTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PackingListLineTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PackingListLineTableMap::OM_CLASS;
            /** @var PackingListLine $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PackingListLineTableMap::addInstanceToPool($obj, $key);
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
            $key = PackingListLineTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PackingListLineTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PackingListLine $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PackingListLineTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PackingListLineTableMap::COL_ID);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_PACKING_LIST_ID);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_NET_WEIGHT);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_GROSS_WEIGHT);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_QTY);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_QTY_OF_PACK);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_CUBIC_DIMENSION);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_TOTAL_CUBIC_DIMENSION);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PackingListLineTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.packing_list_id');
            $criteria->addSelectColumn($alias . '.proforma_invoice_line_id');
            $criteria->addSelectColumn($alias . '.net_weight');
            $criteria->addSelectColumn($alias . '.gross_weight');
            $criteria->addSelectColumn($alias . '.qty');
            $criteria->addSelectColumn($alias . '.qty_of_pack');
            $criteria->addSelectColumn($alias . '.cubic_dimension');
            $criteria->addSelectColumn($alias . '.total_cubic_dimension');
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
        return Propel::getServiceContainer()->getDatabaseMap(PackingListLineTableMap::DATABASE_NAME)->getTable(PackingListLineTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PackingListLineTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PackingListLineTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PackingListLineTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PackingListLine or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PackingListLine object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PackingListLine) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PackingListLineTableMap::DATABASE_NAME);
            $criteria->add(PackingListLineTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PackingListLineQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PackingListLineTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PackingListLineTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the packing_list_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PackingListLineQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PackingListLine or Criteria object.
     *
     * @param mixed               $criteria Criteria or PackingListLine object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PackingListLine object
        }

        if ($criteria->containsKey(PackingListLineTableMap::COL_ID) && $criteria->keyContainsValue(PackingListLineTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PackingListLineTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PackingListLineQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PackingListLineTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PackingListLineTableMap::buildTableMap();
