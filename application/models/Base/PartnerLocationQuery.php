<?php

namespace Base;

use \PartnerLocation as ChildPartnerLocation;
use \PartnerLocationQuery as ChildPartnerLocationQuery;
use \Exception;
use \PDO;
use Map\PartnerLocationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'partner_location' table.
 *
 *
 *
 * @method     ChildPartnerLocationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPartnerLocationQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPartnerLocationQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPartnerLocationQuery orderByPartnerId($order = Criteria::ASC) Order by the partner_id column
 * @method     ChildPartnerLocationQuery orderByCountryId($order = Criteria::ASC) Order by the country_id column
 * @method     ChildPartnerLocationQuery orderByPostal($order = Criteria::ASC) Order by the postal column
 * @method     ChildPartnerLocationQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildPartnerLocationQuery orderByUsage($order = Criteria::ASC) Order by the usage column
 * @method     ChildPartnerLocationQuery orderByAdress($order = Criteria::ASC) Order by the address column
 *
 * @method     ChildPartnerLocationQuery groupById() Group by the id column
 * @method     ChildPartnerLocationQuery groupByName() Group by the name column
 * @method     ChildPartnerLocationQuery groupByDescription() Group by the description column
 * @method     ChildPartnerLocationQuery groupByPartnerId() Group by the partner_id column
 * @method     ChildPartnerLocationQuery groupByCountryId() Group by the country_id column
 * @method     ChildPartnerLocationQuery groupByPostal() Group by the postal column
 * @method     ChildPartnerLocationQuery groupByCity() Group by the city column
 * @method     ChildPartnerLocationQuery groupByUsage() Group by the usage column
 * @method     ChildPartnerLocationQuery groupByAdress() Group by the address column
 *
 * @method     ChildPartnerLocationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartnerLocationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartnerLocationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartnerLocationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPartnerLocationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPartnerLocationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPartnerLocationQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildPartnerLocationQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildPartnerLocationQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildPartnerLocationQuery joinWithCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Country relation
 *
 * @method     ChildPartnerLocationQuery leftJoinWithCountry() Adds a LEFT JOIN clause and with to the query using the Country relation
 * @method     ChildPartnerLocationQuery rightJoinWithCountry() Adds a RIGHT JOIN clause and with to the query using the Country relation
 * @method     ChildPartnerLocationQuery innerJoinWithCountry() Adds a INNER JOIN clause and with to the query using the Country relation
 *
 * @method     ChildPartnerLocationQuery leftJoinPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partner relation
 * @method     ChildPartnerLocationQuery rightJoinPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partner relation
 * @method     ChildPartnerLocationQuery innerJoinPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the Partner relation
 *
 * @method     ChildPartnerLocationQuery joinWithPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Partner relation
 *
 * @method     ChildPartnerLocationQuery leftJoinWithPartner() Adds a LEFT JOIN clause and with to the query using the Partner relation
 * @method     ChildPartnerLocationQuery rightJoinWithPartner() Adds a RIGHT JOIN clause and with to the query using the Partner relation
 * @method     ChildPartnerLocationQuery innerJoinWithPartner() Adds a INNER JOIN clause and with to the query using the Partner relation
 *
 * @method     \CountryQuery|\PartnerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPartnerLocation findOne(ConnectionInterface $con = null) Return the first ChildPartnerLocation matching the query
 * @method     ChildPartnerLocation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPartnerLocation matching the query, or a new ChildPartnerLocation object populated from the query conditions when no match is found
 *
 * @method     ChildPartnerLocation findOneById(int $id) Return the first ChildPartnerLocation filtered by the id column
 * @method     ChildPartnerLocation findOneByName(string $name) Return the first ChildPartnerLocation filtered by the name column
 * @method     ChildPartnerLocation findOneByDescription(string $description) Return the first ChildPartnerLocation filtered by the description column
 * @method     ChildPartnerLocation findOneByPartnerId(int $partner_id) Return the first ChildPartnerLocation filtered by the partner_id column
 * @method     ChildPartnerLocation findOneByCountryId(int $country_id) Return the first ChildPartnerLocation filtered by the country_id column
 * @method     ChildPartnerLocation findOneByPostal(string $postal) Return the first ChildPartnerLocation filtered by the postal column
 * @method     ChildPartnerLocation findOneByCity(string $city) Return the first ChildPartnerLocation filtered by the city column
 * @method     ChildPartnerLocation findOneByUsage(string $usage) Return the first ChildPartnerLocation filtered by the usage column
 * @method     ChildPartnerLocation findOneByAdress(string $address) Return the first ChildPartnerLocation filtered by the address column *

 * @method     ChildPartnerLocation requirePk($key, ConnectionInterface $con = null) Return the ChildPartnerLocation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOne(ConnectionInterface $con = null) Return the first ChildPartnerLocation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartnerLocation requireOneById(int $id) Return the first ChildPartnerLocation filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByName(string $name) Return the first ChildPartnerLocation filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByDescription(string $description) Return the first ChildPartnerLocation filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByPartnerId(int $partner_id) Return the first ChildPartnerLocation filtered by the partner_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByCountryId(int $country_id) Return the first ChildPartnerLocation filtered by the country_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByPostal(string $postal) Return the first ChildPartnerLocation filtered by the postal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByCity(string $city) Return the first ChildPartnerLocation filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByUsage(string $usage) Return the first ChildPartnerLocation filtered by the usage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartnerLocation requireOneByAdress(string $address) Return the first ChildPartnerLocation filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartnerLocation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPartnerLocation objects based on current ModelCriteria
 * @method     ChildPartnerLocation[]|ObjectCollection findById(int $id) Return ChildPartnerLocation objects filtered by the id column
 * @method     ChildPartnerLocation[]|ObjectCollection findByName(string $name) Return ChildPartnerLocation objects filtered by the name column
 * @method     ChildPartnerLocation[]|ObjectCollection findByDescription(string $description) Return ChildPartnerLocation objects filtered by the description column
 * @method     ChildPartnerLocation[]|ObjectCollection findByPartnerId(int $partner_id) Return ChildPartnerLocation objects filtered by the partner_id column
 * @method     ChildPartnerLocation[]|ObjectCollection findByCountryId(int $country_id) Return ChildPartnerLocation objects filtered by the country_id column
 * @method     ChildPartnerLocation[]|ObjectCollection findByPostal(string $postal) Return ChildPartnerLocation objects filtered by the postal column
 * @method     ChildPartnerLocation[]|ObjectCollection findByCity(string $city) Return ChildPartnerLocation objects filtered by the city column
 * @method     ChildPartnerLocation[]|ObjectCollection findByUsage(string $usage) Return ChildPartnerLocation objects filtered by the usage column
 * @method     ChildPartnerLocation[]|ObjectCollection findByAdress(string $address) Return ChildPartnerLocation objects filtered by the address column
 * @method     ChildPartnerLocation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PartnerLocationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PartnerLocationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PartnerLocation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPartnerLocationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPartnerLocationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPartnerLocationQuery) {
            return $criteria;
        }
        $query = new ChildPartnerLocationQuery();
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
     * @return ChildPartnerLocation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartnerLocationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PartnerLocationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPartnerLocation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, partner_id, country_id, postal, city, usage, address FROM partner_location WHERE id = :p0';
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
            /** @var ChildPartnerLocation $obj */
            $obj = new ChildPartnerLocation();
            $obj->hydrate($row);
            PartnerLocationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPartnerLocation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PartnerLocationTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PartnerLocationTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PartnerLocationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PartnerLocationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByPartnerId($partnerId = null, $comparison = null)
    {
        if (is_array($partnerId)) {
            $useMinMax = false;
            if (isset($partnerId['min'])) {
                $this->addUsingAlias(PartnerLocationTableMap::COL_PARTNER_ID, $partnerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($partnerId['max'])) {
                $this->addUsingAlias(PartnerLocationTableMap::COL_PARTNER_ID, $partnerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_PARTNER_ID, $partnerId, $comparison);
    }

    /**
     * Filter the query on the country_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryId(1234); // WHERE country_id = 1234
     * $query->filterByCountryId(array(12, 34)); // WHERE country_id IN (12, 34)
     * $query->filterByCountryId(array('min' => 12)); // WHERE country_id > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $countryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByCountryId($countryId = null, $comparison = null)
    {
        if (is_array($countryId)) {
            $useMinMax = false;
            if (isset($countryId['min'])) {
                $this->addUsingAlias(PartnerLocationTableMap::COL_COUNTRY_ID, $countryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countryId['max'])) {
                $this->addUsingAlias(PartnerLocationTableMap::COL_COUNTRY_ID, $countryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_COUNTRY_ID, $countryId, $comparison);
    }

    /**
     * Filter the query on the postal column
     *
     * Example usage:
     * <code>
     * $query->filterByPostal('fooValue');   // WHERE postal = 'fooValue'
     * $query->filterByPostal('%fooValue%', Criteria::LIKE); // WHERE postal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postal The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByPostal($postal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postal)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_POSTAL, $postal, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query on the usage column
     *
     * Example usage:
     * <code>
     * $query->filterByUsage('fooValue');   // WHERE usage = 'fooValue'
     * $query->filterByUsage('%fooValue%', Criteria::LIKE); // WHERE usage LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usage The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByUsage($usage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usage)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_USAGE, $usage, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAdress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAdress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByAdress($adress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerLocationTableMap::COL_ADDRESS, $adress, $comparison);
    }

    /**
     * Filter the query by a related \Country object
     *
     * @param \Country|ObjectCollection $country The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof \Country) {
            return $this
                ->addUsingAlias(PartnerLocationTableMap::COL_COUNTRY_ID, $country->getId(), $comparison);
        } elseif ($country instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnerLocationTableMap::COL_COUNTRY_ID, $country->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \Country or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\CountryQuery');
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function filterByPartner($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(PartnerLocationTableMap::COL_PARTNER_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnerLocationTableMap::COL_PARTNER_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
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
     * @param   ChildPartnerLocation $partnerLocation Object to remove from the list of results
     *
     * @return $this|ChildPartnerLocationQuery The current query, for fluid interface
     */
    public function prune($partnerLocation = null)
    {
        if ($partnerLocation) {
            $this->addUsingAlias(PartnerLocationTableMap::COL_ID, $partnerLocation->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the partner_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerLocationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PartnerLocationTableMap::clearInstancePool();
            PartnerLocationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerLocationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PartnerLocationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PartnerLocationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PartnerLocationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PartnerLocationQuery
