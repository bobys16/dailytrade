<?php
    include "../config/db.php";
    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = str_replace("'","",$_POST['email']);
        $pass  = str_replace("'", "", $_POST['password']);
        $login_data = getUserByEmail($email);
        if($login_data['pass'] !== $pass) {
            $result['msg'] = "Email/Password unmatch!";
        } else {
            $_SESSION['id'] = $login_data['id'];
            $result['success'] = "true";
            $result['msg'] = "Login Success";
        }
        echo json_encode($result);
    }
    
?>