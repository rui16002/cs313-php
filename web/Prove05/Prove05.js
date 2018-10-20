/*Load content on the screen depending on the tab selected*/
var currentContentBeingDisplayed = "clientes";
function displayContent(whichone) {
  document.getElementById("clientes").setAttribute("style", "display: none");
  document.getElementById("ordenes").setAttribute("style", "display: none");
  document.getElementById("productos").setAttribute("style", "display: none");
  currentContentBeingDisplayed = whichone;
  if (whichone==="clientes")
    document.getElementById("clientes").setAttribute("style", "display: block");
  if (whichone==="ordenes")
    document.getElementById("ordenes").setAttribute("style", "display: block");
  if (whichone==="productos")
    document.getElementById("productos").setAttribute("style", "display: block");
}

function currentlyDisplayed() {
return currentContentBeingDisplayed;
}
