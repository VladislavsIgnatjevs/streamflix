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

var_dump($_REQUEST);


?>


<link href="css/dropzone.css" type="text/css" rel="stylesheet"/>
<script src="js/dropzone_options.js"></script>
<script src="js/dropzone.js"></script>


<body>


<div class="container" style="margin-top:10px;">

    <form id="uploadVideoForm" name='uploadVideoForm' action="#" method="post" role="form">
        <h2>Upload video</h2>

        <div class="alert alert-success" role="alert" id="success-upload" style="display: none"></div>
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




