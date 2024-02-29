<?php
include "../config/session.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $uid = $_SESSION['id'];
    $b_pass = $_POST['b_pass'];
    $b_uid = $_POST['b_uid'];
    $broker = $_POST['broker'];
    $query = mysqli_query($connect, "SELECT * FROM broker_acc WHERE userid='$uid'");
    if(mysqli_num_rows($query) == 0) {
        mysqli_query($connect, "INSERT INTO broker_acc VALUES('','$uid','$broker','','$b_uid','','$b_pass','')");
        $result['success'] = "true";
        $result['msg'] = "Broker Updated!";
    } else {
        mysqli_query($connect, "UPDATE broker_acc SET broker1='$broker',id_broker1='$b_uid',pass_broker1='$b_pass' WHERE userid='$uid'");
        $result['success'] = "true";
        $result['msg'] = "Broker Updated!";
    }
    echo json_encode($result);
}