
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de Perfil</title>
	<link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="../../css/RegistroCuenta.css">

</head>
<body>
	<main>
		<div id="head">
			<!--img src="https://static.wikia.nocookie.net/dynastytv/images/5/54/Netflix_logo.png" height="50px"\-->
	   </div>

	   <div class="Registro">
		<h2>Perfil</h2>
		<form  class="formulario" id="formulario">
            <input type="hidden" id="Id">
			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__imagen">
				<label for="nombre" class="formulario__label">Imagen de perfil</label>
				<div class="formulario__grupo-input">
                    
                    <div class="cc-selector-2">
                        
                        <input id="img1" type="radio" name="imagen" value="img/Imagen1.png" />
                        <label class="drinkcard-cc" for="visa2">
                            <img class="profile-img"  src="../../img/Imagen1.png"/>
                            
                        </label>

                        <input id="img2" type="radio" name="imagen" value="img/imagen2.png" />
                        <label class="drinkcard-cc" for="mastercard2">
                            <img class="profile-img"  src="../../img/imagen2.png"/>
                        </label>

						<input id="img3" type="radio" name="imagen" value="img/imagen3.png" />
                        <label class="drinkcard-cc" for="mastercard2">
                            <img class="profile-img"  src="../../img/imagen3.png"/>
                        </label>

						<input id="img4" type="radio" name="imagen" value="img/imagen4.png" />
                        <label class="drinkcard-cc" for="mastercard2">
                            <img class="profile-img"  src="../../img/imagen4.png"/>
                        </label>

						<input id="img5" type="radio" name="imagen" value="img/imagen5.png" />
                        <label class="drinkcard-cc" for="mastercard2">
                            <img class="profile-img"  src="../../img/imagen5.png"/>
                        </label>
                        
                    </div>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Selecciona una imagen de perfil</p>
			</div>

			<!-- Grupo para nombre de perfil -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre del perfil:</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" >
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras.</p>
			</div>

			<!-- Grupo: Tipo e Cuenta -->
			<div class="formulario__grupo form-group form-label mt-4" id="grupo__idioma">
				<label for="idioma" class="formulario__label form-label mt-4">Idioma:</label>
				<div class="formulario__grupo-input">
				  <select class="formulario__input form-select form-control" name="idioma" id="idioma">
					<option value="" > Selecciona idioma</option>
					<option value="English">Inglés</option>
					<option value="Spanish">Español</option>
					<option value="Frances">Frances</option>
				  </select>
				  <i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Este campo es necesario</p>
			  </div>


			<!-- Grupo: Edad -->
			<div class="formulario__grupo form-group form-label mt-4" id="grupo__edad">
				<label for="edad" class="formulario__label form-label mt-4">Edad:</label>
				<div class="formulario__grupo-input">
				  <select class="formulario__input form-select form-control" name="edad" id="edad">
					<option value="" > Selecciona tu edad</option>
					<option value="Menos de 18">Menos de 18</option>
					<option value="20">20</option>
					<option value="30 y más">30 y mas</option>
				  </select>
				  <i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">Este campo es necesario</p>
			</div>

			<div class="formulario__mensaje" id="formulario__mensaje">
				<p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
			</div>
            
			<div id="buttons" class="buttons">
			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button class="formulario__btn" type="reset" onclick="redirige()">Cancelar</a></button>
			</div>

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" id="enviar" onclick="redirige()"  class="task-form__btn formulario__btn btn-block btn btn-success">Guardar</button>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			</div>
            </div>
		</form>

	   </div>
	</main>

    <script type="text/javascript">
		function redirige(){
			window.location.href="Perfiles.php";
		}
	</script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js">
    </script>
	<!--Referencia web a JQuery-->
   

    <!-- Lógica del Frontend -->
    <script src="../../js/Cuenta.js"></script>
	
</body>
</html>