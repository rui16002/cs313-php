function displayContent(whichone) {
  document.getElementById("clientes").setAttribute("style", "display: none");
  document.getElementById("ordenes").setAttribute("style", "display: none");
  document.getElementById("productos").setAttribute("style", "display: none");
  if (whichone==="clientes")
    document.getElementById("clientes").setAttribute("style", "display: block");
  if (whichone==="ordenes")
    document.getElementById("ordenes").setAttribute("style", "display: block");
  if (whichone==="productos")
    document.getElementById("productos").setAttribute("style", "display: block");
}

function editClient($client)
{

}

function editProduct($product)
{

}

function editOrder($order)
{

}
