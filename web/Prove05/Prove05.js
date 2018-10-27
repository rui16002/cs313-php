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

function editClient(firstName, lastName, email, phone)
{
	document.getElementById("editClient_firstName").setAttribute("value", firstName);
	document.getElementById("editClient_lastName").setAttribute("value", lastName);
	document.getElementById("editClient_email").setAttribute("value", email);
	document.getElementById("editClient_phone").setAttribute("value", phone);
}

function editProduct(type, name, description, price, available)
{
	document.getElementById("editProduct_Type").setAttribute("value", type);
	document.getElementById("editProduct_Name").setAttribute("value", name);
	document.getElementById("editProduct_Description").setAttribute("value", description);
	document.getElementById("editProduct_Price").setAttribute("value", price);
	if (available)
		document.getElementById("editProduct_Available").checked = true;
	else
		document.getElementById("editProduct_Available").checked = false;
}

function editOrder(order)
{

}
