<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use UniLEDApp\Contact;


class TestContact 
{

  private $pdo = null;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function testGetterSetterReferrerName()
  {
    $contact = new Contact($this->pdo);
    $contact->setReferrerName('foo');
    return $contact->getReferrerName() == 'foo'? 1: 0;
  }

  public function testGetterSetterFriendName()
  {
    $contact = new Contact($this->pdo);
    $contact->setFriendName('bar');
    return $contact->getFriendName() == 'bar'? 1: 0;
  }

  public function testGetterSetterFriendEmail()
  {
    $contact = new Contact($this->pdo);
    $contact->setFriendEmail('foo@bar.com');
    return $contact->getFriendEmail() == 'foo@bar.com'? 1: 0;
  }

  public function testGetterSetterStatus()
  {
    $contact = new Contact($this->pdo);
    $contact->setStatus('F');
    return $contact->getStatus() == 'F'? 1: 0;
  }

  public function testSaveData()
  {
    $contact = new Contact($this->pdo);
    $contact->setReferrerName('foo');
    $contact->setFriendName('bar');
    $contact->setFriendEmail('foo@bar.com');
    $contact->setStatusInitial();
    $contact->save();

    $input = array(
                   'referrer_name' => $contact->getReferrerName(),
                   'friend_name' => $contact->getFriendName(),
                   'friend_email' => $contact->getFriendEmail(),
                   'status' => $contact->getStatus()
                  );
    $statement = $this->pdo->query("SELECT referrer_name, friend_name, friend_email, status FROM contacts");
    $output= $statement->fetch(PDO::FETCH_ASSOC);
    return $input == $output? 1: 0;
    
  }



  public function run()
  {
    echo "[" . ($this->testGetterSetterReferrerName() ? 'OK' : 'FAIL') . "]\n\r";
    echo "[" . ($this->testGetterSetterFriendName() ? 'OK' : 'FAIL') . "]\n\r";
    echo "[" . ($this->testGetterSetterFriendEmail() ? 'OK' : 'FAIL') . "]\n\r";
    echo "[" . ($this->testGetterSetterStatus() ? 'OK' : 'FAIL') . "]\n\r";
    echo "[" . ($this->testSaveData() ? 'OK' : 'FAIL') . "]\n\r";
    return true;
  }

}


?>
