<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $amount = str_replace("-","",$_POST['amount']);
    $package = getPackage($user_data['package_id']);
    $depo = explode(":", $package['deposit']);
    $min_depo = $depo[0];
    
    $sql = mysqli_query($connect, "SELECT * FROM deposit WHERE userid = '$user_id' AND status='Waiting'");
    if(mysqli_num_rows($sql) > 0) {
        $result['msg'] = "Ongoing request found! unable to process";
    } else {
        if($min_depo > $amount) {
            $result['msg'] = "Unable to perform this request. Your minimum deposit is ".$min_depo;
        } else {
            if($package > 0) {
                mysqli_query($connect, "INSERT INTO deposit VALUES('','$user_id','$amount', '1','Waiting','$his')");
                mysqli_query($connect, "UPDATE wallet SET fund=fund-".$amount." WHERE userid='".$user_id."'");
                $result['success'] = "true";
                //$result['data'] = array('com' => $com, 'amount' => $converted);
                $result['msg'] = "Your request has been sent. Please wait for confirmation";
            } else {
                $result['msg'] = "Please setup your broker acccount before perform this";
            }
        }
    }
}
echo json_encode($result);