/*AUTOCOMPLETAR PROVINCIA*/
$(function() {
    $("#mod_provincia").autocomplete({
        source: "./ajax/autocompletar/provincias.php",
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $('#mod_provincia').val(ui.item.nom_provincia);	
            $('#id_provincia_mod').val(ui.item.cod_provincia);
            $('#id_regional_mod').val(ui.item.cod_regional);
        }
    });
});
$("#mod_provincia" ).on( "change", function( event ) {
    if($('#id_provincia_mod').val()===""){
        reset_ubicacion();
    }
});
$("#mod_provincia" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        reset_ubicacion_global();
    }
});
function reset_ubicacion_global(){
    $("#mod_provincia" ).val("");
    $("#id_provincia_mod" ).val("");
    $("#id_regional_mod" ).val("");
    reset_ubicacion_media();
}
//AUTOCOMPLETAR CANTÓN
$("#mod_canton").autocomplete({
    source: function( request, response ) {
    $.ajax({
     url: "./ajax/autocompletar/cantones.php",
     type: 'post',
     dataType: "json",
     data: {
      term: request.term,
      prov : $('#id_provincia_mod').val()
     },
     success: function( data ) {
      response( data );
     }
    });
   },
    minLength: 2,
    select: function(event, ui) {
        event.preventDefault();
        $('#mod_canton').val(ui.item.nom_canton);	
        $('#id_canton_mod').val(ui.item.cod_canton);
    }
});
$("#mod_canton" ).on( "change", function( event ) {
    if($('#id_canton_mod').val()===""){
        reset_ubicacion_media();
    }
});
$("#mod_canton" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        reset_ubicacion_media();
    }
});
function reset_ubicacion_media(){
    $("#mod_canton" ).val("");
    $("#id_canton_mod" ).val("");
    reset_ubicacion();
}
//AUTOCOMPLETAR PARROQUIA
$("#mod_parroquia").autocomplete({
    source: function( request, response ) {
    $.ajax({
     url: "./ajax/autocompletar/parroquias.php",
     type: 'post',
     dataType: "json",
     data: {
      term: request.term,
      can : $('#id_canton_mod').val()
     },
     success: function( data ) {
      response( data );
     }
    });
   },
    minLength: 2,
    select: function(event, ui) {
        event.preventDefault();
        $('#mod_parroquia').val(ui.item.nom_parroquia);	
        $('#id_parroquia_mod').val(ui.item.cod_parroquia);
    }
});
$("#mod_parroquia" ).on( "change", function( event ) {
    if($('#id_parroquia').val()===""){
        reset_ubicacion();
    }
});
$("#mod_parroquia" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        reset_ubicacion();
    }
});
function reset_ubicacion(){
    $("#mod_parroquia" ).val("");
    $("#id_parroquia_mod" ).val("");
}
//IGUAL UBICACIÓN QUE EL DOMICILIO
$("#ubicacion_domiciliaria" ).on("change", function(event) {
    if($('#ubicacion_domiciliaria').prop('checked')) {
        $.ajax({
            type: "POST",
            url: "./ajax/obtener_usuario.php",
            data: 'usuario='+$("#id_usuario").val(),
            success: function(datos){
                var data = $.parseJSON(datos);
                $.each(data, function(i, item) {
                    $("#id_canton_mod").val(item.id_canton);
                    $("#mod_canton").val(item.canton);
                    $("#id_parroquia_mod").val(item.id_parroquia);
                    $("#mod_parroquia").val(item.parroquia);
                    $("#id_provincia_mod").val(item.id_provincia);
                    $("#mod_provincia").val(item.provincia);
                    $("#id_regional_mod").val(item.id_regional);
                    $("#mod_direccion").val(item.direccion);
                    $("#codigo_inventario").focus();
                });
            }
        }); 
    }else{
        $("#id_canton").val("");
        $("#canton").val("");
        $("#id_parroquia").val("");
        $("#parroquia").val("");
        $("#id_provincia").val("");
        $("#provincia").val("");
        $("#id_regional").val("");
        $("#direccion").val("");
        $("#provincia").focus();
    }
});

