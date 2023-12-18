<?php
declare(strict_types=1);
/** A class that used to do transaction of money */

class Transaction
{
    /**field/attributes/properties */
    private float $amount;
    private string $description;


    /**constructor magic method */
    public function __construct(float $amount, string $description)
    {
        $this->amount=$amount;
        $this->description = $description;
    }
    /**methods */
     public function vat(float $rate): Transaction
    {
        $this->amount += $this->amount * $rate/100;
        return $this;
    }
     public function discount(float $off): Transaction
    {
        $this->amount -= $this->amount * $off/100;
        return $this;
    }

     public function getAmount(): float
    {
        return $this->amount;
    }

    /**destruct magic method */
    public function __destruct()
    {
        echo 'Destruct' . ' '.$this->description.'</br>';
    }

}