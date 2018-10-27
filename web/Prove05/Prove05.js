function displayContent(whichone) {
	document.getElementById("clientes").setAttribute("style", "display: none");
	document.getElementById("ordenes").setAttribute("style", "display: none");
	document.getElementById("productos").setAttribute("style", "display: none");
	currentTab(whichone);
	document.getElementById(whichone).setAttribute("style", "display: block"); 
}

function currentTab(tab) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			return this.responseText;
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
