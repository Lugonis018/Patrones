<?php
require_once '../Modelo//UTIL/ConexionBD.php';
require_once 'CRUD.php';
 
class TrabajoDAO implements CRUD {
    
    private $con;

    function __construct() {
        $this->con=  conexionBD::conectar();
    }

    function __destruct() {
        $this->con->close();
    }

    
    public function listar(){
        $data = "";
        $statement = "SELECT * FROM trabajos";
        $query= $this->con->query($statement);
        
        
        return $query;
    }
    

    public function agregar(){

    }
    public function eliminar(){

    }
    public function actualizar(){

    }
}