//Documento de prueba
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 768px)").matches) {
        $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
        );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });

    $(document).ready(function () {
        
        $('.carousel').carousel();
        img();

        //Se oculta la sección de búsqueda
        $('#seccion-0').hide();

        //-----------Funciones para listar el contenido-------------//
	    /**/

        const edad = 4;

        switch (edad){
            case 1: //A - AA niños menores de 7 años
                listarRP();
                listarRS();
                listarAAP();
                listarAAS();
                listarAP();
                listarAS();
                //Se ocultan las secciones que no se muestran
                $('#seccion-4').hide();
                $('#seccion-5').hide();
                $('#seccion-6').hide();
                $('#seccion-7').hide();
            break;
            case 2: // A - AA - B menores de 15 años
                listarRP();
                listarRS();
                listarAAP();
                listarAAS();
                listarAP();
                listarAS();
                listarBP();
                listarBS();
                //Se ocultan las secciones que no se muestran
                $('#seccion-5').hide();
                $('#seccion-6').hide();
                $('#seccion-7').hide();
            break;
            case 3: //A - AA - B - B15 menores de 18 años
                listarRP();
                listarRS();
                listarAAP();
                listarAAS();
                listarAP();
                listarAS();
                listarBP();
                listarBS();
                listarB15P();
                listarB15S();
                //Se ocultan las secciones que no se muestran
                $('#seccion-6').hide();
                $('#seccion-7').hide();
            break;
            case 4: //A - AA - B - B15 - C - D Mayores de 18
                listarRP();
                listarRS();
                listarAAP();
                listarAAS();
                listarAP();
                listarAS();
                listarBP();
                listarBS();
                listarB15P();
                listarB15S();
                listarCP();
                listarCS();
                listarDP();
                listarDS();
            break;
        }

        function img(){
            $.ajax({
                url: './backend/perfiles/perfil-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        contenido.forEach(detalles => {
                            template += `
                                <img id width="35" height="35" src="../../${detalles.imagen}" alt="perfil">
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#navbarDropdown3').html(template);
                    }
                }
            });
        }

        //BOTÓN DE BÚSQUEDA
        //Búsqueda de elementos por coincidencias en Título, Categoría, País o Clasificación.
    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/contenido/search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        console.log(response);
                        const contenido = JSON.parse(response);
                        
                        //Se verifica que el objeto no este vacio
                        if(Object.keys(contenido).length > 0) {
                            let template = '';
                            contenido.forEach(detalles => {
                                template += `
                                    <div>
                                        <img width="330" height="220" src="../../${detalles.rutaPortada}" class="img-thumbnail float-left" alt="${detalles.titulo}">
                                        <div class="">
                                            <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                        </div>
                                    </div>
                                `;
                            });
                            //Se muestra la seccion
                            $('#seccion-0').show(); 
                            // Se inserta la plantilla en el elemento "products"
                            $('#contenidoSearch').html(template);  
                        }
                    }
                }
            });
        }
        else {
            $('#seccion-0').hide(); //Se oculta la barra de estado
        }
    });


        /*Edición de productos
        $(document).on('click', '#edicion', (e) => {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('peliculasId');
            //tendriamos que mandarle el nombre o id del perfil... pero como lo traemos :(((( consesion no se puede?? mmmm no se, creo
            //que es desde perfil, desde ahí tenemos que mandar ))))
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
        });*/


        function listarRP() {
            $.ajax({
                url: './backend/contenido/peliculas/rp-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a> 
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-recom').html(template);
                    }
                }
            });
        }

        function listarRS() {
            $.ajax({
                url: './backend/contenido/series/rs-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-recom').html(template);
                    }
                }
            });
        }

        function listarAAP() {
            $.ajax({
                url: './backend/contenido/peliculas/aap-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a> 
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-aa').html(template);
                    }
                }
            });
        }

        function listarAAS() {
            $.ajax({
                url: './backend/contenido/series/aas-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-aa').html(template);
                    }
                }
            });
        }

        function listarAP() {
            $.ajax({
                url: './backend/contenido/peliculas/ap-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a> 
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-a').html(template);
                    }
                }
            });
        }

        function listarAS() {
            $.ajax({
                url: './backend/contenido/series/as-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-a').html(template);
                    }
                }
            });
        }

        function listarBP() {
            $.ajax({
                url: './backend/contenido/peliculas/bp-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a>  
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-b').html(template);
                    }
                }
            });
        }

        function listarBS() {
            $.ajax({
                url: './backend/contenido/series/bs-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-b').html(template);
                    }
                }
            });
        }

        function listarB15P() {
            $.ajax({
                url: './backend/contenido/peliculas/b15p-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a> 
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-b15').html(template);
                    }
                }
            });
        }

        function listarB15S() {
            $.ajax({
                url: './backend/contenido/series/b15s-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-b15').html(template);
                    }
                }
            });
        }
        
        function listarCP() {
            $.ajax({
                url: './backend/contenido/peliculas/cp-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a>  
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-c').html(template);
                    }
                }
            });
        }

        function listarCS() {
            $.ajax({
                url: './backend/contenido/series/cs-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-c').html(template);
                    }
                }
            });
        }

        function listarDP() {
            $.ajax({
                url: './backend/contenido/peliculas/dp-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Peliculas.png" class="card-img" alt="Portada peliculas">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Peliculas&nbsp;&nbsp;&nbsp;</a>  
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#peliculas-d').html(template);
                    }
                }
            });
        }

        function listarDS() {
            $.ajax({
                url: './backend/contenido/series/ds-list.php',
                type: 'GET',
                success: function(response) {
                    console.log(response); //este de aqui
                    const contenido = JSON.parse(response);
                
                    //Se verifica que el objeto tenga datos
                    if(Object.keys(contenido).length > 0) {
                        //Se crea la plantilla para crear las filas de los elementos a insertar
                        let template = '';
                        template += `
                                <div class="card">
                                    <img src="../../img/Series.png" class="card-img" alt="Portada series">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-info-circle"></i>&nbsp;&nbsp;&nbsp;Series&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                        `;
                        contenido.forEach(detalles => {
                            template += `
                                <div class="card d-none d-md-block">
                                    <img src="../../${detalles.rutaPortada}" class="card-img" alt="${detalles.titulo}">
                                    <div class="card-img-overlay">
                                        <a href="#" class="btn btn-primary"><i class="bi bi-play-circle"></i>&nbsp;&nbsp;&nbsp;Ver&nbsp;&nbsp;&nbsp;</a>
                                    </div>
                                </div>
                            `;
                        });
                        // Se inserta la plantilla en el elemento "products"
                        $('#series-d').html(template);
                    }
                }
            });
        }
    });