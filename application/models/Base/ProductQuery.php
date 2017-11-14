<?php

namespace Base;

use \Product as ChildProduct;
use \ProductQuery as ChildProductQuery;
use \Exception;
use \PDO;
use Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'product' table.
 *
 *
 *
 * @method     ChildProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductQuery orderByArticle($order = Criteria::ASC) Order by the article column
 * @method     ChildProductQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProductQuery orderByIsKdn($order = Criteria::ASC) Order by the is_kdn column
 * @method     ChildProductQuery orderByHasComponent($order = Criteria::ASC) Order by the has_component column
 * @method     ChildProductQuery orderByCostPrice($order = Criteria::ASC) Order by the cost_price column
 * @method     ChildProductQuery orderByListPrice($order = Criteria::ASC) Order by the list_price column
 * @method     ChildProductQuery orderByCubicAsb($order = Criteria::ASC) Order by the cubic_asb column
 * @method     ChildProductQuery orderByCubicKdn($order = Criteria::ASC) Order by the cubic_kdn column
 * @method     ChildProductQuery orderByWidthAsb($order = Criteria::ASC) Order by the width_asb column
 * @method     ChildProductQuery orderByHeightAsb($order = Criteria::ASC) Order by the height_asb column
 * @method     ChildProductQuery orderByDepthAsb($order = Criteria::ASC) Order by the depth_asb column
 * @method     ChildProductQuery orderByWidthKdn($order = Criteria::ASC) Order by the width_kdn column
 * @method     ChildProductQuery orderByHeightKdn($order = Criteria::ASC) Order by the height_kdn column
 * @method     ChildProductQuery orderByDepthKdn($order = Criteria::ASC) Order by the depth_kdn column
 * @method     ChildProductQuery orderByNetCubic($order = Criteria::ASC) Order by the net_cubic column
 * @method     ChildProductQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProductQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProductQuery groupById() Group by the id column
 * @method     ChildProductQuery groupByName() Group by the name column
 * @method     ChildProductQuery groupByArticle() Group by the article column
 * @method     ChildProductQuery groupByDescription() Group by the description column
 * @method     ChildProductQuery groupByIsKdn() Group by the is_kdn column
 * @method     ChildProductQuery groupByHasComponent() Group by the has_component column
 * @method     ChildProductQuery groupByCostPrice() Group by the cost_price column
 * @method     ChildProductQuery groupByListPrice() Group by the list_price column
 * @method     ChildProductQuery groupByCubicAsb() Group by the cubic_asb column
 * @method     ChildProductQuery groupByCubicKdn() Group by the cubic_kdn column
 * @method     ChildProductQuery groupByWidthAsb() Group by the width_asb column
 * @method     ChildProductQuery groupByHeightAsb() Group by the height_asb column
 * @method     ChildProductQuery groupByDepthAsb() Group by the depth_asb column
 * @method     ChildProductQuery groupByWidthKdn() Group by the width_kdn column
 * @method     ChildProductQuery groupByHeightKdn() Group by the height_kdn column
 * @method     ChildProductQuery groupByDepthKdn() Group by the depth_kdn column
 * @method     ChildProductQuery groupByNetCubic() Group by the net_cubic column
 * @method     ChildProductQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProductQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinProductComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductComponent relation
 * @method     ChildProductQuery rightJoinProductComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductComponent relation
 * @method     ChildProductQuery innerJoinProductComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductComponent relation
 *
 * @method     ChildProductQuery joinWithProductComponent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductComponent relation
 *
 * @method     ChildProductQuery leftJoinWithProductComponent() Adds a LEFT JOIN clause and with to the query using the ProductComponent relation
 * @method     ChildProductQuery rightJoinWithProductComponent() Adds a RIGHT JOIN clause and with to the query using the ProductComponent relation
 * @method     ChildProductQuery innerJoinWithProductComponent() Adds a INNER JOIN clause and with to the query using the ProductComponent relation
 *
 * @method     ChildProductQuery leftJoinProductCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductCustomer relation
 * @method     ChildProductQuery rightJoinProductCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductCustomer relation
 * @method     ChildProductQuery innerJoinProductCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductCustomer relation
 *
 * @method     ChildProductQuery joinWithProductCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductCustomer relation
 *
 * @method     ChildProductQuery leftJoinWithProductCustomer() Adds a LEFT JOIN clause and with to the query using the ProductCustomer relation
 * @method     ChildProductQuery rightJoinWithProductCustomer() Adds a RIGHT JOIN clause and with to the query using the ProductCustomer relation
 * @method     ChildProductQuery innerJoinWithProductCustomer() Adds a INNER JOIN clause and with to the query using the ProductCustomer relation
 *
 * @method     ChildProductQuery leftJoinProductFinishing($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductFinishing relation
 * @method     ChildProductQuery rightJoinProductFinishing($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductFinishing relation
 * @method     ChildProductQuery innerJoinProductFinishing($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductFinishing relation
 *
 * @method     ChildProductQuery joinWithProductFinishing($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductFinishing relation
 *
 * @method     ChildProductQuery leftJoinWithProductFinishing() Adds a LEFT JOIN clause and with to the query using the ProductFinishing relation
 * @method     ChildProductQuery rightJoinWithProductFinishing() Adds a RIGHT JOIN clause and with to the query using the ProductFinishing relation
 * @method     ChildProductQuery innerJoinWithProductFinishing() Adds a INNER JOIN clause and with to the query using the ProductFinishing relation
 *
 * @method     ChildProductQuery leftJoinProductImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductImage relation
 * @method     ChildProductQuery rightJoinProductImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductImage relation
 * @method     ChildProductQuery innerJoinProductImage($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductImage relation
 *
 * @method     ChildProductQuery joinWithProductImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductImage relation
 *
 * @method     ChildProductQuery leftJoinWithProductImage() Adds a LEFT JOIN clause and with to the query using the ProductImage relation
 * @method     ChildProductQuery rightJoinWithProductImage() Adds a RIGHT JOIN clause and with to the query using the ProductImage relation
 * @method     ChildProductQuery innerJoinWithProductImage() Adds a INNER JOIN clause and with to the query using the ProductImage relation
 *
 * @method     \ProductComponentQuery|\ProductCustomerQuery|\ProductFinishingQuery|\ProductImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneById(int $id) Return the first ChildProduct filtered by the id column
 * @method     ChildProduct findOneByName(string $name) Return the first ChildProduct filtered by the name column
 * @method     ChildProduct findOneByArticle(string $article) Return the first ChildProduct filtered by the article column
 * @method     ChildProduct findOneByDescription(string $description) Return the first ChildProduct filtered by the description column
 * @method     ChildProduct findOneByIsKdn(boolean $is_kdn) Return the first ChildProduct filtered by the is_kdn column
 * @method     ChildProduct findOneByHasComponent(boolean $has_component) Return the first ChildProduct filtered by the has_component column
 * @method     ChildProduct findOneByCostPrice(double $cost_price) Return the first ChildProduct filtered by the cost_price column
 * @method     ChildProduct findOneByListPrice(double $list_price) Return the first ChildProduct filtered by the list_price column
 * @method     ChildProduct findOneByCubicAsb(double $cubic_asb) Return the first ChildProduct filtered by the cubic_asb column
 * @method     ChildProduct findOneByCubicKdn(double $cubic_kdn) Return the first ChildProduct filtered by the cubic_kdn column
 * @method     ChildProduct findOneByWidthAsb(double $width_asb) Return the first ChildProduct filtered by the width_asb column
 * @method     ChildProduct findOneByHeightAsb(double $height_asb) Return the first ChildProduct filtered by the height_asb column
 * @method     ChildProduct findOneByDepthAsb(double $depth_asb) Return the first ChildProduct filtered by the depth_asb column
 * @method     ChildProduct findOneByWidthKdn(double $width_kdn) Return the first ChildProduct filtered by the width_kdn column
 * @method     ChildProduct findOneByHeightKdn(double $height_kdn) Return the first ChildProduct filtered by the height_kdn column
 * @method     ChildProduct findOneByDepthKdn(double $depth_kdn) Return the first ChildProduct filtered by the depth_kdn column
 * @method     ChildProduct findOneByNetCubic(double $net_cubic) Return the first ChildProduct filtered by the net_cubic column
 * @method     ChildProduct findOneByCreatedAt(string $created_at) Return the first ChildProduct filtered by the created_at column
 * @method     ChildProduct findOneByUpdatedAt(string $updated_at) Return the first ChildProduct filtered by the updated_at column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneById(int $id) Return the first ChildProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $name) Return the first ChildProduct filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByArticle(string $article) Return the first ChildProduct filtered by the article column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDescription(string $description) Return the first ChildProduct filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByIsKdn(boolean $is_kdn) Return the first ChildProduct filtered by the is_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByHasComponent(boolean $has_component) Return the first ChildProduct filtered by the has_component column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCostPrice(double $cost_price) Return the first ChildProduct filtered by the cost_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByListPrice(double $list_price) Return the first ChildProduct filtered by the list_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCubicAsb(double $cubic_asb) Return the first ChildProduct filtered by the cubic_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCubicKdn(double $cubic_kdn) Return the first ChildProduct filtered by the cubic_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByWidthAsb(double $width_asb) Return the first ChildProduct filtered by the width_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByHeightAsb(double $height_asb) Return the first ChildProduct filtered by the height_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDepthAsb(double $depth_asb) Return the first ChildProduct filtered by the depth_asb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByWidthKdn(double $width_kdn) Return the first ChildProduct filtered by the width_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByHeightKdn(double $height_kdn) Return the first ChildProduct filtered by the height_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByDepthKdn(double $depth_kdn) Return the first ChildProduct filtered by the depth_kdn column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByNetCubic(double $net_cubic) Return the first ChildProduct filtered by the net_cubic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCreatedAt(string $created_at) Return the first ChildProduct filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByUpdatedAt(string $updated_at) Return the first ChildProduct filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findById(int $id) Return ChildProduct objects filtered by the id column
 * @method     ChildProduct[]|ObjectCollection findByName(string $name) Return ChildProduct objects filtered by the name column
 * @method     ChildProduct[]|ObjectCollection findByArticle(string $article) Return ChildProduct objects filtered by the article column
 * @method     ChildProduct[]|ObjectCollection findByDescription(string $description) Return ChildProduct objects filtered by the description column
 * @method     ChildProduct[]|ObjectCollection findByIsKdn(boolean $is_kdn) Return ChildProduct objects filtered by the is_kdn column
 * @method     ChildProduct[]|ObjectCollection findByHasComponent(boolean $has_component) Return ChildProduct objects filtered by the has_component column
 * @method     ChildProduct[]|ObjectCollection findByCostPrice(double $cost_price) Return ChildProduct objects filtered by the cost_price column
 * @method     ChildProduct[]|ObjectCollection findByListPrice(double $list_price) Return ChildProduct objects filtered by the list_price column
 * @method     ChildProduct[]|ObjectCollection findByCubicAsb(double $cubic_asb) Return ChildProduct objects filtered by the cubic_asb column
 * @method     ChildProduct[]|ObjectCollection findByCubicKdn(double $cubic_kdn) Return ChildProduct objects filtered by the cubic_kdn column
 * @method     ChildProduct[]|ObjectCollection findByWidthAsb(double $width_asb) Return ChildProduct objects filtered by the width_asb column
 * @method     ChildProduct[]|ObjectCollection findByHeightAsb(double $height_asb) Return ChildProduct objects filtered by the height_asb column
 * @method     ChildProduct[]|ObjectCollection findByDepthAsb(double $depth_asb) Return ChildProduct objects filtered by the depth_asb column
 * @method     ChildProduct[]|ObjectCollection findByWidthKdn(double $width_kdn) Return ChildProduct objects filtered by the width_kdn column
 * @method     ChildProduct[]|ObjectCollection findByHeightKdn(double $height_kdn) Return ChildProduct objects filtered by the height_kdn column
 * @method     ChildProduct[]|ObjectCollection findByDepthKdn(double $depth_kdn) Return ChildProduct objects filtered by the depth_kdn column
 * @method     ChildProduct[]|ObjectCollection findByNetCubic(double $net_cubic) Return ChildProduct objects filtered by the net_cubic column
 * @method     ChildProduct[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProduct objects filtered by the created_at column
 * @method     ChildProduct[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProduct objects filtered by the updated_at column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, article, description, is_kdn, has_component, cost_price, list_price, cubic_asb, cubic_kdn, width_asb, height_asb, depth_asb, width_kdn, height_kdn, depth_kdn, net_cubic, created_at, updated_at FROM product WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the article column
     *
     * Example usage:
     * <code>
     * $query->filterByArticle('fooValue');   // WHERE article = 'fooValue'
     * $query->filterByArticle('%fooValue%', Criteria::LIKE); // WHERE article LIKE '%fooValue%'
     * </code>
     *
     * @param     string $article The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByArticle($article = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($article)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_ARTICLE, $article, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the is_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByIsKdn(true); // WHERE is_kdn = true
     * $query->filterByIsKdn('yes'); // WHERE is_kdn = true
     * </code>
     *
     * @param     boolean|string $isKdn The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByIsKdn($isKdn = null, $comparison = null)
    {
        if (is_string($isKdn)) {
            $isKdn = in_array(strtolower($isKdn), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_IS_KDN, $isKdn, $comparison);
    }

    /**
     * Filter the query on the has_component column
     *
     * Example usage:
     * <code>
     * $query->filterByHasComponent(true); // WHERE has_component = true
     * $query->filterByHasComponent('yes'); // WHERE has_component = true
     * </code>
     *
     * @param     boolean|string $hasComponent The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByHasComponent($hasComponent = null, $comparison = null)
    {
        if (is_string($hasComponent)) {
            $hasComponent = in_array(strtolower($hasComponent), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProductTableMap::COL_HAS_COMPONENT, $hasComponent, $comparison);
    }

    /**
     * Filter the query on the cost_price column
     *
     * Example usage:
     * <code>
     * $query->filterByCostPrice(1234); // WHERE cost_price = 1234
     * $query->filterByCostPrice(array(12, 34)); // WHERE cost_price IN (12, 34)
     * $query->filterByCostPrice(array('min' => 12)); // WHERE cost_price > 12
     * </code>
     *
     * @param     mixed $costPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCostPrice($costPrice = null, $comparison = null)
    {
        if (is_array($costPrice)) {
            $useMinMax = false;
            if (isset($costPrice['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_COST_PRICE, $costPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($costPrice['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_COST_PRICE, $costPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_COST_PRICE, $costPrice, $comparison);
    }

    /**
     * Filter the query on the list_price column
     *
     * Example usage:
     * <code>
     * $query->filterByListPrice(1234); // WHERE list_price = 1234
     * $query->filterByListPrice(array(12, 34)); // WHERE list_price IN (12, 34)
     * $query->filterByListPrice(array('min' => 12)); // WHERE list_price > 12
     * </code>
     *
     * @param     mixed $listPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByListPrice($listPrice = null, $comparison = null)
    {
        if (is_array($listPrice)) {
            $useMinMax = false;
            if (isset($listPrice['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_LIST_PRICE, $listPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($listPrice['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_LIST_PRICE, $listPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_LIST_PRICE, $listPrice, $comparison);
    }

    /**
     * Filter the query on the cubic_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByCubicAsb(1234); // WHERE cubic_asb = 1234
     * $query->filterByCubicAsb(array(12, 34)); // WHERE cubic_asb IN (12, 34)
     * $query->filterByCubicAsb(array('min' => 12)); // WHERE cubic_asb > 12
     * </code>
     *
     * @param     mixed $cubicAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCubicAsb($cubicAsb = null, $comparison = null)
    {
        if (is_array($cubicAsb)) {
            $useMinMax = false;
            if (isset($cubicAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_ASB, $cubicAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cubicAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_ASB, $cubicAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CUBIC_ASB, $cubicAsb, $comparison);
    }

    /**
     * Filter the query on the cubic_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByCubicKdn(1234); // WHERE cubic_kdn = 1234
     * $query->filterByCubicKdn(array(12, 34)); // WHERE cubic_kdn IN (12, 34)
     * $query->filterByCubicKdn(array('min' => 12)); // WHERE cubic_kdn > 12
     * </code>
     *
     * @param     mixed $cubicKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCubicKdn($cubicKdn = null, $comparison = null)
    {
        if (is_array($cubicKdn)) {
            $useMinMax = false;
            if (isset($cubicKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_KDN, $cubicKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cubicKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CUBIC_KDN, $cubicKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CUBIC_KDN, $cubicKdn, $comparison);
    }

    /**
     * Filter the query on the width_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByWidthAsb(1234); // WHERE width_asb = 1234
     * $query->filterByWidthAsb(array(12, 34)); // WHERE width_asb IN (12, 34)
     * $query->filterByWidthAsb(array('min' => 12)); // WHERE width_asb > 12
     * </code>
     *
     * @param     mixed $widthAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByWidthAsb($widthAsb = null, $comparison = null)
    {
        if (is_array($widthAsb)) {
            $useMinMax = false;
            if (isset($widthAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_ASB, $widthAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($widthAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_ASB, $widthAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_WIDTH_ASB, $widthAsb, $comparison);
    }

    /**
     * Filter the query on the height_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByHeightAsb(1234); // WHERE height_asb = 1234
     * $query->filterByHeightAsb(array(12, 34)); // WHERE height_asb IN (12, 34)
     * $query->filterByHeightAsb(array('min' => 12)); // WHERE height_asb > 12
     * </code>
     *
     * @param     mixed $heightAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByHeightAsb($heightAsb = null, $comparison = null)
    {
        if (is_array($heightAsb)) {
            $useMinMax = false;
            if (isset($heightAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_ASB, $heightAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($heightAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_ASB, $heightAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_HEIGHT_ASB, $heightAsb, $comparison);
    }

    /**
     * Filter the query on the depth_asb column
     *
     * Example usage:
     * <code>
     * $query->filterByDepthAsb(1234); // WHERE depth_asb = 1234
     * $query->filterByDepthAsb(array(12, 34)); // WHERE depth_asb IN (12, 34)
     * $query->filterByDepthAsb(array('min' => 12)); // WHERE depth_asb > 12
     * </code>
     *
     * @param     mixed $depthAsb The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDepthAsb($depthAsb = null, $comparison = null)
    {
        if (is_array($depthAsb)) {
            $useMinMax = false;
            if (isset($depthAsb['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_ASB, $depthAsb['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depthAsb['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_ASB, $depthAsb['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DEPTH_ASB, $depthAsb, $comparison);
    }

    /**
     * Filter the query on the width_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByWidthKdn(1234); // WHERE width_kdn = 1234
     * $query->filterByWidthKdn(array(12, 34)); // WHERE width_kdn IN (12, 34)
     * $query->filterByWidthKdn(array('min' => 12)); // WHERE width_kdn > 12
     * </code>
     *
     * @param     mixed $widthKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByWidthKdn($widthKdn = null, $comparison = null)
    {
        if (is_array($widthKdn)) {
            $useMinMax = false;
            if (isset($widthKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_KDN, $widthKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($widthKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_WIDTH_KDN, $widthKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_WIDTH_KDN, $widthKdn, $comparison);
    }

    /**
     * Filter the query on the height_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByHeightKdn(1234); // WHERE height_kdn = 1234
     * $query->filterByHeightKdn(array(12, 34)); // WHERE height_kdn IN (12, 34)
     * $query->filterByHeightKdn(array('min' => 12)); // WHERE height_kdn > 12
     * </code>
     *
     * @param     mixed $heightKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByHeightKdn($heightKdn = null, $comparison = null)
    {
        if (is_array($heightKdn)) {
            $useMinMax = false;
            if (isset($heightKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_KDN, $heightKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($heightKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_HEIGHT_KDN, $heightKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_HEIGHT_KDN, $heightKdn, $comparison);
    }

    /**
     * Filter the query on the depth_kdn column
     *
     * Example usage:
     * <code>
     * $query->filterByDepthKdn(1234); // WHERE depth_kdn = 1234
     * $query->filterByDepthKdn(array(12, 34)); // WHERE depth_kdn IN (12, 34)
     * $query->filterByDepthKdn(array('min' => 12)); // WHERE depth_kdn > 12
     * </code>
     *
     * @param     mixed $depthKdn The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByDepthKdn($depthKdn = null, $comparison = null)
    {
        if (is_array($depthKdn)) {
            $useMinMax = false;
            if (isset($depthKdn['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_KDN, $depthKdn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depthKdn['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_DEPTH_KDN, $depthKdn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_DEPTH_KDN, $depthKdn, $comparison);
    }

    /**
     * Filter the query on the net_cubic column
     *
     * Example usage:
     * <code>
     * $query->filterByNetCubic(1234); // WHERE net_cubic = 1234
     * $query->filterByNetCubic(array(12, 34)); // WHERE net_cubic IN (12, 34)
     * $query->filterByNetCubic(array('min' => 12)); // WHERE net_cubic > 12
     * </code>
     *
     * @param     mixed $netCubic The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByNetCubic($netCubic = null, $comparison = null)
    {
        if (is_array($netCubic)) {
            $useMinMax = false;
            if (isset($netCubic['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_NET_CUBIC, $netCubic['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($netCubic['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_NET_CUBIC, $netCubic['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_NET_CUBIC, $netCubic, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProductComponent object
     *
     * @param \ProductComponent|ObjectCollection $productComponent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductComponent($productComponent, $comparison = null)
    {
        if ($productComponent instanceof \ProductComponent) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productComponent->getProductId(), $comparison);
        } elseif ($productComponent instanceof ObjectCollection) {
            return $this
                ->useProductComponentQuery()
                ->filterByPrimaryKeys($productComponent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductComponent() only accepts arguments of type \ProductComponent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductComponent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductComponent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductComponent');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductComponent');
        }

        return $this;
    }

    /**
     * Use the ProductComponent relation ProductComponent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductComponentQuery A secondary query class using the current class as primary query
     */
    public function useProductComponentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductComponent', '\ProductComponentQuery');
    }

    /**
     * Filter the query by a related \ProductCustomer object
     *
     * @param \ProductCustomer|ObjectCollection $productCustomer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductCustomer($productCustomer, $comparison = null)
    {
        if ($productCustomer instanceof \ProductCustomer) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productCustomer->getProductId(), $comparison);
        } elseif ($productCustomer instanceof ObjectCollection) {
            return $this
                ->useProductCustomerQuery()
                ->filterByPrimaryKeys($productCustomer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductCustomer() only accepts arguments of type \ProductCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductCustomer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductCustomer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductCustomer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductCustomer');
        }

        return $this;
    }

    /**
     * Use the ProductCustomer relation ProductCustomer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductCustomerQuery A secondary query class using the current class as primary query
     */
    public function useProductCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductCustomer', '\ProductCustomerQuery');
    }

    /**
     * Filter the query by a related \ProductFinishing object
     *
     * @param \ProductFinishing|ObjectCollection $productFinishing the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductFinishing($productFinishing, $comparison = null)
    {
        if ($productFinishing instanceof \ProductFinishing) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productFinishing->getProductId(), $comparison);
        } elseif ($productFinishing instanceof ObjectCollection) {
            return $this
                ->useProductFinishingQuery()
                ->filterByPrimaryKeys($productFinishing->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductFinishing() only accepts arguments of type \ProductFinishing or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductFinishing relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductFinishing($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductFinishing');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductFinishing');
        }

        return $this;
    }

    /**
     * Use the ProductFinishing relation ProductFinishing object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductFinishingQuery A secondary query class using the current class as primary query
     */
    public function useProductFinishingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductFinishing($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductFinishing', '\ProductFinishingQuery');
    }

    /**
     * Filter the query by a related \ProductImage object
     *
     * @param \ProductImage|ObjectCollection $productImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterByProductImage($productImage, $comparison = null)
    {
        if ($productImage instanceof \ProductImage) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_ID, $productImage->getProductId(), $comparison);
        } elseif ($productImage instanceof ObjectCollection) {
            return $this
                ->useProductImageQuery()
                ->filterByPrimaryKeys($productImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductImage() only accepts arguments of type \ProductImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function joinProductImage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductImage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProductImage');
        }

        return $this;
    }

    /**
     * Use the ProductImage relation ProductImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductImageQuery A secondary query class using the current class as primary query
     */
    public function useProductImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductImage', '\ProductImageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_ID, $product->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductQuery
