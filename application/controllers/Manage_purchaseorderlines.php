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
    $this->custom_column['product_id'] = "_{Product}_->getDescription()";
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


	function write($id=null){
    $po_id = $this->input->get('purchase_order');
		$qty = $this->input->post('PILineQty');
  	$name = $this->input->post('PILineName');
  	$price = $this->input->post('PILinePrice');
    $prods = $this->input->post('ProductId');

    foreach ($this->input->post('PILineId') as $key => $line) {
      # code...
      $ids = explode("-",$line);
      $prod_id = $ids[1];
      if(isset($prods[$key])){
        $prod_id=$prods[$key];
      }
      $pp = ProductPartnerQuery::create()
      ->orderByCreatedAt('desc')
      ->filterByProductId($prod_id)
      ->filterByPartnerId($this->input->post('PartnerId'))
      ->filterByType("buy")
      ->findOne();
      if(($pp?$pp->getProductPrice():1) !== $price[$key]){
        $newpp = new ProductPartner;
        $newpp->setProductId($prod_id)
        ->setPartnerId($this->input->post('PartnerId'))
        ->setProductPrice($price[$key])
        ->setType("buy")
        ->save();
      }
      $line = PurchaseOrderLineQuery::create()
      ->filterByName($name[$key])
      ->filterByPurchaseOrderId($po_id)
      ->filterByProformaInvoiceLineId($ids[0])
      ->filterByProductId($prod_id)
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
         'value'=> ($prod_id)
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
