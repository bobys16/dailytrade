<?php

if($isRouter){
	$bank_n = $_POST['bank_name'];
	$acc_name = $_POST['acc_name'];
	$bank_number = $_POST['bank_number'];
	$c_pass = $_POST['c_pass'];
	
	$cek = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$uid."'"));
	
	if($cek['pass'] == $c_pass){
		$cek_acc = mysqli_query($connect, "SELECT * FROM bank WHERE userid='".$uid."'");
		if(mysqli_num_rows($cek_acc) < 1){
			$insert = mysqli_query($connect, "INSERT INTO bank VALUES(null, '$uid', '$acc_name', '$bank_number', '$bank_n', 'Active')");
			if($insert){
				$result['success'] = 'true';
				$result['msg'] = 'You have succesfully change your bank details!';
			}else{
				$result['msg'] = 'There is some problem processing your request, try again or contact us!';
			}
		}else{
			$result['msg'] = 'You cant change your bank detail, please contact support to change your bank informations!';
		}
	}else{
		$result['msg'] = 'Your current password doesnt match, please re-enter your current password and try again!';
	}
}
?>