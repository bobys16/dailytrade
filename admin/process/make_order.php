<?php

if($isRouter) {
	$post = $_POST;
	
	$order_type = $post['type'];
	$manager = $post['m_id'];
	$getManager = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM manager WHERE id='".$manager."'"));
	$managerBalance = $getManager['manager_balance'];
	$manager_value = round($managerBalance/10000, 4);
	$min = $getManager['type'] == 'Low' ? '100':'50';
	$max = $getManager['type'] == 'Low' ? '100000':'50000';
	if($order_type == 'sell') {
		$profit = round( (10000 * $manage_value) * ($post['price_open'] - $post['price_close']) ,2);
		$changes = round((1 - ($post['price_close'] / $post['price_open'] )) * 100,2);
	} else {
		$profit = round( (10000 * $manager_value) * ($post['price_close'] - $post['price_open']) ,2);
		$changes = round( (1 - ( $post['price_open'] / $post['price_close'])) * 100,2);
	}
	mysqli_query($connect, "UPDATE manager set manager_balance=manager_balance+$profit WHERE id='".$manager."'");
	
	$follower = mysqli_query($connect, "SELECT * FROM trading_account WHERE copy = '".$manager."' AND type='".$getManager['type']."' AND balance BETWEEN $min AND $max");
	while($row = mysqli_fetch_assoc($follower)) {
		$value = round($row['balance']/$managerBalance*$manager_value,4);
		if($order_type == 'sell') {
			
			$profit = round( (10000 * $value) * ($post['price_open'] - $post['price_close']) ,2);
			$changes = round((1 - ($post['price_close'] / $post['price_open'] )) * 100,2);
		} else {
			
			$profit = round( (10000 * $value) * ($post['price_close'] - $post['price_open']) ,2);
			$changes = round((1 - ( $post['price_open'] / $post['price_close'])) * 100,2);
		}
		$inv = $getManager['type'] == 'Low' ? '70':'80';
		$charges = round(($profit/100)*$inv,2);
		$query = mysqli_query($connect, "INSERT INTO trading_history VALUES(null,
			'".$manager."',
			'".$row['account_id']."',
			'".$post['market']."',
			'".$value."',
			'".$order_type."',
			'".$post['price_open']."',
			'".$post['price_close']."',
			'".$profit."', 
			'".$changes."',
			'".time()."',
			'Active')");
		mysqli_query($connect, "UPDATE trading_account SET balance=balance+$charges WHERE account_id='".$row['account_id']."'");
	}
	$result['success'] = "true";
	$result['msg']	   = "Position successfully set";
}