<?php

require_once '../Transaction.php';
/** an object from a class */

// $transaction1 = (new Transaction(150, 'milk'))
//     ->vat(8)
//     ->discount(20);
// $transaction2 = (new Transaction(330, 'wine'))
//     ->vat(10)
//     ->discount(5);
// var_dump($transaction1->getAmount());
// var_dump($transaction2->getAmount());
// var_dump($transaction->description);

$mt = (new Transaction(330, 'wine'))
    ->vat(10)
    ->discount(5)
    ->getAmount();
var_dump($mt);