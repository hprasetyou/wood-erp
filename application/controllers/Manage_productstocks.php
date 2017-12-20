<?php

class Manage_productstocks extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'ProductStock';
		$this->tpl = 'productstocks';

    $this->authorization->check_authorization('manage_productstocks');
  }

  // function get_json(){
  //   $this->objname = 'PartnerLocation';
  //   $this->objobj = PartnerLocationQuery::create()
  //   ->join('SUM()')
  //   ->select('PartnerLocation.Id')
  //   ->withColumn('')
  //   ->filterByPartnerId(36);
  //   echo $this->objobj->find()->toJSON();
  //   // parent::get_json();
  // }


}
