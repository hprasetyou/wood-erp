<?php


class Manage_groups extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_groups');
  }
  function index(){
      $this->template->render('admin/groups/index');
  }

	function get_json(){
		$groups = GroupQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$groups->condition('cond1' ,'Group.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$groups->where(array('cond1',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$groups = $groups->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$groups->getNbResults();
    $o['recordsFiltered']=$groups->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($groups as $group) {
				$o['data'][$i]['id'] = $group->getId();
				$o['data'][$i]['name'] = $group->getName();
				$o['data'][$i]['description'] = $group->getDescription();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){

		$this->template->render('admin/groups/form',array());
  }

  function detail($id){

		$group = GroupQuery::create()->findPK($id);
    // echo json_encode($this->get_group_access($group->getId()));
    // $ga = $this->get_group_access($group->getId());
		$this->template->render('admin/groups/form',array(
      'groups'=>$group,
      'menus'=> MenuQuery::create()->findByParentId(0)));
  }

  private function get_group_access($gid){

    $accesses = MenuGroupQuery::create()
    ->addSelectQuery(
      MenuGroupQuery::create()
        ->filterByGroupId($gid),'gm')
    ->rightJoinWith('gm.Menu')
    ->where('Menu.ParentId > ?',0)
    ->find();
    $gaccess = [];
    $a = 0;
    foreach ($accesses as $key => $ga) {
      # code...
      $value = $ga->getMenu();
      $exist = false;
      $parent = false;
      foreach ($gaccess as $parentmenu) {
        if($parentmenu->getId()==$value->getParent()->getId()){
          //exist
          $exist = true;
          $parentmenu->Child[] = $value;
        }
      }
      if(!$exist){
        $gaccess[$a] = $value->getParent();
        $gaccess[$a]->Child[] = $value;
        $a++;
      }
    }
    return $gaccess;
  }

  function write($id=null){
		if($id){
			$group = GroupQuery::create()->findPK($id);
      $group->getMenuGroups()->delete();
		}else{
			$group = new Group;
		}
		$group->setName($this->input->post('Name'));
		$group->setDescription($this->input->post('Description'));
		$group->save();
    foreach ($this->input->post('menu') as $key => $value) {
      # code...
      echo $value;
      $menugroup = new MenuGroup;
      $menugroup->setMenuId($value);
      $menugroup->setGroup($group);
      $menugroup->save();
    }

		$this->loging->add_entry('groups',$group->getId(),($id?'activity_modify':'activity_create'));
		redirect('manage_groups/detail/'.$group->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$group = GroupQuery::create()->findPK($id);
			$group->delete();
		}
		redirect('manage_groups');
  }

}
