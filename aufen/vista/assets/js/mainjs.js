var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    loadUsers(); 
    loadTrabajos();
    loadDocumentos();       
}
function loadUsers() {
    $('#contenido').html("");
    $.post("users.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  
function loadTrabajos() {
    $('#contenido').html("");
    $.post("trabajos.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
} 
function loadDocumentos() {
    $('#contenido').html("");
    $.post("PDF.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
}  
function loadHorarios() {
    $('#contenido').html("");
    $.post("horarios.php", function(response) {        
        $('#contenido').html(response);
        $('#contenido').fadeIn();
    });
} 