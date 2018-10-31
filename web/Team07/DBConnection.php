 <?php //DB connection
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

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function insertUser($username, $password){
  global $db;
  try
  {
    $query = 'INSERT INTO Users (UserName, UserPassword) VALUES (:username, :password);';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
// get the new id
    $User = $db->lastInsertId("users_userid_seq");
    return $User;
  }
  catch (Exception $ex)
  {
    echo $ex;
    die();
  }
}

function getHash($username){
  global $db;
  try
  {
    $query = 'SELECT UserPassword FROM Users WHERE UserName=:username';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
  $row = $stmt->fetch();
  return $row['userpassword'];
  }
  catch (Exception $ex)
  {
    echo $ex;
    die();
  }
}

?>