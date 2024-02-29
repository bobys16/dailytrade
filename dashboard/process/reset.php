<?php
if($isRouter){
	$pw = $_POST['npassword'];
	$npw = $_POST['password'];
	$token = $_POST['token'];
	$time = time();
	
	if($pw == $npw){
		$cek = mysqli_query($connect, "SELECT * FROM reset WHERE token='".$token."'");
		if(mysqli_num_rows($cek) < 1){
			$result['msg'] = 'Sorry there is problem from our back, please try again!';
		}else{
			$fetch = mysqli_fetch_array($cek);
			$user = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$fetch['uid']."'"));
			$update = mysqli_query($connect, "UPDATE users SET pass='".$npw."' WHERE id='".$fetch['uid']."'");
			if($update){
				mysqli_query($connect, "UPDATE reset SET date_verify='".$time."' WHERE token='".$token."'");
				$result['success'] = 'true';
				$result['msg']	= 'Password has been changed!';
			}else{
				$result['msg']  = 'There is problem from our back, please try again!';
			}
		}
	}else{
		$result['msg'] = 'Your confirmation password doesnt match, please try again!';
	}
}
?>