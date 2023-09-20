<?php
	include_once 'header.php';
?>
<?php 
//session_start();
$conn = mysqli_connect("localhost", "root", "", "projectdb");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete" && $_GET["id"])
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="men.php"</script>';
			}
		}
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
			
			<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/men.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>MEN'S CLOTHES</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
			<br /><br />
			
			<?php
			
			if($_SESSION['u_uid'] == "admins"){
				
			?>
				<div class="col-md-4">
    
					<form action="includes/product.inc.php" method="POST" enctype="multipart/form-data">
					<div style="border:1px solid #555; background-color:#f2f2f2; border-radius:5px; padding:16px;" align="center">
					<h1>Add New Product</h1>
					  <input type="text" name="name" placeholder="name" class="form-control" /><br />
					  <input type="text" name="price" placeholder="price" class="form-control" /><br />
					  <input type="file" name="productfile" class="form-control" /><br />
					  <input type="hidden" name="category" value="MEN"/>
					  <input type="submit" name="add_new_product" style="margin-top:5px;" class="btn btn-success" value="Add New Product" />
					</form>
					</div>
				  </div>
			<?php
			
			}else{
			
			?>
			
			
			<?php
				$query = "SELECT * FROM tbl_product WHERE category = 'MEN' ORDER BY id ASC";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
				<form method="post" action="men.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #555; background-color:#f2f2f2; border-radius:5px; padding:16px;" align="center">
						<img src="img/product-img/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger"><?php echo number_format($row["price"]); ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			
			
		
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
			<form method="post" action="includes\submitorder.inc.php">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
			
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td><?php echo $values["item_price"]; ?></td>
						<td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="men.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right"><?php echo number_format($total, 2); ?></td>
						<td><input type="submit" name="submit_order" style="margin-top:5px;" class="btn btn-success" value="Submit Order" /></td>
					</tr>
					<?php
					}
					?>
						
				</table>
				</form>
				<?php
			}
				?>
			</div>
		</div>
	</div>
	<br />
	</body>
</html>

<?php

	include_once 'footer.php';
?>

