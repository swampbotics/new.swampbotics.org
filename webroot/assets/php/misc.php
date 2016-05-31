<?php

$autoTitle = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
$autoTitle = ucfirst($autoTitle);
$autoPage = str_replace('.php', '.html', basename($_SERVER['PHP_SELF']));

/* ------------------- FUNC -------------------*/

function formatEvent($dataArr){
  $ret;
  foreach($dataArr as $data){
    $ret .= '<div class="blog-item">
        <!-- Blog-item Header & Media-->
        <a class="blog-media animsition-link" href="event/'.$data['year'].'/'.$data['slug'].'">
            <img class="parallax-img img-responsive" src="assets/img/events/'.$data['year'].'/'.$data['folder'].'/main.jpg" alt="" data-center="transform: translate3d(0px, -50%, 0px)" data-top-bottom="transform: translate3d(0px, -10%, 0px)" data-bottom-top="transform: translate3d(0px, -90%, 0px)">
        </a>
        <!-- Date, Author, Categories, Comments -->
        <div class="blog-item-detail row">
            <div class="col-sm-10">
                <a><i class="fa fa-wrench"></i> '.$data['robots'].'</a>
                <a><i class="fa fa-sitemap"></i> '.$data['rank'].'</a>
            </div>
            <div class="col-sm-2 text-right  padding-top-xs-15 ">
                <a href="event/'.$data['year'].'/'.$data['slug'].'" class="btn-blog-more animsition-link"><span>view post</span><i class="btn-icon ci-icon-uniE8BE"></i></a>
            </div>
        </div>
        <div class="row blog-item-title-wrapper">
            <div class="blog-item-title col-sm-4">
                <h1 class=" font-second">'.$data['name'].'</h1>
                <span class="post-date">'.date("F j, Y", strtotime($data['date'])).'</span>
            </div>
            <!-- Text Intro -->
            <div class="col-sm-8 blog-item-body">
                <p>
                    '.$data['description'].'
                </p>
            </div>
        </div>
    </div>';
  }
  return $ret;
}

function formatEventIndex($dataArr){
  $return;
  if(count($dataArr) == 1){
    $row = "12";
  }else{
    $row = "6";
  }
  foreach($dataArr as $data){
    $return .= '<article class="blog-post-preview margin-bottom-xs-40 col-sm-'.$row.'" style="padding-bottom: 90px">
        <a href="event/'.$data['year'].'/'.$data['slug'].'" class="blog-post-preview-link animsition-link" data-animsition-out="fade-out-up-sm" data-animsition-out-duration="500">
            <div class="blog-post-preview-img">
                <img class="parallax-img img-responsive" src="assets/img/events/'.$data['year'].'/'.$data['folder'].'/main.jpg" alt="" data-center="transform: translate3d(0px, -50%, 0px)" data-top-bottom="transform: translate3d(0px, -10%, 0px)" data-bottom-top="transform: translate3d(0px, -90%, 0px)">
            </div>
            <div>
                <h2 class="blog-post-preview-title font-second">'.$data['name'].'</h2>
            </div>
            <div class="blog-post-preview-date font-second">'.date("F j, Y", strtotime($data['date'])).'</div>
            <div class="blog-post-preview-text">
                <p>'.$data['description'].'</p>
            </div>
        </a>
    </article>';
  }
  return $return;
}


function formatPost($dataArr){
  $return;
  foreach($dataArr as $data){
    $return = '<section class="blog-post">
        <!-- Post Media -->
        <div id="images-slider-1" class="blog-item-slider owl-carousel carousel dots-under">
            {pics}
        </div>
        <!-- Post Title -->
        <h1 class="blog-page-post-title font-second">'.$data['name'].'</h1>
        <!-- Date, Author, Categories, Comments -->
        <div class="blog-item-detail no-margin-left">
          <a><i class="fa fa-wrench"></i> '.$data['robots'].'</a>
          <a><i class="fa fa-sitemap"></i> '.$data['rank'].'</a>
        </div>
        <!-- Post body text -->
        <div class="blog-item-body">
            '.$data['content'].'
        </div>
        <!--/ End Post body text -->
    </section>';
  }
  return $return;
}

function formatGallary($folder){
  $pics;
  $dir = 'assets/img/events/'.$folder;
  $files1 = scandir($dir.'/slides');
  foreach($files1 as $file){
    if ($file != "." && $file != "..") {
      $pics .= '<img src="assets/img/events/'.$folder.'/'.'slides/'.$file.'" alt="">';
    }
  }
  return $pics;
}

function formatPostPagination($previous, $next){
  $divNext = '';
  $divPrevious = '';
  $colPrevious = "col-sm-6";
  $colNext = "col-sm-6";
  if(empty($previous)){
    $colPrevious = "col-sm-12";
  }
  if(empty($next)){
    $colNext = "col-sm-12";
  }

  if(!empty($previous)){
    $divPrevious = '<a href="event/'.$previous[0]['year'].'/'.$previous[0]['slug'].'" class="article-nav-link '.$colNext.'">
        <i class="ci-icon-uniE893"></i>
        <p>'.$previous[0]['name'].'
            <br /><span class="post-date">'.date("F j, Y", strtotime($next[0]['date'])).'</span></p>
    </a>';
  }
  if(!empty($next)){
    $divNext = '<a href="event/'.$next[0]['year'].'/'.$next[0]['slug'].'" class="article-nav-link '.$colPrevious.'">
        <p>'.$next[0]['name'].'
            <br /> <span class="post-date">'.date("F j, Y", strtotime($next[0]['date'])).'</span></p>
        <i class="ci-icon-uniE890"></i>
    </a>';
  }
  $return = '<nav class="article-nav row">'.$divPrevious.$divNext.'</nav>';
  return $return;
}
