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

echo "you have a db connection to: ". $dbUrl;

$stmt = $db->prepare('SELECT * FROM Customers WHERE LastName=:LastName AND FirstName=:FirstName');
$stmt->bindValue(':LastName', $LastName, PDO::PARAM_STR);
$stmt->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo $rows;

// function getCustomer($LastName, $FirstName){
// $stmt = $db->prepare('SELECT * FROM Customers WHERE LastName=:LastName AND FirstName=:FirstName');
// $stmt->execute(array(':LastName' => $LastName, ':FirstName' => $FirstName));
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// return $rows;
// }

// function getMenuItems($type){
// $stmt = $db->prepare('SELECT * FROM Menuitems WHERE Type=:type');
// $stmt->execute(array(':Type' => $type));
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// return $rows;
// }

?>
</body>
</html>