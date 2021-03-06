<?php

use Base\PackingList as BasePackingList;

/**
 * Skeleton subclass for representing a row from the 'packing_list' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PackingList extends BasePackingList
{
  function getProformaInvoices(){
    $pl = $this;
    $pi_ids = [];
    foreach ($pl->getPackingListLines() as $key => $value) {
      # code...
      $pi_ids[] = $value->getProformaInvoiceLine()->getProformaInvoiceId();
    }
    write_log(json_encode($pi_ids));
    return ProformaInvoiceQuery::create()->findById($pi_ids);
  }
}
