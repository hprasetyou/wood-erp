<?php

/**
 *
 */
class Mailer
{
  // Create the Transport
  private $transport;

  private $body;
  private $recipient;
  private $recipient_name;
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

  function set_body($body){
    $this->body = $body;
    return $this;
  }

  function set_recipient($recipient){
    $this->recipient = $recipient;
    return $this;
  }

  function set_recipient_name($recipient){
    $this->recipient_name = $recipient;
    return $this;
  }
  function send_email(){
    $message = (new Swift_Message('Test'))
      ->setFrom([$conf['username'] => $conf['sender_name']])
      ->setTo([$this->recipient=> $this->recipient_name])
      ->setBody($this->body, 'text/html');
    $result = $this->mailer->send($message);
  }

}
