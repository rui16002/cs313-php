<!DOCTYPE html>
<html lang="en">
<head>
	<title>Team 07</title>
	<?php
	require 'DBConnection.php';

	function valid($password){
		if (!preg_match("/^[a-zA-Z ]{6,}[0-9]+$/",$password)) {
      $error = "At least 7 character long and one number is required"; 
      return false;
    }
    return true;
	}

	if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password2'])){
		$username = test_input($_POST['username']);
		$password = password_hash(test_input($_POST['password']), PASSWORD_DEFAULT);
		if(($_POST['password']==$_POST['password2'])&&(valid($_POST['password'])))
		{
			if (insertUser($username, $password)!= ""){
				header('Location: ' . 'SignIn.php');
				die();
			}
		}
		else
		{
			header("Location: SignUp.php");
			echo "passwords don't match";
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
			  <span style="color:red;">* <?php echo $error;?></span>
		</div>		
		<div class="input-group">
			<span class="input-group-addon">Password verify</span>
			<input type="password" class="form-control" id="password2" name="password2">
			  <span style="color:red;">* <?php echo $error;?></span>
		</div>
		<button class="btn btn-default" type="submit">Create</button>
	</form>
</body>
</html>

