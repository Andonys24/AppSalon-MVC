let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener("DOMContentLoaded", function () {
	iniciarApp();
});

function iniciarApp() {
	mostrarSeccion(); // Muestra y oculta las secciones
	tabs(); //Cambiar la seccion cuando se presionen los tabs
	botonesPaginador(); // Agrega o quita los botones paginadores
	paginaAnterior();
	paginaSiguiente();
}

function mostrarSeccion() {
	// Ocultar la seccion que tenga la clase mostrar
	const seccionAnterior = document.querySelector(".mostrar");
	if (seccionAnterior) {
		seccionAnterior.classList.remove("mostrar");
	}

	// Seleccionar la seccion con el paso...
	const seccion = document.querySelector(`#paso-${paso}`);
	seccion.classList.add("mostrar");

	// Quita la clase de actual al tab anterior
	const tabAnterior = document.querySelector(".actual");
	if (tabAnterior) {
		tabAnterior.classList.remove("actual");
	}

	// Resalta el tab actual
	const tab = document.querySelector(`[data-paso="${paso}"]`);
	tab.classList.add("actual");
}

function tabs() {
	const botones = document.querySelectorAll(".tabs button");

	botones.forEach((boton) => {
		boton.addEventListener("click", function (e) {
			paso = parseInt(e.target.dataset.paso);

			mostrarSeccion();
			botonesPaginador();
		});
	});
}

function botonesPaginador() {
	const paginaAnterior = document.querySelector("#anterior");
	const paginaSiguiente = document.querySelector("#siguiente");

	if (paso === pasoInicial) {
		paginaAnterior.classList.add("ocultar");
		paginaSiguiente.classList.remove("ocultar");
	} else if (paso === pasoFinal) {
		paginaAnterior.classList.remove("ocultar");
		paginaSiguiente.classList.add("ocultar");
	} else {
		paginaAnterior.classList.remove("ocultar");
		paginaSiguiente.classList.remove("ocultar");
	}
	mostrarSeccion();
}
function paginaAnterior() {
	const paginaAnterior = document.querySelector("#anterior");
	paginaAnterior.addEventListener("click", function () {
		if (paso <= pasoInicial) return;
		paso--;
		botonesPaginador();
	});
}
function paginaSiguiente() {
	const paginaSiguiente = document.querySelector("#siguiente");
	paginaSiguiente.addEventListener("click", function () {
		if (paso >= pasoFinal) return;
			paso++;
			botonesPaginador();
	});
}
