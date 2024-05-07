<?php
    require('includes/Computadora.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' ) {
          
         computadora::get_all_computadoras();
        
        
    }


?>