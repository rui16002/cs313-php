
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
    <?php
    $_SESSION["shopping_cart"] = array();
    ?>
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
        <li><a href="#" onclick="displayContent('pizzas');">Pizzas</a></li>
        <li><a href="#" onclick="displayContent('bebidas');">Bebidas</a></li>
        <li><a href="#" onclick="displayContent('postres');">Postres</a></li>
        <li><a href="#" onclick="displayContent('extras');">Extras</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" onclick="displayContent('cart');"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge">0</span> Carrito</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php 
//Read the XML first
$couldgetcontent = false;
$xml = "";
if (!$couldgetcontent){
$xml=simplexml_load_file("content.xml");
}
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

<div id="entrantes" class="entrantes section">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($xml->entrante);
    }
      ?>
  </div>    
  </div>
</div>
<div id="pizzas" class="pizzas section">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($xml->pizza);
    }
      ?>
  </div>    
  </div>
</div>  
<div id="bebidas" class="bebidas section">
  <div class="container">    
  <div class="row">
    <?php
    if ($couldgetcontent)
    { 
      printItems($xml->bebida);
    }
      ?>
  </div>    
  </div>
</div>
<div id="postres" class="postres section">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($xml->postre);
    }
      ?>
  </div>    
  </div>
</div>
<div id="extras" class="extras section">
  <div class="container">    
  <div class="row">
    <?php 
    if ($couldgetcontent)
    {
      printItems($xml->extra);
    }
    ?>
  </div>    
  </div>
</div>

<div id="cart" class="cart section">
  <div class="container">    
   <div class="row">
    <div class="col-sm-12 form-title">
     <h3>Complete la compra</h3>
    </div>
    <div class="col-sm-6">
      <h4>Su compra</h4>   
       <div class="row" id="shopping_cart">     
      </div>
      <h5>Click sobre un item para quitar</h5>
    </div>
    <div class="col-sm-3">
      <h4>Información de envio</h4>
  <?php include 'form.php'; ?>
</div>
    <div class="col-sm-3">
      <h4>Resultado de la compra</h4>
      <div id="purchaseResult">
        <h5>Aun tienes hambre</h5>
        <img class='img-responsive' alt='Image' src='hungry.jpg'>
      </div>
</div>
</div>
</div>
</div>
<br>
<br>
<footer class="container-fluid text-center">
  <p>Based on example in W3School</p>  
  <form class="form-inline">Promociones:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Suscribirse</button>
  </form>
</footer>
<script type="text/javascript">displayContent("pizzas");</script>
    <div id='itemCount'>
      <?php
print_r($_SESSION);
?>
    </div>
</body>
</html>
