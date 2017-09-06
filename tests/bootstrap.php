<?php
define('ENVIRONMENT', 'phpunit');
require_once(__DIR__ ."/../vendor/autoload.php");

$al = new \Composer\Autoload\ClassLoader();
$al->addPsr4('JmWri\\Pubg\\Test\\', __DIR__ . '/../tests');
$al->register();
