<?php
require_once "../ruta.php";
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/usuarioBo.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/trabajoBo.php';
require_once $_SERVER['DOCUMENT_ROOT'].ruta::ruta. '/Modelo/Bo/horarioBo.php';

switch ($_GET['action']) {
	case "users":  
		$bo = new usuarioBo();
		$r = $bo->traeUsuariosBo();
		print $r;
		break;
	case "trabajos":  
		$bo = new trabajoBo();
		$r = $bo->traeTrabajosBo();
		print $r;
		break;
	case "horarios":  
		$bo = new horarioBo();
		$r = $bo->traeHorarioBo();
		print $r;
		break;
}
          

  