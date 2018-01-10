<?php

class Manage_components extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('Product');
		$this->tpl = 'components';
    $this->authorization->check_authorization('manage_components');
  }


  function get_json(){
    $this->objobj = ProductQuery::create()
    ->filterByType(array('component','support_component'))
    ->join('Material')
    ->withColumn('Material.Name');
    $this->custom_column = array('material'=>'_{MaterialName}_');
    $this->custom_column['type'] = "function() use(_{Type}_){
      return string(_{Type}_);
    }";
    if($this->input->get('avail_component')){
      $avcmp = explode(",",$this->input->get('avail_component'));
      $this->objobj = $this->objobj->filterById($avcmp);
    }
    parent::get_json();
  }

  function create(){
    $this->load->helper('good_numbering');

		$this->template->render('admin/components/form',array('new_number'=>create_number(
        array('format'=>'CMP-i',
        'tb_name'=>'product',
        'tb_field'=>'name'))));
  }

	function write($id=null){
    $this->form['UomId'] = 'UomId';
    if(strlen($this->input->post('Material'))>1){
      $new_mtr = new Material();
      $new_mtr->setName($this->input->post('Material'))
      ->save();
      $this->form['MaterialId'] = array('value'=>$new_mtr->getId());
    }else{
      $this->form['MaterialId'] = 'MaterialId';
    }
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
      echo $data->toJSON();
    }else{
		  redirect('manage_components/detail/'.$data->getId());
    }
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_components');
  }

}
