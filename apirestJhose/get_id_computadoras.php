<?php
    require('includes/Computadora.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' && isset($_GET['id'])) {
          
         computadora::get_id_computadoras($_GET['id']);
        
    }else{
        echo 'Nose envio el Id';
    }


?>