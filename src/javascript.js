document.addEventListener('DOMContentLoaded', () => {
    const cardsContainer = document.getElementById('cards-container');
    const cardsContainer2 = document.getElementById('cards-container2');
    const jsonPath = '../public/datos_usuario.json'; // Ruta del archivo json

   

    // 1. Obtener los datos del JSON
    fetch(jsonPath)
        .then(response => {
            // Verifica si la respuesta es OK (código 200)
            if (!response.ok) {
                throw new Error('Error al cargar el archivo JSON: ' + response.statusText);
            }
            return response.json(); // Parsea la respuesta como JSON
        })
        .then(datos => {
            // La variable 'data' ahora contiene el array de objetos del JSON
            console.log('Datos cargados:', datos);
            var cont = 0;

            
            
            // 2. Iterar sobre los datos y 3. Crear las cards
            datos.forEach(item => {
                cont++;
                // Calculamos los dias desde la fecha de publicacion
                 // 1. Convertir la fecha de inicio a un objeto Date
    const fechaInicio = new Date(item.fecha_publicacion);

    
    const fechaActual = new Date();


    fechaInicio.setHours(0, 0, 0, 0);
    fechaActual.setHours(0, 0, 0, 0);


  
    const diferenciaMilisegundos = fechaActual.getTime() - fechaInicio.getTime();

  
    const milisegundosEnUnDia = 1000 * 60 * 60 * 24;

   
    const diasTranscurridos = diferenciaMilisegundos / milisegundosEnUnDia;

    
    const intervalo = Math.floor(diasTranscurridos);


                const cardHtml = `
                    <div class=" col-xl-2 col-lg-3  col-sm-12 col mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="${item.ruta_foto}" class="card-img-top" alt="${item.titulo}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">${item.titulo} </h5>
                                <p class="card-text">${item.descripcion}</p>
                                <p class="text-primary fw-bold mt-auto">${item.categoria}</p>
                                
                                <!-- Creamos el modal con la informacion del articulo -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalArticulo${cont}">
                            Ver articulo
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalArticulo${cont}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">${item.titulo} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                        <div class="modal-body p-3">
                                        <img src="${item.ruta_foto}" class="card-img-top" alt="${item.nombre}">
                                        <div class="border p-3 m-2">
                                        <h6>Descripción del articulo</h6>
                                        <p class="card-text">${item.descripcion}</p>
                                        </div>
                                        <div class="border p-3 m-2">
                                        <h6>Categoría</h6>
                                        <p class="text-primary fw-bold mt-auto">${item.categoria}</p>
                                        </div>
                                        <div class="border p-3 m-2">
                                        <h6>Vendedor</h6>
                                        <p class="text-primary fw-bold mt-auto">${item.nombre}</p>
                                        </div>    
                                          <div class="border p-3 m-2">
                                        <h6>Fecha publicación</h6>
                                        <p class="text-primary fw-bold mt-auto">Publicado hace ${intervalo} dias</p>
                                        </div> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                                      
                                                    `;

                // Inyectar el HTML de la card en el contenedor
                cardsContainer.innerHTML += cardHtml;
            });
        })
        .catch(error => {
            // Manejar cualquier error que ocurra durante la carga o el parseo
            console.error('Ha ocurrido un error:', error);
            cardsContainer.innerHTML = `<div class="alert alert-danger" role="alert">No se pudieron cargar los datos: ${error.message}</div>`;
        });




});