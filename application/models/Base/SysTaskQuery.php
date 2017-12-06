<?php

namespace Base;

use \SysTask as ChildSysTask;
use \SysTaskQuery as ChildSysTaskQuery;
use \Exception;
use \PDO;
use Map\SysTaskTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'sys_task' table.
 *
 *
 *
 * @method     ChildSysTaskQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSysTaskQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSysTaskQuery orderByPriority($order = Criteria::ASC) Order by the priority column
 * @method     ChildSysTaskQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildSysTaskQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSysTaskQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildSysTaskQuery orderByTimeExecution($order = Criteria::ASC) Order by the time_execution column
 * @method     ChildSysTaskQuery orderByScheduledExecution($order = Criteria::ASC) Order by the scheduled_execution column
 * @method     ChildSysTaskQuery orderByDayRepeat($order = Criteria::ASC) Order by the day_repeat column
 * @method     ChildSysTaskQuery orderByIsExecuted($order = Criteria::ASC) Order by the is_executed column
 * @method     ChildSysTaskQuery orderByLastExecution($order = Criteria::ASC) Order by the last_execution column
 * @method     ChildSysTaskQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSysTaskQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSysTaskQuery groupById() Group by the id column
 * @method     ChildSysTaskQuery groupByName() Group by the name column
 * @method     ChildSysTaskQuery groupByPriority() Group by the priority column
 * @method     ChildSysTaskQuery groupByContent() Group by the content column
 * @method     ChildSysTaskQuery groupByDescription() Group by the description column
 * @method     ChildSysTaskQuery groupByType() Group by the type column
 * @method     ChildSysTaskQuery groupByTimeExecution() Group by the time_execution column
 * @method     ChildSysTaskQuery groupByScheduledExecution() Group by the scheduled_execution column
 * @method     ChildSysTaskQuery groupByDayRepeat() Group by the day_repeat column
 * @method     ChildSysTaskQuery groupByIsExecuted() Group by the is_executed column
 * @method     ChildSysTaskQuery groupByLastExecution() Group by the last_execution column
 * @method     ChildSysTaskQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSysTaskQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSysTaskQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSysTaskQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSysTaskQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSysTaskQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSysTaskQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSysTaskQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSysTask findOne(ConnectionInterface $con = null) Return the first ChildSysTask matching the query
 * @method     ChildSysTask findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSysTask matching the query, or a new ChildSysTask object populated from the query conditions when no match is found
 *
 * @method     ChildSysTask findOneById(int $id) Return the first ChildSysTask filtered by the id column
 * @method     ChildSysTask findOneByName(string $name) Return the first ChildSysTask filtered by the name column
 * @method     ChildSysTask findOneByPriority(int $priority) Return the first ChildSysTask filtered by the priority column
 * @method     ChildSysTask findOneByContent(string $content) Return the first ChildSysTask filtered by the content column
 * @method     ChildSysTask findOneByDescription(string $description) Return the first ChildSysTask filtered by the description column
 * @method     ChildSysTask findOneByType(string $type) Return the first ChildSysTask filtered by the type column
 * @method     ChildSysTask findOneByTimeExecution(string $time_execution) Return the first ChildSysTask filtered by the time_execution column
 * @method     ChildSysTask findOneByScheduledExecution(string $scheduled_execution) Return the first ChildSysTask filtered by the scheduled_execution column
 * @method     ChildSysTask findOneByDayRepeat(string $day_repeat) Return the first ChildSysTask filtered by the day_repeat column
 * @method     ChildSysTask findOneByIsExecuted(boolean $is_executed) Return the first ChildSysTask filtered by the is_executed column
 * @method     ChildSysTask findOneByLastExecution(string $last_execution) Return the first ChildSysTask filtered by the last_execution column
 * @method     ChildSysTask findOneByCreatedAt(string $created_at) Return the first ChildSysTask filtered by the created_at column
 * @method     ChildSysTask findOneByUpdatedAt(string $updated_at) Return the first ChildSysTask filtered by the updated_at column *

 * @method     ChildSysTask requirePk($key, ConnectionInterface $con = null) Return the ChildSysTask by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOne(ConnectionInterface $con = null) Return the first ChildSysTask matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysTask requireOneById(int $id) Return the first ChildSysTask filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByName(string $name) Return the first ChildSysTask filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByPriority(int $priority) Return the first ChildSysTask filtered by the priority column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByContent(string $content) Return the first ChildSysTask filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByDescription(string $description) Return the first ChildSysTask filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByType(string $type) Return the first ChildSysTask filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByTimeExecution(string $time_execution) Return the first ChildSysTask filtered by the time_execution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByScheduledExecution(string $scheduled_execution) Return the first ChildSysTask filtered by the scheduled_execution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByDayRepeat(string $day_repeat) Return the first ChildSysTask filtered by the day_repeat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByIsExecuted(boolean $is_executed) Return the first ChildSysTask filtered by the is_executed column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByLastExecution(string $last_execution) Return the first ChildSysTask filtered by the last_execution column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByCreatedAt(string $created_at) Return the first ChildSysTask filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSysTask requireOneByUpdatedAt(string $updated_at) Return the first ChildSysTask filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSysTask[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSysTask objects based on current ModelCriteria
 * @method     ChildSysTask[]|ObjectCollection findById(int $id) Return ChildSysTask objects filtered by the id column
 * @method     ChildSysTask[]|ObjectCollection findByName(string $name) Return ChildSysTask objects filtered by the name column
 * @method     ChildSysTask[]|ObjectCollection findByPriority(int $priority) Return ChildSysTask objects filtered by the priority column
 * @method     ChildSysTask[]|ObjectCollection findByContent(string $content) Return ChildSysTask objects filtered by the content column
 * @method     ChildSysTask[]|ObjectCollection findByDescription(string $description) Return ChildSysTask objects filtered by the description column
 * @method     ChildSysTask[]|ObjectCollection findByType(string $type) Return ChildSysTask objects filtered by the type column
 * @method     ChildSysTask[]|ObjectCollection findByTimeExecution(string $time_execution) Return ChildSysTask objects filtered by the time_execution column
 * @method     ChildSysTask[]|ObjectCollection findByScheduledExecution(string $scheduled_execution) Return ChildSysTask objects filtered by the scheduled_execution column
 * @method     ChildSysTask[]|ObjectCollection findByDayRepeat(string $day_repeat) Return ChildSysTask objects filtered by the day_repeat column
 * @method     ChildSysTask[]|ObjectCollection findByIsExecuted(boolean $is_executed) Return ChildSysTask objects filtered by the is_executed column
 * @method     ChildSysTask[]|ObjectCollection findByLastExecution(string $last_execution) Return ChildSysTask objects filtered by the last_execution column
 * @method     ChildSysTask[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildSysTask objects filtered by the created_at column
 * @method     ChildSysTask[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildSysTask objects filtered by the updated_at column
 * @method     ChildSysTask[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SysTaskQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SysTaskQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\SysTask', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSysTaskQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSysTaskQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSysTaskQuery) {
            return $criteria;
        }
        $query = new ChildSysTaskQuery();
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
     * @return ChildSysTask|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SysTaskTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SysTaskTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSysTask A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, priority, content, description, type, time_execution, scheduled_execution, day_repeat, is_executed, last_execution, created_at, updated_at FROM sys_task WHERE id = :p0';
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
            /** @var ChildSysTask $obj */
            $obj = new ChildSysTask();
            $obj->hydrate($row);
            SysTaskTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSysTask|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SysTaskTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SysTaskTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the priority column
     *
     * Example usage:
     * <code>
     * $query->filterByPriority(1234); // WHERE priority = 1234
     * $query->filterByPriority(array(12, 34)); // WHERE priority IN (12, 34)
     * $query->filterByPriority(array('min' => 12)); // WHERE priority > 12
     * </code>
     *
     * @param     mixed $priority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByPriority($priority = null, $comparison = null)
    {
        if (is_array($priority)) {
            $useMinMax = false;
            if (isset($priority['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_PRIORITY, $priority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priority['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_PRIORITY, $priority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_PRIORITY, $priority, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%', Criteria::LIKE); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_CONTENT, $content, $comparison);
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the time_execution column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeExecution('2011-03-14'); // WHERE time_execution = '2011-03-14'
     * $query->filterByTimeExecution('now'); // WHERE time_execution = '2011-03-14'
     * $query->filterByTimeExecution(array('max' => 'yesterday')); // WHERE time_execution > '2011-03-13'
     * </code>
     *
     * @param     mixed $timeExecution The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByTimeExecution($timeExecution = null, $comparison = null)
    {
        if (is_array($timeExecution)) {
            $useMinMax = false;
            if (isset($timeExecution['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_TIME_EXECUTION, $timeExecution['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeExecution['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_TIME_EXECUTION, $timeExecution['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_TIME_EXECUTION, $timeExecution, $comparison);
    }

    /**
     * Filter the query on the scheduled_execution column
     *
     * Example usage:
     * <code>
     * $query->filterByScheduledExecution('2011-03-14'); // WHERE scheduled_execution = '2011-03-14'
     * $query->filterByScheduledExecution('now'); // WHERE scheduled_execution = '2011-03-14'
     * $query->filterByScheduledExecution(array('max' => 'yesterday')); // WHERE scheduled_execution > '2011-03-13'
     * </code>
     *
     * @param     mixed $scheduledExecution The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByScheduledExecution($scheduledExecution = null, $comparison = null)
    {
        if (is_array($scheduledExecution)) {
            $useMinMax = false;
            if (isset($scheduledExecution['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_SCHEDULED_EXECUTION, $scheduledExecution['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scheduledExecution['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_SCHEDULED_EXECUTION, $scheduledExecution['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_SCHEDULED_EXECUTION, $scheduledExecution, $comparison);
    }

    /**
     * Filter the query on the day_repeat column
     *
     * Example usage:
     * <code>
     * $query->filterByDayRepeat('fooValue');   // WHERE day_repeat = 'fooValue'
     * $query->filterByDayRepeat('%fooValue%', Criteria::LIKE); // WHERE day_repeat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dayRepeat The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByDayRepeat($dayRepeat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dayRepeat)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_DAY_REPEAT, $dayRepeat, $comparison);
    }

    /**
     * Filter the query on the is_executed column
     *
     * Example usage:
     * <code>
     * $query->filterByIsExecuted(true); // WHERE is_executed = true
     * $query->filterByIsExecuted('yes'); // WHERE is_executed = true
     * </code>
     *
     * @param     boolean|string $isExecuted The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByIsExecuted($isExecuted = null, $comparison = null)
    {
        if (is_string($isExecuted)) {
            $isExecuted = in_array(strtolower($isExecuted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_IS_EXECUTED, $isExecuted, $comparison);
    }

    /**
     * Filter the query on the last_execution column
     *
     * Example usage:
     * <code>
     * $query->filterByLastExecution('2011-03-14'); // WHERE last_execution = '2011-03-14'
     * $query->filterByLastExecution('now'); // WHERE last_execution = '2011-03-14'
     * $query->filterByLastExecution(array('max' => 'yesterday')); // WHERE last_execution > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastExecution The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByLastExecution($lastExecution = null, $comparison = null)
    {
        if (is_array($lastExecution)) {
            $useMinMax = false;
            if (isset($lastExecution['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_LAST_EXECUTION, $lastExecution['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastExecution['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_LAST_EXECUTION, $lastExecution['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_LAST_EXECUTION, $lastExecution, $comparison);
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SysTaskTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SysTaskTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSysTask $sysTask Object to remove from the list of results
     *
     * @return $this|ChildSysTaskQuery The current query, for fluid interface
     */
    public function prune($sysTask = null)
    {
        if ($sysTask) {
            $this->addUsingAlias(SysTaskTableMap::COL_ID, $sysTask->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sys_task table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SysTaskTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SysTaskTableMap::clearInstancePool();
            SysTaskTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SysTaskTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SysTaskTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SysTaskTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SysTaskTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SysTaskQuery
