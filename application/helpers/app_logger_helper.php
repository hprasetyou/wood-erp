<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


// You can now use your logger
function write_log($msg){
  // create a log channel
  $log = new Logger('name');
  $log->pushHandler(new StreamHandler('application/logs/default.log', Logger::INFO));
  $log->pushHandler(new FirePHPHandler());
  $log->info($msg);
}
