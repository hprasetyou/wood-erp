<?php


class Manage_productimages extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_productimages');
  }
  function index(){
      $this->template->render('admin/productimages/index');
  }

	function get_json(){
		$productimages = ProductImageQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$productimages->condition('cond1' ,'ProductImage.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$productimages->where(array('cond1',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$productimages = $productimages->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$productimages->getNbResults();
    $o['recordsFiltered']=$productimages->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($productimages as $productimage) {
				$o['data'][$i]['id'] = $productimage->getId();
				$o['data'][$i]['name'] = $productimage->getName();
				$o['data'][$i]['url'] = $productimage->getUrl();
				$o['data'][$i]['description'] = $productimage->getDescription();
				$o['data'][$i]['product_id'] = $productimage->getProduct()->getName();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		
		$products = ProductQuery::create()->find();
			
		$this->template->render('admin/productimages/form',array(
		'products'=> $products,
			));
  }

  function detail($id){
		
		$products = ProductQuery::create()->find();
			
		$productimage = ProductImageQuery::create()->findPK($id);
		$this->template->render('admin/productimages/form',array('productimages'=>$productimage,
		'products'=> $products,
			));
  }

  function write($id=null){
		if($id){
			$productimage = ProductImageQuery::create()->findPK($id);
		}else{
			$productimage = new ProductImage;
		}
		$productimage->setName($this->input->post('Name'));
		$productimage->setUrl($this->input->post('Url'));
		$productimage->setDescription($this->input->post('Description'));
		$productimage->setProductId($this->input->post('ProductId'));

		$productimage->save();
		$this->loging->add_entry('productimages',$productimage->getId(),($id?'activity_modify':'activity_create'));
		redirect('manage_productimages/detail/'.$productimage->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$productimage = ProductImageQuery::create()->findPK($id);
			$productimage->delete();
		}
		redirect('manage_productimages');
  }

}
    