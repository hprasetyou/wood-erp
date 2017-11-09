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
    }
}
