<?php
$config = require_once(__DIR__.'/../local/config.php.inc');
$loader = require_once __DIR__.'/../vendor/autoload.php';

$app = new  Metayogi\Foundation\Application($config);
$app->run();
