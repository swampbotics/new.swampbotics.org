<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->navType = 'dark-top';
$thisPage->header = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/events.html');
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/events.html');
$thisPage->title = $autoTitle;
$thisPage->canonical = '';
$thisPage->description = '';

$year = date('Y-m-d');
if(isset($_GET['year'])){
  $year = date('Y-m-d', mktime(0, 0, 0, 12, 31, $year));
}

$db = new Db();
$events = $db->query("SELECT * FROM events WHERE date<=(?) AND release_date<=(?) ORDER BY date DESC", "ss", $year, date('Y-m-d'));
$thisPage->content = str_replace('{events}', formatEvent($events), $thisPage->content);


$thisPage->output();
