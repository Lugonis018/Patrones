<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/documentoBo.php';

switch ($_POST['action']) {
    case 'subir':
        $nombre = $_FILES['archivo']['name'];
        $tipo = $_FILES['archivo']['type'];
        $tamanio = $_FILES['archivo']['size'];
        $ruta = $_FILES['archivo']['tmp_name'];
        $destino = "archivos/" . $nombre;
        if ($nombre != "") {
            if (copy($ruta, $destino)) {
                $titulo= $_POST['titulo'];
                $descri= $_POST['descripcion'];
                $bo = new documentoBo();
                $r = $bo->registrarDocumento($titulo,$descri,$tamanio,$tipo,$nombre,$Trabajos_id);
            } else {
                $r = "Error";
            }
        }
        print $r;
        break; 

}