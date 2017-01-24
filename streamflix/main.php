<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 18/01/2017
 * Time: 18:22
 */

require_once 'core/include/header.inc.php';

require_once 'core/include/header.html.php';

//get videos
$videos = [];
foreach (new DirectoryIterator('videos/mp4') as $file) {
    if ($file->isFile()) {

        //only mp4s
        if ($file->getExtension() == 'mp4') {
            $videos[] = $file->getFilename() . "\n";
        }
    }
}


//$video = [
//    'title' => 'vid',
//    'description' => 'desc',
//    'mongo' => 'yep',
//];
//
//$connection = new MongoClient('mongodb');
//$db = $connection->streamflixmongodb;
//$collection = $db->createCollection('videos');
//$collection->insert($video);



require_once 'core/include/html_header.php';
?>




    <!-- videos -->

    <div class="container" style="margin-top:10px;">
        <div class="row form-group">

        </div>

        <div class="row form-group">

            <?php

            foreach ($videos as $vid) {

                $videofile = trim('videos/mp4/' . $vid);
                $pic = str_replace('.mp4', '.jpg', $vid);
                $picfile = trim('videos/videopics/' . $pic);

                if (!file_exists($picfile)) {
                    $video = new Video();
                    $video->getVideoPic($videofile, $picfile);
                    $frame = $video->frame;
                } else {
                    $frame = $picfile;
                }

                ?>

                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-image">
                            <img
                                src="<?= $frame ?>"
                                class="panel-image-preview"/>
                            <label for="toggle-4"></label>
                        </div>
                        <div class="panel-body">
                            <h4><b>Video title</b> (03:00)</h4>
                            <p>A love story about one young man and Docker</p>

                            <p><a class="btn btn-primary btn-lg" href="video.php?video-id=1" role="button">Watch <span
                                        class="glyphicon glyphicon-play-circle" aria-hidden="true"></span></a></p>
                        </div>
                        <div class="panel-footer text-center">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/"><span
                                    class="fa fa-facebook"></span></a>
                            <a href="https://twitter.com/home?status=https%3A//hub.docker.com/r/vignatjevs/nginx-php5-fpm-xdebug-ffmpeg/"><span
                                    class="fa fa-twitter"></span></a>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>


        </div>


    </div>

</div>
    <!-- footer -->

<?php
require_once 'core/include/html_footer.php'
?>

    <!-- .wrapper -->


