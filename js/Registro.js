$(document).ready(function(){
    //Envio de datos a PHP - Registro de usuarios

	$("#formulario").submit(e => {
		e.preventDefault();

		let postData = {
			nombre: $("#nombre").val(),
			apellido: $("#apellido").val(),
			correo: $("#correo").val(),
			tipo: $("#tipo").val(),
			pais: $("#pais").val(),
			numTarjeta: $("#tarjeta").val(),
			periodicidad: $("#periodo").val()
		}

		$.post('../Proyecto/model/Registro.php',postData, (response) => {
			console.log(response);
			//Se obtiene el objeto de datos a través de un string
			let respuesta = JSON.parse(response);
			if(respuesta.status == 'Success'){
				//Si el registro de la cuenta en la base de datos es correcto se rediccionará al registro de la cuenta
				window.location = '../Proyecto/registroUsuario.php';
			}else{

				setTimeout(() => {
					//Se crea una plantilla con la información para insertar en la barra de estado
				let template_bar = '';
				template_bar += `
						<li style="list-style: none;"> ${respuesta.status}</li>
						<li style="list-style: none;"> ${respuesta.message}</li>
				`;
				//Se hace visible la barra de estado
				$('#cuenta-result').show();
				//Se inserta la plantilla en el elemento container
				$('#container').html(template_bar);
				}, 5000);
			}
		});

	});


//VALIDACIONES PARA EL REGISTRO
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const select = document.querySelectorAll('#formulario select');

const expresiones = {
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	tipo: /Free|Familiar|Premium/,
	//pais: /Aguascalientes|Baja California|Baja California Sur|Campeche|Chiapas|Chihuahua|Ciudad de México|Coahuila|Colima|Durango|Estado de México|Guanajuato|Guerrero|Hidalgo|Jalisco|Michoacán|Morelos|Nayarit|Nuevo León|Oaxaca|Puebla|Querétaro|Quintana Roo|San Luis Potosí|Sinaloa|Sonora|Tabasco|Tamaulipas|Tlaxcala|Veracruz|Yucatán|Zacatecas/,
	tarjeta: /^\d{16}$/, // 16 numeros.
	periodo: /Mensual|Anual/
}

const campos = {
	nombre: false,
	apellido: false,
	correo: false,
	tipo: false,
	tarjeta: false,
	periodo:false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
		break;
		case "apellido":
			validarCampo(expresiones.apellido, e.target, 'apellido');
		break;
		case "correo":
			validarCampo(expresiones.correo, e.target, 'correo');
		break;
		case "tipo":
			validarCampo(expresiones.tipo, e.target, 'tipo');
		break;
		case "tarjeta":
			validarCampo(expresiones.tarjeta, e.target, 'tarjeta');
		break;
		case "periodo":
			validarCampo(expresiones.periodo, e.target, 'periodo');
		break;
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}


inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

select.forEach((select) => {
	select.addEventListener('keyup', validarFormulario);
	select.addEventListener('blur', validarFormulario);
});

formulario.addEventListener('submit', (e) => {
	e.preventDefault();


	const terminos = document.getElementById('terminos');
	if(campos.nombre && campos.apellido && campos.correo && campos.tipo && campos.tarjeta && campos.periodo && terminos.checked ){
		//formulario.reset();

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 10000);

		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove('formulario__grupo-correcto');
		});

	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 5000);
			
	}

});

});


