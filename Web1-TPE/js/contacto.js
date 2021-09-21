"use strict";
// changeCaptcha();
let formContact= document.querySelector('form');
document.addEventListener("DOMContentLoaded", changeCaptcha)
document.querySelector("#refresh").addEventListener("click", changeCaptcha);

function changeCaptcha(){
	let randomVal = Math.floor(Math.random() * 5 + 1);
	document.querySelector("#captcha-img").src = `img/Captcha${randomVal}.jpg`;
}

document.querySelector("form").addEventListener("submit", validateForm);

function validateForm(event) {
	event.preventDefault();
	let formData = new FormData(formContact);
	let captchaValue = formData.get("captcha")
	let img = document.querySelector("#captcha-img");
	let imgSrc = img.getAttribute("src");
	
	let validationResult;
	if (validateCaptcha(imgSrc, captchaValue)){
		validationResult = "Su consulta ha sido enviada correctamente";
	}
	else{
		validationResult = "El captcha ingresado es incorrecto";
	}
	document.querySelector("#captcha-validation").innerHTML = validationResult;
}

function validateCaptcha(imageSrc, value){
	switch (imageSrc) {
		case "img/Captcha1.jpg":
			if (value.toUpperCase() == "W93BX"){
				return true;
			}
			break;
		case "img/Captcha2.jpg":
			if (value.toUpperCase() == "RBSKW"){
				return true;
			}
			break;
		case "img/Captcha3.jpg":
			if (value.toUpperCase() == "R84CH"){
				return true;
			}
			break;
		case "img/Captcha4.jpg":
			if (value.toUpperCase() == "HAPK3"){
				return true;
			}
			break;
		case "img/Captcha5.jpg":
			if (value.toUpperCase() == "HAT8M"){
				return true;
			}
			break;
	}
	return false;
}