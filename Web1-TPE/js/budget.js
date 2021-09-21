"use strict"
const url = 'https://60d8e410eec56d0017477530.mockapi.io/Presupuesto';
let HTMLtable = document.querySelector("table.presupuesto tbody");
let form = document.querySelector('form.simulator');
	form.addEventListener('submit', agregarPresupuesto);
let namefilter = document.querySelector('input[name="namefilter"]')
	namefilter.addEventListener("input", filter);
let matfilter =document.querySelector('select[name="matfilter"]');
	matfilter.addEventListener("input", filter);
let grfilter =document.querySelector('input[name="grfilter"]');
	grfilter.addEventListener("input", filter);
let hrfilter =document.querySelector('input[name="hrfilter"]');
	hrfilter.addEventListener("input", filter);
let budgetfilter =document.querySelector('input[name="budgetfilter"]');
	budgetfilter.addEventListener("input",filter);
document.querySelector('#add3').addEventListener("click", add3);
document.addEventListener("DOMContentLoaded", obtenerDatos);

/* Estructuras */ 
let tableBudget = [
	{
	},
]

let addNew3 = [
	{
		nombre: "Roberto",
		material: "PLA",
		cantGr: 10,
		horas: 1,
		presupuesto: presupuestar("PLA",10,1),
	},
	{   
		nombre: "Magali",
		material: "ABS",
		cantGr: 150,
		horas: 5,
		presupuesto: presupuestar("ABS",150,5),
	},
	{
		nombre: "Alejandro",
		material: "Tecnicos",
		cantGr: 247,
		horas: 16,
		presupuesto: presupuestar("Tecnicos",247,16),
	},
]
function showTable(){
	HTMLtable.innerHTML="";
	for (const item of tableBudget ) {
		printTable(item)
	}
}
	function printTable(item){
		HTMLtable.innerHTML += `<tr>
								<td>${item.nombre}</td>
								<td>${item.material}</td>
								<td>${item.cantGr}</td>
								<td>${item.horas}</td>
								<td>$${item.presupuesto.toFixed(2)}</td>
								<td><button class="btnedit" data-id=${item.id} ><i data-id=${item.id} class="fas fa-edit fa-fw"></i></button></td>
								<td><button class="btndelete" data-id=${item.id}><i data-id=${item.id} class="fas fa-trash fa-fw"></i></button></td>
							</tr>`
		document.querySelectorAll(".btndelete").forEach((button) =>{
			button.addEventListener("click", deleterow)
		})
		document.querySelectorAll(".btnedit").forEach((button) =>{
			button.addEventListener("click", editrow)
		})
	}

//---------------------------------------API/REST-----------------------------------------------
//GET	
async function obtenerDatos() {
	try {
		let res = await fetch(url); 
		tableBudget = await res.json(); // texto json a objeto
		showTable();
	} catch (error) {
		console.log(error);
	}
}
//DELETE
async function deleterow(){
	let id= this.dataset.id;
	try {
		let res = await fetch(`${url}/${id}`, {
			"method": "DELETE",
		});
		if (res.status == 200) {
			  obtenerDatos();
	  }
	} catch (error) {
		console.log(error);
	}
}
//PUT
function editrow(event){
	let id= event.target.dataset.id;
	let budget;
	for (const line of tableBudget) {
		if (line.id == id){
			budget = line;
		}
	}
	let editForm = document.querySelector("#edittab");
	editForm.setAttribute("data-id", id);
	editForm.innerHTML="";
	editForm.innerHTML += `
							<input type="text" name="nameedit" placeholder="John doe" required value="${budget.nombre}">
							<select type="select" name="matedi" required>
									<option value="${budget.material}" selected hidden>${budget.material}</option>
									<option value="PLA">PLA</option>
									<option value="ABS">ABS</option>
									<option value="Pet-g">Pet-g</option>
									<option value="Tecnicos">Tecnicos</option>
									<option value="Flex">Flex</option>
							</select>
							<input type="number" name="gredit" placeholder="cantidad Gr" required value="${budget.cantGr}"> 
							<input type="number" name="hredit" placeholder="cantidad Hs" required value="${budget.horas}">
							<button type="submit" id="listo"><i class="fas fa-check fa-fw"></i></button>
							<button type="button" id="cancel"><i class="fas fa-times fa-fw"></i></button>
							`
	document.querySelector("#edittab").addEventListener("submit", save);
	document.querySelector("#cancel").addEventListener("click", cancelEdit);
  }
