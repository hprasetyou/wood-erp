<?php

class Manage_componentpartners extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'ComponentPartner';
		$this->tpl = 'componentpartners';

    $this->authorization->check_authorization('manage_products');
  }

  function get_json(){

    if($this->input->get('product_id')){
      $latest_price_ids = ComponentPartnerQuery::create()
      ->select(array('ComponentId'))
      ->withColumn('MAX(id)','Id')
      ->groupBy(array('component_id','partner_id'))
      ->filterByComponentId(
        $this->get_avail_cmp($this->input->get('product_id')))->find();
      $price_ids = [];
      foreach ($latest_price_ids as $price_id) {
        # code...
        $price_ids[] = $price_id['Id'];
      }
      $this->objobj = ComponentPartnerQuery::create()
      ->filterById($price_ids)
      ->join('Component')
      ->join('Partner')
      ->withColumn('Component.Name','object')
      ->withColumn('Partner.Name','partner_name');
      $this->custom_column = array(
        'partner_name'=>'_{partner_name}_',
        'object'=>'_{object}_'
      );
    }
    parent::get_json();
  }

  function get_price_history(){
    $component_id = $this->input->get('component_id');
    $supplier_id = $this->input->get('supplier_id');
    echo ComponentPartnerQuery::create()
    ->filterByComponentId($component_id)
    ->filterByPartnerId($supplier_id)
    ->find()->toJSON();
  }

  private function get_avail_cmp($product_id){
    $availcmp = [];
    foreach (ProductComponentQuery::create()
    ->findByProductId($product_id) as $key => $value) {
      # code...
      $availcmp[] = $value->getComponentId();
    }
    return $availcmp;
  }
  function create(){
    $availcmp = [];
    if($this->input->get('products')){
      $availcmp = $this->get_avail_cmp($this->input->get('products'));
    }
		$this->template->render('admin/componentpartners/form',array(
      'availcmp'=>json_encode($availcmp)
    ));
  }

  function detail($id){
		$componentpartner = ComponentPartnerQuery::create()->findPK($id);
		$this->template->render('admin/componentpartners/form',array('componentpartners'=>$componentpartner));
  }

	function write($id=null){
		$this->form = array(
     'PartnerId' => 'PartnerId',
     'ComponentId' => 'ComponentId',
     'Price' => 'Price',
    );
		$data = parent::write($id);
		redirect('manage_componentpartners/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_componentpartners');
  }

}
