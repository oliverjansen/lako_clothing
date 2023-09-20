<?php
	include_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Signup form</title>
  <link rel="stylesheet" href="./style1.css">
</head>
<body>
<!-- partial:index.partial.html -->

	<br><br><br><br>
   <div class="form" action="includes/signup.inc.php" method="POST">
    
    <form class="signup-form" action="includes/signup.inc.php" method="POST"> 
	<h1>Signup</h1>
	  <input type="text" name="first" placeholder="first name"/>
      <input type="text" name="last" placeholder="last name"/>
	   <input type="text" name="email" placeholder="Email"/>
	  <input type="text" name="address" placeholder="address"/>
      <input type="text" name="uid" placeholder="username"/>
      <input type="password" name="pwd" placeholder="password"/>
	  
      <button type="submit" name="submit">Sign Up</button>
     
    </form>
	
  
</div>
<!-- partial -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script  src="./script.js"></script>

</body>
</html>