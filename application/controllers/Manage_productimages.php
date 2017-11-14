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
				$o['data'][$i]['product_id'] = $productimage->getProductId();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		
		$this->template->render('admin/productimages/form',array());
  }

  function detail($id){
		
		$productimage = ProductImageQuery::create()->findPK($id);
		$this->template->render('admin/productimages/form',array('productimages'=>$productimage,));
  }

  function write($id=null){
		$input_data = json_decode(file_get_contents("php://input"));
		if($id){
			$productimage = ProductImageQuery::create()->findPK($id);
		}else{
			$productimage = new ProductImage;
		}
		$productimage->setName($input_data->name);
		if($input_data->url){
      if(strpos($input_data->url,'base64')){
        $this->load->helper('base64toimage');
    		$productimage->setUrl(base64_to_img($input_data->url));
      }
    }
		$productimage->setDescription($input_data->description);
		$productimage->setProductId($input_data->product_id);

		$productimage->save();
		//$this->loging->add_entry('productimages',$productimage->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		echo $productimage->toJSON();
	}

  function delete($id){
		if($this->input->post('confirm')){
			$productimage = ProductImageQuery::create()->findPK($id);
			$productimage->delete();
		}
		redirect('manage_productimages');
  }

}
    