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
    $this->custom_column['currency_code'] = "_{PurchaseOrder}_->getCurrency()->getCode()";
    $this->custom_column['product_id'] = "_{Product}_->getDescription()";
    $this->custom_column['qty'] = "_{Qty}_.\" (\"._{UnitOfMeasure}_->getName().\")\"";
    // $base_currency = "USD";
    // $po = PurchaseOrderQuery::create()->findPk($this->input->get('purchase_order_id'));
    // if($po){
    //   $convert_to = $po->getCurrency()->getCode();
    //   $this->custom_column['price'] = "exchange_rate(_{Price}_,\"$convert_to\",\"$base_currency\")";
    //   $this->custom_column['total_price'] = "exchange_rate(_{TotalPrice}_,\"$convert_to\",\"$base_currency\")";
    // }
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
    $default_cur = 'USD';
    $po_id = $this->input->get('purchase_order');
    $po = PurchaseOrderQuery::create()->findPk($po_id);
		$qty = $this->input->post('PILineQty');
  	$name = $this->input->post('PILineName');
  	$price = $this->input->post('PILinePrice');
    $prods = $this->input->post('ProductId');
    $uom_id = $this->input->post('UomId');
    foreach ($this->input->post('PILineId') as $key => $line) {
      # code...
      $ids = explode("-",$line);
      $prod_id = $ids[1];
      if(isset($prods[$key])){
        $prod_id=$prods[$key];
      }
      //convert price if cur_id not same as default cur_id
      if($po->getCurrency()->getCode()!=$default_cur){
        $price[$key] = exchange_rate($price[$key],$default_cur,$po->getCurrency()->getCode());
        write_log("the price is....".$price[$key]);
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
       'UomId' =>  array(
         'value'=> $uom_id[$key]
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
