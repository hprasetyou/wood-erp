<?php

namespace Map;

use \Partner;
use \PartnerQuery;
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
 * This class defines the structure of the 'partner' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PartnerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PartnerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'partner';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Partner';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Partner';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the id field
     */
    const COL_ID = 'partner.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'partner.name';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'partner.address';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'partner.phone';

    /**
     * the column name for the website field
     */
    const COL_WEBSITE = 'partner.website';

    /**
     * the column name for the fax field
     */
    const COL_FAX = 'partner.fax';

    /**
     * the column name for the image field
     */
    const COL_IMAGE = 'partner.image';

    /**
     * the column name for the tax_number field
     */
    const COL_TAX_NUMBER = 'partner.tax_number';

    /**
     * the column name for the bank_detail field
     */
    const COL_BANK_DETAIL = 'partner.bank_detail';

    /**
     * the column name for the company_id field
     */
    const COL_COMPANY_ID = 'partner.company_id';

    /**
     * the column name for the is_employee field
     */
    const COL_IS_EMPLOYEE = 'partner.is_employee';

    /**
     * the column name for the is_customer field
     */
    const COL_IS_CUSTOMER = 'partner.is_customer';

    /**
     * the column name for the is_supplier field
     */
    const COL_IS_SUPPLIER = 'partner.is_supplier';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Address', 'Phone', 'Website', 'Fax', 'Image', 'TaxNumber', 'BankDetail', 'CompanyId', 'IsEmployee', 'IsCustomer', 'IsSupplier', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'address', 'phone', 'website', 'fax', 'image', 'taxNumber', 'bankDetail', 'companyId', 'isEmployee', 'isCustomer', 'isSupplier', ),
        self::TYPE_COLNAME       => array(PartnerTableMap::COL_ID, PartnerTableMap::COL_NAME, PartnerTableMap::COL_ADDRESS, PartnerTableMap::COL_PHONE, PartnerTableMap::COL_WEBSITE, PartnerTableMap::COL_FAX, PartnerTableMap::COL_IMAGE, PartnerTableMap::COL_TAX_NUMBER, PartnerTableMap::COL_BANK_DETAIL, PartnerTableMap::COL_COMPANY_ID, PartnerTableMap::COL_IS_EMPLOYEE, PartnerTableMap::COL_IS_CUSTOMER, PartnerTableMap::COL_IS_SUPPLIER, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'address', 'phone', 'website', 'fax', 'image', 'tax_number', 'bank_detail', 'company_id', 'is_employee', 'is_customer', 'is_supplier', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Address' => 2, 'Phone' => 3, 'Website' => 4, 'Fax' => 5, 'Image' => 6, 'TaxNumber' => 7, 'BankDetail' => 8, 'CompanyId' => 9, 'IsEmployee' => 10, 'IsCustomer' => 11, 'IsSupplier' => 12, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'address' => 2, 'phone' => 3, 'website' => 4, 'fax' => 5, 'image' => 6, 'taxNumber' => 7, 'bankDetail' => 8, 'companyId' => 9, 'isEmployee' => 10, 'isCustomer' => 11, 'isSupplier' => 12, ),
        self::TYPE_COLNAME       => array(PartnerTableMap::COL_ID => 0, PartnerTableMap::COL_NAME => 1, PartnerTableMap::COL_ADDRESS => 2, PartnerTableMap::COL_PHONE => 3, PartnerTableMap::COL_WEBSITE => 4, PartnerTableMap::COL_FAX => 5, PartnerTableMap::COL_IMAGE => 6, PartnerTableMap::COL_TAX_NUMBER => 7, PartnerTableMap::COL_BANK_DETAIL => 8, PartnerTableMap::COL_COMPANY_ID => 9, PartnerTableMap::COL_IS_EMPLOYEE => 10, PartnerTableMap::COL_IS_CUSTOMER => 11, PartnerTableMap::COL_IS_SUPPLIER => 12, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'address' => 2, 'phone' => 3, 'website' => 4, 'fax' => 5, 'image' => 6, 'tax_number' => 7, 'bank_detail' => 8, 'company_id' => 9, 'is_employee' => 10, 'is_customer' => 11, 'is_supplier' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $this->setName('partner');
        $this->setPhpName('Partner');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Partner');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('address', 'Address', 'LONGVARCHAR', false, null, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 255, null);
        $this->addColumn('website', 'Website', 'VARCHAR', false, 255, null);
        $this->addColumn('fax', 'Fax', 'VARCHAR', false, 255, null);
        $this->addColumn('image', 'Image', 'LONGVARCHAR', false, null, null);
        $this->addColumn('tax_number', 'TaxNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('bank_detail', 'BankDetail', 'VARCHAR', false, 255, null);
        $this->addColumn('company_id', 'CompanyId', 'INTEGER', false, null, null);
        $this->addColumn('is_employee', 'IsEmployee', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_customer', 'IsCustomer', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_supplier', 'IsSupplier', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ProductCustomer', '\\ProductCustomer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':partner_id',
    1 => ':id',
  ),
), null, null, 'ProductCustomers', false);
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
        return $withPrefix ? PartnerTableMap::CLASS_DEFAULT : PartnerTableMap::OM_CLASS;
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
     * @return array           (Partner object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PartnerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PartnerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PartnerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PartnerTableMap::OM_CLASS;
            /** @var Partner $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PartnerTableMap::addInstanceToPool($obj, $key);
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
            $key = PartnerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PartnerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Partner $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PartnerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PartnerTableMap::COL_ID);
            $criteria->addSelectColumn(PartnerTableMap::COL_NAME);
            $criteria->addSelectColumn(PartnerTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(PartnerTableMap::COL_PHONE);
            $criteria->addSelectColumn(PartnerTableMap::COL_WEBSITE);
            $criteria->addSelectColumn(PartnerTableMap::COL_FAX);
            $criteria->addSelectColumn(PartnerTableMap::COL_IMAGE);
            $criteria->addSelectColumn(PartnerTableMap::COL_TAX_NUMBER);
            $criteria->addSelectColumn(PartnerTableMap::COL_BANK_DETAIL);
            $criteria->addSelectColumn(PartnerTableMap::COL_COMPANY_ID);
            $criteria->addSelectColumn(PartnerTableMap::COL_IS_EMPLOYEE);
            $criteria->addSelectColumn(PartnerTableMap::COL_IS_CUSTOMER);
            $criteria->addSelectColumn(PartnerTableMap::COL_IS_SUPPLIER);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.website');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.tax_number');
            $criteria->addSelectColumn($alias . '.bank_detail');
            $criteria->addSelectColumn($alias . '.company_id');
            $criteria->addSelectColumn($alias . '.is_employee');
            $criteria->addSelectColumn($alias . '.is_customer');
            $criteria->addSelectColumn($alias . '.is_supplier');
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
        return Propel::getServiceContainer()->getDatabaseMap(PartnerTableMap::DATABASE_NAME)->getTable(PartnerTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PartnerTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PartnerTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PartnerTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Partner or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Partner object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Partner) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PartnerTableMap::DATABASE_NAME);
            $criteria->add(PartnerTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PartnerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PartnerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PartnerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the partner table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PartnerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Partner or Criteria object.
     *
     * @param mixed               $criteria Criteria or Partner object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Partner object
        }

        if ($criteria->containsKey(PartnerTableMap::COL_ID) && $criteria->keyContainsValue(PartnerTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PartnerTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PartnerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PartnerTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PartnerTableMap::buildTableMap();
