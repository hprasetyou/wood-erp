<?php

class Manage_partnerbanks extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'PartnerBank';
		$this->tpl = 'partnerbanks';
    $this->set_objname('PartnerBank');
    // $this->authorization->check_authorization('manage_partnerbanks');
  }

  function get_json(){
    $this->objobj = PartnerBankQuery::create()->filterByPartnerId($this->input->get('partner_id'));
    parent::get_json();
  }

  function create(){
		$this->template->render('admin/partnerbanks/form');
  }

  function detail($id){
		$partnerbank = PartnerBankQuery::create()->findPK($id);
		$this->template->render('admin/partnerbanks/form',array('partnerbanks'=>$partnerbank));
  }

	function write($id=null){
    //because these are related so not set auomatically
    $this->form['BankId'] = 'BankId';
    $this->form['PartnerId'] = 'PartnerId';
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
      echo $data->toJSON();
    }else{
    	redirect('manage_'.$this->input->post('Src').'/detail/'.$this->input->post('PartnerId'));
    }
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_partnerbanks');
  }

}
