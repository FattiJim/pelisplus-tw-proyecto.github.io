//Documento de peliculas
$(document).ready(function () {
    let edit = false; //Variable controlador de edición
    
    $('#peliculas-result').hide(); //Se oculta la barra de estado
    listarPeliculas(); //Se llama a la función para listar los productos

    function listarPeliculas() {
        $.ajax({
            url: './backend/peliculas/peliculas-list.php',
            type: 'GET',
            success: function(response) {
                console.log(response);
                const peliculas = JSON.parse(response);
            
                //Se verifica que el objeto tenga datos
                if(Object.keys(peliculas).length > 0) {
                    //Se crea la plantilla para crear las filas de los elementos a insertar
                    let template = '';
                    peliculas.forEach(pelicula => {
                        let descripcion = '';
                        descripcion += '<li>Duración: '+pelicula.duracion+'</li>';
                        descripcion += '<li>Genero: '+pelicula.Genero+'</li>';
                        descripcion += '<li>Región: '+pelicula.Region+'</li>';
                        descripcion += '<li>Clasificación: '+pelicula.clave+'</li>';
                        descripcion += '<li>Descripcion: '+pelicula.publico+'</li>';
                    
                        template += `
                            <tr peliculasId="${pelicula.idPelicula}">
                                <td>${pelicula.idPelicula}</td>
                                <td><a href="#" class="peliculas-item">${pelicula.titulo}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="peliculas-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // Se inserta la plantilla en el elemento "products"
                    $('#peliculas').html(template);
                }
            }
        });
    }


    //Búsqueda de elementos por coincidencias en Título, Categoría, País o Clasificación.
    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/peliculas/peliculas-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        const peliculas = JSON.parse(response);
                        
                        //Se verifica que el objeto no este vacio
                        if(Object.keys(peliculas).length > 0) {
                            // Se crea la plantilla para insertar los elementos
                            let template = '';
                            let template_bar = ''; //Plantilla de la barra de estado

                            peliculas.forEach(pelicula => {
                                let descripcion = '';
                                descripcion += '<li>Duración: '+pelicula.duracion+'</li>';
                                descripcion += '<li>Genero: '+pelicula.Genero+'</li>';
                                descripcion += '<li>Región: '+pelicula.descripcion+'</li>';
                                descripcion += '<li>Clasificacion: '+pelicula.clave+' </li>';
                                descripcion += '<li>Descripcion: '+pelicula.publico+' </li>';
                            
                                template += `
                                    <tr peliculasId="${pelicula.idPelicula}">
                                        <td>${pelicula.idPelicula}</td>
                                        <td><a href="#" class="peliculas-item">${pelicula.titulo}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="peliculas-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${pelicula.titulo}</il>
                                `;
                            });
                            // Se hace visible la barra de estado
                            $('#peliculas-result').show();
                            // Se inserta la plantilla en el elemento "container"
                            $('#container').html(template_bar);
                            // Se inserta la plantilla en el elemento "products"
                            $('#peliculas').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#peliculas-result').hide(); //Se oculta la barra de estado
        }
    });



    //Buscar coincidencias en el nombre
    $('#titulo').keyup(function() {
        if($('#titulo').val()) {
            let search = $('#titulo').val();
            $.ajax({
                url: './backend/peliculas/peliculas-titulo.php?search='+$('#titulo').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    if(!response.error) {
                        const peliculas = JSON.parse(response);
                        
                        //Se verifica que el objeto no este vacio
                        if(Object.keys(peliculas).length > 0) {
                            // Se crea la plantilla para insertar los elementos
                            let template = '';
                            let template_bar = ''; //Plantilla de la barra de estado

                            peliculas.forEach(pelicula => {
                                let descripcion = '';
                                descripcion += '<li>Duración: '+pelicula.duracion+'</li>';
                                descripcion += '<li>Genero: '+pelicula.Genero+'</li>';
                                descripcion += '<li>Región: '+pelicula.descripcion+'</li>';
                                descripcion += '<li>Clasificacion: '+pelicula.clave+' </li>';
                                descripcion += '<li>Descripcion: '+pelicula.publico+' </li>';
                            
                                template += `
                                    <tr peliculasId="${pelicula.idPelicula}">
                                        <td>${pelicula.idPelicula}</td>
                                        <td><a href="#" class="peliculas-item">${pelicula.titulo}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="peliculas-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${pelicula.titulo}</il>
                                `;
                            });
                            // Se hace visible la barra de estado
                            $('#peliculas-result').show();
                            // Se inserta la plantilla en el elemento "container"
                            $('#container').html(template_bar);
                            // Se inserta la plantilla en el elemento "products"
                            $('#peliculas').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#peliculas-result').show(); //Se muestra la barra de estado
            $('#container').html("No se encontraron coincidencias"); //Se manda a imprimir que no se encontraron coincidencias
            listarPeliculas();
        }
    });


    //AQUI COMIENZAN LAS FUNCIONES DE VALIDACION DE LOS CAMPOS
    const titulo = document.getElementById('titulo');
    const e_tit = document.querySelector('#titulo + span.error');
    const duracion = document.getElementById('duracion');
    const e_dur = document.querySelector('#duracion + span.error');
    const genero = document.getElementById('genero');
    const e_gen = document.querySelector('#genero + span.error');
    const region = document.getElementById('region');
    const e_reg = document.querySelector('#region + span.error');
    const clasificacion = document.getElementById('clasificacion');
    const e_clas = document.querySelector('#clasificacion + span.error');

    //Este evento se realiza para cada dato a validar
    titulo.addEventListener('input', function (event){
        //Cada vez que el usuario escriba algo, se verificara si es válido
        if(titulo.validity.valid){
           //Si el campo es válido se elimina el mensaje de error
           e_tit.innerHTML = ''; //Restablece el contenido del mensaje
           e_tit.className = 'error'; //Restablece el estado visual del mensaje
        }else{
          //Si el error persiste, se muestra especificamente cual es
          showError_tit();
        }
    });

    duracion.addEventListener('input', function (event){
        //Cada vez que el usuario escriba algo, se verificara si es válido
        if(duracion.validity.valid){
           //Si el campo es válido se elimina el mensaje de error
           e_dur.innerHTML = ''; //Restablece el contenido del mensaje
           e_dur.className = 'error'; //Restablece el estado visual del mensaje
        }else{
          //Si el error persiste, se muestra especificamente cual es
          showError_dur();
        }
    });

    genero.addEventListener('select', function (event){
        //Cada vez que el usuario seleccione algo, se verificara si es válido
        if(genero.validity.valid){
           //Si el campo es válido se elimina el mensaje de error
           e_gen.innerHTML = ''; //Restablece el contenido del mensaje
           e_gen.className = 'error'; //Restablece el estado visual del mensaje
        }else{
          //Si el error persiste, se muestra especificamente cual es
          showError_gen();
        }
    });

    region.addEventListener('select', function (event){
        //Cada vez que el usuario seleccione algo, se verificara si es válido
        if(region.validity.valid){
           //Si el campo es válido se elimina el mensaje de error
           e_reg.innerHTML = ''; //Restablece el contenido del mensaje
           e_reg.className = 'error'; //Restablece el estado visual del mensaje
        }else{
          //Si el error persiste, se muestra especificamente cual es
          showError_reg();
        }
    });

    clasificacion.addEventListener('select', function (event){
        //Cada vez que el usuario seleccione algo, se verificara si es válido
        if(clasificacion.validity.valid){
           //Si el campo es válido se elimina el mensaje de error
           e_clas.innerHTML = ''; //Restablece el contenido del mensaje
           e_clas.className = 'error'; //Restablece el estado visual del mensaje
        }else{
          //Si el error persiste, se muestra especificamente cual es
          showError_clas();
        }
    });

     //Estas son las funciones que evaluan si los elementos son validos o no
     function showError_tit(){
        if(titulo.validity.valueMissing){
            //Si el campo esta vacio se muestra el siguiente mensaje
            e_tit.textContent = 'Este campo es obligatorio, introduzca un nombre.';
        }
        if(titulo.validity.tooShort){
            //Si el campo es más corto que el mímino de caracteres
            e_tit.textContent = `Ingresa al menos 5 caracteres. El número máximo de caracteres es ${ titulo.maxLength }; has introducido ${ titulo.value.length }`;
        }
      //Se establece el estilo del error
      e_tit.className = 'error activo';
    }

    function showError_dur(){
        if(duracion.validity.valueMissing){
            //Si el campo esta vacio se muestra el siguiente mensaje
            e_dur.textContent = 'Este campo es obligatorio, introduzca la duración de la película.';
        }
      //Se establece el estilo del error
      e_dur.className = 'error activo';
    }

    function showError_reg(){
        //Para este caso solo verificaremos que el campo no este vacío
        if(region.validity.valueMissing){
            e_reg.textContent = 'Este es un campo obligatorio, selecciona una opción';
        }
        //Se establece el estilo del error
        e_reg.className = 'error activo';
    }

    function showError_gen(){
        //Para este caso solo verificaremos que el campo no este vacío
        if(genero.validity.valueMissing){
            e_gen.textContent = 'Este es un campo obligatorio, selecciona una opción';
        }
        //Se establece el estilo del error
        e_gen.className = 'error activo';
    }

    function showError_clas(){
        //Para este caso solo verificaremos que el campo no este vacío
        if(clasificacion.validity.valueMissing){
            e_clas.textContent = 'Este es un campo obligatorio, selecciona una opción';
        }
        //Se establece el estilo del error
        e_clas.className = 'error activo';
    }

    //Agregación o edición de productos
    $('#peliculas-form').submit(e => {
        e.preventDefault();

        console.log($('#titulo').val());

        //Se crea el objeto que almacena los datos
        let postData = {
            idPelicula: $('#peliculasId').val(),
            titulo: $('#titulo').val(),
            duracion: $('#duracion').val(),
            idGenero: $('#genero').val(),
            idClasificacion: $('#clasificacion').val(),
            idRegion: $('#region').val(),
            rutaPortada: $('#imagen').val()
        }
        
        //AQUI COMIENZAN LAS VALIDACIONES DE LOS CAMPOS
        let correcto = 0;
        //Llamamos a las funciones de validacion
        if(!titulo.validity.valid){
            showError_tit();
            e.preventDefault();
        }else correcto++;
        if(!duracion.validity.valid){
            showError_dur();
            e.preventDefault();
        }else correcto++;
        if(!genero.validity.valid){
            showError_gen();
            e.preventDefault();
        }else correcto++;
        if(!region.validity.valid){
            showError_reg();
            e.preventDefault();
        }else correcto++;
        if(!clasificacion.validity.valid){
            showError_clas();
            e.preventDefault();
        }else correcto++;

        let envio = true; 

        if(correcto < 4){
            envio = false;
            window.alert('Algunos de los campos requeridos estan vacíos, llene correctamente el formulario');
        }else {
            envio = true;
            window.alert('Los datos son correctos, se enviaran a la base de datos');
        }
          

        const url = edit === false ? './backend/peliculas/peliculas-add.php' : './backend/peliculas/peliculas-update.php';
        if(envio == true) {
            $.post(url, postData, (response) => {
                console.log(response); //Respuesta del servidor en consola
                //Se obtiene el objeto de datos a través de un string
                let respuesta = JSON.parse(response);
                //Se crea una plantilla con la información para insertar en la barra de estado
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                //Se reinician los campos del formulario
                $('#titulo').val('');
                $('#duracion').val('');
                $('#genero').val('');
                $('#clasificacion').val('');
                $('#region').val('');
                $('#imagen').val('');
                //Se hace visible la barra de estado
                $('#peliculas-result').show();
                //Se inserta la plantilla en el elemento container
                $('#container').html(template_bar);
                //Se listan los productos
                listarPeliculas();
                //Se regresa el valor de la variable controlador a su estado inicial
                edit = false;
            });
        }
    });


    //Eliminación de productos
    $(document).on('click', '.peliculas-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('peliculasId');
            $.post('./backend/peliculas/peliculas-delete.php', {id}, (response) => {
                console.log(response); //Muestra la respuesta del servidor en consola
                let respuesta = JSON.parse(response);
                //Se crea una plantilla para la información de la barra de estado
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                //Se hace visible la barra de estado
                $('#peliculas-result').show();
                //Se inserta la plantilla en el elemento "container"
                $('#container').html(template_bar);
                //Se listan los productos nuevamente
                listarPeliculas();
            });
        }
    });


    //Edición de productos
    $(document).on('click', '.peliculas-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('peliculasId');
        console.log(id);
        $.post('./backend/peliculas/peliculas-single.php', {id}, (response) => {
            console.log(response);
            let pelicula = JSON.parse(response);
            //Sse insertan los datos en los campos del formulario para su edición
            $('#titulo').val(pelicula.titulo);
            $('#duracion').val(pelicula.duracion);
            $('#genero').val(pelicula.idGenero);
            $('#clasificacion').val(pelicula.idClasificacion);
            $('#region').val(pelicula.idRegion);
            $('#imagen').val(pelicula.rutaPortada);
            //El ID se inserta en un campo oculto para el usuario, pero que será utilizado para la actualización
            $('#peliculasId').val(pelicula.idPelicula);
            console.log(pelicula.idPelicula);
            //Variable controlador cambia a true
            edit = true;
        });
        e.preventDefault();
    });
});




