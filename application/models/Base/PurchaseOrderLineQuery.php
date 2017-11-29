<?php

namespace Base;

use \PurchaseOrderLine as ChildPurchaseOrderLine;
use \PurchaseOrderLineQuery as ChildPurchaseOrderLineQuery;
use \Exception;
use \PDO;
use Map\PurchaseOrderLineTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'purchase_order_line' table.
 *
 *
 *
 * @method     ChildPurchaseOrderLineQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPurchaseOrderLineQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPurchaseOrderLineQuery orderByPurchaseOrderId($order = Criteria::ASC) Order by the purchase_order_id column
 * @method     ChildPurchaseOrderLineQuery orderByProformaInvoiceLineId($order = Criteria::ASC) Order by the proforma_invoice_line_id column
 * @method     ChildPurchaseOrderLineQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildPurchaseOrderLineQuery orderByComponentId($order = Criteria::ASC) Order by the component_id column
 * @method     ChildPurchaseOrderLineQuery orderByNote($order = Criteria::ASC) Order by the note column
 * @method     ChildPurchaseOrderLineQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildPurchaseOrderLineQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildPurchaseOrderLineQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPurchaseOrderLineQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPurchaseOrderLineQuery groupById() Group by the id column
 * @method     ChildPurchaseOrderLineQuery groupByName() Group by the name column
 * @method     ChildPurchaseOrderLineQuery groupByPurchaseOrderId() Group by the purchase_order_id column
 * @method     ChildPurchaseOrderLineQuery groupByProformaInvoiceLineId() Group by the proforma_invoice_line_id column
 * @method     ChildPurchaseOrderLineQuery groupByProductId() Group by the product_id column
 * @method     ChildPurchaseOrderLineQuery groupByComponentId() Group by the component_id column
 * @method     ChildPurchaseOrderLineQuery groupByNote() Group by the note column
 * @method     ChildPurchaseOrderLineQuery groupByPrice() Group by the price column
 * @method     ChildPurchaseOrderLineQuery groupByQty() Group by the qty column
 * @method     ChildPurchaseOrderLineQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPurchaseOrderLineQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPurchaseOrderLineQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPurchaseOrderLineQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPurchaseOrderLineQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPurchaseOrderLineQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPurchaseOrderLineQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinPurchaseOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildPurchaseOrderLineQuery rightJoinPurchaseOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildPurchaseOrderLineQuery innerJoinPurchaseOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrder relation
 *
 * @method     ChildPurchaseOrderLineQuery joinWithPurchaseOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinWithPurchaseOrder() Adds a LEFT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildPurchaseOrderLineQuery rightJoinWithPurchaseOrder() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildPurchaseOrderLineQuery innerJoinWithPurchaseOrder() Adds a INNER JOIN clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinProformaInvoiceLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildPurchaseOrderLineQuery rightJoinProformaInvoiceLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildPurchaseOrderLineQuery innerJoinProformaInvoiceLine($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildPurchaseOrderLineQuery joinWithProformaInvoiceLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinWithProformaInvoiceLine() Adds a LEFT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildPurchaseOrderLineQuery rightJoinWithProformaInvoiceLine() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildPurchaseOrderLineQuery innerJoinWithProformaInvoiceLine() Adds a INNER JOIN clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildPurchaseOrderLineQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildPurchaseOrderLineQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildPurchaseOrderLineQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildPurchaseOrderLineQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildPurchaseOrderLineQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Component relation
 * @method     ChildPurchaseOrderLineQuery rightJoinComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Component relation
 * @method     ChildPurchaseOrderLineQuery innerJoinComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the Component relation
 *
 * @method     ChildPurchaseOrderLineQuery joinWithComponent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Component relation
 *
 * @method     ChildPurchaseOrderLineQuery leftJoinWithComponent() Adds a LEFT JOIN clause and with to the query using the Component relation
 * @method     ChildPurchaseOrderLineQuery rightJoinWithComponent() Adds a RIGHT JOIN clause and with to the query using the Component relation
 * @method     ChildPurchaseOrderLineQuery innerJoinWithComponent() Adds a INNER JOIN clause and with to the query using the Component relation
 *
 * @method     \PurchaseOrderQuery|\ProformaInvoiceLineQuery|\ProductQuery|\ComponentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPurchaseOrderLine findOne(ConnectionInterface $con = null) Return the first ChildPurchaseOrderLine matching the query
 * @method     ChildPurchaseOrderLine findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPurchaseOrderLine matching the query, or a new ChildPurchaseOrderLine object populated from the query conditions when no match is found
 *
 * @method     ChildPurchaseOrderLine findOneById(int $id) Return the first ChildPurchaseOrderLine filtered by the id column
 * @method     ChildPurchaseOrderLine findOneByName(string $name) Return the first ChildPurchaseOrderLine filtered by the name column
 * @method     ChildPurchaseOrderLine findOneByPurchaseOrderId(int $purchase_order_id) Return the first ChildPurchaseOrderLine filtered by the purchase_order_id column
 * @method     ChildPurchaseOrderLine findOneByProformaInvoiceLineId(int $proforma_invoice_line_id) Return the first ChildPurchaseOrderLine filtered by the proforma_invoice_line_id column
 * @method     ChildPurchaseOrderLine findOneByProductId(int $product_id) Return the first ChildPurchaseOrderLine filtered by the product_id column
 * @method     ChildPurchaseOrderLine findOneByComponentId(int $component_id) Return the first ChildPurchaseOrderLine filtered by the component_id column
 * @method     ChildPurchaseOrderLine findOneByNote(string $note) Return the first ChildPurchaseOrderLine filtered by the note column
 * @method     ChildPurchaseOrderLine findOneByPrice(double $price) Return the first ChildPurchaseOrderLine filtered by the price column
 * @method     ChildPurchaseOrderLine findOneByQty(double $qty) Return the first ChildPurchaseOrderLine filtered by the qty column
 * @method     ChildPurchaseOrderLine findOneByCreatedAt(string $created_at) Return the first ChildPurchaseOrderLine filtered by the created_at column
 * @method     ChildPurchaseOrderLine findOneByUpdatedAt(string $updated_at) Return the first ChildPurchaseOrderLine filtered by the updated_at column *

 * @method     ChildPurchaseOrderLine requirePk($key, ConnectionInterface $con = null) Return the ChildPurchaseOrderLine by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOne(ConnectionInterface $con = null) Return the first ChildPurchaseOrderLine matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPurchaseOrderLine requireOneById(int $id) Return the first ChildPurchaseOrderLine filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByName(string $name) Return the first ChildPurchaseOrderLine filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByPurchaseOrderId(int $purchase_order_id) Return the first ChildPurchaseOrderLine filtered by the purchase_order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByProformaInvoiceLineId(int $proforma_invoice_line_id) Return the first ChildPurchaseOrderLine filtered by the proforma_invoice_line_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByProductId(int $product_id) Return the first ChildPurchaseOrderLine filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByComponentId(int $component_id) Return the first ChildPurchaseOrderLine filtered by the component_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByNote(string $note) Return the first ChildPurchaseOrderLine filtered by the note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByPrice(double $price) Return the first ChildPurchaseOrderLine filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByQty(double $qty) Return the first ChildPurchaseOrderLine filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByCreatedAt(string $created_at) Return the first ChildPurchaseOrderLine filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPurchaseOrderLine requireOneByUpdatedAt(string $updated_at) Return the first ChildPurchaseOrderLine filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPurchaseOrderLine[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPurchaseOrderLine objects based on current ModelCriteria
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findById(int $id) Return ChildPurchaseOrderLine objects filtered by the id column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByName(string $name) Return ChildPurchaseOrderLine objects filtered by the name column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByPurchaseOrderId(int $purchase_order_id) Return ChildPurchaseOrderLine objects filtered by the purchase_order_id column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByProformaInvoiceLineId(int $proforma_invoice_line_id) Return ChildPurchaseOrderLine objects filtered by the proforma_invoice_line_id column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByProductId(int $product_id) Return ChildPurchaseOrderLine objects filtered by the product_id column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByComponentId(int $component_id) Return ChildPurchaseOrderLine objects filtered by the component_id column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByNote(string $note) Return ChildPurchaseOrderLine objects filtered by the note column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByPrice(double $price) Return ChildPurchaseOrderLine objects filtered by the price column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByQty(double $qty) Return ChildPurchaseOrderLine objects filtered by the qty column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPurchaseOrderLine objects filtered by the created_at column
 * @method     ChildPurchaseOrderLine[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPurchaseOrderLine objects filtered by the updated_at column
 * @method     ChildPurchaseOrderLine[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PurchaseOrderLineQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PurchaseOrderLineQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PurchaseOrderLine', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPurchaseOrderLineQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPurchaseOrderLineQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPurchaseOrderLineQuery) {
            return $criteria;
        }
        $query = new ChildPurchaseOrderLineQuery();
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
     * @return ChildPurchaseOrderLine|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PurchaseOrderLineTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PurchaseOrderLineTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPurchaseOrderLine A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, purchase_order_id, proforma_invoice_line_id, product_id, component_id, note, price, qty, created_at, updated_at FROM purchase_order_line WHERE id = :p0';
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
            /** @var ChildPurchaseOrderLine $obj */
            $obj = new ChildPurchaseOrderLine();
            $obj->hydrate($row);
            PurchaseOrderLineTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPurchaseOrderLine|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the purchase_order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPurchaseOrderId(1234); // WHERE purchase_order_id = 1234
     * $query->filterByPurchaseOrderId(array(12, 34)); // WHERE purchase_order_id IN (12, 34)
     * $query->filterByPurchaseOrderId(array('min' => 12)); // WHERE purchase_order_id > 12
     * </code>
     *
     * @see       filterByPurchaseOrder()
     *
     * @param     mixed $purchaseOrderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrderId($purchaseOrderId = null, $comparison = null)
    {
        if (is_array($purchaseOrderId)) {
            $useMinMax = false;
            if (isset($purchaseOrderId['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID, $purchaseOrderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($purchaseOrderId['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID, $purchaseOrderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID, $purchaseOrderId, $comparison);
    }

    /**
     * Filter the query on the proforma_invoice_line_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProformaInvoiceLineId(1234); // WHERE proforma_invoice_line_id = 1234
     * $query->filterByProformaInvoiceLineId(array(12, 34)); // WHERE proforma_invoice_line_id IN (12, 34)
     * $query->filterByProformaInvoiceLineId(array('min' => 12)); // WHERE proforma_invoice_line_id > 12
     * </code>
     *
     * @see       filterByProformaInvoiceLine()
     *
     * @param     mixed $proformaInvoiceLineId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceLineId($proformaInvoiceLineId = null, $comparison = null)
    {
        if (is_array($proformaInvoiceLineId)) {
            $useMinMax = false;
            if (isset($proformaInvoiceLineId['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLineId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proformaInvoiceLineId['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLineId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLineId, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PRODUCT_ID, $productId, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByComponentId($componentId = null, $comparison = null)
    {
        if (is_array($componentId)) {
            $useMinMax = false;
            if (isset($componentId['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_COMPONENT_ID, $componentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($componentId['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_COMPONENT_ID, $componentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_COMPONENT_ID, $componentId, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByNote($note = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($note)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_NOTE, $note, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_PRICE, $price, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_QTY, $qty, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PurchaseOrderLineTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PurchaseOrderLineTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \PurchaseOrder object
     *
     * @param \PurchaseOrder|ObjectCollection $purchaseOrder The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrder($purchaseOrder, $comparison = null)
    {
        if ($purchaseOrder instanceof \PurchaseOrder) {
            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID, $purchaseOrder->getId(), $comparison);
        } elseif ($purchaseOrder instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_PURCHASE_ORDER_ID, $purchaseOrder->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
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
     * Filter the query by a related \ProformaInvoiceLine object
     *
     * @param \ProformaInvoiceLine|ObjectCollection $proformaInvoiceLine The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceLine($proformaInvoiceLine, $comparison = null)
    {
        if ($proformaInvoiceLine instanceof \ProformaInvoiceLine) {
            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLine->getId(), $comparison);
        } elseif ($proformaInvoiceLine instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLine->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
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
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
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
     * Filter the query by a related \Component object
     *
     * @param \Component|ObjectCollection $component The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function filterByComponent($component, $comparison = null)
    {
        if ($component instanceof \Component) {
            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_COMPONENT_ID, $component->getId(), $comparison);
        } elseif ($component instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PurchaseOrderLineTableMap::COL_COMPONENT_ID, $component->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByComponent() only accepts arguments of type \Component or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Component relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function joinComponent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
     * Use the Component relation Component object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ComponentQuery A secondary query class using the current class as primary query
     */
    public function useComponentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Component', '\ComponentQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPurchaseOrderLine $purchaseOrderLine Object to remove from the list of results
     *
     * @return $this|ChildPurchaseOrderLineQuery The current query, for fluid interface
     */
    public function prune($purchaseOrderLine = null)
    {
        if ($purchaseOrderLine) {
            $this->addUsingAlias(PurchaseOrderLineTableMap::COL_ID, $purchaseOrderLine->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the purchase_order_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderLineTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PurchaseOrderLineTableMap::clearInstancePool();
            PurchaseOrderLineTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PurchaseOrderLineTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PurchaseOrderLineTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PurchaseOrderLineTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PurchaseOrderLineTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PurchaseOrderLineQuery
