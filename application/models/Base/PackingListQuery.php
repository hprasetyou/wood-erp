<?php

namespace Base;

use \PackingList as ChildPackingList;
use \PackingListQuery as ChildPackingListQuery;
use \Exception;
use \PDO;
use Map\PackingListTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'packing_list' table.
 *
 *
 *
 * @method     ChildPackingListQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPackingListQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPackingListQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildPackingListQuery orderByLoadingDate($order = Criteria::ASC) Order by the loading_date column
 * @method     ChildPackingListQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 * @method     ChildPackingListQuery orderByOceanVessel($order = Criteria::ASC) Order by the ocean_vessel column
 * @method     ChildPackingListQuery orderByBlNo($order = Criteria::ASC) Order by the bl_no column
 * @method     ChildPackingListQuery orderByGoodsDescription($order = Criteria::ASC) Order by the goods_description column
 * @method     ChildPackingListQuery orderByCntrNo($order = Criteria::ASC) Order by the cntr_no column
 * @method     ChildPackingListQuery orderBySealNo($order = Criteria::ASC) Order by the seal_no column
 * @method     ChildPackingListQuery orderByPod($order = Criteria::ASC) Order by the pod column
 * @method     ChildPackingListQuery orderByShipping($order = Criteria::ASC) Order by the shipping column
 * @method     ChildPackingListQuery orderByPol($order = Criteria::ASC) Order by the pol column
 * @method     ChildPackingListQuery orderByEtdSrg($order = Criteria::ASC) Order by the etd_srg column
 * @method     ChildPackingListQuery orderByRefDoc($order = Criteria::ASC) Order by the ref_doc column
 * @method     ChildPackingListQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildPackingListQuery orderByTotalQty($order = Criteria::ASC) Order by the total_qty column
 * @method     ChildPackingListQuery orderByTotalQtyOfPack($order = Criteria::ASC) Order by the total_qty_of_pack column
 * @method     ChildPackingListQuery orderByTotalCubicDimension($order = Criteria::ASC) Order by the total_cubic_dimension column
 * @method     ChildPackingListQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildPackingListQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPackingListQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPackingListQuery groupById() Group by the id column
 * @method     ChildPackingListQuery groupByName() Group by the name column
 * @method     ChildPackingListQuery groupByDate() Group by the date column
 * @method     ChildPackingListQuery groupByLoadingDate() Group by the loading_date column
 * @method     ChildPackingListQuery groupByCustomerId() Group by the customer_id column
 * @method     ChildPackingListQuery groupByOceanVessel() Group by the ocean_vessel column
 * @method     ChildPackingListQuery groupByBlNo() Group by the bl_no column
 * @method     ChildPackingListQuery groupByGoodsDescription() Group by the goods_description column
 * @method     ChildPackingListQuery groupByCntrNo() Group by the cntr_no column
 * @method     ChildPackingListQuery groupBySealNo() Group by the seal_no column
 * @method     ChildPackingListQuery groupByPod() Group by the pod column
 * @method     ChildPackingListQuery groupByShipping() Group by the shipping column
 * @method     ChildPackingListQuery groupByPol() Group by the pol column
 * @method     ChildPackingListQuery groupByEtdSrg() Group by the etd_srg column
 * @method     ChildPackingListQuery groupByRefDoc() Group by the ref_doc column
 * @method     ChildPackingListQuery groupByState() Group by the state column
 * @method     ChildPackingListQuery groupByTotalQty() Group by the total_qty column
 * @method     ChildPackingListQuery groupByTotalQtyOfPack() Group by the total_qty_of_pack column
 * @method     ChildPackingListQuery groupByTotalCubicDimension() Group by the total_cubic_dimension column
 * @method     ChildPackingListQuery groupByActive() Group by the active column
 * @method     ChildPackingListQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPackingListQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPackingListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPackingListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPackingListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPackingListQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPackingListQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPackingListQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPackingListQuery leftJoinPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partner relation
 * @method     ChildPackingListQuery rightJoinPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partner relation
 * @method     ChildPackingListQuery innerJoinPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the Partner relation
 *
 * @method     ChildPackingListQuery joinWithPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Partner relation
 *
 * @method     ChildPackingListQuery leftJoinWithPartner() Adds a LEFT JOIN clause and with to the query using the Partner relation
 * @method     ChildPackingListQuery rightJoinWithPartner() Adds a RIGHT JOIN clause and with to the query using the Partner relation
 * @method     ChildPackingListQuery innerJoinWithPartner() Adds a INNER JOIN clause and with to the query using the Partner relation
 *
 * @method     ChildPackingListQuery leftJoinPackingListLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackingListLine relation
 * @method     ChildPackingListQuery rightJoinPackingListLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackingListLine relation
 * @method     ChildPackingListQuery innerJoinPackingListLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PackingListLine relation
 *
 * @method     ChildPackingListQuery joinWithPackingListLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackingListLine relation
 *
 * @method     ChildPackingListQuery leftJoinWithPackingListLine() Adds a LEFT JOIN clause and with to the query using the PackingListLine relation
 * @method     ChildPackingListQuery rightJoinWithPackingListLine() Adds a RIGHT JOIN clause and with to the query using the PackingListLine relation
 * @method     ChildPackingListQuery innerJoinWithPackingListLine() Adds a INNER JOIN clause and with to the query using the PackingListLine relation
 *
 * @method     ChildPackingListQuery leftJoinPurchaseOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildPackingListQuery rightJoinPurchaseOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildPackingListQuery innerJoinPurchaseOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrder relation
 *
 * @method     ChildPackingListQuery joinWithPurchaseOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildPackingListQuery leftJoinWithPurchaseOrder() Adds a LEFT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildPackingListQuery rightJoinWithPurchaseOrder() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildPackingListQuery innerJoinWithPurchaseOrder() Adds a INNER JOIN clause and with to the query using the PurchaseOrder relation
 *
 * @method     \PartnerQuery|\PackingListLineQuery|\PurchaseOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPackingList findOne(ConnectionInterface $con = null) Return the first ChildPackingList matching the query
 * @method     ChildPackingList findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPackingList matching the query, or a new ChildPackingList object populated from the query conditions when no match is found
 *
 * @method     ChildPackingList findOneById(int $id) Return the first ChildPackingList filtered by the id column
 * @method     ChildPackingList findOneByName(string $name) Return the first ChildPackingList filtered by the name column
 * @method     ChildPackingList findOneByDate(string $date) Return the first ChildPackingList filtered by the date column
 * @method     ChildPackingList findOneByLoadingDate(string $loading_date) Return the first ChildPackingList filtered by the loading_date column
 * @method     ChildPackingList findOneByCustomerId(int $customer_id) Return the first ChildPackingList filtered by the customer_id column
 * @method     ChildPackingList findOneByOceanVessel(string $ocean_vessel) Return the first ChildPackingList filtered by the ocean_vessel column
 * @method     ChildPackingList findOneByBlNo(string $bl_no) Return the first ChildPackingList filtered by the bl_no column
 * @method     ChildPackingList findOneByGoodsDescription(string $goods_description) Return the first ChildPackingList filtered by the goods_description column
 * @method     ChildPackingList findOneByCntrNo(string $cntr_no) Return the first ChildPackingList filtered by the cntr_no column
 * @method     ChildPackingList findOneBySealNo(string $seal_no) Return the first ChildPackingList filtered by the seal_no column
 * @method     ChildPackingList findOneByPod(string $pod) Return the first ChildPackingList filtered by the pod column
 * @method     ChildPackingList findOneByShipping(string $shipping) Return the first ChildPackingList filtered by the shipping column
 * @method     ChildPackingList findOneByPol(string $pol) Return the first ChildPackingList filtered by the pol column
 * @method     ChildPackingList findOneByEtdSrg(string $etd_srg) Return the first ChildPackingList filtered by the etd_srg column
 * @method     ChildPackingList findOneByRefDoc(string $ref_doc) Return the first ChildPackingList filtered by the ref_doc column
 * @method     ChildPackingList findOneByState(string $state) Return the first ChildPackingList filtered by the state column
 * @method     ChildPackingList findOneByTotalQty(int $total_qty) Return the first ChildPackingList filtered by the total_qty column
 * @method     ChildPackingList findOneByTotalQtyOfPack(int $total_qty_of_pack) Return the first ChildPackingList filtered by the total_qty_of_pack column
 * @method     ChildPackingList findOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildPackingList filtered by the total_cubic_dimension column
 * @method     ChildPackingList findOneByActive(boolean $active) Return the first ChildPackingList filtered by the active column
 * @method     ChildPackingList findOneByCreatedAt(string $created_at) Return the first ChildPackingList filtered by the created_at column
 * @method     ChildPackingList findOneByUpdatedAt(string $updated_at) Return the first ChildPackingList filtered by the updated_at column *

 * @method     ChildPackingList requirePk($key, ConnectionInterface $con = null) Return the ChildPackingList by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOne(ConnectionInterface $con = null) Return the first ChildPackingList matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackingList requireOneById(int $id) Return the first ChildPackingList filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByName(string $name) Return the first ChildPackingList filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByDate(string $date) Return the first ChildPackingList filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByLoadingDate(string $loading_date) Return the first ChildPackingList filtered by the loading_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByCustomerId(int $customer_id) Return the first ChildPackingList filtered by the customer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByOceanVessel(string $ocean_vessel) Return the first ChildPackingList filtered by the ocean_vessel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByBlNo(string $bl_no) Return the first ChildPackingList filtered by the bl_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByGoodsDescription(string $goods_description) Return the first ChildPackingList filtered by the goods_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByCntrNo(string $cntr_no) Return the first ChildPackingList filtered by the cntr_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneBySealNo(string $seal_no) Return the first ChildPackingList filtered by the seal_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByPod(string $pod) Return the first ChildPackingList filtered by the pod column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByShipping(string $shipping) Return the first ChildPackingList filtered by the shipping column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByPol(string $pol) Return the first ChildPackingList filtered by the pol column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByEtdSrg(string $etd_srg) Return the first ChildPackingList filtered by the etd_srg column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByRefDoc(string $ref_doc) Return the first ChildPackingList filtered by the ref_doc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByState(string $state) Return the first ChildPackingList filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByTotalQty(int $total_qty) Return the first ChildPackingList filtered by the total_qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByTotalQtyOfPack(int $total_qty_of_pack) Return the first ChildPackingList filtered by the total_qty_of_pack column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByTotalCubicDimension(double $total_cubic_dimension) Return the first ChildPackingList filtered by the total_cubic_dimension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByActive(boolean $active) Return the first ChildPackingList filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByCreatedAt(string $created_at) Return the first ChildPackingList filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPackingList requireOneByUpdatedAt(string $updated_at) Return the first ChildPackingList filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPackingList[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPackingList objects based on current ModelCriteria
 * @method     ChildPackingList[]|ObjectCollection findById(int $id) Return ChildPackingList objects filtered by the id column
 * @method     ChildPackingList[]|ObjectCollection findByName(string $name) Return ChildPackingList objects filtered by the name column
 * @method     ChildPackingList[]|ObjectCollection findByDate(string $date) Return ChildPackingList objects filtered by the date column
 * @method     ChildPackingList[]|ObjectCollection findByLoadingDate(string $loading_date) Return ChildPackingList objects filtered by the loading_date column
 * @method     ChildPackingList[]|ObjectCollection findByCustomerId(int $customer_id) Return ChildPackingList objects filtered by the customer_id column
 * @method     ChildPackingList[]|ObjectCollection findByOceanVessel(string $ocean_vessel) Return ChildPackingList objects filtered by the ocean_vessel column
 * @method     ChildPackingList[]|ObjectCollection findByBlNo(string $bl_no) Return ChildPackingList objects filtered by the bl_no column
 * @method     ChildPackingList[]|ObjectCollection findByGoodsDescription(string $goods_description) Return ChildPackingList objects filtered by the goods_description column
 * @method     ChildPackingList[]|ObjectCollection findByCntrNo(string $cntr_no) Return ChildPackingList objects filtered by the cntr_no column
 * @method     ChildPackingList[]|ObjectCollection findBySealNo(string $seal_no) Return ChildPackingList objects filtered by the seal_no column
 * @method     ChildPackingList[]|ObjectCollection findByPod(string $pod) Return ChildPackingList objects filtered by the pod column
 * @method     ChildPackingList[]|ObjectCollection findByShipping(string $shipping) Return ChildPackingList objects filtered by the shipping column
 * @method     ChildPackingList[]|ObjectCollection findByPol(string $pol) Return ChildPackingList objects filtered by the pol column
 * @method     ChildPackingList[]|ObjectCollection findByEtdSrg(string $etd_srg) Return ChildPackingList objects filtered by the etd_srg column
 * @method     ChildPackingList[]|ObjectCollection findByRefDoc(string $ref_doc) Return ChildPackingList objects filtered by the ref_doc column
 * @method     ChildPackingList[]|ObjectCollection findByState(string $state) Return ChildPackingList objects filtered by the state column
 * @method     ChildPackingList[]|ObjectCollection findByTotalQty(int $total_qty) Return ChildPackingList objects filtered by the total_qty column
 * @method     ChildPackingList[]|ObjectCollection findByTotalQtyOfPack(int $total_qty_of_pack) Return ChildPackingList objects filtered by the total_qty_of_pack column
 * @method     ChildPackingList[]|ObjectCollection findByTotalCubicDimension(double $total_cubic_dimension) Return ChildPackingList objects filtered by the total_cubic_dimension column
 * @method     ChildPackingList[]|ObjectCollection findByActive(boolean $active) Return ChildPackingList objects filtered by the active column
 * @method     ChildPackingList[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPackingList objects filtered by the created_at column
 * @method     ChildPackingList[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPackingList objects filtered by the updated_at column
 * @method     ChildPackingList[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PackingListQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PackingListQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PackingList', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPackingListQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPackingListQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPackingListQuery) {
            return $criteria;
        }
        $query = new ChildPackingListQuery();
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
     * @return ChildPackingList|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PackingListTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PackingListTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPackingList A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, date, loading_date, customer_id, ocean_vessel, bl_no, goods_description, cntr_no, seal_no, pod, shipping, pol, etd_srg, ref_doc, state, total_qty, total_qty_of_pack, total_cubic_dimension, active, created_at, updated_at FROM packing_list WHERE id = :p0';
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
            /** @var ChildPackingList $obj */
            $obj = new ChildPackingList();
            $obj->hydrate($row);
            PackingListTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPackingList|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PackingListTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PackingListTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_DATE, $date, $comparison);
    }

    /**
     * Filter the query on the loading_date column
     *
     * Example usage:
     * <code>
     * $query->filterByLoadingDate('2011-03-14'); // WHERE loading_date = '2011-03-14'
     * $query->filterByLoadingDate('now'); // WHERE loading_date = '2011-03-14'
     * $query->filterByLoadingDate(array('max' => 'yesterday')); // WHERE loading_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $loadingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByLoadingDate($loadingDate = null, $comparison = null)
    {
        if (is_array($loadingDate)) {
            $useMinMax = false;
            if (isset($loadingDate['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_LOADING_DATE, $loadingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($loadingDate['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_LOADING_DATE, $loadingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_LOADING_DATE, $loadingDate, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByCustomerId($customerId = null, $comparison = null)
    {
        if (is_array($customerId)) {
            $useMinMax = false;
            if (isset($customerId['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_CUSTOMER_ID, $customerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customerId['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_CUSTOMER_ID, $customerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_CUSTOMER_ID, $customerId, $comparison);
    }

    /**
     * Filter the query on the ocean_vessel column
     *
     * Example usage:
     * <code>
     * $query->filterByOceanVessel('fooValue');   // WHERE ocean_vessel = 'fooValue'
     * $query->filterByOceanVessel('%fooValue%', Criteria::LIKE); // WHERE ocean_vessel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $oceanVessel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByOceanVessel($oceanVessel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($oceanVessel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_OCEAN_VESSEL, $oceanVessel, $comparison);
    }

    /**
     * Filter the query on the bl_no column
     *
     * Example usage:
     * <code>
     * $query->filterByBlNo('fooValue');   // WHERE bl_no = 'fooValue'
     * $query->filterByBlNo('%fooValue%', Criteria::LIKE); // WHERE bl_no LIKE '%fooValue%'
     * </code>
     *
     * @param     string $blNo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByBlNo($blNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($blNo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_BL_NO, $blNo, $comparison);
    }

    /**
     * Filter the query on the goods_description column
     *
     * Example usage:
     * <code>
     * $query->filterByGoodsDescription('fooValue');   // WHERE goods_description = 'fooValue'
     * $query->filterByGoodsDescription('%fooValue%', Criteria::LIKE); // WHERE goods_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $goodsDescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByGoodsDescription($goodsDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($goodsDescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_GOODS_DESCRIPTION, $goodsDescription, $comparison);
    }

    /**
     * Filter the query on the cntr_no column
     *
     * Example usage:
     * <code>
     * $query->filterByCntrNo('fooValue');   // WHERE cntr_no = 'fooValue'
     * $query->filterByCntrNo('%fooValue%', Criteria::LIKE); // WHERE cntr_no LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cntrNo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByCntrNo($cntrNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cntrNo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_CNTR_NO, $cntrNo, $comparison);
    }

    /**
     * Filter the query on the seal_no column
     *
     * Example usage:
     * <code>
     * $query->filterBySealNo('fooValue');   // WHERE seal_no = 'fooValue'
     * $query->filterBySealNo('%fooValue%', Criteria::LIKE); // WHERE seal_no LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sealNo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterBySealNo($sealNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sealNo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_SEAL_NO, $sealNo, $comparison);
    }

    /**
     * Filter the query on the pod column
     *
     * Example usage:
     * <code>
     * $query->filterByPod('fooValue');   // WHERE pod = 'fooValue'
     * $query->filterByPod('%fooValue%', Criteria::LIKE); // WHERE pod LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pod The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPod($pod = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pod)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_POD, $pod, $comparison);
    }

    /**
     * Filter the query on the shipping column
     *
     * Example usage:
     * <code>
     * $query->filterByShipping('fooValue');   // WHERE shipping = 'fooValue'
     * $query->filterByShipping('%fooValue%', Criteria::LIKE); // WHERE shipping LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shipping The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByShipping($shipping = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shipping)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_SHIPPING, $shipping, $comparison);
    }

    /**
     * Filter the query on the pol column
     *
     * Example usage:
     * <code>
     * $query->filterByPol('fooValue');   // WHERE pol = 'fooValue'
     * $query->filterByPol('%fooValue%', Criteria::LIKE); // WHERE pol LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pol The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPol($pol = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pol)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_POL, $pol, $comparison);
    }

    /**
     * Filter the query on the etd_srg column
     *
     * Example usage:
     * <code>
     * $query->filterByEtdSrg('fooValue');   // WHERE etd_srg = 'fooValue'
     * $query->filterByEtdSrg('%fooValue%', Criteria::LIKE); // WHERE etd_srg LIKE '%fooValue%'
     * </code>
     *
     * @param     string $etdSrg The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByEtdSrg($etdSrg = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($etdSrg)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_ETD_SRG, $etdSrg, $comparison);
    }

    /**
     * Filter the query on the ref_doc column
     *
     * Example usage:
     * <code>
     * $query->filterByRefDoc('fooValue');   // WHERE ref_doc = 'fooValue'
     * $query->filterByRefDoc('%fooValue%', Criteria::LIKE); // WHERE ref_doc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $refDoc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByRefDoc($refDoc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($refDoc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_REF_DOC, $refDoc, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the total_qty column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalQty(1234); // WHERE total_qty = 1234
     * $query->filterByTotalQty(array(12, 34)); // WHERE total_qty IN (12, 34)
     * $query->filterByTotalQty(array('min' => 12)); // WHERE total_qty > 12
     * </code>
     *
     * @param     mixed $totalQty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByTotalQty($totalQty = null, $comparison = null)
    {
        if (is_array($totalQty)) {
            $useMinMax = false;
            if (isset($totalQty['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_TOTAL_QTY, $totalQty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalQty['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_TOTAL_QTY, $totalQty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_TOTAL_QTY, $totalQty, $comparison);
    }

    /**
     * Filter the query on the total_qty_of_pack column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalQtyOfPack(1234); // WHERE total_qty_of_pack = 1234
     * $query->filterByTotalQtyOfPack(array(12, 34)); // WHERE total_qty_of_pack IN (12, 34)
     * $query->filterByTotalQtyOfPack(array('min' => 12)); // WHERE total_qty_of_pack > 12
     * </code>
     *
     * @param     mixed $totalQtyOfPack The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByTotalQtyOfPack($totalQtyOfPack = null, $comparison = null)
    {
        if (is_array($totalQtyOfPack)) {
            $useMinMax = false;
            if (isset($totalQtyOfPack['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_TOTAL_QTY_OF_PACK, $totalQtyOfPack['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalQtyOfPack['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_TOTAL_QTY_OF_PACK, $totalQtyOfPack['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_TOTAL_QTY_OF_PACK, $totalQtyOfPack, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByTotalCubicDimension($totalCubicDimension = null, $comparison = null)
    {
        if (is_array($totalCubicDimension)) {
            $useMinMax = false;
            if (isset($totalCubicDimension['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalCubicDimension['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_TOTAL_CUBIC_DIMENSION, $totalCubicDimension, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PackingListTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PackingListTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PackingListTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PackingListTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPartner($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(PackingListTableMap::COL_CUSTOMER_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PackingListTableMap::COL_CUSTOMER_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
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
     * Filter the query by a related \PackingListLine object
     *
     * @param \PackingListLine|ObjectCollection $packingListLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPackingListLine($packingListLine, $comparison = null)
    {
        if ($packingListLine instanceof \PackingListLine) {
            return $this
                ->addUsingAlias(PackingListTableMap::COL_ID, $packingListLine->getPackingListId(), $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
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
     * Filter the query by a related \PurchaseOrder object
     *
     * @param \PurchaseOrder|ObjectCollection $purchaseOrder the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPackingListQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrder($purchaseOrder, $comparison = null)
    {
        if ($purchaseOrder instanceof \PurchaseOrder) {
            return $this
                ->addUsingAlias(PackingListTableMap::COL_ID, $purchaseOrder->getPackingListId(), $comparison);
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
     * @return $this|ChildPackingListQuery The current query, for fluid interface
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
     * @param   ChildPackingList $packingList Object to remove from the list of results
     *
     * @return $this|ChildPackingListQuery The current query, for fluid interface
     */
    public function prune($packingList = null)
    {
        if ($packingList) {
            $this->addUsingAlias(PackingListTableMap::COL_ID, $packingList->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the packing_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PackingListTableMap::clearInstancePool();
            PackingListTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PackingListTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PackingListTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PackingListTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PackingListTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PackingListQuery
