<?php

use Base\ExchangeRateQuery as BaseExchangeRateQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'exchange_rate' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ExchangeRateQuery extends BaseExchangeRateQuery
{
  function find_latest(){
    $latest = ExchangeRateQuery::create()
    ->select(array('Base','Target'))
    ->groupBy('Base')
    ->groupBy('Target')
    ->withColumn('MAX(ExchangeRate.Id)','Id')->find();
    $ids = [];
    foreach ($latest as $key => $value) {
      # code...
      $ids[] = $value['Id'];
    }
    return ExchangeRateQuery::create()
    ->addJoin('ExchangeRate.Target','currency.code')
    ->withColumn('currency.Rounding','Rounding')
    ->withColumn('currency.Symbol','Symbol')->findById($ids);
  }
}
