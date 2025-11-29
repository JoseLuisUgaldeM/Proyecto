<?php 

require("../config/Database.php");

require ("../public/Articulos.php");


session_start(); // Iniciamos la sesión y traemos las variables globales del usuario


$database = new Database();

$db = $database->getConnection();

if ($_SESSION['inicioSesion'] == true){



if(isset($_POST['publicar'])){

    $titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    $id_usuario = $_SESSION['id_usuario'];
    
    $articulo = new Articulos($database);

    $articulo->subirArticulo($id_usuario, $titulo,$descripcion,$categoria, $estado);


     header("Location: ../public/sesionIniciada.php");
 
}

    

}else{

        echo "<script>alert('Registrese o inicie sesión para acceder.');</script>";

        header("Location: index.php");

}

?>
