<?php

if($isRouter == "true") {
    
    $check = mysqli_query($connect, "SELECT * FROM users WHERE id='$uid'");
    $fetch_c = mysqli_fetch_array($check);
    $pw = $fetch_c['pass'];
    
   
    $type = $data['type'];
    if($type == 'profile'){
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $c_pass = $data['password'];
        
        if(mysqli_num_rows($check) < 1){
            $result['msg'] = "We are having problem processing your request, if the problem continue you need to relogin";
        }else{
            if($c_pass == $pw){
                $update = mysqli_query($connect, "UPDATE users SET full_name='$name',email='$email',phone='$phone' WHERE id='$uid'");
                if($update){
                    $result['success'] = "true";
                    $result['msg'] = "Your profile has been changed succesfully";
                }else{
                    $result['msg'] = "There is a problem processing your request, please try again later!";
                }
            }else{
                $result['msg'] = "Your entered current password did not match with your current password! try again";
            }
        }
    
    }else if($type == 'password'){
        $n_pass = $data['n_pass'];
        $nc_pass = $data['nc_pass'];
        $c1_pass = $data['password'];
        
        if(mysqli_num_rows($check) < 1){
            $result['msg'] = "We are having problem processing your request, if the problem continue you need to relogin";
        }else{
            if($n_pass == $nc_pass){
                if($c1_pass == $pw){
                    $update = mysqli_query($connect, "UPDATE users SET pass='$nc_pass' WHERE id='$uid'");
                    if($update){
                        $result['success'] = "true";
                        $result['msg'] = "Your password has been changed succesfully";
                    }else{
                        $result['msg'] = "There is problem processing your request, please try again later!";
                    }
                }
            }else{
                $result['msg'] = "Your password confirmation did not match please try again later";
            }
        }
    }
    
}