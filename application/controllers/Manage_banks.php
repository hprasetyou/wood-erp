<?php

class Manage_banks extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'Bank';
		$this->tpl = 'banks';

    // $this->authorization->check_authorization('manage_banks');
  }


  function create(){
		$this->template->render('admin/banks/form');
  }

  function detail($id){
		$bank = BankQuery::create()->findPK($id);
		$this->template->render('admin/banks/form',array('banks'=>$bank));
  }

	function write($id=null){
		$this->form = array(
 'Name' => 'Name',
 'CodeName' => 'CodeName',
);
		$data = parent::write($id);
		redirect('manage_banks/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_banks');
  }

}
