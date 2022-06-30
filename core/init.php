<?php
ob_start();
session_start();



require "classes/FormSanitizer.php";
require "classes/Database.php";
require "classes/Constant.php";
require "classes/Account.php";
require "classes/User.php";

$account = new \MyApp\Account();
$loadfromUser = new \MyApp\User();

define("WWW_ROOT", "http://localhost/webrtc/");
require "functions.php";
