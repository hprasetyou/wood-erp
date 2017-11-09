<?php


class Manage_products extends CI_Controller{


  function __construct(){
    parent::__construct();
   $this->authorization->check_authorization('manage_products');
  }
  function index(){
      $this->template->render('admin/products/index');
  }

	function get_json(){
		$products = ProductQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$products->condition('cond1' ,'Product.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$products->where(array('cond1',),'or');
      $products->find();
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$products = $products->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$products->getNbResults();
    $o['recordsFiltered']=$products->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($products as $product) {
				$o['data'][$i]['id'] = $product->getId();
				$o['data'][$i]['name'] = $product->getName();
				$o['data'][$i]['description'] = $product->getDescription();
				$o['data'][$i]['is_kdn'] = $product->getIsKdn();
				$o['data'][$i]['cost_price'] = $product->getCostPrice();
				$o['data'][$i]['list_price'] = $product->getListPrice();
				$o['data'][$i]['cubic_asb'] = $product->getCubicAsb();
				$o['data'][$i]['cubic_kdn'] = $product->getCubicKdn();
				$o['data'][$i]['width_asb'] = $product->getWidthAsb();
				$o['data'][$i]['height_asb'] = $product->getHeightAsb();
				$o['data'][$i]['depth_asb'] = $product->getDepthAsb();
				$o['data'][$i]['width_kdn'] = $product->getWidthKdn();
				$o['data'][$i]['height_kdn'] = $product->getHeightKdn();
				$o['data'][$i]['depth_kdn'] = $product->getDepthKdn();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){

		$this->template->render('admin/products/form',array());
  }

  function detail($id){

		$product = ProductQuery::create()->findPK($id);
		$this->template->render('admin/products/form',array('products'=>$product,));
  }

  function write($id=null){
		if($id){
			$product = ProductQuery::create()->findPK($id);
		}else{
			$product = new Product;
		}
		$product->setName($this->input->post('Name'));
		$product->setDescription($this->input->post('Description'));
		$product->setIsKdn($this->input->post('IsKdn'));
		$product->setCostPrice($this->input->post('CostPrice'));
		$product->setListPrice($this->input->post('ListPrice'));
		$product->setCubicAsb($this->input->post('CubicAsb'));
		$product->setCubicKdn($this->input->post('CubicKdn'));
		$product->setWidthAsb($this->input->post('WidthAsb'));
		$product->setHeightAsb($this->input->post('HeightAsb'));
		$product->setDepthAsb($this->input->post('DepthAsb'));
		$product->setWidthKdn($this->input->post('WidthKdn'));
		$product->setHeightKdn($this->input->post('HeightKdn'));
		$product->setDepthKdn($this->input->post('DepthKdn'));

		$product->save();
		//$this->loging->add_entry('products',$product->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_products/detail/'.$product->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$product = ProductQuery::create()->findPK($id);
			$product->delete();
		}
		redirect('manage_products');
  }

}
