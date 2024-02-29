<?php
date_default_timezone_set('Asia/Jakarta');
    $his = date("d-m-Y H:i:s");
    $result = array('success' => "false", 'msg' => 'Nothing to do');
    $connect = mysqli_connect('localhost','trade','@Bobys123@','trade');
    if (!$connect) {
        die("Internal server error!");
    }
    
    
    function getUserEntireData($id) {
        global $connect;
        $query = mysqli_query($connect, "SELECT a.*,c.fund, f.fund as rp, d.fund as sharing FROM users a
                                        LEFT JOIN idr f ON f.uid = a.id
                                        LEFT JOIN wallet c ON c.userid = a.id
										LEFT JOIN profit_sharing d ON d.uid=a.id
                                        WHERE a.id='".$id."'");
        $res = mysqli_fetch_array($query);
        return $res;
    }    
?>