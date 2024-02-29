<?php
 header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Jakarta');
$token = str_replace("'","",$_POST['token']);
if($token !== "") {
	include "db.php";
	$user_id = getUserByToken($token);
	if($user_id == false) {
		$array = array('success' => 'false', 'type' => 'expired', 'msg' => 'Login Expired. Redirecting...');
		echo json_encode($array);
		exit;
	} else {
    	$query = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$user_id."'");
    	if(mysqli_num_rows($query) == 0) {
    		$array = array('success' => 'false', 'type' => 'token expired', 'msg' => 'Login Expired. Redirecting...');
    		echo json_encode($array);
    		exit;
    	} else {
    		$user_data = getUserEntireData($user_id);
    		
    		// Counter //
    		$bonus_count = 0;
    		$bonus = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as leveling FROM history WHERE type='level' AND user_id='$user_id'"));
    		$bonus_count = $bonus_count+$bonus['leveling'];
    		
    		$refer_count = 0;
    		$refer = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as refer FROM history WHERE type='sponsor' AND user_id='$user_id'"));
    		$refer_count = $refer_count+$refer['refer'];
    		$total_count = $refer_count + $bonus_count;
    		
            $roadmap = rewardCounter($user_id);
    		// END Counter //
    		
    		
    		$q_ref = mysqli_query($connect, "SELECT * FROM users WHERE ref='$user_id'");
            $com['bank'] = "BCA";
            $com['acc']  = "";
            $com['num']  = "11111111";
    	}
	}
} else {
	$array = array('success' => 'false', 'type' => 'token expired', 'msg' => 'Login Expired. Redirecting...');
	echo json_encode($array);
	exit;
}
?>