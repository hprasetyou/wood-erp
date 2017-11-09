<?php


class Manage_finishings extends CI_Controller{


  function __construct(){
    parent::__construct();
   $this->authorization->check_authorization('manage_finishings');
  }
  function index(){
      $this->template->render('admin/finishings/index');
  }

	function get_json(){
		$finishings = FinishingQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$finishings->condition('cond1' ,'Finishing.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$finishings->where(array('cond1',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$finishings = $finishings->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$finishings->getNbResults();
    $o['recordsFiltered']=$finishings->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($finishings as $finishing) {
				$o['data'][$i]['id'] = $finishing->getId();
				$o['data'][$i]['name'] = $finishing->getName();
				$o['data'][$i]['description'] = $finishing->getDescription();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){

		$this->template->render('admin/finishings/form',array());
  }

  function detail($id){

		$finishing = FinishingQuery::create()->findPK($id);
		$this->template->render('admin/finishings/form',array('finishings'=>$finishing,));
  }

  function write($id=null){
		if($id){
			$finishing = FinishingQuery::create()->findPK($id);
		}else{
			$finishing = new Finishing;
		}
		$finishing->setName($this->input->post('Name'));
		$finishing->setDescription($this->input->post('Description'));

		$finishing->save();
		//$this->loging->add_entry('finishings',$finishing->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_finishings/detail/'.$finishing->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$finishing = FinishingQuery::create()->findPK($id);
			$finishing->delete();
		}
		redirect('manage_finishings');
  }

}
