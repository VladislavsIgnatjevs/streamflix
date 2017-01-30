<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 23/01/2017
 * Time: 00:06
 */

include_once 'core/include/header.inc.php';


include_once 'core/include/header.html.php';

require_once 'core/include/html_header.php';


if (!empty($_REQUEST['file_name']) && !empty($_REQUEST['video_title'])) {
    $video_title = $_REQUEST['video_title'];
    $filename = $_REQUEST['file_name'];
    $description = $_REQUEST['video_description'];
    $video = new Video();
    $duration = $video->getVideoDuration($filename);
    $url = $video->getVideoUrl($filename);

    $video = [
        'title' => $video_title,
        'filename' => $filename,
        'description' => $description,
        'duration' => $duration,
    ];

    $mongo = new StreamflixMongo();
    $mongo->selectCollection('videos');
    $collection=$mongo->collection;
    $collection->insertOne($video);


}


?>


<link href="css/dropzone.css" type="text/css" rel="stylesheet"/>
<script src="js/dropzone_options.js"></script>
<script src="js/dropzone.js"></script>


<body>


<div class="container" style="margin-top:10px;">

    <form id="uploadVideoForm" name='uploadVideoForm' action="#" method="post" role="form">
        <h2>Upload video</h2>
        <?php
        if (!empty($_REQUEST['file_name']) && !empty($_REQUEST['video_title'])) {
            ?>
            <div class="alert alert-success" role="alert" id="success-upload">Congratulations, your video is uploaded!
            </div>
            <?php
        }
        ?>

        <div class="alert alert-danger" role="alert" id="error-upload" style="display: none"></div>

        <h3>Video title</h3>
        <div class="form-group">
            <label for="usr">Title:</label>
            <input type="text" class="form-control" id="title">
        </div>


        <h3>Video description</h3>
        <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control" rows="5" id="desc"></textarea>
        </div>


        <h3>Add file</h3>
        <div id="dZUpload" class="dropzone"></div>

        <input type="submit" name="uploaded" id="uploaded" style="display: none">
        <input type="hidden" name="file_name" id="file_name">
        <input type="hidden" name="video_title" id="video_title">
        <input type="hidden" name="video_description" id="video_description">

        <button id="submitButton" value="Upload" name="submitButton">Upload</button>
    </form>

</div>


</body>


<?php

require_once 'core/include/footer.html.php';

require_once 'core/include/html_footer.php';

?>




