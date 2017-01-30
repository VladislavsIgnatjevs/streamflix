<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 16/01/2017
 * Time: 21:08
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

require '/vendor/autoload.php';
require_once "classes/Db.php";
require_once "classes/User.php";
require_once "classes/Video.php";
require_once "classes/StreamflixMongo.php";
require_once "core/include/functions.php";

session_start();
$user = new User();
if (!$user->checkLogin() && !strpos($_SERVER['REQUEST_URI'],'index.php')) {
    header('Location: /index.php');
}