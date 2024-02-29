<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $amount = str_replace("-","",$_POST['amount']);
    $sql = mysqli_query($connect, "SELECT * FROM request WHERE userid = '$user_id' AND type='withdraw' AND status='Pending'");
    $package = mysqli_query($connect, "SELECT * FROM package WHERE package_id='".$user_data['package_id']."'");
    $pack_fetch = mysqli_fetch_array($package);
    $fix_amount = $pack_fetch['price']*13000;
    
    if(mysqli_num_rows($sql) > 0) {
        $result['msg'] = "Unable to process, ongoing withdraw found!";
    } else {
        if($user_data['bonuses'] < $amount) {
            $result['msg'] = "Insuffience balance";
        } else if($amount >= 13000) {
            
            $converted = ($amount/13000);
            mysqli_query($connect, "INSERT INTO request VALUES('','$user_id','withdraw','$amount','Pending','$converted','1','$his')");
            mysqli_query($connect, "UPDATE bonus SET fund = fund-".$amount.", date_modify='$his' WHERE user_id='".$user_id."'");
            mysqli_query($connect, "INSERT INTO transaction VALUES('','$user_id','$amount','withdraw','Withdraw ".$amount." IDR','Pending','$his')");
            $result['success'] = "true";
            $result['data'] = array('amount' => $converted);
            $result['msg'] = "Your withdraw is under review, please wait for confirmation.";
        } else {
            $result['msg'] = "Minimum withdraw is 13.000!";
        }
    }
}
echo json_encode($result);