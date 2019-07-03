<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/horarioBo.php';

switch ($_POST['action']) {
    case 'insert':
        $usuarios_id  = $_POST['usuarios_id'];
        $trabajos_id  = $_POST['trabajos_id'];
        $fecha_asignacion = $_POST['fecha_asignacion'];
        
       

        $bo = new horarioBo();
        $r = $bo->registrarHorarioBo($usuarios_id, $trabajos_id, $fecha_asignacion);
        print $r;
        break; 

    case 'update':
        $id = $_POST['id'];

        $bo = new horarioBo();
        $r = $bo->actualizarhorarioBo($id);
        print $r;
        break; 

    case 'savedata':
        $id        = $_POST['a']; 
        $usuarios_id  = $_POST['b'];
        $trabajos_id  = $_POST['c'];
        $fecha_asignacion    = $_POST['d'];
    

        $bo = new horarioBo();
        $r = $bo->saveDataHorarioBo($id, $usuarios_id, $trabajos_id, $fecha_asignacion);
        print $r;
        break;

    case 'delete':
        $id = $_POST['id'];

        $bo = new horarioBo();
        $r = $bo->eliminarHorarioBo($id);
        print $r;
        break;
    case 'select':
        $bo = new horarioBo();
        $r = $bo->traeHorarioBo();
        print $r;
        break;
}