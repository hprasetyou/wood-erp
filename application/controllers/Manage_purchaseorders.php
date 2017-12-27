<?php

class Manage_purchaseorders extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('PurchaseOrder');
		$this->tpl = 'purchaseorders';

    $this->authorization->check_authorization('manage_purchaseorders');

  }


  function create(){
		$this->template->render('admin/purchaseorders/form');
  }

  function get_number($pi){
    $this->load->helper('good_numbering');
    $pi = str_replace("PI-","",$pi);
    echo create_number(
        array('format'=>"PO-$pi-i",
        'tb_name'=>'purchase_order',
        'tb_field'=>'name'));
  }

  function detail($id){
    $this->outputstd = 1;
    $polinetotal = PurchaseOrderLineQuery::create()
    ->getTotalPricePerPO()
    ->findOneByPurchaseOrderId($id);
    $this->objobj = PurchaseOrderQuery::create()
    ->joinWith('PurchaseOrder.ProformaInvoice')
    ->joinWith('PurchaseOrder.Supplier')
    ->joinWith('PurchaseOrder.DownPayment')
    ->withColumn((is_null($polinetotal['Total'])?"1*0":$polinetotal['Total']),'SubTotal');

    parent::detail($id);
  }

	function write($id=null){
    $this->form['DownPaymentId'] = 'DownPaymentId';
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
      echo $data->toJSON();
    }else{
      redirect('manage_purchaseorders/detail/'.$data->getId());
    }
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_purchaseorders');
  }

}
