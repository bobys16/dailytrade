<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $npass = $_POST['npass'];
    $pass = $_POST['cpass'];
    $ncpass = $_POST['ncpass'];
    if($pass !== $user_data['pass']) {
        $result['msg'] = "Current password doesn't match";
    } else {
        if($npass !== $ncpass) {
            $result['msg'] = "New Password doesn't match";
        } else {
            mysqli_query($connect, "UPDATE users SET password = '$npass' WHERE id='$uid'");
            $result['success'] = "true";
            $result['msg'] = "Password Updated!";
        }
    }
    echo json_encode($result);
}