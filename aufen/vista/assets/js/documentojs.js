var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    loadDataTableTrabajos();
    tooltip();
    rgTrabajo();
}

function rgTrabajo() {  
  $('#formregistro').submit(function(event){
  event.preventDefault();
  var nombre = $("#nombre").val();
  var descripcion = $("#descripcion").val();
  var fecha_inicio =$("#fecha_inicio").val();
  var status = 1;//1:Activo
  var tipo_trabajo = $("#tiposTrabajoId").val();  
  
  if (nombre == null || nombre.length == 0) {
    $("#camponombre").addClass("has-error");
    alert("Por favor ingresa el nombre");
    return false;
  }
  else {
    $("#camponombre").removeClass("has-error");
  }
  
  if (descripcion == null || descripcion.length == 0) {
    $("#campodescripcion").addClass("has-error");
    alert("Por favor ingresa la descripcion");
    return false;
  }else {
    $("#campodescripcion").removeClass("has-error");
  }

  /*if (fecha_inicio == null || fecha_inicio.length == 0) {
    $("#campofecha_inicio").addClass("has-error");
    alert("Por favor ingresa una fecha")
    return false;
  }else {
    $("#camponombre").removeClass("has-error");    
  }*/

    $("#notificacion").html("");
    var datos = "action=insert&" + $("#formregistro").serialize();
    $.post("../controlador/trabajosController.php", datos, function(data) {        
        $('#notificacion').html(data);
        $('#notificacion').fadeIn();  
    });    
  });
}

function upTrabajo() {         
    $("#mensaje").html("");
    var datos = "action=savedata&" + $("#formactualizar").serialize();
    $.post("../controlador/trabajosController.php", datos, function(data) {        
        $('#mensaje').html(data);
        $('#mensaje').fadeIn();
    });
}

function traeDatosTrabajoId(trabajo) {
  $("#mensaje").html("");
  $('#contenido-update').html("");
  var id    = trabajo.id;
  var datos = "action=update&id="+id ;
  $.post("../controlador/trabajosController.php", datos, function(data) {
      $('#contenido-update').html(data);        
  });
}

function delTrabajo(trabajo) { 
    if(confirm('¿Seguro que desea eliminar este trabajo?')){
      $("#mensaje-delete").html("");
      var id    = trabajo.id;
      var datos = "action=delete&id="+id ;
      $.post("../controlador/trabajosController.php", datos, function(data) {
          $('#mensaje-delete').prepend(data);
          $('#mensaje-delete').show('slow');
          $('#mensaje-delete').fadeOut(5000);  
      });     
    } 
}

function loadTrabajos() {
    $('#contenido').html("");
    $.post("trabajos.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  

function tooltip() {
   $('[data-toggle="tooltip"]').tooltip(); 
}

function loadDataTableTrabajos() {
  $('#example').DataTable( {  
    "bDeferRender": true,
    "ajax": "../controlador/loadListController.php?action=trabajos",        
    "columns": [
    { "data" : "id" },
    { "data" : "nombre" },
    { "data" : "descripcion" },
    { "data" : "fecha_inicio"},
    { "data" : "fecha_fin"},
    { "data" : "status"},
    { "data" : "tipo"},
    { "data" : "acciones"}
    ],      
    "sPaginationType": "full_numbers",          
    "oLanguage": {
            "sProcessing":     "Procesando...",
        "sLengthMenu": 'Mostrar <select>'+
            '<option value="10">10</option>'+
            '<option value="20">20</option>'+
            '<option value="30">30</option>'+
            '<option value="40">40</option>'+
            '<option value="50">50</option>'+
            '<option value="-1">Todos</option>'+
            '</select> registros',    
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Filtrar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Por favor espere - cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        }
  });
}
