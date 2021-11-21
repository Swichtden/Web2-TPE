
"use strict"
document.querySelector('tbody').addEventListener('click', editUser);

function editUser(e){
	let idUser = e.target.dataset.id_user;
	if (idUser){
		let roleCell = document.querySelector(`#id${idUser}`);
		roleCell.innerHTML = `
						<select type="select" name="Rol" required>
							<option value="Usiario">Usuarios</option>
							<option value="Admin">Admin</option>
						</select>
		`;
		let buttons = roleCell.parentElement.querySelector("#buttons");
		console.log(roleCell);
		console.log(buttons);
		buttons.innerHTML = `
						<button type="submit" id="listo" data-id_user="${userId}"><i class="fas fa-check fa-fw"></i></button>
						<button type="button" id="cancel" data-id_user="${userId}"><i class="fas fa-times fa-fw"></i></button>
						`;
		document.querySelector("#listo").addEventListener("click", save);
		document.querySelector("#cancel").addEventListener("click", cancelEdit);
	}
}

function cancelEdit(e){
	let roleCell = document.querySelector(e.target.dataset.id_user);
	console.log(roleCell);
 	let buttons = document.querySelector("#buttons");
	let userId = buttons.dataset.id_user;
 	buttons.innerHTML=`
						<a data-id_user="${userId}" href="/user/edit/${userId}"<button><i data-id_user="${userId}" class="fas fa-edit fa-fw"></i></button></a>
						<a href="/user/delete/${userId}"<button><i class="fas fa-trash fa-fw"></i></button></a>
	 `;
}

function save(){
	console.log("save");
}

	// function editrow(event){
	// 	let id= event.target.dataset.id;
	// 	let budget;
	// 	for (const line of tableBudget) {
	// 		if (line.id == id){
	// 			budget = line;
	// 		}
	// 	}
	// 	let editForm = document.querySelector("#edittab");
	// 	editForm.setAttribute("data-id", id);
	// 	editForm.innerHTML="";
	// 	editForm.innerHTML += `
	// 							<input type="text" name="nameedit" placeholder="John doe" required value="${budget.nombre}">
	// 							<select type="select" name="matedi" required>
	// 									<option value="${budget.material}" selected hidden>${budget.material}</option>
	// 									<option value="PLA">PLA</option>
	// 									<option value="ABS">ABS</option>
	// 									<option value="Pet-g">Pet-g</option>
	// 									<option value="Tecnicos">Tecnicos</option>
	// 									<option value="Flex">Flex</option>
	// 							</select>
	// 							<input type="number" name="gredit" placeholder="cantidad Gr" required value="${budget.cantGr}"> 
	// 							<input type="number" name="hredit" placeholder="cantidad Hs" required value="${budget.horas}">
	// 							<button type="submit" id="listo"><i class="fas fa-check fa-fw"></i></button>
	// 							<button type="button" id="cancel"><i class="fas fa-times fa-fw"></i></button>
	// 							`
	// 	document.querySelector("#edittab").addEventListener("submit", save);
	// 	document.querySelector("#cancel").addEventListener("click", cancelEdit);
	//   }
	// function cancelEdit(){
	// 	let editForm = document.querySelector("#edittab");
	// 	editForm.innerHTML="";
	// }
	// async function save(event){
	// 	event.preventDefault();
	// 	let datos = document.querySelector("#edittab");
	// 	let formData = new FormData(datos);
	// 	let nombre = formData.get("nameedit");
	// 	let material= formData.get("matedi");
	// 	let gramos= Number(formData.get("gredit"));
	// 	let time= Number (formData.get("hredit"));
	// 	let presupuesto=presupuestar(material, gramos, time);
	// 	let editentry = {
	// 		nombre: nombre,
	// 		material:material ,
	// 		cantGr: gramos,
	// 		horas: time,
	// 		presupuesto: presupuesto,
	// 	}
	// 	let editForm = document.querySelector("#edittab");
	// 	editForm.innerHTML="";        
	// 	let id= this.dataset.id;
	// 	try {
	// 		let res = await fetch(`${url}/${id}`, {
	// 			"method": "PUT",
	// 			"headers": { "Content-type": "application/json" },
	// 			"body": JSON.stringify(editentry)
	// 		});
	// 		if (res.status == 200) {
	// 			namefilter.value = grfilter.value = hrfilter.value = budgetfilter.value = matfilter.value = ""; /* Borro los filtros */
	// 			obtenerDatos();
	// 		}
	// 	} catch (error) {
	// 		console.log(error);
	// 	}
	// }