<!DOCTYPE html>
<html lang="en">
<head>
  <title>Team 05</title>  
  
  <?php
  
  	function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
  
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
  
  if($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    if(isset($_GET['id'])) 
    {
      $id = test_input($_GET['id']);
      
      $stmt = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures WHERE id=:id');
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      
      
      echo "<p><span style='font-size:2em; font-weight:bold;'>Scripture Details</span></p>";
      
    	echo "<p><span style='font-weight:bold'>" . $row['book'] . " " .  $row['chapter'] . ":". $row['verse'] ."</span><br> " . $row['content'] . "</p>";
      
    }
  }
  
  ?>
  </head>
<body>

  
</body>
</html>