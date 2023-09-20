<?php
session_start();


if(isset($_POST["add_new_product"]))
{
	if($_POST["name"] && $_POST["price"] && $_FILES["productfile"])
	{
		include_once'dbh.inc.php';
		
		$uploaddir = "../img/product-img/";
		$uploadfile = $uploaddir.basename($_FILES["productfile"]["name"]);
		
		if(move_uploaded_file($_FILES["productfile"]["tmp_name"], $uploadfile)){
			//insert product in the database
			$sql = "INSERT INTO tbl_product (category, name, image, price) 
						VALUES ('".$_POST['category']."', '".$_POST['name']."', '".basename($_FILES["productfile"]["name"])."', '".$_POST['price']."')";
			mysqli_query($conn, $sql);
			
			if($_POST["category"] == "WOMEN"){
				header("Location: ../women.php?message=Success");
			}else{
				header("Location: ../men.php?message=Success");
			}
			exit();
		}else{
			if($_POST["category"] == "WOMEN"){
				header("Location: ../women.php?message=Error uploading the file");
			}else{
				header("Location: ../men.php?message=Error uploading the file");
			}
			exit();
		}
		
		
	}else{
		
		if($_POST["category"] == "WOMEN"){
			header("Location: ../women.php?message=Incomplete entry");
		}else{
			header("Location: ../men.php?message=Incomplete entry");
		}
		exit();
	}
}

