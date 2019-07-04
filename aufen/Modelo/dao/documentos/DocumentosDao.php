<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/procesaParametros.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/documentos/documentosSql.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/vista/logicavista/notificationView.php';

class documentosDao {

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

  function registrarDocumento($titulo,$descri,$tamanio,$tipo,$nombre,$descripcion){
    if ($nombre != "") {
            $sql = "INSERT INTO tbl_documentos(titulo,descripcion,tamanio,tipo,nombre_archivo,descripcion) VALUES('$titulo','$descri','$tamanio','$tipo','$nombre',$descripcion)";
            $query = $this->execute($sql);
            if($query){
                $result = "Se guardo correctamente";
            }
    }
    return $result;
  }
  #"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
  function  registrarDocumentoDao($titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id){
    $datosArray=array($trabajos_id);
    $st=  procesaParametros::PrepareStatement(documentosSql::validateIfExistsHorario(),$datosArray);

    $query=$this->con->query($st);

    if($query->num_rows==0)
    {
      $st = "INSERT INTO `tbl_documentos` (`titulo`, `descripcion`, `tamanio`, `tipo`, `nombre_archivo`, `Trabajos_id`)
      VALUES('$titulo', '$descripcion', '$tamanio','$tipo','$nombre',$trabajos_id)";

      $query = $this->con->query($st); 
      $result = Notification::registeredRecord($query);

    } 
    else
    {
      $result = Notification::existsTrabajo();
    }
    return $result;
  }

  function saveDataDocumentoDao($id,$titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id) {
    $st = "UPDATE `tbl_documentos` SET `titulo`='$titulo',`descripcion`='$descripcion',`tamanio`='$tamanio',`tipo`='$tipo',`nombre_archivo`='$nombre',`Trabajos_id`=$trabajos_id WHERE id_documento= $id";
    $query = $this->con->query($st); 
    $result = Notification::updatedRecord($query);
    return $result;
  }
  function saveDataDocumentoSinFileDao($id,$titulo,$descripcion) {
    $st = "UPDATE `tbl_documentos` SET `titulo`='$titulo',`descripcion`='$descripcion' WHERE id_documento = $id";
    $query = $this->con->query($st); 
    $result = Notification::updatedRecord($query);
    return $result;
  }

  function eliminarDocumentoDao($id) {
    $st = "DELETE FROM tbl_documentos WHERE id_documento=$id";
    $query = $this->con->query($st); 
    $result = Notification::deletedRecord($query);
     return $result;
  }

  function traeDocumentoDao() {

    $data = "";
    $st = "SELECT * FROM tbl_documentos";
    $query= $this->con->query($st); 

    while ($row =  mysqli_fetch_array($query) ) {
      $ver = '<a href=\"#\" data-toggle=\"modal\" data-target=\"#Ver\" id=\"../vista/archivos/'.$row['nombre_archivo'].'\"  onclick=\"mostrarDocumento(this)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver\" class=\"btn btn-primary\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></a>';
      $editar = '<a href=\"#\" data-toggle=\"modal\" data-target=\"#myModalActualiza\" id=\"'.$row['id_documento'].'\" onclick=\"traeDatosDocumentoId(this)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
      $eliminar = '<a href=\"#\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" id=\"'.$row['id_documento'].'\" onclick=\"delDocumento(this)\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';

      $st = "SELECT nombre FROM trabajos WHERE id=".$row['Trabajos_id'];
      $query2= $this->con->query($st);
      $row2 =  mysqli_fetch_array($query2);

      $data.='{
            "id":"'.$row['id_documento'].'",
            "titulo":"'.$row['titulo'].'",
            "descripcion":"'.$row['descripcion'].'",
            "tamanio":"'.$row['tamanio'].'",
            "tipo":"'.$row['tipo'].'",
            "nombre":"'.$row['nombre_archivo'].'",
            "trabajos_id":"'.$row2['nombre'].'",
            "acciones":"'.$ver.$editar.$eliminar.'"
          },';
  }
      $data = substr($data,0, strlen($data) - 1);
      $result =  '{"data":['.$data.']}';

      return $result;
  }

  
  function actualizarDocumentoDao($id) {
    $cad = "";
    $st = "SELECT * FROM tbl_documentos WHERE id_documento = $id";

    $query= $this->con->query($st); 

    while ($row =  mysqli_fetch_array($query) ) {

      $cad = '
          <fieldset>
              <div class="form-group"> 
                  <input type="hidden" class="form-control" name="a" value="'.$row['id_documento'].'"> 
                  <input type="hidden" class="form-control" name="e" value="'.$row['Trabajos_id'].'">                           
                  <div class="col-lg-6">
                      <div class="form-group" id="campotitulo">
                          <label class="control-label" for="titulo">Cambiar título</label>
                          <input type="text" class="form-control" id="titulo" name="b" autofocus value="'.$row['titulo'].'" required>
                      </div>
                  </div>
                  <div class="col-lg-8">
                      <div class="form-group" id="campodescripcion">
                          <label class="control-label" for="descripcion">Cambiar descripción</label>
                          <textarea class="form-control" id="descripcion" name="c"  required>'.$row['descripcion'].'</textarea>
                      </div>
                  </div>
                  <div class="col-lg-8">
                      <div class="form-group" id="campoarchivo">
                          <label class="control-label" for="archivo">Subir documento</label>
                          <input type="file" class="form-control-file" id="archivo" name="d" required>
                      </div>
                  </div>
                 
                                     
                  <div class="col-lg-4 col-lg-offset-8">
                      <div class="form-group">
                            <a href="#" class="btn btn-primary btn-block" onclick="upDocumento()">Actualizar</a>
                      </div>
                  </div>
              </div>   
          </fieldset>
      ';

  }
  return $cad;
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
