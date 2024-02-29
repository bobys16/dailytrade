<?php
include "config/mailer.php";
if($isRouter){
	$fullname = $user['full_name'];
	$email = $user['email'];
	$token = md5(rand(100000,10000000));
	$time = time();
	$body = file_get_contents("mail/reset_password.html");
	
	$insert = mysqli_query($connect, "INSERT INTO reset VALUES(null,'$uid', '$token', '".$time."', '')");
		if($insert){
			Elz_Mail($email, $fullname, "Password Reset Request", str_replace(array('{{LINK}}','{{name}}'),array('https://dailytrade.one/reset_password?token='.$token,$fullname),$body));
			$result['success'] = 'true';
			$result['msg']	   = 'Please check your email, we have sent you a link to reset your password!';
		}else{
			$result['error'] = mysqli_error($connect);
			$result['msg'] = 'There is problem from our back please try again!';
		}
}
?>