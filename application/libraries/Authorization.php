<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization {
    private $CI;
    function __construct(){
      $this->CI =& get_instance();

    }
    function authenticate($except=''){

        if(!$this->CI->session->userdata('logged_in')){
            redirect('auth');
        }
    }

    function check_authorization($object,$except=array()){
        $this->authenticate();
        $uacccess = unserialize($this->CI->session->userdata('access'));
        $menu = MenuQuery::create()->findOneByController($object);
        $access = false;
        if(in_array($menu->getId(),$uacccess)){
          $access = true;
        }
        if(!$access){
          die('access denied');
        }
    }
}
