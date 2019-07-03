var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    loadDataTableHorarios();
    tooltip();
    rgHorario();
}

function rgHorario() {  
  $('#formregistro').submit(function(event){
  event.preventDefault();
  var usuarios_id = $("#usuarios_id").val();
  var trabajos_id = $("#trabajos_id").val();
  var fecha_asignacion =$("#fecha_asignacion").val();
   
  
  if (usuarios_id == null || usuarios_id.length == 0) {
    $("#campousuarioid").addClass("has-error");
    alert("Por favor ingresa el id del usuario");
    return false;
  }
  else {
    $("#campousuarioid").removeClass("has-error");
  }
  
  
  if (trabajos_id == null || trabajos_id.length == 0) {
    $("#campotrabajoid").addClass("has-error");
    alert("Por favor ingresa el trabajo id");
    return false;
  }else {
    $("#campotrabajoid").removeClass("has-error");
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
    $.post("../controlador/horariosController.php", datos, function(data) {        
        $('#notificacion').html(data);
        $('#notificacion').fadeIn();  
    });    
  });
}

function upHorario() {         
    $("#mensaje").html("");
    var datos = "action=savedata&" + $("#formactualizar").serialize();
    $.post("../controlador/horariosController.php", datos, function(data) {        
        $('#mensaje').html(data);
        $('#mensaje').fadeIn();
    });
}

function traeDatosHorarioId(horario) {
  $("#mensaje").html("");
  $('#contenido-update').html("");
  var id    = horario.id;
  var datos = "action=update&id="+id ;
  $.post("../controlador/horariosController.php", datos, function(data) {
      $('#contenido-update').html(data);        
  });
}

function delHorario(horario) { 
    if(confirm('¿Seguro que desea eliminar este horario')){
      $("#mensaje-delete").html("");
      var id    = horario.id;
      var datos = "action=delete&id="+id ;
      $.post("../controlador/horariosController.php", datos, function(data) {
          $('#mensaje-delete').prepend(data);
          $('#mensaje-delete').show('slow');
          $('#mensaje-delete').fadeOut(5000);  
      });     
    } 
}

function loadHorarios() {
    $('#contenido').html("");
    $.post("horarios.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  

function tooltip() {
   $('[data-toggle="tooltip"]').tooltip(); 
}




function loadDataTableHorarios() {
  $('#example').DataTable( {  
    "bDeferRender": true,
    "ajax": "../controlador/loadListController.php?action=horarios",        
    "columns": [
    { "data" : "id" },
    { "data" : "usuarios_id" },
    { "data" : "trabajos_id" },
    { "data" : "fecha_asignacion"},
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







