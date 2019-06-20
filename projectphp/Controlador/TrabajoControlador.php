<?php

require_once '../Modelo/DAO/TrabajoDAO.php';
switch ($_GET['action']) {
    case 'listar':
        
        $dao = new TrabajoDAO();
        $r = $dao->Listar();
        while ($row = mysqli_fetch_array($r)) {
            echo $row['id'];
        }
        break;
    
    default:
        # code...
        break;
}
