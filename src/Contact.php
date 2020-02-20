<?php
declare(strict_types=1);

namespace UniLEDApp;

class Contact
{

  private $database = null;
  private static $table = 'contacts';
  private $referrer_name = null;
  private $friend_name = null;
  private $friend_email = null;
  private $status = null;


  // Setters
  public function setReferrerName($name)
  {
    $this->referrer_name = $name;
  }

  public function setFriendName($name)
  {
    $this->friend_name = $name;
  }

  public function setFriendEmail($email)
  {
    $this->friend_email = $email;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function setStatusInitial()
  {
    $this->setStatus('I');
  }

  public function setStatusFinal()
  {
    $this->setStatus('F');
  }


  // Getters
  public function getReferrerName()
  {
    return $this->referrer_name;
  }

  public function getFriendName()
  {
    return $this->friend_name;
  }

  public function getFriendEmail()
  {
    return $this->friend_email;
  }

  public function getStatus()
  {
    return $this->status;
  }



  public function __construct(\PDO $database)
  {
    $this->database = $database;
  }


  public function save()
  {

    try
    {
      $this->database->beginTransaction();

      $sql = "INSERT INTO " . self::$table . " (created_at, referrer_name, friend_name, friend_email, status) VALUES (now(), ?, ?, ?, ?)";
      $stmt = $this->database->prepare($sql);
      $args = array($this->referrer_name, $this->friend_name, $this->friend_email, $this->status);
      $stmt->execute($args);

      $this->database->commit();
    }
    catch(\PDOException $p)
    {
      $this->database->rollBack();
      return false;
    }

    return true;

  }


  public static function listPendingMail($db)
  {
    return $db->query('SELECT * FROM ' . self::$table . ' WHERE status = "I"');
  }


  public static function updateFinalStatus($db, $id)
  {
    try
    {
      $db->beginTransaction();

      $sql = "UPDATE " . self::$table . " SET status = ? WHERE id = ?";
      $stmt = $db->prepare($sql);
      $args = array('F', $id);
      $stmt->execute($args);

      $db->commit();
    }
    catch(\PDOException $p)
    {
      $db->rollBack();
      return false;
    }

    return true;

  }

  

}

?>
