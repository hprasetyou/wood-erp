<?php

class Manage_productpartners extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'ProductPartner';
		$this->tpl = 'productpartners';
    $this->form = array(
     'Name' => 'Name',
     'PartnerId' => 'PartnerId',
     'ProductId' => 'ProductId',
     'ProductPrice' => 'ProductPrice',
     'Description' => 'Description',
    );
    $this->authorization->check_authorization('manage_productpartners');
  }

  function create(){
		$this->template->render('admin/productpartners/form');
  }

  function detail($id){
		$productpartner = ProductPartnerQuery::create()->findPK($id);
		$this->template->render('admin/productpartners/form',array('productpartners'=>$productpartner,
			));
  }

	function write($id=null){
		$data = parent::write($id);
		redirect('manage_productpartners/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_productpartners');
  }

}
