<?php

namespace Base;

use \Ugroup as ChildUgroup;
use \UgroupQuery as ChildUgroupQuery;
use \Exception;
use \PDO;
use Map\UgroupTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ugroup' table.
 *
 *
 *
 * @method     ChildUgroupQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUgroupQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUgroupQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildUgroupQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUgroupQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUgroupQuery groupById() Group by the id column
 * @method     ChildUgroupQuery groupByName() Group by the name column
 * @method     ChildUgroupQuery groupByDescription() Group by the description column
 * @method     ChildUgroupQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUgroupQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUgroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUgroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUgroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUgroupQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUgroupQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUgroupQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUgroupQuery leftJoinUserGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserGroup relation
 * @method     ChildUgroupQuery rightJoinUserGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserGroup relation
 * @method     ChildUgroupQuery innerJoinUserGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the UserGroup relation
 *
 * @method     ChildUgroupQuery joinWithUserGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserGroup relation
 *
 * @method     ChildUgroupQuery leftJoinWithUserGroup() Adds a LEFT JOIN clause and with to the query using the UserGroup relation
 * @method     ChildUgroupQuery rightJoinWithUserGroup() Adds a RIGHT JOIN clause and with to the query using the UserGroup relation
 * @method     ChildUgroupQuery innerJoinWithUserGroup() Adds a INNER JOIN clause and with to the query using the UserGroup relation
 *
 * @method     ChildUgroupQuery leftJoinMenuGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the MenuGroup relation
 * @method     ChildUgroupQuery rightJoinMenuGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MenuGroup relation
 * @method     ChildUgroupQuery innerJoinMenuGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the MenuGroup relation
 *
 * @method     ChildUgroupQuery joinWithMenuGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MenuGroup relation
 *
 * @method     ChildUgroupQuery leftJoinWithMenuGroup() Adds a LEFT JOIN clause and with to the query using the MenuGroup relation
 * @method     ChildUgroupQuery rightJoinWithMenuGroup() Adds a RIGHT JOIN clause and with to the query using the MenuGroup relation
 * @method     ChildUgroupQuery innerJoinWithMenuGroup() Adds a INNER JOIN clause and with to the query using the MenuGroup relation
 *
 * @method     \UserGroupQuery|\MenuGroupQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUgroup findOne(ConnectionInterface $con = null) Return the first ChildUgroup matching the query
 * @method     ChildUgroup findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUgroup matching the query, or a new ChildUgroup object populated from the query conditions when no match is found
 *
 * @method     ChildUgroup findOneById(int $id) Return the first ChildUgroup filtered by the id column
 * @method     ChildUgroup findOneByName(string $name) Return the first ChildUgroup filtered by the name column
 * @method     ChildUgroup findOneByDescription(string $description) Return the first ChildUgroup filtered by the description column
 * @method     ChildUgroup findOneByCreatedAt(string $created_at) Return the first ChildUgroup filtered by the created_at column
 * @method     ChildUgroup findOneByUpdatedAt(string $updated_at) Return the first ChildUgroup filtered by the updated_at column *

 * @method     ChildUgroup requirePk($key, ConnectionInterface $con = null) Return the ChildUgroup by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUgroup requireOne(ConnectionInterface $con = null) Return the first ChildUgroup matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUgroup requireOneById(int $id) Return the first ChildUgroup filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUgroup requireOneByName(string $name) Return the first ChildUgroup filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUgroup requireOneByDescription(string $description) Return the first ChildUgroup filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUgroup requireOneByCreatedAt(string $created_at) Return the first ChildUgroup filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUgroup requireOneByUpdatedAt(string $updated_at) Return the first ChildUgroup filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUgroup[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUgroup objects based on current ModelCriteria
 * @method     ChildUgroup[]|ObjectCollection findById(int $id) Return ChildUgroup objects filtered by the id column
 * @method     ChildUgroup[]|ObjectCollection findByName(string $name) Return ChildUgroup objects filtered by the name column
 * @method     ChildUgroup[]|ObjectCollection findByDescription(string $description) Return ChildUgroup objects filtered by the description column
 * @method     ChildUgroup[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUgroup objects filtered by the created_at column
 * @method     ChildUgroup[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUgroup objects filtered by the updated_at column
 * @method     ChildUgroup[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UgroupQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UgroupQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Ugroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUgroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUgroupQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUgroupQuery) {
            return $criteria;
        }
        $query = new ChildUgroupQuery();
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
     * @return ChildUgroup|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UgroupTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UgroupTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUgroup A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, created_at, updated_at FROM ugroup WHERE id = :p0';
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
            /** @var ChildUgroup $obj */
            $obj = new ChildUgroup();
            $obj->hydrate($row);
            UgroupTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUgroup|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UgroupTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UgroupTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UgroupTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UgroupTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UgroupTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UgroupTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UgroupTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UgroupTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UgroupTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UgroupTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UgroupTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UgroupTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UgroupTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \UserGroup object
     *
     * @param \UserGroup|ObjectCollection $userGroup the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByUserGroup($userGroup, $comparison = null)
    {
        if ($userGroup instanceof \UserGroup) {
            return $this
                ->addUsingAlias(UgroupTableMap::COL_ID, $userGroup->getGroupId(), $comparison);
        } elseif ($userGroup instanceof ObjectCollection) {
            return $this
                ->useUserGroupQuery()
                ->filterByPrimaryKeys($userGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserGroup() only accepts arguments of type \UserGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function joinUserGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserGroup');

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
            $this->addJoinObject($join, 'UserGroup');
        }

        return $this;
    }

    /**
     * Use the UserGroup relation UserGroup object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserGroupQuery A secondary query class using the current class as primary query
     */
    public function useUserGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserGroup', '\UserGroupQuery');
    }

    /**
     * Filter the query by a related \MenuGroup object
     *
     * @param \MenuGroup|ObjectCollection $menuGroup the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByMenuGroup($menuGroup, $comparison = null)
    {
        if ($menuGroup instanceof \MenuGroup) {
            return $this
                ->addUsingAlias(UgroupTableMap::COL_ID, $menuGroup->getGroupId(), $comparison);
        } elseif ($menuGroup instanceof ObjectCollection) {
            return $this
                ->useMenuGroupQuery()
                ->filterByPrimaryKeys($menuGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMenuGroup() only accepts arguments of type \MenuGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MenuGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function joinMenuGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MenuGroup');

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
            $this->addJoinObject($join, 'MenuGroup');
        }

        return $this;
    }

    /**
     * Use the MenuGroup relation MenuGroup object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MenuGroupQuery A secondary query class using the current class as primary query
     */
    public function useMenuGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMenuGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MenuGroup', '\MenuGroupQuery');
    }

    /**
     * Filter the query by a related User object
     * using the user_group table as cross reference
     *
     * @param User $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useUserGroupQuery()
            ->filterByUser($user, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Menu object
     * using the menu_group table as cross reference
     *
     * @param Menu $menu the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUgroupQuery The current query, for fluid interface
     */
    public function filterByMenu($menu, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useMenuGroupQuery()
            ->filterByMenu($menu, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUgroup $ugroup Object to remove from the list of results
     *
     * @return $this|ChildUgroupQuery The current query, for fluid interface
     */
    public function prune($ugroup = null)
    {
        if ($ugroup) {
            $this->addUsingAlias(UgroupTableMap::COL_ID, $ugroup->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ugroup table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UgroupTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UgroupTableMap::clearInstancePool();
            UgroupTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UgroupTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UgroupTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UgroupTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UgroupTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UgroupQuery
