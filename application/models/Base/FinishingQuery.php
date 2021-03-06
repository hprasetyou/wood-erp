<?php

namespace Base;

use \Finishing as ChildFinishing;
use \FinishingQuery as ChildFinishingQuery;
use \Exception;
use \PDO;
use Map\FinishingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'finishing' table.
 *
 *
 *
 * @method     ChildFinishingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFinishingQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildFinishingQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildFinishingQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildFinishingQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFinishingQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildFinishingQuery groupById() Group by the id column
 * @method     ChildFinishingQuery groupByName() Group by the name column
 * @method     ChildFinishingQuery groupByDescription() Group by the description column
 * @method     ChildFinishingQuery groupByActive() Group by the active column
 * @method     ChildFinishingQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFinishingQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildFinishingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFinishingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFinishingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFinishingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFinishingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFinishingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFinishingQuery leftJoinProductFinishing($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductFinishing relation
 * @method     ChildFinishingQuery rightJoinProductFinishing($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductFinishing relation
 * @method     ChildFinishingQuery innerJoinProductFinishing($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductFinishing relation
 *
 * @method     ChildFinishingQuery joinWithProductFinishing($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductFinishing relation
 *
 * @method     ChildFinishingQuery leftJoinWithProductFinishing() Adds a LEFT JOIN clause and with to the query using the ProductFinishing relation
 * @method     ChildFinishingQuery rightJoinWithProductFinishing() Adds a RIGHT JOIN clause and with to the query using the ProductFinishing relation
 * @method     ChildFinishingQuery innerJoinWithProductFinishing() Adds a INNER JOIN clause and with to the query using the ProductFinishing relation
 *
 * @method     \ProductFinishingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFinishing findOne(ConnectionInterface $con = null) Return the first ChildFinishing matching the query
 * @method     ChildFinishing findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFinishing matching the query, or a new ChildFinishing object populated from the query conditions when no match is found
 *
 * @method     ChildFinishing findOneById(int $id) Return the first ChildFinishing filtered by the id column
 * @method     ChildFinishing findOneByName(string $name) Return the first ChildFinishing filtered by the name column
 * @method     ChildFinishing findOneByDescription(string $description) Return the first ChildFinishing filtered by the description column
 * @method     ChildFinishing findOneByActive(boolean $active) Return the first ChildFinishing filtered by the active column
 * @method     ChildFinishing findOneByCreatedAt(string $created_at) Return the first ChildFinishing filtered by the created_at column
 * @method     ChildFinishing findOneByUpdatedAt(string $updated_at) Return the first ChildFinishing filtered by the updated_at column *

 * @method     ChildFinishing requirePk($key, ConnectionInterface $con = null) Return the ChildFinishing by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinishing requireOne(ConnectionInterface $con = null) Return the first ChildFinishing matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinishing requireOneById(int $id) Return the first ChildFinishing filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinishing requireOneByName(string $name) Return the first ChildFinishing filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinishing requireOneByDescription(string $description) Return the first ChildFinishing filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinishing requireOneByActive(boolean $active) Return the first ChildFinishing filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinishing requireOneByCreatedAt(string $created_at) Return the first ChildFinishing filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFinishing requireOneByUpdatedAt(string $updated_at) Return the first ChildFinishing filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFinishing[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFinishing objects based on current ModelCriteria
 * @method     ChildFinishing[]|ObjectCollection findById(int $id) Return ChildFinishing objects filtered by the id column
 * @method     ChildFinishing[]|ObjectCollection findByName(string $name) Return ChildFinishing objects filtered by the name column
 * @method     ChildFinishing[]|ObjectCollection findByDescription(string $description) Return ChildFinishing objects filtered by the description column
 * @method     ChildFinishing[]|ObjectCollection findByActive(boolean $active) Return ChildFinishing objects filtered by the active column
 * @method     ChildFinishing[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildFinishing objects filtered by the created_at column
 * @method     ChildFinishing[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildFinishing objects filtered by the updated_at column
 * @method     ChildFinishing[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FinishingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FinishingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Finishing', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFinishingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFinishingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFinishingQuery) {
            return $criteria;
        }
        $query = new ChildFinishingQuery();
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
     * @return ChildFinishing|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FinishingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FinishingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFinishing A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, active, created_at, updated_at FROM finishing WHERE id = :p0';
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
            /** @var ChildFinishing $obj */
            $obj = new ChildFinishing();
            $obj->hydrate($row);
            FinishingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFinishing|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FinishingTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FinishingTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FinishingTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FinishingTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinishingTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinishingTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinishingTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FinishingTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(FinishingTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FinishingTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinishingTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(FinishingTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(FinishingTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FinishingTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ProductFinishing object
     *
     * @param \ProductFinishing|ObjectCollection $productFinishing the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByProductFinishing($productFinishing, $comparison = null)
    {
        if ($productFinishing instanceof \ProductFinishing) {
            return $this
                ->addUsingAlias(FinishingTableMap::COL_ID, $productFinishing->getFinishingId(), $comparison);
        } elseif ($productFinishing instanceof ObjectCollection) {
            return $this
                ->useProductFinishingQuery()
                ->filterByPrimaryKeys($productFinishing->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductFinishing() only accepts arguments of type \ProductFinishing or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductFinishing relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function joinProductFinishing($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductFinishing');

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
            $this->addJoinObject($join, 'ProductFinishing');
        }

        return $this;
    }

    /**
     * Use the ProductFinishing relation ProductFinishing object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductFinishingQuery A secondary query class using the current class as primary query
     */
    public function useProductFinishingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductFinishing($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductFinishing', '\ProductFinishingQuery');
    }

    /**
     * Filter the query by a related Product object
     * using the product_finishing table as cross reference
     *
     * @param Product $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFinishingQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useProductFinishingQuery()
            ->filterByProduct($product, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFinishing $finishing Object to remove from the list of results
     *
     * @return $this|ChildFinishingQuery The current query, for fluid interface
     */
    public function prune($finishing = null)
    {
        if ($finishing) {
            $this->addUsingAlias(FinishingTableMap::COL_ID, $finishing->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the finishing table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FinishingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FinishingTableMap::clearInstancePool();
            FinishingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FinishingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FinishingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FinishingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FinishingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FinishingQuery
