<?php

namespace Base;

use \Bank as ChildBank;
use \BankQuery as ChildBankQuery;
use \Exception;
use \PDO;
use Map\BankTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'bank' table.
 *
 *
 *
 * @method     ChildBankQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBankQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildBankQuery orderByCodeName($order = Criteria::ASC) Order by the ref_code column
 * @method     ChildBankQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildBankQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBankQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildBankQuery groupById() Group by the id column
 * @method     ChildBankQuery groupByName() Group by the name column
 * @method     ChildBankQuery groupByCodeName() Group by the ref_code column
 * @method     ChildBankQuery groupByActive() Group by the active column
 * @method     ChildBankQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBankQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildBankQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBankQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBankQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBankQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBankQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBankQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBankQuery leftJoinPartnerBank($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartnerBank relation
 * @method     ChildBankQuery rightJoinPartnerBank($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartnerBank relation
 * @method     ChildBankQuery innerJoinPartnerBank($relationAlias = null) Adds a INNER JOIN clause to the query using the PartnerBank relation
 *
 * @method     ChildBankQuery joinWithPartnerBank($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PartnerBank relation
 *
 * @method     ChildBankQuery leftJoinWithPartnerBank() Adds a LEFT JOIN clause and with to the query using the PartnerBank relation
 * @method     ChildBankQuery rightJoinWithPartnerBank() Adds a RIGHT JOIN clause and with to the query using the PartnerBank relation
 * @method     ChildBankQuery innerJoinWithPartnerBank() Adds a INNER JOIN clause and with to the query using the PartnerBank relation
 *
 * @method     \PartnerBankQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBank findOne(ConnectionInterface $con = null) Return the first ChildBank matching the query
 * @method     ChildBank findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBank matching the query, or a new ChildBank object populated from the query conditions when no match is found
 *
 * @method     ChildBank findOneById(int $id) Return the first ChildBank filtered by the id column
 * @method     ChildBank findOneByName(string $name) Return the first ChildBank filtered by the name column
 * @method     ChildBank findOneByCodeName(string $ref_code) Return the first ChildBank filtered by the ref_code column
 * @method     ChildBank findOneByActive(boolean $active) Return the first ChildBank filtered by the active column
 * @method     ChildBank findOneByCreatedAt(string $created_at) Return the first ChildBank filtered by the created_at column
 * @method     ChildBank findOneByUpdatedAt(string $updated_at) Return the first ChildBank filtered by the updated_at column *

 * @method     ChildBank requirePk($key, ConnectionInterface $con = null) Return the ChildBank by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBank requireOne(ConnectionInterface $con = null) Return the first ChildBank matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBank requireOneById(int $id) Return the first ChildBank filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBank requireOneByName(string $name) Return the first ChildBank filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBank requireOneByCodeName(string $ref_code) Return the first ChildBank filtered by the ref_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBank requireOneByActive(boolean $active) Return the first ChildBank filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBank requireOneByCreatedAt(string $created_at) Return the first ChildBank filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBank requireOneByUpdatedAt(string $updated_at) Return the first ChildBank filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBank[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBank objects based on current ModelCriteria
 * @method     ChildBank[]|ObjectCollection findById(int $id) Return ChildBank objects filtered by the id column
 * @method     ChildBank[]|ObjectCollection findByName(string $name) Return ChildBank objects filtered by the name column
 * @method     ChildBank[]|ObjectCollection findByCodeName(string $ref_code) Return ChildBank objects filtered by the ref_code column
 * @method     ChildBank[]|ObjectCollection findByActive(boolean $active) Return ChildBank objects filtered by the active column
 * @method     ChildBank[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildBank objects filtered by the created_at column
 * @method     ChildBank[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildBank objects filtered by the updated_at column
 * @method     ChildBank[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BankQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BankQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Bank', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBankQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBankQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBankQuery) {
            return $criteria;
        }
        $query = new ChildBankQuery();
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
     * @return ChildBank|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BankTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BankTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBank A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, ref_code, active, created_at, updated_at FROM bank WHERE id = :p0';
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
            /** @var ChildBank $obj */
            $obj = new ChildBank();
            $obj->hydrate($row);
            BankTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBank|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BankTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BankTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BankTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BankTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BankTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BankTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the ref_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCodeName('fooValue');   // WHERE ref_code = 'fooValue'
     * $query->filterByCodeName('%fooValue%', Criteria::LIKE); // WHERE ref_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codeName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByCodeName($codeName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codeName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BankTableMap::COL_REF_CODE, $codeName, $comparison);
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
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BankTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(BankTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BankTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BankTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(BankTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BankTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BankTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \PartnerBank object
     *
     * @param \PartnerBank|ObjectCollection $partnerBank the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBankQuery The current query, for fluid interface
     */
    public function filterByPartnerBank($partnerBank, $comparison = null)
    {
        if ($partnerBank instanceof \PartnerBank) {
            return $this
                ->addUsingAlias(BankTableMap::COL_ID, $partnerBank->getBankId(), $comparison);
        } elseif ($partnerBank instanceof ObjectCollection) {
            return $this
                ->usePartnerBankQuery()
                ->filterByPrimaryKeys($partnerBank->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartnerBank() only accepts arguments of type \PartnerBank or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartnerBank relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function joinPartnerBank($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartnerBank');

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
            $this->addJoinObject($join, 'PartnerBank');
        }

        return $this;
    }

    /**
     * Use the PartnerBank relation PartnerBank object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerBankQuery A secondary query class using the current class as primary query
     */
    public function usePartnerBankQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartnerBank($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartnerBank', '\PartnerBankQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBank $bank Object to remove from the list of results
     *
     * @return $this|ChildBankQuery The current query, for fluid interface
     */
    public function prune($bank = null)
    {
        if ($bank) {
            $this->addUsingAlias(BankTableMap::COL_ID, $bank->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the bank table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BankTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BankTableMap::clearInstancePool();
            BankTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BankTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BankTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BankTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BankTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BankQuery
