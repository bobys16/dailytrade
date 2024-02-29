<?php
include 'config/mailer.php';

if($isRouter){
	$bank_name = $_POST['bank_name'];
	$bank_acc = $_POST['bank_acc'];
	$email = $user['email'];
	$bank_number = $_POST['bank_number'];
	$amount = $_POST['amount'];
	$proof = $_FILES['trx_proof'];
	$pName = md5(time()+rand(100,999));
	$path = $user['username']."/";
	$time = time();
	$check = mysqli_query($connect, "SELECT * FROM request WHERE userid='".$uid."' AND type='Deposit'");
	$body = file_get_contents('mail/invoice_depo.html');
	$date = date('Y-m-d H:i:s', $time);
	
	if(mysqli_num_rows($check) > 0){
		$rc = mysqli_fetch_array($check);
		if($rc['status'] == "Pending"){
			$result['msg'] = 'Your last payment request are still in pending process, please wait untill it change status first!';
		}else{
			  if(SaveImage($proof, $path, $pName)) {
                $proof_ext = pathinfo($proof['name'], PATHINFO_EXTENSION);
                $update = mysqli_query($connect, "INSERT INTO request 
                   VALUES(null,'$uid','Deposit','0','$amount','Pending','Deposit IDR','1','".$time."')");
				  
				   if($update){
					   $insert_id = mysqli_insert_id($connect);
					   mysqli_query($connect, "INSERT INTO trx_proof VALUES(null,'$insert_id','".$pName.".".$proof_ext."')");
					    $result['mail'] = Elz_Mail($email, $user['full_name'], "#".$insert_id." Your Deposit Information", str_replace(array('{{NAME}}','{{BANK_TYPE}}','{{BANK_NAME}}','{{TOTAL_IDR}}','{{DATE}}'),array($user['full_name'],$bank_name,$bank_acc,$amount,$date),$body));
						$result['success'] = "true";
						$result['msg']     = "Request accepted please follow up in the next 1x24 hours to verify your request";
				   }else{
						$result['msg'] = "There is problem from our back, please try again later!1";
				   }
            }
		}
	}else{
		 if(SaveImage($proof, $path, $pName)) {
                $proof_ext = pathinfo($proof['name'], PATHINFO_EXTENSION);
                $update = mysqli_query($connect, "INSERT INTO request 
                   VALUES(null,'$uid','Deposit','0','$amount','Pending','Deposit IDR','1','".$time."')");
				   if($update){
					  
					   $insert_id = mysqli_insert_id($connect);
					    $result['mail'] = Elz_Mail($email, $user['full_name'], "#".$insert_id." Your Deposit Information", str_replace(array('{{NAME}}','{{BANK_TYPE}}','{{BANK_NAME}}','{{TOTAL_IDR}}','{{DATE}}'),array($user['full_name'],$bank_name,$bank_acc,$amount,$date),$body));
					   mysqli_query($connect, "INSERT INTO trx_proof VALUES(null,'$insert_id','".$pName.".".$proof_ext."')");
						$result['success'] = "true";
						$result['msg']     = "Request accepted please follow up in the next 1x24 hours to verify your request";
				   }else{
						$result['msg'] = "There is problem from our back, please try again later!2";
				   }
            }
	}
	
}
function SaveImage($file, $path, $fname) {
    $infoExt        =   getimagesize($file['tmp_name']);
    if (!file_exists('uploads/proof/'.$path)) {
        mkdir('uploads/proof/'.$path, 0755, true);
    }
     
    if(strtolower($infoExt['mime']) == 'image/gif' || strtolower($infoExt['mime']) == 'image/jpeg' || strtolower($infoExt['mime']) == 'image/jpg' || strtolower($infoExt['mime']) == 'image/png'){
        
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        move_uploaded_file($file['tmp_name'],'uploads/proof/'.$path.$fname.'.'.$ext);
        return true;
    }else{
        return false;
    }
}

?>