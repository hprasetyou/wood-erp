<?php

class Manage_components extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'Component';
		$this->tpl = 'components';
    $this->form = array(
     'Name' => 'Name',
     'Description' => 'Description',
     'Material' => 'Material',
    );
    $this->authorization->check_authorization('manage_components');
  }


  function create(){

		$this->template->render('admin/components/form',array());
  }

  function detail($id){

		$component = ComponentQuery::create()->findPK($id);
		$this->template->render('admin/components/form',array('components'=>$component,));
  }

	function write($id=null){
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
