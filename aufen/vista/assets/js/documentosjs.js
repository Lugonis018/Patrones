var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    loadDataTableDocumentos();
    tooltip();
    rgDocumento();
}

function rgDocumento() {  
  $('#formregistro').submit(function(event){
  event.preventDefault();
  var titulo = $("#titulo").val();
  var descripcion = $("#descripcion").val();
  var archivo = $("#archivo").val();

  if (titulo == null || titulo.length == 0) {
    $("#campotitulo").addClass("has-error");
    alert("Por favor ingresa el titulo");
    return false;
  }
  else {
    $("#campotitulo").removeClass("has-error");
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
    $("#campotitulo").removeClass("has-error");    
  }*/

    $("#notificacion").html("");
    var formData = new FormData(document.getElementById("formregistro"));
            formData.append("action", "insert");
    /*var datos = "action=insert&" + $("#formregistro").serialize();
    $.post("../controlador/documentosController.php", datos, function(data) {        
        $('#notificacion').html(data);
        $('#notificacion').fadeIn();  
    });*/
    jQuery.ajax({
      url: "../controlador/documentosController.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        $('#notificacion').html(data);
        $('#notificacion').fadeIn();  
      }
  });    
  });
}

function upDocumento() {         
    $("#mensaje").html("");
    var formData = new FormData(document.getElementById("formactualizar"));
            formData.append("action", "savedata");
            jQuery.ajax({
              url: "../controlador/documentosController.php",
              type: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                $('#mensaje').html(data);
                $('#mensaje').fadeIn();
              }
          }); 
}

function traeDatosDocumentoId(documento) {
  $("#mensaje").html("");
  $('#contenido-update').html("");
  var id    = documento.id;
  var datos = "action=update&id="+id ;
  $.post("../controlador/documentosController.php", datos, function(data) {
      $('#contenido-update').html(data);        
  });
}

function mostrarDocumento(documento){
  var url = documento.id;
  window.open(url);
}

function delDocumento(documento) { 
    if(confirm('¿Seguro que desea eliminar este tocumento?')){
      $("#mensaje-delete").html("");
      var id    = documento.id;
      var datos = "action=delete&id="+id ;
      $.post("../controlador/documentosController.php", datos, function(data) {
          $('#mensaje-delete').prepend(data);
          $('#mensaje-delete').show('slow');
          $('#mensaje-delete').fadeOut(5000);  
      });     
    } 
}

function loadDocumentos() {
    $('#contenido').html("");
    $.post("pdf.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  

function tooltip() {
   $('[data-toggle="tooltip"]').tooltip(); 
}

function loadDataTableDocumentos() {
  $('#example').DataTable( {  
    "bDeferRender": true,
    "ajax": "../controlador/loadListController.php?action=documentos",        
    "columns": [
    { "data" : "id" },
    { "data" : "titulo" },
    { "data" : "descripcion" },
    { "data" : "tamanio"},
    { "data" : "tipo"},
    { "data" : "nombre"},
    { "data" : "trabajos_id"},
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
