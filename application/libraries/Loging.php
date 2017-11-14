<?php

/**
 *
 */
class Loging
{

  function add_entry($model,$id_obj,$msg){
    $this->CI =& get_instance();
    $string = include('application/language/en/activity_message.php');
    $this->CI->session->set_flashdata('info',$string[$msg]);
    $log = new Activity();
    $log->setUuid(uniqid('log').date('s'));
    $log->setObjectId($id_obj);
    $log->setObject($model);
    $log->setDescription($msg);
    $log->setUserId($this->CI->session->userdata('uid'));
    $log->save();
  }


}
