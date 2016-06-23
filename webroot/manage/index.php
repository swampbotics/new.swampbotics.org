<?php

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';
require 'session.php';

session_startsecure();
mustbeloggedin();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        header('Content-type: application/json');
        $return = array();
        $db = new Db();
        switch ($_GET['type']) {
            case 'update':
                $db->query(
                    'UPDATE events
                    SET season=(?), name=(?), tagline=(?), date=(?),
                    release_date=(?), robots=(?), description=(?), content=(?)
                    WHERE id=(?)',
                    'ssssssssi',
                    $_POST['season'],
                    $_POST['name'],
                    $_POST['tagline'],
                    $_POST['date'],
                    $_POST['release_date'],
                    $_POST['robots'],
                    $_POST['description'],
                    $_POST['content'],
                    $_POST['id']
                );
                $return['type'] = "success";
                $return['text'] = "Updated event with id: ".$_POST['id'];
                break;
            case 'delete':
                $db->query('DELETE FROM events WHERE id=(?)', 'i', $_POST['id']);
                $return['type'] = "error";
                $return['text'] = "Deleted event with id: ".$_POST['id'];
                break;
            case 'add':
                $db->query(
                    'INSERT INTO events
                    SET season=(?), name=(?), tagline=(?), date=(?),
                    release_date=(?), robots=(?), description=(?), content=(?)',
                    'ssssssss',
                    $_POST['season'],
                    $_POST['name'],
                    $_POST['tagline'],
                    $_POST['date'],
                    $_POST['release_date'],
                    $_POST['robots'],
                    $_POST['description'],
                    $_POST['content']
                );
                $return['type'] = "success";
                $return['text'] = "Successfully added the event";
                break;
            default:
                $return['type'] = "error";
                $return['text'] = "Invalid Post";
        }
        echo json_encode($return);
        break;
    default:
        /* ------------------- FIX SEASON -------------------*/
        if (!isset($_GET['season'])) {
            header('Location: /manage/'.strtolower($CONFIG['season']).'/');
        }

        /* ------------------- DB STUFF -------------------*/
        $db = new Db();
        $getSeason = str_replace('-', ' ', ucwords($_GET['season']));
        $events = $db->query(
            'SELECT name, season, date, description FROM events WHERE season=(?)',
            's',
            $getSeason
        );

        /* ------------------- BAD SEASON -------------------*/
        if (empty($events)) {
            $season = str_replace(' ', '-', strtolower($CONFIG['season']));
            header("Location: /manage/".$season."/");
        }

        $thisPage = new Page();
        $thisPage->nav = false;
        $thisPage->js = '<script src="assets/js/custom/manage.js"></script>';

        if (isset($_GET['event']) && !empty($_GET['event'])) {
            /* ------------------- DB STUFF -------------------*/
            $getEvent = str_replace('-', ' ', ucfirst($_GET['event']));
            $event = $db->query(
                'SELECT * FROM events WHERE season=(?) AND name=(?) LIMIT 1',
                'ss',
                $getSeason,
                $getEvent
            );

            /* ------------------- BAD EVENT -------------------*/
            if (empty($event)) {
                $season = str_replace(' ', '-', strtolower($CONFIG['season']));
                header("Location: /manage/".$season."/");
            }

            /* ------------------- RENDER EVENT PAGE -------------------*/
            $event = $event[0];
            $thisPage->title = $event['name'].' - '.$event['season'];
            $thisPage->header = str_replace(
                array(
                    '{page}'
                ),
                array(
                    'Home'
                ),
                file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/manage.html')
            );
            $thisPage->content = str_replace(
                array(
                    '{event-id}',
                    '{event-season}',
                    '{event-name}',
                    '{event-tagline}',
                    '{event-date}',
                    '{event-release-date}',
                    '{event-robots}',
                    '{event-description}',
                    '{event-content}'
                ),
                array(
                    $event['id'],
                    $event['season'],
                    $event['name'],
                    $event['tagline'],
                    $event['date'],
                    $event['release_date'],
                    $event['robots'],
                    $event['description'],
                    $event['content']
                ),
                file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/manage/home-event.html')
            );
        } else {
            /* ------------------- RENDER EVENTS PAGE -------------------*/
            $thisPage->title = 'Home';
            $thisPage->meta = '';
            $thisPage->header = str_replace(
                array(
                    '{page}'
                ),
                array(
                    $thisPage->title
                ),
                file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/manage.html')
            );
            $thisPage->content = str_replace(
                array(
                    '{season}',
                    '{events}',
                    '{form-season}',
                    '{form-cdate}',
                    '{form-tdate}'
                ),
                array(
                    strtolower($_GET['season']),
                    manageEvents($events),
                    ucfirst($_GET['season']),
                    date('Y-m-d'),
                    date('Y-m-d', strtotime('+1 day'))
                ),
                file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/manage/home.html')
            );
        }
        $user = $db->query('SELECT name, email FROM users WHERE id=(?)', 'i', $_SESSION['userid']);
        $thisPage->content = str_replace(
            array(
                '{nav}',
                '{user-name}',
                '{user-email}'
            ),
            array(
                file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/manage/nav.html'),
                $user[0]['name'],
                $user[0]['email']
            ),
            $thisPage->content
        );
        $thisPage->output();
}
