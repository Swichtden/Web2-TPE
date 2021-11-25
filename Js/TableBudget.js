"use strict"

document.querySelector("#delete").addEventListener('click', deleteComment);

async function deleteComment(e){
	e.preventDefault();
	let url= document.querySelector('#delete').dataset.id_comentario;
	let idPresupuesto = document.querySelector('#delete').dataset.id_presupuesto;
	try {
		let res = await fetch(url, {
			"method": "DELETE",
		});
		if (res.status == 200) {
			window.location.href = `/presupuesto/${idPresupuesto}`;
			console.log("Comentario eliminado");
	  }
	} catch (error) {
		console.log(error);
	}
}