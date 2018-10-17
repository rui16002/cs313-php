<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prove 05</title>
</head>
<body>
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
  echo 'Error!: ' . $ex->getMessage();
  die();
}

function getCustomersByName($LastName, $FirstName){
global $db;
$query = 'SELECT * FROM Customers WHERE LastName=:LastName AND FirstName=:FirstName';
$stmt = $db->prepare($query);
$stmt->bindValue(':LastName', $LastName, PDO::PARAM_STR);
$stmt->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

function getOrdersByNameDate($FirstName, $LastName, $OrderDate){
global $db;
$query = '
SELECT old.LastName, old.FirstName, old.OrderDate, mi.Name, mi.Description, mi.Price, mi.Available FROM
(SELECT * FROM
(SELECT * FROM Orderlists ol 
  INNER JOIN Customers c 
  ON ol.CustomerID = c.CustomerID) cd 
  INNER JOIN Orders o ON cd.OrderID = o.OrderID) old 
  INNER JOIN Menuitems mi ON old.MenuitemID = mi.MenuitemID 
  WHERE old.LastName=:LastName AND old.FirstName=:FirstName AND old.OrderDate=:OrderDate';
$stmt = $db->prepare($query);
$stmt->bindValue(':LastName', $LastName, PDO::PARAM_STR);
$stmt->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
$stmt->bindValue(':OrderDate', $OrderDate, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

function getMenuitemsByTypeNameAvailable($type, $name, $available){
global $db;
$query = 'SELECT MIT.Type, Name, Description, Price, Available FROM Menuitems MI INNER JOIN MenuitemTypes MIT ON MI.Type = MIT.MenuitemTypeID WHERE MIT.Type=:MenuitemType AND Name=:Name AND Available=:Available';
$stmt = $db->prepare($query);
$stmt->bindValue(':MenuitemType', $type, PDO::PARAM_STR);
$stmt->bindValue(':Name', $name, PDO::PARAM_STR);
$stmt->bindValue(':Available', $available, PDO::PARAM_BOOL);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
return $rows;
}

echo "Testing functions<br>";
echo "<br>";
print_r(getCustomersByName('Rubolino','Barbara'));
echo "<br>";
print_r(getOrdersByNameDate('Rubolino','Barbara','15-10-2018'));
echo "<br>";
print_r(getMenuitemsByTypeNameAvailable('Entrada','Nachos', true));


?>
</body>
</html>