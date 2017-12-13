<?php

class Manage_purchaseorderlines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'PurchaseOrderLine';
		$this->tpl = 'purchaseorderlines';
  }

  function get_json(){
		$this->objobj = PurchaseOrderLineQuery::create()
    ->filterByPurchaseOrderId($this->input->get('purchase_order_id'));
    parent::get_json();
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
		$qty = $this->input->post('PILineQty');
  	$name = $this->input->post('PILineName');
  	$price = $this->input->post('PILinePrice');

    foreach ($this->input->post('PILineId') as $key => $line) {
      # code...
      $ids = explode("-",$line);
      $pp = ProductPartnerQuery::create()
      ->orderByCreatedAt('desc')
      ->filterByProductId(isset($ids[2])?$ids[1]:$ids[1])
      ->filterByPartnerId($this->input->post('PartnerId'))
      ->filterByType("buy")
      ->findOne();
      if(($pp?$pp->getProductPrice():1) != $price[$key]){
        $newpp = new ProductPartner;
        $newpp->setProductId(isset($ids[2])?$ids[1]:$ids[1])
        ->setPartnerId($this->input->post('PartnerId'))
        ->setProductPrice($price[$key])
        ->setType("buy")
        ->save();
      }
      $line = PurchaseOrderLineQuery::create()
      ->filterByName($name[$key])
      ->filterByPurchaseOrderId($po_id)
      ->filterByProformaInvoiceLineId($ids[0])
      ->filterByProductId($ids[1])
      ->filterByComponentId((isset($ids[2])?$ids[2]:null))
      ->findOne();
      if($line){
        $qty[$key] = $qty[$key]+$line->getQty();
      }
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
      $data = parent::write($line?$line->getId():null);
    }
    echo json_encode(array('status'=>'ok'));
	}

  function delete($id){
		$data = parent::delete($id);
    echo json_encode(array('status'=>'ok'));
  }

}
