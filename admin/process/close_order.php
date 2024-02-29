<?php
if($isRouter){
	$m_id = $_POST['m_id'];
	$cek = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM manager WHERE id='".$m_id."'"));
	$update = mysqli_query($connect, "UPDATE manager SET status='Close' WHERE id='".$m_id."'");
	if($update){
		$share = $cek['type'] == "Low" ? 30:20;
		$getHistory = mysqli_query($connect, "SELECT SUM(gain) as profit, m_id, account_id FROM trading_history WHERE m_id='".$m_id."' AND status='Active' GROUP BY account_id");
		while($row = mysqli_fetch_assoc($getHistory)) {
			$acc_id = $row['account_id'];
			$profit = $row['profit'];
			$percent = ($profit/100);
			if($profit > 0) {
				### FIRST SHARE
				$first_ref = mysqli_fetch_array(mysqli_query($connect, "SELECT a.uid,b.username ,b.ref FROM trading_account a INNER JOIN users b ON a.uid=b.id WHERE a.account_id = '".$acc_id."'"));
				$first_share = round($percent*5, 2);
				mysqli_query($connect, "INSERT INTO history VALUES(null,
					'".$first_ref['ref']."',
					'profit_sharing',
					'Get ".$first_share." USD from ".$first_ref['username']." (".$cek['type'].")',
					'".$first_share."',
					'".$first_ref['username']."',
					'".time()."')");
				mysqli_query($connect, "UPDATE profit_sharing SET fund=fund+".$first_share." WHERE uid='".$first_ref['ref']."'");
				
				### SECOND SHARE
				$second_ref = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$first_ref['ref']."'"));
				$second_share = round($percent*3, 2);
				mysqli_query($connect, "INSERT INTO history VALUES(null,
					'".$second_ref['ref']."',
					'profit_sharing',
					'Get ".$second_share." USD from ".$first_ref['username']." (".$cek['type'].")',
					'".$second_share."',
					'".$first_ref['username']."',
					'".time()."')");
				mysqli_query($connect, "UPDATE profit_sharing SET fund=fund+".$second_share." WHERE uid='".$second_ref['ref']."'");
				
				### THIRD SHARE
				$third_ref = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$second_ref['ref']."'"));
				$third_share = round($percent*2, 2);
				mysqli_query($connect, "INSERT INTO history VALUES(null,
					'".$third_ref['ref']."',
					'profit_sharing',
					'Get ".$third_share." USD from ".$first_ref['username']." (".$cek['type'].")',
					'".$third_share."',
					'".$first_ref['username']."',
					'".time()."')");
				mysqli_query($connect, "UPDATE profit_sharing SET fund=fund+".$third_share." WHERE uid='".$third_ref['ref']."'");
					
				### FOURTH SHARE
				$fourth_ref = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$third_ref['ref']."'"));
				$fourth_share = round($percent*2, 2);
				mysqli_query($connect, "INSERT INTO history VALUES(null,
					'".$fourth_ref['ref']."',
					'profit_sharing',
					'Get ".$fourth_share." USD from ".$first_ref['username']." (".$cek['type'].")',
					'".$fourth_share."',
					'".$first_ref['username']."',
					'".time()."')");
				mysqli_query($connect, "UPDATE profit_sharing SET fund=fund+".$fourth_share." WHERE uid='".$fourth_ref['ref']."'");
					
				### FIFTH SHARE
				$fifth_ref = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM users WHERE id='".$fourth_ref['ref']."'"));
				$fifth_share = round($percent*1, 2);
				mysqli_query($connect, "INSERT INTO history VALUES(null,
					'".$fifth_ref['ref']."',
					'profit_sharing',
					'Get ".$fifth_share." USD from ".$first_ref['username']." (".$cek['type'].")',
					'".$fifth_share."',
					'".$first_ref['username']."',
					'".time()."')");
				mysqli_query($connect, "UPDATE profit_sharing SET fund=fund+".$fifth_share." WHERE uid='".$fifth_ref['ref']."'");
					
				
				
			}
			mysqli_query($connect, "UPDATE trading_history SET status='Close' WHERE m_id = '".$m_id."' AND account_id='".$acc_id."' AND status='Active'");
		}
		
		$result['success'] = 'true';
		$result['msg'] = 'Master has been succesfully in close!';
	}else{
		$result['msg'] = 'Sorry admin, Boby has some problem processing your request!';
	}
	$result['miscelanous'] = mysqli_error($connect);
}
?>