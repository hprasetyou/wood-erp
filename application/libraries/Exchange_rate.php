<?php

/**
 *
 */
class Exchange_rate
{

  function get_update(){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,"https://api.fixer.io/latest?base=USD");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $output=curl_exec($ch);
    curl_close($ch);
    $output = json_decode($output);
    $erlist = array('IDR','EUR');
    foreach ($erlist as $key => $value) {
      $rate = ExchangeRateQuery::create()
      ->filterByBase("USD")
      ->filterByTarget($value)
      ->filterByCreatedAt(
        array('min'=>date('Y-m-d 00:00:00')));
      if($rate->count()<1){
        $rate = new ExchangeRate();
        $rate->setBase('USD')
        ->setName("USD $value")
        ->setTarget($value)
        ->setRate($output->rates->$value)
        ->save();
      }
    }
    return true;
  }
}
