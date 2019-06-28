<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Dao/trabajos/trabajosDao.php';

class trabajoBo {

    var $dao;

    function __construct() {
        $this->dao=new trabajoDao();
    }

    /*
    function identificarUsuarioBo($usuario, $password) {
        $resultado = $this->dao->identificarUsuarioDao($usuario, $password);
        return $resultado;
    }
    */

    function registrarTrabajoBo($nombre, $descripcion, $fecha_inicio, $status, $tipo_trabajo) {
        $resultado = $this->dao->registrarTrabajoDao($nombre, $descripcion, $fecha_inicio, $status, $tipo_trabajo);
        return $resultado;
    }

    function traeTrabajosBo(){
        $resultado = $this->dao->traetrabajosDao();
        return $resultado;
    }

    function actualizartrabajoBo($id) {
        $resultado = $this->dao->actualizarTrabajoDao($id);
        return $resultado;
    }

    function saveDataTrabajoBo($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $tipo_trabajo) {
        $resultado = $this->dao->saveDataTrabajoDao($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $tipo_trabajo);
        return $resultado;
    }

    function eliminarTrabajoBo($id) {
        $resultado = $this->dao->eliminarTrabajoDao($id);
        return $resultado;
    }

    /*
    function logoutBo() {
        $resultado = $this->dao->logoutDao();
        return $resultado;
    }
    

    function sessionValidateBo() {
        $resultado = $this->dao->sessionValidateDao();
        return $resultado;
    }

    function sessionUserTypeBo($type) {
        $resultado = $this->dao->sessionUserTypeDao($type);
        return $resultado;
    }
    */
}
?>
