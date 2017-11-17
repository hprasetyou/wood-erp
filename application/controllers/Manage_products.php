<?php


class Manage_products extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_products');
  }
  function index(){
      $this->template->render('admin/products/index');
  }

  function get_detail_json($id){
    $product = ProductQuery::create();
    $sproduct = $product->findPk($id);
    if($this->input->get('customer_id')){
      $productcustomer = $product->useProductCustomerQuery()
        ->filterByPartnerId($this->input->get('customer_id'))
      ->endUse()
      ->leftJoinWith('Product.ProductCustomer');
    }
    $productcustomer = $productcustomer->findPk($id);
    echo $productcustomer? $productcustomer->toJSON(): $sproduct->toJSON();
  }

	function get_json(){
		$products = ProductQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$products->condition('cond1' ,'Product.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$products->where(array('cond1',),'or');
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
	    $imgurl = '';
	    if($product->getProductImages()->count()>0){
	    	$imgurl = $product->getProductImages()[0]->getUrl();
	    }
	    	$o['data'][$i]['id'] = $product->getId();
		$o['data'][$i]['name'] = $product->getName();
		$o['data'][$i]['description'] = $product->getDescription();
		$o['data'][$i]['is_kdn'] = $product->getIsKdn();
		$o['data'][$i]['cost_price'] = $product->getCostPrice();
		$o['data'][$i]['list_price'] = $product->getListPrice();
		$o['data'][$i]['image'] = $imgurl;
		$o['data'][$i]['cubic_asb'] = $product->getCubicAsb();
		$o['data'][$i]['cubic_kdn'] = $product->getIsKdn()?$product->getCubicKdn():string('not_knockdown');
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
    $this->load->helper('good_numbering');
    $finishings = FinishingQuery::create()->find();

		$this->template->render('admin/products/form',array(
      'finishings'=>	$finishings,
      'new_number'=>create_number(
          array('format'=>'WDX-i',
          'tb_name'=>'product',
          'tb_field'=>'name'))));
  }

  function detail($id){
    $this->load->helper('good_numbering');
		$product = ProductQuery::create()->findPK($id);
    $finishings = FinishingQuery::create()->find();
    foreach ($finishings as $key => $value) {
      # code...
      $productfinishing = ProductFinishingQuery::create()
      ->filterByProduct($product)
      ->filterByFinishing($value);
      if($productfinishing->count()>0){
        $value->have = true;
      }
    }
		$this->template->render('admin/products/form',array(
      'products'=>$product,
      'finishings'=>	$finishings,
      'new_number'=>create_number(
        array('format'=>'WDX-i',
        'tb_name'=>'product',
        'tb_field'=>'name'))));
  }

  function write($id=null){
		if($id){
			$product = ProductQuery::create()->findPK($id);
		}else{
			$product = new Product;
		}
		$product->setName($this->input->post('Name'));
		$product->setDescription($this->input->post('Description'));
		$product->setIsKdn($this->input->post('IsKdn')?true:false);
		$product->setIsFlegt($this->input->post('IsFlegt')?true:false);
		$product->setHasComponent($this->input->post('HasComponent')?true:false);
		$product->setNetCubic($this->input->post('NetCubic'));
		$product->setCostPrice($this->input->post('CostPrice'));
		$product->setQtyPerPack($this->input->post('QtyPerPack'));
		$product->setListPrice($this->input->post('ListPrice'));
		$product->setCubicAsb($this->input->post('CubicAsb'));
		$product->setCubicKdn($this->input->post('CubicKdn'));
		$product->setWidthAsb($this->input->post('WidthAsb'));
		$product->setHeightAsb($this->input->post('HeightAsb'));
		$product->setDepthAsb($this->input->post('DepthAsb'));
		$product->setWidthKdn($this->input->post('WidthKdn'));
		$product->setHeightKdn($this->input->post('HeightKdn'));
		$product->setDepthKdn($this->input->post('DepthKdn'));
		$product->setNote($this->input->post('Note'));
		$product->save();
		$this->load->helper('base64toimage');
		$prod_img = json_decode($this->input->post('imgProduct'));
    if($prod_img){
      foreach ($prod_img as $key => $input_data) {
        # code...
        switch ($input_data->state) {
          case 'new':
            $productimage = new ProductImage;
            $productimage->setName($input_data->name);
            if($input_data->url){
              if(strpos($input_data->url,'base64')){
                $productimage->setUrl(base64_to_img($input_data->url));
              }
            }
            $productimage->setDescription($input_data->description);
            $productimage->setProductId($product->getId());
            $productimage->save();
            # code...
            break;
          case 'delete':
            $productimage = ProductImageQuery::create()
            ->findPk($input_data->id);
            unlink('.'.$productimage->getUrl());
            $productimage->delete();
            # code...
            break;

          default:
            # code...
            break;
        }

      }
    }

    $prod_component = json_decode($this->input->post('productComponents'));

    if($prod_component){
      foreach ($prod_component as $component) {
        switch ($component->state) {
          case 'new':
            # code...
            $productcomponent = new ProductComponent;
            $productcomponent->setProductId($product->getId());
            $productcomponent->setComponentId($component->component_id);
            $productcomponent->setQty($component->qty);
            $productcomponent->save();
            break;
          case 'delete':
            # code...
            $productcomponent = ProductComponentQuery::create()
            ->findPk($component->id)
            ->delete();

            break;
          default:
            break;
        }

      }
    }
    $product->getProductFinishings()->delete();
    foreach ($this->input->post('Finishing') as $k=> $finishing) {
      # code...
      $pf = new ProductFinishing;
      $pf->setFinishingId($k);
      $pf->setProductId($product->getId());
      $pf->save();
    }

    $this->loging->add_entry('products',$product->getId(),($id?'activity_modify':'activity_create'));

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
