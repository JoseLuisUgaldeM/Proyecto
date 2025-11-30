<?php


require "Usuario.php";

require "Articulos.php";


$database = new Database();

$db = $database->getConnection();


session_start();

if ($_SESSION['inicioSesion'] == true) {


    $usuario = new Usuario($database);


    $id_usuario =  $_SESSION['id_usuario'];


    // Hacemos una consulta a la base da datos para obtener el nombre 

    $datosUsuario = $usuario->obtenerUsuarioPorId($id_usuario);


    $nombreUsuario = $datosUsuario['nombre'];



    $_SESSION['usuarioNombre'] = $nombreUsuario;


    $_SESSION['avatar'] =  $datosUsuario['avatar'];


    $todos = $usuario->listarUsuarios();


?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <link rel="stylesheet" href="estilo.css">
        <script src="javascript.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../css/estilo.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <title>TrueChange</title>
    </head>

    <body>

        <div class="loader">
            <div class="spinner"></div>
            <p>Cargando...</p>
        </div>



        <header class="header">

            <div class="px-2 py-1 bg-opacity-30 bg-info bg-gradient text-white contenedor">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <img src="imagenes/icono_proyecto.png" alt="icono de la aplicacion" width="100" height="100">
                        <!-- Ejemplo en PHP -->





                        <div class="dropdown"> <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src=<?php print($_SESSION['avatar']) ?> alt="Foto de perfil " width="60" height="60" class="rounded-circle me-2">
                                <strong> <?php print($_SESSION['usuarioNombre']) ?></strong> </a>


                            <ul class="dropdown-menu text-small shadow">
                                  <li><a class="btn dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#avatarModal">Cambiar foto de perfil</a></li>
                                <li><a class="btn dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#subirModal">Subir producto</a></li>
                                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="#">Eliminar articulo</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>

                        
                        <!-- Modal de cambio de avatar -->

                        <div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Foto de perfil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="../src/cambiarAvatar.php" method="post" enctype="multipart/form-data">
                                    
                                    <div class="col-md-12">
                                            <label for="fileToUpload" class="form-label">Selecciona una imagen para subir:</label>
                                            <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" >
                                     </div>
                                    
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Subir Imagen" name="submit">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                               
                            </div>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>

                        <!-- Modal subir producto-->

                        <div class="modal" id="subirModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Rellena los datos de tu anuncio</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" action="../src/subirArticulo.php" method="post"  enctype="multipart/form-data">
                                            <div class="col-md-12">
                                                <label for="titulo" class="form-label" name="titulo">Titulo</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                                            </div>

                                            <p>Selecciona el estado del artículo:</p>
                                            <div>
                                                <input class="form-check-input" type="radio" id="nuevo" name="estado" value="nuevo">
                                                <label for="nuevo">Nuevo</label>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" id="como-nuevo" name="estado" value="como nuevo">
                                                <label for="como-nuevo">Como nuevo</label>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" id="usado" name="estado" value="usado" checked>
                                                <label for="usado">Usado</label>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" id="deteriorado" name="estado" value="deteriorado">
                                                <label for="deteriorado">Deteriorado</label>
                                            </div>

                                            <div class="col-md-12">


                                                <select class="form-select " name="categoria">
                                                    <option selected disabled>Categoria</option>
                                                    <option value="coches">Coches</option>
                                                    <option value="motos">Motos</option>
                                                    <option value="motor y accesorios">Motor y accesorios</option>
                                                    <option value="moda y accesorios">Moda y accesorios</option>
                                                    <option value="inmobiliaria">Inmobiliaria</option>
                                                    <option value="tecnologia y electronica">Tecnología y electrónica</option>
                                                    <option value="deporte y ocio">Deporte y ocio</option>
                                                    <option value="bicicletas">Bicicletas</option>
                                                    <option value="hogar y jardin">Hogar y jardin</option>
                                                    <option value="electrodomesticos">Electrodomésticos</option>
                                                    <option value="cine libros y musica">Cine libros y música</option>
                                                    <option value="niños y bebes">Niños y bebés</option>
                                                    <option value="coleccionismo">Coleccionismo</option>
                                                    <option value="construccion y reformas">Construccion y reformas</option>
                                                    <option value="industria  agricultura">Industria y agricultura</option>
                                                    <option value="empleo">Empleo</option>
                                                    <option value="servicios">Servicios</option>
                                                    <option value="otros">Otros...</option>

                                                </select>



                                            </div>
                                            <div class="col-md-12">

                                                <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="cambio" class="form-label">Quiero cambiar por...</label>
                                                <input type="text" class="form-control" id="cambio" name="cambio" required>
                                            </div>

                                             <label for="foto">Selecciona una imagen:</label><br>
                                                <!-- El campo de entrada tipo 'file' -->
                                                <input type="file" name="foto" id="foto" required>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Borrar</button>
                                                <button type="submit" class="btn btn-primary" name="publicar">Publicar</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div>

        </header>

        <!-- Barra de navegación-->
  <div class="barraNavegacion mx-auto ">

        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-item nav-underline">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                href="#">Categorias</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="coches">Coches</a></li>
                                <li><a class="dropdown-item" href="motos">Motos</a></li>
                                <li><a class="dropdown-item" href="motor y accesorios">Motor y accesorios</a></li>
                                <li><a class="dropdown-item" href="moda y accesorios">Moda y accesorios</a></li>
                                <li><a class="dropdown-item" href="inmobiliaria">Inmobiliaria</a></li>
                                <li><a class="dropdown-item" href="#">Tecnología y electrónica</a></li>
                                <li><a class="dropdown-item" href="#">Deporte y ocio</a></li>
                                <li><a class="dropdown-item" href="#">Bicicletas</a></li>
                                <li><a class="dropdown-item" href="#">Hogar yjardín</a></li>
                                <li><a class="dropdown-item" href="#">Electrodomésticos</a></li>
                                <li><a class="dropdown-item" href="#">Cine libros y música</a></li>
                                <li><a class="dropdown-item" href="#">Niños y bebés</a></li>
                                <li><a class="dropdown-item" href="#">Coleccionismo</a></li>
                                <li><a class="dropdown-item" href="#">Construccion y reformas</a></li>
                                <li><a class="dropdown-item" href="#">Hogar</a></li>
                                <li><a class="dropdown-item" href="#">Jardineria</a></li>
                                <li><a class="dropdown-item" href="#">Coches</a></li>
                                <li><a class="dropdown-item" href="#">Motos</a></li>
                            </ul>
                        </li>


                        <li class="nav-item ">
                            <a class="nav-link" href="#">Electronica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Informática</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Hogar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Coches</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Motos</a>
                        </li>
                    </ul>
                </div>
                <form class="d-flex col-lg-5 col-md-8 col-sm-9" role="search">
                    <input class="form-control me-2 text-primary" type="search" placeholder="Ej.Iphone" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>

                </form>
            </div>
        </nav>

    </div>
    </div>
    
        <!-- Hasta aquí la barra de navegación-->

        <div class="d-flex bg-body-tertiary ">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary col-lg-6 col-sm-12">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"> <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                    <span class="fs-4">Mi sitio</span>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item"> <a href="#" class="nav-link active" aria-current="page">
                                <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Inicio
                            </a> </li>
                        <li> <a href="#" id="misProductos" class="nav-link link-body-emphasis"><svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                Mis productos
                            </a> </li>
                        <li> <a href="mostrar.php" class="nav-link link-body-emphasis"> <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#table"></use>
                                </svg>
                                Favoritos
                            </a> </li>
                        <li> <a href="#" class="nav-link link-body-emphasis"> <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                Products
                            </a> </li>
                        <li> <a href="#" class="nav-link link-body-emphasis"> <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true">
                                    <use xlink:href="#people-circle"></use>
                                </svg>
                                Vendedores
                            </a> </li>
                    </ul>
                    <hr>
            </div>


            <div id="carouselExampleInterval" class="carousel slide text-center flex-shrink-0 p-3 bg-body-tertiary col-lg-6 col-sm-12" data-bs-ride="carousel">
                <div class="carousel-inner text-center">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="imagenes/manos.jpg" class="d-block w-100 img-fluid " alt="Foto de ROMAN ODINTSOV: https://www.pexels.com/es-es/foto/manos-sujetando-cartulina-carton-12725405/">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="imagenes/electronica.jpg" class="d-block w-100 img-fluid" alt="Foto de ATC Comm Photo: https://www.pexels.com/es-es/foto/primer-plano-de-la-camara-sobre-fondo-negro-306763/">
                    </div>
                    <div class="carousel-item">
                        <img src="imagenes/moto.jpg" class="d-block w-100 img-fluid" alt="Foto de Pragyan Bezbaruah: https://www.pexels.com/es-es/foto/motocicleta-en-medio-de-la-carretera-1715193/">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!--  Añadimos las cards con los articulos guardados-->

        <div class="container my-5 ">
            <h1 id="titulo2">Catálogo de Productos</h1>
            <div class="row" id="cards-container">
            </div>
        </div>

        <div class="container my-5 ">
            <h1 id=titulo1>Mis productos</h1>
            <div class="row" id="cards-container2">
            </div>
        </div>

        <script>
            window.onload = function() {
                const loader = document.querySelector('.loader');
                loader.style.transition = 'opacity 0.5s ease'; // Transición para el desvanecimiento
                loader.style.opacity = '0'; // Hace que el loader se desvanezca

                // Opcional: Eliminar el loader del DOM después de la transición
                setTimeout(() => {
                    loader.remove();
                }, 500);
            };
        </script>


    </body>

    </html>

<?php
} else {

    echo "<script>alert('Registrese para acceder.');</script>";

    header("Location: index.php");
}
