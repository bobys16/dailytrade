<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        
        $query = mysqli_query($connect, "SELECT * FROM users WHERE username ='$username'");
        
        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            $result['username'] = $user['id'];
            $result['success'] = 'true';
            $result['msg'] = 'User Found! Redirecting..';
        }else{
            $result['success'] = 'false';
            $result['msg'] = 'Our system cannot found the user you have search for! please re-check the username and try again!';
        }
    }
}
echo json_encode($result);