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
  
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if(isset($_POST['book'])) 
    {
      $bookName = test_input($_POST['book']);
      
      $stmt = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures WHERE book=:bookName');
      $stmt->bindValue(':bookName', $bookName, PDO::PARAM_STR);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      echo "<p><span style='font-size:2em; font-weight:bold;'>Scripture Resources</span></p>";
      
      if(count($rows) <= 0)
      {
        echo "No Books Found";
      }
      else {
        foreach ($rows as $row)
        {
          //echo "<p><span style='font-weight:bold'>" . $row['book'] . " " .  $row['chapter'] . ":". $row['verse'] ."</span></p>";
          
          echo "<a href='results.php?id=" . $row['id']. "' >" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . "</a>";
          
          
        }      
      }
    } else {
      
      echo "Something Else!";
    }
  }
  
  

  
  ?>
</head>
<body>
 
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="book">Book</label>
  <input type="text" id="book" name="book">
  <input type="submit" name="submit" value="Submit">
</form>
  
</body>
</html>