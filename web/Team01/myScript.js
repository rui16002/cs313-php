
function displayAlert() {
    alert("Clicked!");
}

function changeColor() {
	var textbox = document.getElementById("colorInput");
	var div1 = document.getElementById("div01");
	var color = textbox.value;

	var isOk  = /^#[0-9A-F]{6}$/i.test(color);

	if (isOk) {
	div1.style.backgroundColor = color;
}
else
{
	alert("Are you sure that's a color?");
}

}

$(document).ready(function(){
    $("#hideButton").click(function(){
        $("#div03").fadeToggle();
    });
});