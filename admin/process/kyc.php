<?php
//$file           =   $_FILES['file']['name'];
include '/dashboard/config/mailer.php';

if($isRouter) {
    $id_card = $_POST['kyc_id'];
    
    $kyc_check = mysqli_query($connect, "SELECT * FROM kyc WHERE uid='".$id_card."'");
    if(mysqli_num_rows($kyc_check) == 'Pending') {
        $ft = mysqli_fetch_array($kyc_check);
        if($ft['status'] == "Pending") {
            $update = mysqli_query($connect, "UPDATE kyc SET status='Verified' WHERE uid='$id_card'");
            if($update){
                
            $result['success'] = 'true';
            $result['msg'] = "Succesfully Verified the KYC detail! they'll get notification email don't worry!";
                
            }else{
                $result['success'] = 'false';
                $result['msg'] = 'Something went wrong, please try again later!';
            }
        } else {
            // TO DO: IF FILE EMPTY!!!!!!
            $result['success'] = "false";
            $result['msg']     = "Sorry i think this verification is already confirmed, or anything? IDK :3";
        }
    } else {
            $result['success'] = "false";
            $result['msg']     = "Sorry i think this verification is already confirmed, or anything? IDK :3";
    }
}

