<?php


class Manage_customers extends MY_Controller{


  function __construct(){
    $this->tpl = 'customers';

    $this->objobj = CustomerQuery::create()
    ->filterByCompanyId(0)
    ->_or()
    ->filterByCompanyId(null);

    parent::__construct();
    $this->set_objname('Customer');

    $this->authorization->check_authorization('manage_customers');
  }

  function get_json(){
    if($this->input->get('company_id')){
      $this->objobj = PartnerQuery::create()->filterByCompanyId($this->input->get('company_id'));
    }
    parent::get_json();
  }

  function write($id=null){
    if(!$id){
      $this->form['CompanyId']='CompanyId';
    }
    //multiple email and phone, separated by commas
    $this->form['Phone'] = array('value'=>implode($this->input->post('Phone'),', '));
    $this->form['Email'] = array('value'=>implode($this->input->post('Email'),', '));
    $data = parent::write($id);
    redirect('manage_customers/detail/'.$data->getId());
  }

  function delete($id){
		$dell = parent::delete($id);
		redirect('manage_customers/'.($dell->getCompanyId()?"detail/".$dell->getCompanyId():""));
  }

}
