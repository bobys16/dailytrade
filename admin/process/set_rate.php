<?php
if($isRouter){
	$buy_r = $_POST['rate_buy'];
	$sell_r = $_POST['rate_sell'];
	
	$update = mysqli_query($connect, "UPDATE rate SET amount='".$buy_r."' WHERE type='buy'");
	if($update){
		mysqli_query($connect, "UPDATE rate SET amount='".$sell_r."' WHERE type='sell'");
		$result['success'] = 'true';
		$result['msg'] = 'Successfully change the rate!';
	}else{
		$result['msg'] = 'There is problem! thats all boby can say';
	}
}