<?php

use Base\PartnerLocationQuery as BasePartnerLocationQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'partner_location' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PartnerLocationQuery extends BasePartnerLocationQuery
{
  public function ownerType($type)
  {
    $key = 4;
    switch ($type) {
      case 'Internal':
        $key = 2;
        break;
      case 'Customer':
        $key = 3;
        break;

      default:
        # code...
        break;
    }
      return $this->usePartnerQuery()
      ->where('partner.class_key = ?',$key)
      ->endUse();
  }
  public function filterByInternalLocation(){
    return $this->usePartnerQuery()
      ->filterByClassKey(1)
    ->endUse();
  }
}
