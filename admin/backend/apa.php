<?php
include "../config/db.php";

$query = mysqli_query($connect, "SELECT a.*, b.price FROM user_package a INNER JOIN package b ON a.package_id = b.package_id");
while($row = mysqli_fetch_assoc($query)) {
    $limit = $row['price']*(250/100);
    $total = $row['price'];
    $id = $row['userid']; 
    mysqli_query($connect, "INSERT INTO limitation VALUES('','".$id."','".$limit."','".$total."','".$total."')");
}

?>
