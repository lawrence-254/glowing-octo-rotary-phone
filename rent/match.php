#!/usr/bin/env php
<?php
/* this file shows similarities and differences between match expression as in php 8 nad switch statements */
/* switch statements first */

$number = 5;

switch ($number)
{
    case 1:
        echo "fist option and your number is" . " " . $number;
        break;
    case 2:
        echo "second option and your number is" . " " . $number;
        break;
    case 3:
        echo "third option and your number is" . " " . $number;
        break;
    case 4:
        echo "fourth option and your number is" . " " . $number;
        break;
    case 5:
        echo "fifth option and your number is" . " " . $number;
        break;
    case 6:
        echo "last option and your number is" . " " . $number;
        break;
    default:
        echo "Number does not exist among the provided options";
}