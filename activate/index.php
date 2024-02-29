<?php
session_start();
if(isset($_GET['token'])) {
   include "../dashboard/config/db.php";
   $token = $_GET['token'];
   $tk = mysqli_query($connect, "SELECT * FROM activate WHERE token = '".$token."'");
   $f_tk = mysqli_fetch_array($tk);
   $uss = $f_tk['uid'];
   $time = time();
   $q = mysqli_query($connect, "SELECT * FROM users WHERE id='".$uss."'");
   if(mysqli_num_rows($q) < 1) {
	$_SESSION['status'] = 'Not Found';
   header("Location: /dashboard/not_found");
   } else {
	mysqli_query($connect, "UPDATE users SET status='1' WHERE id='".$uss."'");
	mysqli_query($connect, "UPDATE activate SET activate_date='".$time."' WHERE token='".$token."'");

	header("Location: /dashboard/signin");
   }
}
?>
