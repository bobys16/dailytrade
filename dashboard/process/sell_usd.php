<?php
if($isRouter){
	$value = $_POST['valued'];
	$cek = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM wallet WHERE userid='".$uid."'"));
	$time = time();
	if($value > $cek['fund']){
		$result['msg'] = 'You dont have enough Master balance, buy some and try again!';
	}else{
		$rate = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM rate WHERE type='sell'"));
		$wallet = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM idr WHERE uid='".$uid."'"));
		$rate_total = $rate['amount'] * $value;
		$got = $wallet['fund'] + $rate_total;
		$u_fund = $cek['fund'] - $value;
		$update = mysqli_query($connect, "INSERT INTO request VALUES(null, '$uid', 'Sell', '0', '$value', 'Pending', 'Sell USD', '1', '".$time."')");
			if($update){
				mysqli_query($connect, "UPDATE wallet SET fund='".$u_fund."', date_modify='".$time."' WHERE userid='".$uid."'");
				mysqli_query($connect, "UPDATE idr SET fund='".$got."', date_modify='".$time."' WHERE uid='".$uid."'");
				$result['msg'] = 'You have successfully sell USD, and your Master balance is deducted!';
				$result['success'] = 'true';
				$result['misscelanous'] = $got;
			}else{
				$result['error'] = mysqli_error($connect);
				$result['msg'] = 'There is some problem from our back, please try again later!';
			}
	}
}