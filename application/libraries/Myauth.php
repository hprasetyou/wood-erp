<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myauth {
    function authenticate($except=''){

        $this->CI =& get_instance();
        if(!$this->CI->session->userdata('id')){
            redirect('auth');
        }
    }
}