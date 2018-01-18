<?php

function queue_message($config){
  $task = new SysTask();
  $now = date('Y/m/d H:i:s ', time());

  $task->setName("send email ".$now)
  ->setPriority(1)
  ->setContent(json_encode($config))
  ->setType('email')
  ->save();
}
