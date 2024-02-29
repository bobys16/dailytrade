<?php

if($isRouter){
	$file1 = $_FILES['trx_proof'];
	$pName = md5(time()+rand(100,999));
	$path = $user['username']."/";
	$time = time();
	$apath = '/dashboard/uploads/profile/'.$path;
	$check = mysqli_query($connect, "SELECT * FROM users WHERE id='".$uid."'");
	$date = date('Y-m-d H:i:s', $time);
	
	if(mysqli_num_rows($check) < 1){
		$result['msg'] = 'Sorry requirement does not meet, please re-login!';
	}else{
		 if(SaveImage($file1, $path, $pName)) {
                $proof_ext = pathinfo($file1['name'], PATHINFO_EXTENSION);
                $update = mysqli_query($connect, "UPDATE users SET pic='".$apath."".$pName.".".$proof_ext."' WHERE id='".$uid."'");
				   if($update){
					   	$result['success'] = "true";
						$result['msg']     = "You have succesfully change your profile picture!";
				   }else{
						$result['msg'] = "There is problem from our back, please try again later!";
				   }
            }
	}
	
}
function SaveImage($file, $path, $fname) {
    $infoExt        =   getimagesize($file['tmp_name']);
    if (!file_exists('uploads/profile/'.$path)) {
        mkdir('uploads/profile/'.$path, 0755, true);
    }
     
    if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png'){
        
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        move_uploaded_file($file['tmp_name'],'uploads/profile/'.$path.$fname.'.'.$ext);
        return true;
    }else{
        return false;
    }
}

?>