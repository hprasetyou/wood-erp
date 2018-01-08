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
 * @method     ChildPartnerQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildPartnerQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildPartnerQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 * @method     ChildPartnerQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method     ChildPartnerQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildPartnerQuery orderByTaxNumber($order = Criteria::ASC) Order by the tax_number column
 * @method     ChildPartnerQuery orderByRole($order = Criteria::ASC) Order by the role column
 * @method     ChildPartnerQuery orderByCompanyId($order = Criteria::ASC) Order by the company_id column
 * @method     ChildPartnerQuery orderBySupplierTypeId($order = Criteria::ASC) Order by the supplier_type_id column
 * @method     ChildPartnerQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildPartnerQuery orderByClassKey($order = Criteria::ASC) Order by the class_key column
 * @method     ChildPartnerQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPartnerQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPartnerQuery groupById() Group by the id column
 * @method     ChildPartnerQuery groupByName() Group by the name column
 * @method     ChildPartnerQuery groupByEmail() Group by the email column
 * @method     ChildPartnerQuery groupByPhone() Group by the phone column
 * @method     ChildPartnerQuery groupByWebsite() Group by the website column
 * @method     ChildPartnerQuery groupByFax() Group by the fax column
 * @method     ChildPartnerQuery groupByImage() Group by the image column
 * @method     ChildPartnerQuery groupByTaxNumber() Group by the tax_number column
 * @method     ChildPartnerQuery groupByRole() Group by the role column
 * @method     ChildPartnerQuery groupByCompanyId() Group by the company_id column
 * @method     ChildPartnerQuery groupBySupplierTypeId() Group by the supplier_type_id column
 * @method     ChildPartnerQuery groupByActive() Group by the active column
 * @method     ChildPartnerQuery groupByClassKey() Group by the class_key column
 * @method     ChildPartnerQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPartnerQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPartnerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartnerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartnerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartnerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPartnerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPartnerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPartnerQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildPartnerQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildPartnerQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildPartnerQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildPartnerQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildPartnerQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildPartnerQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildPartnerQuery leftJoinSupplierType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SupplierType relation
 * @method     ChildPartnerQuery rightJoinSupplierType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SupplierType relation
 * @method     ChildPartnerQuery innerJoinSupplierType($relationAlias = null) Adds a INNER JOIN clause to the query using the SupplierType relation
 *
 * @method     ChildPartnerQuery joinWithSupplierType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SupplierType relation
 *
 * @method     ChildPartnerQuery leftJoinWithSupplierType() Adds a LEFT JOIN clause and with to the query using the SupplierType relation
 * @method     ChildPartnerQuery rightJoinWithSupplierType() Adds a RIGHT JOIN clause and with to the query using the SupplierType relation
 * @method     ChildPartnerQuery innerJoinWithSupplierType() Adds a INNER JOIN clause and with to the query using the SupplierType relation
 *
 * @method     ChildPartnerQuery leftJoinPartnerRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartnerRelatedById relation
 * @method     ChildPartnerQuery rightJoinPartnerRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartnerRelatedById relation
 * @method     ChildPartnerQuery innerJoinPartnerRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the PartnerRelatedById relation
 *
 * @method     ChildPartnerQuery joinWithPartnerRelatedById($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PartnerRelatedById relation
 *
 * @method     ChildPartnerQuery leftJoinWithPartnerRelatedById() Adds a LEFT JOIN clause and with to the query using the PartnerRelatedById relation
 * @method     ChildPartnerQuery rightJoinWithPartnerRelatedById() Adds a RIGHT JOIN clause and with to the query using the PartnerRelatedById relation
 * @method     ChildPartnerQuery innerJoinWithPartnerRelatedById() Adds a INNER JOIN clause and with to the query using the PartnerRelatedById relation
 *
 * @method     ChildPartnerQuery leftJoinProductPartner($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductPartner relation
 * @method     ChildPartnerQuery rightJoinProductPartner($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductPartner relation
 * @method     ChildPartnerQuery innerJoinProductPartner($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductPartner relation
 *
 * @method     ChildPartnerQuery joinWithProductPartner($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductPartner relation
 *
 * @method     ChildPartnerQuery leftJoinWithProductPartner() Adds a LEFT JOIN clause and with to the query using the ProductPartner relation
 * @method     ChildPartnerQuery rightJoinWithProductPartner() Adds a RIGHT JOIN clause and with to the query using the ProductPartner relation
 * @method     ChildPartnerQuery innerJoinWithProductPartner() Adds a INNER JOIN clause and with to the query using the ProductPartner relation
 *
 * @method     ChildPartnerQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildPartnerQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildPartnerQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildPartnerQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildPartnerQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildPartnerQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildPartnerQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildPartnerQuery leftJoinProformaInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildPartnerQuery rightJoinProformaInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProformaInvoice relation
 * @method     ChildPartnerQuery innerJoinProformaInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the ProformaInvoice relation
 *
 * @method     ChildPartnerQuery joinWithProformaInvoice($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildPartnerQuery leftJoinWithProformaInvoice() Adds a LEFT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildPartnerQuery rightJoinWithProformaInvoice() Adds a RIGHT JOIN clause and with to the query using the ProformaInvoice relation
 * @method     ChildPartnerQuery innerJoinWithProformaInvoice() Adds a INNER JOIN clause and with to the query using the ProformaInvoice relation
 *
 * @method     ChildPartnerQuery leftJoinPackingList($relationAlias = null) Adds a LEFT JOIN clause to the query using the PackingList relation
 * @method     ChildPartnerQuery rightJoinPackingList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PackingList relation
 * @method     ChildPartnerQuery innerJoinPackingList($relationAlias = null) Adds a INNER JOIN clause to the query using the PackingList relation
 *
 * @method     ChildPartnerQuery joinWithPackingList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PackingList relation
 *
 * @method     ChildPartnerQuery leftJoinWithPackingList() Adds a LEFT JOIN clause and with to the query using the PackingList relation
 * @method     ChildPartnerQuery rightJoinWithPackingList() Adds a RIGHT JOIN clause and with to the query using the PackingList relation
 * @method     ChildPartnerQuery innerJoinWithPackingList() Adds a INNER JOIN clause and with to the query using the PackingList relation
 *
 * @method     ChildPartnerQuery leftJoinPurchaseOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildPartnerQuery rightJoinPurchaseOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PurchaseOrder relation
 * @method     ChildPartnerQuery innerJoinPurchaseOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the PurchaseOrder relation
 *
 * @method     ChildPartnerQuery joinWithPurchaseOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildPartnerQuery leftJoinWithPurchaseOrder() Adds a LEFT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildPartnerQuery rightJoinWithPurchaseOrder() Adds a RIGHT JOIN clause and with to the query using the PurchaseOrder relation
 * @method     ChildPartnerQuery innerJoinWithPurchaseOrder() Adds a INNER JOIN clause and with to the query using the PurchaseOrder relation
 *
 * @method     ChildPartnerQuery leftJoinPartnerBank($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartnerBank relation
 * @method     ChildPartnerQuery rightJoinPartnerBank($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartnerBank relation
 * @method     ChildPartnerQuery innerJoinPartnerBank($relationAlias = null) Adds a INNER JOIN clause to the query using the PartnerBank relation
 *
 * @method     ChildPartnerQuery joinWithPartnerBank($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PartnerBank relation
 *
 * @method     ChildPartnerQuery leftJoinWithPartnerBank() Adds a LEFT JOIN clause and with to the query using the PartnerBank relation
 * @method     ChildPartnerQuery rightJoinWithPartnerBank() Adds a RIGHT JOIN clause and with to the query using the PartnerBank relation
 * @method     ChildPartnerQuery innerJoinWithPartnerBank() Adds a INNER JOIN clause and with to the query using the PartnerBank relation
 *
 * @method     ChildPartnerQuery leftJoinPartnerLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartnerLocation relation
 * @method     ChildPartnerQuery rightJoinPartnerLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartnerLocation relation
 * @method     ChildPartnerQuery innerJoinPartnerLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the PartnerLocation relation
 *
 * @method     ChildPartnerQuery joinWithPartnerLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PartnerLocation relation
 *
 * @method     ChildPartnerQuery leftJoinWithPartnerLocation() Adds a LEFT JOIN clause and with to the query using the PartnerLocation relation
 * @method     ChildPartnerQuery rightJoinWithPartnerLocation() Adds a RIGHT JOIN clause and with to the query using the PartnerLocation relation
 * @method     ChildPartnerQuery innerJoinWithPartnerLocation() Adds a INNER JOIN clause and with to the query using the PartnerLocation relation
 *
 * @method     \PartnerQuery|\SupplierTypeQuery|\ProductPartnerQuery|\UserQuery|\ProformaInvoiceQuery|\PackingListQuery|\PurchaseOrderQuery|\PartnerBankQuery|\PartnerLocationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPartner findOne(ConnectionInterface $con = null) Return the first ChildPartner matching the query
 * @method     ChildPartner findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPartner matching the query, or a new ChildPartner object populated from the query conditions when no match is found
 *
 * @method     ChildPartner findOneById(int $id) Return the first ChildPartner filtered by the id column
 * @method     ChildPartner findOneByName(string $name) Return the first ChildPartner filtered by the name column
 * @method     ChildPartner findOneByEmail(string $email) Return the first ChildPartner filtered by the email column
 * @method     ChildPartner findOneByPhone(string $phone) Return the first ChildPartner filtered by the phone column
 * @method     ChildPartner findOneByWebsite(string $website) Return the first ChildPartner filtered by the website column
 * @method     ChildPartner findOneByFax(string $fax) Return the first ChildPartner filtered by the fax column
 * @method     ChildPartner findOneByImage(string $image) Return the first ChildPartner filtered by the image column
 * @method     ChildPartner findOneByTaxNumber(string $tax_number) Return the first ChildPartner filtered by the tax_number column
 * @method     ChildPartner findOneByRole(string $role) Return the first ChildPartner filtered by the role column
 * @method     ChildPartner findOneByCompanyId(int $company_id) Return the first ChildPartner filtered by the company_id column
 * @method     ChildPartner findOneBySupplierTypeId(int $supplier_type_id) Return the first ChildPartner filtered by the supplier_type_id column
 * @method     ChildPartner findOneByActive(boolean $active) Return the first ChildPartner filtered by the active column
 * @method     ChildPartner findOneByClassKey(int $class_key) Return the first ChildPartner filtered by the class_key column
 * @method     ChildPartner findOneByCreatedAt(string $created_at) Return the first ChildPartner filtered by the created_at column
 * @method     ChildPartner findOneByUpdatedAt(string $updated_at) Return the first ChildPartner filtered by the updated_at column *

 * @method     ChildPartner requirePk($key, ConnectionInterface $con = null) Return the ChildPartner by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOne(ConnectionInterface $con = null) Return the first ChildPartner matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartner requireOneById(int $id) Return the first ChildPartner filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByName(string $name) Return the first ChildPartner filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByEmail(string $email) Return the first ChildPartner filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByPhone(string $phone) Return the first ChildPartner filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByWebsite(string $website) Return the first ChildPartner filtered by the website column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByFax(string $fax) Return the first ChildPartner filtered by the fax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByImage(string $image) Return the first ChildPartner filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByTaxNumber(string $tax_number) Return the first ChildPartner filtered by the tax_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByRole(string $role) Return the first ChildPartner filtered by the role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByCompanyId(int $company_id) Return the first ChildPartner filtered by the company_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneBySupplierTypeId(int $supplier_type_id) Return the first ChildPartner filtered by the supplier_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByActive(boolean $active) Return the first ChildPartner filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByClassKey(int $class_key) Return the first ChildPartner filtered by the class_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByCreatedAt(string $created_at) Return the first ChildPartner filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartner requireOneByUpdatedAt(string $updated_at) Return the first ChildPartner filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartner[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPartner objects based on current ModelCriteria
 * @method     ChildPartner[]|ObjectCollection findById(int $id) Return ChildPartner objects filtered by the id column
 * @method     ChildPartner[]|ObjectCollection findByName(string $name) Return ChildPartner objects filtered by the name column
 * @method     ChildPartner[]|ObjectCollection findByEmail(string $email) Return ChildPartner objects filtered by the email column
 * @method     ChildPartner[]|ObjectCollection findByPhone(string $phone) Return ChildPartner objects filtered by the phone column
 * @method     ChildPartner[]|ObjectCollection findByWebsite(string $website) Return ChildPartner objects filtered by the website column
 * @method     ChildPartner[]|ObjectCollection findByFax(string $fax) Return ChildPartner objects filtered by the fax column
 * @method     ChildPartner[]|ObjectCollection findByImage(string $image) Return ChildPartner objects filtered by the image column
 * @method     ChildPartner[]|ObjectCollection findByTaxNumber(string $tax_number) Return ChildPartner objects filtered by the tax_number column
 * @method     ChildPartner[]|ObjectCollection findByRole(string $role) Return ChildPartner objects filtered by the role column
 * @method     ChildPartner[]|ObjectCollection findByCompanyId(int $company_id) Return ChildPartner objects filtered by the company_id column
 * @method     ChildPartner[]|ObjectCollection findBySupplierTypeId(int $supplier_type_id) Return ChildPartner objects filtered by the supplier_type_id column
 * @method     ChildPartner[]|ObjectCollection findByActive(boolean $active) Return ChildPartner objects filtered by the active column
 * @method     ChildPartner[]|ObjectCollection findByClassKey(int $class_key) Return ChildPartner objects filtered by the class_key column
 * @method     ChildPartner[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPartner objects filtered by the created_at column
 * @method     ChildPartner[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPartner objects filtered by the updated_at column
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
        $sql = 'SELECT id, name, email, phone, website, fax, image, tax_number, role, company_id, supplier_type_id, active, class_key, created_at, updated_at FROM partner WHERE id = :p0';
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
            $cls = PartnerTableMap::getOMClass($row, 0, false);
            /** @var ChildPartner $obj */
            $obj = new $cls();
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
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_EMAIL, $email, $comparison);
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
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%', Criteria::LIKE); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_ROLE, $role, $comparison);
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
     * @see       filterByCompany()
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
     * Filter the query on the supplier_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySupplierTypeId(1234); // WHERE supplier_type_id = 1234
     * $query->filterBySupplierTypeId(array(12, 34)); // WHERE supplier_type_id IN (12, 34)
     * $query->filterBySupplierTypeId(array('min' => 12)); // WHERE supplier_type_id > 12
     * </code>
     *
     * @see       filterBySupplierType()
     *
     * @param     mixed $supplierTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterBySupplierTypeId($supplierTypeId = null, $comparison = null)
    {
        if (is_array($supplierTypeId)) {
            $useMinMax = false;
            if (isset($supplierTypeId['min'])) {
                $this->addUsingAlias(PartnerTableMap::COL_SUPPLIER_TYPE_ID, $supplierTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($supplierTypeId['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_SUPPLIER_TYPE_ID, $supplierTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_SUPPLIER_TYPE_ID, $supplierTypeId, $comparison);
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PartnerTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the class_key column
     *
     * Example usage:
     * <code>
     * $query->filterByClassKey(1234); // WHERE class_key = 1234
     * $query->filterByClassKey(array(12, 34)); // WHERE class_key IN (12, 34)
     * $query->filterByClassKey(array('min' => 12)); // WHERE class_key > 12
     * </code>
     *
     * @param     mixed $classKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByClassKey($classKey = null, $comparison = null)
    {
        if (is_array($classKey)) {
            $useMinMax = false;
            if (isset($classKey['min'])) {
                $this->addUsingAlias(PartnerTableMap::COL_CLASS_KEY, $classKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($classKey['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_CLASS_KEY, $classKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_CLASS_KEY, $classKey, $comparison);
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartnerTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByCompany($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_COMPANY_ID, $partner->getId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnerTableMap::COL_COMPANY_ID, $partner->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \Partner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinCompany($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

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
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation Partner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\PartnerQuery');
    }

    /**
     * Filter the query by a related \SupplierType object
     *
     * @param \SupplierType|ObjectCollection $supplierType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterBySupplierType($supplierType, $comparison = null)
    {
        if ($supplierType instanceof \SupplierType) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_SUPPLIER_TYPE_ID, $supplierType->getId(), $comparison);
        } elseif ($supplierType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartnerTableMap::COL_SUPPLIER_TYPE_ID, $supplierType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySupplierType() only accepts arguments of type \SupplierType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SupplierType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinSupplierType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SupplierType');

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
            $this->addJoinObject($join, 'SupplierType');
        }

        return $this;
    }

    /**
     * Use the SupplierType relation SupplierType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SupplierTypeQuery A secondary query class using the current class as primary query
     */
    public function useSupplierTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSupplierType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SupplierType', '\SupplierTypeQuery');
    }

    /**
     * Filter the query by a related \Partner object
     *
     * @param \Partner|ObjectCollection $partner the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPartnerRelatedById($partner, $comparison = null)
    {
        if ($partner instanceof \Partner) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $partner->getCompanyId(), $comparison);
        } elseif ($partner instanceof ObjectCollection) {
            return $this
                ->usePartnerRelatedByIdQuery()
                ->filterByPrimaryKeys($partner->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartnerRelatedById() only accepts arguments of type \Partner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartnerRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinPartnerRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartnerRelatedById');

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
            $this->addJoinObject($join, 'PartnerRelatedById');
        }

        return $this;
    }

    /**
     * Use the PartnerRelatedById relation Partner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerQuery A secondary query class using the current class as primary query
     */
    public function usePartnerRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPartnerRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartnerRelatedById', '\PartnerQuery');
    }

    /**
     * Filter the query by a related \ProductPartner object
     *
     * @param \ProductPartner|ObjectCollection $productPartner the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByProductPartner($productPartner, $comparison = null)
    {
        if ($productPartner instanceof \ProductPartner) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $productPartner->getPartnerId(), $comparison);
        } elseif ($productPartner instanceof ObjectCollection) {
            return $this
                ->useProductPartnerQuery()
                ->filterByPrimaryKeys($productPartner->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProductPartner() only accepts arguments of type \ProductPartner or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductPartner relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinProductPartner($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductPartner');

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
            $this->addJoinObject($join, 'ProductPartner');
        }

        return $this;
    }

    /**
     * Use the ProductPartner relation ProductPartner object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductPartnerQuery A secondary query class using the current class as primary query
     */
    public function useProductPartnerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProductPartner($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductPartner', '\ProductPartnerQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $user->getPartnerId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            return $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \ProformaInvoice object
     *
     * @param \ProformaInvoice|ObjectCollection $proformaInvoice the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByProformaInvoice($proformaInvoice, $comparison = null)
    {
        if ($proformaInvoice instanceof \ProformaInvoice) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $proformaInvoice->getCustomerId(), $comparison);
        } elseif ($proformaInvoice instanceof ObjectCollection) {
            return $this
                ->useProformaInvoiceQuery()
                ->filterByPrimaryKeys($proformaInvoice->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProformaInvoice() only accepts arguments of type \ProformaInvoice or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProformaInvoice relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinProformaInvoice($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProformaInvoice');

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
            $this->addJoinObject($join, 'ProformaInvoice');
        }

        return $this;
    }

    /**
     * Use the ProformaInvoice relation ProformaInvoice object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProformaInvoiceQuery A secondary query class using the current class as primary query
     */
    public function useProformaInvoiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProformaInvoice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProformaInvoice', '\ProformaInvoiceQuery');
    }

    /**
     * Filter the query by a related \PackingList object
     *
     * @param \PackingList|ObjectCollection $packingList the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPackingList($packingList, $comparison = null)
    {
        if ($packingList instanceof \PackingList) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $packingList->getCustomerId(), $comparison);
        } elseif ($packingList instanceof ObjectCollection) {
            return $this
                ->usePackingListQuery()
                ->filterByPrimaryKeys($packingList->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPackingList() only accepts arguments of type \PackingList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PackingList relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinPackingList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PackingList');

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
            $this->addJoinObject($join, 'PackingList');
        }

        return $this;
    }

    /**
     * Use the PackingList relation PackingList object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PackingListQuery A secondary query class using the current class as primary query
     */
    public function usePackingListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPackingList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PackingList', '\PackingListQuery');
    }

    /**
     * Filter the query by a related \PurchaseOrder object
     *
     * @param \PurchaseOrder|ObjectCollection $purchaseOrder the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPurchaseOrder($purchaseOrder, $comparison = null)
    {
        if ($purchaseOrder instanceof \PurchaseOrder) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $purchaseOrder->getSupplierId(), $comparison);
        } elseif ($purchaseOrder instanceof ObjectCollection) {
            return $this
                ->usePurchaseOrderQuery()
                ->filterByPrimaryKeys($purchaseOrder->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPurchaseOrder() only accepts arguments of type \PurchaseOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PurchaseOrder relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinPurchaseOrder($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PurchaseOrder');

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
            $this->addJoinObject($join, 'PurchaseOrder');
        }

        return $this;
    }

    /**
     * Use the PurchaseOrder relation PurchaseOrder object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PurchaseOrderQuery A secondary query class using the current class as primary query
     */
    public function usePurchaseOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPurchaseOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PurchaseOrder', '\PurchaseOrderQuery');
    }

    /**
     * Filter the query by a related \PartnerBank object
     *
     * @param \PartnerBank|ObjectCollection $partnerBank the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPartnerBank($partnerBank, $comparison = null)
    {
        if ($partnerBank instanceof \PartnerBank) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $partnerBank->getPartnerId(), $comparison);
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
     * @return $this|ChildPartnerQuery The current query, for fluid interface
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
     * Filter the query by a related \PartnerLocation object
     *
     * @param \PartnerLocation|ObjectCollection $partnerLocation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPartnerQuery The current query, for fluid interface
     */
    public function filterByPartnerLocation($partnerLocation, $comparison = null)
    {
        if ($partnerLocation instanceof \PartnerLocation) {
            return $this
                ->addUsingAlias(PartnerTableMap::COL_ID, $partnerLocation->getPartnerId(), $comparison);
        } elseif ($partnerLocation instanceof ObjectCollection) {
            return $this
                ->usePartnerLocationQuery()
                ->filterByPrimaryKeys($partnerLocation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartnerLocation() only accepts arguments of type \PartnerLocation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartnerLocation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartnerQuery The current query, for fluid interface
     */
    public function joinPartnerLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartnerLocation');

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
            $this->addJoinObject($join, 'PartnerLocation');
        }

        return $this;
    }

    /**
     * Use the PartnerLocation relation PartnerLocation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartnerLocationQuery A secondary query class using the current class as primary query
     */
    public function usePartnerLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartnerLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartnerLocation', '\PartnerLocationQuery');
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
