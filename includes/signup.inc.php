<?php
session_start();
if(isset($_POST['submit'])){

   include_once'dbh.inc.php';

	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	
	//error handlers
	//check for empty fileds 
	
	if(empty($first)||empty($last)||empty($address)||empty($uid)||empty($pwd)|| empty($email)){
		header("Location: ../signup.php?signup=empty");
	    exit();
	}else{
		//check if inputs character are valid
		if(!preg_match("/^[a-zA-Z]*$/", $first ) || !preg_match("/^[a-zA-Z]*$/", $last )){
			header("Location: ../signup.php?signup=invalid");
	        exit();
			
		}else{
			//check if email is valid 
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../signup.php?signup=email");
	            exit();
			}else{
				$sql="SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if($resultCheck>0){
					header("Location: ../signup.php?signup=usertaken");
	             exit();
					
				}else{
					//hasing the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//insert the user insert the data base
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, user_address) 
					VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd', '$address');";
				    mysqli_query($conn, $sql);
					header("Location: ../index.php?signup=success");
	             exit();
				}
			}
		}
	}
	
	
	
}else{
	header("Location: ../signup.php");
	exit();
	
} 
