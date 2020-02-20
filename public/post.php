<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use UniLEDApp\UniLEDApp;


$app = new UniLEDApp;
$app->start();


// fill the form object with the POST fields
$app->populateForm();

// validate the form data
if(!$app->validateForm())
{
  // store error message to be shown on form after redirecting
  session_start();
  $_SESSION['error_msg'] = $app->getFormValidationMsg();
  session_write_close();

  // redirect back to form in case of validation error(s)
  header("Location: index.php"); die();
}


// save form data into the DB
$app->saveForm();


?>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UniLED Technical Test 1</title>
  <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>

  <div class='main'>

    <h1>Thank you.</h1>

    <p class='call-to-action'>We have saved your contact!</p>

  </div>

</body>

</html>
