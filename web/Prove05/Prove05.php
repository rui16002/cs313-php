
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

  <?php require 'DBConnection.php';?>
  <?php
function printClients($rows){
  foreach ($rows as $row)
  {
    echo'<div class="media">';
    echo'<div class="media-left">';
    echo'<img src="img_avatar1.png" class="media-object" style="width:70px">';
    echo'</div>';
    echo'<div class="media-body">';
    echo'<h4 class="media-heading">'.$row['firstname'].' '.$row['lastname'].'</h4>';
    echo'<p>';
    echo'<strong>Email:</strong>'.$row['email'].'<br>';
    echo'<strong>Teléfono:</strong>'.$row['phone'];
    echo'</p>';
    echo'</div>';
    echo'</div>';
  }
}

function printOrders($rows){
  foreach ($rows as $row)
  {
    echo '<div class="panel-group">';
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading text-center"><div>';
    if ($row['available']) {
      echo '<span class="glyphicon glyphicon-ok-sign rightaligned">';
    }
    else {
     echo '<span class="glyphicon glyphicon-remove-sign rightaligned">'; 
    }
    echo '</div><div> '.$row['orderdate'].'</div></div>';
    echo '<div class="panel-body">';
    echo '<strong>'.$row['name'].'</strong><br>';
    echo '<em>'.$row['description'].'</em><br>';
    echo '<p class="bg-info text-center">'.$row['price'].' €</p></div>';
    echo '<div class="panel-footer text-center">'.$row['firstname'].' '.$row['lastname'].'</div>';
    echo '</div>';
    echo '</div>';
  }
}

function printProducts($rows){
  foreach ($rows as $row)
  {
    echo '<div class="panel-group">';
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading text-center"><div>';
    if ($row['available']) {
      echo '<span class="glyphicon glyphicon-ok-sign rightaligned">';
    }
    else {
     echo '<span class="glyphicon glyphicon-remove-sign rightaligned">'; 
    }
    echo '</div><strong>'.$row['type'].'</strong></div>';
    echo '<div class="panel-body">';
    echo '<strong>'.$row['name'].'</strong><br>';
    echo '<em>'.$row['description'].'</em></div>';
    echo '<div class="panel-footer text-right"><span class="badge">'.$row['price'].' €</span></div>';
    echo '</div>';
    echo '</div>';
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

static $contentDisplayed = "clientes";

if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['c-firstName'])&&isset($_POST['c-lastName'])) 
    {
      $firstName = test_input($_POST['c-firstName']);
      $lastName = test_input($_POST['c-lastName']);
      $clientRows = getCustomersByName($lastName, $firstName);
    }
    elseif (isset($_POST['o-firstName'])&&isset($_POST['o-lastName'])&&isset($_POST['o-date'])&&(!(empty($_POST['o-date'])))) {
      $firstName = test_input($_POST['o-firstName']);
      $lastName = test_input($_POST['o-lastName']);
      $orderDate = test_input($_POST['o-date']);
      $orderRows = getOrdersByNameDate($firstName, $lastName, $orderDate);
    }
    elseif (isset($_POST['p-type'])&&isset($_POST['p-itemName'])&&isset($_POST['p-available'])) {
      $type = test_input($_POST['p-type']);
      $itemName = test_input($_POST['p-itemName']);
      $check = test_input($_POST['p-available']);
      if($check == "available"){
        $check = true;
      }
      else
      {
        $check = false;
      }
      $productRows = getMenuitemsByTypeNameAvailable($type, $itemName, $check);
    }
  }    

?>
 
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
      <li><a href="#" onclick="displayContent('productos');">Productos</a></li>
      <li><a href="#" onclick="displayContent('ordenes');">Ordenes</a></li>
    </ul>
  </div>
</nav>

<div id="clientes" class="container-fluid">
  <form method="post" class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="c-firstName" name="c-firstName">
  </div>
  <div class="input-group">
    <span class="input-group-addon">Apellido</span>
    <input type="text" class="form-control" id="c-lastName" name="c-lastName">
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="clientes-container">
</div>
<?php 
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && (count($clientRows) <= 0))
      {
        echo "<div class='NoMatch'><span>No se encontraron clientes que coincidan con la busqueda...</span></div>";
      }
      else {
        printClients($clientRows);
        $contentDisplayed = "clientes";
      }
?>
</div>

<div id="ordenes" class="container-fluid">
    <form method="post" class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="o-firstName" name="o-firstName">
  </div>
  <div class="input-group">
    <span class="input-group-addon">Apellido</span>
    <input type="text" class="form-control" id="o-lastName" name="o-lastName">
  </div>
    <div class="input-group">
    <span class="input-group-addon">Fecha</span>
    <input type="date" class="form-control" id="o-date" name="o-date">
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="ordenes-container">
<?php 
    if(count($orderRows) <= 0)
      {
        echo "<div class='NoMatch'><span>No se encontraron ordenes que coincidan con la busqueda...</span></div>";
      }
      else {
        printOrders($orderRows);
        $contentDisplayed = "ordenes";
      }
?>
</div>
</div>

<div id="productos" class="container-fluid">
  <form method="post" class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="input-group">
  <span class="input-group-addon">Tipo</span>
  <select class="form-control" id="p-type" name="p-type">
    <option>- Seleccionar -</option>
    <option>Entrada</option>
    <option>Plato principal</option>
    <option>Bebida</option>
    <option>Postre</option>
  </select>
  </div>
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="p-itemName" name="p-itemName">
  </div>
  <div class="input-group">
    <label class="checkbox-inline"><input type="checkbox" value="available" id="p-available" name="p-available">Disponible</label>
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="productos-container">
<?php 
    if(count($productRows) <= 0)
      {
        echo "<div class='NoMatch'><span>No se encontraron productos que coincidan con la busqueda...</span></div>";
      }
      else {
        printProducts($productRows);
        $contentDisplayed = "productos";
      }
?>
</div>
</div>

<br>
<footer class="container-fluid text-center">
  <p>Based on example in W3School</p>
</footer>
<script type="text/javascript">displayContent(<?php echo "'".$contentDisplayed."'"; ?>);</script>
    </div>
</body>
</html>
