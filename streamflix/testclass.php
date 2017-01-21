<?php

/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 19/01/2017
 * Time: 15:52
 */
class testclass
{


    public function get_url($request_url) {

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $request_url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $JsonResponse = curl_exec($curl_handle);
        $http_code = curl_getinfo($curl_handle);

        return($JsonResponse);
    }
}