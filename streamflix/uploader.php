<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 23/01/2017
 * Time: 19:36
 */


$ds          = DIRECTORY_SEPARATOR;

$storeFolder = 'videos/mp4';

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

    $targetFile =  $targetPath. $_FILES['file']['name'];

    move_uploaded_file($tempFile,$targetFile);
}
?>
