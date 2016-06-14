<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';

$season = $CONFIG['season'];

$thisPage = new Page();
$thisPage->meta = '';
$thisPage->canonical = '';
$date = date('Y-m-d');

if (isset($_GET['season'])) {
    /* ---------------------------------------------------- MULTIPLE EVENTS ----------------------------------------------------*/
    $thisPage->header = str_replace(
        '{season}',
        str_replace('-', ' ', $_GET['season']),
        file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/events.html')
    );
    $thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/events.html');
    $thisPage->title = $autoTitle;
    $thisPage->navType = 'dark-top';
    $thisPage->description = '';

    /* ------------------- DB STUFF -------------------*/
    $getSeason = str_replace('-', ' ', ucwords($_GET['season']));
    $db = new Db();
    $events = $db->query(
        "SELECT * FROM events WHERE season=(?) AND release_date<=(?) ORDER BY date DESC",
        "ss",
        $getSeason,
        $date
    );

    /* ------------------- BAD SEASON -------------------*/
    if (empty($events)) {
        $season = str_replace(' ', '-', strtolower($season));
        header("Location: /events/".$season."/");
    }

    /* ---------------------------------------------------- SINGLE EVENT ----------------------------------------------------*/
    if (isset($_GET['event']) && !empty($_GET['event'])) {
        /* ------------------- DB STUFF -------------------*/
        $event = $db->query(
            "SELECT * FROM events WHERE season=(?) AND name=(?) LIMIT 1",
            "ss",
            str_replace('-', ' ', $_GET['season']),
            str_replace('-', ' ', $_GET['event'])
        );

        /* ------------------- BAD EVENT -------------------*/
        if (empty($event)) {
            $season = str_replace(' ', '-', strtolower($season));
            header("Location: /events/".$season."/");
        }

        /* ------------------- RENDER -------------------*/
        $event = $event[0];
        $thisPage->header = str_replace(
            array(
                '{season}',
                '{name}',
                '{tagline}',
                '{img-season}',
                '{img-event}'
            ),
            array(
                $event['season'],
                $event['name'],
                $event['tagline'],
                str_replace(' ', '-', strtolower($event['season'])),
                str_replace(' ', '-', strtolower($event['name']))
            ),
            file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/post.html')
        );
        $thisPage->content = str_replace(
            array('{post}', '{pics}'),
            array(
                formatPost($event),
                formatGallary(str_replace(' ', '-', strtolower($event['season'])). '/' . str_replace(' ', '-', strtolower($event['name'])))
            ),
            file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/post.html')
        );
        $thisPage->title =  $event['name'].' - '.$event['season'];
        $thisPage->navType = 'dark-middle';
        $thisPage->description = $event['description'];
    }
} else {
    $season = str_replace(' ', '-', strtolower($season));
    header("Location: /events/".$season."/");
}

$thisPage->content = str_replace('{events}', formatEvent($events), $thisPage->content);
$thisPage->output();
