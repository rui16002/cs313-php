
<!--?php
session_start();
?-->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prove 05</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="Prove05.js"></script>
  <link rel="stylesheet" href="Prove05.css">

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
        <li><a href="#" onclick="displayContent('principales');">Principales</a></li>
        <li><a href="#" onclick="displayContent('bebidas');">Bebidas</a></li>
        <li><a href="#" onclick="displayContent('postres');">Postres</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li><a href="#" onclick="displayContent('clientes');">Clientes</a></li>
        <li><a href="#" onclick="displayContent('ordenes');">Ordenes</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" onclick="displayContent('cart');"><span class="glyphicon glyphicon-shopping-cart"></span><span class="badge">0</span> Carrito</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php require 'DBConnection.php';?>

<div id="clientes" class="clientes section">
</div>

<div id="ordenes" class="ordenes section">
</div>

<div id="entrantes" class="entrantes section">
  <div class="container">    
  <div class="row">
    <?php 
      printItems(getMenuItems(1), "apple");
      ?>
  </div>    
  </div>
</div>
<div id="principales" class="principales section">
  <div class="container">    
  <div class="row">
    <?php 
      printItems(getMenuItems(2), "cutlery");
      ?>
  </div>    
  </div>
</div>  
<div id="bebidas" class="bebidas section">
  <div class="container">    
  <div class="row">
    <?php
      printItems(getMenuItems(3), "glass");
      ?>
  </div>    
  </div>
</div>
<div id="postres" class="postres section">
  <div class="container">    
  <div class="row">
    <?php 
      printItems(getMenuItems(4), "ice-lolly-tasted");
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
<script type="text/javascript">displayContent("principales");</script>
    </div>
</body>
</html>
