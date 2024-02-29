<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $bank_name = $_POST['bank_name'];
    $acc_name = $_POST['acc_name'];
    $acc_number = $_POST['acc_number'];
    $pass = $_POST['pass'];
    if($user_data['pass'] !== $pass) {
        $result['msg'] = "Incorrect password";
    } else {
        mysqli_query($connect, "UPDATE bank SET bank_name='$bank_name',account_name='$acc_name', account_number='$acc_number' WHERE userid='$user_id'");
        $result['success'] = "true";
        $result['msg'] = "Bank Info Updated!";
    }
}
echo json_encode($result);