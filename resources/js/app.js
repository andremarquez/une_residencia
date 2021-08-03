require('./bootstrap');

var $ = require( "jquery" );
window.$ = $
window.jQuery = $

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


window.accionActual = ''

window.setAccion = function(url, mensaje){
    window.accionActual = url
    $('#mensajeModal').html(mensaje)
}


window.aplicarAccion = function(){

    
    

    if(window.accionActual) {
        
        $.ajax({
            url: window.accionActual,
            type: 'POST',
            contentType:'application/json',
            success: function(result) {
                
                try {
                    $('#ventanamodal').modal('hide');
                } catch (error) {
                    
                }
                
                alert('Accion aplicada exitosamente');
                
                window.location.reload()
                

                
            },
            error: function(result){
                alert('Ocurrio un error');
            }
        }
        );

        
        /*

        if(window.accionActual) {
            window.location.replace(accionActual)
        }*/
    }
    
}