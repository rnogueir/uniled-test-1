<?php

namespace UniLEDApp;

class Logger
{

  private static $logfile = 'log/uniled.log';

  public static function log($msg)
  {
    $f = fopen($logfile, 'w+');
    fputs($f, $msg);
    fclose($f);
  }

}

?>
