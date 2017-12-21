<?php

use Base\PurchaseOrderLine as BasePurchaseOrderLine;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a row from the 'purchase_order_line' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class PurchaseOrderLine extends BasePurchaseOrderLine
{
  public function save(ConnectionInterface $con = null){
    //set TotalPrice
    $this->setTotalPrice($this->getPrice()*$this->getQty());
    parent::save();
    $this->updateTotalPriceParent($this->getPurchaseOrderId());
  }

  private function updateTotalPriceParent($purchase_order_id){
    //find total price for all po line
    $polinetotal = PurchaseOrderLineQuery::create()
    ->getTotalPricePerPO()
    ->findOneByPurchaseOrderId($purchase_order_id);
    //set total price for purchase order
    $po = PurchaseOrderQuery::create()->findPk($purchase_order_id);
    $po->setTotalPrice($polinetotal['Total'])->save();
  }

  public function delete(ConnectionInterface $con = null){
    $purchase_order_id = $this->getPurchaseOrderId();
    parent::delete();
    $this->updateTotalPriceParent($purchase_order_id);

  }

}
