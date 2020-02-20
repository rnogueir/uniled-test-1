<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use UniLEDApp\UniLEDApp;

$app = new UniLEDApp;

$app->sendPendingMail();

?>
