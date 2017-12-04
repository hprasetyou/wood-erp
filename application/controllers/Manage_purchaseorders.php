<?php

class Manage_purchaseorders extends MY_Controller{


  function __construct(){
    parent::__construct();
    $this->form = array(
     'Name' => 'Name',
     'ProformaInvoiceId' => 'ProformaInvoiceId',
     'SupplierId' => 'SupplierId',
     'Note' => 'Note',
     'Date' => 'Date',
     'PaymentTerm' => 'PaymentTerm',
     'ShipmentTerm' => 'ShipmentTerm',
     'PackingType' => 'PackingType',
     'DownPayment' => 'DownPayment',
     'DownPaymentDeadline' => 'DownPaymentDeadline',
     'TotalPrice' => 'TotalPrice',
    );
		$this->objname = 'PurchaseOrder';
		$this->tpl = 'purchaseorders';

    $this->authorization->check_authorization('manage_purchaseorders');

  }


  function create(){
		$this->template->render('admin/purchaseorders/form');
  }

  function get_number($pi){
    $this->load->helper('good_numbering');
    echo create_number(
        array('format'=>"PO $pi-i",
        'tb_name'=>'purchase_order',
        'tb_field'=>'name'));
  }

  function detail($id){

		$proforma_invoices = ProformaInvoiceQuery::create()->find();

		$partners = PartnerQuery::create()->find();

		$purchaseorder = PurchaseOrderQuery::create()->findPK($id);
		$this->template->render('admin/purchaseorders/form',array('purchaseorders'=>$purchaseorder,
		'proforma_invoices'=> $proforma_invoices,

		'partners'=> $partners,
			));
  }

	function write($id=null){
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
