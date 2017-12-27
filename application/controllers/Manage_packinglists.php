<?php

class Manage_packinglists extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('PackingList');
		$this->tpl = 'packinglists';
    $this->authorization->check_authorization('manage_packinglists');
  }


  function create(){
    $this->load->helper('good_numbering');
		$partners = PartnerQuery::create()->find();

		$this->template->render('admin/packinglists/form',array(
		'partners'=> $partners,
    'code' => create_number(
        array('format'=>'PL-i-y-m',
        'tb_name'=>'packing_list',
        'tb_field'=>'name'))
			));
  }

  function get_json(){
    $this->objobj = PackingListQuery::create()
    ->filterByState('delete', '!=');
    $this->custom_column = array(
      'shipping' =>"string(_{Shipping}_)"
    );
    parent::get_json();
  }

  function detail($id,$render="html"){
		$packinglist = PackingListQuery::create()->findPK($id);
    if($this->input->is_ajax_request()){
      echo $packinglist->toJSON();
    }else{
      $this->template->render('admin/packinglists/form',array('packinglists'=>$packinglist,'pi'=>$packinglist->getProformaInvoices()	));
    }
  }

	function write($id=null){
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
        echo $data->toJSON();
    }else{
		    redirect('manage_packinglists/detail/'.$data->getId());
    }
	}

  function delete($id){
    PackingListQuery::create()->findPk($id)
    ->setState('delete')
    ->save();
    redirect('manage_packinglists');
  }

}
