<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/documentoBo.php';

switch ($_POST['action']) {
    case 'insert':
        $trabajos_id = $_POST['trabajos_id'];
        $nombre = $_FILES['archivo']['name'];
        $tipo = $_FILES['archivo']['type'];
        $tamanio = $_FILES['archivo']['size'];
        $ruta = $_FILES['archivo']['tmp_name'];
        $destino = $_SERVER['DOCUMENT_ROOT'].ruta::ruta. "/vista/archivos/" . $nombre;
        if ($nombre != "") {
            if (copy($ruta, $destino)) {
                $titulo= $_POST['titulo'];
                $descri= $_POST['descripcion'];
                $bo = new documentoBo();
                $r = $bo->registrarDocumentoBo($titulo,$descri,$tamanio,$tipo,$nombre,$trabajos_id);
            } else {
                $r = "Error";
            }
        }
        print $r;
        break; 

    case 'update':
        $id = $_POST['id'];

        $bo = new documentoBo();
        $r = $bo->actualizarDocumentoBo($id);
        print $r;
        break; 

    case 'savedata':

        $id        = $_POST['a']; 
        $titulo  = $_POST['b'];
        $descripcion  = $_POST['c'];
        $trabajos_id = $_POST['e'];
        if ($_FILES['d']['name'] != null) {
            $nombre = $_FILES['d']['name'];
            $tipo = $_FILES['d']['type'];
            $tamanio = $_FILES['d']['size'];
            $ruta = $_FILES['d']['tmp_name'];
            $destino = $_SERVER['DOCUMENT_ROOT'].ruta::ruta. "/vista/archivos/" . $nombre;
            if ($nombre != "") {
                if (copy($ruta, $destino)) {
                    
                    $bo = new documentoBo();
                    $r = $bo->saveDataDocumentoBo($id,$titulo,$descripcion,$tamanio,$tipo,$nombre,$trabajos_id);
                } else {
                    $r = "Error";
                }
            }
        
        } else {
                    $bo = new documentoBo();
                    $r = $bo->saveDataDocumentoSinFileBo($id,$titulo,$descripcion);
        }
        print $r;
        break;

    case 'delete':
        $id = $_POST['id'];

        $bo = new documentoBo();
        $r = $bo->eliminarDocumentoBo($id);
        print $r;
        break;
    case 'select':
        $bo = new documentoBo();
        $r = $bo->traeDocumentoBo();
        print $r;
        break;

}