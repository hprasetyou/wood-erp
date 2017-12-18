<?php

/**
 *
 */
class Mailer
{
  // Create the Transport
  private $transport;

  // Create the Mailer using your created Transport
  private $mailer;
  private $CI;
  // Create a message
  private $message;
  // Send the message
  function __construct()
  {
    $this->CI =& get_instance();
    $conf = $this->CI->config->item('email');
    # code...
    $this->transport = (new Swift_SmtpTransport($conf['smtp_server'], $conf['smtp_port']))
      ->setUsername($conf['username'])
      ->setPassword($conf['password']);
    $this->mailer = new Swift_Mailer($this->transport);

  }

  function send_email(){
    $message = (new Swift_Message('Test'))
      ->setFrom(['john@doe.com' => 'John Doe'])
      ->setTo(['hprasetyou@gmail.com'=> 'A name'])
      ->setBody($this->CI->template->render('common/email_test',[],false), 'text/html');
    $result = $this->mailer->send($message);
  }

}
