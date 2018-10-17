
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
function printClient($firstName, $lastName, $email, $phone){
  echo'<div class="media">';
  echo'<div class="media-left">';
  echo'<img src="img_avatar1.png" class="media-object" style="width:70px">';
  echo'</div>';
  echo'<div class="media-body">';
  echo'<h4 class="media-heading">'.$firstName.' '.$lastName.'</h4>';
  echo'<p>';
  echo'<strong>Email:</strong>'.$email.'<br>';
  echo'<strong>Teléfono:</strong>'.$phone;
  echo'</p>';
  echo'</div>';
  echo'</div>';
}

function printOrder($LastName, $FirstName, $OrderDate, $ProdName, $ProdDescription, $ProdPrice, $ProdAvailable){
  echo '<div class="panel-group">';
  echo '<div class="panel panel-default">';
  echo '<div class="panel-heading">'.$OrderDate;
  if ($available) {
    echo '<span class="text-right glyphicon glyphicon-ok-sign">';
  }
  else {
   echo '<span class="text-right glyphicon glyphicon-remove-sign">'; 
  }
  echo '</div>';
  echo '<div class="panel-body"><strong>'.$ProdName'</strong><br>'.$ProdDescription.'<br>'.$ProdPrice.'</div>';
  echo '<div class="panel-footer">'.$firstName.' '.$lastName.'</div>';
  echo '</div>';
  echo '</div>';
}

function printProduct($type, $name, $description, $price, $available){
  echo '<div class="panel-group">';
  echo '<div class="panel panel-default">';
  echo '<div class="panel-heading">'.$type;
  if ($available) {
    echo '<span class="text-right glyphicon glyphicon-ok-sign">';
  }
  else {
    echo '<span class="text-right glyphicon glyphicon-remove-sign">'; 
  }
  echo '</div>';
  echo '<div class="panel-body">'.$name.'<br>'.$description.'</div>';
  echo '<div class="panel-footer">'.$price.'</div>';
  echo '</div>';
  echo '</div>';
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['c-firstName'])&&isset($_POST['c-lastName'])) 
    {
      $firstName = test_input($_POST['c-firstName']);
      $lastName = test_input($_POST['c-lastName']);
      $rows = getCustomersByName($lastName, $firstName);
      if(count($rows) <= 0)
      {
        echo "No se encontraron clientes que coincidan con la busqueda...";
      }
      else {
        print_r($rows);
      }
    }
    elseif (isset($_POST['o-firstName'])&&isset($_POST['o-lastName'])&&isset($_POST['o-date'])) {
      $firstName = test_input($_POST['o-firstName']);
      $lastName = test_input($_POST['o-lastName']);
      $orderDate = test_input($_POST['o-date']);
      $rows = getOrdersByNameDate($firstName, $lastName, $orderDate);
      if(count($rows) <= 0)
      {
        echo "No se encontraron ordenes que coincidan con la busqueda...";
      }
      else {
        print_r($rows);
      }
    }
    elseif (isset($_POST['p-type'])&&isset($_POST['p-itemName'])&&isset($_POST['p-available'])) {
      $type = test_input($_POST['p-type']);
      $itemName = test_input($_POST['p-itemName']);
      $available = test_input($_POST['p-available']);
      $rows = getMenuitemsByTypeNameAvailable($type, $itemName, $available);
      if(count($rows) <= 0)
      {
        echo "No se encontraron productos que coincidan con la busqueda...";
      }
      else {
        print_r($rows);
      }
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
  <form class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="c-firstName">
  </div>
  <div class="input-group">
    <span class="input-group-addon">Apellido</span>
    <input type="text" class="form-control" id="c-lastName">
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="clientes-container">
</div>
<?php ?>
</div>

<div id="ordenes" class="container-fluid">
    <form class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="o-firstName">
  </div>
  <div class="input-group">
    <span class="input-group-addon">Apellido</span>
    <input type="text" class="form-control" id="o-lastName">
  </div>
    <div class="input-group">
    <span class="input-group-addon">Fecha</span>
    <input type="date" class="form-control" id="o-date">
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="ordenes-container">
  <?php ?>
</div>
</div>

<div id="productos" class="container-fluid">
  <form class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="input-group">
  <span class="input-group-addon">Tipo</span>
  <select class="form-control" id="p-type">
    <option>- Seleccionar -</option>
    <option>Entrantes</option>
    <option>Principales</option>
    <option>Bebidas</option>
    <option>Postres</option>
  </select>
  </div>
  <div class="input-group">
    <span class="input-group-addon">Nombre</span>
    <input type="text" class="form-control" id="p-itemName">
  </div>
  <div class="input-group">
    <label class="checkbox-inline"><input type="checkbox" value="" id="p-available">Disponible</label>
  </div>
  <button class="btn btn-default" type="submit">
    <i class="glyphicon glyphicon-search"></i>
  </button>
</form>
<div id="productos-container">
<?php ?>
</div>
</div>

<br>
<footer class="container-fluid text-center">
  <p>Based on example in W3School</p>
</footer>
<script type="text/javascript">displayContent("clientes");</script>
    </div>
</body>
</html>
