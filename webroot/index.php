<?php

//ini_set("display_errors", "1");
//error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->header = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/index.html');
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/index.html');

$db = new Db();
$upcoming = $db->query("SELECT * FROM events WHERE date>=(?) ORDER BY date ASC LIMIT 2", "s", date('Y-m-d'));
$thisPage->content = str_replace('{upcoming-events}', formatEventIndex($upcoming), $thisPage->content);
$recent = $db->query("SELECT * FROM events WHERE date<(?) ORDER BY date DESC LIMIT 2", "s", date('Y-m-d'));
$thisPage->content = str_replace('{past-events}', formatEventIndex($recent), $thisPage->content);

$thisPage->title = 'Home';
$thisPage->canonical = '';
$thisPage->description = '';
$thisPage->output();
