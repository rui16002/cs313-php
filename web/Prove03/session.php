<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Session</title>
</head>
<body>
  <!--?php
    // collect value of input field
    if (!(empty($_REQUEST["purchasedItem"]))) {
      $purchasedItem = $_REQUEST["purchasedItem"];
      array_push($_SESSION["shopping_cart"], $purchasedItem);      
    }

    if (!(empty($_REQUEST["removedItem"]))) {
      $removedItem = $_REQUEST["removedItem"];
      $item2remove = array_search($removedItem,$_SESSION["shopping_cart"], true);
      if (!($item2remove === false))
      {
        array_splice($_SESSION["shopping_cart"],$item2remove,1);
      }
     echo json_encode($_SESSION["shopping_cart"]);
    }
  ?-->
  <?php
  echo $_SESSION["favcolor"];
  echo $_SESSION["favanimal"];
  // Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
?>
</body>
</html>