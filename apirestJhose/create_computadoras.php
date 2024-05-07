<?php
    
    require_once('includes/Computadora.php');
    //header('Access-Control-Allow-Origin: *');

    if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['nombre_modelo']) && isset($_POST['fabricante']) && isset($_POST['precio']) && isset($_POST['procesador'])) {

        computadora::create_computadoras($_POST['nombre_modelo'], $_POST['fabricante'], $_POST['precio'], $_POST['procesador']);
        
    } else {
        echo 'No se encontraron todos los datos necesarios';
    }
?>
