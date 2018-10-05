<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prove 03</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="Prove03.js"></script>
  <link rel="stylesheet" href="Prove03.css">

</head>
<body>
<div class="page-header">
 <img src="logo.jpg" class="img-responsive logo" alt="Logo">
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#" onclick="displayContent('entrante');">Entrantes</a></li>
        <li class="active"><a href="#" onclick="displayContent('pizza');">Pizzas</a></li>
        <li><a href="#" onclick="displayContent('bebida');">Bebidas</a></li>
        <li><a href="#" onclick="displayContent('postre');">Postres</a></li>
        <li><a href="#" onclick="displayContent('extra');">Extras</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" onclick="displayContent('cart');"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php

// define variables and set to empty values
$nameErr = $addressErr = $cityErr = $stateErr = $zipCodeErr = "";
$name = $address = $city = $state = $zipCode = "";

$xml = false;
/*/Read the XML first
$xml=simplexml_load_file("content.xml");
if ($xml === false) {
//save a global var with the state in order to skip the execution of the script at the end
    echo "<h1>Sorry it seems our kitchen is on fire</h1>";
    echo "<h2>We couldn't save our precious food for you to taste</h2>";
        foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
  }
  else
  {
echo "<div id="entrantes" class="entrantes">";
  //$item-number = 0;
  //foreach($xml->entrante->children() as $entrante) { 
  //$item-number++;
  ////If I have already 3 item in a row
  //if ($item-number % 3 == 1)
  //{
    ////close the previous row if there was one open
    ////Add a new row
  //}
  //else
  //{
    ////keep adding elements to the existing row
  //}
  ////close the last row
      //echo $entrante->nombre . ", ";
      //echo $entrante->descripcion . ", ";
      //echo $entrante->imagen . ", ";
      //echo $entrante->precio . "<br>";
       //}

echo "</div>";
echo "<div id="pizzas" class="pizzas">";
echo "</div>";
echo "<div id="bebidas" class="bebidas">";
echo "</div>";
echo "<div id="postres" class="postres">";
echo "</div>";
echo "<div id="extras" class="extras">";
echo "</div>";
echo "<div id="cart" class="cart">";

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
    if (!preg_match("/^[0-9]*$/",$state)) {
      $stateErr = "Only numbers allowed"; 
    }
  }

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
 }
}*/

?>
  <h2>Complete la compra</h2>
  <p><span class="error">* campo requerido</span></p>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="name">Name</label>
  <input type="text" placeholder="<?php echo $name;?>" id="name" name="name">
  <span class="error">* <?php echo $nameErr;?></span><br>
  <label for="streetAddress">Address</label>
  <input type="text" placeholder="<?php echo $address;?>" id="address" name="address">
  <span class="error">* <?php echo $addressErr;?></span><br>
  <label for="city">City</label>
  <input type="text" placeholder="<?php echo $city;?>" id="city" name="city">
  <span class="error">* <?php echo $cityErr;?></span><br>
  <label for="state">State</label>
  <input type="text" placeholder="<?php echo $state;?>" id="state" name="state">
  <span class="error">* <?php echo $stateErr;?></span><br>
  <label for="zipCode">Zip Code</label>
  <input type="text" placeholder="<?php echo $zipCode;?>" id="zipCode" name="zipCode">
  <span class="error">* <?php echo $zipCodeErr;?></span><br>
  <input type="submit" name="submit" value="Submit"> 
</form>
</div>

<!--div id="promociones" class="Promociones">
<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      
      <div class="panel panel-default">
        <div class="panel-heading text-center">Pizza Margarita</div>
        <div class="panel-body"><img src="pizza.jpg" class="img-responsive" alt="Image"></div>
        <div class="panel-footer">
         <div class="row">
          <div class="col-sm-12 description">Salsa + Muzzarella</div>
          <div class="col-sm-6 oldprice">€ 18</div>
          <div class="col-sm-6 newprice">€ 15</div>
         </div>
        </div>
      </div>
    
    </div>

  </div>
</div>

</div-->
<br><br>
<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>
<?php 
if ($xml === false)
{
  echo "<h2>Couldn't load content</h2>";
}
else
{
  echo "<script type="text/javascript">displayContent("pizzas");</script>";
}
?>
</body>
</html>
