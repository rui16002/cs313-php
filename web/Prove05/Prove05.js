var currentTab;
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
setCurrentTab(whichone);
}

function setCurrentTab(tab) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            currentTab = this.responseText;
        }
    };
    xmlhttp.open("GET", "session.php?tab=" + tab, true);
    xmlhttp.send();
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
