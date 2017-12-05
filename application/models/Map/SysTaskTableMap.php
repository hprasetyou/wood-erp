<?php

namespace Map;

use \SysTask;
use \SysTaskQuery;
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
 * This class defines the structure of the 'sys_task' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SysTaskTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SysTaskTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'sys_task';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\SysTask';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'SysTask';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'sys_task.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'sys_task.name';

    /**
     * the column name for the priority field
     */
    const COL_PRIORITY = 'sys_task.priority';

    /**
     * the column name for the content field
     */
    const COL_CONTENT = 'sys_task.content';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'sys_task.description';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'sys_task.type';

    /**
     * the column name for the time_execution field
     */
    const COL_TIME_EXECUTION = 'sys_task.time_execution';

    /**
     * the column name for the scheduled_execution field
     */
    const COL_SCHEDULED_EXECUTION = 'sys_task.scheduled_execution';

    /**
     * the column name for the day_repeat field
     */
    const COL_DAY_REPEAT = 'sys_task.day_repeat';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'sys_task.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'sys_task.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Priority', 'Content', 'Description', 'Type', 'TimeExecution', 'ScheduledExecution', 'DayRepeat', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'priority', 'content', 'description', 'type', 'timeExecution', 'scheduledExecution', 'dayRepeat', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(SysTaskTableMap::COL_ID, SysTaskTableMap::COL_NAME, SysTaskTableMap::COL_PRIORITY, SysTaskTableMap::COL_CONTENT, SysTaskTableMap::COL_DESCRIPTION, SysTaskTableMap::COL_TYPE, SysTaskTableMap::COL_TIME_EXECUTION, SysTaskTableMap::COL_SCHEDULED_EXECUTION, SysTaskTableMap::COL_DAY_REPEAT, SysTaskTableMap::COL_CREATED_AT, SysTaskTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'priority', 'content', 'description', 'type', 'time_execution', 'scheduled_execution', 'day_repeat', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Priority' => 2, 'Content' => 3, 'Description' => 4, 'Type' => 5, 'TimeExecution' => 6, 'ScheduledExecution' => 7, 'DayRepeat' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'priority' => 2, 'content' => 3, 'description' => 4, 'type' => 5, 'timeExecution' => 6, 'scheduledExecution' => 7, 'dayRepeat' => 8, 'createdAt' => 9, 'updatedAt' => 10, ),
        self::TYPE_COLNAME       => array(SysTaskTableMap::COL_ID => 0, SysTaskTableMap::COL_NAME => 1, SysTaskTableMap::COL_PRIORITY => 2, SysTaskTableMap::COL_CONTENT => 3, SysTaskTableMap::COL_DESCRIPTION => 4, SysTaskTableMap::COL_TYPE => 5, SysTaskTableMap::COL_TIME_EXECUTION => 6, SysTaskTableMap::COL_SCHEDULED_EXECUTION => 7, SysTaskTableMap::COL_DAY_REPEAT => 8, SysTaskTableMap::COL_CREATED_AT => 9, SysTaskTableMap::COL_UPDATED_AT => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'priority' => 2, 'content' => 3, 'description' => 4, 'type' => 5, 'time_execution' => 6, 'scheduled_execution' => 7, 'day_repeat' => 8, 'created_at' => 9, 'updated_at' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('sys_task');
        $this->setPhpName('SysTask');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\SysTask');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 2, null);
        $this->addColumn('priority', 'Priority', 'INTEGER', true, null, 0);
        $this->addColumn('content', 'Content', 'LONGVARCHAR', false, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 255, null);
        $this->addColumn('time_execution', 'TimeExecution', 'TIME', false, null, null);
        $this->addColumn('scheduled_execution', 'ScheduledExecution', 'TIMESTAMP', false, null, null);
        $this->addColumn('day_repeat', 'DayRepeat', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        return $withPrefix ? SysTaskTableMap::CLASS_DEFAULT : SysTaskTableMap::OM_CLASS;
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
     * @return array           (SysTask object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SysTaskTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SysTaskTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SysTaskTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SysTaskTableMap::OM_CLASS;
            /** @var SysTask $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SysTaskTableMap::addInstanceToPool($obj, $key);
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
            $key = SysTaskTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SysTaskTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SysTask $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SysTaskTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SysTaskTableMap::COL_ID);
            $criteria->addSelectColumn(SysTaskTableMap::COL_NAME);
            $criteria->addSelectColumn(SysTaskTableMap::COL_PRIORITY);
            $criteria->addSelectColumn(SysTaskTableMap::COL_CONTENT);
            $criteria->addSelectColumn(SysTaskTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SysTaskTableMap::COL_TYPE);
            $criteria->addSelectColumn(SysTaskTableMap::COL_TIME_EXECUTION);
            $criteria->addSelectColumn(SysTaskTableMap::COL_SCHEDULED_EXECUTION);
            $criteria->addSelectColumn(SysTaskTableMap::COL_DAY_REPEAT);
            $criteria->addSelectColumn(SysTaskTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SysTaskTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.priority');
            $criteria->addSelectColumn($alias . '.content');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.time_execution');
            $criteria->addSelectColumn($alias . '.scheduled_execution');
            $criteria->addSelectColumn($alias . '.day_repeat');
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
        return Propel::getServiceContainer()->getDatabaseMap(SysTaskTableMap::DATABASE_NAME)->getTable(SysTaskTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SysTaskTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SysTaskTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SysTaskTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SysTask or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SysTask object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SysTaskTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \SysTask) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SysTaskTableMap::DATABASE_NAME);
            $criteria->add(SysTaskTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SysTaskQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SysTaskTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SysTaskTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the sys_task table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SysTaskQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SysTask or Criteria object.
     *
     * @param mixed               $criteria Criteria or SysTask object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysTaskTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SysTask object
        }

        if ($criteria->containsKey(SysTaskTableMap::COL_ID) && $criteria->keyContainsValue(SysTaskTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SysTaskTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SysTaskQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SysTaskTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SysTaskTableMap::buildTableMap();
