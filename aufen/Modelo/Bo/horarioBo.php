<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Dao/horarios/horariosDao.php';


class horarioBo {
 
    
    var $dao;

    function __construct() {
        $this->dao=new horariosDao();
    }

    function registrarHorarioBo($usuarios_id, $trabajos_id, $fecha_asignacion) {
        $resultado = $this->dao->registrarHorarioDao($usuarios_id, $trabajos_id, $fecha_asignacion);
        return $resultado;
    }

    function traeHorarioBo(){
        $resultado = $this->dao->traeHorarioDao();
        return $resultado;
    }

    function actualizarhorarioBo($id) {
        $resultado = $this->dao->actualizarHorarioDao($id);
        return $resultado;
    }

    function saveDataHorarioBo($id, $usuarios_id, $trabajos_id, $fecha_asignacion) {
        $resultado = $this->dao->saveDataHorarioDao($id, $usuarios_id, $trabajos_id, $fecha_asignacion);
        return $resultado;
    }

    function eliminarHorarioBo($id) {
        $resultado = $this->dao->eliminarHorarioDao($id);
        return $resultado;
    }
    
}
