<?php

use Base\PurchaseOrderLineQuery as BasePurchaseOrderLineQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'purchase_order_line' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PurchaseOrderLineQuery extends BasePurchaseOrderLineQuery
{
  function getTotalPricePerPO(){
    return $this->select('PurchaseOrderId')
    ->withColumn('SUM(PurchaseOrderLine.TotalPrice)','Total')
    ->groupBy('PurchaseOrderId');
  }
}
