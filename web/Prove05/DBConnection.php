<?php
try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo "Ups I couldn't connect to the server database";
  die();
}

function addNewCustomer($LastName, $FirstName, $Email, $Phone){
  global $db;
  try
  {
//Validate the inputs before inserting
    $query = 'INSERT INTO Customers (LastName, FirstName, Email, Phone) VALUES (:LastName, :FirstName, :Email, :Phone);';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':Email', $Email, PDO::PARAM_STR);
    $stmt->bindValue(':Phone', $Phone, PDO::PARAM_INT);
    $stmt->bindValue(':LastName', $LastName, PDO::PARAM_STR);
    $stmt->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
    $stmt->execute();
// get the new id
    $customerId = $db->lastInsertId("customers_customerid_seq");
    return $customerId;
  }
  catch (Exception $ex)
  {
    echo "Ups, I couldn't add the Customer, I am sorry.";
    die();
  }
}

function updateCustomer($id, $NewLastName, $NewFirstName, $NewEmail, $NewPhone){
  global $db;
  try{
//Validate inputs before updating
    $query = 'UPDATE Customers SET LastName=:NewLastName, FirstName=:NewFirstName, Email=:NewEmail, Phone=:NewPhone WHERE CustomerID=:id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':NewLastName', $NewLastName, PDO::PARAM_STR);
    $stmt->bindValue(':NewFirstName', $NewFirstName, PDO::PARAM_STR);
    $stmt->bindValue(':NewEmail', $NewEmail, PDO::PARAM_STR);
    $stmt->bindValue(':NewPhone', $NewPhone, PDO::PARAM_INT);
    $stmt->execute();
  }
  catch (Exception $ex)
  {
    echo "Ups, I couldn't update the Customer info, I am sorry.";
    echo $ex;
    die();
  }
}

function getCustomers(){
  global $db;
  $query = 'SELECT CustomerID, LastName, FirstName, Email, Phone FROM Customers';
  $stmt = $db->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function getCustomersByName($LastName, $FirstName){
  global $db;
  $query = 'SELECT CustomerID, LastName, FirstName, Email, Phone FROM Customers WHERE LastName=:LastName AND FirstName=:FirstName';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':LastName', $LastName, PDO::PARAM_STR);
  $stmt->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function addNewMenuitem($Type, $Name, $Description, $Price, $Available){
  global $db;
  try{
//Validate inputs before inserting
    $query = 'INSERT INTO Menuitems (ItemTypeID, Name, Description, Price, Available) VALUES (:Type, :Name, :Description, :Price, :Available)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':Type', $Type, PDO::PARAM_INT);
    $stmt->bindValue(':Name', $Name, PDO::PARAM_STR);
    $stmt->bindValue(':Description', $Description, PDO::PARAM_STR);
    $stmt->bindValue(':Price', strval($Price), PDO::PARAM_STR);
    $stmt->bindValue(':Available', $Available, PDO::PARAM_BOOL);
    $stmt->execute();
// get the new id
    $menuItemId = $db->lastInsertId("menuitems_itemid_seq");
    return $menuItemId;
  }
  catch (Exception $ex)
  {
    echo "Ups, I couldn't add the new item to the menu, I am sorry.";
    die();
  }
}

function updateMenuitem($id, $NewType, $NewName, $NewDescription, $NewPrice, $NewAvailable){
  global $db;
  try{
    $query = 'UPDATE Menuitems SET ItemTypeID=:NewType, Name=:NewName, Description=:NewDescription, Price=:NewPrice, Available=:NewAvailable WHERE ItemID=:id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':NewType', $NewType, PDO::PARAM_INT);
    $stmt->bindValue(':NewName', $NewName, PDO::PARAM_STR);
    $stmt->bindValue(':NewDescription', $NewDescription, PDO::PARAM_STR);
    $stmt->bindValue(':NewPrice', strval($NewPrice), PDO::PARAM_STR);
    $stmt->bindValue(':NewAvailable', $NewAvailable, PDO::PARAM_BOOL);
    $stmt->execute();
  }
  catch (Exception $ex)
  {
    echo "Ups, I couldn't add the new item to the menu, I am sorry.";
    echo $ex;
    die();
  }
}

function getMenuitems(){
  global $db;
  $query = '
  SELECT IT.Type, Name, Description, Price, Available FROM Menuitems MI 
  INNER JOIN ItemTypes IT ON MI.ItemTypeID = IT.ItemTypeID';
  $stmt = $db->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function getMenuitemsByTypeNameAvailable($type, $name, $available){
  global $db;
  $query = '
  SELECT IT.Type, Name, Description, Price, Available FROM Menuitems MI 
  INNER JOIN ItemTypes IT ON MI.ItemTypeID = IT.ItemTypeID 
  WHERE IT.Type=:Type AND Name=:Name AND Available=:Available';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':Type', $type, PDO::PARAM_STR);
  $stmt->bindValue(':Name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':Available', $available, PDO::PARAM_BOOL);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function getOrders(){
  global $db;
  $query = '
  SELECT old.LastName, old.FirstName, old.OrderDate, mi.Name, mi.Description, mi.Price, mi.Available FROM
  (SELECT cd.LastName, cd.FirstName, cd.Email, cd.Phone, cd.OrderDate, cd.OrderID, ol.ItemID FROM
  (SELECT c.LastName, c.FirstName, c.Email, c.Phone, o.OrderDate, o.OrderID FROM Orders o
  INNER JOIN Customers c 
  ON o.CustomerID = c.CustomerID) cd
  INNER JOIN Orderlist ol ON cd.OrderID = ol.OrderID) old 
  INNER JOIN Menuitems mi ON old.ItemID = mi.ItemID';
  $stmt = $db->prepare($query);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

function getOrdersByNameDate($FirstName, $LastName, $OrderDate){
  global $db;
  $query = '
  SELECT old.LastName, old.FirstName, old.OrderDate, mi.Name, mi.Description, mi.Price, mi.Available FROM
  (SELECT cd.LastName, cd.FirstName, cd.Email, cd.Phone, cd.OrderDate, cd.OrderID, ol.ItemID FROM
  (SELECT c.LastName, c.FirstName, c.Email, c.Phone, o.OrderDate, o.OrderID FROM Orders o
  INNER JOIN Customers c 
  ON o.CustomerID = c.CustomerID) cd
  INNER JOIN Orderlist ol ON cd.OrderID = ol.OrderID) old 
  INNER JOIN Menuitems mi ON old.ItemID = mi.ItemID
  WHERE old.LastName=:LastName AND old.FirstName=:FirstName AND old.OrderDate=:OrderDate';
  $stmt = $db->prepare($query);
  $stmt->bindValue(':LastName', $LastName, PDO::PARAM_STR);
  $stmt->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
  $stmt->bindValue(':OrderDate', $OrderDate, PDO::PARAM_STR);
  $stmt->execute();

  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}

?>