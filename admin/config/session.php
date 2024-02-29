<?php
include "setup.php";
session_start();
if(isset($_SESSION['id'])) {
	include "db.php";
	$user_id = $_SESSION['id'];
	$query = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$user_id."'");
	if(mysqli_num_rows($query) == 0) {
		session_destroy();
		header("Location: /startpage");
	} else {
		$user_data = getUserEntireData($user_id);
		
		// Counter //
		$bonus_count = 0;
		$bonus = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as leveling FROM history WHERE type='pairing' AND user_id='$user_id'"));
		$bonus_count = $bonus_count+$bonus['leveling'];
		
		$pshare_count = 0;
		$pshare = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as curs FROM history WHERE type='curs' AND user_id='$user_id'"));
		$curs_count = $pshare_count+$pshare['curs'];
		
		$refer_count = 0;
		$refer = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as refer FROM history WHERE type='sponsor' AND user_id='$user_id'"));
		$refer_count = $refer_count+$refer['refer'];
		
		
		$ccb_count = 0;
		$ccb = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as ccb FROM history WHERE type='CCB' AND user_id='$user_id'"));
		$ccb_count = $ccb_count+$ccb['ccb'];
		
		
		$vols = getVolume($user_id);
		
		
        $grand_total = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as bonus FROM history WHERE user_id='".$user_id."' AND type IN ('curs','sponsor','pairing','CCB')"));
		
		
		// END Counter //
		$rew = getReward($user_id);
	    if($rew['kiri'] > $rew['kanan']) {
	        $road = $rew['kanan'];
	    } else {
	        $road = $rew['kiri'];
	    }
        $claimed = explode(",",$road['claimed_ids']);
		
		
		$q_ref = mysqli_query($connect, "SELECT * FROM users WHERE ref='$user_id'");
	}
} else {
    session_destroy();
	header("Location: /startpage");
	exit;
}
?>