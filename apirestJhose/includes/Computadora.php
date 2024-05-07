<?php
require_once('Database.php');

class computadora{



    public static function get_all_computadoras()
    {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM computadora');       
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            echo json_encode($result);
            header('HTTP/1.1 201 lista de computadora');
        }else{
            header('HTTP/1.1  ');
        }

    }
    public static function create_computadoras($nombre_modelo, $fabricante, $precio, $procesador)
    {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('INSERT INTO computadora (nombre_modelo, fabricante , precio, procesador) VALUES (:nombre_modelo, :fabricante, :precio, :procesador)');
        $stmt->bindParam(':nombre_modelo', $nombre_modelo);
        $stmt->bindParam(':fabricante', $fabricante); 
        $stmt->bindParam(':precio', $precio); 
        $stmt->bindParam(':procesador', $procesador);  
        if($stmt->execute()){
            header('HTTP/1.1 201 computadora agregado ');
        }else{
            header('HTTP/1.1 ');
        }
    

    }
    
    public static function delete_computadoras($id){
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('DELETE  FROM computadora WHERE id=:id');
        $stmt->bindParam(':id',$id);

        if($stmt->execute()){
            header('HTTP/1.1 201 computadora eliminado de la lista');
        }else{
            header('HTTP/1.1 201 ');
        }
    
    }
     public static function update_computadoras($id, $nombre_modelo, $fabricante, $precio, $procesador){
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('UPDATE computadora SET nombre_modelo=:nombre_modelo, fabricante =:fabricante, precio=:precio, procesador =:procesador WHERE id=:id');
        $stmt->bindParam(':nombre_modelo', $nombre_modelo);
        $stmt->bindParam(':fabricante', $fabricante); 
        $stmt->bindParam(':precio', $precio); 
        $stmt->bindParam(':procesador', $procesador);  
        $stmt->bindParam(':id', $id);  
        
        if($stmt->execute()){
            header('HTTP/1.1 201 computadora actualizado ');
        }else{
            header('HTTP/1.1 500 no se ha podido actualizar la computadora ');
        }
    
        
     }    
     
     public static function get_id_computadoras($id){
        $database = new Database();
        $conn = $database->getConnection();
    
        $stmt = $conn->prepare('SELECT * FROM computadora WHERE id = :id');
        $stmt->bindParam(':id',$id);
        
    
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            header('HTTP/1.1 202 ok');
            echo json_encode($result);
            return json_encode($result);
        } else {
            header('HTTP/1.1 401 fallo');
            echo "Error en el listado";
        }
    }
}
?>