<?php

namespace Base;

use \ComponentPartner as ChildComponentPartner;
use \ComponentPartnerQuery as ChildComponentPartnerQuery;
use \Exception;
use \PDO;
use Map\ComponentPartnerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'component_partner' table.
 *
 *
 *
 * @method     ChildComponentPartnerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildComponentPartnerQuery orderByPartnerId($order = Criteria::ASC) Order by the partner_id column
 * @method     ChildComponentPartnerQuery orderByComponentId($order = Criteria::ASC) Order by the component_id column
 * @method     ChildComponentPartnerQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildComponentPartnerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildComponentPartnerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildComponentPartnerQuery groupById() Group by the id column
 * @method     ChildComponentPartnerQuery groupByPartnerId() Group by the partner_id column
 * @method     ChildComponentPartnerQuery groupByComponentId() Group by the component_id column
 * @method     ChildComponentPartnerQuery groupByPrice() Group by the price column
 * @method     ChildComponentPartnerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildComponentPartnerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildComponentPartnerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildComponentPartnerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildComponentPartnerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildComponentPartnerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildComponentPartnerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildComponentPartnerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildComponentPartnerQuery leftJoinComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Component relation
 * @method     ChildComponentPartnerQuery rightJoinComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Component relation
 * @method     ChildComponentPartnerQuery innerJoinComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the Component relation
 *
 * @method     ChildComponentPartnerQuery joinWithComponent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Component relation
 *
 * @method     ChildComponentPartnerQuery leftJoinWithComponent() Adds a LEFT JOIN clause and with to the query using the Component relation
 * @method     ChildComponentPartnerQuery rightJoinWithComponent() Adds a RIGHT JOIN clause and with to the query using the Component relation
 * @method     ChildComponentPartnerQuery innerJoinWithComponent() Adds a INNER JOIN clause and with to the query using the Component relation
 *
 * @method     ChildComponentPartnerQuery leftJoinPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partner relation
 * @method     ChildComponentPartnerQuery rightJoinPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partner relation
 * @method     ChildComponentPartnerQuery innerJoinPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the Partner relation
 *
 * @method     ChildComponentPartnerQuery joinWithPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Partner relation
 *
 * @method     ChildComponentPartnerQuery leftJoinWithPartner() Adds a LEFT JOIN clause and with to the query using the Partner relation
 * @method     ChildComponentPartnerQuery rightJoinWithPartner() Adds a RIGHT JOIN clause and with to the query using the Partner relation
 * @method     ChildComponentPartnerQuery innerJoinWithPartner() Adds a INNER JOIN clause and with to the query using the Partner relation
 *
 * @method     \ComponentQuery|\PartnerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildComponentPartner findOne(ConnectionInterface $con = null) Return the first ChildComponentPartner matching the query
 * @method     ChildComponentPartner findOneOrCreate(ConnectionInterface $con = null) Return the first ChildComponentPartner matching the query, or a new ChildComponentPartner object populated from the query conditions when no match is found
 *
 * @method     ChildComponentPartner findOneById(int $id) Return the first ChildComponentPartner filtered by the id column
 * @method     ChildComponentPartner findOneByPartnerId(int $partner_id) Return the first ChildComponentPartner filtered by the partner_id column
 * @method     ChildComponentPartner findOneByComponentId(int $component_id) Return the first ChildComponentPartner filtered by the component_id column
 * @method     ChildComponentPartner findOneByPrice(double $price) Return the first ChildComponentPartner filtered by the price column
 * @method     ChildComponentPartner findOneByCreatedAt(string $created_at) Return the first ChildComponentPartner filtered by the created_at column
 * @method     ChildComponentPartner findOneByUpdatedAt(string $updated_at) Return the first ChildComponentPartner filtered by the updated_at column *

 * @method     ChildComponentPartner requirePk($key, ConnectionInterface $con = null) Return the ChildComponentPartner by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentPartner requireOne(ConnectionInterface $con = null) Return the first ChildComponentPartner matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComponentPartner requireOneById(int $id) Return the first ChildComponentPartner filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentPartner requireOneByPartnerId(int $partner_id) Return the first ChildComponentPartner filtered by the partner_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentPartner requireOneByComponentId(int $component_id) Return the first ChildComponentPartner filtered by the component_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentPartner requireOneByPrice(double $price) Return the first ChildComponentPartner filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentPartner requireOneByCreatedAt(string $created_at) Return the first ChildComponentPartner filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponentPartner requireOneByUpdatedAt(string $updated_at) Return the first ChildComponentPartner filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComponentPartner[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildComponentPartner objects based on current ModelCriteria
 * @method     ChildComponentPartner[]|ObjectCollection findById(int $id) Return ChildComponentPartner objects filtered by the id column
 * @method     ChildComponentPartner[]|ObjectCollection findByPartnerId(int $partner_id) Return ChildComponentPartner objects filtered by the partner_id column
 * @method     ChildComponentPartner[]|ObjectCollection findByComponentId(int $component_id) Return ChildComponentPartner objects filtered by the component_id column
 * @method     ChildComponentPartner[]|ObjectCollection findByPrice(double $price) Return ChildComponentPartner objects filtered by the price column
 * @method     ChildComponentPartner[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildComponentPartner objects filtered by the created_at column
 * @method     ChildComponentPartner[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildComponentPartner objects filtered by the updated_at column
 * @method     ChildComponentPartner[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ComponentPartnerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ComponentPartnerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ComponentPartner', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildComponentPartnerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildComponentPartnerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildComponentPartnerQuery) {
            return $criteria;
        }
        $query = new ChildComponentPartnerQuery();
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
     * @return ChildComponentPartner|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ComponentPartnerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ComponentPartnerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildComponentPartner A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, partner_id, component_id, price, created_at, updated_at FROM component_partner WHERE id = :p0';
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
            /** @var ChildComponentPartner $obj */
            $obj = new ChildComponentPartner();
            $obj->hydrate($row);
            ComponentPartnerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildComponentPartner|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByPartnerId($partnerId = null, $comparison = null)
    {
        if (is_array($partnerId)) {
            $useMinMax = false;
            if (isset($partnerId['min'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_PARTNER_ID, $partnerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($partnerId['max'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_PARTNER_ID, $partnerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_PARTNER_ID, $partnerId, $comparison);
    }

    /**
     * Filter the query on the component_id column
     *
     * Example usage:
     * <code>
     * $query->filterByComponentId(1234); // WHERE component_id = 1234
     * $query->filterByComponentId(array(12, 34)); // WHERE component_id IN (12, 34)
     * $query->filterByComponentId(array('min' => 12)); // WHERE component_id > 12
     * </code>
     *
     * @see       filterByComponent()
     *
     * @param     mixed $componentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByComponentId($componentId = null, $comparison = null)
    {
        if (is_array($componentId)) {
            $useMinMax = false;
            if (isset($componentId['min'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_COMPONENT_ID, $componentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($componentId['max'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_COMPONENT_ID, $componentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_COMPONENT_ID, $componentId, $comparison);
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_PRICE, $price, $comparison);
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ComponentPartnerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentPartnerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Component object
     *
     * @param \Component|ObjectCollection $component The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByComponent($component, $comparison = null)
    {
        if ($component instanceof \Component) {
            return $this
                ->addUsingAlias(ComponentPartnerTableMap::COL_COMPONENT_ID, $component->getId(), $comparison);
        } elseif ($component instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComponentPartnerTableMap::COL_COMPONENT_ID, $component->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByComponent() only accepts arguments of type \Component or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Component relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function joinComponent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Component');

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
            $this->addJoinObject($join, 'Component');
        }

        return $this;
    }

    /**
     * Use the Component relation Component object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ComponentQuery A secondary query class using the current class as primary query
     */
    public function useComponentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Component', '\ComponentQuery');
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function filterByPartner($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(ComponentPartnerTableMap::COL_PARTNER_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComponentPartnerTableMap::COL_PARTNER_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildComponentPartner $componentPartner Object to remove from the list of results
     *
     * @return $this|ChildComponentPartnerQuery The current query, for fluid interface
     */
    public function prune($componentPartner = null)
    {
        if ($componentPartner) {
            $this->addUsingAlias(ComponentPartnerTableMap::COL_ID, $componentPartner->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the component_partner table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentPartnerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ComponentPartnerTableMap::clearInstancePool();
            ComponentPartnerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentPartnerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ComponentPartnerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ComponentPartnerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ComponentPartnerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ComponentPartnerQuery
