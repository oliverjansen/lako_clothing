<?php
session_start();


if(isset($_POST["submit_order"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		if(!isset($_SESSION["u_id"])){
			header("Location: ../login.php");
			exit();
		}
		
		include_once'dbh.inc.php';
		
		$totalamount = 0;
		$order_id = 0;
		
		//check last order id in the database
		$sql = "SELECT MAX(ID) AS ID FROM tbl_orders";
		$res = mysqli_query($conn, $sql);
		$order = mysqli_fetch_assoc($res);
		$order_id = $order["ID"] + 1;
		
		//insert order in the database
		$sql = "INSERT INTO tbl_orders (id, user_id, total, date_ordered) 
					VALUES ($order_id, ".$_SESSION['u_id'].", $totalamount, NOW())";
		mysqli_query($conn, $sql);
		
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			$total = 0;
			$total = $values['item_quantity'] * $values['item_price'];
			
			//insert order detais in the database
			$sql = "INSERT INTO tbl_order_details (order_id, product_id, price, quantity, total) 
						VALUES ($order_id, ".$values['item_id'].", ".$values['item_price'].", ".$values['item_quantity'].", $total)";
			mysqli_query($conn, $sql);
			
			$totalamount += $values['item_quantity'] * $values['item_price'];
		}
		
		$sql = "UPDATE tbl_orders SET total = $totalamount WHERE ID = $order_id";
		mysqli_query($conn, $sql);
		
		unset($_SESSION['shopping_cart']);
		
		header("Location: ../account.php");
		exit();
	}else{
		header("Location: ../women.php");
		exit();
	}
}

/*if(isset($_POST['submit_order'])){

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
					header("Location: ../signup.php?signup=success");
	             exit();
				}
			}
		}
	}
	
	
	
}else{
	header("Location: ../women.php");
	exit();
	
} */
