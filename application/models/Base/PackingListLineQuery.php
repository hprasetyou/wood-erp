<?php

namespace Base;

use \PackingListLine as ChildPackingListLine;
use \PackingListLineQuery as ChildPackingListLineQuery;
use \Exception;
use \PDO;
use Map\PackingListLineTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'packing_list_line' table.
 *
 *
 *
 * @method     ChildPackingListLineQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPackingListLineQuery orderByPackingListId($order = Criteria::ASC) Order by the packing_list_id column
 * @method     ChildPackingListLineQuery orderByProformaInvoiceLineId($order = Criteria::ASC) Order by the proforma_invoice_line_id column
 * @method     ChildPackingListLineQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method     ChildPackingListLineQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPackingListLineQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPackingListLineQuery groupById() Group by the id column
 * @method     ChildPackingListLineQuery groupByPackingListId() Group by the packing_list_id column
 * @method     ChildPackingListLineQuery groupByProformaInvoiceLineId() Group by the proforma_invoice_line_id column
 * @method     ChildPackingListLineQuery groupByQty() Group by the qty column
 * @method     ChildPackingListLineQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPackingListLineQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPackingListLineQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPackingListLineQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPackingListLineQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPackingListLineQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPackingListLineQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPackingListLineQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPackingListLineQuery leftJoinPackingList($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackingList relation
 * @method     ChildPackingListLineQuery rightJoinPackingList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackingList relation
 * @method     ChildPackingListLineQuery innerJoinPackingList($relationAlias = null) Adds a INNER JOIN clause to the query using the PackingList relation
 *
 * @method     ChildPackingListLineQuery joinWithPackingList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackingList relation
 *
 * @method     ChildPackingListLineQuery leftJoinWithPackingList() Adds a LEFT JOIN clause and with to the query using the PackingList relation
 * @method     ChildPackingListLineQuery rightJoinWithPackingList() Adds a RIGHT JOIN clause and with to the query using the PackingList relation
 * @method     ChildPackingListLineQuery innerJoinWithPackingList() Adds a INNER JOIN clause and with to the query using the PackingList relation
 *
 * @method     ChildPackingListLineQuery leftJoinProformaInvoiceLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildPackingListLineQuery rightJoinProformaInvoiceLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoiceLine relation
 * @method     ChildPackingListLineQuery innerJoinProformaInvoiceLine($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildPackingListLineQuery joinWithProformaInvoiceLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     ChildPackingListLineQuery leftJoinWithProformaInvoiceLine() Adds a LEFT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildPackingListLineQuery rightJoinWithProformaInvoiceLine() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoiceLine relation
 * @method     ChildPackingListLineQuery innerJoinWithProformaInvoiceLine() Adds a INNER JOIN clause and with to the query using the ProformaInvoiceLine relation
 *
 * @method     \PackingListQuery|\ProformaInvoiceLineQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPackingListLine findOne(ConnectionInterface $con = null) Return the first ChildPackingListLine matching the query
 * @method     ChildPackingListLine findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPackingListLine matching the query, or a new ChildPackingListLine object populated from the query conditions when no match is found
 *
 * @method     ChildPackingListLine findOneById(int $id) Return the first ChildPackingListLine filtered by the id column
 * @method     ChildPackingListLine findOneByPackingListId(int $packing_list_id) Return the first ChildPackingListLine filtered by the packing_list_id column
 * @method     ChildPackingListLine findOneByProformaInvoiceLineId(int $proforma_invoice_line_id) Return the first ChildPackingListLine filtered by the proforma_invoice_line_id column
 * @method     ChildPackingListLine findOneByQty(int $qty) Return the first ChildPackingListLine filtered by the qty column
 * @method     ChildPackingListLine findOneByCreatedAt(string $created_at) Return the first ChildPackingListLine filtered by the created_at column
 * @method     ChildPackingListLine findOneByUpdatedAt(string $updated_at) Return the first ChildPackingListLine filtered by the updated_at column *

 * @method     ChildPackingListLine requirePk($key, ConnectionInterface $con = null) Return the ChildPackingListLine by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingListLine requireOne(ConnectionInterface $con = null) Return the first ChildPackingListLine matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackingListLine requireOneById(int $id) Return the first ChildPackingListLine filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingListLine requireOneByPackingListId(int $packing_list_id) Return the first ChildPackingListLine filtered by the packing_list_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingListLine requireOneByProformaInvoiceLineId(int $proforma_invoice_line_id) Return the first ChildPackingListLine filtered by the proforma_invoice_line_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingListLine requireOneByQty(int $qty) Return the first ChildPackingListLine filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingListLine requireOneByCreatedAt(string $created_at) Return the first ChildPackingListLine filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingListLine requireOneByUpdatedAt(string $updated_at) Return the first ChildPackingListLine filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackingListLine[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPackingListLine objects based on current ModelCriteria
 * @method     ChildPackingListLine[]|ObjectCollection findById(int $id) Return ChildPackingListLine objects filtered by the id column
 * @method     ChildPackingListLine[]|ObjectCollection findByPackingListId(int $packing_list_id) Return ChildPackingListLine objects filtered by the packing_list_id column
 * @method     ChildPackingListLine[]|ObjectCollection findByProformaInvoiceLineId(int $proforma_invoice_line_id) Return ChildPackingListLine objects filtered by the proforma_invoice_line_id column
 * @method     ChildPackingListLine[]|ObjectCollection findByQty(int $qty) Return ChildPackingListLine objects filtered by the qty column
 * @method     ChildPackingListLine[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPackingListLine objects filtered by the created_at column
 * @method     ChildPackingListLine[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPackingListLine objects filtered by the updated_at column
 * @method     ChildPackingListLine[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PackingListLineQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PackingListLineQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PackingListLine', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPackingListLineQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPackingListLineQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPackingListLineQuery) {
            return $criteria;
        }
        $query = new ChildPackingListLineQuery();
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
     * @return ChildPackingListLine|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PackingListLineTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPackingListLine A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, packing_list_id, proforma_invoice_line_id, qty, created_at, updated_at FROM packing_list_line WHERE id = :p0';
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
            /** @var ChildPackingListLine $obj */
            $obj = new ChildPackingListLine();
            $obj->hydrate($row);
            PackingListLineTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPackingListLine|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PackingListLineTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PackingListLineTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListLineTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the packing_list_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPackingListId(1234); // WHERE packing_list_id = 1234
     * $query->filterByPackingListId(array(12, 34)); // WHERE packing_list_id IN (12, 34)
     * $query->filterByPackingListId(array('min' => 12)); // WHERE packing_list_id > 12
     * </code>
     *
     * @see       filterByPackingList()
     *
     * @param     mixed $packingListId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByPackingListId($packingListId = null, $comparison = null)
    {
        if (is_array($packingListId)) {
            $useMinMax = false;
            if (isset($packingListId['min'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_PACKING_LIST_ID, $packingListId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($packingListId['max'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_PACKING_LIST_ID, $packingListId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListLineTableMap::COL_PACKING_LIST_ID, $packingListId, $comparison);
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceLineId($proformaInvoiceLineId = null, $comparison = null)
    {
        if (is_array($proformaInvoiceLineId)) {
            $useMinMax = false;
            if (isset($proformaInvoiceLineId['min'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLineId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($proformaInvoiceLineId['max'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLineId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLineId, $comparison);
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListLineTableMap::COL_QTY, $qty, $comparison);
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListLineTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PackingListLineTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListLineTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \PackingList object
     *
     * @param \PackingList|ObjectCollection $packingList The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByPackingList($packingList, $comparison = null)
    {
        if ($packingList instanceof \PackingList) {
            return $this
                ->addUsingAlias(PackingListLineTableMap::COL_PACKING_LIST_ID, $packingList->getId(), $comparison);
        } elseif ($packingList instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PackingListLineTableMap::COL_PACKING_LIST_ID, $packingList->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPackingList() only accepts arguments of type \PackingList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackingList relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function joinPackingList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackingList');

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
            $this->addJoinObject($join, 'PackingList');
        }

        return $this;
    }

    /**
     * Use the PackingList relation PackingList object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PackingListQuery A secondary query class using the current class as primary query
     */
    public function usePackingListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackingList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackingList', '\PackingListQuery');
    }

    /**
     * Filter the query by a related \ProformaInvoiceLine object
     *
     * @param \ProformaInvoiceLine|ObjectCollection $proformaInvoiceLine The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPackingListLineQuery The current query, for fluid interface
     */
    public function filterByProformaInvoiceLine($proformaInvoiceLine, $comparison = null)
    {
        if ($proformaInvoiceLine instanceof \ProformaInvoiceLine) {
            return $this
                ->addUsingAlias(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLine->getId(), $comparison);
        } elseif ($proformaInvoiceLine instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PackingListLineTableMap::COL_PROFORMA_INVOICE_LINE_ID, $proformaInvoiceLine->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildPackingListLine $packingListLine Object to remove from the list of results
     *
     * @return $this|ChildPackingListLineQuery The current query, for fluid interface
     */
    public function prune($packingListLine = null)
    {
        if ($packingListLine) {
            $this->addUsingAlias(PackingListLineTableMap::COL_ID, $packingListLine->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the packing_list_line table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PackingListLineTableMap::clearInstancePool();
            PackingListLineTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListLineTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PackingListLineTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PackingListLineTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PackingListLineTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PackingListLineQuery
