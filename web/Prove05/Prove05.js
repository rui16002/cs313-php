/*Load content on the screen depending on the tab selected*/
var currentlyDisplayed;
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

function currentlyDisplayed() {
return currentContentBeingDisplayed;
}

function getDisplayed() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(currentlyDisplayed != this.responseText)
                {
                	currentlyDisplayed = "clientes";
                }
            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + whichone, true);
        xmlhttp.send();
    }
}
