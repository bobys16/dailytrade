<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $amount = str_replace("-", "",$_POST['amount']);
    $ad_id = str_replace("-", "",$_POST['ad_id']);
    $sql = mysqli_query($connect, "SELECT * FROM request WHERE userid = '$user_id' AND type='request' AND status='Pending'");
    if(mysqli_num_rows($sql) > 0) {
        $result['msg'] = "Ongoing request found! unable to process";
    } else {
        if($amount < 10) {
            $result['msg'] = "Minimum top up balance is $100. Request denied";
        } else {
            $converted = ($amount*16000) + rand(100, 999);
            mysqli_query($connect, "INSERT INTO request VALUES('','$user_id','request','$amount','Pending','$converted','$ad_id','$his')");
            $result['success'] = "true";
            $result['data'] = array('amount' => $converted);
            $result['msg'] = "Your data has been requested! please go to next step";
        }
    }
}
echo json_encode($result);