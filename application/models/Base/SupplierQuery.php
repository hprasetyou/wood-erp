<?php

namespace Base;

use Map\PartnerTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a query for one of the subclasses of the 'partner' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class SupplierQuery extends PartnerQuery
{

    /**
     * Returns a new \SupplierQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return \SupplierQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof \SupplierQuery) {
            return $criteria;
        }
        $query = new \SupplierQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Filters the query to target only Supplier objects.
     */
    public function preSelect(ConnectionInterface $con)
    {
        $this->addUsingAlias(PartnerTableMap::COL_CLASS_KEY, PartnerTableMap::CLASSKEY_4);
    }

    /**
     * Filters the query to target only Supplier objects.
     */
    public function preUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false)
    {
        $this->addUsingAlias(PartnerTableMap::COL_CLASS_KEY, PartnerTableMap::CLASSKEY_4);
    }

    /**
     * Filters the query to target only Supplier objects.
     */
    public function preDelete(ConnectionInterface $con)
    {
        $this->addUsingAlias(PartnerTableMap::COL_CLASS_KEY, PartnerTableMap::CLASSKEY_4);
    }

    /**
     * Issue a DELETE query based on the current ModelCriteria deleting all rows in the table
     * Having the Supplier class.
     * This method is called by ModelCriteria::deleteAll() inside a transaction
     *
     * @param ConnectionInterface $con a connection object
     *
     * @return integer the number of deleted rows
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        // condition on class key is already added in preDelete()
        return parent::delete($con);
    }

} // SupplierQuery
