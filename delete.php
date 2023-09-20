	<?php include_once 'header.php';

	if(isset($_SESSION['u_id'])){
		include_once 'includes/dbh.inc.php';
		include_once '/include/conn.php';
	}else{
		header("Location: login.php");
		exit();
	}
	
	if(isset($_GET['action'])){
		if(isset($_GET['id'])){
			$sql = "DELETE FROM tbl_orders WHERE ID = ".$_GET['id'];
			mysqli_query($conn, $sql);
			echo '<script>alert("Order deleted.")</script>';
			header("Location: account.php");
		}
	}