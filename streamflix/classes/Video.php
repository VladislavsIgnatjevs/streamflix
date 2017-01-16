<?php

/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 15/01/2017
 * Time: 17:54
 */
class Video
{
    function GetVideoUrl($id = false, $user_id = false, $date = false)
    {
        $db = new DB();
        if (!empty($id)) {
            $sql = 'SELECT * FROM `videos` WHERE `id` = :id';
            $params = ['id' => $id];
            if ($db->executeTransaction()){
                $data = $db->query($sql,$params);

            }

        } elseif (!empty($user_id)) {
            $sql = 'SELECT * FROM `videos` WHERE `user_id` = :user_id';
            $params = [':user_id' => $user_id];

        } elseif (!empty($date)) {
            $sql = 'SELECT * FROM `videos` WHERE `date` = :date';
            $params = [':date' => $date];

        }
    }
}