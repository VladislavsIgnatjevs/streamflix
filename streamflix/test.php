<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 19/01/2017
 * Time: 15:31
 */

require_once 'core/include/header.inc.php';


$testclass = new testclass();

$tes = $testclass->get_url("videoserver/upload");

$tes1 = opendir('videoserver/');

var_dump($tes1);



