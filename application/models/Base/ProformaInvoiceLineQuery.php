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
 * @method     ChildProformaInvoiceLineQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildProformaInvoiceLineQuery orderByProductFinishing($order = Criteria::ASC) Order by the product_finishing column
 * @method     ChildProformaInvoiceLineQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProformaInvoiceLineQuery orderByRemark($order = Criteria::ASC) Order by the remark column
 * @method     ChildProformaInvoiceLineQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildProformaInvoiceLineQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildProformaInvoiceLineQuery orderByQtyPerPack($order = Criteria::ASC) Order by the qty_per_pack column
 * @method     ChildProformaInvoiceLineQuery orderByCubicDimension($order = Criteria::ASC) Order by the cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery orderByTotalCubicDimension($order = Criteria::ASC) Order by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildProformaInvoiceLineQuery orderByTotalPrice($order = Criteria::ASC) Order by the total_price column
 * @method     ChildProformaInvoiceLineQuery orderByIsSample($order = Criteria::ASC) Order by the is_sample column
 * @method     ChildProformaInvoiceLineQuery orderByIsNeedBox($order = Criteria::ASC) Order by the is_need_box column
 * @method     ChildProformaInvoiceLineQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildProformaInvoiceLineQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProformaInvoiceLineQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProformaInvoiceLineQuery groupById() Group by the id column
 * @method     ChildProformaInvoiceLineQuery groupByProformaInvoiceId() Group by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLineQuery groupByProductId() Group by the product_id column
 * @method     ChildProformaInvoiceLineQuery groupByProductFinishing() Group by the product_finishing column
 * @method     ChildProformaInvoiceLineQuery groupByName() Group by the name column
 * @method     ChildProformaInvoiceLineQuery groupByRemark() Group by the remark column
 * @method     ChildProformaInvoiceLineQuery groupByDescription() Group by the description column
 * @method     ChildProformaInvoiceLineQuery groupByQty() Group by the qty column
 * @method     ChildProformaInvoiceLineQuery groupByQtyPerPack() Group by the qty_per_pack column
 * @method     ChildProformaInvoiceLineQuery groupByCubicDimension() Group by the cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery groupByTotalCubicDimension() Group by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLineQuery groupByPrice() Group by the price column
 * @method     ChildProformaInvoiceLineQuery groupByTotalPrice() Group by the total_price column
 * @method     ChildProformaInvoiceLineQuery groupByIsSample() Group by the is_sample column
 * @method     ChildProformaInvoiceLineQuery groupByIsNeedBox() Group by the is_need_box column
 * @method     ChildProformaInvoiceLineQuery groupByActive() Group by the active column
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
 * @method     ChildProformaInvoiceLineQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildProformaInvoiceLineQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildProformaInvoiceLineQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildProformaInvoiceLineQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildProformaInvoiceLineQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildProformaInvoiceLineQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinPackingListLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackingListLine relation
 * @method     ChildProformaInvoiceLineQuery rightJoinPackingListLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackingListLine relation
 * @method     ChildProformaInvoiceLineQuery innerJoinPackingListLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PackingListLine relation
 *
 * @method     ChildProformaInvoiceLineQuery joinWithPackingListLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackingListLine relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinWithPackingListLine() Adds a LEFT JOIN clause and with to the query using the PackingListLine relation
 * @method     ChildProformaInvoiceLineQuery rightJoinWithPackingListLine() Adds a RIGHT JOIN clause and with to the query using the PackingListLine relation
 * @method     ChildProformaInvoiceLineQuery innerJoinWithPackingListLine() Adds a INNER JOIN clause and with to the query using the PackingListLine relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinPurchaseOrderLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildProformaInvoiceLineQuery rightJoinPurchaseOrderLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildProformaInvoiceLineQuery innerJoinPurchaseOrderLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrderLine relation
 *
 * @method     ChildProformaInvoiceLineQuery joinWithPurchaseOrderLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     ChildProformaInvoiceLineQuery leftJoinWithPurchaseOrderLine() Adds a LEFT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildProformaInvoiceLineQuery rightJoinWithPurchaseOrderLine() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildProformaInvoiceLineQuery innerJoinWithPurchaseOrderLine() Adds a INNER JOIN clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     \ProformaInvoiceQuery|\ProductQuery|\PackingListLineQuery|\PurchaseOrderLineQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProformaInvoiceLine findOne(ConnectionInterface $con = null) Return the first ChildProformaInvoiceLine matching the query
 * @method     ChildProformaInvoiceLine findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProformaInvoiceLine matching the query, or a new ChildProformaInvoiceLine object populated from the query conditions when no match is found
 *
 * @method     ChildProformaInvoiceLine findOneById(int $id) Return the first ChildProformaInvoiceLine filtered by the id column
 * @method     ChildProformaInvoiceLine findOneByProformaInvoiceId(int $proforma_invoice_id) Return the first ChildProformaInvoiceLine filtered by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLine findOneByProductId(int $product_id) Return the first ChildProformaInvoiceLine filtered by the product_id column
 * @method     ChildProformaInvoiceLine findOneByProductFinishing(string $product_finishing) Return the first ChildProformaInvoiceLine filtered by the product_finishing column
 * @method     ChildProformaInvoiceLine findOneByName(string $name) Return the first ChildProformaInvoiceLine filtered by the name column
 * @method     ChildProformaInvoiceLine findOneByRemark(string $remark) Return the first ChildProformaInvoiceLine filtered by the remark column
 * @method     ChildProformaInvoiceLine findOneByDescription(string $description) Return the first ChildProformaInvoiceLine filtered by the description column
 * @method     ChildProformaInvoiceLine findOneByQty(int $qty) Return the first ChildProformaInvoiceLine filtered by the qty column
 * @method     ChildProformaInvoiceLine findOneByQtyPerPack(int $qty_per_pack) Return the first ChildProformaInvoiceLine filtered by the qty_per_pack column
 * @method     ChildProformaInvoiceLine findOneByCubicDimension(double $cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the cubic_dimension column
 * @method     ChildProformaInvoiceLine findOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLine findOneByPrice(double $price) Return the first ChildProformaInvoiceLine filtered by the price column
 * @method     ChildProformaInvoiceLine findOneByTotalPrice(double $total_price) Return the first ChildProformaInvoiceLine filtered by the total_price column
 * @method     ChildProformaInvoiceLine findOneByIsSample(boolean $is_sample) Return the first ChildProformaInvoiceLine filtered by the is_sample column
 * @method     ChildProformaInvoiceLine findOneByIsNeedBox(boolean $is_need_box) Return the first ChildProformaInvoiceLine filtered by the is_need_box column
 * @method     ChildProformaInvoiceLine findOneByActive(boolean $active) Return the first ChildProformaInvoiceLine filtered by the active column
 * @method     ChildProformaInvoiceLine findOneByCreatedAt(string $created_at) Return the first ChildProformaInvoiceLine filtered by the created_at column
 * @method     ChildProformaInvoiceLine findOneByUpdatedAt(string $updated_at) Return the first ChildProformaInvoiceLine filtered by the updated_at column *

 * @method     ChildProformaInvoiceLine requirePk($key, ConnectionInterface $con = null) Return the ChildProformaInvoiceLine by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOne(ConnectionInterface $con = null) Return the first ChildProformaInvoiceLine matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProformaInvoiceLine requireOneById(int $id) Return the first ChildProformaInvoiceLine filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByProformaInvoiceId(int $proforma_invoice_id) Return the first ChildProformaInvoiceLine filtered by the proforma_invoice_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByProductId(int $product_id) Return the first ChildProformaInvoiceLine filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByProductFinishing(string $product_finishing) Return the first ChildProformaInvoiceLine filtered by the product_finishing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByName(string $name) Return the first ChildProformaInvoiceLine filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByRemark(string $remark) Return the first ChildProformaInvoiceLine filtered by the remark column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByDescription(string $description) Return the first ChildProformaInvoiceLine filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByQty(int $qty) Return the first ChildProformaInvoiceLine filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByQtyPerPack(int $qty_per_pack) Return the first ChildProformaInvoiceLine filtered by the qty_per_pack column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByCubicDimension(double $cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the cubic_dimension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildProformaInvoiceLine filtered by the total_cubic_dimension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByPrice(double $price) Return the first ChildProformaInvoiceLine filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByTotalPrice(double $total_price) Return the first ChildProformaInvoiceLine filtered by the total_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByIsSample(boolean $is_sample) Return the first ChildProformaInvoiceLine filtered by the is_sample column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByIsNeedBox(boolean $is_need_box) Return the first ChildProformaInvoiceLine filtered by the is_need_box column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByActive(boolean $active) Return the first ChildProformaInvoiceLine filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByCreatedAt(string $created_at) Return the first ChildProformaInvoiceLine filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProformaInvoiceLine requireOneByUpdatedAt(string $updated_at) Return the first ChildProformaInvoiceLine filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProformaInvoiceLine[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProformaInvoiceLine objects based on current ModelCriteria
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findById(int $id) Return ChildProformaInvoiceLine objects filtered by the id column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByProformaInvoiceId(int $proforma_invoice_id) Return ChildProformaInvoiceLine objects filtered by the proforma_invoice_id column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByProductId(int $product_id) Return ChildProformaInvoiceLine objects filtered by the product_id column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByProductFinishing(string $product_finishing) Return ChildProformaInvoiceLine objects filtered by the product_finishing column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByName(string $name) Return ChildProformaInvoiceLine objects filtered by the name column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByRemark(string $remark) Return ChildProformaInvoiceLine objects filtered by the remark column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByDescription(string $description) Return ChildProformaInvoiceLine objects filtered by the description column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByQty(int $qty) Return ChildProformaInvoiceLine objects filtered by the qty column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByQtyPerPack(int $qty_per_pack) Return ChildProformaInvoiceLine objects filtered by the qty_per_pack column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByCubicDimension(double $cubic_dimension) Return ChildProformaInvoiceLine objects filtered by the cubic_dimension column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByTotalCubicDimension(double $total_cubic_dimension) Return ChildProformaInvoiceLine objects filtered by the total_cubic_dimension column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByPrice(double $price) Return ChildProformaInvoiceLine objects filtered by the price column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByTotalPrice(double $total_price) Return ChildProformaInvoiceLine objects filtered by the total_price column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByIsSample(boolean $is_sample) Return ChildProformaInvoiceLine objects filtered by the is_sample column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByIsNeedBox(boolean $is_need_box) Return ChildProformaInvoiceLine objects filtered by the is_need_box column
 * @method     ChildProformaInvoiceLine[]|ObjectCollection findByActive(boolean $active) Return ChildProformaInvoiceLine objects filtered by the active column
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
        $sql = 'SELECT id, proforma_invoice_id, product_id, product_finishing, name, remark, description, qty, qty_per_pack, cubic_dimension, total_cubic_dimension, price, total_price, is_sample, is_need_box, active, created_at, updated_at FROM proforma_invoice_line WHERE id = :p0';
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the product_finishing column
     *
     * Example usage:
     * <code>
     * $query->filterByProductFinishing('fooValue');   // WHERE product_finishing = 'fooValue'
     * $query->filterByProductFinishing('%fooValue%', Criteria::LIKE); // WHERE product_finishing LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productFinishing The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProductFinishing($productFinishing = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productFinishing)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_FINISHING, $productFinishing, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the remark column
     *
     * Example usage:
     * <code>
     * $query->filterByRemark('fooValue');   // WHERE remark = 'fooValue'
     * $query->filterByRemark('%fooValue%', Criteria::LIKE); // WHERE remark LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remark The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByRemark($remark = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remark)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_REMARK, $remark, $comparison);
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
     * Filter the query on the qty_per_pack column
     *
     * Example usage:
     * <code>
     * $query->filterByQtyPerPack(1234); // WHERE qty_per_pack = 1234
     * $query->filterByQtyPerPack(array(12, 34)); // WHERE qty_per_pack IN (12, 34)
     * $query->filterByQtyPerPack(array('min' => 12)); // WHERE qty_per_pack > 12
     * </code>
     *
     * @param     mixed $qtyPerPack The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByQtyPerPack($qtyPerPack = null, $comparison = null)
    {
        if (is_array($qtyPerPack)) {
            $useMinMax = false;
            if (isset($qtyPerPack['min'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY_PER_PACK, $qtyPerPack['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qtyPerPack['max'])) {
                $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY_PER_PACK, $qtyPerPack['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_QTY_PER_PACK, $qtyPerPack, $comparison);
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
     * Filter the query on the is_sample column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSample(true); // WHERE is_sample = true
     * $query->filterByIsSample('yes'); // WHERE is_sample = true
     * </code>
     *
     * @param     boolean|string $isSample The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByIsSample($isSample = null, $comparison = null)
    {
        if (is_string($isSample)) {
            $isSample = in_array(strtolower($isSample), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_IS_SAMPLE, $isSample, $comparison);
    }

    /**
     * Filter the query on the is_need_box column
     *
     * Example usage:
     * <code>
     * $query->filterByIsNeedBox(true); // WHERE is_need_box = true
     * $query->filterByIsNeedBox('yes'); // WHERE is_need_box = true
     * </code>
     *
     * @param     boolean|string $isNeedBox The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByIsNeedBox($isNeedBox = null, $comparison = null)
    {
        if (is_string($isNeedBox)) {
            $isNeedBox = in_array(strtolower($isNeedBox), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_IS_NEED_BOX, $isNeedBox, $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ProformaInvoiceLineTableMap::COL_ACTIVE, $active, $comparison);
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
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
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
     * Filter the query by a related \PackingListLine object
     *
     * @param \PackingListLine|ObjectCollection $packingListLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByPackingListLine($packingListLine, $comparison = null)
    {
        if ($packingListLine instanceof \PackingListLine) {
            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $packingListLine->getProformaInvoiceLineId(), $comparison);
        } elseif ($packingListLine instanceof ObjectCollection) {
            return $this
                ->usePackingListLineQuery()
                ->filterByPrimaryKeys($packingListLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPackingListLine() only accepts arguments of type \PackingListLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackingListLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function joinPackingListLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackingListLine');

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
            $this->addJoinObject($join, 'PackingListLine');
        }

        return $this;
    }

    /**
     * Use the PackingListLine relation PackingListLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PackingListLineQuery A secondary query class using the current class as primary query
     */
    public function usePackingListLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackingListLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackingListLine', '\PackingListLineQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrderLine object
     *
     * @param \PurchaseOrderLine|ObjectCollection $purchaseOrderLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrderLine($purchaseOrderLine, $comparison = null)
    {
        if ($purchaseOrderLine instanceof \PurchaseOrderLine) {
            return $this
                ->addUsingAlias(ProformaInvoiceLineTableMap::COL_ID, $purchaseOrderLine->getProformaInvoiceLineId(), $comparison);
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
     * @return $this|ChildProformaInvoiceLineQuery The current query, for fluid interface
     */
    public function joinPurchaseOrderLine($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function usePurchaseOrderLineQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPurchaseOrderLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrderLine', '\PurchaseOrderLineQuery');
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
