<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->header = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/index.html');
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/index.html');

$db = new Db();
$recent = $db->query("SELECT * FROM events WHERE DATE(release_date)<DATE(NOW()) ORDER BY date DESC LIMIT 2");
$thisPage->content = str_replace('{past-events}', formatEventIndex($recent), $thisPage->content);

$thisPage->title = 'Home';
$thisPage->canonical = '';
$thisPage->description = "We're team 2105 from Ware County High School in Waycross, Georgia.
    We've competed in VEX Robotics since 2010, won several tournaments,
    earned many awards, and most importantly, had a lot of fun.
    We are competitive, organized, motivated, and hard-working.
    We're constantly developing our hardware, software, and strategy.";
$thisPage->output();
