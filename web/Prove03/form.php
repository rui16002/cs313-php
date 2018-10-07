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
  
if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
    // check if address only contains letters, numbers and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$address)) {
      $addressErr = "Only letters, numbers and white space allowed"; 
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

if (empty($_POST["zipCode"])) {
    $zipCodeErr = "Zip Code is required";
  } else {
    $zipCode = test_input($_POST["zipCode"]);
    // check if zipCode only contains numbers
    if (!preg_match("/^[0-9]*$/",$zipCode)) {
      $zipCodeErr = "Only numbers allowed"; 
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

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="name">Nombre</label>
  <input type="text" value="<?php echo $name;?>" id="name" name="name">
  <span class="error">* <?php echo $nameErr;?></span><br><br>
  <label for="streetAddress">Dirección</label>
  <input type="text" value="<?php echo $address;?>" id="address" name="address">
  <span class="error">* <?php echo $addressErr;?></span><br><br>
  <label for="city">Ciudad</label>
  <input type="text" value="<?php echo $city;?>" id="city" name="city">
  <span class="error">* <?php echo $cityErr;?></span><br><br>
  <label for="state">Estado</label>
  <input type="text" value="<?php echo $state;?>" id="state" name="state">
  <span class="error">* <?php echo $stateErr;?></span><br><br>
  <label for="zipCode">CP</label>
  <input type="text" value="<?php echo $zipCode;?>" id="zipCode" name="zipCode">
  <span class="error">* <?php echo $zipCodeErr;?></span><br><br>
  <input type="submit" name="submit" value="Submit"> <br><br>
  <p><span class="error">* Campo requerido</span></p>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $address;
echo "<br>";
echo $city;
echo "<br>";
echo $state;
echo "<br>";
echo $zipCode;
?>

</body>
</html>