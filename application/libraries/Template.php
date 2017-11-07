<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
v1.0
This is library for accessing twig, make sure you have intall twig via composer
and enable composer autoloading
*/
class Template {
    function render($tpl,$data=array(),$ext="html"){

		$this->CI =& get_instance();
        $loader = new Twig_Loader_Filesystem('./application/views');
        $twig = new Twig_Environment($loader);
        $this->CI->load->helper('url');
        $pdata = array(
            'base_url'=>base_url(),
        );
        if($this->CI->session->userdata('is_logged_in')){
            $pdata['user_data'] = MemberQuery::create()->findPK($this->CI->session->userdata('id'));
        }
        $out = array_merge($pdata,$data);
        
        echo $twig->render($tpl.'.html',$out);
    }
}
