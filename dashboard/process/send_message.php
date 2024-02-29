<?php
if($isRouter){
	$m_id = $_POST['msg_id'];
	$text = $_POST['text'];
	$time = time();
	
	$cek = mysqli_query($connect, "SELECT * FROM support_msg WHERE id='".$m_id."'");
	if(mysqli_num_rows($cek) < 1){
		$result['msg'] = 'There is problem processing your request, please try again';
	}else{
		$insert = mysqli_query($connect, "INSERT INTO support_msg VALUES(null, '$m_id', '$uid', 'Admin', '$text', '$time')");
		if($insert){
			$result['success'] = 'true';
			$result['msg'] = 'Your message is succesfully send!';
		}else{
			$result['msg'] = 'There is problem processing your request!';
		}
	}
}