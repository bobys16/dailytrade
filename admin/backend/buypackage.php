<?php
include "../config/session.php";
$id = $user_id;
$package = $_POST['package'];
$userdata = getUserEntireData($id);
$q_pack = mysqli_query($connect, "SELECT * FROM package WHERE package_id = '$package'");
$getPackage = mysqli_fetch_array($q_pack);
$current = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM package WHERE package_id = '".$getPackage['package_id']."'"));

if(mysqli_num_rows($q_pack) > 0) {
    $amount = $current['price'];
    if($amount >$userdata['fund']) {
        $result['msg'] = "Insuffience fund";
    } else {
        $amount_idr = $amount*16000;
        
        mysqli_query($connect, "INSERT INTO transaction VALUES('','$id','$amount_idr','upgrade','Buy Package','Success','$his')");
        mysqli_query($connect, "INSERT INTO history VALUES('','$id','spent','Buy Package','$amount_idr','System','$his')");
        mysqli_query($connect, "UPDATE user_package SET package_id = '".$getPackage['package_id']."', date_modify='$his' WHERE userid='$id'");
        mysqli_query($connect, "UPDATE wallet SET fund = fund-".$amount.", date_modify='$his' WHERE userid='$id'");
        $qu = mysqli_query($connect, "SELECT * FROM limitation WHERE uid='".$id."'");
        $limits = ($amount*250)/100;
        if(mysqli_num_rows($qu) > 0) {
            mysqli_query($connect, "UPDATE limitation SET p_limit=p_limit+".$limits.",wd_limit=wd_limit+$amount, total=total+$amount WHERE uid='".$id."'");
        } else {
            mysqli_query($connect, "INSERT INTO limitation VALUES('','".$id."','".$limits."','".$amount."','".$amount."')");
        }
        
        
        $road = mysqli_query($connect, "SELECT * FROM user_roadmap WHERE userid='".$userdata['ref']."'");
        if(mysqli_num_rows($road) > 0) {
            mysqli_query($connect, "UPDATE user_roadmap SET roadmap=roadmap+$amount WHERE userid='".$userdata['ref']."'");
        } else {
            mysqli_query($connect, "INSERT INTO user_roadmap VALUES('".$userdata['ref']."','$amount','0,','$his')");
        }
        $ref_data = getUserEntireData($userdata['upline']);
        $kiri = 0;
        $kanan = 0;
        
        $vol = false;
        $uplines = $userdata['upline'];
        
        while(!$vol) {
            $upli = getUserEntireData($uplines);
            $last_vol = mysqli_query($connect, "SELECT * FROM volume WHERE uid='".$upli['userid']."'");
            $get_vol = getVolume($upli['userid']);
            
            if($get_vol['kiri'] < $get_vol['kanan']) {
                $last = $get_vol['kiri'];
            } else {
                $last = $get_vol['kanan'];
            }
            
            if(mysqli_num_rows($last_vol) > 0) {
                $ftlast = mysqli_fetch_array($last_vol);
                $ft_last = $ftlast['last_vol'];
                if($ft_last < $last) {
                    $tingtong = (($last-$ft_last)/10)*13000;
                    if(limitation($upli['userid']) == 'true') {
                        mysqli_query($connect, "UPDATE bonus SET fund = fund+".$tingtong.", date_modify='$his' WHERE user_id='".$upli['userid']."'");
                    } else {
                        mysqli_query($connect, "UPDATE pending_profit SET fund=fund+".$tingtong." WHERE uid='".$upli['userid']."'");
                    }
                    mysqli_query($connect, "INSERT INTO history VALUES('','".$upli['userid']."','pairing','Pairing Bonus','$tingtong','System','$his')");
                    $qu = mysqli_query($connect, "UPDATE volume SET last_vol=$last WHERE uid='".$upli['userid']."'");   
                }
            } else {
                $ft_last = 0;
                mysqli_query($connect, "INSERT INTO volume VALUES('".$upli['userid']."','0','".date('d-m-Y H:i:s')."')");
                if($ft_last < $last) {
                    $tingtong = (($last-$ft_last)/10)*13000;
                    if(limitation($upli['userid']) == 'true') {
                        mysqli_query($connect, "UPDATE bonus SET fund = fund+".$tingtong.", date_modify='$his' WHERE user_id='".$upli['userid']."'");
                    } else {
                        mysqli_query($connect, "UPDATE pending_profit SET fund = fund+".$tingtong." WHERE uid='".$upli['userid']."'");
                    }
                    mysqli_query($connect, "INSERT INTO history VALUES('','".$upli['userid']."','pairing','Pairing Bonus','$tingtong','System','$his')");
                    $qu = mysqli_query($connect, "UPDATE volume SET last_vol=$last WHERE uid='".$upli['userid']."'");   
                }
            }
            if($upli['upline'] == null || $upli['upline'] == '') {
                $vol=true;
            } else {
                $uplines = $upli['upline'];
            }
        }
        
        /*
        if($ref_data['kiri'] !== null) {
            $kiri_package = getBonus($ref_data['kiri']);
            if($kiri_package['package_id'] > 0) {
                $kiri = $kiri_package['price'];
            }
        }
        
        if($ref_data['kanan'] !== null) {
            $kanan_package = getBonus($ref_data['kanan']);
            if($kanan_package['package_id'] > 0) {
                $kanan = $kanan_package['price'];
            }
        }
        
        if($kiri > 0 && $kanan > 0) {
            if($kiri < $kanan) {
                $pairing = $kiri;
                $trigger = getUserEntireData($ref_data['kiri']);
            } else {
                $trigger = getUserEntireData($ref_data['kanan']);
                $pairing = $kanan;
            }
            $vol_check = mysqli_query($connect, "SELECT * FROM volume WHERE uid='".$userdata['upline']."'");
            if(mysqli_num_rows($vol_check) == 0) {
                mysqli_query($connect, "INSERT INTO volume VALUES('".$userdata['upline']."','$pairing','".date('d-m-Y H:i:s')."')");
            } else {
                mysqli_query($connect, "UPDATE volume SET last_vol=$pairing WHERE uid='".$userdata['upline']."'");
            }
            
            $pairing = ($pairing*13000)/10;
            mysqli_query($connect, "INSERT INTO history VALUES('','".$userdata['upline']."','pairing','Pairing','$pairing','".$trigger['username']."','$his')");
            if(limitation($userdata['upline']) == 'true') {
                mysqli_query($connect, "UPDATE bonus SET fund = fund+".$pairing." WHERE user_id='".$userdata['upline']."'");
            } else {
                mysqli_query($connect, "UPDATE pending_profit SET fund = fund+".$pairing." WHERE uid='".$userdata['upline']."'");
            }
        }
        
        
        
        
        
        
        $road = mysqli_query($connect, "SELECT * FROM user_roadmap WHERE userid='".$ref_data['ref']."'");
        if(mysqli_num_rows($road) > 0) {
            mysqli_query($connect, "UPDATE user_roadmap SET roadmap=roadmap+$amount WHERE userid='".$ref_data['ref']."'");
        } else {
            mysqli_query($connect, "INSERT INTO user_roadmap VALUES('".$ref_data['ref']."','$amount','0','$his')");
        }
        */
        
        $ref = 15;
        
        
        $diff = convertIn($amount) - convertOut($amount);
        
        
        $level = ($diff/10);
        $sponsor = (($amount*13000) / 100) * $ref;
        
        mysqli_query($connect, "INSERT INTO history VALUES('','".$userdata['ref']."','sponsor','Referral Comission','$sponsor','".$userdata['username']."','$his')");
        if(limitation($user_data['ref']) == 'true') {
            mysqli_query($connect, "UPDATE bonus SET fund = fund+".$sponsor.", date_modify='$his' WHERE user_id='".$userdata['ref']."'");
        } else {
            mysqli_query($connect, "UPDATE pending_profit SET fund = fund+".$sponsor." WHERE uid='".$userdata['ref']."'");
        }
        
        for($i=1;$i<=10; $i++) {
            
            mysqli_query($connect, "INSERT INTO history VALUES('','".$ref_data['userid']."','curs','Kurs Commission','$level','".$userdata['username']."','$his')");
            if(limitation($ref_data['userid']) == 'true') {
                mysqli_query($connect, "UPDATE bonus SET fund = fund+".$level.", date_modify='$his' WHERE user_id='".$ref_data['userid']."'");
            } else {
                mysqli_query($connect, "UPDATE pending_profit SET fund = fund+".$level." WHERE uid='".$ref_data['userid']."'");
                
            }
            
            $check = mysqli_query($connect, "SELECT * FROM users WHERE id='".$ref_data['upline']."'");
            if(mysqli_num_rows($check) !== 0) {
                $ref_data = getUserEntireData($ref_data['upline']);
            } else {
                break;
            }
        }
        
        $result['success'] = 'true';
        $result['msg'] = $getPackage['pack_name']." Package activated!";
    }
} else {
    $result['msg'] = "Unknown Package";
}

echo json_encode($result);


function getBonus($id) {
    global $connect;
    $usr = getUserEntireData($id);
    $package = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM package WHERE package_id = '".$usr['package_id']."'"));
    return $package;
}
?>