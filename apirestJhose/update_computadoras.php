
<?php
require('includes/Computadora.php');


parse_str(file_get_contents("php://input"), $_PUT);

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_PUT['nombre_modelo']) && isset($_PUT['fabricante']) && isset($_PUT['precio']) && isset($_PUT['procesador']) && isset($_PUT['id'] )) {
    Computadora::update_computadoras($_PUT['id'], $_PUT['nombre_modelo'], $_PUT['fabricante'], $_PUT['precio'], $_PUT['procesador']);
} else {
    echo 'No se han proporcionado todos los datos necesarios para la actualización';
}

?>