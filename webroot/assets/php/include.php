<?php

$autoTitle = ucfirst(str_replace('.php', '', basename($_SERVER['PHP_SELF'])));
$autoPage = str_replace('.php', '.html', basename($_SERVER['PHP_SELF']));

include $_SERVER['DOCUMENT_ROOT'].'/assets/php/db.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/assets/php/page.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/assets/php/misc.php';
