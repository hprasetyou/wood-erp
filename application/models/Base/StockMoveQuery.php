<?php

namespace Base;

use \StockMove as ChildStockMove;
use \StockMoveQuery as ChildStockMoveQuery;
use \Exception;
use \PDO;
use Map\StockMoveTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'stock_move' table.
 *
 *
 *
 * @method     ChildStockMoveQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStockMoveQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildStockMoveQuery orderBySrcId($order = Criteria::ASC) Order by the src_id column
 * @method     ChildStockMoveQuery orderByDestId($order = Criteria::ASC) Order by the dest_id column
 * @method     ChildStockMoveQuery orderByOperation($order = Criteria::ASC) Order by the operation column
 * @method     ChildStockMoveQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildStockMoveQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildStockMoveQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildStockMoveQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildStockMoveQuery groupById() Group by the id column
 * @method     ChildStockMoveQuery groupByName() Group by the name column
 * @method     ChildStockMoveQuery groupBySrcId() Group by the src_id column
 * @method     ChildStockMoveQuery groupByDestId() Group by the dest_id column
 * @method     ChildStockMoveQuery groupByOperation() Group by the operation column
 * @method     ChildStockMoveQuery groupByState() Group by the state column
 * @method     ChildStockMoveQuery groupByActive() Group by the active column
 * @method     ChildStockMoveQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildStockMoveQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildStockMoveQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStockMoveQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStockMoveQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStockMoveQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStockMoveQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStockMoveQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStockMoveQuery leftJoinSrc($relationAlias = null) Adds a LEFT JOIN clause to the query using the Src relation
 * @method     ChildStockMoveQuery rightJoinSrc($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Src relation
 * @method     ChildStockMoveQuery innerJoinSrc($relationAlias = null) Adds a INNER JOIN clause to the query using the Src relation
 *
 * @method     ChildStockMoveQuery joinWithSrc($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Src relation
 *
 * @method     ChildStockMoveQuery leftJoinWithSrc() Adds a LEFT JOIN clause and with to the query using the Src relation
 * @method     ChildStockMoveQuery rightJoinWithSrc() Adds a RIGHT JOIN clause and with to the query using the Src relation
 * @method     ChildStockMoveQuery innerJoinWithSrc() Adds a INNER JOIN clause and with to the query using the Src relation
 *
 * @method     ChildStockMoveQuery leftJoinDest($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dest relation
 * @method     ChildStockMoveQuery rightJoinDest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dest relation
 * @method     ChildStockMoveQuery innerJoinDest($relationAlias = null) Adds a INNER JOIN clause to the query using the Dest relation
 *
 * @method     ChildStockMoveQuery joinWithDest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dest relation
 *
 * @method     ChildStockMoveQuery leftJoinWithDest() Adds a LEFT JOIN clause and with to the query using the Dest relation
 * @method     ChildStockMoveQuery rightJoinWithDest() Adds a RIGHT JOIN clause and with to the query using the Dest relation
 * @method     ChildStockMoveQuery innerJoinWithDest() Adds a INNER JOIN clause and with to the query using the Dest relation
 *
 * @method     ChildStockMoveQuery leftJoinStockMoveLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockMoveLine relation
 * @method     ChildStockMoveQuery rightJoinStockMoveLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockMoveLine relation
 * @method     ChildStockMoveQuery innerJoinStockMoveLine($relationAlias = null) Adds a INNER JOIN clause to the query using the StockMoveLine relation
 *
 * @method     ChildStockMoveQuery joinWithStockMoveLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockMoveLine relation
 *
 * @method     ChildStockMoveQuery leftJoinWithStockMoveLine() Adds a LEFT JOIN clause and with to the query using the StockMoveLine relation
 * @method     ChildStockMoveQuery rightJoinWithStockMoveLine() Adds a RIGHT JOIN clause and with to the query using the StockMoveLine relation
 * @method     ChildStockMoveQuery innerJoinWithStockMoveLine() Adds a INNER JOIN clause and with to the query using the StockMoveLine relation
 *
 * @method     \PartnerLocationQuery|\StockMoveLineQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStockMove findOne(ConnectionInterface $con = null) Return the first ChildStockMove matching the query
 * @method     ChildStockMove findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStockMove matching the query, or a new ChildStockMove object populated from the query conditions when no match is found
 *
 * @method     ChildStockMove findOneById(int $id) Return the first ChildStockMove filtered by the id column
 * @method     ChildStockMove findOneByName(string $name) Return the first ChildStockMove filtered by the name column
 * @method     ChildStockMove findOneBySrcId(int $src_id) Return the first ChildStockMove filtered by the src_id column
 * @method     ChildStockMove findOneByDestId(int $dest_id) Return the first ChildStockMove filtered by the dest_id column
 * @method     ChildStockMove findOneByOperation(string $operation) Return the first ChildStockMove filtered by the operation column
 * @method     ChildStockMove findOneByState(string $state) Return the first ChildStockMove filtered by the state column
 * @method     ChildStockMove findOneByActive(boolean $active) Return the first ChildStockMove filtered by the active column
 * @method     ChildStockMove findOneByCreatedAt(string $created_at) Return the first ChildStockMove filtered by the created_at column
 * @method     ChildStockMove findOneByUpdatedAt(string $updated_at) Return the first ChildStockMove filtered by the updated_at column *

 * @method     ChildStockMove requirePk($key, ConnectionInterface $con = null) Return the ChildStockMove by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOne(ConnectionInterface $con = null) Return the first ChildStockMove matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockMove requireOneById(int $id) Return the first ChildStockMove filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByName(string $name) Return the first ChildStockMove filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneBySrcId(int $src_id) Return the first ChildStockMove filtered by the src_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByDestId(int $dest_id) Return the first ChildStockMove filtered by the dest_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByOperation(string $operation) Return the first ChildStockMove filtered by the operation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByState(string $state) Return the first ChildStockMove filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByActive(boolean $active) Return the first ChildStockMove filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByCreatedAt(string $created_at) Return the first ChildStockMove filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStockMove requireOneByUpdatedAt(string $updated_at) Return the first ChildStockMove filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStockMove[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStockMove objects based on current ModelCriteria
 * @method     ChildStockMove[]|ObjectCollection findById(int $id) Return ChildStockMove objects filtered by the id column
 * @method     ChildStockMove[]|ObjectCollection findByName(string $name) Return ChildStockMove objects filtered by the name column
 * @method     ChildStockMove[]|ObjectCollection findBySrcId(int $src_id) Return ChildStockMove objects filtered by the src_id column
 * @method     ChildStockMove[]|ObjectCollection findByDestId(int $dest_id) Return ChildStockMove objects filtered by the dest_id column
 * @method     ChildStockMove[]|ObjectCollection findByOperation(string $operation) Return ChildStockMove objects filtered by the operation column
 * @method     ChildStockMove[]|ObjectCollection findByState(string $state) Return ChildStockMove objects filtered by the state column
 * @method     ChildStockMove[]|ObjectCollection findByActive(boolean $active) Return ChildStockMove objects filtered by the active column
 * @method     ChildStockMove[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildStockMove objects filtered by the created_at column
 * @method     ChildStockMove[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildStockMove objects filtered by the updated_at column
 * @method     ChildStockMove[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StockMoveQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\StockMoveQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\StockMove', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStockMoveQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStockMoveQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStockMoveQuery) {
            return $criteria;
        }
        $query = new ChildStockMoveQuery();
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
     * @return ChildStockMove|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StockMoveTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StockMoveTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildStockMove A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, src_id, dest_id, operation, state, active, created_at, updated_at FROM stock_move WHERE id = :p0';
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
            /** @var ChildStockMove $obj */
            $obj = new ChildStockMove();
            $obj->hydrate($row);
            StockMoveTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildStockMove|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StockMoveTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StockMoveTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the src_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySrcId(1234); // WHERE src_id = 1234
     * $query->filterBySrcId(array(12, 34)); // WHERE src_id IN (12, 34)
     * $query->filterBySrcId(array('min' => 12)); // WHERE src_id > 12
     * </code>
     *
     * @see       filterBySrc()
     *
     * @param     mixed $srcId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterBySrcId($srcId = null, $comparison = null)
    {
        if (is_array($srcId)) {
            $useMinMax = false;
            if (isset($srcId['min'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_SRC_ID, $srcId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($srcId['max'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_SRC_ID, $srcId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_SRC_ID, $srcId, $comparison);
    }

    /**
     * Filter the query on the dest_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDestId(1234); // WHERE dest_id = 1234
     * $query->filterByDestId(array(12, 34)); // WHERE dest_id IN (12, 34)
     * $query->filterByDestId(array('min' => 12)); // WHERE dest_id > 12
     * </code>
     *
     * @see       filterByDest()
     *
     * @param     mixed $destId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByDestId($destId = null, $comparison = null)
    {
        if (is_array($destId)) {
            $useMinMax = false;
            if (isset($destId['min'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_DEST_ID, $destId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($destId['max'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_DEST_ID, $destId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_DEST_ID, $destId, $comparison);
    }

    /**
     * Filter the query on the operation column
     *
     * Example usage:
     * <code>
     * $query->filterByOperation('fooValue');   // WHERE operation = 'fooValue'
     * $query->filterByOperation('%fooValue%', Criteria::LIKE); // WHERE operation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $operation The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByOperation($operation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($operation)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_OPERATION, $operation, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * Example usage:
     * <code>
     * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
     * $query->filterByState('%fooValue%', Criteria::LIKE); // WHERE state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $state The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(StockMoveTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StockMoveTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \PartnerLocation object
     *
     * @param \PartnerLocation|ObjectCollection $partnerLocation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterBySrc($partnerLocation, $comparison = null)
    {
        if ($partnerLocation instanceof \PartnerLocation) {
            return $this
                ->addUsingAlias(StockMoveTableMap::COL_SRC_ID, $partnerLocation->getId(), $comparison);
        } elseif ($partnerLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StockMoveTableMap::COL_SRC_ID, $partnerLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySrc() only accepts arguments of type \PartnerLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Src relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function joinSrc($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Src');

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
            $this->addJoinObject($join, 'Src');
        }

        return $this;
    }

    /**
     * Use the Src relation PartnerLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerLocationQuery A secondary query class using the current class as primary query
     */
    public function useSrcQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSrc($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Src', '\PartnerLocationQuery');
    }

    /**
     * Filter the query by a related \PartnerLocation object
     *
     * @param \PartnerLocation|ObjectCollection $partnerLocation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByDest($partnerLocation, $comparison = null)
    {
        if ($partnerLocation instanceof \PartnerLocation) {
            return $this
                ->addUsingAlias(StockMoveTableMap::COL_DEST_ID, $partnerLocation->getId(), $comparison);
        } elseif ($partnerLocation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(StockMoveTableMap::COL_DEST_ID, $partnerLocation->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDest() only accepts arguments of type \PartnerLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dest relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function joinDest($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dest');

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
            $this->addJoinObject($join, 'Dest');
        }

        return $this;
    }

    /**
     * Use the Dest relation PartnerLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerLocationQuery A secondary query class using the current class as primary query
     */
    public function useDestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dest', '\PartnerLocationQuery');
    }

    /**
     * Filter the query by a related \StockMoveLine object
     *
     * @param \StockMoveLine|ObjectCollection $stockMoveLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStockMoveQuery The current query, for fluid interface
     */
    public function filterByStockMoveLine($stockMoveLine, $comparison = null)
    {
        if ($stockMoveLine instanceof \StockMoveLine) {
            return $this
                ->addUsingAlias(StockMoveTableMap::COL_ID, $stockMoveLine->getStockMoveId(), $comparison);
        } elseif ($stockMoveLine instanceof ObjectCollection) {
            return $this
                ->useStockMoveLineQuery()
                ->filterByPrimaryKeys($stockMoveLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByStockMoveLine() only accepts arguments of type \StockMoveLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockMoveLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function joinStockMoveLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockMoveLine');

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
            $this->addJoinObject($join, 'StockMoveLine');
        }

        return $this;
    }

    /**
     * Use the StockMoveLine relation StockMoveLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \StockMoveLineQuery A secondary query class using the current class as primary query
     */
    public function useStockMoveLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockMoveLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockMoveLine', '\StockMoveLineQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStockMove $stockMove Object to remove from the list of results
     *
     * @return $this|ChildStockMoveQuery The current query, for fluid interface
     */
    public function prune($stockMove = null)
    {
        if ($stockMove) {
            $this->addUsingAlias(StockMoveTableMap::COL_ID, $stockMove->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the stock_move table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StockMoveTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StockMoveTableMap::clearInstancePool();
            StockMoveTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(StockMoveTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StockMoveTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StockMoveTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StockMoveTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StockMoveQuery
