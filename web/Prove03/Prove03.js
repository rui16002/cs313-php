var content_loaded = false;

/*Load content on the screen depending on the tab selected*/
function displayContent(whichone) {
  document.getElementById("promociones").setAttribute("style", "display: none");
  document.getElementById("entrantes").setAttribute("style", "display: none");
  document.getElementById("bebidas").setAttribute("style", "display: none");
  document.getElementById("postres").setAttribute("style", "display: none");
  document.getElementById("extras").setAttribute("style", "display: none");
  document.getElementById("cart").setAttribute("style", "display: none");
  if (whichone==="promociones")
    document.getElementById("promociones").setAttribute("style", "display: block");
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