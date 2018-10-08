  <?php
    // collect value of input field
    if (!(empty($_REQUEST["purchasedItem"]))) {
      echo $_REQUEST["purchasedItem"];
        //array_push($_SESSION["shopping_cart"], $_POST["purchasedItem"]); // Not working
    }

    if (!(empty($_REQUEST["removedItem"]))) {
      //$item2remove = array_search($_POST["removedItem"],$_SESSION["shopping_cart"], true);
      //if (!($item2remove === false))
      //{
      //  array_splice($_SESSION["shopping_cart"],$item2remove,1);
     // }
     echo $_REQUEST["removedItem"];
    }
  ?>