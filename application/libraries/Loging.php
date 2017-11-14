<?php

/**
 *
 */
class Loging
{

  function add_entry($model,$id_obj,$msg){
    $this->CI =& get_instance();
    $log = new Activity();
    $log->setUuid(uniqid('log').date('s'));
    $log->setObjectId($id_obj);
    $log->setObject($model);
    $log->setDescription($msg);
    $log->UserId($this->CI->session->uid);
    $log->save();
  }


}
