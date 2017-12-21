<?php

class Manage_partnerlocations extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('PartnerLocation');
		$this->tpl = 'partnerlocations';
  }

  function get_json(){
    if($this->input->get('partner_id')){
      $this->objobj = PartnerLocationQuery::create()
      ->filterByPartnerId($this->input->get('partner_id'));
    }
    if($this->input->get('type')){
        $this->objobj = PartnerLocationQuery::create()
        ->ownerType($this->input->get('type'));
    }
    parent::get_json();
  }

  function create(){
		$this->template->render('admin/partnerlocations/form');
  }

  function detail($id){
		$partnerlocation = PartnerLocationQuery::create()->findPK($id);
		$this->template->render('admin/partnerlocations/form',array('partnerlocations'=>$partnerlocation));
  }

	function write($id=null){
    $this->form['CountryId'] = 'CountryId';
    if(!$id){
      $this->form['PartnerId'] = 'PartnerId';
    }
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
			echo $data->toJSON();
		}else{
      $src = $this->input->post('Src');
      $partner_id = $this->input->post('PartnerId');
      if($src){
        redirect("manage_$src/detail/$partner_id");
      }
      redirect("manage_partnerlocations/detail/$id");
		}
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_partnerlocations');
  }

}
