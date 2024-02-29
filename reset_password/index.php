<?php
session_start();
if(isset($_GET['token'])) {
   include "../dashboard/config/db.php";
   $token = $_GET['token'];
   $tk = mysqli_query($connect, "SELECT * FROM reset WHERE token = '".$token."'");
   $f_tk = mysqli_fetch_array($tk);
   $uss = $f_tk['uid'];
   $time = time();
   $q = mysqli_query($connect, "SELECT * FROM users WHERE id='".$uss."'");
   if(mysqli_num_rows($tk) < 1) {
	$_SESSION['status'] = 'Not Found';
   header("Location: /dashboard/signin");
   } else {
			header("Location: /dashboard/password_reset?token=".$token."");
   }
}
?>
