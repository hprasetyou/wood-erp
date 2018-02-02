<?php

class Manage_banks extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('Bank');
		$this->tpl = 'banks';

  }


}
