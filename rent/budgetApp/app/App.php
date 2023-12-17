<?php
declare(strict_types =1);

function getTransactionFiles(): array
{
    $files = [];
    foreach(scandir(FILE_PATH) as $file)
    {
        if (is_dir($file))
        {
            continue;
        }
        $files[]=$file;
    }
    return $files;
}