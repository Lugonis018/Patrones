<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/vista/logicavista/notificationView.php';

class trabajoDao {

  private $con;
  var $q_id ="";
  var $ExeBit  ="";
  var $db_connect_id = "";
  var $query_count   = 0;

  function __construct() {
      $this->con=  conexion::conectar();
  }
  function __destruct() {
      $this->con->close();
  }


  function execute($query) {       
          $this->q_id = $this->con->query($query);        
          if(!$this->q_id ) {
              $error1 = $this->con->error;
              die ("ERROR: error DB.<br> No Se Puede Ejecutar La Consulta:<br> $query <br>MySql Tipo De Error: $error1");
              exit;
          }         
    $this->query_count++; 
    return $this->q_id;    
  }

  function registrarDocumento($titulo,$descri,$tamanio,$tipo,$nombre,$Trabajos_id){
    if ($nombre != "") {
            $sql = "INSERT INTO tbl_documentos(titulo,descripcion,tamanio,tipo,nombre_archivo,Trabajos_id) VALUES('$titulo','$descri','$tamanio','$tipo','$nombre',$Trabajos_id)";
            $query = $this->execute($sql);
            if($query){
                $result = "Se guardo correctamente";
            }
    }
    return $result;
  }

  public function fetch_row($q_id = "") {
        if ($q_id == "") {
          $q_id = $this->q_id;
        }
          $result = $this->con->fetch_array($q_id);
          return $result;
  } 

  public function get_num_rows() {
          return $this->con->num_rows($this->q_id);
  }

  public function get_row_affected(){
      return $this->con->affected_rows($this->con);
  }

  public  function get_insert_id() {
      return $this->con->insert_id($this->con);
  }

  public  function free_result($q_id) {
        if($q_id == ""){
          $q_id = $this->q_id;
      }
    $this->con->free_result($q_id);
  } 

  public function close_db(){
          return $this->con->close($this->con);
  }

  public function more_result() {
      return $this->con->more_results($this->con);
    }
  public function next_result() {
      return $this->con->next_result($this->con);
  }
}
