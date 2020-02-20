<?php
declare(strict_types=1);

namespace UniLEDApp;

use UniLEDApp\Contact;

class Form
{

  private $pdo = null;
  private $name = null;
  private $friend = null;
  private $email = null;
  private $error_msg = null;


  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }


  public function getErrorMsg()
  {
    return $this->error_msg;
  }

  public function setErrorMsg($msg)
  {
    $this->error_msg = $msg;
  }


  public function populate()
  {
    $this->name = trim($_POST['referrer_name']);
    $this->friend = trim($_POST['friend_name']);
    $this->email = trim($_POST['friend_email']);
    return true;
  }


  public function validate()
  {

    $this->error_msg = null;

    if (strlen($this->name) < 3 )
    {
      $this->setErrorMsg("Name is missing or too short.");
      return false;
    }

    if (strlen($this->friend) < 3 )
    {
      $this->setErrorMsg("Friend name is missing or too short.");
      return false;
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $this->name))
    {
      $this->setErrorMsg("Only letters and white space allowed for name.");
      return false;
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $this->friend)) 
    {
      $this->setErrorMsg("Only letters and white space allowed for friend's name.");
      return false;
    }

    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
    {
      $this->setErrorMsg("Invalid e-mail address.");
      return false;
    }

    return true;

  }


  public function save()
  {
    $contact = new Contact($this->pdo);
    $contact->setReferrerName($this->name);
    $contact->setFriendName($this->friend);
    $contact->setFriendEmail($this->email);
    $contact->setStatusInitial();
    return $contact->save();
  }


}

?>
