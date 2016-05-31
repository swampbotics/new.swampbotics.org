<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'].'/assets/php/include.php';
$thisPage = new Page();
$thisPage->meta = '';
$thisPage->navType = 'dark-middle';
$thisPage->header = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/headers/post.html');
$thisPage->content = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/assets/html/pages/post.html');
$thisPage->title = $autoTitle;
$thisPage->canonical = '';
$thisPage->description = '';
if(isset($_GET['post'])){
  if(isset($_GET['year'])){
    $db = new Db();
    $post = $db->query("SELECT * FROM events WHERE slug=(?) AND release_date<=(?) AND year=(?)", "sss", $_GET['post'], date('Y-m-d'), $_GET['year']);
    if(empty($post)){
      echo "empty";
    }
    //$next = $db->query("SELECT date, name, release_date, slug, year FROM events WHERE date>(?) LIMIT 1", "s", $post[0]['date']);
    //$previous = $db->query("SELECT date, name, release_date, slug, year FROM events WHERE date<(?) LIMIT 1", "s", $post[0]['date']);
    $thisPage->content = str_replace('{post}', formatPost($post), $thisPage->content);
    //$thisPage->content = str_replace('{pagination}', formatPostPagination($previous, $next), $thisPage->content);
    $thisPage->content = str_replace('{pics}', formatGallary($post[0]['year'].'/'.$post[0]['slug']), $thisPage->content);
    $thisPage->header = str_replace('{name}', $post[0]['name'], $thisPage->header);
    $thisPage->header = str_replace('{tagline}', $post[0]['tagline'], $thisPage->header);
    $thisPage->header = str_replace('{year}', $post[0]['year'], $thisPage->header);
    $thisPage->header = str_replace('{slug}', $post[0]['slug'], $thisPage->header);


  } else {
    header('Location: /events');
  }
} else {
  header('Location: /events');
}
$thisPage->output();
