<?php

use Base\ProformaInvoice as BaseProformaInvoice;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Connection\ConnectionInterface;
use \ProformaInvoiceLineQuery as ChildProformaInvoiceLineQuery;

/**
 * Skeleton subclass for representing a row from the 'proforma_invoice' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ProformaInvoice extends BaseProformaInvoice
{
  public function getProformaInvoiceLines(Criteria $criteria = null, ConnectionInterface $con = null)
  {
      $partial = $this->collProformaInvoiceLinesPartial && !$this->isNew();
      if (null === $this->collProformaInvoiceLines || null !== $criteria  || $partial) {
          if ($this->isNew() && null === $this->collProformaInvoiceLines) {
              // return empty collection
              $this->initProformaInvoiceLines();
          } else {
              $collProformaInvoiceLines = ChildProformaInvoiceLineQuery::create(null, $criteria)
                  ->filterByProformaInvoice($this)
                  ->filterByActive(true)
                  ->find($con);

              if (null !== $criteria) {
                  if (false !== $this->collProformaInvoiceLinesPartial && count($collProformaInvoiceLines)) {
                      $this->initProformaInvoiceLines(false);

                      foreach ($collProformaInvoiceLines as $obj) {
                          if (false == $this->collProformaInvoiceLines->contains($obj)) {
                              $this->collProformaInvoiceLines->append($obj);
                          }
                      }

                      $this->collProformaInvoiceLinesPartial = true;
                  }

                  return $collProformaInvoiceLines;
              }

              if ($partial && $this->collProformaInvoiceLines) {
                  foreach ($this->collProformaInvoiceLines as $obj) {
                      if ($obj->isNew()) {
                          $collProformaInvoiceLines[] = $obj;
                      }
                  }
              }

              $this->collProformaInvoiceLines = $collProformaInvoiceLines;
              $this->collProformaInvoiceLinesPartial = false;
          }
      }

      return $this->collProformaInvoiceLines;
  }
}
