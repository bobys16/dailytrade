<?php
if($isRouter) {
	$account_id = $_POST['account_id'];
	$update = mysqli_query($connect, "UPDATE trading_account SET copy=0 WHERE account_id='".$account_id."' AND uid='".$uid."'");
	if($update) {
		$result['success'] = "true";
		$result['msg']	   = "Successfully unfollow.";
	} else {
		$result['msg']	   = "Unknown error.";
	}
}