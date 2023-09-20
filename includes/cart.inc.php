<?php 

session_start();

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName); 
option1 ($order_array, $connect)


if(isset($_POST['submit'])){
		include'dbh.inc.php';

		if (isset($_SESSION['u_id'])){
			
			function option1($array, $conn)
					if(is_array($array))
					{
						forearch($array as $row => $value){
						$item_name = mysqli_real_escape_string($conn, $value['item_name']);
						$item_price = mysqli_real_escape_string($conn, $value['item_price']);
						$item_quantity = mysqli_real_escape_string($conn, $value['item_quantity']);
						$sql = "INSERT INTO tbl_orders (product_name, product_quantity, product_price) VALUES ('".$item_name."', '".$item_price."', '".$item_quantity."');";
						mysqli_query($conn, $sql);
						}
					}
				
			
					
		}else{
			  header("Location: ../login.php?login=success");
		 }
	
		
}