<?php

namespace Base;

use \ComponentProduct as ChildComponentProduct;
use \ComponentProductQuery as ChildComponentProductQuery;
use \Exception;
use \PDO;
use Map\ComponentProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'component_product' table.
 *
 *
 *
 * @method     ChildComponentProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildComponentProductQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildComponentProductQuery orderByComponentId($order = Criteria::ASC) Order by the component_id column
 * @method     ChildComponentProductQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildComponentProductQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildComponentProductQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildComponentProductQuery groupById() Group by the id column
 * @method     ChildComponentProductQuery groupByProductId() Group by the product_id column
 * @method     ChildComponentProductQuery groupByComponentId() Group by the component_id column
 * @method     ChildComponentProductQuery groupByQty() Group by the qty column
 * @method     ChildComponentProductQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildComponentProductQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildComponentProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildComponentProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildComponentProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildComponentProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildComponentProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildComponentProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildComponentProductQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildComponentProductQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildComponentProductQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildComponentProductQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildComponentProductQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildComponentProductQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildComponentProductQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildComponentProductQuery leftJoinComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Component relation
 * @method     ChildComponentProductQuery rightJoinComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Component relation
 * @method     ChildComponentProductQuery innerJoinComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the Component relation
 *
 * @method     ChildComponentProductQuery joinWithComponent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Component relation
 *
 * @method     ChildComponentProductQuery leftJoinWithComponent() Adds a LEFT JOIN clause and with to the query using the Component relation
 * @method     ChildComponentProductQuery rightJoinWithComponent() Adds a RIGHT JOIN clause and with to the query using the Component relation
 * @method     ChildComponentProductQuery innerJoinWithComponent() Adds a INNER JOIN clause and with to the query using the Component relation
 *
 * @method     \ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildComponentProduct findOne(ConnectionInterface $con = null) Return the first ChildComponentProduct matching the query
 * @method     ChildComponentProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildComponentProduct matching the query, or a new ChildComponentProduct object populated from the query conditions when no match is found
 *
 * @method     ChildComponentProduct findOneById(int $id) Return the first ChildComponentProduct filtered by the id column
 * @method     ChildComponentProduct findOneByProductId(int $product_id) Return the first ChildComponentProduct filtered by the product_id column
 * @method     ChildComponentProduct findOneByComponentId(int $component_id) Return the first ChildComponentProduct filtered by the component_id column
 * @method     ChildComponentProduct findOneByQty(int $qty) Return the first ChildComponentProduct filtered by the qty column
 * @method     ChildComponentProduct findOneByCreatedAt(string $created_at) Return the first ChildComponentProduct filtered by the created_at column
 * @method     ChildComponentProduct findOneByUpdatedAt(string $updated_at) Return the first ChildComponentProduct filtered by the updated_at column *

 * @method     ChildComponentProduct requirePk($key, ConnectionInterface $con = null) Return the ChildComponentProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentProduct requireOne(ConnectionInterface $con = null) Return the first ChildComponentProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComponentProduct requireOneById(int $id) Return the first ChildComponentProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentProduct requireOneByProductId(int $product_id) Return the first ChildComponentProduct filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentProduct requireOneByComponentId(int $component_id) Return the first ChildComponentProduct filtered by the component_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentProduct requireOneByQty(int $qty) Return the first ChildComponentProduct filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentProduct requireOneByCreatedAt(string $created_at) Return the first ChildComponentProduct filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentProduct requireOneByUpdatedAt(string $updated_at) Return the first ChildComponentProduct filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComponentProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildComponentProduct objects based on current ModelCriteria
 * @method     ChildComponentProduct[]|ObjectCollection findById(int $id) Return ChildComponentProduct objects filtered by the id column
 * @method     ChildComponentProduct[]|ObjectCollection findByProductId(int $product_id) Return ChildComponentProduct objects filtered by the product_id column
 * @method     ChildComponentProduct[]|ObjectCollection findByComponentId(int $component_id) Return ChildComponentProduct objects filtered by the component_id column
 * @method     ChildComponentProduct[]|ObjectCollection findByQty(int $qty) Return ChildComponentProduct objects filtered by the qty column
 * @method     ChildComponentProduct[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildComponentProduct objects filtered by the created_at column
 * @method     ChildComponentProduct[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildComponentProduct objects filtered by the updated_at column
 * @method     ChildComponentProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ComponentProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ComponentProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ComponentProduct', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildComponentProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildComponentProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildComponentProductQuery) {
            return $criteria;
        }
        $query = new ChildComponentProductQuery();
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
     * @return ChildComponentProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ComponentProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ComponentProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildComponentProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, product_id, component_id, qty, created_at, updated_at FROM component_product WHERE id = :p0';
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
            /** @var ChildComponentProduct $obj */
            $obj = new ChildComponentProduct();
            $obj->hydrate($row);
            ComponentProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildComponentProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ComponentProductTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ComponentProductTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentProductTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @see       filterByProduct()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentProductTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the component_id column
     *
     * Example usage:
     * <code>
     * $query->filterByComponentId(1234); // WHERE component_id = 1234
     * $query->filterByComponentId(array(12, 34)); // WHERE component_id IN (12, 34)
     * $query->filterByComponentId(array('min' => 12)); // WHERE component_id > 12
     * </code>
     *
     * @see       filterByComponent()
     *
     * @param     mixed $componentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByComponentId($componentId = null, $comparison = null)
    {
        if (is_array($componentId)) {
            $useMinMax = false;
            if (isset($componentId['min'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_COMPONENT_ID, $componentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($componentId['max'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_COMPONENT_ID, $componentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentProductTableMap::COL_COMPONENT_ID, $componentId, $comparison);
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param     mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentProductTableMap::COL_QTY, $qty, $comparison);
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
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentProductTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ComponentProductTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentProductTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(ComponentProductTableMap::COL_PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComponentProductTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\ProductQuery');
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildComponentProductQuery The current query, for fluid interface
     */
    public function filterByComponent($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(ComponentProductTableMap::COL_COMPONENT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComponentProductTableMap::COL_COMPONENT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByComponent() only accepts arguments of type \Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Component relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function joinComponent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Component');

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
            $this->addJoinObject($join, 'Component');
        }

        return $this;
    }

    /**
     * Use the Component relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductQuery A secondary query class using the current class as primary query
     */
    public function useComponentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Component', '\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildComponentProduct $componentProduct Object to remove from the list of results
     *
     * @return $this|ChildComponentProductQuery The current query, for fluid interface
     */
    public function prune($componentProduct = null)
    {
        if ($componentProduct) {
            $this->addUsingAlias(ComponentProductTableMap::COL_ID, $componentProduct->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the component_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ComponentProductTableMap::clearInstancePool();
            ComponentProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ComponentProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ComponentProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ComponentProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ComponentProductQuery
