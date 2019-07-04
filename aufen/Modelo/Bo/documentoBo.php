<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/aufen/ruta.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Dao/documentos/documentosDao.php';

class documentoBo {

    var $dao;

    function __construct() {
        $this->dao=new documentosDao();
    }

    function registrarDocumentoBo($titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id) {
        $resultado = $this->dao->registrarDocumentoDao($titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id);
        return $resultado;
    }

    function traeDocumentoBo(){
        $resultado = $this->dao->traeDocumentoDao();
        return $resultado;
    }

    function actualizarDocumentoBo($id) {
        $resultado = $this->dao->actualizarDocumentoDao($id);
        return $resultado;
    }

    function saveDataDocumentoBo($id,$titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id) {
        $resultado = $this->dao->saveDataDocumentoDao($id,$titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id);
        return $resultado;
    }

    function saveDataDocumentoSinFileBo($id,$titulo,$descripcion) {
        $resultado = $this->dao->saveDataDocumentoSinFileDao($id,$titulo,$descripcion);
        return $resultado;
    }

    function eliminarDocumentoBo($id) {
        $resultado = $this->dao->eliminarDocumentoDao($id);
        return $resultado;
    }

}
?>
