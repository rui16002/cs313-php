<?php
session_start();
?>
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
        <li><a href="#" onclick="displayContent('entrantes');">Entrantes</a></li>
        <li class="active"><a href="#" onclick="displayContent('pizzas');">Pizzas</a></li>
        <li><a href="#" onclick="displayContent('bebidas');">Bebidas</a></li>
        <li><a href="#" onclick="displayContent('postres');">Postres</a></li>
        <li><a href="#" onclick="displayContent('extras');">Extras</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" onclick="displayContent('cart');"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php 
//Read the XML first
$couldgetcontent = false;
if (!$couldgetcontent){
$_SESSION["xml"]=simplexml_load_file("content.xml");
}
if ($_SESSION["xml"] === false) {
//save a global var with the state in order to skip the execution of the script at the end
    echo "<h1>Sorry it seems our kitchen is on fire</h1>";
    echo "<h2>We couldn't save our precious food for you to taste</h2>";
        foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
  }
  else
  {
    $couldgetcontent = true;
  }

function printItems($list)
{
foreach($list->children() as $types) {
echo <<< HereDocString
<div class="col-sm-4" onclick="shopItem('$types->name', '$types->description', '$types->img', '$types->price')">
HereDocString;
       echo "<div class='panel panel-default'>";
        echo "<div class='panel-heading text-center'>".$types->name."</div>";
        echo "<div class='panel-body'><img src='".$types->img."' class='img-responsive' alt='Image'></div>";
        echo "<div class='panel-footer'>";
         echo "<div class='row'>";
          echo "<div class='col-sm-12 description'>".$types->description."</div>";
          echo "<div class='col-sm-6 oldprice'></div>";
          echo "<div class='col-sm-6 newprice'>".$types->price." €</div>";
         echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        }
}
?>

<div id="entrantes" class="entrantes">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($_SESSION["xml"]->entrante);
    }
      ?>
  </div>    
  </div>
</div>
<div id="pizzas" class="pizzas">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($_SESSION["xml"]->pizza);
    }
      ?>
  </div>    
  </div>
</div>  
<div id="bebidas" class="bebidas">
  <div class="container">    
  <div class="row">
    <?php
    if ($couldgetcontent)
    { 
      printItems($_SESSION["xml"]->bebida);
    }
      ?>
  </div>    
  </div>
</div>
<div id="postres" class="postres">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($_SESSION["xml"]->postre);
    }
      ?>
  </div>    
  </div>
</div>
<div id="extras" class="extras">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($_SESSION["xml"]->extra);
    }
    ?>
  </div>    
  </div>
</div>
<div id="cart" class="cart">
  <div class="container">    
   <div class="row">
    <div class="col-sm-12 form-title">
     <h3>Complete la compra</h3>
    </div>
    <div class="col-sm-7">
      <h4>Su compra</h4>   
       <div class="row" id="shopping_cart">        
      </div>
      <h5>Click sobre un item para quitar</h5>
    </div>
    <div class="col-sm-5">
      <h4>Información de envio</h4>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="name">Nombre</label>
  <input type="text" placeholder="<?php echo $name;?>" id="name" name="name">
  <span class="error">* <?php echo $nameErr;?></span><br><br>
  <label for="streetAddress">Dirección</label>
  <input type="text" placeholder="<?php echo $address;?>" id="address" name="address">
  <span class="error">* <?php echo $addressErr;?></span><br><br>
  <label for="city">Ciudad</label>
  <input type="text" placeholder="<?php echo $city;?>" id="city" name="city">
  <span class="error">* <?php echo $cityErr;?></span><br><br>
  <label for="state">Estado</label>
  <input type="text" placeholder="<?php echo $state;?>" id="state" name="state">
  <span class="error">* <?php echo $stateErr;?></span><br><br>
  <label for="zipCode">CP</label>
  <input type="text" placeholder="<?php echo $zipCode;?>" id="zipCode" name="zipCode">
  <span class="error">* <?php echo $zipCodeErr;?></span><br><br>
  <input type="submit" name="submit" value="Submit"> <br><br>
  <p><span class="error">* Campo requerido</span></p>
</form>
</div>
</div>
</div>
</div>

<br><br>
<footer class="container-fluid text-center">
  <p>Based on example in W3School</p>  
  <form class="form-inline">Promociones:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Suscribirse</button>
  </form>
</footer>
  <script type="text/javascript">displayContent("pizzas");</script>
  <?php
//------------------------------Handle Form -----------------------------------
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
</body>
</html>
