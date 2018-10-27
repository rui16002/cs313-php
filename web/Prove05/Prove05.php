
<?php
session_start();
?>
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

  if (!(isset($_SESSION['lastContent']))) {
    $_SESSION['lastContent'] = 'clientes';
  }

  function printClients($rows){
    foreach ($rows as $row)
    {
      $id = $row['customerid'];
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
      $email = $row['email'];
      $phone = $row['phone'];
      $editClientCall = "editClient('".$id."','".$firstname."','".$lastname."','".$email."','".$phone."');";
      echo'<div class="media">';
      echo'<div class="media-left">';
      echo'<img src="img_avatar1.png" class="media-object" style="width:70px">';
      echo'</div>';
      echo'<div class="media-body">';
      echo'<h4 class="media-heading">'.$firstname.' '.$lastname.'</h4>';
      echo'<p>';
      echo'<strong>Email:</strong>'.$email.'<br>';
      echo'<strong>Teléfono:</strong>'.$phone;
      echo'</p>';
      echo'</div>';
      echo'<div class="media-right">';
      echo'<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#EditClient" onclick="'.$editClientCall.'">';
      echo'<span class="glyphicon glyphicon-edit"></span>';
      echo'</button>';
      echo'</div>';
      echo'</div>';
    }
  }

  function printProducts($rows){
    foreach ($rows as $row)
    {
      $id = $row['id'];
      $type = $row['type'];
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
      $available = $row['available'];
      $editProductCall = "editProduct('".$id."','".$type."','".$name."','".$description."','".$price."','".$available."');";
      echo '<div class="panel-group">';
      echo '<div class="panel panel-default">';
      echo '<div class="panel-heading text-center"><div>';
      if ($available) {
        echo '<span class="glyphicon glyphicon-ok-sign rightaligned">';
      }
      else {
       echo '<span class="glyphicon glyphicon-remove-sign rightaligned">'; 
     }
     echo '</div><strong>'.$type.'</strong></div>';
     echo '<div class="panel-body row">';
     echo '<div class="col-sm-6">';
     echo '<strong>'.$name.'</strong><br>';
     echo '<em>'.$description.'</em>';
     echo '</div>';
     echo '<div class="col-sm-6 text-right">';
     echo '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#EditProduct" onclick="'.$editProductCall.'">';
     echo '<span class="glyphicon glyphicon-edit"></span>';
     echo '</button>';
     echo '</div>';
     echo '</div>';
     echo '<div class="panel-footer text-right"><span class="badge">'.$price.' €</span></div>';
     echo '</div>';
     echo '</div>';
   }
 }

 function printOrders($rows){
  if (!(empty($rows))) {
    $orderdate = $rows[0]['orderdate'];    
    $firstname = $rows[0]['firstname'];
    $lastname = $rows[0]['lastname'];
    echo '<div class="panel-group">';
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading text-center"><div>';
    echo '</div><div> '.$orderdate.'</div></div>';
    echo '<div class="panel-body row">';
    foreach ($rows as $row){
      $name = $row['name'];
      $description = $row['description'];
      $price = $row['price'];
      $available = $row['available'];
      echo '<div class="col-sm-6">';
      echo '<strong>'.$name.'</strong><br>';
      echo '<em>'.$description.'</em><br>';
      echo '</div>';
      echo '<div class="col-sm-4">';
      echo '<p class="bg-info text-center">'.$price.' €</p></div>';
      echo '</div>';
      echo '<div class="col-sm-2">';
      if ($available) {
        echo '<span class="glyphicon glyphicon-ok-sign rightaligned">';
      }
      else {
       echo '<span class="glyphicon glyphicon-remove-sign rightaligned">'; 
     }
     echo '</div>';
   }
   echo '<div class="panel-footer text-center">'.$firstname.' '.$lastname.'</div>';
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

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  //Search Functionality
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
/*  else
  {
    $clientRows = getCustomers();
    $orderRows = getOrders();
    $productRows = getMenuitems();
  }*/

  //Edit and add functionality
  if(isset($_POST['editClient_id'])&&isset($_POST['editClient_firstName'])&&isset($_POST['editClient_lastName'])&&isset($_POST['editClient_email'])&&isset($_POST['editClient_phone'])) 
  {
    $id = intval(test_input($_POST['editClient_id']));
    $firstName = test_input($_POST['editClient_firstName']);
    $lastName = test_input($_POST['editClient_lastName']);
    $email = test_input($_POST['editClient_email']);
    $phone = intval(test_input($_POST['editClient_phone']));
    updateCustomer($id, $lastName, $firstName, $email, $phone);
  }

  if(isset($_POST['addClient_firstName'])&&isset($_POST['addClient_lastName'])&&isset($_POST['addClient_email'])&&isset($_POST['addClient_phone'])) 
  {
    $firstName = test_input($_POST['addClient_firstName']);
    $lastName = test_input($_POST['addClient_lastName']);
    $email = test_input($_POST['addClient_email']);
    $phone = intval(test_input($_POST['addClient_phone']));
    addNewCustomer($lastName, $firstName, $email, $phone);
  }

  if(isset($_POST['editProduct_id'])&&isset($_POST['editProduct_Type'])&&isset($_POST['editProduct_Name'])&&isset($_POST['editProduct_Description'])&&isset($_POST['editProduct_Price'])&&isset($_POST['editProduct_Available']))
  {
    $id = intval(test_input($_POST['editProduct_id']));
    $type = intval(test_input($_POST['editProduct_Type']));
    $name = test_input($_POST['editProduct_Name']);
    $description = test_input($_POST['editProduct_Description']);
    $price = floatval(test_input($_POST['editProduct_Price']));
    $available = (test_input($_POST['editProduct_Available'])=='Available');
    updateMenuitem($id, $type, $name, $description, $price, $available);
  }

  if(isset($_POST['addProduct_Type'])&&isset($_POST['addProduct_Name'])&&isset($_POST['addProduct_Description'])&&isset($_POST['addProduct_Price'])&&isset($_POST['addProduct_Available'])) 
  {
    $id = intval(test_input($_POST['addProduct_id']));
    $type = intval(test_input($_POST['addProduct_Type']));
    $name = test_input($_POST['addProduct_Name']);
    $description = test_input($_POST['addProduct_Description']);
    $price = floatval(test_input($_POST['addProduct_Price']));
    $available = (test_input($_POST['addProduct_Available'])=='available');
    addNewMenuItem($id, $type, $name, $description, $price, $available);
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
  <div class="row">
    <div class="col-sm-10">
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
        <br>
        <span class="bg-warning">Debe rellenar todos los campos</span>
      </form>
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#AddClient">
        <span class="glyphicon glyphicon-plus"></span>
      </button>
    </div>
  </div>
</div>
<div id="clientes-container">
</div>
<?php 
if(($_SERVER['REQUEST_METHOD'] == 'POST') && (count($clientRows) <= 0) && $_SESSION['lastContent'] == 'clientes')
{
  echo "<div class='NoMatch'><span>No se encontraron clientes que coincidan con la busqueda...</span></div>";
}
else {
  printClients($clientRows);
}
?>
<!-- EDIT CLIENT MODAL -->
<div id="EditClient" class="modal fade" role="dialog" style="display: none;">
  <form method="post" class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER['php_self']);?>">
    <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Editar Cliente</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editClient_id" name="editClient_id" value="">
        <div class="input-group">
          <span class="input-group-addon">Nombre</span>
          <input type="text" class="form-control" id="editClient_firstName" name="editClient_firstName" value="" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon">Apellido</span>
          <input type="text" class="form-control" id="editClient_lastName" name="editClient_lastName" value="" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon">Email</span>
          <input type="email" class="form-control" id="editClient_email" name="editClient_email" value="">
        </div>
        <div class="input-group">
          <span class="input-group-addon">Teléfono</span>
          <input type="tel" class="form-control" id="editClient_phone" name="editClient_phone" value="">
        </div>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-default">Modificar</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
     </div>
   </div>
 </div>
</form>
</div>

<!-- ADD CLIENT MODAL -->
<div id="AddClient" class="modal fade" role="dialog" style="display: none;">
  <form method="post" class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER['php_self']);?>">
    <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-addon">Nombre</span>
          <input type="text" class="form-control" id="addClient_firstName" name="addClient_firstName" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon">Apellido</span>
          <input type="text" class="form-control" id="addClient_lastName" name="addClient_lastName" required>
        </div>
        <div class="input-group">
          <span class="input-group-addon">Email</span>
          <input type="email" class="form-control" id="addClient_email" name="addClient_email">
        </div>
        <div class="input-group">
          <span class="input-group-addon">Teléfono</span>
          <input type="tel" class="form-control" id="addClient_phone" name="addClient_phone">
        </div>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-default">Agregar</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
     </div>
   </div>
 </div>
</form>
</div>
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
    <br>
    <span class="bg-warning">Debe rellenar todos los campos</span>
  </form>
  <div id="ordenes-container">
    <?php 
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (count($orderRows) <= 0))
    {
      echo "<div class='NoMatch'><span>No se encontraron ordenes que coincidan con la busqueda...</span></div>";
    }
    else {
      printOrders($orderRows);
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
    <br>
    <span class="bg-warning">Debe rellenar todos los campos</span>
  </form>
  <div id="productos-container">
    <?php 
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && (count($productRows) <= 0) && $_SESSION['lastContent'] == 'productos')
    {
      echo "<div class='NoMatch'><span>No se encontraron productos que coincidan con la busqueda...</span></div>";
    }
    else {
      printProducts($productRows);
    }
    ?>

    <div id="EditProduct" class="modal fade" role="dialog" style="display: none;">
      <form method="post" class="form-inline text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Editar Producto</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" id="editProduct_id" name="editProduct_id" value="">
           <div class="input-group">
             <span class="input-group-addon">Tipo</span>
             <select class="form-control" id="editProduct_Type" name="editProduct_Type" value="" required>
               <option>- Seleccionar -</option>
               <option>Entrada</option>
               <option>Plato principal</option>
               <option>Bebida</option>
               <option>Postre</option>
             </select>
           </div>
           <div class="input-group">
             <span class="input-group-addon">Nombre</span>
             <input type="text" class="form-control" id="editProduct_Name" name="editProduct_Name" value="" required>
           </div>
           <div class="input-group">
             <span class="input-group-addon">Descripción</span>
             <input type="text" class="form-control" id="editProduct_Description" name="editProduct_Description" value="">
           </div>
           <div class="input-group">
             <span class="input-group-addon">Precio</span>
             <input type="number" class="form-control" id="editProduct_Price" name="editProduct_Price" value="" required>
           </div>
           <div class="input-group">
             <label class="checkbox-inline"><input type="checkbox" value="" id="editProduct_Available" name="editProduct_Available" required>Disponible</label>
           </div>
           <br>
           <span class="bg-warning">Debe rellenar todos los campos</span>

         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-default">Modificar</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
         </div>
       </div>
     </div>
   </form>
 </div>

</div>
</div>

<br>
<footer class="container-fluid text-center">
  <p>Based on example in W3School</p>
</footer>
<script type="text/javascript">displayContent(<?php echo "'".$_SESSION['lastContent']."'"; ?>);</script>
</div>
</body>
</html>
