<?php


class Manage_customers extends MY_Controller{


  function __construct(){
    $this->objname = 'Partner';
    $this->tpl = 'customers';
    $this->objobj = PartnerQuery::create()
    ->filterByIsCustomer(true)
    ->filterByCompanyId(0)
    ->_or()
    ->filterByCompanyId(null);
    parent::__construct();
    $this->authorization->check_authorization('manage_customers');
  }

  function get_json(){
    if($this->input->get('company_id')){
      $this->objobj = PartnerQuery::create()->filterByCompanyId($this->input->get('company_id'));
    }
    parent::get_json();
  }

  function write($id=null,$fields=array(
    'Name'=>'Name',
    'Address'=>'Address',
    'Phone'=>'Phone',
    'Website'=>'Website',
    'Email'=>'Email',
    'Image'=>'Image',
    'Fax'=>'Fax',
    'TaxNumber'=>'TaxNumber',
    'BankDetail'=>'BankDetail',
    'CompanyId'=>'CompanyId',
    'IsCustomer'=>array('value'=>1)
  )){
    $data = parent::write($id,$fields);
    redirect('manage_customers/detail/'.$data->getId());
  }

  function delete($id){
		$dell = parent::delete($id);
		redirect('manage_customers/'.($dell->getCompanyId()?"detail/".$dell->getCompanyId():""));
  }

}
