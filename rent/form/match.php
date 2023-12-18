#!/usr/bin/env php
<?php
/* this file shows similarities and differences between match expression as in php 8 nad switch statements */

/* switch statements first */
echo "switch statement\n";
echo "\n";
$number = 5;
switch ($number)
{
    case 1:
        echo "fist option and your number is" . " " . $number. "\n";
        break;
    case 2:
        echo "second option and your number is" . " " . $number. "\n";
        break;
    case 3:
        echo "third option and your number is" . " " . $number. "\n";
        break;
    case 4:
        echo "fourth option and your number is" . " " . $number. "\n";
        break;
    case 5:
        echo "fifth option and your number is" . " " . $number. "\n";
        break;
    case 6:
        echo "last option and your number is" . " " . $number. "\n";
        break;
    default:
        echo "Number does not exist among the provided options\n";
}
/* match option */
echo "\n";

echo "match statement\n";
$digit = 3;
echo "\n";

$digitInQuestion = match($digit)
{
    1 => print 'first option'.' '. $digit. "\n",
    2 => print 'second option'.' '. $digit. "\n",
    3 => print 'third option'.' '. $digit. "\n",
    4 => print 'fourth option'.' '. $digit. "\n",
    5 => print 'fifth option'.' '. $digit. "\n",
};
echo "\n";

// echo $digitInQuestion;
