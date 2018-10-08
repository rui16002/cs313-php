  <!--?php
    // collect value of input field
    if (!(empty($_POST["purchasedItem"]))) {
        array_push($_SESSION["shopping_cart"], $_POST["purchasedItem"]); // Not working
    }

    if (!(empty($_POST["removedItem"]))) {
      $item2remove = array_search($_POST["removedItem"],$_SESSION["shopping_cart"], true);
      if (!($item2remove === false))
      {
        array_splice($_SESSION["shopping_cart"],$item2remove,1);
      }
    }
  ?-->

<!DOCTYPE html>
<html>
<body>

<div id="demo">

<h2>The XMLHttpRequest Object</h2>

<button type="button"
onclick="loadDoc('session.php', myFunction)">Change Content
</button>
</div>

<script>
function loadDoc(url, cFunction) {
  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}
function myFunction(xhttp) {
  document.getElementById("demo").innerHTML =
  xhttp.responseText;
}
</script>
</body>
</html>
