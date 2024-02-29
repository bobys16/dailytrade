<?php

include "setup.php";
$http = "false";

if($_SERVER['HTTP_ELZGAR'] == "Its Lord") {
    $http = "true";
}