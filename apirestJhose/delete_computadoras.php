<?php 
require_once('includes/Computadora.php');

if($_SERVER['REQUEST_METHOD']== 'DELETE' && isset($_GET['id'])){
    computadora::delete_computadoras($_GET['id']);
}
?>