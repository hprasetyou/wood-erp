<?php

class Manage_productstocks extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('ProductStock');
		$this->tpl = 'productstocks';

    $this->authorization->check_authorization('manage_productstocks');
  }

	function get_json(){
		$this->custom_column = array(
			'product_desc' =>"_{Product}_->getDescription()",
			'partner_location_id' =>"_{PartnerLocation}_->getName().' - '._{PartnerLocation}_->getDescription()"
		);
		parent::get_json();
	}

	function write($id=null){
		$this->form['PartnerLocationId'] = 'PartnerLocationId';
		$this->form['ProductId'] = 'ProductId';

		$data = parent::write($id);
    if($this->input->is_ajax_request()){
			echo $data->toJSON();
		}else{
			redirect('manage_productstocks/detail/'.$data->getId());
		}
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_productstocks');
  }

}
    