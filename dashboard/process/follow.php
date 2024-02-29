<?php
if($isRouter){
	$manager_id = $_POST['manager_id'];
	
	
	$m = mysqli_query($connect, "SELECT * FROM manager WHERE id='".$manager_id."'");
	if(mysqli_num_rows($m) > 0){
		$fetch_m = mysqli_fetch_array($m);
		
		$type = $fetch_m['type'];
		
		$q = mysqli_query($connect, "SELECT * FROM trading_account WHERE uid='".$uid."' AND type='".$type."'");
		$fetch = mysqli_fetch_array($q);
		$acc_id = $fetch['account_id'];
		
		if($fetch['copy'] == 0){
			$update = mysqli_query($connect, "UPDATE trading_account SET copy='".$manager_id."' WHERE account_id='".$acc_id."'");
			if($update){
				$result['success'] = 'true';
				$result['msg'] = 'Copying Start Succesfully!';
			}else{
				$result['msg'] = 'Sorry there is trouble from our back, please try again later!';
			}
		}else{
			$result['msg'] = 'Please unfollow current master, then you can start follow the other one!';
		}
	}else{
		$result['msg'] = 'Sorry, we cant find person you want to follow!';
	}
}