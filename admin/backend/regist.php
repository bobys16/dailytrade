<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
	include "../config/session.php";
	include "../config/mailer.php";
	include "../config/includes/config.php";

	$email = str_replace("'","",$_POST['email']);
	$fullname = str_replace("'","",$_POST['name']);
	$phone = str_replace("'","",$_POST['phone']);
	$pass = str_replace("'","",$_POST['pass']); 
	$cpass = str_replace("'","",$_POST['cpass']);
	$uname = clean($_POST['uname']);
	$upline = $_POST['upline'];
	$position = $_POST['position'];
    $ref = $user_id;
	
if($user_data['package_id'] > 0) {
  if($email == '' || $fullname == '' || $phone == '' || $pass == '' || $cpass == '' || $uname == '') {
	$result['success'] == 'false';
	$result['msg'] == "An empty field found!";
  } else {
 	if(strlen($phone < 15)) {
	   $result['success'] = 'false';
	   $result['msg'] = 'Invalid phone number';
	} else {
	    if(strpos($email, "@") === false) {
    		$result['success'] = 'false';
    		$result['msg'] = 'Invalid email';
	    } else {
    		if($pass !== $cpass) {
    	 
    		   $result['success'] = 'false';
    		   $result['msg'] = "Password didn't match";
    
    		} else {
    		    if(strlen($uname) > 15 || strlen($uname) < 5) {
    		        
    		        $result['msg'] = "Username must in range 5 - 15 character";
    		        
    		    } else {
    		        
                    $check = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
                    $check_uname = mysqli_query($connect, "SELECT * FROM users WHERE username='".$uname."'");
                    
                    if(mysqli_num_rows($check) == 0 && mysqli_num_rows($check_uname) == 0) {
                        if(isset($position)){
                            if($position == 'kanan'){
                                $query = "INSERT INTO users VALUES(NULL,'$email','$pass','unset','$fullname','$uname','$ref','$phone','','','$upline','kanan','$his')";
                                mysqli_query($connect, $query);
                                $inserted_id = mysqli_insert_id($connect);
                                mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                mysqli_query($connect, "INSERT INTO bonus VALUES(NULL,'$inserted_id','0','$his')");
                                $update = [
                         	                'kanan' => $inserted_id,
                                   	    ];
                                $update = $model->db_update($db, 'users', $update, "id='$upline'");
                                $result['success'] = 'true';
                                $result['msg'] = 'Register success!';
                            }else if($position == 'kiri'){
                                $query = "INSERT INTO users VALUES(NULL,'$email','$pass','unset','$fullname','$uname','$ref','$phone','','','$upline','kiri','$his')";
                                mysqli_query($connect, $query);
                                $inserted_id = mysqli_insert_id($connect);
                                mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                mysqli_query($connect, "INSERT INTO bonus VALUES(NULL,'$inserted_id','0','$his')");
                                    $update = [
                             	                'kiri' => $inserted_id,
                                       	    ];
                                    $update = $model->db_update($db, 'users', $update, "id='$upline'");
                                $result['success'] = 'true';
                                $result['msg'] = 'Register success!';
                            }
                            
                        } else {
                                    
                            $check2 = mysqli_query($connect, "SELECT * FROM users WHERE id='$ref'");
                            $array = array();
                            $success = false;
                            if(mysqli_num_rows($check2) > 0){
                                $fetch_check = mysqli_fetch_array($check2);
                                if($fetch_check['kiri'] !== null || $fetch_check['kiri'] !== ''){
                                    $array[]=$fetch_check['kiri']; 
                                }
                                if($fetch_check['kanan'] !== null || $fetch_check['kanan'] !== ''){
                                    $array[]=$fetch_check['kanan'];
                                }
                                if($fetch_check['kiri'] == null){
                                            $insert = [
                                     	          'email' => $email,
                                     	          'pass' => $pass,
                                     	          'pin' => 'unset',
                                     	          'full_name' => $fullname,
                                     	          'username' => $uname,
                                     	          'ref' => $ref,
                                     	          'phone' => $phone,
                                     	          'kiri' => NULL,
                                     	          'kanan' => NULL,
                                     	          'upline' => $ref,
                                     	          'position' => 'kiri',
                                     	          'register_date' => $his,
                                               ];
                                            $insert1 = $model->db_insert($db, 'users', $insert);
                                            $inserted_id = mysqli_insert_id($db);
                                            $id = mysqli_insert_id($db);
                                            $update = [
                                     	                'kiri' => $id,
                                               	    ];
                                            $update = $model->db_update($db, 'users', $update, "id='$ref'");
                                            mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                            mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bonus VALUES('','$inserted_id','0','$his')");
                                            $success = true;
                                }else if($fetch_check['kanan'] == null){
                                            $insert = [
                                     	          'email' => $email,
                                     	          'pass' => $pass,
                                     	          'pin' => 'unset',
                                     	          'full_name' => $fullname,
                                     	          'username' => $uname,
                                     	          'ref' => $ref,
                                     	          'phone' => $phone,
                                     	          'kiri' => NULL,
                                     	          'kanan' => NULL,
                                     	          'upline' => $ref,
                                     	          'position' => 'kanan',
                                     	          'register_date' => $his,
                                               ];
                                            $insert1 = $model->db_insert($db, 'users', $insert);
                                            $inserted_id = mysqli_insert_id($db);
                                            $id = mysqli_insert_id($db);
                                            $update = [
                                     	                'kanan' => $id,
                                               	    ];
                                            $update = $model->db_update($db, 'users', $update, "id='$ref'");
                                            mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                            mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bonus VALUES('','$inserted_id','0','$his')");
                                            $success = true;
                                }
                                if(!$success){
                                    $next = array();
                                    $i=0;
                                    while(!$success) {
                                        $upline = $array[$i];
                                        $data_upline = mysqli_query($connect, "SELECT * FROM users where id='$upline'");
                                        $fetch = mysqli_fetch_array($data_upline);
                                        if($fetch['kiri'] !== null || $fetch['kiri'] !== '') {
                                            $next[]= $fetch['kiri'];
                                        }
                                        if($fetch['kanan'] !== null || $fetch['kanan'] !== '') {
                                            $next[]= $fetch['kanan'];
                                        }
                                        if($fetch['kiri'] == '' || $fetch['kiri'] == null) {
                                            // insert kiri
                                            $insert = [
                                     	          'email' => $email,
                                     	          'pass' => $pass,
                                     	          'pin' => 'unset',
                                     	          'full_name' => $fullname,
                                     	          'username' => $uname,
                                     	          'ref' => $ref,
                                     	          'phone' => $phone,
                                     	          'kiri' => NULL,
                                     	          'kanan' => NULL,
                                     	          'upline' => $upline,
                                     	          'position' => 'kiri',
                                     	          'register_date' => $his,
                                               ];
                                            $insert1 = $model->db_insert($db, 'users', $insert);
                                            $inserted_id = mysqli_insert_id($db);
                                            $id = mysqli_insert_id($db);
                                            $update = [
                                     	                'kiri' => $id,
                                               	    ];
                                            $update = $model->db_update($db, 'users', $update, "id='$upline'");
                                            mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                            mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bonus VALUES('','$inserted_id','0','$his')");
                                            $_SESSION['id'] = $inserted_id;
                                            $success = true;
                                        } else if($fetch['kanan'] == null || $fetch['kanan'] == ''){
                                            $insert = [
                                     	          'email' => $email,
                                     	          'pass' => $pass,
                                     	          'pin' => 'unset',
                                     	          'full_name' => $fullname,
                                     	          'username' => $uname,
                                     	          'ref' => $ref,
                                     	          'phone' => $phone,
                                     	          'kiri' => NULL,
                                     	          'kanan' => NULL,
                                     	          'upline' => $upline,
                                     	          'position' => 'kanan',
                                     	          'register_date' => $his,
                                               ];
                                            $insert1 = $model->db_insert($db, 'users', $insert);
                                            $inserted_id = mysqli_insert_id($db);
                                            $id = mysqli_insert_id($db);
                                            $update = [
                                     	                'kanan' => $id,
                                               	    ];
                                            $update = $model->db_update($db, 'users', $update, "id='$upline'");
                                            mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                            mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                            mysqli_query($connect, "INSERT INTO bonus VALUES('','$inserted_id','0','$his')");
                                            $success = true;
                                        }
                                        $i++;
                                        if($i == count($array)) {
                                            $array = $next;
                                            $i=0;
                                        }
                                    }
                                }
                        
                            }else{
                                    $insert = [
                                     	          'email' => $email,
                                     	          'pass' => $pass,
                                     	          'pin' => 'unset',
                                     	          'full_name' => $fullname,
                                     	          'username' => $uname,
                                     	          'ref' => $ref,
                                     	          'phone' => $phone,
                                     	          'kiri' => '',
                                     	          'kanan' => '',
                                     	          'upline' => '',
                                     	          'position' => '',
                                     	          'register_date' => $his,
                                               ];
                                    $insert = $model->db_insert($db, 'users', $insert);
                                    $inserted_id = mysqli_insert_id($db);
                                    mysqli_query($connect, "INSERT INTO user_package VALUES(NULL,'$inserted_id','0','$his')");
                                    mysqli_query($connect, "INSERT INTO bank VALUES(NULL, '$inserted_id', '', '', '', '','','Active')");
                                    mysqli_query($connect, "INSERT INTO wallet VALUES('$inserted_id','0','$his')");
                                    mysqli_query($connect, "INSERT INTO bonus VALUES('','$inserted_id','0','$his')");
                                    $result['error'] = mysqli_error($connect);
                            }
                        
                        
                        
                            $result['success'] = 'true';
                            $result['msg'] = "Register success!";
                    
                        }
                    } else {
                        $result['msg'] = 'Email used';
                    }
    		   
    		    }
    		}
	   }
	}
  }
} else {
    $result['msg'] = "Your account is inactive. please buy package for activate your account";
}
	echo json_encode($result);
} else {
   echo json_encode(array('error' => 1));

}
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>
