<?php

require_once 'StringManipulation.php';

/* Read String */
$stdin = fopen("php://stdin", "r");
$custom_string = trim(fgets($stdin));

$obj_str = new StringManipulation();
$obj_str->manipulatIt($custom_string);
