<?php
//then start the session
@session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'model.php';

$db_host = "localhost";
$db_user = "vastmoce_root";
$db_pass = "Bobys123";
$db_name = "vastmoce_db";

$errors = array();

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

$model = new Model();
