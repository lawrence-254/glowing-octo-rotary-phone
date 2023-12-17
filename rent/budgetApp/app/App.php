<?php
declare(strict_types =1);

function getTransactionFiles(string $dirPath): array
{
    $files = [];
    foreach(scandir($dirPath) as $file)
    {
        if (is_dir($file))
        {
            continue;
        }
        $files[]=$dirPath.$file;
    }
    return $files;
}
function getTransactions(string $fileName): array
{
    $transactions=[];
    if (! file_exists($fileName))
    {
        trigger_error('File' . $fileName.'does not exist', E_USER_ERROR);
    }
    $file = fopen($fileName, 'r');
    fgetcsv($file);

    while (($transaction=fgetcsv($file)) !== false)
    {
        $transactions[] = extractTransaction($transaction);
    }
    return $transactions;
}
function extractTransaction(array $transactionRow): array
{
    [$TransactionID,$Date,$Description,$Amount,$Type,$Category,$Account]=$transactionRow;

    return [
        'TransactionID' => $TransactionID,
        'Date' => $Date,
        'Description' => $Description,
        'Amount' => $Amount,
        'Type' => $Type,
        'Category' => $Category,
        'Account' => $Account
    ];
}