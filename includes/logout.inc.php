<?php 

session_start();

//if(isset($_POST['submit'])){
	//include'dbh.inc.php';
	//$uid = mysqli_real_escape_string($conn, $_POST['uid']);
    //$pwd = mysqli_real_escape_string($conn, $_POST['pwd']); 

// session is destroyed 
session_destroy();

header('Location: ../index.php');
exit;

//}

?>