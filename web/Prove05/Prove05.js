/*Load content on the screen depending on the tab selected*/
function displayContent(whichone) {
  document.getElementById("clientes").setAttribute("style", "display: none");
  document.getElementById("ordenes").setAttribute("style", "display: none");
  document.getElementById("principales").setAttribute("style", "display: none");
  document.getElementById("entrantes").setAttribute("style", "display: none");
  document.getElementById("bebidas").setAttribute("style", "display: none");
  document.getElementById("postres").setAttribute("style", "display: none");
  document.getElementById("cart").setAttribute("style", "display: none");
  if (whichone==="clientes")
    document.getElementById("clientes").setAttribute("style", "display: block");
  if (whichone==="ordenes")
    document.getElementById("ordenes").setAttribute("style", "display: block");
  if (whichone==="principales")
    document.getElementById("principales").setAttribute("style", "display: block");
  if (whichone==="entrantes")
    document.getElementById("entrantes").setAttribute("style", "display: block");
  if (whichone==="bebidas")
    document.getElementById("bebidas").setAttribute("style", "display: block");
  if (whichone==="postres")
    document.getElementById("postres").setAttribute("style", "display: block");
  if (whichone==="cart")
    document.getElementById("cart").setAttribute("style", "display: block");
}
