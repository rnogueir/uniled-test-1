<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

require('./test/TestContact.php');

$pdo = new PDO('mysql:host=localhost;dbname=uniled_test_1', 'homestead', 'secret');

$tc = new TestContact($pdo);
$tc->run();

?>

