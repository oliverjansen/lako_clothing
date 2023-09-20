<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	</html>
<?php 

session_start();

if(isset($_POST['submit'])){
	include'dbh.inc.php';
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']); 

   //Error handlers 
   //check if inputs are empty 
   
   if(empty($uid) || empty($pwd)){
	  
	    header("Location: ../login.php?login=empty");
		
	   exit();
   }else{
	   $sql = "SELECT * FROM users WHERE user_uid='$uid'";
	   $result = mysqli_query($conn, $sql);
	   $resultCheck = mysqli_num_rows($result);
	   if($resultCheck < 1){
		   header("Location: ../login.php?login=error");
			exit();
	   }else{
		   if($row = mysqli_fetch_assoc($result)){
			   // de-hasing the password 
			   $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
			   if($hashedPwdCheck == false){
				   header("Location: ../login.php?login=error");
					exit();
			   }elseif($hashedPwdCheck == true){
				   //log in the user here 
				$_SESSION['u_id']=$row['user_id'];
				$_SESSION['u_first']=$row['user_first'];
				$_SESSION['u_last']=$row['user_last']; 
				$_SESSION['u_email']=$row['user_email']; 
				$_SESSION['u_uid']=$row['user_uid']; 
				$_SESSION['u_pwd']=$row['user_pwd']; 
				$_SESSION['u_address']=$row['user_address']; 
				header("Location: ../index.php?login=success");
				exit();
				   
			   }
		   }
	   }
   }
	   
   }else{
      header("Location: ../index.php?login=error");
	  exit();
}