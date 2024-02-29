<?php
include "config/setup.php";
session_start();
if(isset($_SESSION['admin_id'])) {
	include "config/db.php";
	$user_id = $_SESSION['admin_id'];
	$query = mysqli_query($connect, "SELECT * FROM admin WHERE id = '".$user_id."'");
	
	$getuser = mysqli_query($connect, "SELECT * FROM users");
	$getdepo = mysqli_query($connect, "SELECT SUM(amount) AS total FROM request WHERE type='Deposit'");
    $getwd = mysqli_query($connect, "SELECT SUM(amount) as total FROM request WHERE type='Withdraw'");
	$pwd = mysqli_query($connect, "SELECT * FROM request WHERE type='Withdraw' AND status='Pending'");
	$pdp = mysqli_query($connect, "SELECT * FROM request WHERE type='Deposit' AND status='Pending'");
	
	$r_buy = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM rate WHERE type='buy'"));
	$r_sell =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM rate WHERE type='sell'"));
    
	if(mysqli_num_rows($query) == 0) {
		session_destroy();
		header("Location: /admin/login");
	} else {
		$user_data = getUserEntireData($user_id);
		$user_list = mysqli_query($connect, "SELECT a.*, b.fund FROM users a INNER JOIN wallet b ON b.userid = a.id");
		$total_user = mysqli_num_rows($getuser);
		
		
		include "view/dashboard.php";
	}
} else {
    session_destroy();
	header("Location: /");
	exit;
}
?>