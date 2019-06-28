<?php 
require_once "../controlador/sessionValidate.php"; 
require_once "../controlador/sessionUserTypeAdmin.php";

include_once '../Modelo/dao/config.inc.php';

if (isset($_POST['subir'])) {
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamanio = $_FILES['archivo']['size'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "archivos/" . $nombre;
    if ($nombre != "") {
        if (copy($ruta, $destino)) {
            $titulo= $_POST['titulo'];
            $descri= $_POST['descripcion'];
            $db=new Conect_MySql();
            $sql = "INSERT INTO tbl_documentos(titulo,descripcion,tamanio,tipo,nombre_archivo) VALUES('$titulo','$descri','$tamanio','$tipo','$nombre')";
            $query = $db->execute($sql);
            if($query){
                echo "Se guardo correctamente";
            }
        } else {
            echo "Error";
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Principal</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap-yeti.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />    
</head>
<body>
    
                
<div class="container">
        <div class="row">
         
        </div>
        <div class="row">            
            <div id="mensaje-delete"></div>            
            <h1>Subir documentos               
               
            </h1>  
        </div>
        <div class="row">    
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>A. materno</th>
                <th>Nombre</th>               
                
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th><input type="text" name="titulo"></th>
                <th><textarea name="descripcion"></textarea></th>
                <th><input type="file" name="archivo"></th>
                <th><input class="btn btn-success pull-right menu"  type="submit" value="subir" name="subir"></th>               
                 <th><a href="lista.php">lista de pdf</a></th>
            </tr>
            </tfoot>
        </table>        
        </div>
    </div>
                
                
            <div class="row">            
            <div id="mensaje-delete"></div>            
            <h2>Documentos                 
               
            </h2>  
        </div>                  
                            
            <div class="col-md-12 text-center">
                <a href="PDF.php" class="btn btn-info" >&nbsp;Refrescar</a>
            </div>       
                            
          
            </form>
            
            <br>
            <br>
             <br>
            <br>
           
            
             <div class="row">    
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                  <th>titulo</th>
                  <th>descripcion</th>
                <th>tamaño</th>
                <th>tipo</th>
                <th>nombre</th>
             
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
        
            
                      <?php
       
        $db=new Conect_MySql();
            $sql = "select*from tbl_documentos";
            $query = $db->execute($sql);
            while($datos=$db->fetch_row($query)){?>
            <tr>
                <th><?php echo $datos['titulo']; ?></th>
                <th><?php echo $datos['descripcion']; ?></th>
                <th><?php echo $datos['tamanio']; ?></th>
                <th><?php echo $datos['tipo']; ?></th>
                <th><a href="archivo.php?id=<?php echo $datos['id_documento']?>"><?php echo $datos['nombre_archivo']; ?></a></th>
            </tr>
                
          <?php  } ?> 
          
            </tfoot>
        </table>        
        </div>
            
            
            
            
            
            
            
      
                         <!-- <object data="SG53-chatbots.pdf" type="application/pdf" width="100%" height="1050px">                           
                         </object> -->
                        </div>                   
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                </div>
                 <!-- /. PAGE INNER  -->
                </div>
             <!-- /. PAGE WRAPPER  -->
            </div>
         <!-- /. WRAPPER  -->
    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/appjs.js"></script>
    <script src="assets/js/mainjs.js"></script>
</body>
</html>
        