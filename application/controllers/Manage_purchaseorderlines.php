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
    $po_id = $this->input->get('purchase_order');
		$qty = $this->input->post('PILineId');
  	$name = $this->input->post('PILineName');
  	$price = $this->input->post('PILinePrice');
    foreach ($this->input->post('PILineId') as $key => $line) {
      # code...
      $ids = explode("-",$line);
      $this->form = array(
       'Name' => array(
         'value'=>$name[$key]
       ),
       'PurchaseOrderId' =>  array(
         'value'=> $po_id
       ),
       'ProformaInvoiceLineId'  =>  array(
         'value'=> $ids[0]
       ),
       'ProductId' =>  array(
         'value'=> $ids[1]
       ),
       'ComponentId'  =>  array(
         'value'=> (isset($ids[2])?$ids[2]:null)
       ),
       'Note' => 'Note',
       'Price' => array(
         'value'=> $price[$key]
       ),
       'Qty' => array(
         'value'=> $qty[$key]
       ),
      );
      $data = parent::write();
      write_log("pl line $data saved . . . . .");
    }
    echo json_encode(array('status'=>'ok'));
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_purchaseorderlines');
  }

}
