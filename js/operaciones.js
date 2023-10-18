
$('#login').click(function(){

  // Traemos los datos de los inputs
  var user  = $('#user').val();
  var clave = $('#clave').val();

  // Envio de datos mediante Ajax
  $.ajax({
    method: 'POST',
    url: 'controller/loginController.php',
    data: {user_php: user, clave_php: clave},
    
    beforeSend: function(){
      $('#load').show();
    },

    success: function(res){
      $('#load').hide();

      //Validacion de datos para redireccionar a la página
      if(res == 'error_1'){
        swal('Error', 'Por favor ingrese todos los campos', 'error');
      }else if(res == 'error_2'){
        swal('Error', 'Por favor ingrese un usuario', 'warning');
      }else if(res == 'error_3'){
        swal('Error', 'El usuario y contraseña que ingresaste es incorrecto', 'error');
      }else{
        // Redireccionamos a la página que corresponda el usuario
        window.location.href= res
      }

    }
  });

});


//Ajax para registro del usuario y contraseña
$('#registro').click(function(){

  //Variable a enviar
  let postData = {
    name: $('#nombre').val(),
    clave: $('#pass').val(),
    clave2: $('#pass2').val()
  }

  $.ajax({
    method: 'POST',
    url: 'controller/registroController.php',
    data: postData,
    beforeSend: function(){
      $('#load').show();
    },
    success: function(res){
      $('#load').hide();

      if(res == 'error_1'){
        swal('Error', 'Campos obligatorios, por favor llena el usuario y las contraseñas', 'warning');
      }else if(res == 'error_2'){
        swal('Error', 'Las contraseñas deben ser iguales, por favor intentalo de nuevo', 'error');
      }else if(res == 'error_3'){
        swal('Error', 'El nombre de usuario ya esta en uso', 'error');
      }else if(res == 'error_4'){
        swal('Error', 'Por favor ingresa los datos', 'warning');
      }else{
        window.location.href = res ;
      }


    }
  });

});
