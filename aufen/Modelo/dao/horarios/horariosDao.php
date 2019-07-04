<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/procesaParametros.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/modelo/dao/horarios/horariosSql.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta.'/vista/logicavista/notificationView.php';


class horariosDao {
  
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

    function  registrarHorarioDao($usuarios_id,$trabajos_id,$fecha_asignacion){
      $datosArray=array($usuarios_id);
      $st=  procesaParametros::PrepareStatement(horariosSql::validateIfExistsHorario(),$datosArray);

      $query=$this->con->query($st);

      if($query->num_rows==0)
      {
        $st = "INSERT INTO asignar(usuarios_id,Trabajos_id, fecha_asignacion) 
        VALUES('$usuarios_id', '$trabajos_id', '$fecha_asignacion')";

        $query = $this->con->query($st); 
        $result = Notification::registeredRecord($query);

      } 
      else
      {
        $result = Notification::existsTrabajo();
      }
      return $result;
    }

    function saveDataHorarioDao($id, $usuarios_id,$trabajos_id,$fecha_asignacion) {
      $st = "UPDATE asignar SET usuarios_id='$usuarios_id', Trabajos_id='$trabajos_id', fecha_asignacion='$fecha_asignacion'  WHERE id = $id";
      $query = $this->con->query($st); 
      $result = Notification::updatedRecord($query);
      return $result;
    }

    function eliminarHorarioDao($id) {
      $st = "DELETE FROM asignar WHERE id='$id'";
      $query = $this->con->query($st); 
      $result = Notification::deletedRecord($query);
       return $result;
    }

    function traeHorarioDao() {

      $data = "";
      $st = "SELECT * FROM asignar";
      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {
        $editar = '<a href=\"#\" data-toggle=\"modal\" data-target=\"#myModalActualiza\" id=\"'.$row['id'].'\" onclick=\"traeDatosHorarioId(this)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Editar\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>';
        $eliminar = '<a href=\"#\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Eliminar\" id=\"'.$row['id'].'\" onclick=\"delHorario(this)\" class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>';
        
        $st = "SELECT nombre FROM usuarios WHERE id=".$row['usuarios_id'];
        $query1= $this->con->query($st); 
        $row1 =  mysqli_fetch_array($query1);

        $st = "SELECT nombre FROM trabajos WHERE id=".$row['Trabajos_id'];
        $query2= $this->con->query($st);
        $row2 =  mysqli_fetch_array($query2);

        $data.='{
              "id":"'.$row['id'].'",
              "usuarios_id":"'.$row1['nombre'].'",
              "trabajos_id":"'.$row2['nombre'].'",
              "fecha_asignacion":"'.$row['fecha_asignacion'].'",
              "acciones":"'.$editar.$eliminar.'"
            },';
    }
        $data = substr($data,0, strlen($data) - 1);
        $result =  '{"data":['.$data.']}';

        return $result;
    }

    function actualizarHorarioDao($id) {
      $cad = "";
      $st = "SELECT * FROM asignar WHERE id = '$id'";

      $query= $this->con->query($st); 

      while ($row =  mysqli_fetch_array($query) ) {

        $cad = '
            <fieldset>
                <div class="form-group"> 
                    <input type="hidden" class="form-control" name="a" value="'.$row['id'].'">                           
                    <div class="col-lg-4">
                        <div class="form-group" id="campousuarioid">
                            <label class="control-label" for="usuarios_id">Empleado</label>
                            <input type="text" class="form-control" id="usuarios_id" name="b" autofocus value="'.$row['usuarios_id'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="campotrabajoid">
                            <label class="control-label" for="trabajos_id">Trabajo</label>
                            <input type="text" class="form-control" id="trabajos_id" name="c" value="'.$row['Trabajos_id'].'" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" id="campofecha">
                            <label class="control-label" for="fecha_asignacion">Fecha de Asignacion</label>
                            <input type="datetime-local" class="form-control" id="fecha_asignacion" name="d" value="'.$row['fecha_asignacion'].'" required>
                        </div>
                    </div>
                   
                                       
                    <div class="col-lg-4 col-lg-offset-8">
                        <div class="form-group">
                              <a href="#" class="btn btn-primary btn-block" onclick="upHorario()">Actualizar</a>
                        </div>
                    </div>
                </div>   
            </fieldset>
        ';

    }
    return $cad;
    }
}
