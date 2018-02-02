<?php

class Exchange_rate extends MY_Controller{

  function __construct(){
    parent::__construct();
    $this->objname = 'ExchangeRate';
    $this->tpl = 'exchange_rate';

    // $this->authorization->check_authorization('manage_banks');
  }
  // get latest exchange rate
  function get_latest(){
    $er = ExchangeRateQuery::create()->find_latest();
    echo $er->toJSON();
  }
}
