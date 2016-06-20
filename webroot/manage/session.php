<?php

/**
 * Initializes secure settings for built-in PHP session handling
 * Configuration is adapted for insecure development environments.
 * IP address and UA will be checked and if they are not valid the script will exit.
 * @return void
 */
function session_startsecure($expires = 604800) // cookie expires in one week
{
    if ($_SERVER["SERVER_NAME"] === "swampbotics.org") {
        // sets cookie lifetime to browser session, '/' path, current host (so it will work on staging), HTTPS only
        // Arguably this should be set in the actual INI file, but this ensures that they actually are set.
        session_name('session');
        ini_set('session.use_trans_sid', 0);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.hash_function', 'SHA512');
        ini_set('session.hash_bits_per_character', 5);
        ini_set('session.entropy_file', '/dev/urandom');
        ini_set('session.entropy_length', '512');
        session_set_cookie_params($expires, '/', '.swampbotics.org', true, true);
    }
    session_start();
}

/**
 * Securely destroys this session.
 * @return void
 */
function session_destroysecure()
{
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 86400,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
    session_destroy();
}

function mustbeloggedin()
{
    if (!isset($_SESSION["userid"])) {
        header("Location: /manage/login");
    }
}

function mustbeloggedout()
{
    if (isset($_SESSION["userid"])) {
        header("Location: /manage/logout");
    }
}
