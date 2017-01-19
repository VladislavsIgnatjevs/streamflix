<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 16/01/2017
 * Time: 21:08
 */
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');

require_once "classes/Db.php";
require_once "classes/User.php";
require_once "classes/Video.php";

//var_dump($_SESSION);

$user = new User();
if ($user->checkLogin()) {
    header('Location: /main.php');
}