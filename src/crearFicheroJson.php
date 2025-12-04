<?php

    function creaYactualiza($usuario){

    header('Content-Type: application/json');

    //require ("../config/database.php");

      require_once ("../public/Usuario.php");


   
    //session_start();

    $resultado= $usuario->crearFichero();


    $datos = array();

    $datos = $resultado;
       

    $json_string = json_encode($datos, JSON_PRETTY_PRINT);

        $fichero = '../public/datos_usuario.json';

    if (file_put_contents($fichero, $json_string, LOCK_EX) !== false) {
    echo "El array JSON se ha copiado correctamente al archivo: $fichero";
    
// Comprueba si la cabecera Referer existe


} else {
    echo "Error al escribir el archivo.";
}



}

?>


