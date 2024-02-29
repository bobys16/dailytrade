<?php

if($isRouter){
	$amount = $_POST['amount'];
	$cek_p = mysqli_query($connect, "SELECT * FROM profit_sharing WHERE uid='".$uid."'");
	$fetch_p = mysqli_fetch_array($cek_p);
	$total_p = $fetch_p['fund'] - $amount;
	$limit = $fetch_p['limitation'] - $amount;
	$time = time();

	if(mysqli_num_rows($cek_p) < 1){
		$result['msg'] = 'Please re-login there is some problem regarding your session!';
	}else{
		if($fetch_p['limitation'] == 0 ){
			$result['msg'] = 'Your daily limit is reached, please try again tomorrow!';
		}else{
			if($amount > 2000){
				$result['msg'] = 'You can only transfer below 2000 USD';
			}else{
				if($fetch_p['fund'] < $amount){
					$result['msg'] = 'You dont have enough profit sharing balance, please lower your amount!';
				}else{

					$wallet = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM wallet WHERE userid='".$uid."'"));
					$w_fund = $wallet['fund'] + $amount;
					$update = mysqli_query($connect, "UPDATE profit_sharing SET fund='$total_p',limitation='$limit' WHERE uid='".$uid."'");
					if($update){
						mysqli_query($connect, "UPDATE wallet SET fund='$w_fund', date_modify='$time' WHERE userid='".$uid."'");
						$result['success'] = 'true';
						$result['msg']	   = 'Your request has been succesfully processed!';
					}else{
						$result['msg'] = 'There is problem, please contact support!';
					}
				}
			}
		}
	}
}
