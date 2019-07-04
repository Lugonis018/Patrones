<?php 
require_once "../controlador/sessionValidate.php";
require_once "../controlador/sessionUserTypeAdmin.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Portal de Documentos</title>
    <!--CSS-->    
    <link rel="stylesheet" href="assets/css/bootstrap-yeti.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.css">

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache"> 
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
            <h1>Documentos                
                <a href="" data-toggle="modal" data-target="#myModal"  class="btn btn-success pull-right menu"><i class="fa fa-user-plus " aria-hidden="true"></i>&nbsp;Subir</a>
            </h1>  
        </div>
        <div class="row">    
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th>ID de Documento</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Tamaño</th>
                <th>Tipo</th>
                <th>Nombre del archivo</th>
                <th>Trabajo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>ID de Documento</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Tamaño</th>
                <th>Tipo</th>
                <th>Nombre del archivo</th>
                <th>Trabajo</th>
                <th>Acciones</th>
            </tr>
            </tfoot>
        </table>        
        </div>
    </div>
    <!-- END DATATABLE -->

    <!-- MODAL REGISTER -->
    <div class="modal fade in" id="myModal" >
        <div class="modal-dialog" style="width:50%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h4 class="modal-title"><b></b>Subir documento</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid" id="notificacion"></div>
                    <form id="formregistro"> 
                        <fieldset>
                            <div class="form-group">                            
                            <div class="col-lg-4">
                                    <div class="form-group" id="campoidtrabajo">
                                        <label class="control-label" for="trabajos_id">Id del trabajo</label>
                                        <input type="text" class="form-control" id="trabajos_id" name="trabajos_id" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" id="campotitulo">
                                        <label class="control-label" for="titulo">Título</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" autofocus>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" id="campodescripcion">
                                        <label class="control-label" for="descripcion">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" ></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group" id="campoarchivo">
                                        <label class="control-label" for="archivo">Archivo</label>
                                        <input type="file" id="archivo" name="archivo" >
                                    </div>
                                </div>                          
                                <div class="col-lg-4 col-lg-offset-8">
                                    <div class="form-group">
                                         <button type="submit" class="btn btn-primary btn-block">Subir</button>                                     
                                    </div>
                                </div>
                            </div>   
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">                
                </div>
            </div>
        </div>
     </div>
     <!-- END MODAL REGISTER -->

     <!-- MODAL UPDATE -->
    <div class="modal fade in" id="myModalActualiza" >
        <div class="modal-dialog" style="width:50%;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b></b>Actualizar Documento</h4>
                </div>
                <div class="modal-body">
                    <div class="row-fluid" id="mensaje"></div>
                    <form id="formactualizar">
                    <div id="contenido-update"></div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL UPDATE -->

    <!--Javascript-->    
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap.min.js"></script>          
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/documentosjs.js"></script>
    <!--<script src="https://gist.github.com/oswaldoacauan/7580474.js"></script>-->
    <script type="text/javascript">
$(document).ready(function() { 
    var options = { target: '#output' }; 
    $('#my-form').submit(function() { 
        $(this).ajaxSubmit(options); 
        return false; 
    });
}); 
</script>
   
</body>
</html>