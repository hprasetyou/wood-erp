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
        $session = [];
        if($this->CI->session->userdata('logged_in')){
          $uaccess = MenuQuery::create()
          ->findById(unserialize($this->CI->session->userdata('access')));
          $access = [];
          foreach ($uaccess as $key => $value) {
            # code...
            $exist = false;
            $parent = false;
            foreach ($access as $parentmenu) {
              if($parentmenu->getId()==$value->getParent()->getId()){
                //exist
                $exist = true;
                $parentmenu->Child[] = $value;
              }
            }
            if(!$exist){
              $access[$key] = $value->getParent();
              $access[$key]->Child[] = $value;
            }
          }
          $session['access'] = $access;
          $session['uid'] = UserQuery::create()->join('User.Partner')->findOneById($this->CI->session->userdata('uid'));
        }
        $pdata = array(
            'base_url'=>base_url(),
            'res'=>array(
                'string'=>include('application/language/en/default.php'),
		'uri'=>uri_string(),
		'query_params'=>$this->CI->input->get(),
                'session' => $session,
                'info' => $this->CI->session->flashdata('info')
            )
        );
        $out = array_merge($pdata,$data);

        echo $twig->render($tpl.'.html',$out);
    }
}
