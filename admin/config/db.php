<?php
date_default_timezone_set('Asia/Jakarta');
    $his = date("d-m-Y H:i:s");
    $result = array('success' => "false", 'msg' => 'Nothing to do');
    $connect = mysqli_connect('localhost','trade','@Bobys123@','trade');
    if (!$connect) {
        die("Internal server error!");
    }
    
    
    function getPackageList() {
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM package");
        $ret = array();
        while($row = mysqli_fetch_assoc($query)) {
            $ret[]=$row;
        }
        return $ret;
    }
    
    function getUserByToken($token) {
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM token WHERE token='$token'");
        if(mysqli_num_rows($query) > 0) {
            $res = mysqli_fetch_array($query);
            return $res['user_id'];
        } else {
            return false;
        }
    }    
    function getUserEntireData($id) {
        global $connect;
        $query = mysqli_query($connect, "SELECT * FROM admin where id='".$id."'");
        $res = mysqli_fetch_array($query);
        return $res;
    }   
    
    function getPackage($pack_id) {
        global $connect;
        $q = mysqli_query($connect, "SELECT * FROM package WHERE package_id = '$pack_id'");
        $f = mysqli_fetch_array($q);
        return $f;
    }
    function dataRefresher($token) {
        global $connect;
    	$user_id = getUserByToken($token);
    	if($user_id == false) {
    		$array = array('success' => 'false', 'type' => 'expired', 'msg' => 'Login Expired. Redirecting...');
    		echo json_encode($array);
    		exit;
    	} else {
        	$query = mysqli_query($connect, "SELECT * FROM users WHERE id = '".$user_id."'");
        	if(mysqli_num_rows($query) == 0) {
        		$array = array('success' => 'false', 'type' => 'expired', 'msg' => 'Login Expired. Redirecting...');
        		return false;
        	} else {
        	   
        		$user_data = getUserEntireData($user_id);
        		$new_user = array();
        		$news = mysqli_query($connect, "SELECT username, register_date FROM users ORDER BY id DESC LIMIT 20"); 
				while($roo = mysqli_fetch_assoc($news)) {
				    $new_user[]=$roo;
				}
				
        		// Counter //
        		$bonus_count = 0;
        		$bonus = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as leveling FROM history WHERE type='level' AND user_id='$user_id'"));
        		$bonus_count = $bonus_count+$bonus['leveling'];
        		
        		$refer_count = 0;
        		$refer = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(amount) as refer FROM history WHERE type='sponsor' AND user_id='$user_id'"));
        		$refer_count = $refer_count+$refer['refer'];
        		$total_count = $refer_count + $bonus_count;
        		
                $roadmap = rewardCounter($user_id);
                $array = array('user_data' => $user_data, 'total_count' => $total_count, 'bonus_count' => $bonus_count, 'refer_count' => $refer_count, 'roadmap' => $roadmap, 'new_user' => $new_user);
                return $array;
        	}
    	}
    }
?>