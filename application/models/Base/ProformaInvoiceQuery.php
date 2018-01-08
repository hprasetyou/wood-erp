<?php

namespace Base;

use \ProformaInvoice as ChildProformaInvoice;
use \ProformaInvoiceQuery as ChildProformaInvoiceQuery;
use \Exception;
use \PDO;
use Map\ProformaInvoiceTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'proforma_invoice' table.
 *
 *
 *
 * @method     ChildProformaInvoiceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProformaInvoiceQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProformaInvoiceQuery orderByCurrencyId($order = Criteria::ASC) Order by the currency_id column
 * @method     ChildProformaInvoiceQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 * @method     ChildProformaInvoiceQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildProformaInvoiceQuery orderByConfirmDate($order = Criteria::ASC) Order by the confirm_date column
 * @method     ChildProformaInvoiceQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProformaInvoiceQuery orderByTotalCubicDimension($order = Criteria::ASC) Order by the total_cubic_dimension column
 * @method     ChildProformaInvoiceQuery orderByTotalPrice($order = Criteria::ASC) Order by the total_price column
 * @method     ChildProformaInvoiceQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildProformaInvoiceQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildProformaInvoiceQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProformaInvoiceQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProformaInvoiceQuery groupById() Group by the id column
 * @method     ChildProformaInvoiceQuery groupByName() Group by the name column
 * @method     ChildProformaInvoiceQuery groupByCurrencyId() Group by the currency_id column
 * @method     ChildProformaInvoiceQuery groupByCustomerId() Group by the customer_id column
 * @method     ChildProformaInvoiceQuery groupByDate() Group by the date column
 * @method     ChildProformaInvoiceQuery groupByConfirmDate() Group by the confirm_date column
 * @method     ChildProformaInvoiceQuery groupByDescription() Group by the description column
 * @method     ChildProformaInvoiceQuery groupByTotalCubicDimension() Group by the total_cubic_dimension column
 * @method     ChildProformaInvoiceQuery groupByTotalPrice() Group by the total_price column
 * @method     ChildProformaInvoiceQuery groupByState() Group by the state column
 * @method     ChildProformaInvoiceQuery groupByActive() Group by the active column
 * @method     ChildProformaInvoiceQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProformaInvoiceQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProformaInvoiceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProformaInvoiceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProformaInvoiceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProformaInvoiceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProformaInvoiceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProformaInvoiceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProformaInvoiceQuery leftJoinPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partner relation
 * @method     ChildProformaInvoiceQuery rightJoinPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partner relation
 * @method     ChildProformaInvoiceQuery innerJoinPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the Partner relation
 *
 * @method     ChildProformaInvoiceQuery joinWithPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Partner relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinWithPartner() Adds a LEFT JOIN clause and with to the query using the Partner relation
 * @method     ChildProformaInvoiceQuery rightJoinWithPartner() Adds a RIGHT JOIN clause and with to the query using the Partner relation
 * @method     ChildProformaInvoiceQuery innerJoinWithPartner() Adds a INNER JOIN clause and with to the query using the Partner relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     ChildProformaInvoiceQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     ChildProformaInvoiceQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     ChildProformaInvoiceQuery joinWithCurrency($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currency relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinWithCurrency() Adds a LEFT JOIN clause and with to the query using the Currency relation
 * @method     ChildProformaInvoiceQuery rightJoinWithCurrency() Adds a RIGHT JOIN clause and with to the query using the Currency relation
 * @method     ChildProformaInvoiceQuery innerJoinWithCurrency() Adds a INNER JOIN clause and with to the query using the Currency relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinProformaInvoiceLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildProformaInvoiceQuery rightJoinProformaInvoiceLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildProformaInvoiceQuery innerJoinProformaInvoiceLine($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildProformaInvoiceQuery joinWithProformaInvoiceLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinWithProformaInvoiceLine() Adds a LEFT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildProformaInvoiceQuery rightJoinWithProformaInvoiceLine() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildProformaInvoiceQuery innerJoinWithProformaInvoiceLine() Adds a INNER JOIN clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinPurchaseOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildProformaInvoiceQuery rightJoinPurchaseOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildProformaInvoiceQuery innerJoinPurchaseOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrder relation
 *
 * @method     ChildProformaInvoiceQuery joinWithPurchaseOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildProformaInvoiceQuery leftJoinWithPurchaseOrder() Adds a LEFT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildProformaInvoiceQuery rightJoinWithPurchaseOrder() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildProformaInvoiceQuery innerJoinWithPurchaseOrder() Adds a INNER JOIN clause and with to the query using the PurchaseOrder relation
 *
 * @method     \PartnerQuery|\CurrencyQuery|\ProformaInvoiceLineQuery|\PurchaseOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProformaInvoice findOne(ConnectionInterface $con = null) Return the first ChildProformaInvoice matching the query
 * @method     ChildProformaInvoice findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProformaInvoice matching the query, or a new ChildProformaInvoice object populated from the query conditions when no match is found
 *
 * @method     ChildProformaInvoice findOneById(int $id) Return the first ChildProformaInvoice filtered by the id column
 * @method     ChildProformaInvoice findOneByName(string $name) Return the first ChildProformaInvoice filtered by the name column
 * @method     ChildProformaInvoice findOneByCurrencyId(int $currency_id) Return the first ChildProformaInvoice filtered by the currency_id column
 * @method     ChildProformaInvoice findOneByCustomerId(int $customer_id) Return the first ChildProformaInvoice filtered by the customer_id column
 * @method     ChildProformaInvoice findOneByDate(string $date) Return the first ChildProformaInvoice filtered by the date column
 * @method     ChildProformaInvoice findOneByConfirmDate(string $confirm_date) Return the first ChildProformaInvoice filtered by the confirm_date column
 * @method     ChildProformaInvoice findOneByDescription(string $description) Return the first ChildProformaInvoice filtered by the description column
 * @method     ChildProformaInvoice findOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildProformaInvoice filtered by the total_cubic_dimension column
 * @method     ChildProformaInvoice findOneByTotalPrice(double $total_price) Return the first ChildProformaInvoice filtered by the total_price column
 * @method     ChildProformaInvoice findOneByState(string $state) Return the first ChildProformaInvoice filtered by the state column
 * @method     ChildProformaInvoice findOneByActive(boolean $active) Return the first ChildProformaInvoice filtered by the active column
 * @method     ChildProformaInvoice findOneByCreatedAt(string $created_at) Return the first ChildProformaInvoice filtered by the created_at column
 * @method     ChildProformaInvoice findOneByUpdatedAt(string $updated_at) Return the first ChildProformaInvoice filtered by the updated_at column *

 * @method     ChildProformaInvoice requirePk($key, ConnectionInterface $con = null) Return the ChildProformaInvoice by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOne(ConnectionInterface $con = null) Return the first ChildProformaInvoice matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProformaInvoice requireOneById(int $id) Return the first ChildProformaInvoice filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByName(string $name) Return the first ChildProformaInvoice filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByCurrencyId(int $currency_id) Return the first ChildProformaInvoice filtered by the currency_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByCustomerId(int $customer_id) Return the first ChildProformaInvoice filtered by the customer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByDate(string $date) Return the first ChildProformaInvoice filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByConfirmDate(string $confirm_date) Return the first ChildProformaInvoice filtered by the confirm_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByDescription(string $description) Return the first ChildProformaInvoice filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildProformaInvoice filtered by the total_cubic_dimension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByTotalPrice(double $total_price) Return the first ChildProformaInvoice filtered by the total_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByState(string $state) Return the first ChildProformaInvoice filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByActive(boolean $active) Return the first ChildProformaInvoice filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByCreatedAt(string $created_at) Return the first ChildProformaInvoice filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoice requireOneByUpdatedAt(string $updated_at) Return the first ChildProformaInvoice filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProformaInvoice[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProformaInvoice objects based on current ModelCriteria
 * @method     ChildProformaInvoice[]|ObjectCollection findById(int $id) Return ChildProformaInvoice objects filtered by the id column
 * @method     ChildProformaInvoice[]|ObjectCollection findByName(string $name) Return ChildProformaInvoice objects filtered by the name column
 * @method     ChildProformaInvoice[]|ObjectCollection findByCurrencyId(int $currency_id) Return ChildProformaInvoice objects filtered by the currency_id column
 * @method     ChildProformaInvoice[]|ObjectCollection findByCustomerId(int $customer_id) Return ChildProformaInvoice objects filtered by the customer_id column
 * @method     ChildProformaInvoice[]|ObjectCollection findByDate(string $date) Return ChildProformaInvoice objects filtered by the date column
 * @method     ChildProformaInvoice[]|ObjectCollection findByConfirmDate(string $confirm_date) Return ChildProformaInvoice objects filtered by the confirm_date column
 * @method     ChildProformaInvoice[]|ObjectCollection findByDescription(string $description) Return ChildProformaInvoice objects filtered by the description column
 * @method     ChildProformaInvoice[]|ObjectCollection findByTotalCubicDimension(double $total_cubic_dimension) Return ChildProformaInvoice objects filtered by the total_cubic_dimension column
 * @method     ChildProformaInvoice[]|ObjectCollection findByTotalPrice(double $total_price) Return ChildProformaInvoice objects filtered by the total_price column
 * @method     ChildProformaInvoice[]|ObjectCollection findByState(string $state) Return ChildProformaInvoice objects filtered by the state column
 * @method     ChildProformaInvoice[]|ObjectCollection findByActive(boolean $active) Return ChildProformaInvoice objects filtered by the active column
 * @method     ChildProformaInvoice[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProformaInvoice objects filtered by the created_at column
 * @method     ChildProformaInvoice[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProformaInvoice objects filtered by the updated_at column
 * @method     ChildProformaInvoice[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProformaInvoiceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProformaInvoiceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProformaInvoice', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProformaInvoiceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProformaInvoiceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProformaInvoiceQuery) {
            return $criteria;
        }
        $query = new ChildProformaInvoiceQuery();
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
     * @return ChildProformaInvoice|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProformaInvoiceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProformaInvoice A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, currency_id, customer_id, date, confirm_date, description, total_cubic_dimension, total_price, state, active, created_at, updated_at FROM proforma_invoice WHERE id = :p0';
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
            /** @var ChildProformaInvoice $obj */
            $obj = new ChildProformaInvoice();
            $obj->hydrate($row);
            ProformaInvoiceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProformaInvoice|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the currency_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrencyId(1234); // WHERE currency_id = 1234
     * $query->filterByCurrencyId(array(12, 34)); // WHERE currency_id IN (12, 34)
     * $query->filterByCurrencyId(array('min' => 12)); // WHERE currency_id > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $currencyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByCurrencyId($currencyId = null, $comparison = null)
    {
        if (is_array($currencyId)) {
            $useMinMax = false;
            if (isset($currencyId['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CURRENCY_ID, $currencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyId['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CURRENCY_ID, $currencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_CURRENCY_ID, $currencyId, $comparison);
    }

    /**
     * Filter the query on the customer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerId(1234); // WHERE customer_id = 1234
     * $query->filterByCustomerId(array(12, 34)); // WHERE customer_id IN (12, 34)
     * $query->filterByCustomerId(array('min' => 12)); // WHERE customer_id > 12
     * </code>
     *
     * @see       filterByPartner()
     *
     * @param     mixed $customerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByCustomerId($customerId = null, $comparison = null)
    {
        if (is_array($customerId)) {
            $useMinMax = false;
            if (isset($customerId['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CUSTOMER_ID, $customerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customerId['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CUSTOMER_ID, $customerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_CUSTOMER_ID, $customerId, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the confirm_date column
     *
     * Example usage:
     * <code>
     * $query->filterByConfirmDate('2011-03-14'); // WHERE confirm_date = '2011-03-14'
     * $query->filterByConfirmDate('now'); // WHERE confirm_date = '2011-03-14'
     * $query->filterByConfirmDate(array('max' => 'yesterday')); // WHERE confirm_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $confirmDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByConfirmDate($confirmDate = null, $comparison = null)
    {
        if (is_array($confirmDate)) {
            $useMinMax = false;
            if (isset($confirmDate['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CONFIRM_DATE, $confirmDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($confirmDate['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CONFIRM_DATE, $confirmDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_CONFIRM_DATE, $confirmDate, $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the total_cubic_dimension column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalCubicDimension(1234); // WHERE total_cubic_dimension = 1234
     * $query->filterByTotalCubicDimension(array(12, 34)); // WHERE total_cubic_dimension IN (12, 34)
     * $query->filterByTotalCubicDimension(array('min' => 12)); // WHERE total_cubic_dimension > 12
     * </code>
     *
     * @param     mixed $totalCubicDimension The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByTotalCubicDimension($totalCubicDimension = null, $comparison = null)
    {
        if (is_array($totalCubicDimension)) {
            $useMinMax = false;
            if (isset($totalCubicDimension['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalCubicDimension['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension, $comparison);
    }

    /**
     * Filter the query on the total_price column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalPrice(1234); // WHERE total_price = 1234
     * $query->filterByTotalPrice(array(12, 34)); // WHERE total_price IN (12, 34)
     * $query->filterByTotalPrice(array('min' => 12)); // WHERE total_price > 12
     * </code>
     *
     * @param     mixed $totalPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByTotalPrice($totalPrice = null, $comparison = null)
    {
        if (is_array($totalPrice)) {
            $useMinMax = false;
            if (isset($totalPrice['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_TOTAL_PRICE, $totalPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPrice['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_TOTAL_PRICE, $totalPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_TOTAL_PRICE, $totalPrice, $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_STATE, $state, $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProformaInvoiceTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByPartner($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(ProformaInvoiceTableMap::COL_CUSTOMER_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProformaInvoiceTableMap::COL_CUSTOMER_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPartner() only accepts arguments of type \Partner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Partner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function joinPartner($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Partner');

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
            $this->addJoinObject($join, 'Partner');
        }

        return $this;
    }

    /**
     * Use the Partner relation Partner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerQuery A secondary query class using the current class as primary query
     */
    public function usePartnerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Partner', '\PartnerQuery');
    }

    /**
     * Filter the query by a related \Currency object
     *
     * @param \Currency|ObjectCollection $currency The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof \Currency) {
            return $this
                ->addUsingAlias(ProformaInvoiceTableMap::COL_CURRENCY_ID, $currency->getId(), $comparison);
        } elseif ($currency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProformaInvoiceTableMap::COL_CURRENCY_ID, $currency->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type \Currency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function joinCurrency($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

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
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation Currency object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', '\CurrencyQuery');
    }

    /**
     * Filter the query by a related \ProformaInvoiceLine object
     *
     * @param \ProformaInvoiceLine|ObjectCollection $proformaInvoiceLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceLine($proformaInvoiceLine, $comparison = null)
    {
        if ($proformaInvoiceLine instanceof \ProformaInvoiceLine) {
            return $this
                ->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $proformaInvoiceLine->getProformaInvoiceId(), $comparison);
        } elseif ($proformaInvoiceLine instanceof ObjectCollection) {
            return $this
                ->useProformaInvoiceLineQuery()
                ->filterByPrimaryKeys($proformaInvoiceLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProformaInvoiceLine() only accepts arguments of type \ProformaInvoiceLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProformaInvoiceLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function joinProformaInvoiceLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProformaInvoiceLine');

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
            $this->addJoinObject($join, 'ProformaInvoiceLine');
        }

        return $this;
    }

    /**
     * Use the ProformaInvoiceLine relation ProformaInvoiceLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProformaInvoiceLineQuery A secondary query class using the current class as primary query
     */
    public function useProformaInvoiceLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProformaInvoiceLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProformaInvoiceLine', '\ProformaInvoiceLineQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrder object
     *
     * @param \PurchaseOrder|ObjectCollection $purchaseOrder the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrder($purchaseOrder, $comparison = null)
    {
        if ($purchaseOrder instanceof \PurchaseOrder) {
            return $this
                ->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $purchaseOrder->getProformaInvoiceId(), $comparison);
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
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function joinPurchaseOrder($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePurchaseOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPurchaseOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrder', '\PurchaseOrderQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProformaInvoice $proformaInvoice Object to remove from the list of results
     *
     * @return $this|ChildProformaInvoiceQuery The current query, for fluid interface
     */
    public function prune($proformaInvoice = null)
    {
        if ($proformaInvoice) {
            $this->addUsingAlias(ProformaInvoiceTableMap::COL_ID, $proformaInvoice->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the proforma_invoice table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProformaInvoiceTableMap::clearInstancePool();
            ProformaInvoiceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProformaInvoiceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProformaInvoiceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProformaInvoiceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProformaInvoiceQuery
