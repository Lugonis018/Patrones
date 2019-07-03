<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/procesaParametros.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/trabajos/trabajosSql.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/vista/logicavista/notificationView.php';

class trabajoDao {

    private $con;

    function __construct() {
        $this->con=  conexion::conectar();
    }
    function __destruct() {
        $this->con->close();
    }

    /*function logoutDao() {
        session_start(); 
        session_destroy(); 
        print "<script>window.location='../index.php';</script>";  
    }

    function sessionValidateDao() {
        session_start(); 
        if (!isset($_SESSION['tipo'])) {
            print "<script>window.location='../index.php';</script>";  
        } 
    }

    function sessionUserTypeDao($type) {
        if ($_SESSION['tipo'] != $type) {
            print "<script>window.location='main.php';</script>";  
        } 
    }*/

    /*function  identificarUsuarioDao($usuario, $password) 
    {

        $datosArray=array($usuario,$password);

        if( $usuario == '' || $usuario === NULL || is_null($usuario) || $password == '' || $password === NULL || is_null($password) )
        {
          
            $result = Notification::requiredFields();

        } 
        else
        {

            $st = procesaParametros::PrepareStatement(usuariosSql::indentificarUsuario(),$datosArray);
            $query=$this->con->query($st);

            if($query->num_rows==0)
            {

                $result = Notification::incorrectCredentials();

            } 
            else 
            {

                $row = mysqli_fetch_array($query); 

                if ($row['status'] != 0) 
                {

                    session_start();
                    $_SESSION['idusuario']   = $row['id']; 
                    $_SESSION['nombre']      = $row['apaterno'].' '.$row['amaterno'].' '.$row['nombre']; 
                    $_SESSION['tipo']        = $row['tipo'];               
                    $result = "<script>window.location='main.php';</script>"; 

                } 
                else 
                { 

                    $result = Notification::disableUser();                

                }
            }            
        }  

        return $result;     
    }*/

    function  registrarTrabajoDao($nombre, $descripcion, $fecha_inicio, $status, $tipo_trabajo){
      $datosArray=array($nombre);
      $st=  procesaParametros::PrepareStatement(TrabajosSql::validateIfExistsTrabajo(),$datosArray);

      $query=$this->con->query($st);

      if($query->num_rows==0)
      {
        $st = "INSERT INTO trabajos(nombre, descripcion, fecha_inicio, fecha_fin, status, Tipos_trabajo_id) 
        VALUES('$nombre', '$descripcion', '$fecha_inicio', NULL, $status, $tipo_trabajo)";

        $query = $this->con->query($st); 
        $result = Notification::registeredRecord($query);

      } 
      else
      {
        $result = Notification::existsTrabajo();
      }
      return $result;
    }

    function saveDataTrabajoDao($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $tipo_trabajo) {
      $st = "UPDATE trabajos SET nombre='$nombre', descripcion='$descripcion', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', status=$status, Tipos_trabajo_id=$tipo_trabajo WHERE id = $id";
      $query = $this->con->query($st); 
      $result = Notification::updatedRecord($query);
      return $result;
    }

    function eliminarTrabajoDao($id) {
      $st = "DELETE FROM trabajos WHERE id='$id'";
      $query = $this->con->query($st); 
      $result = Notification::deletedRecord($query);
       return $result;
    }

    function traeTrabajosDao() {

      $data = "";
      $st = "SELECT * FROM trabajos";
      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {
      
      $editar = '<a href=\"#\" data-toggle=\"modal\" data-target=\"#myModalActualiza\" id=\"'.$row['id'].'\" onclick=\"traeDatosTrabajoId(this)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
      $eliminar = '<a href=\"#\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" id=\"'.$row['id'].'\" onclick=\"delTrabajo(this)\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';
        
        switch ($row['status']) {
            case 1:
                $estadotrabajo='Activo';
                break;
            case 0:
                $estadotrabajo='Inactivo';
                break;
            default:
                $estadotrabajo='Sigues rompiendolo';
                break;
      }
        $st1 = "SELECT nombre FROM `tipos_trabajo` WHERE id = " . $row['Tipos_trabajo_id'] ;
        $query= $this->con->query($st1);
        $row1 =  mysqli_fetch_array($query);
        $data.='{
              "id":"'.$row['id'].'",
              "nombre":"'.$row['nombre'].'",
              "descripcion":"'.$row['descripcion'].'",
              "fecha_inicio":"'.$row['fecha_inicio'].'",
              "fecha_fin":"'.$row['fecha_fin'].'",
              "status":"'.$estadotrabajo.'",
              "tipo":"'.$row1['nombre'].'",
              "acciones":"'.$editar.$eliminar.'"
            },';
    }
        $data = substr($data,0, strlen($data) - 1);
        $result =  '{"data":['.$data.']}';

        return $result;
    }

    function actualizarTrabajoDao($id) {
      $cad = "";
      $st = "SELECT * FROM trabajos WHERE id = '$id'";

      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {

        $cad = '
            <fieldset>
                <div class="form-group"> 
                    <input type="hidden" class="form-control" name="a" value="'.$row['id'].'">                           
                    <div class="col-lg-4">
                        <div class="form-group" id="camponombre">
                            <label class="control-label" for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="b" autofocus value="'.$row['nombre'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="campodescripcion">
                            <label class="control-label" for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="c" value="'.$row['descripcion'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="campofecha_inicio">
                            <label class="control-label" for="fecha_inicio">Fecha de Inicio</label>
                            <input type="datetime-local" class="form-control" id="fecha_inicio" name="d" value="'.$row['fecha_inicio'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="campofecha_fin">
                            <label class="control-label" for="fecha_fin">Fecha de Fin</label>
                            <input type="datetime-local" class="form-control" id="fecha_fin" name="j" value="'.$row['fecha_fin'].'" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="campoStatus">
                            <select class="form-control" id="status" name="l">
                                <option selected value="'.$row['status'].'">--Click para cambiar--</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>                                       
                            </select>                                    
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="form-group" id="campoTiposTrabajoId">
                            <select class="form-control" id="tiposTrabajoId" name="m">
                                <option selected value="'.$row['Tipos_trabajo_id'].'">--Click para cambiar--</option>
                                <option value="1">Tipos de trabajo 1</option>
                                <option value="2">Tipos de trabajo 2</option>
                                <option value="3">Tipos de trabajo 3</option>
                            </select>                                    
                        </div>
                    </div>                            
                    <div class="col-lg-4 col-lg-offset-8">
                        <div class="form-group">
                              <a href="#" class="btn btn-primary btn-block" onclick="upTrabajo()">Actualizar</a>
                        </div>
                    </div>
                </div>   
            </fieldset>
        ';

    }
    return $cad;
    }
}
