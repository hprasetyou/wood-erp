<?php

namespace Map;

use \StockMove;
use \StockMoveQuery;
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
 * This class defines the structure of the 'stock_move' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class StockMoveTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.StockMoveTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'stock_move';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\StockMove';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'StockMove';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'stock_move.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'stock_move.name';

    /**
     * the column name for the ref field
     */
    const COL_REF = 'stock_move.ref';

    /**
     * the column name for the src_id field
     */
    const COL_SRC_ID = 'stock_move.src_id';

    /**
     * the column name for the dest_id field
     */
    const COL_DEST_ID = 'stock_move.dest_id';

    /**
     * the column name for the operation field
     */
    const COL_OPERATION = 'stock_move.operation';

    /**
     * the column name for the state field
     */
    const COL_STATE = 'stock_move.state';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'stock_move.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'stock_move.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'stock_move.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Reference', 'SrcId', 'DestId', 'Operation', 'State', 'Active', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'reference', 'srcId', 'destId', 'operation', 'state', 'active', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(StockMoveTableMap::COL_ID, StockMoveTableMap::COL_NAME, StockMoveTableMap::COL_REF, StockMoveTableMap::COL_SRC_ID, StockMoveTableMap::COL_DEST_ID, StockMoveTableMap::COL_OPERATION, StockMoveTableMap::COL_STATE, StockMoveTableMap::COL_ACTIVE, StockMoveTableMap::COL_CREATED_AT, StockMoveTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'ref', 'src_id', 'dest_id', 'operation', 'state', 'active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Reference' => 2, 'SrcId' => 3, 'DestId' => 4, 'Operation' => 5, 'State' => 6, 'Active' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'reference' => 2, 'srcId' => 3, 'destId' => 4, 'operation' => 5, 'state' => 6, 'active' => 7, 'createdAt' => 8, 'updatedAt' => 9, ),
        self::TYPE_COLNAME       => array(StockMoveTableMap::COL_ID => 0, StockMoveTableMap::COL_NAME => 1, StockMoveTableMap::COL_REF => 2, StockMoveTableMap::COL_SRC_ID => 3, StockMoveTableMap::COL_DEST_ID => 4, StockMoveTableMap::COL_OPERATION => 5, StockMoveTableMap::COL_STATE => 6, StockMoveTableMap::COL_ACTIVE => 7, StockMoveTableMap::COL_CREATED_AT => 8, StockMoveTableMap::COL_UPDATED_AT => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'ref' => 2, 'src_id' => 3, 'dest_id' => 4, 'operation' => 5, 'state' => 6, 'active' => 7, 'created_at' => 8, 'updated_at' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('stock_move');
        $this->setPhpName('StockMove');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\StockMove');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 8, null);
        $this->addColumn('ref', 'Reference', 'VARCHAR', false, 18, null);
        $this->addForeignKey('src_id', 'SrcId', 'INTEGER', 'partner_location', 'id', true, null, null);
        $this->addForeignKey('dest_id', 'DestId', 'INTEGER', 'partner_location', 'id', true, null, null);
        $this->addColumn('operation', 'Operation', 'CHAR', true, null, null);
        $this->addColumn('state', 'State', 'CHAR', false, null, 'draft');
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Src', '\\PartnerLocation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':src_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Dest', '\\PartnerLocation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':dest_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('StockMoveLine', '\\StockMoveLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':stock_move_id',
    1 => ':id',
  ),
), null, null, 'StockMoveLines', false);
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
        return $withPrefix ? StockMoveTableMap::CLASS_DEFAULT : StockMoveTableMap::OM_CLASS;
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
     * @return array           (StockMove object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = StockMoveTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = StockMoveTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + StockMoveTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = StockMoveTableMap::OM_CLASS;
            /** @var StockMove $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            StockMoveTableMap::addInstanceToPool($obj, $key);
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
            $key = StockMoveTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = StockMoveTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var StockMove $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                StockMoveTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(StockMoveTableMap::COL_ID);
            $criteria->addSelectColumn(StockMoveTableMap::COL_NAME);
            $criteria->addSelectColumn(StockMoveTableMap::COL_REF);
            $criteria->addSelectColumn(StockMoveTableMap::COL_SRC_ID);
            $criteria->addSelectColumn(StockMoveTableMap::COL_DEST_ID);
            $criteria->addSelectColumn(StockMoveTableMap::COL_OPERATION);
            $criteria->addSelectColumn(StockMoveTableMap::COL_STATE);
            $criteria->addSelectColumn(StockMoveTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(StockMoveTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(StockMoveTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.ref');
            $criteria->addSelectColumn($alias . '.src_id');
            $criteria->addSelectColumn($alias . '.dest_id');
            $criteria->addSelectColumn($alias . '.operation');
            $criteria->addSelectColumn($alias . '.state');
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
        return Propel::getServiceContainer()->getDatabaseMap(StockMoveTableMap::DATABASE_NAME)->getTable(StockMoveTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(StockMoveTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(StockMoveTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new StockMoveTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a StockMove or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or StockMove object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(StockMoveTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \StockMove) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(StockMoveTableMap::DATABASE_NAME);
            $criteria->add(StockMoveTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = StockMoveQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            StockMoveTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                StockMoveTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the stock_move table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return StockMoveQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a StockMove or Criteria object.
     *
     * @param mixed               $criteria Criteria or StockMove object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockMoveTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from StockMove object
        }

        if ($criteria->containsKey(StockMoveTableMap::COL_ID) && $criteria->keyContainsValue(StockMoveTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.StockMoveTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = StockMoveQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // StockMoveTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
StockMoveTableMap::buildTableMap();
