<?php


class Manage_suppliers extends MY_Controller{


  function __construct(){
    $this->tpl = 'suppliers';
    $this->objobj = SupplierQuery::create()
    ->filterByCompanyId(0)
    ->_or()
    ->filterByCompanyId(null);

    parent::__construct();
    $this->set_objname('Supplier');
    $this->authorization->check_authorization('manage_suppliers');
  }

  function get_json(){
    if($this->input->get('company_id')){
      $this->objobj = SupplierQuery::create()->filterByCompanyId($this->input->get('company_id'));
    }
    parent::get_json();
  }

  function write($id=null){
    if(!$id){
      $this->form['CompanyId']='CompanyId';
    }
    $this->form['Phone'] = array('value'=>implode($this->input->post('Phone'),', '));
    $this->form['Email'] = array('value'=>implode($this->input->post('Email'),', '));
    $data = parent::write($id);
    redirect('manage_suppliers/detail/'.$data->getId());
  }

  function delete($id){
		$dell = parent::delete($id);
		redirect('manage_suppliers/'.($dell->getCompanyId()?"detail/".$dell->getCompanyId():""));
  }

}
