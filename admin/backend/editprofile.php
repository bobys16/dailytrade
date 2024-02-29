<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $uid = $_SESSION['id'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    if($pass !== $user_data['pass']) {
        $result['msg'] = "Current password doesn't match";
    } else {
        mysqli_query($connect, "UPDATE users SET full_name = '$name', phone='$phone' WHERE id='$uid'");
        $result['success'] = "true";
        $result['msg'] = "Profile Updated!";
    }
    echo json_encode($result);
}