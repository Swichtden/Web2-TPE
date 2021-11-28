"use strict"

document.addEventListener('DOMContentLoaded', getCommentsByPage);
document.querySelector("#pagSiguiente").addEventListener('click', getNextPage);
document.querySelector("#pagAnterior").addEventListener('click', getPrevPage);
let commentForm = document.querySelector('#commentForm')
if (commentForm) {
	commentForm.addEventListener('submit', addComment);
}

let page = 1;
let maxPage;
let cantComments;

function getNextPage() {
	if (page < maxPage) {
		page++;
		getCommentsByPage();
		updatePageCount();
	}
}

function getPrevPage() {
	if (page > 1) {
		page--;
		getCommentsByPage();
		updatePageCount();
	}
}

function getLastPage(){
	page = maxPage;
	getCommentsByPage();
	updatePageCount();
}

function getFirstPage(){
	page = 1;
	getCommentsByPage();
	updatePageCount();
}

function updatePageCount(){
	document.querySelector("#pageNumber").innerHTML = page;
}

async function getCommentsByPage() {
	try {
		let res = await fetch(`/api/Comentarios/${document.querySelector("#listaComentarios").dataset.id_presupuesto}/${page}`, {
			"method": "GET",
		});
		if (res.status == 200) {
			res.json().then(data => {
				cantComments = data['totalRows'];
				maxPage = data['cantPages'];
				let listaComentarios = document.querySelector("#listaComentarios");
				listaComentarios.innerHTML = "";
				if (data['comentarios'].length == 0) {
					document.querySelector("#pagButtons").hidden = true;
					listaComentarios.innerHTML = `<p>No hay comentarios</p>`;
				};
				for (let comentario of data['comentarios']) {
					document.querySelector("#pagButtons").hidden = false;
					let lista = document.createElement("ul");
					lista.classList.add("lista-comentarios");
					let puntaje = document.createElement("li");
					puntaje.innerHTML = `Puntaje: ${comentario.puntaje}`;
					let detalle = document.createElement("li");
					detalle.innerHTML = `Comentario: ${comentario.detalle}`;
					lista.appendChild(puntaje);
					lista.appendChild(detalle);
					if (document.querySelector("#listaComentarios").dataset.id_rol == 2) {
						let deleteButton = document.createElement("button");
						deleteButton.classList.add("buttons", "deleteButton");
						deleteButton.setAttribute("data-id_comentario", comentario.id_comentario);
						deleteButton.innerHTML = `<i class="fas fa-trash fa-fw"></i>`;
						lista.appendChild(deleteButton);
					}
					listaComentarios.appendChild(lista);
					document.querySelectorAll(".deleteButton").forEach(
						function(currentValue) {
							currentValue.addEventListener('click', deleteComment);
						});
				}
			})
		};
	} catch (error) {
		console.log(error);
	}
}

async function getComments() {
	try {
		let res = await fetch(`/api/Comentarios/${document.querySelector("#listaComentarios").dataset.id_presupuesto}`, {
			"method": "GET",
		});
		if (res.status == 200) {
			res.json().then(data => {
				let listaComentarios = document.querySelector("#listaComentarios");
				listaComentarios.innerHTML = "";
				if (data.length == 0) {
					listaComentarios.innerHTML = `<p>No hay comentarios</p>`;
				};
				for (let comentario of data) {
					let lista = document.createElement("ul");
					lista.classList.add("lista-comentarios");
					let puntaje = document.createElement("li");
					puntaje.innerHTML = `Puntaje: ${comentario.puntaje}`;
					let detalle = document.createElement("li");
					detalle.innerHTML = `Comentario: ${comentario.detalle}`;
					lista.appendChild(puntaje);
					lista.appendChild(detalle);
					if (document.querySelector("#listaComentarios").dataset.id_rol == 2) {
						let deleteButton = document.createElement("button");
						deleteButton.classList.add("buttons", "deleteButton");
						deleteButton.setAttribute("data-id_comentario", comentario.id_comentario);
						deleteButton.innerHTML = `<i class="fas fa-trash fa-fw"></i>`;
						lista.appendChild(deleteButton);
					}
					listaComentarios.appendChild(lista);
					document.querySelectorAll(".deleteButton").forEach(
						function(currentValue) {
							currentValue.addEventListener('click', deleteComment);
						});
				}
			})
		};
	} catch (error) {
		console.log(error);
	}
}

async function addComment(e){
	e.preventDefault();
	let form = document.querySelector('#commentForm');
	let url = window.location.origin + `/api/Comentario`;
	let formData = new FormData(form);
	let comentario = {
		idBudget: form.dataset.id_presupuesto,
		Puntaje: formData.get('Puntaje'),
		Comentario: formData.get('Comentario'),
	};
	if (comentario.Comentario == "" || comentario.Puntaje == ""){
		        alert("Faltan campos por completar");
		    }
	else {
		try {
			let res = await fetch(url, {
				method: 'POST',
				headers: {'Content-type': 'application/json'},
				body: JSON.stringify(comentario)
			});
			res.json();
			if (res.status == 200) {
				console.log("Comentario creado");
				console.log(cantComments);
				console.log(cantComments % 5);
				console.log(cantComments % 5 == 0);
				if (cantComments % 5 == 0) {
					maxPage++;
					console.log("MaxPage: " + maxPage);
				}
				getLastPage();
			}
			else {
				console.log("Error al crear comentario");
				console.log(res.status);
			}
		} catch (error) {
			console.log(error);
		}
	}
}

async function deleteComment(e){
	
	let url= "/api/Comentario/" + e.target.closest(".deleteButton").dataset.id_comentario;
	try {
		let res = await fetch(url, {
			"method": "DELETE",
		});
		res.json();
		if (res.status == 200) {
			console.log("Comentario eliminado");
			getFirstPage();
	  }
	} catch (error) {
		console.log(error);
	}
}