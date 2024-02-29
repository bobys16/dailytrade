<?php
if($isRouter){
	$text = $_POST['text'];
	$time = time();
	$cek = mysqli_query($connect, "SELECT * FROM support_id WHERE uid='".$uid."' AND status='Open'");
	if(mysqli_num_rows($cek) < 1){
		$insert = mysqli_query($connect, "INSERT INTO support_id VALUES(null, '$uid', 'Open', '$time')");
		if($insert){
			$insert_id = mysqli_insert_id($connect);
			mysqli_query($connect, "INSERT INTO support_msg VALUES(null, '$insert_id', '$uid', 'Admin', '$text', '$time')");
			$result['success'] = 'true';
			$result['msg'] = 'You have succesfully created new ticket!';
			$result['next_action'] = '/dashboard';
		}else{
			$result['msg'] = 'There is problem';
		}
	}else{
		$result['msg'] = 'You still have some open ticket, please wait untill they close by the Admin!';
	}
}