<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Team 07</title>
</head>
<body>
	<h1>Welcome <?php echo $_SESSION['username']; ?> </h1>
</body>
</html>