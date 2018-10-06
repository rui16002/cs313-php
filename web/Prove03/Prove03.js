var content_loaded = false;
var shopping_cart = [];

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



function removeItem(id, item)
{
  shopping_cart.splice( shopping_cart.indexOf(item), 1 );
  container = document.getElementById("shopping_cart");
  child = document.getElementById(id);
  container.removeChild(child);
}

function shopItem(item)
{
 //Add it to the list
 shopping_cart.push(item);
 //Create a card in the Shopping cart
 container = document.getElementById("shopping_cart");
 description = document.createTextNode(item.description);
 price = document.createTextNode(item.price);
 name = document.createTextNode(item.name);
 id = item.name + shopping_cart.length;

col = document.createElement("div");
col.setAttribute("class","col-sm-4");
col.setAttribute("id",id);
col.onclick = removeItem(id, item);
panel = document.createElement("div");
panel.setAttribute("class","panel panel-default");
heading = document.createElement("div");
heading.setAttribute("class","panel-heading text-center");
heading.appendChild(name);
body = document.createElement("div");
body.setAttribute("class","panel-body");
img = document.createElement("img");
img.setAttribute("class", "img-responsive");
img.setAttribute("alt", "Image");
img.setAttribute("src", item.img);
footer = document.createElement("div");
footer.setAttribute("class", "panel-footer");
frow = document.createElement("div");
frow.setAttribute("class", "row");
desc = document.createElement("div");
desc.setAttribute("class", "col-sm-12 description");
desc.appendChild(description);
oldp = document.createElement("div");
oldp.setAttribute("class", "col-sm-6 oldprice");
newp = document.createElement("div");
newp.setAttribute("class", "col-sm-6 newprice");
newp.appendChild(price);

col.appendChild(panel);
panel.appendChild(heading);
panel.appendChild(body);
panel.appendChild(footer);
footer.appendChild(frow);
frow.appendChild(desc);
frow.appendChild(oldp);
frow.appendChild(newp);
container.appendChild(col);
}
