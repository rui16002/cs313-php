/*Load content on the screen depending on the tab selected*/
function displayContent(whichone) {
  document.getElementById("pizzas").setAttribute("style", "display: none");
  document.getElementById("entrantes").setAttribute("style", "display: none");
  document.getElementById("bebidas").setAttribute("style", "display: none");
  document.getElementById("postres").setAttribute("style", "display: none");
  document.getElementById("extras").setAttribute("style", "display: none");
  document.getElementById("cart").setAttribute("style", "display: none");
  if (whichone==="pizzas")
    document.getElementById("pizzas").setAttribute("style", "display: block");
  if (whichone==="entrantes")
    document.getElementById("entrantes").setAttribute("style", "display: block");
  if (whichone==="bebidas")
    document.getElementById("bebidas").setAttribute("style", "display: block");
  if (whichone==="postres")
    document.getElementById("postres").setAttribute("style", "display: block");
  if (whichone==="extras")
    document.getElementById("extras").setAttribute("style", "display: block");
  if (whichone==="cart")
    document.getElementById("cart").setAttribute("style", "display: block");
}

function savePurchasedItemInSession(item) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itemCount").innerHTML = JSON.parse(this.responseText);
    }
  };
  xhttp.open("POST", "session.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("purchasedItem=" +JSON.stringify(arr));
}

function removePurchasedItemFromSession(item) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("itemCount").innerHTML = JSON.parse(this.responseText);
    }
  };
  xhttp.open("POST", "session.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("removedItem=" +JSON.stringify(arr));
}

function removeItem(id, itemName, itemDescription, itemImg, itemPrice)
{
  var item = {name: itemName, description: itemDescription, img:itemImg, price:itemPrice};
  container = document.getElementById("shopping_cart");
  child = document.getElementById(id);
  container.removeChild(child);
  removePurchasedItemFromSession(item);
}

function shopItem(itemName, itemDescription, itemImg, itemPrice)
{
 //Add it to the list
 var item = {name: itemName, description: itemDescription, img:itemImg, price:itemPrice};
 savePurchasedItemInSession(item);
 //Create a card in the Shopping cart
 var container = document.getElementById("shopping_cart");
 var description = document.createTextNode(itemDescription);
 var price = document.createTextNode(itemPrice + " €");
 var name = document.createTextNode(itemName);
 var id = "purchase" + new Date().getTime();

var col = document.createElement("div");
col.setAttribute("class","col-sm-4");
col.setAttribute("id",id);
var panel = document.createElement("div");
panel.setAttribute("class","panel panel-default");
var heading = document.createElement("div");
heading.setAttribute("class","panel-heading text-center");
heading.appendChild(name);
var body = document.createElement("div");
body.setAttribute("class","panel-body");
var img = document.createElement("img");
img.setAttribute("class", "img-responsive");
img.setAttribute("alt", "Image");
img.setAttribute("src", itemImg);
var footer = document.createElement("div");
footer.setAttribute("class", "panel-footer");
var frow = document.createElement("div");
frow.setAttribute("class", "row");
var desc = document.createElement("div");
desc.setAttribute("class", "col-sm-12 description");
desc.appendChild(description);
var oldp = document.createElement("div");
oldp.setAttribute("class", "col-sm-6 oldprice");
var newp = document.createElement("div");
newp.setAttribute("class", "col-sm-6 newprice");
newp.appendChild(price);

col.appendChild(panel);
panel.appendChild(heading);
panel.appendChild(body);
body.appendChild(img);
panel.appendChild(footer);
footer.appendChild(frow);
frow.appendChild(desc);
frow.appendChild(oldp);
frow.appendChild(newp);
container.appendChild(col);
col.setAttribute("onclick", "removeItem('"+id+"', '"+itemName+"', '"+itemDescription+"', '"+itemImg+"', '"+itemPrice+"');");
}
