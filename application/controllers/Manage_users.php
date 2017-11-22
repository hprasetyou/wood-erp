<?php


class Manage_users extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_users');
  }
  function index(){
      $this->template->render('admin/users/index');
  }

	function get_json(){
		$users = UserQuery::create();
    if($this->input->get('group_id')){
      $user_groups = UserGroupQuery::create()
      ->filterByGroupId($this->input->get('group_id'));
      $ids = [];
      foreach ($user_groups as $user_group) {
        # code...
        $ids[] = $user_group->getUserId();
      }
      $users->filterById($ids);
    }
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$users->condition('cond1' ,'User.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$users->condition('cond2' ,'User.password LIKE ?', "%".$this->input->get('search[value]')."%");

			$users->where(array('cond1','cond2',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$users = $users->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$users->getNbResults();
    $o['recordsFiltered']=$users->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($users as $user) {
				$o['data'][$i]['id'] = $user->getId();
				$o['data'][$i]['name'] = $user->getName();
				$o['data'][$i]['password'] = $user->getPassword();
				$o['data'][$i]['partner_id'] = $user->getPartner()->getName();
				$o['data'][$i]['last_login'] = $user->getLastLogin()?date_format($user->getLastLogin(),'d M Y h:i:s'):"";
				$o['data'][$i]['status'] = $user->getStatus();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){

		$partners = PartnerQuery::create()->find();

		$this->template->render('admin/users/form',array(
		'partners'=> $partners,
			));
  }

  function detail($id){

		$partners = PartnerQuery::create()->find();

		$user = UserQuery::create()->findPK($id);
		$this->template->render('admin/users/form',array('users'=>$user,
		'partners'=> $partners,
			));
  }

  function write($id=null){
		if($id){
			$user = UserQuery::create()->findPK($id);
		}else{
			$user = new User;
		}
		$user->setName($this->input->post('Name'));
    if($user->getPartnerId()){
      $employee = $user->getPartner();
    }else{
      $employee = new Partner;
    }
    $employee->setName($this->input->post('PartnerName'));
    $employee->setAddress($this->input->post('Address'));
    $employee->setPhone($this->input->post('Phone'));
    $employee->setEmail($this->input->post('Email'));
    if($this->input->post('Image')){
      if(strpos($this->input->post('Image'),'base64')){
        $this->load->helper('base64toimage');
        $employee->setImage(base64_to_img($this->input->post('Image')));
      }
    }
    $user->setPartner($employee);
		$user->save();
    $user->getUserGroups()->delete();
    $usermenu = new UserGroup;
    $usermenu->setUserId($user->getId());
    $usermenu->setGroupId($this->input->post('Group'));
    $usermenu->save();
		//$this->loging->add_entry('users',$user->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_users/detail/'.$user->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$user = UserQuery::create()->findPK($id);
			$user->delete();
		}
		redirect('manage_users');
  }

}
