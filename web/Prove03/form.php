<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $addressErr = $cityErr = $stateErr = $zipCodeErr = "";
$name = $address = $city = $state = $zipCode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
    
  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
    $city = test_input($_POST["city"]);
    // check if city only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
      $cityErr = "Only letters and white space allowed"; 
    }
  }

if (empty($_POST["state"])) {
    $stateErr = "State is required";
  } else {
    $state = test_input($_POST["state"]);
    // check if state only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$state)) {
      $stateErr = "Only letters and white space allowed"; 
    }
  }

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
?>

</body>
</html>