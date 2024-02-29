<?php

include "../config/session.php";
$data = array();


if(isset($_POST['uid'])) {
   $uid = $_POST['uid'];
    $i = 0;
    $query = mysqli_query($connect, "SELECT * FROM users WHERE ref='$uid'");
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $data[]= array('title' => strtoupper($row['username'])." (".$row['email'].")", 
    		   'uid'   => $row['id'],
    		   'folder'=> true,
    		   'rank'  => 1,
    		   'level' => 1,
    		   'lazy'  => true
    		  );
        }
    } else {
         $data[]= array('title' => "Empty",
                'uid'  => 0,
    		   'folder'=> false,
    		   'lazy'  => false
    		  );
    }

} else {
    $uid = $_SESSION['id'];
    $i = 0;
    $query = mysqli_query($connect, "SELECT * FROM users WHERE ref='$uid'");
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $data[]= array('title' => strtoupper($row['username'])." (".$row['email'].")", 
    		   'uid'   => $row['id'],
    		   'folder'=> true,
    		   'rank'  => 1,
    		   'level' => 1,
    		   'lazy'  => true
    		  );
        }
    } else {
         $data[]= array('title' => "Empty",
                'uid'  => 0,
    		   'folder'=> false,
    		   'lazy'  => false
    		  );
    }
}


echo json_encode($data);

?>
