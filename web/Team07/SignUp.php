<!DOCTYPE html>
<html lang="en">
<head>
	<title>Team 07</title>
	<?php header('Location: ' . 'SignIn.php'); ?>

 <?php
 require 'DBConnection.php';

  if(isset($_POST['username'])&&isset($_POST['password'])){
  	$username = test_input($_POST['username']);
  	$password = password_hash(test_input($_POST['password']));
  	if (insertUser($username, $password)!= ""){
  		die();
  	}
  }

  ?>
</head>
<body>
	<h1>SignUp</h1>
	<form method="post" class="text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="input-group">
			<span class="input-group-addon">Username</span>
			<input type="text" class="form-control" id="username" name="username">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Password</span>
			<input type="password" class="form-control" id="password" name="password">
		</div>
		<button class="btn btn-default" type="submit">Create</button>
	</form>
</body>
</html>

