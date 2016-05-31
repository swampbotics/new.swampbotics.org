<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);


require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$year = "2014";
echo date('Y', mktime(0, 0, 0, 12, 31, $year));
