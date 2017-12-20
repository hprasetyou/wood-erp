<?php

class Manage_stockmovelines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'StockMoveLine';
		$this->tpl = 'stockmovelines';

    $this->authorization->check_authorization('manage_stockmoves');
  }

  function get_json(){
    $this->objobj = StockMoveLineQuery::create()
    ->filterByStockMoveId($this->input->get('stock_move'));
    parent::get_json();
  }

  function create(){
		$this->template->render('admin/stockmovelines/form');
  }

  function detail($id){
		$stockmoveline = StockMoveLineQuery::create()->findPK($id);
		$this->template->render('admin/stockmovelines/form',array('stockmovelines'=>$stockmoveline));
  }

	function write($id=null){
		$this->form = array(
     'Name' => 'Name',
     'ProductId' => 'ProductId',
     'StockMoveId' => 'MoveId',
     'Qty' => 'Qty',
    );
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
			echo $data->toJSON();
		}else{
			redirect('manage_stockmovelines/detail/'.$data->getId());
		}
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_stockmovelines');
  }

}
