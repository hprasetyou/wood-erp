<?php

/**
 *
 */
class Manage_internallocations extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->set_objname('PartnerLocation');
    $this->objobj = PartnerLocationQuery::create()
    ->filterByInternalLocation();
    $this->tpl = "partnerlocations";
  }

  function write($id=null){
    $this->form['Type'] = array("value" => "warehouse");
    $this->form['CountryId'] = "CountryId";
    $this->form['PartnerId'] = array("value" => PartnerQuery::create()
    ->filterByClassKey(1)
    ->findOne()
    ->getId());
    $data = parent::write($id);
    print_r($this->form);
    redirect('manage_internallocations/detail/'.$data->getId());
  }
}
