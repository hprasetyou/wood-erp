<?php

class Manage_components extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('Component');
		$this->tpl = 'components';
    $this->authorization->check_authorization('manage_components');
  }

  function get_json(){
    $this->objobj = ComponentQuery::create()->join('Material')
    ->withColumn('Material.Name');
    $this->custom_column = array('material'=>'_{MaterialName}_');
    if($this->input->get('avail_component')){
      $avcmp = explode(",",$this->input->get('avail_component'));
      $this->objobj = $this->objobj->filterById($avcmp);
    }
    parent::get_json();
  }

  function create(){

		$this->template->render('admin/components/form',array());
  }

  function detail($id){

		$component = ComponentQuery::create()->findPK($id);
		$this->template->render('admin/components/form',array('components'=>$component,));
  }

	function write($id=null){
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
