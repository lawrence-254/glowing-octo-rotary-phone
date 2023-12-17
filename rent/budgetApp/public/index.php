<?php
declare(strict_types= 1);

$root = dirname(__DIR__).DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILE_PATH', $root . 'transaction' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views'. DIRECTORY_SEPARATOR);

require APP_PATH . "App.php";
$file= getTransactionFiles();
var_dump($file);
