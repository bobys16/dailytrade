<?php
include "config/setup.php";
session_start();
if(isset($_SESSION['id'])) {
	include "config/db.php";
	$uid = $_SESSION['id'];
	$query = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$uid."'");
	$count_network = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM users WHERE ref='".$uid."'"));
	$profit = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(b.gain) as total_gain FROM trading_account a LEFT JOIN trading_history b ON a.account_id = b.account_id WHERE uid='".$uid."'"));
	$total_gain = $profit['total_gain'];
	if(mysqli_num_rows($query) == 0) {
		session_destroy();
		header("Location: signin");
	} else {
		$profit_sharing = mysqli_query($connect, "SELECT * FROM history WHERE uid='".$uid."'");
		$user = getUserEntireData($uid);
		$check = mysqli_query($connect, "SELECT a.*, b.name, b.status as m_status FROM trading_account a LEFT JOIN manager b ON a.copy = b.id WHERE a.uid='".$uid."'");
		if(mysqli_num_rows($check) == 0) {
			$high_acc = array(
				'account_id' => rand(10000000000,999999999999),
				'balance' => 0,
				'copy' => 0);
			$low_acc = array(
				'account_id' => rand(10000000000,999999999999),
				'balance' => 0,
				'copy' => 0);
				
			mysqli_query($connect, "INSERT INTO trading_account VALUES(null,'".$uid."','".$high_acc['account_id']."','High','0','0','1')");
			mysqli_query($connect, "INSERT INTO trading_account VALUES(null,'".$uid."','".$low_acc['account_id']."','Low','0','0','1')");
			//echo mysqli_insert_id($connect);
		} 
		include "view/dashboard.php";
	}
} else {
    session_destroy();
	header("Location: signin");
	exit;
}
?>