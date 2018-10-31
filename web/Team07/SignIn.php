<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Team 07</title>
	<?php require 'DBConnection.php'; ?>
	<?php

	if(isset($_POST['username'])&&isset($_POST['password'])){
		$username = test_input($_POST['username']);
		$password = password_hash(test_input($_POST['password']));
		if (password_verify($password, getHash($username))) {
			$_SESSION['username'] = $username;
			header('Location: ' . 'Welcome.php');
			die();
		} else {
			echo 'Invalid password.';
		}
	}
	?>
</head>
<body>
	<h1>SignIn</h1>
	<form method="post" class="text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="input-group">
			<span class="input-group-addon">Username</span>
			<input type="text" class="form-control" id="username" name="username">
		</div>
		<div class="input-group">
			<span class="input-group-addon">Password</span>
			<input type="password" class="form-control" id="password" name="password">
		</div>
		<button class="btn btn-default" type="submit">Login</button>
	</form>
</body>
</html>