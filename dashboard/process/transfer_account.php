<?php
if($isRouter){
	$desti = $_POST['account_destination'];
	$amount = $_POST['amount'];
	$wallet = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM wallet where userid='".$uid."'"));
	$fund = $wallet['fund'];
	
	$cek = mysqli_query($connect, "SELECT * FROM trading_account WHERE account_id='".$desti."' AND uid='".$uid."'");
	if(mysqli_num_rows($cek) < 1){
		$result['msg'] = 'What are you trying to do punk? Bobys barrier are strong!';
	}else{
	$account = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM trading_account WHERE account_id='".$desti."'"));
	$acc_fund = $account['balance'];
	$type = $account['type'];
	$got = $amount + $acc_fund;
	$deduct = $fund - $amount;
		if($fund < $amount){
			$result['msg'] = 'Your master balance is not enough to perform this request, please buy some!';
		}else{
			$update = mysqli_query($connect, "UPDATE trading_account SET balance='".$got."' WHERE account_id='".$desti."'");
			if($update){
				mysqli_query($connect, "UPDATE wallet SET fund='".$deduct."' WHERE userid='".$uid."'");
				mysqli_query($connect, "INSERT INTO history VALUES(null,'".$uid."','add','Adding balance from trading account','".$amount."','".$type." Account','".time()."')");
				$result['msg'] = "You have succesfully transfer ".$amount." USD from master balance to ".$desti." account!";
				$result['success'] = 'true';
			}else{
				$result['msg'] = 'There is problem from our back, please try again later or contact us!';
				$result['miscelanous'] = mysqli_error($connect);
			}
		}
	}
}