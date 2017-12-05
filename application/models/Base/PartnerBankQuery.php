<?php

namespace Base;

use \PartnerBank as ChildPartnerBank;
use \PartnerBankQuery as ChildPartnerBankQuery;
use \Exception;
use \PDO;
use Map\PartnerBankTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'partner_bank' table.
 *
 *
 *
 * @method     ChildPartnerBankQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPartnerBankQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPartnerBankQuery orderByAccountNo($order = Criteria::ASC) Order by the acount_no column
 * @method     ChildPartnerBankQuery orderByPartnerId($order = Criteria::ASC) Order by the partner_id column
 * @method     ChildPartnerBankQuery orderByBankId($order = Criteria::ASC) Order by the bank_id column
 * @method     ChildPartnerBankQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPartnerBankQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPartnerBankQuery groupById() Group by the id column
 * @method     ChildPartnerBankQuery groupByName() Group by the name column
 * @method     ChildPartnerBankQuery groupByAccountNo() Group by the acount_no column
 * @method     ChildPartnerBankQuery groupByPartnerId() Group by the partner_id column
 * @method     ChildPartnerBankQuery groupByBankId() Group by the bank_id column
 * @method     ChildPartnerBankQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPartnerBankQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPartnerBankQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartnerBankQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartnerBankQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartnerBankQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPartnerBankQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPartnerBankQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPartnerBankQuery leftJoinPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partner relation
 * @method     ChildPartnerBankQuery rightJoinPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partner relation
 * @method     ChildPartnerBankQuery innerJoinPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the Partner relation
 *
 * @method     ChildPartnerBankQuery joinWithPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Partner relation
 *
 * @method     ChildPartnerBankQuery leftJoinWithPartner() Adds a LEFT JOIN clause and with to the query using the Partner relation
 * @method     ChildPartnerBankQuery rightJoinWithPartner() Adds a RIGHT JOIN clause and with to the query using the Partner relation
 * @method     ChildPartnerBankQuery innerJoinWithPartner() Adds a INNER JOIN clause and with to the query using the Partner relation
 *
 * @method     ChildPartnerBankQuery leftJoinBank($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bank relation
 * @method     ChildPartnerBankQuery rightJoinBank($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bank relation
 * @method     ChildPartnerBankQuery innerJoinBank($relationAlias = null) Adds a INNER JOIN clause to the query using the Bank relation
 *
 * @method     ChildPartnerBankQuery joinWithBank($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bank relation
 *
 * @method     ChildPartnerBankQuery leftJoinWithBank() Adds a LEFT JOIN clause and with to the query using the Bank relation
 * @method     ChildPartnerBankQuery rightJoinWithBank() Adds a RIGHT JOIN clause and with to the query using the Bank relation
 * @method     ChildPartnerBankQuery innerJoinWithBank() Adds a INNER JOIN clause and with to the query using the Bank relation
 *
 * @method     \PartnerQuery|\BankQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPartnerBank findOne(ConnectionInterface $con = null) Return the first ChildPartnerBank matching the query
 * @method     ChildPartnerBank findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPartnerBank matching the query, or a new ChildPartnerBank object populated from the query conditions when no match is found
 *
 * @method     ChildPartnerBank findOneById(int $id) Return the first ChildPartnerBank filtered by the id column
 * @method     ChildPartnerBank findOneByName(string $name) Return the first ChildPartnerBank filtered by the name column
 * @method     ChildPartnerBank findOneByAccountNo(string $acount_no) Return the first ChildPartnerBank filtered by the acount_no column
 * @method     ChildPartnerBank findOneByPartnerId(int $partner_id) Return the first ChildPartnerBank filtered by the partner_id column
 * @method     ChildPartnerBank findOneByBankId(int $bank_id) Return the first ChildPartnerBank filtered by the bank_id column
 * @method     ChildPartnerBank findOneByCreatedAt(string $created_at) Return the first ChildPartnerBank filtered by the created_at column
 * @method     ChildPartnerBank findOneByUpdatedAt(string $updated_at) Return the first ChildPartnerBank filtered by the updated_at column *

 * @method     ChildPartnerBank requirePk($key, ConnectionInterface $con = null) Return the ChildPartnerBank by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOne(ConnectionInterface $con = null) Return the first ChildPartnerBank matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartnerBank requireOneById(int $id) Return the first ChildPartnerBank filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOneByName(string $name) Return the first ChildPartnerBank filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOneByAccountNo(string $acount_no) Return the first ChildPartnerBank filtered by the acount_no column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOneByPartnerId(int $partner_id) Return the first ChildPartnerBank filtered by the partner_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOneByBankId(int $bank_id) Return the first ChildPartnerBank filtered by the bank_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOneByCreatedAt(string $created_at) Return the first ChildPartnerBank filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerBank requireOneByUpdatedAt(string $updated_at) Return the first ChildPartnerBank filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartnerBank[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPartnerBank objects based on current ModelCriteria
 * @method     ChildPartnerBank[]|ObjectCollection findById(int $id) Return ChildPartnerBank objects filtered by the id column
 * @method     ChildPartnerBank[]|ObjectCollection findByName(string $name) Return ChildPartnerBank objects filtered by the name column
 * @method     ChildPartnerBank[]|ObjectCollection findByAccountNo(string $acount_no) Return ChildPartnerBank objects filtered by the acount_no column
 * @method     ChildPartnerBank[]|ObjectCollection findByPartnerId(int $partner_id) Return ChildPartnerBank objects filtered by the partner_id column
 * @method     ChildPartnerBank[]|ObjectCollection findByBankId(int $bank_id) Return ChildPartnerBank objects filtered by the bank_id column
 * @method     ChildPartnerBank[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPartnerBank objects filtered by the created_at column
 * @method     ChildPartnerBank[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPartnerBank objects filtered by the updated_at column
 * @method     ChildPartnerBank[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PartnerBankQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PartnerBankQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PartnerBank', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPartnerBankQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPartnerBankQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPartnerBankQuery) {
            return $criteria;
        }
        $query = new ChildPartnerBankQuery();
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
     * @return ChildPartnerBank|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartnerBankTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PartnerBankTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPartnerBank A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, acount_no, partner_id, bank_id, created_at, updated_at FROM partner_bank WHERE id = :p0';
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
            /** @var ChildPartnerBank $obj */
            $obj = new ChildPartnerBank();
            $obj->hydrate($row);
            PartnerBankTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPartnerBank|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PartnerBankTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PartnerBankTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the acount_no column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountNo('fooValue');   // WHERE acount_no = 'fooValue'
     * $query->filterByAccountNo('%fooValue%', Criteria::LIKE); // WHERE acount_no LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accountNo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByAccountNo($accountNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accountNo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_ACOUNT_NO, $accountNo, $comparison);
    }

    /**
     * Filter the query on the partner_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPartnerId(1234); // WHERE partner_id = 1234
     * $query->filterByPartnerId(array(12, 34)); // WHERE partner_id IN (12, 34)
     * $query->filterByPartnerId(array('min' => 12)); // WHERE partner_id > 12
     * </code>
     *
     * @see       filterByPartner()
     *
     * @param     mixed $partnerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByPartnerId($partnerId = null, $comparison = null)
    {
        if (is_array($partnerId)) {
            $useMinMax = false;
            if (isset($partnerId['min'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_PARTNER_ID, $partnerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($partnerId['max'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_PARTNER_ID, $partnerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_PARTNER_ID, $partnerId, $comparison);
    }

    /**
     * Filter the query on the bank_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBankId(1234); // WHERE bank_id = 1234
     * $query->filterByBankId(array(12, 34)); // WHERE bank_id IN (12, 34)
     * $query->filterByBankId(array('min' => 12)); // WHERE bank_id > 12
     * </code>
     *
     * @see       filterByBank()
     *
     * @param     mixed $bankId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByBankId($bankId = null, $comparison = null)
    {
        if (is_array($bankId)) {
            $useMinMax = false;
            if (isset($bankId['min'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_BANK_ID, $bankId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bankId['max'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_BANK_ID, $bankId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_BANK_ID, $bankId, $comparison);
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
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PartnerBankTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerBankTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByPartner($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(PartnerBankTableMap::COL_PARTNER_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnerBankTableMap::COL_PARTNER_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
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
     * Filter the query by a related \Bank object
     *
     * @param \Bank|ObjectCollection $bank The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnerBankQuery The current query, for fluid interface
     */
    public function filterByBank($bank, $comparison = null)
    {
        if ($bank instanceof \Bank) {
            return $this
                ->addUsingAlias(PartnerBankTableMap::COL_BANK_ID, $bank->getId(), $comparison);
        } elseif ($bank instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnerBankTableMap::COL_BANK_ID, $bank->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBank() only accepts arguments of type \Bank or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bank relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function joinBank($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bank');

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
            $this->addJoinObject($join, 'Bank');
        }

        return $this;
    }

    /**
     * Use the Bank relation Bank object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BankQuery A secondary query class using the current class as primary query
     */
    public function useBankQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBank($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bank', '\BankQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPartnerBank $partnerBank Object to remove from the list of results
     *
     * @return $this|ChildPartnerBankQuery The current query, for fluid interface
     */
    public function prune($partnerBank = null)
    {
        if ($partnerBank) {
            $this->addUsingAlias(PartnerBankTableMap::COL_ID, $partnerBank->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the partner_bank table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerBankTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PartnerBankTableMap::clearInstancePool();
            PartnerBankTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerBankTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PartnerBankTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PartnerBankTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PartnerBankTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PartnerBankQuery
