<?php

namespace Base;

use \Component as ChildComponent;
use \ComponentQuery as ChildComponentQuery;
use \Exception;
use \PDO;
use Map\ComponentTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'component' table.
 *
 *
 *
 * @method     ChildComponentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildComponentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildComponentQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildComponentQuery orderByMaterialId($order = Criteria::ASC) Order by the material_id column
 * @method     ChildComponentQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildComponentQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildComponentQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildComponentQuery groupById() Group by the id column
 * @method     ChildComponentQuery groupByName() Group by the name column
 * @method     ChildComponentQuery groupByDescription() Group by the description column
 * @method     ChildComponentQuery groupByMaterialId() Group by the material_id column
 * @method     ChildComponentQuery groupByType() Group by the type column
 * @method     ChildComponentQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildComponentQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildComponentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildComponentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildComponentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildComponentQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildComponentQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildComponentQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildComponentQuery leftJoinMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the Material relation
 * @method     ChildComponentQuery rightJoinMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Material relation
 * @method     ChildComponentQuery innerJoinMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the Material relation
 *
 * @method     ChildComponentQuery joinWithMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Material relation
 *
 * @method     ChildComponentQuery leftJoinWithMaterial() Adds a LEFT JOIN clause and with to the query using the Material relation
 * @method     ChildComponentQuery rightJoinWithMaterial() Adds a RIGHT JOIN clause and with to the query using the Material relation
 * @method     ChildComponentQuery innerJoinWithMaterial() Adds a INNER JOIN clause and with to the query using the Material relation
 *
 * @method     ChildComponentQuery leftJoinProductComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductComponent relation
 * @method     ChildComponentQuery rightJoinProductComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductComponent relation
 * @method     ChildComponentQuery innerJoinProductComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductComponent relation
 *
 * @method     ChildComponentQuery joinWithProductComponent($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductComponent relation
 *
 * @method     ChildComponentQuery leftJoinWithProductComponent() Adds a LEFT JOIN clause and with to the query using the ProductComponent relation
 * @method     ChildComponentQuery rightJoinWithProductComponent() Adds a RIGHT JOIN clause and with to the query using the ProductComponent relation
 * @method     ChildComponentQuery innerJoinWithProductComponent() Adds a INNER JOIN clause and with to the query using the ProductComponent relation
 *
 * @method     ChildComponentQuery leftJoinPurchaseOrderLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildComponentQuery rightJoinPurchaseOrderLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrderLine relation
 * @method     ChildComponentQuery innerJoinPurchaseOrderLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrderLine relation
 *
 * @method     ChildComponentQuery joinWithPurchaseOrderLine($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     ChildComponentQuery leftJoinWithPurchaseOrderLine() Adds a LEFT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildComponentQuery rightJoinWithPurchaseOrderLine() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrderLine relation
 * @method     ChildComponentQuery innerJoinWithPurchaseOrderLine() Adds a INNER JOIN clause and with to the query using the PurchaseOrderLine relation
 *
 * @method     ChildComponentQuery leftJoinComponentPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the ComponentPartner relation
 * @method     ChildComponentQuery rightJoinComponentPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ComponentPartner relation
 * @method     ChildComponentQuery innerJoinComponentPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the ComponentPartner relation
 *
 * @method     ChildComponentQuery joinWithComponentPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ComponentPartner relation
 *
 * @method     ChildComponentQuery leftJoinWithComponentPartner() Adds a LEFT JOIN clause and with to the query using the ComponentPartner relation
 * @method     ChildComponentQuery rightJoinWithComponentPartner() Adds a RIGHT JOIN clause and with to the query using the ComponentPartner relation
 * @method     ChildComponentQuery innerJoinWithComponentPartner() Adds a INNER JOIN clause and with to the query using the ComponentPartner relation
 *
 * @method     \MaterialQuery|\ProductComponentQuery|\PurchaseOrderLineQuery|\ComponentPartnerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildComponent findOne(ConnectionInterface $con = null) Return the first ChildComponent matching the query
 * @method     ChildComponent findOneOrCreate(ConnectionInterface $con = null) Return the first ChildComponent matching the query, or a new ChildComponent object populated from the query conditions when no match is found
 *
 * @method     ChildComponent findOneById(int $id) Return the first ChildComponent filtered by the id column
 * @method     ChildComponent findOneByName(string $name) Return the first ChildComponent filtered by the name column
 * @method     ChildComponent findOneByDescription(string $description) Return the first ChildComponent filtered by the description column
 * @method     ChildComponent findOneByMaterialId(int $material_id) Return the first ChildComponent filtered by the material_id column
 * @method     ChildComponent findOneByType(string $type) Return the first ChildComponent filtered by the type column
 * @method     ChildComponent findOneByCreatedAt(string $created_at) Return the first ChildComponent filtered by the created_at column
 * @method     ChildComponent findOneByUpdatedAt(string $updated_at) Return the first ChildComponent filtered by the updated_at column *

 * @method     ChildComponent requirePk($key, ConnectionInterface $con = null) Return the ChildComponent by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOne(ConnectionInterface $con = null) Return the first ChildComponent matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComponent requireOneById(int $id) Return the first ChildComponent filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOneByName(string $name) Return the first ChildComponent filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOneByDescription(string $description) Return the first ChildComponent filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOneByMaterialId(int $material_id) Return the first ChildComponent filtered by the material_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOneByType(string $type) Return the first ChildComponent filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOneByCreatedAt(string $created_at) Return the first ChildComponent filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildComponent requireOneByUpdatedAt(string $updated_at) Return the first ChildComponent filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildComponent[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildComponent objects based on current ModelCriteria
 * @method     ChildComponent[]|ObjectCollection findById(int $id) Return ChildComponent objects filtered by the id column
 * @method     ChildComponent[]|ObjectCollection findByName(string $name) Return ChildComponent objects filtered by the name column
 * @method     ChildComponent[]|ObjectCollection findByDescription(string $description) Return ChildComponent objects filtered by the description column
 * @method     ChildComponent[]|ObjectCollection findByMaterialId(int $material_id) Return ChildComponent objects filtered by the material_id column
 * @method     ChildComponent[]|ObjectCollection findByType(string $type) Return ChildComponent objects filtered by the type column
 * @method     ChildComponent[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildComponent objects filtered by the created_at column
 * @method     ChildComponent[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildComponent objects filtered by the updated_at column
 * @method     ChildComponent[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ComponentQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ComponentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Component', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildComponentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildComponentQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildComponentQuery) {
            return $criteria;
        }
        $query = new ChildComponentQuery();
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
     * @return ChildComponent|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ComponentTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ComponentTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildComponent A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, material_id, type, created_at, updated_at FROM component WHERE id = :p0';
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
            /** @var ChildComponent $obj */
            $obj = new ChildComponent();
            $obj->hydrate($row);
            ComponentTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildComponent|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ComponentTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ComponentTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ComponentTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ComponentTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the material_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMaterialId(1234); // WHERE material_id = 1234
     * $query->filterByMaterialId(array(12, 34)); // WHERE material_id IN (12, 34)
     * $query->filterByMaterialId(array('min' => 12)); // WHERE material_id > 12
     * </code>
     *
     * @see       filterByMaterial()
     *
     * @param     mixed $materialId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByMaterialId($materialId = null, $comparison = null)
    {
        if (is_array($materialId)) {
            $useMinMax = false;
            if (isset($materialId['min'])) {
                $this->addUsingAlias(ComponentTableMap::COL_MATERIAL_ID, $materialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($materialId['max'])) {
                $this->addUsingAlias(ComponentTableMap::COL_MATERIAL_ID, $materialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_MATERIAL_ID, $materialId, $comparison);
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_TYPE, $type, $comparison);
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ComponentTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ComponentTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ComponentTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ComponentTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComponentTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Material object
     *
     * @param \Material|ObjectCollection $material The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildComponentQuery The current query, for fluid interface
     */
    public function filterByMaterial($material, $comparison = null)
    {
        if ($material instanceof \Material) {
            return $this
                ->addUsingAlias(ComponentTableMap::COL_MATERIAL_ID, $material->getId(), $comparison);
        } elseif ($material instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ComponentTableMap::COL_MATERIAL_ID, $material->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMaterial() only accepts arguments of type \Material or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Material relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function joinMaterial($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Material');

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
            $this->addJoinObject($join, 'Material');
        }

        return $this;
    }

    /**
     * Use the Material relation Material object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MaterialQuery A secondary query class using the current class as primary query
     */
    public function useMaterialQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Material', '\MaterialQuery');
    }

    /**
     * Filter the query by a related \ProductComponent object
     *
     * @param \ProductComponent|ObjectCollection $productComponent the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildComponentQuery The current query, for fluid interface
     */
    public function filterByProductComponent($productComponent, $comparison = null)
    {
        if ($productComponent instanceof \ProductComponent) {
            return $this
                ->addUsingAlias(ComponentTableMap::COL_ID, $productComponent->getComponentId(), $comparison);
        } elseif ($productComponent instanceof ObjectCollection) {
            return $this
                ->useProductComponentQuery()
                ->filterByPrimaryKeys($productComponent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductComponent() only accepts arguments of type \ProductComponent or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductComponent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function joinProductComponent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductComponent');

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
            $this->addJoinObject($join, 'ProductComponent');
        }

        return $this;
    }

    /**
     * Use the ProductComponent relation ProductComponent object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductComponentQuery A secondary query class using the current class as primary query
     */
    public function useProductComponentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductComponent', '\ProductComponentQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrderLine object
     *
     * @param \PurchaseOrderLine|ObjectCollection $purchaseOrderLine the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildComponentQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrderLine($purchaseOrderLine, $comparison = null)
    {
        if ($purchaseOrderLine instanceof \PurchaseOrderLine) {
            return $this
                ->addUsingAlias(ComponentTableMap::COL_ID, $purchaseOrderLine->getComponentId(), $comparison);
        } elseif ($purchaseOrderLine instanceof ObjectCollection) {
            return $this
                ->usePurchaseOrderLineQuery()
                ->filterByPrimaryKeys($purchaseOrderLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseOrderLine() only accepts arguments of type \PurchaseOrderLine or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseOrderLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function joinPurchaseOrderLine($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseOrderLine');

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
            $this->addJoinObject($join, 'PurchaseOrderLine');
        }

        return $this;
    }

    /**
     * Use the PurchaseOrderLine relation PurchaseOrderLine object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PurchaseOrderLineQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseOrderLineQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPurchaseOrderLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrderLine', '\PurchaseOrderLineQuery');
    }

    /**
     * Filter the query by a related \ComponentPartner object
     *
     * @param \ComponentPartner|ObjectCollection $componentPartner the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildComponentQuery The current query, for fluid interface
     */
    public function filterByComponentPartner($componentPartner, $comparison = null)
    {
        if ($componentPartner instanceof \ComponentPartner) {
            return $this
                ->addUsingAlias(ComponentTableMap::COL_ID, $componentPartner->getComponentId(), $comparison);
        } elseif ($componentPartner instanceof ObjectCollection) {
            return $this
                ->useComponentPartnerQuery()
                ->filterByPrimaryKeys($componentPartner->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComponentPartner() only accepts arguments of type \ComponentPartner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ComponentPartner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function joinComponentPartner($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ComponentPartner');

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
            $this->addJoinObject($join, 'ComponentPartner');
        }

        return $this;
    }

    /**
     * Use the ComponentPartner relation ComponentPartner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ComponentPartnerQuery A secondary query class using the current class as primary query
     */
    public function useComponentPartnerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinComponentPartner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ComponentPartner', '\ComponentPartnerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildComponent $component Object to remove from the list of results
     *
     * @return $this|ChildComponentQuery The current query, for fluid interface
     */
    public function prune($component = null)
    {
        if ($component) {
            $this->addUsingAlias(ComponentTableMap::COL_ID, $component->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the component table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ComponentTableMap::clearInstancePool();
            ComponentTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ComponentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ComponentTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ComponentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ComponentTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ComponentQuery
