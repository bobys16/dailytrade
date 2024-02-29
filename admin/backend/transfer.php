<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $dest = $_POST['username'];
    $amount = str_replace("-",'',$_POST['amount']);
    $pass = str_replace("'","",$_POST['pass']);
    $gett = mysqli_query($connect, "SELECT * FROM users WHERE username = '".$dest."'");
    if($user_data['pass'] !== $pass) {
        $result['msg'] = "Password Incorrect!";
    } else {
        if(mysqli_num_rows($gett) == 0) {
            $result['msg'] = "Username not found!";
        } else {
            if($user_data['fund'] < $amount) {
                $result['msg'] = "Insuffience balance";
            } else {
                $fetch = mysqli_fetch_array($gett);
                $dest_id = $fetch['id'];
                mysqli_query($connect, "INSERT INTO history VALUES('','$user_id','transfer','Transfer Balance','$amount','$dest','$his')");
                mysqli_query($connect, "INSERT INTO history VALUES('','$dest_id','receive','Receive Balance','$amount','".$user_data['username']."','$his')");
                mysqli_query($connect, "UPDATE wallet SET fund = fund-".$amount.", date_modify='$his' WHERE userid='$user_id'");
                mysqli_query($connect, "UPDATE wallet SET fund = fund+".$amount.", date_modify='$his' WHERE userid='$dest_id'");
                $result['msg'] = "Balance transfer success!";
                $result['success'] = "true";
            }
        }
    }
}
echo json_encode($result);