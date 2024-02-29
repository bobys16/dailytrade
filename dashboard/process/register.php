<?php
include "config/mailer.php";
if($isRouter) {
    $fullname = $data['f_name'] . " " . $data['l_name'];
    $username = $data['username'];
    $email    = $data['email'];
    $password = $data['password'];
    $confirm  = $data['cpassword'];
    $phone    = $data['phone'];
    $ref      = isset($_SESSION['ref']) !== true ? '100001':$_SESSION['ref'];
    $ref_pos  = isset($_SESSION['ref_pos']) !== true ? null:$_SESSION['ref_pos'];
    $time     = time();
    $str = rand(1000000,100000000);
	$token = md5($str);

    $validate = registerDataValidate($data);
    $body = file_get_contents("mail/greet.html");
	
    if($validate == 'Passed') {
        if($password == $confirm) {
            $insert = mysqli_query($connect, "INSERT INTO users VALUES(null,'$email','$password','$fullname','$username','/dashboard/profile.png','$ref','$phone', '0','".$time."')");
            if($insert) {
                
                $inserted_id = mysqli_insert_id($connect);
                mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','".$time."')");
                mysqli_query($connect, "INSERT INTO idr VALUES('$inserted_id','0','".$time."')");
                mysqli_query($connect, "INSERT INTO profit_sharing VALUES(null,'$inserted_id','0', '2000','".$time."')");
                mysqli_query($connect, "INSERT INTO activate VALUES(null,'$inserted_id','$token','".$time."', '0');");
                //$_SESSION['id'] = $inserted_id;
                //$_SESSION['login'] = true;
                $result['msg'] = "Register Success please check your email in order to start using our service!";
                $result['mail'] = Elz_Mail($email, $fullname, "Account Verification", str_replace(array('{{LINK}}','{{FULLNAME}}'),array('https://dailytrade.one/activate?token='.$token,$fullname),$body));
                $result['success'] = "true";
                $result['next_action'] = '/dashboard/signin';
            } else {
                $result['msg'] = mysqli_error($connect);
            }
            
            
        } else {
            $result['msg'] = "Your password doesn't match";
        }
    } else {
        $result['msg'] = $validate;
    }
    
    
    
} else {
    echo "INTERNAL SERVER ERROR";
}


function registerDataValidate($data) {
    global $connect;
    
    $username    = mysqli_query($connect, "SELECT * FROM users WHERE username ='".$data['username']."'");
    $email       = mysqli_query($connect, "SELECT * FROM users WHERE email = '".$data['email']."'");
    if(mysqli_num_rows($username) > 0) {
        return 'Username Used';
    } else if(mysqli_num_rows($email) > 0) {
        return 'Email Used';
    } else {
        return 'Passed';
    }
}