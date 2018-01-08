<?php

namespace Base;

use \UnitOfMeasure as ChildUnitOfMeasure;
use \UnitOfMeasureQuery as ChildUnitOfMeasureQuery;
use \Exception;
use \PDO;
use Map\UnitOfMeasureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'unit_of_measure' table.
 *
 *
 *
 * @method     ChildUnitOfMeasureQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUnitOfMeasureQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUnitOfMeasureQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ChildUnitOfMeasureQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildUnitOfMeasureQuery orderByRatio($order = Criteria::ASC) Order by the ratio column
 * @method     ChildUnitOfMeasureQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildUnitOfMeasureQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUnitOfMeasureQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUnitOfMeasureQuery groupById() Group by the id column
 * @method     ChildUnitOfMeasureQuery groupByName() Group by the name column
 * @method     ChildUnitOfMeasureQuery groupByCategoryId() Group by the category_id column
 * @method     ChildUnitOfMeasureQuery groupByType() Group by the type column
 * @method     ChildUnitOfMeasureQuery groupByRatio() Group by the ratio column
 * @method     ChildUnitOfMeasureQuery groupByActive() Group by the active column
 * @method     ChildUnitOfMeasureQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUnitOfMeasureQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUnitOfMeasureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUnitOfMeasureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUnitOfMeasureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUnitOfMeasureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUnitOfMeasureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUnitOfMeasureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUnitOfMeasureQuery leftJoinUnitOfMeasureCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the UnitOfMeasureCategory relation
 * @method     ChildUnitOfMeasureQuery rightJoinUnitOfMeasureCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UnitOfMeasureCategory relation
 * @method     ChildUnitOfMeasureQuery innerJoinUnitOfMeasureCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the UnitOfMeasureCategory relation
 *
 * @method     ChildUnitOfMeasureQuery joinWithUnitOfMeasureCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UnitOfMeasureCategory relation
 *
 * @method     ChildUnitOfMeasureQuery leftJoinWithUnitOfMeasureCategory() Adds a LEFT JOIN clause and with to the query using the UnitOfMeasureCategory relation
 * @method     ChildUnitOfMeasureQuery rightJoinWithUnitOfMeasureCategory() Adds a RIGHT JOIN clause and with to the query using the UnitOfMeasureCategory relation
 * @method     ChildUnitOfMeasureQuery innerJoinWithUnitOfMeasureCategory() Adds a INNER JOIN clause and with to the query using the UnitOfMeasureCategory relation
 *
 * @method     ChildUnitOfMeasureQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildUnitOfMeasureQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildUnitOfMeasureQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildUnitOfMeasureQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildUnitOfMeasureQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildUnitOfMeasureQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildUnitOfMeasureQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \UnitOfMeasureCategoryQuery|\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUnitOfMeasure findOne(ConnectionInterface $con = null) Return the first ChildUnitOfMeasure matching the query
 * @method     ChildUnitOfMeasure findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUnitOfMeasure matching the query, or a new ChildUnitOfMeasure object populated from the query conditions when no match is found
 *
 * @method     ChildUnitOfMeasure findOneById(int $id) Return the first ChildUnitOfMeasure filtered by the id column
 * @method     ChildUnitOfMeasure findOneByName(string $name) Return the first ChildUnitOfMeasure filtered by the name column
 * @method     ChildUnitOfMeasure findOneByCategoryId(int $category_id) Return the first ChildUnitOfMeasure filtered by the category_id column
 * @method     ChildUnitOfMeasure findOneByType(string $type) Return the first ChildUnitOfMeasure filtered by the type column
 * @method     ChildUnitOfMeasure findOneByRatio(double $ratio) Return the first ChildUnitOfMeasure filtered by the ratio column
 * @method     ChildUnitOfMeasure findOneByActive(boolean $active) Return the first ChildUnitOfMeasure filtered by the active column
 * @method     ChildUnitOfMeasure findOneByCreatedAt(string $created_at) Return the first ChildUnitOfMeasure filtered by the created_at column
 * @method     ChildUnitOfMeasure findOneByUpdatedAt(string $updated_at) Return the first ChildUnitOfMeasure filtered by the updated_at column *

 * @method     ChildUnitOfMeasure requirePk($key, ConnectionInterface $con = null) Return the ChildUnitOfMeasure by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOne(ConnectionInterface $con = null) Return the first ChildUnitOfMeasure matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnitOfMeasure requireOneById(int $id) Return the first ChildUnitOfMeasure filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByName(string $name) Return the first ChildUnitOfMeasure filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByCategoryId(int $category_id) Return the first ChildUnitOfMeasure filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByType(string $type) Return the first ChildUnitOfMeasure filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByRatio(double $ratio) Return the first ChildUnitOfMeasure filtered by the ratio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByActive(boolean $active) Return the first ChildUnitOfMeasure filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByCreatedAt(string $created_at) Return the first ChildUnitOfMeasure filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUnitOfMeasure requireOneByUpdatedAt(string $updated_at) Return the first ChildUnitOfMeasure filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUnitOfMeasure[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUnitOfMeasure objects based on current ModelCriteria
 * @method     ChildUnitOfMeasure[]|ObjectCollection findById(int $id) Return ChildUnitOfMeasure objects filtered by the id column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByName(string $name) Return ChildUnitOfMeasure objects filtered by the name column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByCategoryId(int $category_id) Return ChildUnitOfMeasure objects filtered by the category_id column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByType(string $type) Return ChildUnitOfMeasure objects filtered by the type column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByRatio(double $ratio) Return ChildUnitOfMeasure objects filtered by the ratio column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByActive(boolean $active) Return ChildUnitOfMeasure objects filtered by the active column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUnitOfMeasure objects filtered by the created_at column
 * @method     ChildUnitOfMeasure[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUnitOfMeasure objects filtered by the updated_at column
 * @method     ChildUnitOfMeasure[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UnitOfMeasureQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UnitOfMeasureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UnitOfMeasure', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUnitOfMeasureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUnitOfMeasureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUnitOfMeasureQuery) {
            return $criteria;
        }
        $query = new ChildUnitOfMeasureQuery();
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
     * @return ChildUnitOfMeasure|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UnitOfMeasureTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UnitOfMeasureTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUnitOfMeasure A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, category_id, type, ratio, active, created_at, updated_at FROM unit_of_measure WHERE id = :p0';
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
            /** @var ChildUnitOfMeasure $obj */
            $obj = new ChildUnitOfMeasure();
            $obj->hydrate($row);
            UnitOfMeasureTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUnitOfMeasure|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByUnitOfMeasureCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_CATEGORY_ID, $categoryId, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the ratio column
     *
     * Example usage:
     * <code>
     * $query->filterByRatio(1234); // WHERE ratio = 1234
     * $query->filterByRatio(array(12, 34)); // WHERE ratio IN (12, 34)
     * $query->filterByRatio(array('min' => 12)); // WHERE ratio > 12
     * </code>
     *
     * @param     mixed $ratio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByRatio($ratio = null, $comparison = null)
    {
        if (is_array($ratio)) {
            $useMinMax = false;
            if (isset($ratio['min'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_RATIO, $ratio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratio['max'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_RATIO, $ratio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_RATIO, $ratio, $comparison);
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UnitOfMeasureTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UnitOfMeasureTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \UnitOfMeasureCategory object
     *
     * @param \UnitOfMeasureCategory|ObjectCollection $unitOfMeasureCategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByUnitOfMeasureCategory($unitOfMeasureCategory, $comparison = null)
    {
        if ($unitOfMeasureCategory instanceof \UnitOfMeasureCategory) {
            return $this
                ->addUsingAlias(UnitOfMeasureTableMap::COL_CATEGORY_ID, $unitOfMeasureCategory->getId(), $comparison);
        } elseif ($unitOfMeasureCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UnitOfMeasureTableMap::COL_CATEGORY_ID, $unitOfMeasureCategory->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUnitOfMeasureCategory() only accepts arguments of type \UnitOfMeasureCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UnitOfMeasureCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function joinUnitOfMeasureCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UnitOfMeasureCategory');

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
            $this->addJoinObject($join, 'UnitOfMeasureCategory');
        }

        return $this;
    }

    /**
     * Use the UnitOfMeasureCategory relation UnitOfMeasureCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UnitOfMeasureCategoryQuery A secondary query class using the current class as primary query
     */
    public function useUnitOfMeasureCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUnitOfMeasureCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UnitOfMeasureCategory', '\UnitOfMeasureCategoryQuery');
    }

    /**
     * Filter the query by a related \Product object
     *
     * @param \Product|ObjectCollection $product the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Product) {
            return $this
                ->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $product->getUomId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            return $this
                ->useProductQuery()
                ->filterByPrimaryKeys($product->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\ProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUnitOfMeasure $unitOfMeasure Object to remove from the list of results
     *
     * @return $this|ChildUnitOfMeasureQuery The current query, for fluid interface
     */
    public function prune($unitOfMeasure = null)
    {
        if ($unitOfMeasure) {
            $this->addUsingAlias(UnitOfMeasureTableMap::COL_ID, $unitOfMeasure->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the unit_of_measure table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UnitOfMeasureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UnitOfMeasureTableMap::clearInstancePool();
            UnitOfMeasureTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UnitOfMeasureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UnitOfMeasureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UnitOfMeasureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UnitOfMeasureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UnitOfMeasureQuery
