<?php
if($isRouter) {
	include "api/api.function.php";

	$hash = $data['transaction_hash'];
	$type = $data['type'];
	if($type == "trc20") {
		$transaction = check_transaction_trc20($hash);
		
		$master_addr = "TBSRLKAGGzikS99nvsrJGKysxo2nxW59P9";
		
		if($transaction['to'] !== $master_addr) {
			$result['msg'] = "unknown transaction".json_encode($transaction);
		} else {
			if($transaction['result'] !== "SUCCESS") {
				$result['msg'] = "unknown transaction or unconfirmed";
			} else {
				$db_check = mysqli_query($connect, "SELECT * FROM hash WHERE hash = '".$hash."'");
				if(mysqli_num_rows($db_check) > 0) {
					$result['msg'] = "hash already claimed";
				} else {
					$value = ($transaction['value']/100)*($transaction['value'] > 50000 ? 99.5:99);
					mysqli_query($connect, "UPDATE wallet SET fund = fund+$value WHERE userid='".$uid."'");
					mysqli_query($connect, "INSERT INTO hash VALUES(null,'".$uid."','".$hash."','".$transaction['from']."','".$value."','".$type."','".time()."')");
					mysqli_query($connect, "INSERT INTO request VALUES(null, '".$uid."','Deposit','0','".$transaction['value']."','Success','FROM USDT','1','".time()."')");
					$result['msg'] = $transaction['value']."$ successfully claimed";
					$result['success'] = "true";
				}
			}
		}
		
		
	} else {
		$result['msg'] = "ERC20 Unavailable yet.";
	}
}