"use strict"

document.querySelector('form').addEventListener('submit', addComment);

async function addComment(e){
	e.preventDefault();
	let form = document.querySelector('form');
	let url = form.action;
	let idPresupuesto = form.dataset.id_presupuesto;
	let formData = new FormData(form);
	let comentario = {
		Puntaje: formData.get('Puntaje'),
		Comentario: formData.get('Comentario'),
	};
	if (comentario.Comentario == "" || comentario.Puntaje == ""){
		        alert("Faltan campos por completar");
		        return false;
		    }
	else {
		try {
			let res = await fetch(url, {
				"method": "PUT",
				"headers": { "Content-type": "application/json" },
				"body": JSON.stringify(comentario)
			});
			if (res.status == 200) {
				window.location.href = `/presupuesto/${idPresupuesto}`;
				console.log("Comentario creado");
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
