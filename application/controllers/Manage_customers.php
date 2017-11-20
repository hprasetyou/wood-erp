<?php


class Manage_customers extends MY_Controller{


  function __construct(){
    $this->objname = 'Partner';
    $this->tpl = 'customers';
    $this->objobj = PartnerQuery::create()->filterByIsCustomer(true);
    parent::__construct();
    $this->authorization->check_authorization('manage_customers');
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
    'CompanyId'=>'CompanyId'
  )){
    $data = parent::write($id,$fields);
    if($this->input->post('Image')){
      if(strpos($this->input->post('Image'),'base64')){
        $this->load->helper('base64toimage');
        $data->setImage(base64_to_img($this->input->post('Image')));
      }
    }
    redirect('manage_customers/detail/'.$data->getId());
  }

  function delete($id){
		$dell = parent::delete($id);
		redirect('manage_customers/'.($dell->getCompanyId()?"detail/".$dell->getCompanyId():""));
  }

}
