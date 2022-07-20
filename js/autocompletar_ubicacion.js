/*AUTOCOMPLETAR PROVINCIA*/
$(function() {
    $("#provincia").autocomplete({
        source: "./ajax/autocompletar/provincias.php",
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $('#provincia').val(ui.item.nom_provincia);	
            $('#id_provincia').val(ui.item.cod_provincia);
            $('#id_regional').val(ui.item.cod_regional);
        }
    });
});
$("#provincia" ).on( "change", function( event ) {
    if($('#id_provincia').val()===""){
        reset_ubicacion();
    }
});
$("#provincia" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        reset_ubicacion_global();
    }
});
function reset_ubicacion_global(){
    $("#provincia" ).val("");
    $("#id_provincia" ).val("");
    $("#id_regional" ).val("");
    reset_ubicacion_media();
}
//AUTOCOMPLETAR CANTÓN
$("#canton").autocomplete({
    source: function( request, response ) {
    $.ajax({
     url: "./ajax/autocompletar/cantones.php",
     type: 'post',
     dataType: "json",
     data: {
      term: request.term,
      prov : $('#id_provincia').val()
     },
     success: function( data ) {
      response( data );
     }
    });
   },
    minLength: 2,
    select: function(event, ui) {
        event.preventDefault();
        $('#canton').val(ui.item.nom_canton);	
        $('#id_canton').val(ui.item.cod_canton);
    }
});
$("#canton" ).on( "change", function( event ) {
    if($('#id_canton').val()===""){
        reset_ubicacion_media();
    }
});
$("#canton" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        reset_ubicacion_media();
    }
});
function reset_ubicacion_media(){
    $("#canton" ).val("");
    $("#id_canton" ).val("");
    reset_ubicacion();
}
//AUTOCOMPLETAR PARROQUIA
$("#parroquia").autocomplete({
    source: function( request, response ) {
    $.ajax({
     url: "./ajax/autocompletar/parroquias.php",
     type: 'post',
     dataType: "json",
     data: {
      term: request.term,
      can : $('#id_canton').val()
     },
     success: function( data ) {
      response( data );
     }
    });
   },
    minLength: 2,
    select: function(event, ui) {
        event.preventDefault();
        $('#parroquia').val(ui.item.nom_parroquia);	
        $('#id_parroquia').val(ui.item.cod_parroquia);
    }
});
$("#parroquia" ).on( "change", function( event ) {
    if($('#id_parroquia').val()===""){
        reset_ubicacion();
    }
});
$("#parroquia" ).on( "keydown", function( event ) {
    if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
    {
        reset_ubicacion();
    }
});
function reset_ubicacion(){
    $("#parroquia" ).val("");
    $("#id_parroquia" ).val("");
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
                    $("#id_canton").val(item.id_canton);
                    $("#canton").val(item.canton);
                    $("#id_parroquia").val(item.id_parroquia);
                    $("#parroquia").val(item.parroquia);
                    $("#id_provincia").val(item.id_provincia);
                    $("#provincia").val(item.provincia);
                    $("#id_regional").val(item.id_regional);
                    $("#direccion").val(item.direccion);
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

