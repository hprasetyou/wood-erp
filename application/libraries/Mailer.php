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

  // Create a message
  private $message;
  // Send the message
  function __construct()
  {
    # code...
    $this->transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
      ->setUsername('b1bcb3a435678a')
      ->setPassword('35323ef503d090');
    $this->mailer = new Swift_Mailer($this->transport);

  }

  function send_email(){
    $message = (new Swift_Message('Wonderful Subject'))
      ->setFrom(['john@doe.com' => 'John Doe'])
      ->setTo(['hprasetyou@gmail.com'=> 'A name'])
      ->setBody('Here is the message itself');
    $result = $this->mailer->send($message);
  }

}
