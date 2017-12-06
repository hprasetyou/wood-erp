<?php
/**
 *
 */
class Task extends CI_Controller
{
  function run(){
    $tasks = SysTask::create();
    //find task by Scheduled Execution
    foreach ($this->get_day_repeat_task() as $key => $value) {
      # code...
      $task_name = $value->getName();
      write_log("executing task $task_name . . . .");

    }
  }


  function execute($type,$content){
    switch ($type) {
      case 'email':
        # code...
        break;
      case 'call_func':

        # code...
        break;

      default:
        # code...
        break;
    }
  }

  function get_day_repeat_task(){
    $tasks = SysTaskQuery::create()
    //check if this task must run today
    ->where('SysTask.DayRepeat like ?','%'.date('D').'%')
    //check wether we have run this task before or not today
    ->where('SysTask.LastExecution < CONCAT(date_format(NOW(),"%Y-%m-%d")," ",date_format(SysTask.TimeExecution,"%H:%i:%s")) ')
    ->find();
    return $tasks;
  }

  function get_one_time_task(){
    $tasks = SysTaskQuery::create()
    ->filterByDayRepeat(null)
    ->filterByScheduledExecution(
      array('max'=>date('Y-m-d h:i:s')))
    ->filterByIsExecuted(false)
    ->find();
    echo $tasks;
  }
}
