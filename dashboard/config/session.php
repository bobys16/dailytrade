<?php
include "setup.php";
session_start();
if(isset($_SESSION['id'])) {
	include "db.php";
	$user_id = $_SESSION['id'];
	$query = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$user_id."'");
	if(mysqli_num_rows($query) == 0) {
		session_destroy();
		header("Location: /");
	} else {
		$user_data = getUserEntireData($user_id);
		
	}
} else {
    session_destroy();
	header("Location: /startpage");
	exit;
}
?>