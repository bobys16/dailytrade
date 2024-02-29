<?php
if($isRouter){
	$from = $_POST['from_account'];
	$amount = $_POST['amount'];
	$account = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM trading_account where account_id='".$from."'"));
	$type = $account['type'];
	$fund = $account['balance'];
	
	$cek = mysqli_query($connect, "SELECT * FROM trading_account WHERE account_id='".$from."' AND uid='".$uid."'");
	if(mysqli_num_rows($cek) < 1){
		$result['msg'] = 'What are you trying to do punk? Bobys barrier are strong!';
	}else{
	$account = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM wallet WHERE userid='".$uid."'"));
	$acc_fund = $account['fund'];
	$got = $amount + $acc_fund;
	$deduct = $fund - $amount;
		if($fund < $amount){
			$result['msg'] = 'Your selected trading account balance is not enough to perform this request, please add some!';
		}else{
			$update = mysqli_query($connect, "UPDATE wallet SET fund='".$got."' WHERE userid='".$uid."'");
			if($update){
				mysqli_query($connect, "UPDATE trading_account SET balance='".$deduct."' WHERE account_id='".$from."'");
				mysqli_query($connect, "INSERT INTO history VALUES(null,'".$uid."','deduct','Taking balance from trading account','".$amount."','".$type." Account','".time()."')");
				$result['msg'] = "You have succesfully take ".$amount." USD from trading account balance to master balance!";
				$result['success'] = 'true';
			}else{
				$result['msg'] = 'There is problem from our back, please try again later or contact us!';
				$result['miscelanous'] = mysqli_error($connect);
			}
		}
	}
}