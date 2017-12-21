<?php

namespace Base;

use \PurchaseOrder as ChildPurchaseOrder;
use \PurchaseOrderQuery as ChildPurchaseOrderQuery;
use \Exception;
use \PDO;
use Map\PurchaseOrderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'purchase_order' table.
 *
 *
 *
 * @method     ChildPurchaseOrderQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPurchaseOrderQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPurchaseOrderQuery orderByProformaInvoiceId($order = Criteria::ASC) Order by the proforma_invoice_id column
 * @method     ChildPurchaseOrderQuery orderBySupplierId($order = Criteria::ASC) Order by the supplier_id column
 * @method     ChildPurchaseOrderQuery orderByCurrencyId($order = Criteria::ASC) Order by the currency_id column
 * @method     ChildPurchaseOrderQuery orderByNote($order = Criteria::ASC) Order by the note column
 * @method     ChildPurchaseOrderQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildPurchaseOrderQuery orderByPaymentTerm($order = Criteria::ASC) Order by the payment_term column
 * @method     ChildPurchaseOrderQuery orderByDownPayment($order = Criteria::ASC) Order by the down_payment column
 * @method     ChildPurchaseOrderQuery orderByDownPaymentDeadline($order = Criteria::ASC) Order by the down_payment_deadline column
 * @method     ChildPurchaseOrderQuery orderByTotalPrice($order = Criteria::ASC) Order by the total_price column
 * @method     ChildPurchaseOrderQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildPurchaseOrderQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPurchaseOrderQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPurchaseOrderQuery groupById() Group by the id column
 * @method     ChildPurchaseOrderQuery groupByName() Group by the name column
 * @method     ChildPurchaseOrderQuery groupByProformaInvoiceId() Group by the proforma_invoice_id column
 * @method     ChildPurchaseOrderQuery groupBySupplierId() Group by the supplier_id column
 * @method     ChildPurchaseOrderQuery groupByCurrencyId() Group by the currency_id column
 * @method     ChildPurchaseOrderQuery groupByNote() Group by the note column
 * @method     ChildPurchaseOrderQuery groupByDate() Group by the date column
 * @method     ChildPurchaseOrderQuery groupByPaymentTerm() Group by the payment_term column
 * @method     ChildPurchaseOrderQuery groupByDownPayment() Group by the down_payment column
 * @method     ChildPurchaseOrderQuery groupByDownPaymentDeadline() Group by the down_payment_deadline column
 * @method     ChildPurchaseOrderQuery groupByTotalPrice() Group by the total_price column
 * @method     ChildPurchaseOrderQuery groupByState() Group by the state column
 * @method     ChildPurchaseOrderQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPurchaseOrderQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPurchaseOrderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPurchaseOrderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPurchaseOrderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPurchaseOrderQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPurchaseOrderQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPurchaseOrderQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPurchaseOrderQuery leftJoinProformaInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildPurchaseOrderQuery rightJoinProformaInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildPurchaseOrderQuery innerJoinProformaInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoice relation
 *
 * @method     ChildPurchaseOrderQuery joinWithProformaInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinWithProformaInvoice() Adds a LEFT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildPurchaseOrderQuery rightJoinWithProformaInvoice() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildPurchaseOrderQuery innerJoinWithProformaInvoice() Adds a INNER JOIN clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     ChildPurchaseOrderQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     ChildPurchaseOrderQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     ChildPurchaseOrderQuery joinWithCurrency($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Currency relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinWithCurrency() Adds a LEFT JOIN clause and with to the query using the Currency relation
 * @method     ChildPurchaseOrderQuery rightJoinWithCurrency() Adds a RIGHT JOIN clause and with to the query using the Currency relation
 * @method     ChildPurchaseOrderQuery innerJoinWithCurrency() Adds a INNER JOIN clause and with to the query using the Currency relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supplier relation
 * @method     ChildPurchaseOrderQuery rightJoinSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supplier relation
 * @method     ChildPurchaseOrderQuery innerJoinSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the Supplier relation
 *
 * @method     ChildPurchaseOrderQuery joinWithSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Supplier relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinWithSupplier() Adds a LEFT JOIN clause and with to the query using the Supplier relation
 * @method     ChildPurchaseOrderQuery rightJoinWithSupplier() Adds a RIGHT JOIN clause and with to the query using the Supplier relation
 * @method     ChildPurchaseOrderQuery innerJoinWithSupplier() Adds a INNER JOIN clause and with to the query using the Supplier relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinPurchaseOrderLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildPurchaseOrderQuery rightJoinPurchaseOrderLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildPurchaseOrderQuery innerJoinPurchaseOrderLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrderLine relation
 *
 * @method     ChildPurchaseOrderQuery joinWithPurchaseOrderLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     ChildPurchaseOrderQuery leftJoinWithPurchaseOrderLine() Adds a LEFT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildPurchaseOrderQuery rightJoinWithPurchaseOrderLine() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildPurchaseOrderQuery innerJoinWithPurchaseOrderLine() Adds a INNER JOIN clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     \ProformaInvoiceQuery|\CurrencyQuery|\PartnerQuery|\PurchaseOrderLineQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPurchaseOrder findOne(ConnectionInterface $con = null) Return the first ChildPurchaseOrder matching the query
 * @method     ChildPurchaseOrder findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPurchaseOrder matching the query, or a new ChildPurchaseOrder object populated from the query conditions when no match is found
 *
 * @method     ChildPurchaseOrder findOneById(int $id) Return the first ChildPurchaseOrder filtered by the id column
 * @method     ChildPurchaseOrder findOneByName(string $name) Return the first ChildPurchaseOrder filtered by the name column
 * @method     ChildPurchaseOrder findOneByProformaInvoiceId(int $proforma_invoice_id) Return the first ChildPurchaseOrder filtered by the proforma_invoice_id column
 * @method     ChildPurchaseOrder findOneBySupplierId(int $supplier_id) Return the first ChildPurchaseOrder filtered by the supplier_id column
 * @method     ChildPurchaseOrder findOneByCurrencyId(int $currency_id) Return the first ChildPurchaseOrder filtered by the currency_id column
 * @method     ChildPurchaseOrder findOneByNote(string $note) Return the first ChildPurchaseOrder filtered by the note column
 * @method     ChildPurchaseOrder findOneByDate(string $date) Return the first ChildPurchaseOrder filtered by the date column
 * @method     ChildPurchaseOrder findOneByPaymentTerm(string $payment_term) Return the first ChildPurchaseOrder filtered by the payment_term column
 * @method     ChildPurchaseOrder findOneByDownPayment(double $down_payment) Return the first ChildPurchaseOrder filtered by the down_payment column
 * @method     ChildPurchaseOrder findOneByDownPaymentDeadline(string $down_payment_deadline) Return the first ChildPurchaseOrder filtered by the down_payment_deadline column
 * @method     ChildPurchaseOrder findOneByTotalPrice(double $total_price) Return the first ChildPurchaseOrder filtered by the total_price column
 * @method     ChildPurchaseOrder findOneByState(string $state) Return the first ChildPurchaseOrder filtered by the state column
 * @method     ChildPurchaseOrder findOneByCreatedAt(string $created_at) Return the first ChildPurchaseOrder filtered by the created_at column
 * @method     ChildPurchaseOrder findOneByUpdatedAt(string $updated_at) Return the first ChildPurchaseOrder filtered by the updated_at column *

 * @method     ChildPurchaseOrder requirePk($key, ConnectionInterface $con = null) Return the ChildPurchaseOrder by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOne(ConnectionInterface $con = null) Return the first ChildPurchaseOrder matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPurchaseOrder requireOneById(int $id) Return the first ChildPurchaseOrder filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByName(string $name) Return the first ChildPurchaseOrder filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByProformaInvoiceId(int $proforma_invoice_id) Return the first ChildPurchaseOrder filtered by the proforma_invoice_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneBySupplierId(int $supplier_id) Return the first ChildPurchaseOrder filtered by the supplier_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByCurrencyId(int $currency_id) Return the first ChildPurchaseOrder filtered by the currency_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByNote(string $note) Return the first ChildPurchaseOrder filtered by the note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByDate(string $date) Return the first ChildPurchaseOrder filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByPaymentTerm(string $payment_term) Return the first ChildPurchaseOrder filtered by the payment_term column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByDownPayment(double $down_payment) Return the first ChildPurchaseOrder filtered by the down_payment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByDownPaymentDeadline(string $down_payment_deadline) Return the first ChildPurchaseOrder filtered by the down_payment_deadline column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByTotalPrice(double $total_price) Return the first ChildPurchaseOrder filtered by the total_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByState(string $state) Return the first ChildPurchaseOrder filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByCreatedAt(string $created_at) Return the first ChildPurchaseOrder filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrder requireOneByUpdatedAt(string $updated_at) Return the first ChildPurchaseOrder filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPurchaseOrder[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPurchaseOrder objects based on current ModelCriteria
 * @method     ChildPurchaseOrder[]|ObjectCollection findById(int $id) Return ChildPurchaseOrder objects filtered by the id column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByName(string $name) Return ChildPurchaseOrder objects filtered by the name column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByProformaInvoiceId(int $proforma_invoice_id) Return ChildPurchaseOrder objects filtered by the proforma_invoice_id column
 * @method     ChildPurchaseOrder[]|ObjectCollection findBySupplierId(int $supplier_id) Return ChildPurchaseOrder objects filtered by the supplier_id column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByCurrencyId(int $currency_id) Return ChildPurchaseOrder objects filtered by the currency_id column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByNote(string $note) Return ChildPurchaseOrder objects filtered by the note column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByDate(string $date) Return ChildPurchaseOrder objects filtered by the date column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByPaymentTerm(string $payment_term) Return ChildPurchaseOrder objects filtered by the payment_term column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByDownPayment(double $down_payment) Return ChildPurchaseOrder objects filtered by the down_payment column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByDownPaymentDeadline(string $down_payment_deadline) Return ChildPurchaseOrder objects filtered by the down_payment_deadline column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByTotalPrice(double $total_price) Return ChildPurchaseOrder objects filtered by the total_price column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByState(string $state) Return ChildPurchaseOrder objects filtered by the state column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPurchaseOrder objects filtered by the created_at column
 * @method     ChildPurchaseOrder[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPurchaseOrder objects filtered by the updated_at column
 * @method     ChildPurchaseOrder[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PurchaseOrderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PurchaseOrderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PurchaseOrder', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPurchaseOrderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPurchaseOrderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPurchaseOrderQuery) {
            return $criteria;
        }
        $query = new ChildPurchaseOrderQuery();
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
     * @return ChildPurchaseOrder|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PurchaseOrderTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPurchaseOrder A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, proforma_invoice_id, supplier_id, currency_id, note, date, payment_term, down_payment, down_payment_deadline, total_price, state, created_at, updated_at FROM purchase_order WHERE id = :p0';
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
            /** @var ChildPurchaseOrder $obj */
            $obj = new ChildPurchaseOrder();
            $obj->hydrate($row);
            PurchaseOrderTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPurchaseOrder|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceId($proformaInvoiceId = null, $comparison = null)
    {
        if (is_array($proformaInvoiceId)) {
            $useMinMax = false;
            if (isset($proformaInvoiceId['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoiceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proformaInvoiceId['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoiceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoiceId, $comparison);
    }

    /**
     * Filter the query on the supplier_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySupplierId(1234); // WHERE supplier_id = 1234
     * $query->filterBySupplierId(array(12, 34)); // WHERE supplier_id IN (12, 34)
     * $query->filterBySupplierId(array('min' => 12)); // WHERE supplier_id > 12
     * </code>
     *
     * @see       filterBySupplier()
     *
     * @param     mixed $supplierId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterBySupplierId($supplierId = null, $comparison = null)
    {
        if (is_array($supplierId)) {
            $useMinMax = false;
            if (isset($supplierId['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_SUPPLIER_ID, $supplierId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($supplierId['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_SUPPLIER_ID, $supplierId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_SUPPLIER_ID, $supplierId, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByCurrencyId($currencyId = null, $comparison = null)
    {
        if (is_array($currencyId)) {
            $useMinMax = false;
            if (isset($currencyId['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_CURRENCY_ID, $currencyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currencyId['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_CURRENCY_ID, $currencyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_CURRENCY_ID, $currencyId, $comparison);
    }

    /**
     * Filter the query on the note column
     *
     * Example usage:
     * <code>
     * $query->filterByNote('fooValue');   // WHERE note = 'fooValue'
     * $query->filterByNote('%fooValue%', Criteria::LIKE); // WHERE note LIKE '%fooValue%'
     * </code>
     *
     * @param     string $note The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByNote($note = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($note)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_NOTE, $note, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the payment_term column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentTerm('fooValue');   // WHERE payment_term = 'fooValue'
     * $query->filterByPaymentTerm('%fooValue%', Criteria::LIKE); // WHERE payment_term LIKE '%fooValue%'
     * </code>
     *
     * @param     string $paymentTerm The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByPaymentTerm($paymentTerm = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentTerm)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_PAYMENT_TERM, $paymentTerm, $comparison);
    }

    /**
     * Filter the query on the down_payment column
     *
     * Example usage:
     * <code>
     * $query->filterByDownPayment(1234); // WHERE down_payment = 1234
     * $query->filterByDownPayment(array(12, 34)); // WHERE down_payment IN (12, 34)
     * $query->filterByDownPayment(array('min' => 12)); // WHERE down_payment > 12
     * </code>
     *
     * @param     mixed $downPayment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByDownPayment($downPayment = null, $comparison = null)
    {
        if (is_array($downPayment)) {
            $useMinMax = false;
            if (isset($downPayment['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_DOWN_PAYMENT, $downPayment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downPayment['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_DOWN_PAYMENT, $downPayment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_DOWN_PAYMENT, $downPayment, $comparison);
    }

    /**
     * Filter the query on the down_payment_deadline column
     *
     * Example usage:
     * <code>
     * $query->filterByDownPaymentDeadline('2011-03-14'); // WHERE down_payment_deadline = '2011-03-14'
     * $query->filterByDownPaymentDeadline('now'); // WHERE down_payment_deadline = '2011-03-14'
     * $query->filterByDownPaymentDeadline(array('max' => 'yesterday')); // WHERE down_payment_deadline > '2011-03-13'
     * </code>
     *
     * @param     mixed $downPaymentDeadline The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByDownPaymentDeadline($downPaymentDeadline = null, $comparison = null)
    {
        if (is_array($downPaymentDeadline)) {
            $useMinMax = false;
            if (isset($downPaymentDeadline['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE, $downPaymentDeadline['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downPaymentDeadline['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE, $downPaymentDeadline['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_DOWN_PAYMENT_DEADLINE, $downPaymentDeadline, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByTotalPrice($totalPrice = null, $comparison = null)
    {
        if (is_array($totalPrice)) {
            $useMinMax = false;
            if (isset($totalPrice['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_TOTAL_PRICE, $totalPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPrice['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_TOTAL_PRICE, $totalPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_TOTAL_PRICE, $totalPrice, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_STATE, $state, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PurchaseOrderTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProformaInvoice object
     *
     * @param \ProformaInvoice|ObjectCollection $proformaInvoice The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByProformaInvoice($proformaInvoice, $comparison = null)
    {
        if ($proformaInvoice instanceof \ProformaInvoice) {
            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoice->getId(), $comparison);
        } elseif ($proformaInvoice instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_PROFORMA_INVOICE_ID, $proformaInvoice->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
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
     * Filter the query by a related \Currency object
     *
     * @param \Currency|ObjectCollection $currency The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof \Currency) {
            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_CURRENCY_ID, $currency->getId(), $comparison);
        } elseif ($currency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_CURRENCY_ID, $currency->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
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
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterBySupplier($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_SUPPLIER_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_SUPPLIER_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySupplier() only accepts arguments of type \Partner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Supplier relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function joinSupplier($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Supplier');

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
            $this->addJoinObject($join, 'Supplier');
        }

        return $this;
    }

    /**
     * Use the Supplier relation Partner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerQuery A secondary query class using the current class as primary query
     */
    public function useSupplierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Supplier', '\PartnerQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrderLine object
     *
     * @param \PurchaseOrderLine|ObjectCollection $purchaseOrderLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrderLine($purchaseOrderLine, $comparison = null)
    {
        if ($purchaseOrderLine instanceof \PurchaseOrderLine) {
            return $this
                ->addUsingAlias(PurchaseOrderTableMap::COL_ID, $purchaseOrderLine->getPurchaseOrderId(), $comparison);
        } elseif ($purchaseOrderLine instanceof ObjectCollection) {
            return $this
                ->usePurchaseOrderLineQuery()
                ->filterByPrimaryKeys($purchaseOrderLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseOrderLine() only accepts arguments of type \PurchaseOrderLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseOrderLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function joinPurchaseOrderLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseOrderLine');

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
            $this->addJoinObject($join, 'PurchaseOrderLine');
        }

        return $this;
    }

    /**
     * Use the PurchaseOrderLine relation PurchaseOrderLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PurchaseOrderLineQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseOrderLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchaseOrderLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrderLine', '\PurchaseOrderLineQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPurchaseOrder $purchaseOrder Object to remove from the list of results
     *
     * @return $this|ChildPurchaseOrderQuery The current query, for fluid interface
     */
    public function prune($purchaseOrder = null)
    {
        if ($purchaseOrder) {
            $this->addUsingAlias(PurchaseOrderTableMap::COL_ID, $purchaseOrder->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the purchase_order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PurchaseOrderTableMap::clearInstancePool();
            PurchaseOrderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PurchaseOrderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PurchaseOrderTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PurchaseOrderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PurchaseOrderQuery
