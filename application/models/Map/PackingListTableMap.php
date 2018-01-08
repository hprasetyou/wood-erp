<?php

namespace Map;

use \PackingList;
use \PackingListQuery;
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
 * This class defines the structure of the 'packing_list' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PackingListTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PackingListTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'packing_list';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PackingList';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PackingList';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 22;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 22;

    /**
     * the column name for the id field
     */
    const COL_ID = 'packing_list.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'packing_list.name';

    /**
     * the column name for the date field
     */
    const COL_DATE = 'packing_list.date';

    /**
     * the column name for the loading_date field
     */
    const COL_LOADING_DATE = 'packing_list.loading_date';

    /**
     * the column name for the customer_id field
     */
    const COL_CUSTOMER_ID = 'packing_list.customer_id';

    /**
     * the column name for the ocean_vessel field
     */
    const COL_OCEAN_VESSEL = 'packing_list.ocean_vessel';

    /**
     * the column name for the bl_no field
     */
    const COL_BL_NO = 'packing_list.bl_no';

    /**
     * the column name for the goods_description field
     */
    const COL_GOODS_DESCRIPTION = 'packing_list.goods_description';

    /**
     * the column name for the cntr_no field
     */
    const COL_CNTR_NO = 'packing_list.cntr_no';

    /**
     * the column name for the seal_no field
     */
    const COL_SEAL_NO = 'packing_list.seal_no';

    /**
     * the column name for the pod field
     */
    const COL_POD = 'packing_list.pod';

    /**
     * the column name for the shipping field
     */
    const COL_SHIPPING = 'packing_list.shipping';

    /**
     * the column name for the pol field
     */
    const COL_POL = 'packing_list.pol';

    /**
     * the column name for the etd_srg field
     */
    const COL_ETD_SRG = 'packing_list.etd_srg';

    /**
     * the column name for the ref_doc field
     */
    const COL_REF_DOC = 'packing_list.ref_doc';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'packing_list.state';

    /**
     * the column name for the total_qty field
     */
    const COL_TOTAL_QTY = 'packing_list.total_qty';

    /**
     * the column name for the total_qty_of_pack field
     */
    const COL_TOTAL_QTY_OF_PACK = 'packing_list.total_qty_of_pack';

    /**
     * the column name for the total_cubic_dimension field
     */
    const COL_TOTAL_CUBIC_DIMENSION = 'packing_list.total_cubic_dimension';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'packing_list.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'packing_list.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'packing_list.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Date', 'LoadingDate', 'CustomerId', 'OceanVessel', 'BlNo', 'GoodsDescription', 'CntrNo', 'SealNo', 'Pod', 'Shipping', 'Pol', 'EtdSrg', 'RefDoc', 'State', 'TotalQty', 'TotalQtyOfPack', 'TotalCubicDimension', 'Active', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'date', 'loadingDate', 'customerId', 'oceanVessel', 'blNo', 'goodsDescription', 'cntrNo', 'sealNo', 'pod', 'shipping', 'pol', 'etdSrg', 'refDoc', 'state', 'totalQty', 'totalQtyOfPack', 'totalCubicDimension', 'active', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PackingListTableMap::COL_ID, PackingListTableMap::COL_NAME, PackingListTableMap::COL_DATE, PackingListTableMap::COL_LOADING_DATE, PackingListTableMap::COL_CUSTOMER_ID, PackingListTableMap::COL_OCEAN_VESSEL, PackingListTableMap::COL_BL_NO, PackingListTableMap::COL_GOODS_DESCRIPTION, PackingListTableMap::COL_CNTR_NO, PackingListTableMap::COL_SEAL_NO, PackingListTableMap::COL_POD, PackingListTableMap::COL_SHIPPING, PackingListTableMap::COL_POL, PackingListTableMap::COL_ETD_SRG, PackingListTableMap::COL_REF_DOC, PackingListTableMap::COL_STATE, PackingListTableMap::COL_TOTAL_QTY, PackingListTableMap::COL_TOTAL_QTY_OF_PACK, PackingListTableMap::COL_TOTAL_CUBIC_DIMENSION, PackingListTableMap::COL_ACTIVE, PackingListTableMap::COL_CREATED_AT, PackingListTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'date', 'loading_date', 'customer_id', 'ocean_vessel', 'bl_no', 'goods_description', 'cntr_no', 'seal_no', 'pod', 'shipping', 'pol', 'etd_srg', 'ref_doc', 'state', 'total_qty', 'total_qty_of_pack', 'total_cubic_dimension', 'active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Date' => 2, 'LoadingDate' => 3, 'CustomerId' => 4, 'OceanVessel' => 5, 'BlNo' => 6, 'GoodsDescription' => 7, 'CntrNo' => 8, 'SealNo' => 9, 'Pod' => 10, 'Shipping' => 11, 'Pol' => 12, 'EtdSrg' => 13, 'RefDoc' => 14, 'State' => 15, 'TotalQty' => 16, 'TotalQtyOfPack' => 17, 'TotalCubicDimension' => 18, 'Active' => 19, 'CreatedAt' => 20, 'UpdatedAt' => 21, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'date' => 2, 'loadingDate' => 3, 'customerId' => 4, 'oceanVessel' => 5, 'blNo' => 6, 'goodsDescription' => 7, 'cntrNo' => 8, 'sealNo' => 9, 'pod' => 10, 'shipping' => 11, 'pol' => 12, 'etdSrg' => 13, 'refDoc' => 14, 'state' => 15, 'totalQty' => 16, 'totalQtyOfPack' => 17, 'totalCubicDimension' => 18, 'active' => 19, 'createdAt' => 20, 'updatedAt' => 21, ),
        self::TYPE_COLNAME       => array(PackingListTableMap::COL_ID => 0, PackingListTableMap::COL_NAME => 1, PackingListTableMap::COL_DATE => 2, PackingListTableMap::COL_LOADING_DATE => 3, PackingListTableMap::COL_CUSTOMER_ID => 4, PackingListTableMap::COL_OCEAN_VESSEL => 5, PackingListTableMap::COL_BL_NO => 6, PackingListTableMap::COL_GOODS_DESCRIPTION => 7, PackingListTableMap::COL_CNTR_NO => 8, PackingListTableMap::COL_SEAL_NO => 9, PackingListTableMap::COL_POD => 10, PackingListTableMap::COL_SHIPPING => 11, PackingListTableMap::COL_POL => 12, PackingListTableMap::COL_ETD_SRG => 13, PackingListTableMap::COL_REF_DOC => 14, PackingListTableMap::COL_STATE => 15, PackingListTableMap::COL_TOTAL_QTY => 16, PackingListTableMap::COL_TOTAL_QTY_OF_PACK => 17, PackingListTableMap::COL_TOTAL_CUBIC_DIMENSION => 18, PackingListTableMap::COL_ACTIVE => 19, PackingListTableMap::COL_CREATED_AT => 20, PackingListTableMap::COL_UPDATED_AT => 21, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'date' => 2, 'loading_date' => 3, 'customer_id' => 4, 'ocean_vessel' => 5, 'bl_no' => 6, 'goods_description' => 7, 'cntr_no' => 8, 'seal_no' => 9, 'pod' => 10, 'shipping' => 11, 'pol' => 12, 'etd_srg' => 13, 'ref_doc' => 14, 'state' => 15, 'total_qty' => 16, 'total_qty_of_pack' => 17, 'total_cubic_dimension' => 18, 'active' => 19, 'created_at' => 20, 'updated_at' => 21, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
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
        $this->setName('packing_list');
        $this->setPhpName('PackingList');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PackingList');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('loading_date', 'LoadingDate', 'DATE', false, null, null);
        $this->addForeignKey('customer_id', 'CustomerId', 'INTEGER', 'partner', 'id', true, null, null);
        $this->addColumn('ocean_vessel', 'OceanVessel', 'VARCHAR', false, 255, null);
        $this->addColumn('bl_no', 'BlNo', 'VARCHAR', false, 255, null);
        $this->addColumn('goods_description', 'GoodsDescription', 'VARCHAR', false, 255, null);
        $this->addColumn('cntr_no', 'CntrNo', 'VARCHAR', false, 255, null);
        $this->addColumn('seal_no', 'SealNo', 'VARCHAR', false, 255, null);
        $this->addColumn('pod', 'Pod', 'VARCHAR', false, 255, null);
        $this->addColumn('shipping', 'Shipping', 'CHAR', false, 255, null);
        $this->addColumn('pol', 'Pol', 'VARCHAR', false, 255, null);
        $this->addColumn('etd_srg', 'EtdSrg', 'VARCHAR', false, 255, null);
        $this->addColumn('ref_doc', 'RefDoc', 'VARCHAR', false, 255, null);
        $this->addColumn('state', 'State', 'CHAR', false, null, 'draft');
        $this->addColumn('total_qty', 'TotalQty', 'INTEGER', false, null, null);
        $this->addColumn('total_qty_of_pack', 'TotalQtyOfPack', 'INTEGER', false, null, null);
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
        $this->addRelation('Partner', '\\Partner', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':customer_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('PackingListLine', '\\PackingListLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':packing_list_id',
    1 => ':id',
  ),
), null, null, 'PackingListLines', false);
        $this->addRelation('PurchaseOrder', '\\PurchaseOrder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':packing_list_id',
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
        return $withPrefix ? PackingListTableMap::CLASS_DEFAULT : PackingListTableMap::OM_CLASS;
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
     * @return array           (PackingList object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PackingListTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PackingListTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PackingListTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PackingListTableMap::OM_CLASS;
            /** @var PackingList $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PackingListTableMap::addInstanceToPool($obj, $key);
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
            $key = PackingListTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PackingListTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PackingList $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PackingListTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PackingListTableMap::COL_ID);
            $criteria->addSelectColumn(PackingListTableMap::COL_NAME);
            $criteria->addSelectColumn(PackingListTableMap::COL_DATE);
            $criteria->addSelectColumn(PackingListTableMap::COL_LOADING_DATE);
            $criteria->addSelectColumn(PackingListTableMap::COL_CUSTOMER_ID);
            $criteria->addSelectColumn(PackingListTableMap::COL_OCEAN_VESSEL);
            $criteria->addSelectColumn(PackingListTableMap::COL_BL_NO);
            $criteria->addSelectColumn(PackingListTableMap::COL_GOODS_DESCRIPTION);
            $criteria->addSelectColumn(PackingListTableMap::COL_CNTR_NO);
            $criteria->addSelectColumn(PackingListTableMap::COL_SEAL_NO);
            $criteria->addSelectColumn(PackingListTableMap::COL_POD);
            $criteria->addSelectColumn(PackingListTableMap::COL_SHIPPING);
            $criteria->addSelectColumn(PackingListTableMap::COL_POL);
            $criteria->addSelectColumn(PackingListTableMap::COL_ETD_SRG);
            $criteria->addSelectColumn(PackingListTableMap::COL_REF_DOC);
            $criteria->addSelectColumn(PackingListTableMap::COL_STATE);
            $criteria->addSelectColumn(PackingListTableMap::COL_TOTAL_QTY);
            $criteria->addSelectColumn(PackingListTableMap::COL_TOTAL_QTY_OF_PACK);
            $criteria->addSelectColumn(PackingListTableMap::COL_TOTAL_CUBIC_DIMENSION);
            $criteria->addSelectColumn(PackingListTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(PackingListTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PackingListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.loading_date');
            $criteria->addSelectColumn($alias . '.customer_id');
            $criteria->addSelectColumn($alias . '.ocean_vessel');
            $criteria->addSelectColumn($alias . '.bl_no');
            $criteria->addSelectColumn($alias . '.goods_description');
            $criteria->addSelectColumn($alias . '.cntr_no');
            $criteria->addSelectColumn($alias . '.seal_no');
            $criteria->addSelectColumn($alias . '.pod');
            $criteria->addSelectColumn($alias . '.shipping');
            $criteria->addSelectColumn($alias . '.pol');
            $criteria->addSelectColumn($alias . '.etd_srg');
            $criteria->addSelectColumn($alias . '.ref_doc');
            $criteria->addSelectColumn($alias . '.state');
            $criteria->addSelectColumn($alias . '.total_qty');
            $criteria->addSelectColumn($alias . '.total_qty_of_pack');
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
        return Propel::getServiceContainer()->getDatabaseMap(PackingListTableMap::DATABASE_NAME)->getTable(PackingListTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PackingListTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PackingListTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PackingListTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PackingList or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PackingList object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PackingList) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PackingListTableMap::DATABASE_NAME);
            $criteria->add(PackingListTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PackingListQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PackingListTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PackingListTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the packing_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PackingListQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PackingList or Criteria object.
     *
     * @param mixed               $criteria Criteria or PackingList object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PackingList object
        }

        if ($criteria->containsKey(PackingListTableMap::COL_ID) && $criteria->keyContainsValue(PackingListTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PackingListTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PackingListQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PackingListTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PackingListTableMap::buildTableMap();
