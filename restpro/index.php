<?php
  // Author: David Krawiec
  // Date: 20.09.2017
  session_start();

  require_once('./classes/Conf.php');

  $ABSOLUTE_PATH = __DIR__;
  $CONF = new Conf($ABSOLUTE_PATH . '/conf.ini');
  $PATH_NAME = $CONF->getPath();
  $DEBUGGING = $CONF->getDebugging();

  if($DEBUGGING === 'true'){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  }
  require_once('./rest.php');
  require_once('./lib/url.php');
  require_once('./classes/DB.php');
  require_once('./classes/Logger.php');
  require_once('./classes/User.php');

  $sRequestedURL = $_SERVER['REQUEST_URI'];
  $sURL = str_replace($PATH_NAME, '', $sRequestedURL);
  $aConf = $CONF->getConf();
  $DB = new DB($aConf['database']['db_ip'], $aConf['database']['db_name']);

  // Need configuration in the conf.ini otherwise die
  if(!$CONF->DBIsSet() || !$DB->connection_established()){
    die("DB is not set. No Connection");
  }

  $URL = get_url($sURL);
  if($URL == '/rest'){
     // REST-requests
    header('Content-Type: application/json');
    $second_url = get_second_url($sURL, $REST);
    $restCall = &get_page($second_url, $REST);
    if(isset($restCall['script']))
        $restCall['script']($DB);
  }
?>
