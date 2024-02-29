<?php
include '../dashboard/config/mailer.php';
$body = file_get_contents('../dashboard/mail/wd_status.html');

if($isRouter){
	$t_id = $_POST['t_id'];
	$type = $_POST['type'];
	$cek = mysqli_query($connect, "SELECT * FROM request WHERE id='".$t_id."'");
	$f_c = mysqli_fetch_array($cek);
	$user_f = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$f_c['userid']."'"));
	$idr = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM idr WHERE uid='".$f_c['userid']."'"));
	
	if($type == 'cancel'){
		
		if(mysqli_num_rows($cek) < 1){
			$result['msg'] = 'There is no transaction based on that ID!';
		}else{
			$update = mysqli_query($connect, "UPDATE request SET status='Canceled' WHERE id='".$t_id."'");
			if($update){
				$result['mail'] = Elz_Mail($user_f['email'], $user_f['full_name'], "#".$t_id." Your Withdraw Has Been Canceled!", str_replace(array('{{NAME}}','{{STATUS}}'),array($user['full_name'],'CANCELED'),$body));
				$cur = $idr['fund'] + $f_c['amount'];
				mysqli_query($connect, "UPDATE idr SET fund='".$cur."' WHERE uid='".$f_c['userid']."'");
				$result['success'] = 'true';
				$result['msg'] = 'Succesfully change the status !';
			}else{
				$result['msg'] = 'There is some trouble proccessing request!';
			}
		}
	}else{
		if(mysqli_num_rows($cek) < 1){
			$result['msg'] = 'There is no transaction based on that ID!';
		}else{
			$update = mysqli_query($connect, "UPDATE request SET status='Success' WHERE id='".$t_id."'");
			if($update){
				$result['mail'] = Elz_Mail($user_f['email'], $user_f['full_name'], "#".$t_id." Your Withdraw Has Been Succesfully Processed!", str_replace(array('{{NAME}}','{{STATUS}}'),array($user['full_name'],'SUCCESS'),$body));
				$cur = $idr['fund'] + $f_c['amount'];
				$result['success'] = 'true';
				$result['msg'] = 'Succesfully change the status !';
			}else{
				$result['msg'] = 'There is some trouble proccessing request!';
			}
		}
	}
}