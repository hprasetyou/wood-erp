<?php

namespace Base;

use \DownPayment as ChildDownPayment;
use \DownPaymentQuery as ChildDownPaymentQuery;
use \Exception;
use \PDO;
use Map\DownPaymentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'down_payment' table.
 *
 *
 *
 * @method     ChildDownPaymentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDownPaymentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildDownPaymentQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildDownPaymentQuery groupById() Group by the id column
 * @method     ChildDownPaymentQuery groupByName() Group by the name column
 * @method     ChildDownPaymentQuery groupByValue() Group by the value column
 *
 * @method     ChildDownPaymentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDownPaymentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDownPaymentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDownPaymentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDownPaymentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDownPaymentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDownPaymentQuery leftJoinPurchaseOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildDownPaymentQuery rightJoinPurchaseOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildDownPaymentQuery innerJoinPurchaseOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrder relation
 *
 * @method     ChildDownPaymentQuery joinWithPurchaseOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildDownPaymentQuery leftJoinWithPurchaseOrder() Adds a LEFT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildDownPaymentQuery rightJoinWithPurchaseOrder() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildDownPaymentQuery innerJoinWithPurchaseOrder() Adds a INNER JOIN clause and with to the query using the PurchaseOrder relation
 *
 * @method     \PurchaseOrderQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDownPayment findOne(ConnectionInterface $con = null) Return the first ChildDownPayment matching the query
 * @method     ChildDownPayment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDownPayment matching the query, or a new ChildDownPayment object populated from the query conditions when no match is found
 *
 * @method     ChildDownPayment findOneById(int $id) Return the first ChildDownPayment filtered by the id column
 * @method     ChildDownPayment findOneByName(string $name) Return the first ChildDownPayment filtered by the name column
 * @method     ChildDownPayment findOneByValue(double $value) Return the first ChildDownPayment filtered by the value column *

 * @method     ChildDownPayment requirePk($key, ConnectionInterface $con = null) Return the ChildDownPayment by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownPayment requireOne(ConnectionInterface $con = null) Return the first ChildDownPayment matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDownPayment requireOneById(int $id) Return the first ChildDownPayment filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownPayment requireOneByName(string $name) Return the first ChildDownPayment filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownPayment requireOneByValue(double $value) Return the first ChildDownPayment filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDownPayment[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDownPayment objects based on current ModelCriteria
 * @method     ChildDownPayment[]|ObjectCollection findById(int $id) Return ChildDownPayment objects filtered by the id column
 * @method     ChildDownPayment[]|ObjectCollection findByName(string $name) Return ChildDownPayment objects filtered by the name column
 * @method     ChildDownPayment[]|ObjectCollection findByValue(double $value) Return ChildDownPayment objects filtered by the value column
 * @method     ChildDownPayment[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DownPaymentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DownPaymentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DownPayment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDownPaymentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDownPaymentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDownPaymentQuery) {
            return $criteria;
        }
        $query = new ChildDownPaymentQuery();
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
     * @return ChildDownPayment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DownPaymentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DownPaymentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDownPayment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, value FROM down_payment WHERE id = :p0';
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
            /** @var ChildDownPayment $obj */
            $obj = new ChildDownPayment();
            $obj->hydrate($row);
            DownPaymentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDownPayment|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DownPaymentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DownPaymentTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DownPaymentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DownPaymentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownPaymentTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownPaymentTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(DownPaymentTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(DownPaymentTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownPaymentTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \PurchaseOrder object
     *
     * @param \PurchaseOrder|ObjectCollection $purchaseOrder the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDownPaymentQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrder($purchaseOrder, $comparison = null)
    {
        if ($purchaseOrder instanceof \PurchaseOrder) {
            return $this
                ->addUsingAlias(DownPaymentTableMap::COL_ID, $purchaseOrder->getDownPaymentId(), $comparison);
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
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
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
     * @param   ChildDownPayment $downPayment Object to remove from the list of results
     *
     * @return $this|ChildDownPaymentQuery The current query, for fluid interface
     */
    public function prune($downPayment = null)
    {
        if ($downPayment) {
            $this->addUsingAlias(DownPaymentTableMap::COL_ID, $downPayment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the down_payment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownPaymentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DownPaymentTableMap::clearInstancePool();
            DownPaymentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DownPaymentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DownPaymentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DownPaymentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DownPaymentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DownPaymentQuery
