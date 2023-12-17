<?php
declare(strict_types= 1);

$root = dirname(__DIR__).DIRECTORY_SEPARATOR;
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILE_PATH', $root . 'transaction' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views'. DIRECTORY_SEPARATOR);

require APP_PATH . "App.php";
$files= getTransactionFiles(FILE_PATH);
// require FILE_PATH . "file.csv";
$transactions = [];
foreach($files as $file)
{
    $transactions = array_merge($transactions, getTransactions($file));
}

require VIEWS_PATH . "transaction.php";