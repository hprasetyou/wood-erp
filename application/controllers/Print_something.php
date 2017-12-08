<?php

/**
 *
 */
class Print_something extends CI_Controller
{

  function index(){
    $this->template->render_pdf('common/print');
  }
}
