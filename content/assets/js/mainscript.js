var btn = document.getElementById("btn");
var menu = document.getElementById("menu");
var content = document.getElementById("content");
var logo = document.getElementById("logo");
var slidemenu = "close";

var mobilemode = 800;


function SavedVariableLocal(name, value = ""){
	value = String(value);
	if (value !== "") {
		localStorage.setItem(name, value);
	}else{
		return localStorage.getItem(name);
	}
}

function logoanimation(value = ""){
	logo.style.transition = "transform 0.9s";
	if (value == "rotate") {
		logo.style.transform = "rotate(360deg)";
	}else if(value == "rotateback"){
		logo.style.transform = "rotate(0deg)";
	}else{
		logo.style.transform = "none";
		logo.style.transition = "none";
	}
}

function SavedVariableCookie(name = "", value = ""){
	//document.cookie = "username=John Doe; expires=Thu, 18 Dec 2013 12:00:00 UTC";
	if (value !== null) {
		document.cookie = "";
	}else{
		return document.cookie;
	}
}
//disable for mobile mode
if (screen.width >= mobilemode) {
	slidemenu = sessionStorage.getItem("slidemenu");
	if (slidemenu == "close") {
		menu.className = "header close";
		menu.style.transition = "none";
	}else{
		menu.className = "header open";
		menu.style.transition = "none";
	}

}else{
	menu.className = "header close";
}
btn.addEventListener("click", function(){
	menu.style = "";
	if (slidemenu !== "close") {
		//close
		menu.className = "header close";
		slidemenu = "close";
		logoanimation("rotateback");
		sessionStorage.setItem("slidemenu", "close");
		if (screen.width <= mobilemode) {
			content.style = "";
			content.style.width = "100%";
			logoanimation();
		}
	}else{
		//open
		menu.className = "header open";
		slidemenu = "open";
		logoanimation("rotate");
		sessionStorage.setItem("slidemenu", "open");
		if (screen.width <= mobilemode) {
			content.style.width = "0";
			logoanimation();
		}
	}
});