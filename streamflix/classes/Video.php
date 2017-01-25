<?php

/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 15/01/2017
 * Time: 17:54
 */

class Video
{

    public $video = false;
    public $frame = false;
    public $video_url = false;

    function getVideoUrl($filename)
    {
        return trim('rtmp://localhost:1935/vod2/'.$filename);
//        $db = new DB();
//        if (!empty($id)) {
//            $sql = 'SELECT * FROM `videos` WHERE `id` = :id';
//            $params = ['id' => $id];
//            if ($db->executeTransaction()) {
//                $data = $db->query($sql, $params);
//
//            }
//
//        } elseif (!empty($user_id)) {
//            $sql = 'SELECT * FROM `videos` WHERE `user_id` = :user_id';
//            $params = [':user_id' => $user_id];
//
//        } elseif (!empty($date)) {
//            $sql = 'SELECT * FROM `videos` WHERE `date` = :date';
//            $params = [':date' => $date];
//
//        }
    }

    function getVideoDuration($video) {
        $video = trim('videos/mp4/' . $video);
        $bins = [
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 1,   // The number of threads that FFMpeg should use
        ];

        $ffprobe = FFMpeg\FFProbe::create($bins);
        $duration = $ffprobe
            ->format($video) // extracts file informations
            ->get('duration');
        return($duration);
    }

    function getVideoByID($id) {

    }




function getVideoPic($videofile,$picfile) {

    $bins = [
        'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
        'ffprobe.binaries' => '/usr/bin/ffprobe',
        'timeout'          => 3600, // The timeout for the underlying process
        'ffmpeg.threads'   => 1,   // The number of threads that FFMpeg should use
    ];
    $ffmpeg = FFMpeg\FFMpeg::create($bins);


    $video = $ffmpeg->open($videofile);
    $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(5))
        ->save($picfile);
    $this->frame =  $picfile;
}




}



