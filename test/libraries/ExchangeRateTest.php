<?php


class ExchangeRateTest extends \PHPUnit_Framework_TestCase
{
  public function testGetUpdate()
  {
    include('./application/libraries/Database_connection.php');
    $conn = new Database_connection();
    $conn->connect();

    //check number of exchange rate in db
    $rateall = ExchangeRateQuery::create()->count();

    $ratetoday = ExchangeRateQuery::create()
    ->filterByBase("USD")
    ->filterByTarget(array("IDR","EUR"))
    ->filterByCreatedAt(
      array('min'=>date('Y-m-d 00:00:00')));

    include('./application/libraries/Exchange_rate.php');
    //library
    $er = new Exchange_rate();
    //get new rate after checking exchannge rate
    $newrate = ExchangeRateQuery::create()->count();
    if($ratetoday->count()<1){
      //not grabbed before, so number of exchange rate in db must have new value
      $this->assertTrue($newrate>$rateall);
    }else{
      $this->assertTrue($newrate==$rateall);
    }
    $this->assertTrue($er->get_update());
  }
}
