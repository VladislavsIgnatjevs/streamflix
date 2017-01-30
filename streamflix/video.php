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
    $client = new MongoDB\Client('mongodb://mongodb_streamflix');
    $collection = $client->streamflixmongodb->videos;

    $video = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID(trim($_REQUEST['video_id']))]);
    $filename = $video['filename'];
    $title = $video['title'];
    $views = $video['views'];
    $duration = gmdate("H:i:s", $video['duration']);
    $description = $video['description'];
    $pic = str_replace('.mp4', '.jpg', $filename);


    if (empty($views)) {
        $views = 1;

        $collection->updateOne(['_id' => new MongoDB\BSON\ObjectID(trim($_REQUEST['video_id']))],['$set' => ['views'=>$views]]);
    } else {
        $views = $views+1;
        $collection->updateOne(['_id' => new MongoDB\BSON\ObjectID(trim($_REQUEST['video_id']))],['$set' => ['views'=>$views]]);
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

<?php
require_once 'core/include/html_header.php';
?>

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

