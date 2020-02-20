<?php
declare(strict_types=1);

namespace UniLEDApp;

use UniLEDApp\Form as Form;


class UniLEDApp
{

  private $pdo = null;
  private $form = null;
  private $config = null;


  public function start()
  {

    // read config file
    $json = file_get_contents('../.env');
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

    return true;

  }


  public function populateForm()
  {
    $this->form->populate();
    return true;
  }


  public function validateForm()
  {
    $this->form->validate();
    return true;
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


}

?>

