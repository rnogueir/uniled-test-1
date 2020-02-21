<?php

namespace UniLEDApp;

class Logger
{

  private static $logfile = __DIR__ . '/../log/uniled.log';

  public static function log($msg)
  {
    $f = fopen(self::$logfile, 'a');
    fputs($f, $msg);
    fclose($f);
  }

}

?>
