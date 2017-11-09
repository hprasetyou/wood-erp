<?php


class Manage_components extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_components');
  }
  function index(){
      $this->template->render('admin/components/index');
  }

	function get_json(){
		$components = ComponentQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$components->condition('cond1' ,'Component.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$components->where(array('cond1',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$components = $components->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$components->getNbResults();
    $o['recordsFiltered']=$components->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($components as $component) {
				$o['data'][$i]['id'] = $component->getId();
				$o['data'][$i]['name'] = $component->getName();
				$o['data'][$i]['description'] = $component->getDescription();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){

		$this->template->render('admin/components/form',array());
  }

  function detail($id){

		$component = ComponentQuery::create()->findPK($id);
		$this->template->render('admin/components/form',array('components'=>$component,));
  }

  function write($id=null){
		if($id){
			$component = ComponentQuery::create()->findPK($id);
		}else{
			$component = new Component;
		}
		$component->setName($this->input->post('Name'));
		$component->setDescription($this->input->post('Description'));

		$component->save();
		//$this->loging->add_entry('components',$component->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_components/detail/'.$component->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$component = ComponentQuery::create()->findPK($id);
			$component->delete();
		}
		redirect('manage_components');
  }

}
