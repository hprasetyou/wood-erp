<?php

use Base\ProductPartnerQuery as BaseProductPartnerQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'product_partner' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ProductPartnerQuery extends BaseProductPartnerQuery
{
  function get_latest_supplier_price(){
    $o = $this->orderByCreatedAt('desc')
    ->findOne();
    return $o?$o->getProductPrice():0;
  }
}
