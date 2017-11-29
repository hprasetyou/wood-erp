<?php

class Manage_purchaseorderlines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'PurchaseOrderLine';
		$this->tpl = 'purchaseorderlines';
  }


  function create(){

		$proforma_invoice_lines = ProformaInvoiceLineQuery::create()->find();

		$products = ProductQuery::create()->find();

		$components = ComponentQuery::create()->find();

		$this->template->render('admin/purchaseorderlines/form',array(
		'proforma_invoice_lines'=> $proforma_invoice_lines,

		'products'=> $products,

		'components'=> $components,
			));
  }

  function detail($id){

		$proforma_invoice_lines = ProformaInvoiceLineQuery::create()->find();

		$products = ProductQuery::create()->find();

		$components = ComponentQuery::create()->find();

		$purchaseorderline = PurchaseOrderLineQuery::create()->findPK($id);
		$this->template->render('admin/purchaseorderlines/form',array('purchaseorderlines'=>$purchaseorderline,
		'proforma_invoice_lines'=> $proforma_invoice_lines,

		'products'=> $products,

		'components'=> $components,
			));
  }

	function write($id=null){
		print_r($this->input->post('PILineId'));
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_purchaseorderlines');
  }

}
