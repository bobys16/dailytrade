<?php
if($isRouter){
	$value = $_POST['valued'];
	$cek = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM idr WHERE uid='".$uid."'"));
	$time = time();
	if($value > $cek['fund']){
		$result['msg'] = 'You dont have enough IDR balance, add some and try again!';
	}else{
		$rate = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM rate WHERE type='buy'"));
		$wallet = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM wallet WHERE userid='".$uid."'"));
		$rate_total = round($value / $rate['amount'], 2);
		$got = $wallet['fund'] + $rate_total;
		$u_fund = $cek['fund'] - $value;
		$update = mysqli_query($connect, "INSERT INTO request VALUES(null, '$uid', 'Buy', '0', '$value', 'Pending', 'Buy USD', '1', '".$time."')");
			if($update){
				mysqli_query($connect, "UPDATE idr SET fund='".$u_fund."', date_modify='".$time."' WHERE uid='".$uid."'");
				mysqli_query($connect, "UPDATE wallet SET fund='".$got."', date_modify='".$time."' WHERE userid='".$uid."'");
				$result['msg'] = 'You have successfully buy USD, and your IDR balance is deducted!';
				$result['success'] = 'true';
			}else{
				$result['error'] = mysqli_error($connect);
				$result['msg'] = 'There is some problem from our back, please try again later!';
			}
	}
}