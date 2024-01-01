<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$con = mysqli_connect('localhost', 'root', '', 'first');
if (!$con) {
    die(mysqli_error($con));
}
