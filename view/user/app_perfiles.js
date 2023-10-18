
$(document).ready(function (){

    listarPerfiles();

    function listarPerfiles() {
        $.ajax({
            url: './backend/perfiles/perfiles-list.php',
            type: 'GET',
            success: function(response) {
                console.log(response); //este de aqui
                const perfiles = JSON.parse(response);
            
                //Se verifica que el objeto tenga datos
                if(Object.keys(perfiles).length > 0) {
                    //Se crea la plantilla para crear las filas de los elementos a insertar
                    let template = '';
                    perfiles.forEach(perfil => {
                        template += `
                            <div class="card">
                                <a href="index.php">
                                    <div class="profile">
                                        <img class="profile-img" src="../../${perfil.imagen}">
                                    </div>
                                </a>
                                <p> ${perfil.usuario} </p>
                            </div>
                        `;
                    });

                    template += `
                        <div class="card">
                            <a href="RegistroPerfil.php">
                                <div class="profile">
                                    <img class="profile-img" src="https://previews.123rf.com/images/misteremil/misteremil1905/misteremil190500116/123641468-plus-sign-symbol-simple-design-.jpg">
                                </div>
                            </a>
                            <p>Agregar perfil</p>
                        </div>
                    `;
                    // Se inserta la plantilla en el elemento "products"
                    $('#lista-perfiles').html(template);
                }
            }
        });
    }

    
    //Paso de datos de los perfiles al index
    /*$(document).on('click', '.profile-img', (e) => {
        const id = 3 //$('#idPerfil').text();
        console.log(id);
        $.get('./backend/perfiles/datos-perfil.php', id, (response) => {
			console.log(response);  
			//Se obtiene el objeto de datos a través de un string
			let respuesta = JSON.parse(response);
			if(respuesta.id != ''){ 
				window.location = 'Perfiles.php' + respuesta;
			}
		});
        e.preventDefault();
    });*/
});