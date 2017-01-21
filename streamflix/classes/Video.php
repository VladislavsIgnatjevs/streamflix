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
            if ($db->executeTransaction()) {
                $data = $db->query($sql, $params);

            }

        } elseif (!empty($user_id)) {
            $sql = 'SELECT * FROM `videos` WHERE `user_id` = :user_id';
            $params = [':user_id' => $user_id];

        } elseif (!empty($date)) {
            $sql = 'SELECT * FROM `videos` WHERE `date` = :date';
            $params = [':date' => $date];

        }
    }


    function generateVideoPreviews()
    {
        // Путь до залитого видео-файла, например временный файл полученный по $_FILES['tmp_file']
        $inputPath = $_FILES['tmp_file'];

//Путь до результирующего файла, то есть отконвертированный и прошитый мета-данными видео-файл
        $outputPath = "/path/video/filename.flv";

// Указываем минимальную позицию фрейма для захвата превью
        $previewFrameMin = '3';

// Путь до превью-файла
        $previewPath = "/path/preview/filename.jpg";

// Путь до мини-превью
        $previewMiniPath = "/path/preview/filename_mini.jpg";

// Массив для сбора ошибок
        $errorInfo = array();

        /*
 * Конвертируем FLV во временный файл ($outputPath . '_temp').
 */
        passthru(
            '/usr/local/bin/ffmpeg -i ' . escapeshellarg($inputPath) .
            ' -f flv ' .
            ' -s 320x240 ' .
            ' -acodec libmp3lame ' .
            ' -ar 44100 ' .
            escapeshellarg($outputPath . '_temp'),
            $errorInfo['ffmpeg']
        );

        /*
 * Прошиваем metadata (позиции ключевых фреймов) для перемотки
 */
        passthru(
            '/usr/local/bin/yamdi -i ' . escapeshellarg($outputPath . '_temp') .
            ' -o ' . escapeshellarg($outputPath),
            $errorInfo['yamdi']);

        /*
         * Удаление временного файла, он нам уже не нужен...
         */
        unlink($outputPath . '_temp');


        /*
 * С помощью расширения php5-ffmpeg получаем информацию о видео-файле
 */
        $movie = new ffmpeg_movie($outputPath);

        /*
         * Вычисляем время воспроизведения видеофайла
         */
        $duration = $movie->getDuration();

        /*
         * Вычисляем количество кадров
         */
        $frameCount = $movie->getFrameCount();

        /*
         * Вычисляем позицию фрейма для его захвата
         */
        $framePosition = ($frameCount > $previewFrameMin) ? $frameCount / 2 : $previewFrameMin;

        /*
         * Получаем объект фрейма для превью
         */
        $preview = $movie->getFrame($framePosition);

        /*
 * Записываем в файл - Превью (320x240)
 */
        imagejpeg($preview->toGDImage(), $previewPath);

        /*
         * Записываем в файл - Мини-превью (160x120)
         */

        $previewMini = imagecreatetruecolor(160, 120);

        $r = imagecopyresized(
            $previewMini,
            $preview->toGDImage(),
            0, 0, 0, 0,
            160, 120,
            320, 240
        );

        imagejpeg($previewMini, $previewMiniPath);

    }
}