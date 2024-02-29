<?php
if($isRouter){
	$m_id = $_POST['m_id'];
	$cek = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM manager WHERE id='".$m_id."'"));
	$update = mysqli_query($connect, "UPDATE manager SET status='Active' WHERE id='".$m_id."'");
	if($update){
		$result['success'] = 'true';
		$result['msg'] = 'Master has been succesfully in Open State!';
	}else{
		$result['msg'] = 'Sorry admin, Boby has some problem processing your request!';
	}
	$result['miscelanous'] = mysqli_error($connect);
}
?>