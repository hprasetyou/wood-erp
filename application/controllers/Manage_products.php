<?php


class Manage_products extends MY_Controller{


  function __construct(){
    // $this->objname = 'Product';
    $this->tpl = 'products';

    parent::__construct();
    parent::set_objname('Product');
    $this->authorization->check_authorization('manage_products');
  }
  function get_json(){
    $type = "product";
    if($this->input->get('type')){
      $type=$this->input->get('type');
      $type = explode(',',$type);
    }
    $this->objobj = ProductQuery::create()->filterByType($type);
    if($this->input->get('partner_id')){
      $this->objobj = $this->objobj->useProductPartnerQuery()
        ->filterByPartnerId($this->input->get('partner_id'))
      ->endUse();
    }
    $this->custom_column = array('dimension'=>
    "_{WidthAsb}_.'W x'. _{DepthAsb}_ .'D x'.
     _{HeightAsb}_ .'H ' ",
     'material' =>"function() use(_{Material}_,\$obj){
         \$o = [];
         foreach(ComponentProductQuery::create()->findByProductId(\$obj->getId()) as \$pc){
         \$o[] = \$pc->getComponent()->getMaterial()->getName();
         }
         if(!\$obj->hasComponent()){
            if(_{Material}_){
              \$o = array(_{Material}_->getName());
            }
          }
         return array_unique(\$o);
       }

       ");
    $this->o2m_def = array(
      array(
        'index'=>'image',
        'rel'=>'ProductImages',
        'field'=>'Url',
        'single'=>true)
    );
    parent::get_json();
  }

  function get_detail_json($id){
    $product = ProductQuery::create();
    // $product->leftJoinWith('ProductFinishing')
    // ->joinWith('ProductFinishing.Finishing');
    $sproduct = $product->findPk($id);
    if($this->input->get('customer_id')){
      $ProductPartner = $product->useProductPartnerQuery()
        ->filterByPartnerId($this->input->get('customer_id'))
      ->endUse()
      ->leftJoinWith('Product.ProductPartner');
    }
    $ProductPartner = $ProductPartner->findPk($id);
    $o = $ProductPartner? $ProductPartner: $sproduct;
    $p = json_decode($o->toJSON());

    if($this->input->get('currency_id')){
      //if need to be exchanged to currency_id
      $currency = CurrencyQuery::create()->findPk($this->input->get('currency_id'));
      if($currency){
        $p->ListPrice = exchange_rate($p->ListPrice,$currency->getCode());
        if(property_exists($p,'ProductPartners')){
          $p->ProductPartners[0]->ProductPrice = exchange_rate($p->ProductPartners[0]->ProductPrice,$currency->getCode());
        }
      }
    }

    $p->Finishings = json_decode($o->getFinishings()->toJSON())->Finishings;
    echo json_encode($p);
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

  function detail($id,$render="html"){
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
      'components' => ComponentProductQuery::create()
      ->findByProduct($product),
      'finishings'=>	$finishings,
      'new_number'=>create_number(
        array('format'=>'WDX-i',
        'tb_name'=>'product',
        'tb_field'=>'name'))));
  }

  function write($id=null){
    $this->form['MaterialId'] = 'MaterialId';
    $this->form['UomId'] = 'UomId';
    $this->form['Type'] = $this->input->post('Type')?'Type':array('value'=>'product');
    $data = parent::write($id);
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
            $productimage->setProductId($data->getId());
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
            $productcomponent = new ComponentProduct;
            $productcomponent->setProductId($data->getId());
            $productcomponent->setComponentId($component->component_id);
            $productcomponent->setQty($component->qty);
            $productcomponent->save();
            break;
          case 'delete':
            # code...
            $productcomponent = ComponentProductQuery::create()
            ->findPk($component->id)
            ->delete();

            break;
          default:
            break;
        }

      }
    }
    if($this->input->post('Finishing')){
      $data->getProductFinishings()->delete();
      foreach ($this->input->post('Finishing') as $k=> $finishing) {
        # code...
        $pf = new ProductFinishing;
        $pf->setFinishingId($k);
        $pf->setProductId($data->getId());
        $pf->save();
      }
    }

    if($this->input->is_ajax_request()){
      echo $data->toJSON();
    }else{
      redirect('manage_products/detail/'.$data->getId());
    }
		//$this->loging->add_entry('products',$product->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
  }

  function delete($id){
		if($this->input->post('confirm')){
      try {
        $product = ProductQuery::create()->findPK($id);
        $product->getProductPartners()->delete();
        $product->getProductFinishings()->delete();
        $product->getProductImages()->delete();
        ComponentProductQuery::create()->findByProductId($id)->delete();
        $product->delete();
        $this->loging->add_entry('products',$product->getId(),('activity_delete'));
      } catch (Exception $e) {
      $this->loging->add_entry('products',$product->getId(),('activity_delete_failed'));
      }
		}
    redirect('manage_products');
  }


}
