<?php

require 'session.php';

session_startsecure();
if (isset($_SESSION["userid"])) {
    session_destroysecure();
    header("Location: /manage/login");
} else {
    session_startsecure();
    session_destroysecure();
    header("Location: /manage/login");
}
