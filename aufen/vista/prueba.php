<?php 
require_once "../controlador/sessionValidate.php";
require_once "../controlador/sessionUserTypeAdmin.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Documentos</title>
    <!--CSS-->    
    <link rel="stylesheet" href="assets/css/bootstrap-yeti.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
</head>
<body>

    <div id="response"></div>

    <!-- DATATABLE -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-info" onclick="loadDocumentos()"><i class="fa fa-refresh"></i>&nbsp;Refrescar</a>
            </div>
        </div>
        <div class="row">            
            <div id="mensaje-delete"></div>            
            <h1>Documentos           gaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa     
                <a href="" data-toggle="modal" data-target="#myModal"  class="btn btn-success pull-right menu"><i class="fa fa-user-plus " aria-hidden="true"></i>&nbsp;Nuevo usuario</a>
            </h1>  
        </div>
        <div class="row">    
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th>ID de Documento</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Documento</th>
                <th>Acciones</th>
                <th>Listar<th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="id_documento"></td>
                <td><input type="text" name="titulo"></td>
                <td><textarea name="descripcion"></textarea></td>
                <td><input type="file" name="archivo"></td>
                <td><input class="btn btn-success pull-right menu"  type="submit" value="subir" name="subir"></td>               
                <td><a href="#">lista de pdf</a></td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>ID de Documento</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Documento</th>
                <th>Acciones</th>
                <th>Listar<th>
            </tr>
            </tfoot>
        </table>        
        </div>
    </div>
    <!-- END DATATABLE -->


    <!--Javascript-->    
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>          
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>