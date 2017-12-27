<?php

class Manage_stockmoves extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'StockMove';
		$this->tpl = 'stockmoves';

    $this->authorization->check_authorization('manage_stockmoves');
  }


  function create(){
		$this->template->render('admin/stockmoves/form');
  }


	function write($id=null){
		$this->form = array(
 'Name' => 'Name',
 'SrcId' => 'SrcId',
 'DestId' => 'DestId',
 'Operation' => 'Operation',
 'State' => 'State',
);
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
			echo $data->toJSON();
		}else{
			redirect('manage_stockmoves/detail/'.$data->getId());
		}
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_stockmoves');
  }

}
