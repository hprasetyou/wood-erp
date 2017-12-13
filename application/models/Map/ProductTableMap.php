<?php

namespace Map;

use \Product;
use \ProductQuery;
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
 * This class defines the structure of the 'product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProductTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'product';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Product';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Product';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 25;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 25;

    /**
     * the column name for the id field
     */
    const COL_ID = 'product.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'product.name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'product.description';

    /**
     * the column name for the is_round field
     */
    const COL_IS_ROUND = 'product.is_round';

    /**
     * the column name for the is_kdn field
     */
    const COL_IS_KDN = 'product.is_kdn';

    /**
     * the column name for the is_flegt field
     */
    const COL_IS_FLEGT = 'product.is_flegt';

    /**
     * the column name for the has_component field
     */
    const COL_HAS_COMPONENT = 'product.has_component';

    /**
     * the column name for the qty_per_pack field
     */
    const COL_QTY_PER_PACK = 'product.qty_per_pack';

    /**
     * the column name for the list_price field
     */
    const COL_LIST_PRICE = 'product.list_price';

    /**
     * the column name for the material_id field
     */
    const COL_MATERIAL_ID = 'product.material_id';

    /**
     * the column name for the note field
     */
    const COL_NOTE = 'product.note';

    /**
     * the column name for the cubic_asb field
     */
    const COL_CUBIC_ASB = 'product.cubic_asb';

    /**
     * the column name for the cubic_kdn field
     */
    const COL_CUBIC_KDN = 'product.cubic_kdn';

    /**
     * the column name for the width_asb field
     */
    const COL_WIDTH_ASB = 'product.width_asb';

    /**
     * the column name for the height_asb field
     */
    const COL_HEIGHT_ASB = 'product.height_asb';

    /**
     * the column name for the depth_asb field
     */
    const COL_DEPTH_ASB = 'product.depth_asb';

    /**
     * the column name for the width_kdn field
     */
    const COL_WIDTH_KDN = 'product.width_kdn';

    /**
     * the column name for the height_kdn field
     */
    const COL_HEIGHT_KDN = 'product.height_kdn';

    /**
     * the column name for the depth_kdn field
     */
    const COL_DEPTH_KDN = 'product.depth_kdn';

    /**
     * the column name for the net_cubic field
     */
    const COL_NET_CUBIC = 'product.net_cubic';

    /**
     * the column name for the net_weight field
     */
    const COL_NET_WEIGHT = 'product.net_weight';

    /**
     * the column name for the gross_weight field
     */
    const COL_GROSS_WEIGHT = 'product.gross_weight';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'product.type';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'product.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'product.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Description', 'IsRound', 'IsKdn', 'IsFlegt', 'HasComponent', 'QtyPerPack', 'ListPrice', 'MaterialId', 'Note', 'CubicAsb', 'CubicKdn', 'WidthAsb', 'HeightAsb', 'DepthAsb', 'WidthKdn', 'HeightKdn', 'DepthKdn', 'NetCubic', 'NetWeight', 'GrossWeight', 'Type', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'description', 'isRound', 'isKdn', 'isFlegt', 'hasComponent', 'qtyPerPack', 'listPrice', 'materialId', 'note', 'cubicAsb', 'cubicKdn', 'widthAsb', 'heightAsb', 'depthAsb', 'widthKdn', 'heightKdn', 'depthKdn', 'netCubic', 'netWeight', 'grossWeight', 'type', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_ID, ProductTableMap::COL_NAME, ProductTableMap::COL_DESCRIPTION, ProductTableMap::COL_IS_ROUND, ProductTableMap::COL_IS_KDN, ProductTableMap::COL_IS_FLEGT, ProductTableMap::COL_HAS_COMPONENT, ProductTableMap::COL_QTY_PER_PACK, ProductTableMap::COL_LIST_PRICE, ProductTableMap::COL_MATERIAL_ID, ProductTableMap::COL_NOTE, ProductTableMap::COL_CUBIC_ASB, ProductTableMap::COL_CUBIC_KDN, ProductTableMap::COL_WIDTH_ASB, ProductTableMap::COL_HEIGHT_ASB, ProductTableMap::COL_DEPTH_ASB, ProductTableMap::COL_WIDTH_KDN, ProductTableMap::COL_HEIGHT_KDN, ProductTableMap::COL_DEPTH_KDN, ProductTableMap::COL_NET_CUBIC, ProductTableMap::COL_NET_WEIGHT, ProductTableMap::COL_GROSS_WEIGHT, ProductTableMap::COL_TYPE, ProductTableMap::COL_CREATED_AT, ProductTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'description', 'is_round', 'is_kdn', 'is_flegt', 'has_component', 'qty_per_pack', 'list_price', 'material_id', 'note', 'cubic_asb', 'cubic_kdn', 'width_asb', 'height_asb', 'depth_asb', 'width_kdn', 'height_kdn', 'depth_kdn', 'net_cubic', 'net_weight', 'gross_weight', 'type', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Description' => 2, 'IsRound' => 3, 'IsKdn' => 4, 'IsFlegt' => 5, 'HasComponent' => 6, 'QtyPerPack' => 7, 'ListPrice' => 8, 'MaterialId' => 9, 'Note' => 10, 'CubicAsb' => 11, 'CubicKdn' => 12, 'WidthAsb' => 13, 'HeightAsb' => 14, 'DepthAsb' => 15, 'WidthKdn' => 16, 'HeightKdn' => 17, 'DepthKdn' => 18, 'NetCubic' => 19, 'NetWeight' => 20, 'GrossWeight' => 21, 'Type' => 22, 'CreatedAt' => 23, 'UpdatedAt' => 24, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'description' => 2, 'isRound' => 3, 'isKdn' => 4, 'isFlegt' => 5, 'hasComponent' => 6, 'qtyPerPack' => 7, 'listPrice' => 8, 'materialId' => 9, 'note' => 10, 'cubicAsb' => 11, 'cubicKdn' => 12, 'widthAsb' => 13, 'heightAsb' => 14, 'depthAsb' => 15, 'widthKdn' => 16, 'heightKdn' => 17, 'depthKdn' => 18, 'netCubic' => 19, 'netWeight' => 20, 'grossWeight' => 21, 'type' => 22, 'createdAt' => 23, 'updatedAt' => 24, ),
        self::TYPE_COLNAME       => array(ProductTableMap::COL_ID => 0, ProductTableMap::COL_NAME => 1, ProductTableMap::COL_DESCRIPTION => 2, ProductTableMap::COL_IS_ROUND => 3, ProductTableMap::COL_IS_KDN => 4, ProductTableMap::COL_IS_FLEGT => 5, ProductTableMap::COL_HAS_COMPONENT => 6, ProductTableMap::COL_QTY_PER_PACK => 7, ProductTableMap::COL_LIST_PRICE => 8, ProductTableMap::COL_MATERIAL_ID => 9, ProductTableMap::COL_NOTE => 10, ProductTableMap::COL_CUBIC_ASB => 11, ProductTableMap::COL_CUBIC_KDN => 12, ProductTableMap::COL_WIDTH_ASB => 13, ProductTableMap::COL_HEIGHT_ASB => 14, ProductTableMap::COL_DEPTH_ASB => 15, ProductTableMap::COL_WIDTH_KDN => 16, ProductTableMap::COL_HEIGHT_KDN => 17, ProductTableMap::COL_DEPTH_KDN => 18, ProductTableMap::COL_NET_CUBIC => 19, ProductTableMap::COL_NET_WEIGHT => 20, ProductTableMap::COL_GROSS_WEIGHT => 21, ProductTableMap::COL_TYPE => 22, ProductTableMap::COL_CREATED_AT => 23, ProductTableMap::COL_UPDATED_AT => 24, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'description' => 2, 'is_round' => 3, 'is_kdn' => 4, 'is_flegt' => 5, 'has_component' => 6, 'qty_per_pack' => 7, 'list_price' => 8, 'material_id' => 9, 'note' => 10, 'cubic_asb' => 11, 'cubic_kdn' => 12, 'width_asb' => 13, 'height_asb' => 14, 'depth_asb' => 15, 'width_kdn' => 16, 'height_kdn' => 17, 'depth_kdn' => 18, 'net_cubic' => 19, 'net_weight' => 20, 'gross_weight' => 21, 'type' => 22, 'created_at' => 23, 'updated_at' => 24, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
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
        $this->setName('product');
        $this->setPhpName('Product');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Product');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('is_round', 'IsRound', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_kdn', 'IsKdn', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_flegt', 'IsFlegt', 'BOOLEAN', false, 1, false);
        $this->addColumn('has_component', 'HasComponent', 'BOOLEAN', false, 1, false);
        $this->addColumn('qty_per_pack', 'QtyPerPack', 'INTEGER', false, null, 1);
        $this->addColumn('list_price', 'ListPrice', 'FLOAT', false, null, null);
        $this->addForeignKey('material_id', 'MaterialId', 'INTEGER', 'material', 'id', false, null, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, null, null);
        $this->addColumn('cubic_asb', 'CubicAsb', 'FLOAT', false, null, null);
        $this->addColumn('cubic_kdn', 'CubicKdn', 'FLOAT', false, null, null);
        $this->addColumn('width_asb', 'WidthAsb', 'FLOAT', false, null, null);
        $this->addColumn('height_asb', 'HeightAsb', 'FLOAT', false, null, null);
        $this->addColumn('depth_asb', 'DepthAsb', 'FLOAT', false, null, null);
        $this->addColumn('width_kdn', 'WidthKdn', 'FLOAT', false, null, null);
        $this->addColumn('height_kdn', 'HeightKdn', 'FLOAT', false, null, null);
        $this->addColumn('depth_kdn', 'DepthKdn', 'FLOAT', false, null, null);
        $this->addColumn('net_cubic', 'NetCubic', 'FLOAT', false, null, null);
        $this->addColumn('net_weight', 'NetWeight', 'FLOAT', false, null, null);
        $this->addColumn('gross_weight', 'GrossWeight', 'FLOAT', false, null, null);
        $this->addColumn('type', 'Type', 'CHAR', false, null, 'product');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Material', '\\Material', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':material_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('ListComponent', '\\ComponentProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'ListComponents', false);
        $this->addRelation('Parent', '\\ComponentProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':component_id',
    1 => ':id',
  ),
), null, null, 'Parents', false);
        $this->addRelation('ProductPartner', '\\ProductPartner', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'ProductPartners', false);
        $this->addRelation('ProductFinishing', '\\ProductFinishing', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'ProductFinishings', false);
        $this->addRelation('ProductImage', '\\ProductImage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'ProductImages', false);
        $this->addRelation('ProformaInvoiceLine', '\\ProformaInvoiceLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'ProformaInvoiceLines', false);
        $this->addRelation('PurchaseOrderLine', '\\PurchaseOrderLine', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_id',
    1 => ':id',
  ),
), null, null, 'PurchaseOrderLines', false);
        $this->addRelation('Finishing', '\\Finishing', RelationMap::MANY_TO_MANY, array(), null, null, 'Finishings');
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
        return $withPrefix ? ProductTableMap::CLASS_DEFAULT : ProductTableMap::OM_CLASS;
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
     * @return array           (Product object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductTableMap::OM_CLASS;
            /** @var Product $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Product $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductTableMap::COL_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_NAME);
            $criteria->addSelectColumn(ProductTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ProductTableMap::COL_IS_ROUND);
            $criteria->addSelectColumn(ProductTableMap::COL_IS_KDN);
            $criteria->addSelectColumn(ProductTableMap::COL_IS_FLEGT);
            $criteria->addSelectColumn(ProductTableMap::COL_HAS_COMPONENT);
            $criteria->addSelectColumn(ProductTableMap::COL_QTY_PER_PACK);
            $criteria->addSelectColumn(ProductTableMap::COL_LIST_PRICE);
            $criteria->addSelectColumn(ProductTableMap::COL_MATERIAL_ID);
            $criteria->addSelectColumn(ProductTableMap::COL_NOTE);
            $criteria->addSelectColumn(ProductTableMap::COL_CUBIC_ASB);
            $criteria->addSelectColumn(ProductTableMap::COL_CUBIC_KDN);
            $criteria->addSelectColumn(ProductTableMap::COL_WIDTH_ASB);
            $criteria->addSelectColumn(ProductTableMap::COL_HEIGHT_ASB);
            $criteria->addSelectColumn(ProductTableMap::COL_DEPTH_ASB);
            $criteria->addSelectColumn(ProductTableMap::COL_WIDTH_KDN);
            $criteria->addSelectColumn(ProductTableMap::COL_HEIGHT_KDN);
            $criteria->addSelectColumn(ProductTableMap::COL_DEPTH_KDN);
            $criteria->addSelectColumn(ProductTableMap::COL_NET_CUBIC);
            $criteria->addSelectColumn(ProductTableMap::COL_NET_WEIGHT);
            $criteria->addSelectColumn(ProductTableMap::COL_GROSS_WEIGHT);
            $criteria->addSelectColumn(ProductTableMap::COL_TYPE);
            $criteria->addSelectColumn(ProductTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ProductTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.is_round');
            $criteria->addSelectColumn($alias . '.is_kdn');
            $criteria->addSelectColumn($alias . '.is_flegt');
            $criteria->addSelectColumn($alias . '.has_component');
            $criteria->addSelectColumn($alias . '.qty_per_pack');
            $criteria->addSelectColumn($alias . '.list_price');
            $criteria->addSelectColumn($alias . '.material_id');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.cubic_asb');
            $criteria->addSelectColumn($alias . '.cubic_kdn');
            $criteria->addSelectColumn($alias . '.width_asb');
            $criteria->addSelectColumn($alias . '.height_asb');
            $criteria->addSelectColumn($alias . '.depth_asb');
            $criteria->addSelectColumn($alias . '.width_kdn');
            $criteria->addSelectColumn($alias . '.height_kdn');
            $criteria->addSelectColumn($alias . '.depth_kdn');
            $criteria->addSelectColumn($alias . '.net_cubic');
            $criteria->addSelectColumn($alias . '.net_weight');
            $criteria->addSelectColumn($alias . '.gross_weight');
            $criteria->addSelectColumn($alias . '.type');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME)->getTable(ProductTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Product or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Product object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Product) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductTableMap::DATABASE_NAME);
            $criteria->add(ProductTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Product or Criteria object.
     *
     * @param mixed               $criteria Criteria or Product object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Product object
        }

        if ($criteria->containsKey(ProductTableMap::COL_ID) && $criteria->keyContainsValue(ProductTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductTableMap::buildTableMap();
