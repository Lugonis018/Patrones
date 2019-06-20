<?php

require_once '../Modelo/DAO/TrabajoDAO.php';
switch ($_GET['action']) {
    case 'listar':
        
        $dao = new TrabajoDAO();
        $r = $dao->listar();
        
        include_once '../Vista/Trabajos/TrabajoTabla.php';
        
        break;
    
    case 'insertar':
        /*
        $apaterno  = $_POST['apaterno'];
        $amaterno  = $_POST['amaterno'];
        $nombre    = $_POST['nombre'];
        $usuario   = $_POST['usuario'];
        $clave     = $_POST['clave'];
        $tipo      = $_POST['tipo'];
        $status    = $_POST['status'];

        $bo = new usuarioBo();
        $r = $bo->registrarUsuarioBo($apaterno, $amaterno, $nombre, $usuario, $clave, $tipo, $status);
        print $r;*/
        
        break;
    case 'eliminar':
        /*
        $dao = new TrabajoDAO();
        $r = $dao->eliminar();
        require_once '../Vista/Trabajos/TrabajoTabla.php';
        */
        break;
    case 'actualizar':
        /*
        $dao = new TrabajoDAO();
        $r = $dao->actualizar();
        require_once '../Vista/Trabajos/TrabajoTabla.php';
        */
        break;
    default:
        # code...
        break;
}
    