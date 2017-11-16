<?php

namespace Base;

use \ProformaInvoiceLine as ChildProformaInvoiceLine;
use \ProformaInvoiceLineQuery as ChildProformaInvoiceLineQuery;
use \Exception;
use \PDO;
use Map\ProformaInvoiceLineTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'proforma_invoice_line' table.
 *
 *
 *
 * @method     ChildProformaInvoiceLineQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProformaInvoiceLineQuery orderByProformaInvoiceId($order = Criteria::ASC) Order by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLineQuery orderByProductCustomerId($order = Criteria::ASC) Order by the product_customer_id column
 * @method     ChildProformaInvoiceLineQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProformaInvoiceLineQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildProformaInvoiceLineQuery orderByQtyOnContainer($order = Criteria::ASC) Order by the qty_on_container column
 * @method     ChildProformaInvoiceLineQuery orderByCubicDimension($order = Criteria::ASC) Order by the cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery orderByTotalCubicDimension($order = Criteria::ASC) Order by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildProformaInvoiceLineQuery orderByTotalPrice($order = Criteria::ASC) Order by the total_price column
 * @method     ChildProformaInvoiceLineQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProformaInvoiceLineQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProformaInvoiceLineQuery groupById() Group by the id column
 * @method     ChildProformaInvoiceLineQuery groupByProformaInvoiceId() Group by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLineQuery groupByProductCustomerId() Group by the product_customer_id column
 * @method     ChildProformaInvoiceLineQuery groupByDescription() Group by the description column
 * @method     ChildProformaInvoiceLineQuery groupByQty() Group by the qty column
 * @method     ChildProformaInvoiceLineQuery groupByQtyOnContainer() Group by the qty_on_container column
 * @method     ChildProformaInvoiceLineQuery groupByCubicDimension() Group by the cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery groupByTotalCubicDimension() Group by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery groupByPrice() Group by the price column
 * @method     ChildProformaInvoiceLineQuery groupByTotalPrice() Group by the total_price column
 * @method     ChildProformaInvoiceLineQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProformaInvoiceLineQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProformaInvoiceLineQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProformaInvoiceLineQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProformaInvoiceLineQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProformaInvoiceLineQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProformaInvoiceLineQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinProformaInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildProformaInvoiceLineQuery rightJoinProformaInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildProformaInvoiceLineQuery innerJoinProformaInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoice relation
 *
 * @method     ChildProformaInvoiceLineQuery joinWithProformaInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinWithProformaInvoice() Adds a LEFT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildProformaInvoiceLineQuery rightJoinWithProformaInvoice() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildProformaInvoiceLineQuery innerJoinWithProformaInvoice() Adds a INNER JOIN clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinProductCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductCustomer relation
 * @method     ChildProformaInvoiceLineQuery rightJoinProductCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductCustomer relation
 * @method     ChildProformaInvoiceLineQuery innerJoinProductCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductCustomer relation
 *
 * @method     ChildProformaInvoiceLineQuery joinWithProductCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductCustomer relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinWithProductCustomer() Adds a LEFT JOIN clause and with to the query using the ProductCustomer relation
 * @method     ChildProformaInvoiceLineQuery rightJoinWithProductCustomer() Adds a RIGHT JOIN clause and with to the query using the ProductCustomer relation
 * @method     ChildProformaInvoiceLineQuery innerJoinWithProductCustomer() Adds a INNER JOIN clause and with to the query using the ProductCustomer relation
 *
 * @method     \ProformaInvoiceQuery|\ProductCustomerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProformaInvoiceLine findOne(ConnectionInterface $con = null) Return the first ChildProformaInvoiceLine matching the query
 * @method     ChildProformaInvoiceLine findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProformaInvoiceLine matching the query, or a new ChildProformaInvoiceLine object populated from the query conditions when no match is found
 *
 * @method     ChildProformaInvoiceLine findOneById(int $id) Return the first ChildProformaInvoiceLine filtered by the id column
 * @method     ChildProformaInvoiceLine findOneByProformaInvoiceId(int $proforma_invoice_id) Return the first ChildProformaInvoiceLine filtered by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLine findOneByProductCustomerId(int $product_customer_id) Return the first ChildProformaInvoiceLine filtered by the product_customer_id column
 * @method     ChildProformaInvoiceLine findOneByDescription(string $description) Return the first ChildProformaInvoiceLine filtered by the description column
 * @method     ChildProformaInvoiceLine findOneByQty(int $qty) Return the first ChildProformaInvoiceLine filtered by the qty column
 * @method     ChildProformaInvoiceLine findOneByQtyOnContainer(int $qty_on_container) Return the first ChildProformaInvoiceLine filtered by the qty_on_container column
 * @method     ChildProformaInvoiceLine findOneByCubicDimension(double $cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the cubic_dimension column
 * @method     ChildProformaInvoiceLine findOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLine findOneByPrice(double $price) Return the first ChildProformaInvoiceLine filtered by the price column
 * @method     ChildProformaInvoiceLine findOneByTotalPrice(double $total_price) Return the first ChildProformaInvoiceLine filtered by the total_price column
 * @method     ChildProformaInvoiceLine findOneByCreatedAt(string $created_at) Return the first ChildProformaInvoiceLine filtered by the created_at column
 * @method     ChildProformaInvoiceLine findOneByUpdatedAt(string $updated_at) Return the first ChildProformaInvoiceLine filtered by the updated_at column *

 * @method     ChildProformaInvoiceLine requirePk($key, ConnectionInterface $con = null) Return the ChildProformaInvoiceLine by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOne(ConnectionInterface $con = null) Return the first ChildProformaInvoiceLine matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProformaInvoiceLine requireOneById(int $id) Return the first ChildProformaInvoiceLine filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByProformaInvoiceId(int $proforma_invoice_id) Return the first ChildProformaInvoiceLine filtered by the proforma_invoice_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByProductCustomerId(int $product_customer_id) Return the first ChildProformaInvoiceLine filtered by the product_customer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByDescription(string $description) Return the first ChildProformaInvoiceLine filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByQty(int $qty) Return the first ChildProformaInvoiceLine filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByQtyOnContainer(int $qty_on_container) Return the first ChildProformaInvoiceLine filtered by the qty_on_container column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByCubicDimension(double $cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the cubic_dimension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the total_cubic_dimension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByPrice(double $price) Return the first ChildProformaInvoiceLine filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByTotalPrice(double $total_price) Return the first ChildProformaInvoiceLine filtered by the total_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByCreatedAt(string $created_at) Return the first ChildProformaInvoiceLine filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByUpdatedAt(string $updated_at) Return the first ChildProformaInvoiceLine filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProformaInvoiceLine[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProformaInvoiceLine objects based on current ModelCriteria
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findById(int $id) Return ChildProformaInvoiceLine objects filtered by the id column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByProformaInvoiceId(int $proforma_invoice_id) Return ChildProformaInvoiceLine objects filtered by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByProductCustomerId(int $product_customer_id) Return ChildProformaInvoiceLine objects filtered by the product_customer_id column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByDescription(string $description) Return ChildProformaInvoiceLine objects filtered by the description column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByQty(int $qty) Return ChildProformaInvoiceLine objects filtered by the qty column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByQtyOnContainer(int $qty_on_container) Return ChildProformaInvoiceLine objects filtered by the qty_on_container column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByCubicDimension(double $cubic_dimension) Return ChildProformaInvoiceLine objects filtered by the cubic_dimension column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByTotalCubicDimension(double $total_cubic_dimension) Return ChildProformaInvoiceLine objects filtered by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByPrice(double $price) Return ChildProformaInvoiceLine objects filtered by the price column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByTotalPrice(double $total_price) Return ChildProformaInvoiceLine objects filtered by the total_price column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProformaInvoiceLine objects filtered by the created_at column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProformaInvoiceLine objects filtered by the updated_at column
 * @method     ChildProformaInvoiceLine[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProformaInvoiceLineQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProformaInvoiceLineQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ProformaInvoiceLine', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProformaInvoiceLineQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProformaInvoiceLineQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProformaInvoiceLineQuery) {
            return $criteria;
        }
        $query = new ChildProformaInvoiceLineQuery();
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
     * @return ChildProformaInvoiceLine|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProformaInvoiceLineTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProformaInvoiceLineTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProformaInvoiceLine A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, proforma_invoice_id, product_customer_id, description, qty, qty_on_container, cubic_dimension, total_cubic_dimension, price, total_price, created_at, updated_at FROM proforma_invoice_line WHERE id = :p0';
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
            /** @var ChildProformaInvoiceLine $obj */
            $obj = new ChildProformaInvoiceLine();
            $obj->hydrate($row);
            ProformaInvoiceLineTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProformaInvoiceLine|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the proforma_invoice_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProformaInvoiceId(1234); // WHERE proforma_invoice_id = 1234
     * $query->filterByProformaInvoiceId(array(12, 34)); // WHERE proforma_invoice_id IN (12, 34)
     * $query->filterByProformaInvoiceId(array('min' => 12)); // WHERE proforma_invoice_id > 12
     * </code>
     *
     * @see       filterByProformaInvoice()
     *
     * @param     mixed $proformaInvoiceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceId($proformaInvoiceId = null, $comparison = null)
    {
        if (is_array($proformaInvoiceId)) {
            $useMinMax = false;
            if (isset($proformaInvoiceId['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoiceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proformaInvoiceId['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoiceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoiceId, $comparison);
    }

    /**
     * Filter the query on the product_customer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductCustomerId(1234); // WHERE product_customer_id = 1234
     * $query->filterByProductCustomerId(array(12, 34)); // WHERE product_customer_id IN (12, 34)
     * $query->filterByProductCustomerId(array('min' => 12)); // WHERE product_customer_id > 12
     * </code>
     *
     * @see       filterByProductCustomer()
     *
     * @param     mixed $productCustomerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProductCustomerId($productCustomerId = null, $comparison = null)
    {
        if (is_array($productCustomerId)) {
            $useMinMax = false;
            if (isset($productCustomerId['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID, $productCustomerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productCustomerId['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID, $productCustomerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID, $productCustomerId, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY, $qty, $comparison);
    }

    /**
     * Filter the query on the qty_on_container column
     *
     * Example usage:
     * <code>
     * $query->filterByQtyOnContainer(1234); // WHERE qty_on_container = 1234
     * $query->filterByQtyOnContainer(array(12, 34)); // WHERE qty_on_container IN (12, 34)
     * $query->filterByQtyOnContainer(array('min' => 12)); // WHERE qty_on_container > 12
     * </code>
     *
     * @param     mixed $qtyOnContainer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByQtyOnContainer($qtyOnContainer = null, $comparison = null)
    {
        if (is_array($qtyOnContainer)) {
            $useMinMax = false;
            if (isset($qtyOnContainer['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY_ON_CONTAINER, $qtyOnContainer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qtyOnContainer['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY_ON_CONTAINER, $qtyOnContainer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY_ON_CONTAINER, $qtyOnContainer, $comparison);
    }

    /**
     * Filter the query on the cubic_dimension column
     *
     * Example usage:
     * <code>
     * $query->filterByCubicDimension(1234); // WHERE cubic_dimension = 1234
     * $query->filterByCubicDimension(array(12, 34)); // WHERE cubic_dimension IN (12, 34)
     * $query->filterByCubicDimension(array('min' => 12)); // WHERE cubic_dimension > 12
     * </code>
     *
     * @param     mixed $cubicDimension The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByCubicDimension($cubicDimension = null, $comparison = null)
    {
        if (is_array($cubicDimension)) {
            $useMinMax = false;
            if (isset($cubicDimension['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_CUBIC_DIMENSION, $cubicDimension['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cubicDimension['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_CUBIC_DIMENSION, $cubicDimension['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_CUBIC_DIMENSION, $cubicDimension, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByTotalCubicDimension($totalCubicDimension = null, $comparison = null)
    {
        if (is_array($totalCubicDimension)) {
            $useMinMax = false;
            if (isset($totalCubicDimension['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalCubicDimension['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRICE, $price, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByTotalPrice($totalPrice = null, $comparison = null)
    {
        if (is_array($totalPrice)) {
            $useMinMax = false;
            if (isset($totalPrice['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_TOTAL_PRICE, $totalPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPrice['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_TOTAL_PRICE, $totalPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_TOTAL_PRICE, $totalPrice, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProformaInvoice object
     *
     * @param \ProformaInvoice|ObjectCollection $proformaInvoice The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProformaInvoice($proformaInvoice, $comparison = null)
    {
        if ($proformaInvoice instanceof \ProformaInvoice) {
            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoice->getId(), $comparison);
        } elseif ($proformaInvoice instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoice->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
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
     * Filter the query by a related \ProductCustomer object
     *
     * @param \ProductCustomer|ObjectCollection $productCustomer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProductCustomer($productCustomer, $comparison = null)
    {
        if ($productCustomer instanceof \ProductCustomer) {
            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID, $productCustomer->getId(), $comparison);
        } elseif ($productCustomer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_CUSTOMER_ID, $productCustomer->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildProformaInvoiceLine $proformaInvoiceLine Object to remove from the list of results
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function prune($proformaInvoiceLine = null)
    {
        if ($proformaInvoiceLine) {
            $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $proformaInvoiceLine->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the proforma_invoice_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceLineTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProformaInvoiceLineTableMap::clearInstancePool();
            ProformaInvoiceLineTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProformaInvoiceLineTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProformaInvoiceLineTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProformaInvoiceLineTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProformaInvoiceLineTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProformaInvoiceLineQuery
