"use strict";

document.querySelector(".left-panel").addEventListener("click",  showInfo);
document.querySelector("#btn-filamentos").addEventListener("click", toggleMenu);

function toggleMenu() {
    document.querySelector(".left-panel").classList.toggle("hidden");
}

function showInfo(event){
	if (event.target.tagName === 'LI'){
		/* hidden a todos los elemetos */
		let list = document.querySelectorAll(".right-content");
		for (let index = 0; index < list.length; index++) {
			list[index].classList.add("hidden");
		}
		/* Mostramos el elemento seleccionado */
		let material = document.querySelector(`#${event.target.innerHTML.toLowerCase()}`);
		material.classList.remove("hidden");
	}
}