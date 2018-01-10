<?php

namespace Base;

use \Currency as ChildCurrency;
use \CurrencyQuery as ChildCurrencyQuery;
use \Exception;
use \PDO;
use Map\CurrencyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'currency' table.
 *
 *
 *
 * @method     ChildCurrencyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCurrencyQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCurrencyQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildCurrencyQuery orderBySymbol($order = Criteria::ASC) Order by the symbol column
 * @method     ChildCurrencyQuery orderByPlacement($order = Criteria::ASC) Order by the placement column
 * @method     ChildCurrencyQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildCurrencyQuery orderByRounding($order = Criteria::ASC) Order by the rounding column
 * @method     ChildCurrencyQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCurrencyQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildCurrencyQuery groupById() Group by the id column
 * @method     ChildCurrencyQuery groupByName() Group by the name column
 * @method     ChildCurrencyQuery groupByCode() Group by the code column
 * @method     ChildCurrencyQuery groupBySymbol() Group by the symbol column
 * @method     ChildCurrencyQuery groupByPlacement() Group by the placement column
 * @method     ChildCurrencyQuery groupByActive() Group by the active column
 * @method     ChildCurrencyQuery groupByRounding() Group by the rounding column
 * @method     ChildCurrencyQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCurrencyQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildCurrencyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCurrencyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCurrencyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCurrencyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCurrencyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCurrencyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCurrencyQuery leftJoinProformaInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildCurrencyQuery rightJoinProformaInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildCurrencyQuery innerJoinProformaInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoice relation
 *
 * @method     ChildCurrencyQuery joinWithProformaInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildCurrencyQuery leftJoinWithProformaInvoice() Adds a LEFT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildCurrencyQuery rightJoinWithProformaInvoice() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildCurrencyQuery innerJoinWithProformaInvoice() Adds a INNER JOIN clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildCurrencyQuery leftJoinPurchaseOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildCurrencyQuery rightJoinPurchaseOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildCurrencyQuery innerJoinPurchaseOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrder relation
 *
 * @method     ChildCurrencyQuery joinWithPurchaseOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildCurrencyQuery leftJoinWithPurchaseOrder() Adds a LEFT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildCurrencyQuery rightJoinWithPurchaseOrder() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildCurrencyQuery innerJoinWithPurchaseOrder() Adds a INNER JOIN clause and with to the query using the PurchaseOrder relation
 *
 * @method     \ProformaInvoiceQuery|\PurchaseOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCurrency findOne(ConnectionInterface $con = null) Return the first ChildCurrency matching the query
 * @method     ChildCurrency findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCurrency matching the query, or a new ChildCurrency object populated from the query conditions when no match is found
 *
 * @method     ChildCurrency findOneById(int $id) Return the first ChildCurrency filtered by the id column
 * @method     ChildCurrency findOneByName(string $name) Return the first ChildCurrency filtered by the name column
 * @method     ChildCurrency findOneByCode(string $code) Return the first ChildCurrency filtered by the code column
 * @method     ChildCurrency findOneBySymbol(string $symbol) Return the first ChildCurrency filtered by the symbol column
 * @method     ChildCurrency findOneByPlacement(string $placement) Return the first ChildCurrency filtered by the placement column
 * @method     ChildCurrency findOneByActive(boolean $active) Return the first ChildCurrency filtered by the active column
 * @method     ChildCurrency findOneByRounding(double $rounding) Return the first ChildCurrency filtered by the rounding column
 * @method     ChildCurrency findOneByCreatedAt(string $created_at) Return the first ChildCurrency filtered by the created_at column
 * @method     ChildCurrency findOneByUpdatedAt(string $updated_at) Return the first ChildCurrency filtered by the updated_at column *

 * @method     ChildCurrency requirePk($key, ConnectionInterface $con = null) Return the ChildCurrency by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOne(ConnectionInterface $con = null) Return the first ChildCurrency matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCurrency requireOneById(int $id) Return the first ChildCurrency filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByName(string $name) Return the first ChildCurrency filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByCode(string $code) Return the first ChildCurrency filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneBySymbol(string $symbol) Return the first ChildCurrency filtered by the symbol column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByPlacement(string $placement) Return the first ChildCurrency filtered by the placement column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByActive(boolean $active) Return the first ChildCurrency filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByRounding(double $rounding) Return the first ChildCurrency filtered by the rounding column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByCreatedAt(string $created_at) Return the first ChildCurrency filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrency requireOneByUpdatedAt(string $updated_at) Return the first ChildCurrency filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCurrency[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCurrency objects based on current ModelCriteria
 * @method     ChildCurrency[]|ObjectCollection findById(int $id) Return ChildCurrency objects filtered by the id column
 * @method     ChildCurrency[]|ObjectCollection findByName(string $name) Return ChildCurrency objects filtered by the name column
 * @method     ChildCurrency[]|ObjectCollection findByCode(string $code) Return ChildCurrency objects filtered by the code column
 * @method     ChildCurrency[]|ObjectCollection findBySymbol(string $symbol) Return ChildCurrency objects filtered by the symbol column
 * @method     ChildCurrency[]|ObjectCollection findByPlacement(string $placement) Return ChildCurrency objects filtered by the placement column
 * @method     ChildCurrency[]|ObjectCollection findByActive(boolean $active) Return ChildCurrency objects filtered by the active column
 * @method     ChildCurrency[]|ObjectCollection findByRounding(double $rounding) Return ChildCurrency objects filtered by the rounding column
 * @method     ChildCurrency[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildCurrency objects filtered by the created_at column
 * @method     ChildCurrency[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCurrency objects filtered by the updated_at column
 * @method     ChildCurrency[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CurrencyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CurrencyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Currency', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCurrencyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCurrencyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCurrencyQuery) {
            return $criteria;
        }
        $query = new ChildCurrencyQuery();
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
     * @return ChildCurrency|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CurrencyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CurrencyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCurrency A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, code, symbol, placement, active, rounding, created_at, updated_at FROM currency WHERE id = :p0';
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
            /** @var ChildCurrency $obj */
            $obj = new ChildCurrency();
            $obj->hydrate($row);
            CurrencyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCurrency|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CurrencyTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CurrencyTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the symbol column
     *
     * Example usage:
     * <code>
     * $query->filterBySymbol('fooValue');   // WHERE symbol = 'fooValue'
     * $query->filterBySymbol('%fooValue%', Criteria::LIKE); // WHERE symbol LIKE '%fooValue%'
     * </code>
     *
     * @param     string $symbol The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterBySymbol($symbol = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($symbol)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_SYMBOL, $symbol, $comparison);
    }

    /**
     * Filter the query on the placement column
     *
     * Example usage:
     * <code>
     * $query->filterByPlacement('fooValue');   // WHERE placement = 'fooValue'
     * $query->filterByPlacement('%fooValue%', Criteria::LIKE); // WHERE placement LIKE '%fooValue%'
     * </code>
     *
     * @param     string $placement The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByPlacement($placement = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($placement)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_PLACEMENT, $placement, $comparison);
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
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the rounding column
     *
     * Example usage:
     * <code>
     * $query->filterByRounding(1234); // WHERE rounding = 1234
     * $query->filterByRounding(array(12, 34)); // WHERE rounding IN (12, 34)
     * $query->filterByRounding(array('min' => 12)); // WHERE rounding > 12
     * </code>
     *
     * @param     mixed $rounding The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByRounding($rounding = null, $comparison = null)
    {
        if (is_array($rounding)) {
            $useMinMax = false;
            if (isset($rounding['min'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_ROUNDING, $rounding['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rounding['max'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_ROUNDING, $rounding['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_ROUNDING, $rounding, $comparison);
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
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CurrencyTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrencyTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProformaInvoice object
     *
     * @param \ProformaInvoice|ObjectCollection $proformaInvoice the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByProformaInvoice($proformaInvoice, $comparison = null)
    {
        if ($proformaInvoice instanceof \ProformaInvoice) {
            return $this
                ->addUsingAlias(CurrencyTableMap::COL_ID, $proformaInvoice->getCurrencyId(), $comparison);
        } elseif ($proformaInvoice instanceof ObjectCollection) {
            return $this
                ->useProformaInvoiceQuery()
                ->filterByPrimaryKeys($proformaInvoice->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProformaInvoice() only accepts arguments of type \ProformaInvoice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProformaInvoice relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function joinProformaInvoice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProformaInvoice');

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
            $this->addJoinObject($join, 'ProformaInvoice');
        }

        return $this;
    }

    /**
     * Use the ProformaInvoice relation ProformaInvoice object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProformaInvoiceQuery A secondary query class using the current class as primary query
     */
    public function useProformaInvoiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProformaInvoice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProformaInvoice', '\ProformaInvoiceQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrder object
     *
     * @param \PurchaseOrder|ObjectCollection $purchaseOrder the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCurrencyQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrder($purchaseOrder, $comparison = null)
    {
        if ($purchaseOrder instanceof \PurchaseOrder) {
            return $this
                ->addUsingAlias(CurrencyTableMap::COL_ID, $purchaseOrder->getCurrencyId(), $comparison);
        } elseif ($purchaseOrder instanceof ObjectCollection) {
            return $this
                ->usePurchaseOrderQuery()
                ->filterByPrimaryKeys($purchaseOrder->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseOrder() only accepts arguments of type \PurchaseOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseOrder relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function joinPurchaseOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseOrder');

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
            $this->addJoinObject($join, 'PurchaseOrder');
        }

        return $this;
    }

    /**
     * Use the PurchaseOrder relation PurchaseOrder object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PurchaseOrderQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchaseOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrder', '\PurchaseOrderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCurrency $currency Object to remove from the list of results
     *
     * @return $this|ChildCurrencyQuery The current query, for fluid interface
     */
    public function prune($currency = null)
    {
        if ($currency) {
            $this->addUsingAlias(CurrencyTableMap::COL_ID, $currency->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the currency table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrencyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CurrencyTableMap::clearInstancePool();
            CurrencyTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CurrencyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CurrencyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CurrencyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CurrencyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CurrencyQuery
