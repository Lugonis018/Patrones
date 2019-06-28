<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/trabajoBo.php';

switch ($_POST['action']) {
    case 'insert':
        $nombre  = $_POST['nombre'];
        $descripcion  = $_POST['descripcion'];
        $fecha_inicio    = $_POST['fecha_inicio'];
        $status   = 1;
        $tipo_trabajo     = $_POST['tiposTrabajoId'];

        $bo = new trabajoBo();
        $r = $bo->registrarTrabajoBo($nombre, $descripcion, $fecha_inicio, $status, $tipo_trabajo);
        print $r;
        break; 

    case 'update':
        $id = $_POST['id'];

        $bo = new TrabajoBo();
        $r = $bo->actualizarTrabajoBo($id);
        print $r;
        break; 

    case 'savedata':
        $id        = $_POST['a']; 
        $nombre  = $_POST['b'];
        $descripcion  = $_POST['c'];
        $fecha_inicio    = $_POST['d'];
        $fecha_fin   = $_POST['j'];
        $status     = $_POST['l'];
        $tipo_trabajo      = $_POST['m'];

        $bo = new trabajoBo();
        $r = $bo->saveDataTrabajoBo($id, $nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $tipo_trabajo);
        print $r;
        break;

    case 'delete':
        $id = $_POST['id'];

        $bo = new trabajoBo();
        $r = $bo->eliminarTrabajoBo($id);
        print $r;
        break;
    case 'select':
        $bo = new trabajoBo();
        $r = $bo->traeTrabajosBo();
        print $r;
        break;
}