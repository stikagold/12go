<?php
/**
 * Created by PhpStorm.
 * User: rafik
 * Date: 5/6/19
 * Time: 6:39 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'env.php';
include FACTORIES."WayReaderFactory.php";

echo "<pre>";

$string = "3
87.342 34.30 start 0 walk 10.0
2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60
58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5
2
30 40 start 90 walk 5
40 50 start 180 walk 10 turn 90 walk 5
0";

$reader = new WayReaderFactory($string);