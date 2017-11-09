<?php
/**
 *
 */
class Auth extends CI_Controller
{

  function __construct()
  {
    # code...
    parent::__construct();
  }

  function index(){
    $this->template->render('auth/login');
  }

  function do_login(){
    $login = false;
    if($this->input->post('Username') && $this->input->post('Password')){
      $user = UserQuery::create()->filterByStatus(true)->findOneByName($this->input->post('Username'));
      if($user){
        if(password_verify( $this->input->post('Password'), $user->getPassword())){
          $login = true;
        }
      }
    }
    if($login){
      $user->setLastLogin(date('Y-m-d H:i:s'))->save();
      /*
      after user is valid, get user group
      save user session
      save user group in session
      save user access(from group) on session
      */
      $user_access = [];
      $redirect_url = false;
      foreach ($user->getGroups() as $group) {
        foreach ($group->getMenus() as $access) {
          if(!$redirect_url){
            $redirect_url=$access->getUrl();
          }
          $user_access[] = $access->getId();
        }
      }
      $newdata = array(
        'uid'  => $user->getId(),
        'access'     => serialize($user_access),
        'logged_in' => TRUE
      );
      $this->session->set_userdata($newdata);
      redirect($redirect_url?$redirect_url:'auth');

    }else{
      echo 'not login';
    }
  }

}
