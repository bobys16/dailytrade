<?php

if($isRouter == "true") {
    $user = $data['username'];
    $pass = $data['password'];
    $get  = mysqli_query($connect, "SELECT * FROM users WHERE username='$user'");
	
    if(mysqli_num_rows($get) > 0) {
        $fetch = mysqli_fetch_array($get);
        if($fetch['pass'] == $pass) {
			if($fetch['status'] > 0){
					$result['msg']      = "Login success..";
					$result['success']  = "true";
					$result['next_action'] = '/dashboard';
					$_SESSION['login']  = true;
					$_SESSION['id']     = $fetch['id'];
			}else{
				$result['msg']		= "Please confirm your email address first in order to start using our services !";
			}
				
        } else {
            $result['msg']      = "Login failed. Unmatched password";
        }
    } else {
        $result['msg'] = "User couldn't be found";
    }
}