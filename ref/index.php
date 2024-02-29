<?php
session_start();
if(isset($_GET['ref'])) {
   include "../dashboard/config/db.php";
   $q = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$_GET['ref']."'");
   if(mysqli_num_rows($q) < 1) {
	$_SESSION['ref'] = '100001';
   } else {
   	$_SESSION['ref'] = $_GET['ref'];
   }
   echo "<script>javascript:location.replace('/dashboard/signup');</script>";
}
?>
