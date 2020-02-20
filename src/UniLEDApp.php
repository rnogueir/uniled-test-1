<?php
declare(strict_types=1);

namespace UniLEDApp;

use UniLEDApp\Form as Form;
use UniLEDApp\Mail as Mail;
use UniLEDApp\Contact as Contact;


class UniLEDApp
{

  private $pdo = null;
  private $form = null;
  private $config = null;
  private $mailer = null;


  public function __construct()
  {

    // read config file
    $json = file_get_contents(__DIR__ . '/../.env');
    $this->config = json_decode($json);

    // define DB connection
    $dsn = $this->config->database->type . ':host=' . $this->config->database->host . ';dbname=' . $this->config->database->dbname;
    try 
    {
      $this->pdo = new \PDO($dsn, $this->config->database->username, $this->config->database->password);
    } 
    catch (\PDOException $e) 
    {
      //echo 'Connection failed: ' . $e->getMessage(); 
      return false;
    }

    // instantiate a form
    $this->form = new Form($this->pdo);

    // instantiate a mailer
    $this->mailer = new Mail;
    $this->mailer->config($this->config->email);

    return true;

  }


  public function populateForm()
  {
    $this->form->populate();
    return true;
  }


  public function validateForm()
  {
    return $this->form->validate();
  }


  public function getFormValidationMsg()
  {
    return $this->form->getErrorMsg();
  }


  public function saveForm()
  {
    $this->form->save();
    return true;
  }


  public function sendPendingMail()
  {

    $pending_mail = Contact::listPendingMail($this->pdo);
    foreach($pending_mail as $m)
    {
      $params = array(
                  'to_address' => $m['friend_email'],
                  'to_name' => $m['friend_name'],
                  'subject' => 'A great deal from your friend ' . $m['referrer_name'] . '!'
                     );
      $this->mailer->sendMail($params);
      Contact::updateFinalStatus($this->pdo, $m['id']);
    }

    return true;

  }


}

?>

