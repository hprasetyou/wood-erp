<?php


class Manage_suppliers extends MY_Controller{


  function __construct(){
    $this->objname = 'Supplier';
    $this->tpl = 'suppliers';
    $this->objobj = SupplierQuery::create()
    ->filterByCompanyId(0)
    ->_or()
    ->filterByCompanyId(null);

    parent::__construct();
    $this->form = array(
      'Name'=>'Name',
      'Address'=>'Address',
      'Phone'=>'Phone',
      'Website'=>'Website',
      'Email'=>'Email',
      'Image'=>'Image',
      'Fax'=>'Fax',
      'TaxNumber'=>'TaxNumber',
      'BankDetail'=>'BankDetail',
    );
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
    $data = parent::write($id);
    redirect('manage_suppliers/detail/'.$data->getId());
  }

  function delete($id){
		$dell = parent::delete($id);
		redirect('manage_suppliers/'.($dell->getCompanyId()?"detail/".$dell->getCompanyId():""));
  }

}