function cancelEdit(){
	let editForm = document.querySelector("#edittab");
	editForm.innerHTML="";
}
async function save(event){
	event.preventDefault();
	let datos = document.querySelector("#edittab");
	let formData = new FormData(datos);
	let nombre = formData.get("nameedit");
	let material= formData.get("matedi");
	let gramos= Number(formData.get("gredit"));
	let time= Number (formData.get("hredit"));
	let presupuesto=presupuestar(material, gramos, time);
	let editentry = {
		nombre: nombre,
		material:material ,
		cantGr: gramos,
		horas: time,
		presupuesto: presupuesto,
	}
	let editForm = document.querySelector("#edittab");
	editForm.innerHTML="";        
	let id= this.dataset.id;
	try {
		let res = await fetch(`${url}/${id}`, {
			"method": "PUT",
			"headers": { "Content-type": "application/json" },
			"body": JSON.stringify(editentry)
		});
		if (res.status == 200) {
			namefilter.value = grfilter.value = hrfilter.value = budgetfilter.value = matfilter.value = ""; /* Borro los filtros */
			obtenerDatos();
		}
	} catch (error) {
		console.log(error);
	}
}

//POST && AddData

function agregarPresupuesto(event){
	event.preventDefault();
	let formData = new FormData(form);
	let nombre = formData.get("clientname");
	let material= formData.get("material");
	let gramos= Number(formData.get("gr"));
	let time= Number (formData.get("time"));
	let presupuesto=presupuestar(material, gramos, time);
	let budgetentry = {
		nombre: nombre,
		material:material ,
		cantGr: gramos,
		horas: time,
		presupuesto: presupuesto,
	}
	sendData(budgetentry);
}
	function presupuestar(material, cantGr, time){
		let costoMaterial=calcularCosto(material, cantGr);
		const mMarcacion = 2.5;
		const manoObra = 30;
		return (costoMaterial+time*manoObra)*mMarcacion;
	}

		function calcularCosto (material, gramos){
			const costoPlaGr = 1600/1000;
			const costoAbsGr = 2000/1000;
			const costoPetgGr = 1900/1000;
			const costoFlexGr = 2300/1000;
			const costoTecnicosGr = 3000/1000;
			let costoMaterial;
			switch (material) {
				case "PLA":
					costoMaterial = costoPlaGr*gramos;
				break;
				case "ABS":
					costoMaterial = costoAbsGr*gramos;
				break;
				case "Pet-g":
					costoMaterial = costoPetgGr*gramos;
					break;
				case "Flex":
					costoMaterial = costoFlexGr*gramos;
					break;
				case "Tecnicos":
					costoMaterial = costoTecnicosGr*gramos;
					break;
			}
			return costoMaterial;
		}
async function sendData(budgetentry){
	try {
		let res = await fetch(url, {
			"method": "POST",
			"headers": { "Content-type": "application/json" },
			"body": JSON.stringify(budgetentry)
		});
		if (res.status == 201) {
			  obtenerDatos();
	  }
	} catch (error) {
		console.log(error); 
	}
}
async function add3 (event){
	event.target.setAttribute("disabled", true);
	for (const item of addNew3) {
		await sendData(item);
	}
	event.target.removeAttribute("disabled");
}
//-------------------------------Filtro--------------------------------------------------//
function filter (event){
	let entry = event.target.value;
	let origin = event.target.name;
	namefilter.value = grfilter.value = hrfilter.value = budgetfilter.value = matfilter.value = "";
	event.target.value = entry;
	HTMLtable.innerHTML="";
	if (entry == ""){
		showTable();
	}
	else
		switch (origin){
			case "namefilter":
				HTMLtable.innerHTML="";
				for (const item of tableBudget) {
					if (item.nombre.toLowerCase().includes(entry.toLowerCase())){
						printTable(item);
					}
				}
				break;
			case "matfilter":
					for (const item of tableBudget) {
						if (item.material == entry){
							printTable(item);
						}
				}
				break;	
			case "grfilter":
				for (const item of tableBudget) {
					if (item.cantGr == entry){
						printTable(item);
					}
				}
				break;
			case "hrfilter":
				for (const item of tableBudget) {
					if (item.horas == entry){
						printTable(item);
					}
				}
				break;
			case "budgetfilter":
				for (const item of tableBudget) {
					if (item.presupuesto >= entry){
						printTable(item);
					}
				}
				break;
		}
}