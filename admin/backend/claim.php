<?php
include "../config/session.php";

$user_road = mysqli_query($connect, "SELECT * FROM user_roadmap WHERE userid='$user_id'");
$road = mysqli_fetch_array($user_road);
//print_r($road);
$claimed = explode(",",$road['claimed_ids']);
//print_r($claimed);
$get = mysqli_query($connect, "SELECT * FROM roadmap");
$result['msg'] = "Unreached Target";

while($value = mysqli_fetch_assoc($get)) {
    $key = $value['id'];
    $is_claimed = is_inarray($key, $claimed);
    echo $is_claimed;
    if($value['target'] <= $road['roadmap'] ) {
        if(is_inarray($key, $claimed) === true) {
            // nothing to do
        } else {
            $new_claim = $road['claimed_ids'].$key.",";
            mysqli_query($connect, "INSERT INTO history VALUES('','$user_id','claim','Claim Reward','".$value['reward']."','System','$his')");
            mysqli_query($connect, "UPDATE user_roadmap SET claimed_ids='$new_claim',date_modify='$his' WHERE userid='$user_id'");
            mysqli_query($connect, "UPDATE bonus SET fund = fund+".$value['reward'].", date_modify='$his' WHERE user_id='".$user_id."'");
            $result['success'] = "true";
            $result['msg'] = "Claimed ".$value['reward']." USD";
            
        }
    }
}
echo json_encode($result);

function is_inarray($find, $array) {
    $ret = false;
    foreach($array as $k => $v) {
        if($find == $v) {
            $ret = true;
        }
    }
    return $ret;
}