<?php
	include_once 'header.php';

	if(isset($_SESSION['u_id'])){
		include_once 'includes/dbh.inc.php';
		include_once '/include/conn.php';
	}else{
		header("Location: login.php");
		exit();
	}
	
	if(isset($_GET['action'])){
		if(isset($_GET['id'])){
			$sql = "UPDATE tbl_orders SET date_cancelled = NOW() WHERE ID = ".$_GET['id'];
			mysqli_query($conn, $sql);
			echo '<script>alert("Order cancelled.")</script>';
		}
	}
	


	
	
?> 

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<br />
			
			
			
			
			
					<?php
								$query = "SELECT * FROM tbl_orders WHERE user_id = ".$_SESSION['u_id']." ORDER BY date_ordered DESC";
								$result = mysqli_query($conn, $query);
						
						$query1 = "SELECT * from tbl_orders";
						$result1 = mysqli_query($conn, $query1);
						
					if($_SESSION['u_uid'] == "admins"){
						
						?>
						<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/account.jpg);">
						
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>ADMIN ACCOUNT DETAILS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<br /><br />
				<div class="col-md-12" align="right">

                     <form method="post" action = "pdf.php">  

                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  

                     </form>  

                     </div>
						<div style="clear:both"></div>
						<br />
						<h3>Admin Order History</h3>
						<div class="table-responsive">
							<table class="table table-bordered">
							<tr>
							<th width="20%">Reference Number</th>
							<th width="10%">User</th>
							<th width="30%">Total</th>
							<th width="15%">Date Ordered</th>
							<th width="15%">Date Cancelled</th>
							<th width="10%">Cancel</th>
							<th width="10%">Delete</th>
							</tr>
						
						
					<?php
						if(mysqli_num_rows($result1) > 0)
						{ 
							while($rows = mysqli_fetch_assoc($result1))
							{
								
						?>
					
									<tr>
									<td><?php echo $rows['id']; ?></td>
									<td><?php echo $rows['user_id']; ?></td>
									<td><?php echo $rows['total']; ?></td>
									<td><?php echo $rows['date_ordered']; ?></td>
									<td><?php echo $rows['date_cancelled']; ?></td>
									<td><?php if($rows["date_cancelled"] == '') { ?><a href="account.php?action=cancel&id=<?php echo $rows["id"]; ?>"><span class="text-danger">Cancel</span></a><?php } ?></td>
									<td><?php?><a href="delete.php?action=delete name=delete&id=<?php echo $rows["id"]; ?>"><span class="text-danger">Delete</span></a><?php } ?></td>
									
									</tr>
						
							
					
					<?php
							
						
							}
							
						
						?>
							</table>
						</div>
							<?php
					}else{
						
					?>
	<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/account.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>ACCOUNT DETAILS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<br /><br />					
					<?php
								if(mysqli_num_rows($result) > 0)
								{
									
									?>
									<div style="clear:both"></div>
								<br />
								<h3>Order History</h3>
								<div class="table-responsive">
									<table class="table table-bordered">
										<tr>
											<th width="20%">Reference Number</th>
											<th width="10%">Items</th>
											<th width="30%">Total</th>
											<th width="15%">Date Ordered</th>
											<th width="15%">Date Cancelled</th>
											<th width="10%">Action</th>
										</tr>
									
									<?php
									
									while($row = mysqli_fetch_array($result))
									{
										$items = 0;
										$query2 = "SELECT COUNT(id) AS total FROM tbl_order_details WHERE order_id = ".$row["id"];
										$result2 = mysqli_query($conn, $query2);
										$items = mysqli_fetch_assoc($result2);
								?>
								<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $items["total"]; ?></td>
						<td><?php echo number_format($row["total"], 2); ?></td>
						<td><?php echo date('m-d-Y H:i:s', strtotime($row["date_ordered"]));?></td>
						<td><?php if($row["date_cancelled"] == '') { echo ''; } else { echo date('m-d-Y H:i:s', strtotime($row["date_cancelled"])); } ?></td>
						<td><?php if($row["date_cancelled"] == '') { ?><a href="account.php?action=cancel&id=<?php echo $row["id"]; ?>"><span class="text-danger">Cancel</span></a><?php } ?>	</td>
						
					</tr>
								<?php
							}
						}
						?>
					</table>
				</div>
					<?php
					}
					?>
					
			
			
			</div>
			
		</div>

	<br />
	</body>
</html>

<?php

	include_once 'footer.php';
?>
