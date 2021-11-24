"use strict"

document.querySelector('tbody').addEventListener('click', editUser);

function editUser(e){
	if (!(typeof e.target.closest(".edit") === 'undefined' || e.target.closest(".edit") === null)){
		e.preventDefault();
		let userId = e.target.closest(".buttons").dataset.id_user;
		if (userId){
			let roleCell = document.querySelector(`#id${userId}`);
			roleCell.innerHTML = `
							<select type="select" name="Rol" required>
								<option value="1">Usuarios</option>
								<option value="2">Admin</option>
							</select>
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

function save(e){
	let userId = e.target.closest(".buttons").dataset.id_user;
	let roleCell = document.querySelector(`#id${userId}`);
	let newRole = roleCell.firstElementChild.value;
	post('/user/edit/'+userId, {'FK_rol_id': newRole});
}

function post(path, params, method='post') {
	const form = document.createElement('form');
	form.method = method;
	form.action = path;
  
	for (const key in params) {
		const hiddenField = document.createElement('input');
		hiddenField.type = 'hidden';
		hiddenField.name = key;
		hiddenField.value = params[key];
  
		form.appendChild(hiddenField);
	}
  
	document.body.appendChild(form);
	form.submit();
  }