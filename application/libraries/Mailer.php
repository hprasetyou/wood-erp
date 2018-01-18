<?php

/**
 *
 */
class Mailer
{
    // Create the Transport
    private $transport;

    private $subject;
    private $body;
    private $recipient;
    private $recipient_name;
    // Create the Mailer using your created Transport
    private $mailer;
    private $CI;
    // Create a message
    private $message;
    // Send the message
    public function __construct()
    {
        $this->CI =& get_instance();
        $conf = $this->CI->config->item('email');
        # code...
        $this->transport = (new Swift_SmtpTransport($conf['smtp_server'], $conf['smtp_port']))
      ->setUsername($conf['username'])
      ->setPassword($conf['password']);
        $this->mailer = new Swift_Mailer($this->transport);
    }

    public function set_body($body)
    {
        $this->body = $body;
        return $this;
    }
    public function set_subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function set_recipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    public function set_recipient_name($recipient)
    {
        $this->recipient_name = $recipient;
        return $this;
    }
    public function send_email()
    {
        $conf = $this->CI->config->item('email');
        $message = (new Swift_Message($this->subject))
      ->setFrom([$conf['username'] => $conf['sender_name']])
      ->setTo([$this->recipient => $this->recipient_name])
      ->setBody($this->body, 'text/html')
      ->attach(Swift_Attachment::fromPath('public/.tmp/5305.pdf')->setFilename('myfilename.pdf'));
        $result = $this->mailer->send($message);
    }
}
