<?php
declare(strict_types=1);

namespace UniLEDApp;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use UniLEDApp\Logger;


class Mail extends PHPMailer
{

  public function setHost($host)
  {
    $this->Host = $host;
  }

  public function setPort($port)
  {
    $this->Port = $port;
  }

  public function setUsername($username)
  {
    $this->Username = $username;
  }

  public function setPassword($password)
  {
    $this->Password = $password;
  }

  public function setFromAddress($from_address, $from_name)
  {
    $this->setFrom($from_address, $from_name);
  }

  public function setToAddress($to_address, $to_name)
  {
    $this->addAddress($to_address, $to_name);
  }

  public function setSubject($subject)
  {
    $this->Subject = $subject;
  }


  public function config($config)
  {
    $this->setHost($config->host);
    $this->setPort($config->port);
    $this->setUsername($config->username);
    $this->setPassword($config->password);
    $this->setFromAddress($config->from_address, $config->from_name);
  }

  public function sendMail($params)
  {

    $this->isSMTP();
    $this->SMTPDebug = SMTP::DEBUG_SERVER;
    $this->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $this->SMTPAuth = true;
    $this->setToAddress($params['to_address'], $params['to_name']);
    $this->setSubject($params['subject']);
    $this->msgHTML(file_get_contents(__DIR__ . '/../jobs/contents.html'), __DIR__);
    $this->AltBody = 'That is a great deal from UniLED, shared by your friend.';

    if (!$this->send()) 
    {
      Logger::log("[" . date('Y-m-d H:i:s') . "] Mailer error sending to " . $params['to_address'] . ": " . $this->ErrorInfo . "\r\n");
      return false;
    }
    else 
    {
      Logger::log("[" . date('Y-m-d H:i:s') . "] Message sent to " . $params['to_address'] . "\r\n");
    }

    return true;

  }


}

?>
