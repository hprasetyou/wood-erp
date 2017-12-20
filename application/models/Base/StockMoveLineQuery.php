<?php

namespace Base;

use \StockMoveLine as ChildStockMoveLine;
use \StockMoveLineQuery as ChildStockMoveLineQuery;
use \Exception;
use \PDO;
use Map\StockMoveLineTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stock_move_line' table.
 *
 *
 *
 * @method     ChildStockMoveLineQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStockMoveLineQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStockMoveLineQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildStockMoveLineQuery orderByStockMoveId($order = Criteria::ASC) Order by the stock_move_id column
 * @method     ChildStockMoveLineQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildStockMoveLineQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildStockMoveLineQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildStockMoveLineQuery groupById() Group by the id column
 * @method     ChildStockMoveLineQuery groupByName() Group by the name column
 * @method     ChildStockMoveLineQuery groupByProductId() Group by the product_id column
 * @method     ChildStockMoveLineQuery groupByStockMoveId() Group by the stock_move_id column
 * @method     ChildStockMoveLineQuery groupByQty() Group by the qty column
 * @method     ChildStockMoveLineQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildStockMoveLineQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildStockMoveLineQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStockMoveLineQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStockMoveLineQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStockMoveLineQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStockMoveLineQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStockMoveLineQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStockMoveLineQuery leftJoinStockMove($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockMove relation
 * @method     ChildStockMoveLineQuery rightJoinStockMove($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockMove relation
 * @method     ChildStockMoveLineQuery innerJoinStockMove($relationAlias = null) Adds a INNER JOIN clause to the query using the StockMove relation
 *
 * @method     ChildStockMoveLineQuery joinWithStockMove($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockMove relation
 *
 * @method     ChildStockMoveLineQuery leftJoinWithStockMove() Adds a LEFT JOIN clause and with to the query using the StockMove relation
 * @method     ChildStockMoveLineQuery rightJoinWithStockMove() Adds a RIGHT JOIN clause and with to the query using the StockMove relation
 * @method     ChildStockMoveLineQuery innerJoinWithStockMove() Adds a INNER JOIN clause and with to the query using the StockMove relation
 *
 * @method     ChildStockMoveLineQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildStockMoveLineQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildStockMoveLineQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildStockMoveLineQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildStockMoveLineQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildStockMoveLineQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildStockMoveLineQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \StockMoveQuery|\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStockMoveLine findOne(ConnectionInterface $con = null) Return the first ChildStockMoveLine matching the query
 * @method     ChildStockMoveLine findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStockMoveLine matching the query, or a new ChildStockMoveLine object populated from the query conditions when no match is found
 *
 * @method     ChildStockMoveLine findOneById(int $id) Return the first ChildStockMoveLine filtered by the id column
 * @method     ChildStockMoveLine findOneByName(string $name) Return the first ChildStockMoveLine filtered by the name column
 * @method     ChildStockMoveLine findOneByProductId(int $product_id) Return the first ChildStockMoveLine filtered by the product_id column
 * @method     ChildStockMoveLine findOneByStockMoveId(int $stock_move_id) Return the first ChildStockMoveLine filtered by the stock_move_id column
 * @method     ChildStockMoveLine findOneByQty(int $qty) Return the first ChildStockMoveLine filtered by the qty column
 * @method     ChildStockMoveLine findOneByCreatedAt(string $created_at) Return the first ChildStockMoveLine filtered by the created_at column
 * @method     ChildStockMoveLine findOneByUpdatedAt(string $updated_at) Return the first ChildStockMoveLine filtered by the updated_at column *

 * @method     ChildStockMoveLine requirePk($key, ConnectionInterface $con = null) Return the ChildStockMoveLine by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOne(ConnectionInterface $con = null) Return the first ChildStockMoveLine matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockMoveLine requireOneById(int $id) Return the first ChildStockMoveLine filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOneByName(string $name) Return the first ChildStockMoveLine filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOneByProductId(int $product_id) Return the first ChildStockMoveLine filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOneByStockMoveId(int $stock_move_id) Return the first ChildStockMoveLine filtered by the stock_move_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOneByQty(int $qty) Return the first ChildStockMoveLine filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOneByCreatedAt(string $created_at) Return the first ChildStockMoveLine filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMoveLine requireOneByUpdatedAt(string $updated_at) Return the first ChildStockMoveLine filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockMoveLine[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStockMoveLine objects based on current ModelCriteria
 * @method     ChildStockMoveLine[]|ObjectCollection findById(int $id) Return ChildStockMoveLine objects filtered by the id column
 * @method     ChildStockMoveLine[]|ObjectCollection findByName(string $name) Return ChildStockMoveLine objects filtered by the name column
 * @method     ChildStockMoveLine[]|ObjectCollection findByProductId(int $product_id) Return ChildStockMoveLine objects filtered by the product_id column
 * @method     ChildStockMoveLine[]|ObjectCollection findByStockMoveId(int $stock_move_id) Return ChildStockMoveLine objects filtered by the stock_move_id column
 * @method     ChildStockMoveLine[]|ObjectCollection findByQty(int $qty) Return ChildStockMoveLine objects filtered by the qty column
 * @method     ChildStockMoveLine[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildStockMoveLine objects filtered by the created_at column
 * @method     ChildStockMoveLine[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildStockMoveLine objects filtered by the updated_at column
 * @method     ChildStockMoveLine[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StockMoveLineQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StockMoveLineQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\StockMoveLine', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStockMoveLineQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStockMoveLineQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStockMoveLineQuery) {
            return $criteria;
        }
        $query = new ChildStockMoveLineQuery();
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
     * @return ChildStockMoveLine|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StockMoveLineTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StockMoveLineTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStockMoveLine A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, product_id, stock_move_id, qty, created_at, updated_at FROM stock_move_line WHERE id = :p0';
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
            /** @var ChildStockMoveLine $obj */
            $obj = new ChildStockMoveLine();
            $obj->hydrate($row);
            StockMoveLineTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStockMoveLine|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StockMoveLineTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StockMoveLineTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the stock_move_id column
     *
     * Example usage:
     * <code>
     * $query->filterByStockMoveId(1234); // WHERE stock_move_id = 1234
     * $query->filterByStockMoveId(array(12, 34)); // WHERE stock_move_id IN (12, 34)
     * $query->filterByStockMoveId(array('min' => 12)); // WHERE stock_move_id > 12
     * </code>
     *
     * @see       filterByStockMove()
     *
     * @param     mixed $stockMoveId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByStockMoveId($stockMoveId = null, $comparison = null)
    {
        if (is_array($stockMoveId)) {
            $useMinMax = false;
            if (isset($stockMoveId['min'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_STOCK_MOVE_ID, $stockMoveId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stockMoveId['max'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_STOCK_MOVE_ID, $stockMoveId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_STOCK_MOVE_ID, $stockMoveId, $comparison);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_QTY, $qty, $comparison);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(StockMoveLineTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveLineTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \StockMove object
     *
     * @param \StockMove|ObjectCollection $stockMove The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByStockMove($stockMove, $comparison = null)
    {
        if ($stockMove instanceof \StockMove) {
            return $this
                ->addUsingAlias(StockMoveLineTableMap::COL_STOCK_MOVE_ID, $stockMove->getId(), $comparison);
        } elseif ($stockMove instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StockMoveLineTableMap::COL_STOCK_MOVE_ID, $stockMove->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByStockMove() only accepts arguments of type \StockMove or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockMove relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function joinStockMove($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockMove');

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
            $this->addJoinObject($join, 'StockMove');
        }

        return $this;
    }

    /**
     * Use the StockMove relation StockMove object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StockMoveQuery A secondary query class using the current class as primary query
     */
    public function useStockMoveQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockMove($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockMove', '\StockMoveQuery');
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(StockMoveLineTableMap::COL_PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StockMoveLineTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildStockMoveLine $stockMoveLine Object to remove from the list of results
     *
     * @return $this|ChildStockMoveLineQuery The current query, for fluid interface
     */
    public function prune($stockMoveLine = null)
    {
        if ($stockMoveLine) {
            $this->addUsingAlias(StockMoveLineTableMap::COL_ID, $stockMoveLine->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stock_move_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockMoveLineTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StockMoveLineTableMap::clearInstancePool();
            StockMoveLineTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StockMoveLineTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StockMoveLineTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StockMoveLineTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StockMoveLineTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StockMoveLineQuery
