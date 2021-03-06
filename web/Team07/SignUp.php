<!DOCTYPE html>
<html lang="en">
<head>
	<title>Team 07</title>
	<?php
	require 'DBConnection.php';

	function valid($password){
		if (!preg_match("/^[a-zA-Z ]{6,}[0-9]+$/",$password)) {
			return false;
		}
		return true;
	}

	if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password2'])){
		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);
		$password2 = test_input($_POST['password2']);
		$passwordhash = password_hash($password, PASSWORD_DEFAULT);
		if((strcmp($password, $password2)==0)&&(valid($password)))
		{
			if (insertUser($username, $passwordhash)!= ""){
				header('Location: ' . 'SignIn.php');
				die();
			}
		}
		else
		{
			header("Location: SignUp.php");
			$error = "passwords don't match or not valid. At least 7 characters long, no symbols and one number is required";
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
			<input type="password" class="form-control" id="password" pattern='[a-zA-Z ]{6,}[0-9]+' name="password" title="At least 7 characters long, no symbols and one number is required. Password and confirm password must match">
			<span id='passerror1' style="color:red;">* <?php echo $error;?></span>
		</div>		
		<div class="input-group">
			<span class="input-group-addon">Confirm password</span>
			<input type="password" class="form-control" id="password2" pattern='[a-zA-Z ]{6,}[0-9]+' name="password2" title="At least 7 characters long, no symbols and one number is required. Password and confirm password must match">
			<span id='passerror2' style="color:red;">* <?php echo $error;?></span>
		</div>
		<button class="btn btn-default" type="submit">Create</button>
	</form>


	<script>
		var password = document.getElementById("password");
		var confirm_password = document.getElementById("password2");
		function validatePassword() {
			if(password.value != confirm_password.value) {
				confirm_password.setCustomValidity("Passwords Don't Match");
			} else {
				confirm_password.setCustomValidity('');
			}
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
	
</body>
</html>

