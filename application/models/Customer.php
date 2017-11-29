<?php

use \Partner;
use Map\PartnerTableMap;


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'partner' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Customer extends Partner
{

    /**
     * Constructs a new Customer class, setting the class_key column to PartnerTableMap::CLASSKEY_3.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(PartnerTableMap::CLASSKEY_3);
    }

} // Customer
