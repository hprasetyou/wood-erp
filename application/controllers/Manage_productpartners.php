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
    $this->authorization->check_authorization('manage_products');
  }

  function get_json(){
    $componentproducts = ComponentProductQuery::create()
    ->findByProductId($this->input->get('product_id'));
    $components = [$this->input->get('product_id')];
    foreach ($componentproducts as $key => $value) {
      $components[] = $value->getComponentId();
    }
    if($this->input->get('type')=='buy' ){
      $latest_price_ids = ProductPartnerQuery::create()
      ->select(array('PartnerId'))
      ->withColumn('MAX(id)','Id')
      ->groupBy(array('partner_id'))
      ->filterByProductId($components)
      ->filterByType('buy')
      ->find();
      $price_ids = [];
      foreach ($latest_price_ids as $price_id) {
        # code...
        $price_ids[] = $price_id['Id'];
      }
      $this->objobj = ProductPartnerQuery::create()
      ->filterById($price_ids)
      ->join('Product')
      ->join('Partner')
      ->withColumn('Product.Description','object')
      ->withColumn('Partner.Name','partner_name');
      $this->custom_column = array(
        'partner_name'=>'_{partner_name}_',
        'object'=>'_{object}_',
        'price'=>'_{ProductPrice}_'
      );
    }
    parent::get_json();
  }

  function create(){
		$this->template->render('admin/productpartners/form',array(
      'product'=> ProductQuery::create()
      ->findPk($this->input->get('products'))
    ));
  }

  function get_price_history(){
    $component_id = $this->input->get('product_id');
    $supplier_id = $this->input->get('supplier_id');
    echo ProductPartnerQuery::create()
    ->filterByProductId($component_id)
    ->filterByPartnerId($supplier_id)
    ->filterByType('buy')
    ->find()->toJSON();
  }

  function detail($id){
		$productpartner = ProductPartnerQuery::create()->findPK($id);
		$this->template->render('admin/productpartners/form',array('productpartners'=>$productpartner,
			));
  }

	function write($id=null){
    $this->form['type'] = array('value'=>'buy');
		$data = parent::write($id);
		redirect('manage_productpartners/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_productpartners');
  }

}
