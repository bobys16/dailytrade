<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $usdt = $_POST['usdt'];
    $pass = $_POST['pass'];
    if($user_data['pass'] !== $pass) {
        $result['msg'] = "Incorrect password";
    } else {
        mysqli_query($connect, "UPDATE bank SET address='$usdt',crypto='USDT' WHERE userid='$user_id'");
        $result['success'] = "true";
        $result['msg'] = "USDT Wallet Updated!";
    }
}
echo json_encode($result);