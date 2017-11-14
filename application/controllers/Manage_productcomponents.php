<?php


class Manage_productcomponents extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_productcomponents');
  }
  function index(){
      $this->template->render('admin/productcomponents/index');
  }

	function get_json(){
		$productcomponents = ProductComponentQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){

    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$productcomponents = $productcomponents->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$productcomponents->getNbResults();
    $o['recordsFiltered']=$productcomponents->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($productcomponents as $productcomponent) {
				$o['data'][$i]['id'] = $productcomponent->getId();
				$o['data'][$i]['product_id'] = $productcomponent->getProductId();
				$o['data'][$i]['component_id'] = $productcomponent->getComponent()->getName();
				$o['data'][$i]['qty'] = $productcomponent->getQty();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		
		$components = ComponentQuery::create()->find();
			
		$this->template->render('admin/productcomponents/form',array(
		'components'=> $components,
			));
  }

  function detail($id){
		
		$components = ComponentQuery::create()->find();
			
		$productcomponent = ProductComponentQuery::create()->findPK($id);
		$this->template->render('admin/productcomponents/form',array('productcomponents'=>$productcomponent,
		'components'=> $components,
			));
  }

  function write($id=null){
		if($id){
			$productcomponent = ProductComponentQuery::create()->findPK($id);
		}else{
			$productcomponent = new ProductComponent;
		}
		$productcomponent->setProductId($this->input->post('ProductId'));
		$productcomponent->setComponentId($this->input->post('ComponentId'));
		$productcomponent->setQty($this->input->post('Qty'));

		$productcomponent->save();
		//$this->loging->add_entry('productcomponents',$productcomponent->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_productcomponents/detail/'.$productcomponent->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$productcomponent = ProductComponentQuery::create()->findPK($id);
			$productcomponent->delete();
		}
		redirect('manage_productcomponents');
  }

}
    