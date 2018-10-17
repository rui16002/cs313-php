
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

  <!--?php require 'DBConnection.php';?-->
  <?php
function printClients(){
  echo'<div class="media">';
  echo'<div class="media-left">';
  echo'<img src="img_avatar1.png" class="media-object" style="width:60px">';
  echo'</div>';
  echo'<div class="media-body">';
  echo'<h4 class="media-heading">John Doe</h4>';
  echo'<p>';
  echo'<strong>Email:</strong> john@email.com<br>';
  echo'<strong>Teléfono:</strong> 73487838744';
  echo'</p>';
  echo'</div>';
  echo'</div>';
}
  ?>
}

</head>
<body>
<div class="page-header">
 <img src="cover.jpg" class="img-responsive cover" alt="Cover">
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="logo.jpg" class="logo img-thumbnail" alt="Logo">
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#" onclick="displayContent('clientes');">Clientes</a></li>
      <li class="dropdown"><a href="#" onclick="displayContent('productos');">Productos</a></li>
      <li><a href="#" onclick="displayContent('ordenes');">Ordenes</a></li>
    </ul>
  </div>
</nav>

<div id="clientes" class="clientes container">
  <form class="form-inline" action="">
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="firstName">
  </div>
  <div class="input-group">
    <span class="input-group-addon">Apellido</span>
    <input type="text" class="form-control" id="lastName">
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="clientes-container">
</div>
<?php printClients(); ?>
</div>

<div id="ordenes" class="ordenes section">
    <form class="form-inline" action="">
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="firstName">
  </div>
  <div class="input-group">
    <span class="input-group-addon">Apellido</span>
    <input type="text" class="form-control" id="lastName">
  </div>
    <div class="input-group">
    <span class="input-group-addon">Fecha</span>
    <input type="date" class="form-control" id="date">
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="ordenes-container">
  <?php printOrders(); ?>
</div>
</div>

<div id="productos" class="productos section">
  <form class="form-inline" action="">
  <div class="input-group">
  <span class="input-group-addon">Tipo</span>
  <select class="form-control" id="type">
    <option>Entrantes</option>
    <option>Principales</option>
    <option>Bebidas</option>
    <option>Postres</option>
  </select>
  </div>
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="menuItemName">
  </div>
  <div class="input-group">
    <label class="checkbox-inline"><input type="checkbox" value="">Disponible</label>
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="productos-container" class="productos section">
   <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">Panel Heading</div>
    <div class="panel-body">Panel Content</div>
    <div class="panel-footer">Panel Footer</div>
  </div>
</div>
</div>
</div>

<br>
<footer class="container-fluid text-center">
  <p>Based on example in W3School</p>  
  <form class="form-inline">Promociones:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Suscribirse</button>
  </form>
</footer>
<script type="text/javascript">displayContent("clientes");</script>
    </div>
</body>
</html>
