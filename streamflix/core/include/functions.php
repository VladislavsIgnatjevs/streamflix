<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 17/01/2017
 * Time: 19:51
 */
function getVideoFiles()
{
    $videos = [];
    foreach (new DirectoryIterator('/videos/mp4') as $file) {
        if ($file->isFile()) {

            //only mp4s
            if ($file->getExtension() == 'mp4') {
                $videos[] =  $file->getFilename() . "\n";
            }
        }
    }
    return $videos;

}