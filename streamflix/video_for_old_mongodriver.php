<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 18/01/2017
 * Time: 18:22
 */

require_once 'core/include/header.inc.php';

require_once 'core/include/header.html.php';


if (!empty($_REQUEST['video_id'])) {
    //get video
    $mongo = new StreamflixMongo();
    $mongo->selectCollection('videos');
    $collection = $mongo->collection;
    $video = $collection->findOne(['_id' => new MongoId(trim($_REQUEST['video_id']))]);
    $filename = $video['filename'];
    $title = $video['title'];
    $views = $video['views'];
    $duration = gmdate("H:i:s", $video['duration']);
    $description = $video['description'];
    $pic = str_replace('.mp4', '.jpg', $filename);
    if (empty($views)) {
        $views = 1;

        $collection->update(['_id' => new MongoId(trim($_REQUEST['video_id']))],['$set' => ['views'=>$views]]);
    } else {
        $views = $views+1;
        $collection->update(['_id' => new MongoId(trim($_REQUEST['video_id']))],['$set' => ['views'=>$views]]);
    }


} else {

    header('Location: /main.php');
}


?>


<link rel='stylesheet' href='/css/main_layout.css'>

<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet">

<link href="http://vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.11/video.js"></script>
<script src="js/likes.js"></script>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header id="header">

                    <div class="slider">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="http://placehold.it/1200x400/B70700/1E1A1A&text=StreamFlix">
                                </div>
                                <div class="item">
                                    <img
                                        src="http://placehold.it/1200x400/660000/660000&text=a Smarter way to watch videos">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!--slider-->
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">

                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#mainNav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="site-name"><b>Stream</b>Flix</span>
                            <span class="site-description">Explore the world of videos</span>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="mainNav">
                            <ul class="nav main-menu navbar-nav">
                                <li><a href="/main.php"><i class="fa fa-play"></i> Explore</a></li>
                                <li><a href="/main.php?featured=true"><i class="fa fa-star"></i> Featured</a></li>
                                <li><a href="/main.php?favourites=true"><i class="fa fa-heart"></i> Loved</a></li>
                            </ul>

                            <ul class="nav  navbar-nav navbar-right">
                                <li><a href="/main.php?profile=true"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="/main.php?logout=true"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </header><!--/#HEADER-->

            </div>
        </div>
    </div>

    <!-- videos -->

    <div class="container" style="margin-top:10px;">


        <?php


        ?>


        <div class="panel panel-default">

            <div class="panel-image">
<!--                <video id="<?/* $_REQUEST['video_id'] */?>" class="video-js vjs-16b9 videoplayer" width="70%"
                       height="auto"
                       controls preload="auto" poster='videos/videopics/<?/*= $pic */?>'
                       data-setup='{"fluid": true, "playbackRates": [1, 1.5, 2] }'>
                    <source src="rtmp://0.0.0.0:1935/vod2/<?/*= $filename */?>" type='rtmp/mp4'/>
                </video>-->


                <video id="my_video_1" class="video-js vjs-default-skin vjs-big-play-centered videoplayer" width="100%" height="640px"
                       controls preload="none" poster='videos/videopics/<?= $pic ?>'
                       data-setup='{ "playbackRates": [1, 1.5, 2] }'>
                    <source src="rtmp://0.0.0.0:1935/vod2/<?= $filename ?>" type='rtmp/mp4' />
                    <!--<source src="http://vjs.zencdn.net/v/oceans.webm" type='video/webm' />-->
                </video>
            </div>

            <div class="panel-body">


                <hr/>
                <div class="panel-video">
                    <div class="child">
                        <div class="childinner"><h4><b><?= $title ?></b> (<?= $duration ?>) </h4></div>
                    </div>

                    <div class="child">
                        <div class="childinner views"><h3 style="color:#3875D7;"><?= $views ?> views</h3></div>
                    </div>

                </div>

                <div class="likes_section">
                    <div class="likes">
                        <button class="btn likeBtn" id="likebutton">Like <span class="glyphicon glyphicon-heart "></span></button>
                    </div>
                </div>



                <p><?= $description ?></p>
                </hr>
            </div>
            <div class="panel-footer text-center">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/"><span
                        class="fa fa-facebook"></span></a>
                <a href="https://twitter.com/home?status=https%3A//hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/"><span
                        class="fa fa-twitter"></span></a>
            </div>
        </div>


        <?php

        ?>


    </div>
</div>

<!-- footer -->


<?php
require_once 'core/include/html_footer.php'
?>

