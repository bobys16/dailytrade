<?php
include 'config/mailer.php';
if($isRouter){
	$amount = $_POST['amount'];
	$time = time();
	$body = file_get_contents('mail/invoice_wd.html');
	$date = date('Y-m-d H:i:s', $time);
	$email = $user['email'];
	$address= $_POST['to_address'];
	
	$fund = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM wallet WHERE userid='".$uid."'"));
	if($amount > $fund['fund']){
		$result['msg'] = 'You dont have enough USD to withdraw!';
	}else{
		$cek_req = mysqli_query($connect, "SELECT * FROM request WHERE userid='".$uid."' AND type='Withdraw' AND status='Pending'");
		if(mysqli_num_rows($cek_req) > 0){
			$result['msg'] = 'You still have some withdraw request pending, please wait until it changed status!';
		}else{
			$insert = mysqli_query($connect, "INSERT INTO request VALUES(null, '$uid', 'Withdraw', '1', '$amount', 'Pending', 'Withdraw USDT ADDRESS: '".$address."'', '1', '$time')");
			if($insert){
				mysqli_query($connect, "UPDATE wallet SET fund=fund-$amount WHERE userid='".$uid."'");
				$f_bank = mysqli_fetch_array($cek);
				$result['success'] = 'true';
				$result['msg'] = 'Your withdraw request has been succesfully added, please check email for the detail information!';
				$result['mail'] = Elz_Mail($email, $user['full_name'], "#".$insert_id." Your Withdraw Information", str_replace(array('{{NAME}}','{{TOTAL_USD}}','{{DATE}}','{{WD_DESTI}}'),array($user['full_name'],$amount,$date,$address),$body));
			}else{
				$result['msg'] = 'There is some problem processing your request, please try again or contact support!';
			}
		}				
	}
	
}