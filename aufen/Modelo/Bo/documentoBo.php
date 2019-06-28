<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Dao/documentos/documentosDao.php';

class usuarioBo {

    var $dao;

    function __construct() {
        $this->dao=new documentoDao();
    }

    function execute($query) {       
          $resultado = $this->dao->execute($query);
          return $resultado;
    }

    function registrarDocumento($titulo,$descri,$tamanio,$tipo,$nombre,$Trabajos_id){
        $resultado = $this->dao->registrarDocumento($titulo,$descri,$tamanio,$tipo,$nombre,$Trabajos_id);
        return $resultado;
    }


    public function fetch_row($q_id = "") {
        $resultado = $this->dao->fetch_row($q_id);
        return $resultado;
    } 

    public function get_num_rows() {
        $resultado = $this->dao->get_num_rows();
        return $resultado;
    }

    public function get_row_affected(){
        $resultado = $this->dao->get_row_affected();
        return $resultado;
    }

    public  function get_insert_id() {
        $resultado = $this->dao->get_insert_id();
        return $resultado;
    }

    public  function free_result($q_id) {
        $resultado = $this->dao->free_result($q_id);
        return $resultado;
    } 

    public function close_db(){
        $resultado = $this->dao->close_db();
        return $resultado;
    }

    public function more_result() {
        $resultado = $this->dao->more_result();
        return $resultado;
    }
    public function next_result() {
        $resultado = $this->dao->next_result();
        return $resultado;
    }

}
?>
