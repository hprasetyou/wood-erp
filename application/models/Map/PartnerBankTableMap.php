<?php

namespace Map;

use \PartnerBank;
use \PartnerBankQuery;
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
 * This class defines the structure of the 'partner_bank' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PartnerBankTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PartnerBankTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'partner_bank';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PartnerBank';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PartnerBank';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'partner_bank.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'partner_bank.name';

    /**
     * the column name for the acount_no field
     */
    const COL_ACOUNT_NO = 'partner_bank.acount_no';

    /**
     * the column name for the partner_id field
     */
    const COL_PARTNER_ID = 'partner_bank.partner_id';

    /**
     * the column name for the bank_id field
     */
    const COL_BANK_ID = 'partner_bank.bank_id';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'partner_bank.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'partner_bank.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'partner_bank.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'AccountNo', 'PartnerId', 'BankId', 'Active', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'accountNo', 'partnerId', 'bankId', 'active', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PartnerBankTableMap::COL_ID, PartnerBankTableMap::COL_NAME, PartnerBankTableMap::COL_ACOUNT_NO, PartnerBankTableMap::COL_PARTNER_ID, PartnerBankTableMap::COL_BANK_ID, PartnerBankTableMap::COL_ACTIVE, PartnerBankTableMap::COL_CREATED_AT, PartnerBankTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'acount_no', 'partner_id', 'bank_id', 'active', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'AccountNo' => 2, 'PartnerId' => 3, 'BankId' => 4, 'Active' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'accountNo' => 2, 'partnerId' => 3, 'bankId' => 4, 'active' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(PartnerBankTableMap::COL_ID => 0, PartnerBankTableMap::COL_NAME => 1, PartnerBankTableMap::COL_ACOUNT_NO => 2, PartnerBankTableMap::COL_PARTNER_ID => 3, PartnerBankTableMap::COL_BANK_ID => 4, PartnerBankTableMap::COL_ACTIVE => 5, PartnerBankTableMap::COL_CREATED_AT => 6, PartnerBankTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'acount_no' => 2, 'partner_id' => 3, 'bank_id' => 4, 'active' => 5, 'created_at' => 6, 'updated_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('partner_bank');
        $this->setPhpName('PartnerBank');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PartnerBank');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('acount_no', 'AccountNo', 'VARCHAR', true, 255, null);
        $this->addForeignKey('partner_id', 'PartnerId', 'INTEGER', 'partner', 'id', true, null, null);
        $this->addForeignKey('bank_id', 'BankId', 'INTEGER', 'bank', 'id', true, null, null);
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
    0 => ':partner_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Bank', '\\Bank', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':bank_id',
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
        return $withPrefix ? PartnerBankTableMap::CLASS_DEFAULT : PartnerBankTableMap::OM_CLASS;
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
     * @return array           (PartnerBank object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PartnerBankTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PartnerBankTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PartnerBankTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PartnerBankTableMap::OM_CLASS;
            /** @var PartnerBank $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PartnerBankTableMap::addInstanceToPool($obj, $key);
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
            $key = PartnerBankTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PartnerBankTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PartnerBank $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PartnerBankTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PartnerBankTableMap::COL_ID);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_NAME);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_ACOUNT_NO);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_PARTNER_ID);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_BANK_ID);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PartnerBankTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.acount_no');
            $criteria->addSelectColumn($alias . '.partner_id');
            $criteria->addSelectColumn($alias . '.bank_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(PartnerBankTableMap::DATABASE_NAME)->getTable(PartnerBankTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PartnerBankTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PartnerBankTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PartnerBankTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a PartnerBank or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PartnerBank object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerBankTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PartnerBank) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PartnerBankTableMap::DATABASE_NAME);
            $criteria->add(PartnerBankTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PartnerBankQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PartnerBankTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PartnerBankTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the partner_bank table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PartnerBankQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PartnerBank or Criteria object.
     *
     * @param mixed               $criteria Criteria or PartnerBank object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerBankTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PartnerBank object
        }

        if ($criteria->containsKey(PartnerBankTableMap::COL_ID) && $criteria->keyContainsValue(PartnerBankTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PartnerBankTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PartnerBankQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PartnerBankTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PartnerBankTableMap::buildTableMap();
