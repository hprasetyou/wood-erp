<?php

namespace Base;

use \Partner as ChildPartner;
use \PartnerQuery as ChildPartnerQuery;
use \Exception;
use \PDO;
use Map\PartnerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'partner' table.
 *
 *
 *
 * @method     ChildPartnerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPartnerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPartnerQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildPartnerQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildPartnerQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 * @method     ChildPartnerQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method     ChildPartnerQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildPartnerQuery orderByTaxNumber($order = Criteria::ASC) Order by the tax_number column
 * @method     ChildPartnerQuery orderByBankDetail($order = Criteria::ASC) Order by the bank_detail column
 * @method     ChildPartnerQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPartnerQuery orderByIsCustomer($order = Criteria::ASC) Order by the is_customer column
 * @method     ChildPartnerQuery orderByIsSupplier($order = Criteria::ASC) Order by the is_supplier column
 *
 * @method     ChildPartnerQuery groupById() Group by the id column
 * @method     ChildPartnerQuery groupByName() Group by the name column
 * @method     ChildPartnerQuery groupByAddress() Group by the address column
 * @method     ChildPartnerQuery groupByPhone() Group by the phone column
 * @method     ChildPartnerQuery groupByWebsite() Group by the website column
 * @method     ChildPartnerQuery groupByFax() Group by the fax column
 * @method     ChildPartnerQuery groupByImage() Group by the image column
 * @method     ChildPartnerQuery groupByTaxNumber() Group by the tax_number column
 * @method     ChildPartnerQuery groupByBankDetail() Group by the bank_detail column
 * @method     ChildPartnerQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPartnerQuery groupByIsCustomer() Group by the is_customer column
 * @method     ChildPartnerQuery groupByIsSupplier() Group by the is_supplier column
 *
 * @method     ChildPartnerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartnerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartnerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartnerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPartnerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPartnerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPartnerQuery leftJoinProductCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductCustomer relation
 * @method     ChildPartnerQuery rightJoinProductCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductCustomer relation
 * @method     ChildPartnerQuery innerJoinProductCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductCustomer relation
 *
 * @method     ChildPartnerQuery joinWithProductCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductCustomer relation
 *
 * @method     ChildPartnerQuery leftJoinWithProductCustomer() Adds a LEFT JOIN clause and with to the query using the ProductCustomer relation
 * @method     ChildPartnerQuery rightJoinWithProductCustomer() Adds a RIGHT JOIN clause and with to the query using the ProductCustomer relation
 * @method     ChildPartnerQuery innerJoinWithProductCustomer() Adds a INNER JOIN clause and with to the query using the ProductCustomer relation
 *
 * @method     \ProductCustomerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPartner findOne(ConnectionInterface $con = null) Return the first ChildPartner matching the query
 * @method     ChildPartner findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPartner matching the query, or a new ChildPartner object populated from the query conditions when no match is found
 *
 * @method     ChildPartner findOneById(int $id) Return the first ChildPartner filtered by the id column
 * @method     ChildPartner findOneByName(string $name) Return the first ChildPartner filtered by the name column
 * @method     ChildPartner findOneByAddress(string $address) Return the first ChildPartner filtered by the address column
 * @method     ChildPartner findOneByPhone(string $phone) Return the first ChildPartner filtered by the phone column
 * @method     ChildPartner findOneByWebsite(string $website) Return the first ChildPartner filtered by the website column
 * @method     ChildPartner findOneByFax(string $fax) Return the first ChildPartner filtered by the fax column
 * @method     ChildPartner findOneByImage(string $image) Return the first ChildPartner filtered by the image column
 * @method     ChildPartner findOneByTaxNumber(string $tax_number) Return the first ChildPartner filtered by the tax_number column
 * @method     ChildPartner findOneByBankDetail(string $bank_detail) Return the first ChildPartner filtered by the bank_detail column
 * @method     ChildPartner findOneByCompanyId(int $company_id) Return the first ChildPartner filtered by the company_id column
 * @method     ChildPartner findOneByIsCustomer(boolean $is_customer) Return the first ChildPartner filtered by the is_customer column
 * @method     ChildPartner findOneByIsSupplier(boolean $is_supplier) Return the first ChildPartner filtered by the is_supplier column *

 * @method     ChildPartner requirePk($key, ConnectionInterface $con = null) Return the ChildPartner by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOne(ConnectionInterface $con = null) Return the first ChildPartner matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartner requireOneById(int $id) Return the first ChildPartner filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByName(string $name) Return the first ChildPartner filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByAddress(string $address) Return the first ChildPartner filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByPhone(string $phone) Return the first ChildPartner filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByWebsite(string $website) Return the first ChildPartner filtered by the website column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByFax(string $fax) Return the first ChildPartner filtered by the fax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByImage(string $image) Return the first ChildPartner filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByTaxNumber(string $tax_number) Return the first ChildPartner filtered by the tax_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByBankDetail(string $bank_detail) Return the first ChildPartner filtered by the bank_detail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByCompanyId(int $company_id) Return the first ChildPartner filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByIsCustomer(boolean $is_customer) Return the first ChildPartner filtered by the is_customer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByIsSupplier(boolean $is_supplier) Return the first ChildPartner filtered by the is_supplier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartner[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPartner objects based on current ModelCriteria
 * @method     ChildPartner[]|ObjectCollection findById(int $id) Return ChildPartner objects filtered by the id column
 * @method     ChildPartner[]|ObjectCollection findByName(string $name) Return ChildPartner objects filtered by the name column
 * @method     ChildPartner[]|ObjectCollection findByAddress(string $address) Return ChildPartner objects filtered by the address column
 * @method     ChildPartner[]|ObjectCollection findByPhone(string $phone) Return ChildPartner objects filtered by the phone column
 * @method     ChildPartner[]|ObjectCollection findByWebsite(string $website) Return ChildPartner objects filtered by the website column
 * @method     ChildPartner[]|ObjectCollection findByFax(string $fax) Return ChildPartner objects filtered by the fax column
 * @method     ChildPartner[]|ObjectCollection findByImage(string $image) Return ChildPartner objects filtered by the image column
 * @method     ChildPartner[]|ObjectCollection findByTaxNumber(string $tax_number) Return ChildPartner objects filtered by the tax_number column
 * @method     ChildPartner[]|ObjectCollection findByBankDetail(string $bank_detail) Return ChildPartner objects filtered by the bank_detail column
 * @method     ChildPartner[]|ObjectCollection findByCompanyId(int $company_id) Return ChildPartner objects filtered by the company_id column
 * @method     ChildPartner[]|ObjectCollection findByIsCustomer(boolean $is_customer) Return ChildPartner objects filtered by the is_customer column
 * @method     ChildPartner[]|ObjectCollection findByIsSupplier(boolean $is_supplier) Return ChildPartner objects filtered by the is_supplier column
 * @method     ChildPartner[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PartnerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PartnerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Partner', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPartnerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPartnerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPartnerQuery) {
            return $criteria;
        }
        $query = new ChildPartnerQuery();
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
     * @return ChildPartner|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartnerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PartnerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPartner A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, address, phone, website, fax, image, tax_number, bank_detail, company_id, is_customer, is_supplier FROM partner WHERE id = :p0';
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
            /** @var ChildPartner $obj */
            $obj = new ChildPartner();
            $obj->hydrate($row);
            PartnerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPartner|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PartnerTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PartnerTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PartnerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the website column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsite('fooValue');   // WHERE website = 'fooValue'
     * $query->filterByWebsite('%fooValue%', Criteria::LIKE); // WHERE website LIKE '%fooValue%'
     * </code>
     *
     * @param     string $website The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByWebsite($website = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($website)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_WEBSITE, $website, $comparison);
    }

    /**
     * Filter the query on the fax column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE fax = 'fooValue'
     * $query->filterByFax('%fooValue%', Criteria::LIKE); // WHERE fax LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fax The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_FAX, $fax, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%', Criteria::LIKE); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query on the tax_number column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxNumber('fooValue');   // WHERE tax_number = 'fooValue'
     * $query->filterByTaxNumber('%fooValue%', Criteria::LIKE); // WHERE tax_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $taxNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByTaxNumber($taxNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($taxNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_TAX_NUMBER, $taxNumber, $comparison);
    }

    /**
     * Filter the query on the bank_detail column
     *
     * Example usage:
     * <code>
     * $query->filterByBankDetail('fooValue');   // WHERE bank_detail = 'fooValue'
     * $query->filterByBankDetail('%fooValue%', Criteria::LIKE); // WHERE bank_detail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bankDetail The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByBankDetail($bankDetail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bankDetail)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_BANK_DETAIL, $bankDetail, $comparison);
    }

    /**
     * Filter the query on the company_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCompanyId(1234); // WHERE company_id = 1234
     * $query->filterByCompanyId(array(12, 34)); // WHERE company_id IN (12, 34)
     * $query->filterByCompanyId(array('min' => 12)); // WHERE company_id > 12
     * </code>
     *
     * @param     mixed $companyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByCompanyId($companyId = null, $comparison = null)
    {
        if (is_array($companyId)) {
            $useMinMax = false;
            if (isset($companyId['min'])) {
                $this->addUsingAlias(PartnerTableMap::COL_COMPANY_ID, $companyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($companyId['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_COMPANY_ID, $companyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_COMPANY_ID, $companyId, $comparison);
    }

    /**
     * Filter the query on the is_customer column
     *
     * Example usage:
     * <code>
     * $query->filterByIsCustomer(true); // WHERE is_customer = true
     * $query->filterByIsCustomer('yes'); // WHERE is_customer = true
     * </code>
     *
     * @param     boolean|string $isCustomer The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByIsCustomer($isCustomer = null, $comparison = null)
    {
        if (is_string($isCustomer)) {
            $isCustomer = in_array(strtolower($isCustomer), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PartnerTableMap::COL_IS_CUSTOMER, $isCustomer, $comparison);
    }

    /**
     * Filter the query on the is_supplier column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSupplier(true); // WHERE is_supplier = true
     * $query->filterByIsSupplier('yes'); // WHERE is_supplier = true
     * </code>
     *
     * @param     boolean|string $isSupplier The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByIsSupplier($isSupplier = null, $comparison = null)
    {
        if (is_string($isSupplier)) {
            $isSupplier = in_array(strtolower($isSupplier), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PartnerTableMap::COL_IS_SUPPLIER, $isSupplier, $comparison);
    }

    /**
     * Filter the query by a related \ProductCustomer object
     *
     * @param \ProductCustomer|ObjectCollection $productCustomer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByProductCustomer($productCustomer, $comparison = null)
    {
        if ($productCustomer instanceof \ProductCustomer) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $productCustomer->getPartnerId(), $comparison);
        } elseif ($productCustomer instanceof ObjectCollection) {
            return $this
                ->useProductCustomerQuery()
                ->filterByPrimaryKeys($productCustomer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductCustomer() only accepts arguments of type \ProductCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductCustomer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinProductCustomer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductCustomer');

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
            $this->addJoinObject($join, 'ProductCustomer');
        }

        return $this;
    }

    /**
     * Use the ProductCustomer relation ProductCustomer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductCustomerQuery A secondary query class using the current class as primary query
     */
    public function useProductCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductCustomer', '\ProductCustomerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPartner $partner Object to remove from the list of results
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function prune($partner = null)
    {
        if ($partner) {
            $this->addUsingAlias(PartnerTableMap::COL_ID, $partner->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the partner table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PartnerTableMap::clearInstancePool();
            PartnerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PartnerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PartnerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PartnerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PartnerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PartnerQuery
