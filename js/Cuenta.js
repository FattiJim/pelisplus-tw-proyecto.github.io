$(document).ready(function(){
	let edit = false;

	$("#formulario").submit(e => {
		e.preventDefault();

		let postData = {
			idioma: $("#idioma").val(),
			edad: $("#edad").val(),
			imagen: $('input:radio[name=imagen]:checked').val(),
			usuario: $('#nombre').val()
		}

		const url = edit === false ? '../../model/cuenta.php' : '../../model/edicionPerfil.php';

		$.post(url, postData, (response) => {
			console.log(response);
			//Se obtiene el objeto de datos a través de un string
			let respuesta = JSON.parse(response);
			if(respuesta.status == 'Success'){
				window.location = '../Proyecto/view/user/Perfiles.php';
			}else{
				window.alert('Error de agregación de perfil');
			}
			edit = false;
		});
	});

	//VALIDACIONES PARA EL REGISTRO
	const formulario = document.getElementById('formulario');
	const select = document.querySelectorAll('#formulario select'); // como el idioma y edad son select, solo se pone escape, si fuera input
	//const input = document.querySelectorAll('#formulario input');  seria asi
	const inputs = document.querySelectorAll('#formulario input');

	const expresiones = { //creo que estas las llamaba el profe constante norecuerdo
		nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
		imagen: /img+[/]+imagen1.png|img+[/]+imagen2.png|img+[/]+imagen3.png|img+[/]+imagen4.png|img+[/]+imagen5.png/,
		idioma: /English|Spanish|Frances/,
		edad: /Menos de 18|20|30 y más/
	}


	const campos = { //para que se pueda validar el formulario deben estar en true los campos
		nombre: false,
		imagen: false,
		edad: false,
		idioma: false
	}

	const validarFormulario = (e) => {
		switch (e.target.name) {
			case "nombre":
				validarCampo(expresiones.nombre, e.target, 'nombre');
			break;
			case "imagen":
				validarCampo(expresiones.imagen, e.target, 'imagen');
			break;
			case "edad": //este los toma por name
				validarCampo(expresiones.edad, e.target, 'edad');
			break;
			case "idioma":
				validarCampo(expresiones.idioma, e.target, 'idioma');
			break;
		}
	}

	const validarCampo = (expresion, input, campo) => {
		if(expresion.test(input.value)){ //esas etiquetas son formulario , son las que da el color rojo o el texto debajo del label
			document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
			document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
			document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle'); //estos
			document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');//son los iconos 
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




	select.forEach((select) => { //esta es cuando le das click al label y lo reconozca para validar... aunque este vacio.. asii
		select.addEventListener('keyup', validarFormulario);
		select.addEventListener('blur', validarFormulario);
	});

	inputs.forEach((input) => {
		input.addEventListener('keyup', validarFormulario);
		input.addEventListener('blur', validarFormulario);
	});



	formulario.addEventListener('submit', (e) => {
		e.preventDefault();
	
		if(campos.nombre&&campos.imagen &&campos.edad && campos.idioma  ){
			formulario.reset(); //lo limpia si estan bien 

			document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
			setTimeout(() => {
				document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
			}, 10000); //si es que se alcanzo a ver, sale un texto en verde, que dice formulario enviado exitosamente

			document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
				icono.classList.remove('formulario__grupo-correcto');
			});
		} else { //y este es el mensaje de error aparece en rojo porque falta un campo o el campo esta mal
			document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
			setTimeout(() => {
				document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
			}, 5000);
		}
	});
});


