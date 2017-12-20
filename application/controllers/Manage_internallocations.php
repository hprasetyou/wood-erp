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
    ->filterByPartnerId(36);
    $this->tpl = "partnerlocations";
  }

  function write($id=null){
    $this->form['Type'] = array("value" => "warehouse");
    $this->form['CountryId'] = "CountryId";
    $this->form['PartnerId'] = array("value" => 36);
    $data = parent::write($id);
    print_r($this->form);
    redirect('manage_internallocations/detail/'.$data->getId());
  }
}
