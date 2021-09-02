var btn = document.getElementById("btn");
var menu = document.getElementById("menu");
var toggle = false;

btn.addEventListener("click", function(){
	if (toggle === false) {
		menu.style.width = "0";
		toggle = true;
	}else{
		menu.style.width = "20%";
		toggle = false;	
	}
	
});
