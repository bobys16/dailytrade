<?php
include '/config/db.php';
if($isRouter == "true") {
    $user = $data['user'];
    $pass = $data['password'];
    $get  = mysqli_query($connect, "SELECT * FROM admin WHERE user='$user'");
    if(mysqli_num_rows($get) > 0) {
        $fetch = mysqli_fetch_array($get);
        if($fetch['password'] == $pass) {
            $result['msg']      = "Login success..";
            $result['success']  = "true";
            $result['next_action'] = '/admin';
            $_SESSION['login']  = true;
            $_SESSION['admin_id']     = $fetch['id'];
            $time = time();
            $update = mysqli_query($connect, "UPDATE admin SET date_login='".time()."' WHERE user='$user'");
        } else {
            $result['msg']      = "Login failed. Unmatched password";
        }
    } else {
        $result['msg'] = "User couldn't be found";
    }
}