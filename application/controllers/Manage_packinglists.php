<?php

class Manage_packinglists extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'PackingList';
		$this->tpl = 'packinglists';
    $this->form = array(
     'Name' => 'Name',
     'Date' => 'Date',
     'LoadingDate' => 'LoadingDate',
     'CustomerId' => 'CustomerId',
     'OceanVessel' => 'OceanVessel',
     'SrcLoc' => 'SrcLoc',
     'BlNo' => 'BlNo',
     'GoodsDescription' => 'GoodsDescription',
     'CntrNo' => 'CntrNo',
     'SealNo' => 'SealNo',
     'Pod' => 'Pod',
     'EtdSrg' => 'EtdSrg',
     'RefDoc' => 'RefDoc'
    );
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
    $this->custom_column = array(
      'total_cubic_dimension' =>"function() use(_{PackingListLines}_){
        \$tot = 0;
          foreach(_{PackingListLines}_ as \$line){
            \$tot += \$line->getProformaInvoiceLine()->getCubicDimension()*\$line->getQty();
          }
          return \$tot;
        }"
    );
    parent::get_json();
  }

  function detail($id){

		$partners = PartnerQuery::create()->find();

		$packinglist = PackingListQuery::create()->findPK($id);
		$this->template->render('admin/packinglists/form',array('packinglists'=>$packinglist,
		'partners'=> $partners,
			));
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
		$data = parent::delete($id);
		redirect('manage_packinglists');
  }

}
