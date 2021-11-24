"use strict"

document.querySelector('tbody').addEventListener('click', editUser);

function editUser(e){
	if (!(typeof e.target.closest(".edit") === 'undefined' || e.target.closest(".edit") === null)){
		e.preventDefault();
		let userId = e.target.closest(".buttons").dataset.id_user;
		if (userId){
			let roleCell = document.querySelector(`#id${userId}`);
			roleCell.innerHTML = `
							<form action="user/edit/${userId}" method="post">
								<select type="select" name="FK_rol_id" required>
									<option value="1">Usuarios</option>
									<option value="2">Admin</option>
								</select>
							</form>
			`;
			let buttons = roleCell.parentElement.querySelector(".buttons");
			buttons.innerHTML = `
							<button type="submit" id="listoForId${userId}"><i class="fas fa-check fa-fw}}"></i></button>
							<button type="button" id="cancelForId${userId}"><i class="fas fa-times fa-fw"></i></button>
							`;
			document.querySelector(`#listoForId${userId}`).addEventListener("click", save);
			document.querySelector(`#cancelForId${userId}`).addEventListener("click", cancelEdit);
		}
	}
}

function cancelEdit(e){
 	let buttons =  e.target.closest(".buttons");
	let userId = buttons.dataset.id_user;
 	buttons.innerHTML=`
						<a href="/user/edit/${userId}" class="edit"<button><i class="fas fa-edit fa-fw"></i></button></a>
						<a href="/user/delete/${userId}"<button><i class="fas fa-trash fa-fw"></i></button></a>
	`;
	let roleCell = document.querySelector(`#id${userId}`);
	roleCell.innerHTML = `${roleCell.dataset.nombre_rol}`;
}

function save(){
	document.querySelector("form").submit();
}