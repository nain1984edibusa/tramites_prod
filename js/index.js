/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

var refreshButton = document.querySelector(".refresh-captcha");
refreshButton.onclick = function() {
  document.querySelector(".captcha-image").src = './includes/captcha.php?' + Date.now();
}
$("#tipo_identificacion" ).on( "change", function( event ) {
    $("#identificacion").val("");
    $("#identificacion").focus();
    reset_formulario();
});
$("#registrarse" ).on( "click", function( event ) {
    $("#tipo_identificacion").val("");
    reset_formulario();
});
function reset_formulario(){
    $("#identificacion").val("");
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#telefono").val("");
    $("#direccion").val("");
    $("#email").val("");
    $("#clave").val("");
    $("#reclave").val("");
    $("#txtcaptcha").val("");
    $("#btn_registrarse").prop('disabled', true);
    reset_ubicacion_global();
}
$("#identificacion").blur(function() {
    if ($("#tipo_identificacion").val()!=="PASAPORTE"){
        //if($("#identificacion").val().length<10){
        //    $("#identificacion").focus();
        //}else{
            if(($("#tipo_identificacion").val()==="RUC")&&($("#identificacion").val().length!==13)){ //RUC
                $("#identificacion").focus();
            }else if(($("#tipo_identificacion").val()==="CI")&&($("#identificacion").val().length!==10)){ //CI
                $("#identificacion").focus();
            }else if(validar_ci_ruc($("#identificacion").val())==false) 
            {   
                $("#identificacion").val("");
                $("#identificacion").focus();
            }
        //}
    }
});
$("#identificacion").change(function(){
    if($("#tipo_identificacion").val()==="RUC"){
        $.ajax({
            type: "POST",
            url: "ajax/obtener_datos_RUCws.php",
            data: 'ruc='+$("#identificacion").val(),
            success: function(datos){
                var data = $.parseJSON(datos);
                var ubicacion="";
                $.each(data, function(i, item) {
                    var razonSocial=item.razonSocial.split(' ');
                    var apellidos=razonSocial[0]+" "+razonSocial[1];
                    var nombres="";
                    for(var j=2;j<razonSocial.length;j++){
                        nombres +=razonSocial[j]+" ";
                    }
                    nombres=nombres.slice(0,-1);
                    $('#nombres').val(nombres);
                    $('#apellidos').val(apellidos);
                    $('#direccion').val(item.direccionCorta);
                    $('#email').val(item.email);
                    ubicacion=item.desUbicaGeograf.split('\\');
                    cargar_ubicacion(ubicacion);
                });
            }
        }); 
    }
    if($("#tipo_identificacion").val()==="CI"){
           $.ajax({
            type: "POST",
            url: "ajax/obtener_datos_CIws.php",
            data: 'ci='+$("#identificacion").val(),
            success: function(datos){
                var data = $.parseJSON(datos);
                var ubicacion="";
                $.each(data, function(i, item) {
                    var nombre=item.Nombre.split(' ');
                    var apellidos=nombre[0]+" "+nombre[1];
                    var nombres="";
                    for(var j=2;j<nombre.length;j++){
                        nombres +=nombre[j]+" ";
                    }
                    nombres=nombres.slice(0,-1);
                    $('#nombres').val(nombres);
                    $('#apellidos').val(apellidos);
                    ubicacion=item.Domicilio.split('/');
                    cargar_ubicacion(ubicacion);
                });
            }
        }); 
    }
});
function cargar_ubicacion(ubicacion){
    var parroquia=ubicacion[ubicacion.length-1].trim();
    var canton=ubicacion[ubicacion.length-2].trim();
    var provincia=ubicacion[ubicacion.length-3].trim();
    var caux;
    $.ajax({
        type: "POST",
        url: "ajax/obtener_provincia.php",
        data: 'provincia='+provincia,
        success: function(datos){
            var data = $.parseJSON(datos);
            $.each(data, function(i, item) {
                    $('#provincia').val(item.nom_provincia);	
                    $('#id_provincia').val(item.cod_provincia);
                    $('#id_regional').val(item.cod_regional);
                    caux=item.cod_provincia;
                    $('#canton').focus();
            });
            $.ajax({
            type: "POST",
            url: "ajax/obtener_canton.php",
            data: 'provincia='+caux+"&canton="+canton,
            success: function(datos){
                    var data = $.parseJSON(datos);
                    $.each(data, function(j, item2) {
                        $('#canton').val(item2.nom_canton);	
                        $('#id_canton').val(item2.cod_canton);
                        caux=item2.cod_canton;
                        $('#parroquia').focus();
                    });
                    $.ajax({
                    type: "POST",
                    url: "ajax/obtener_parroquia.php",
                    data: "canton="+caux+"&parroquia="+parroquia,
                    success: function(datos){
                            var data = $.parseJSON(datos);
                            $.each(data, function(k, item3) {
                                $('#parroquia').val(item3.nom_parroquia);	
                                $('#id_parroquia').val(item3.cod_parroquia);
                                $('#telefono').focus();
                            });
                        }
                    });
                }
            });
        }
    });
}
/*ACCIONES AL MOSTRAR Y OCULTAR MODAL DE REGISTRO*/
$('#ModalRegistroUsuario').on('shown.bs.modal', function () {
    $('#tipo_identificacion').focus();
});
$('#ModalRegistroUsuario').on('hidden.bs.modal', function (e) {
    $('#txtusu').focus();
});

//verificar clave (inicial=confirmado)
$("#reclave" ).on( "change", function( event ) {
    if($('#clave').val()!==$('#reclave').val()){
        alert("Las claves no son iguales. Por favor, vuela a ingresarlas");
        $('#clave').val("");
        $('#reclave').val("");
    }
});
$("#txtcaptcha").on("change", function( event ) {
    $.ajax({
        type: "POST",
        url: "ajax/verificar_captcha.php",
        data: 'cpt='+$("#txtcaptcha").val(),
        success: function(datos){
            if(datos==="1"){
                $('#btn_registrarse').attr("disabled", false);
            }else{
                alert("El texto captcha ingresado es erróneo");
                $("#txtcaptcha").val("");
                $('#btn_registrarse').attr("disabled", true);
            }
            //$('#actualizar_datos').attr("disabled", false); //ACTIVAR BOTÓN DE ENVIAR
        }
    });
});


