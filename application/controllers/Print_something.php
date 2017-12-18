<?php

/**
 *
 */
class Print_something extends CI_Controller
{

  function index(){
    $this->load->helper('form');
    $this->load->view('upload_form', array('error' => ' ' ));
  }

  function test_email(){
    $this->load->library('Mailer');
    $this->mailer->send_email();
  }

  public function do_upload()
  {
          $config['upload_path']          = 'public/upload/images';
          $config['allowed_types']        = 'gif|jpg|png';
          $config['max_size']             = 10000;
          $config['max_width']            = 10240;
          $config['max_height']           = 7680;

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('userfile'))
          {
                  $error = array('error' => $this->upload->display_errors());

                  $this->load->view('upload_form', $error);
          }
          else
          {
                  $this->template->render_pdf('common/print',array('link'=>$this->upload->data()['full_path']));
          }
  }
}
