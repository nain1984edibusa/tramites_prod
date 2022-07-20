/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*FUNCIONES GENERALES*/
/*TIPEO SOLO NÚMEROS*/
function valida_solonumeros(e){ 
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if ((tecla==8)|(tecla == 13)){
        return true;
    }   
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
/*TIPEO NÚMEROS Y GUIÓN MEDIO*/
function valida_numeros_guion(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if ((tecla==8)|(tecla==189)|(tecla == 13)){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9\-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
/*TIPEO NÚMEROS 2 ENTEROS CON DOS DECIMALES*/
function valida_num2dec2(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if ((key == 8)|(key==13)) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    var index = field.value.indexOf('.');
    if (index > 0) {
                         var CharAfterdot = (field.value.length + 1) - index;
                         if (CharAfterdot > 3) {
                             return false;
                         }
                     }
    regexp = /.[0-9]{5}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
}
/*TIPEO NÚMEROS 2 ENTEROS CON CUATRO DECIMALES*/
function valida_num2dec4(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if ((key == 8)|(key==13))  return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    var index = field.value.indexOf('.');
    if (index > 0) {
                         var CharAfterdot = (field.value.length + 1) - index;
                         if (CharAfterdot > 5) {
                             return false;
                         }
                     }
    regexp = /.[0-9]{5}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
}
/*TIPEO NÚMEROS CON DOS DECIMALES*/
function valida_numndec2(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if ((key == 8)|(key==13))  return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    var index = field.value.indexOf('.');
    if (index > 0) {
                         var CharAfterdot = (field.value.length + 1) - index;
                         if (CharAfterdot > 3) {
                             return false;
                         }
                     }
    regexp = /.[0-9]{5}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
 
}
/*RECARGAR ORIGEN/PADRE*/
function recargar_padre()
{
    parent.location.reload();
}
/*VALIDAR PRESIÓN DE TECLA ENTER*/
function validar_enter(e) { 
  if(e.which == 13) {
            return false;
    } 
}
/*VALIDAR CI Y RUC*/
function validar_ci_ruc(campo){
numero = campo;
if(numero=="9999999999999"){
    return true;
}else{
var suma = 0;
var residuo = 0;
var pri = false;
var pub = false;
var nat = false;
var numeroProvincias = 22;
var modulo = 11;


/* Aqui almacenamos los digitos de la cedula en variables. */
d1 = numero.substr(0,1);
d2 = numero.substr(1,1);
d3 = numero.substr(2,1);
d4 = numero.substr(3,1);
d5 = numero.substr(4,1);
d6 = numero.substr(5,1);
d7 = numero.substr(6,1);
d8 = numero.substr(7,1);
d9 = numero.substr(8,1);
d10 = numero.substr(9,1);

/* El tercer digito es: */
/* 9 para sociedades privadas y extranjeros */
/* 6 para sociedades publicas */
/* menor que 6 (0,1,2,3,4,5) para personas naturales */

if (d3==7 || d3==8){
alert('El tercer dígito ingresado es inválido');
return false;
}

/* Solo para personas naturales (modulo 10) */
if (d3 < 6){
nat = true;
p1 = d1 * 2; if (p1 >= 10) p1 -= 9;
p2 = d2 * 1; if (p2 >= 10) p2 -= 9;
p3 = d3 * 2; if (p3 >= 10) p3 -= 9;
p4 = d4 * 1; if (p4 >= 10) p4 -= 9;
p5 = d5 * 2; if (p5 >= 10) p5 -= 9;
p6 = d6 * 1; if (p6 >= 10) p6 -= 9;
p7 = d7 * 2; if (p7 >= 10) p7 -= 9;
p8 = d8 * 1; if (p8 >= 10) p8 -= 9;
p9 = d9 * 2; if (p9 >= 10) p9 -= 9;
modulo = 10;
}

/* Solo para sociedades publicas (modulo 11) */
/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
else if(d3 == 6){
pub = true;
p1 = d1 * 3;
p2 = d2 * 2;
p3 = d3 * 7;
p4 = d4 * 6;
p5 = d5 * 5;
p6 = d6 * 4;
p7 = d7 * 3;
p8 = d8 * 2;
p9 = 0;
}

/* Solo para entidades privadas (modulo 11) */
else if(d3 == 9) {
pri = true;
p1 = d1 * 4;
p2 = d2 * 3;
p3 = d3 * 2;
p4 = d4 * 7;
p5 = d5 * 6;
p6 = d6 * 5;
p7 = d7 * 4;
p8 = d8 * 3;
p9 = d9 * 2;
}

suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
residuo = suma % modulo;

/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
digitoVerificador = residuo==0 ? 0: modulo - residuo;

/* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
if (pub==true){
if (digitoVerificador != d9){
alert('El ruc de la empresa del sector público es incorrecto.');
return false;
}
/* El ruc de las empresas del sector publico terminan con 0001*/
if ( numero.substr(9,4) != '0001' ){
alert('El ruc de la empresa del sector público debe terminar con 0001');
return false;
}
}
else if(pri == true){
if (digitoVerificador != d10){
alert('El ruc de la empresa del sector privado es incorrecto.');
return false;
}
if ( numero.substr(10,3) != '001' ){
alert('El ruc de la empresa del sector privado debe terminar con 001');
return false;
}
}

else if(nat == true){
if (digitoVerificador != d10){
alert('El número de cédula de la persona natural es incorrecto.');
return false;
}
if (numero.length >10 && numero.substr(10,3) != '001' ){
alert('El ruc de la persona natural debe terminar con 001');
return false;
}
}
return true;
}
}
function toFix(num, precision) {
    var res= (Math.round(num * 100 )/100).toFixed(2);
    return res;
}
function toFix_(num, precision) {
    var res= (Math.round(num * 100 )/100).toFixed(precision);
    return res;
}

/*function _data_last_month_day($mes) { 
      $month=get_mes_num($mes);
      //$month = date('m');
      //$year = date('Y');
      $year=$_SESSION['periodo'];
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
      return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
  };
 
function _data_first_month_day($mes) {
  $month=get_mes_num($mes);
  //$month = date('m');
  //$year = date('Y');
  $year = $_SESSION['periodo'];
  return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
}*/

/*COPIAR TEXTO EN PORTAPAPELES*/
function copytext(id_elemento){
    var aux = document.createElement("input");
    aux.setAttribute("id","claveaccesocopy");
    aux.setAttribute("value", $("#"+id_elemento).val());
    document.body.appendChild(aux);
    aux.select();
    if(document.execCommand("copy")){
        alert("El texto fue copiado en portapapeles");
    }else{
        alert("Ocurrió un error, vuelva a intentarlo");
    }
    document.body.removeChild(aux);
}
/*VALIDAR LONGITUD*/
function validar_longitud(tipo,texto){
    
}
/*RECORRER FORMULARIO CON ENTER*/
$('body').on('keydown', 'input, select, a', function(e) {   //, a , button
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            //form.submit();
        }
        return false;
    }
});
$('#input').one("keydown", function () {
    $(this).val("");
});
/*FUNCIONES ESPECÍFICAS DE USO COMPARTIDO*/
function obtener_auditoria(id_tramite_usuario){
    $.ajax({
        type: "POST",
        url: "ajax/obtener_auditoria.php",
        data: 'idtu='+id_tramite_usuario,
        success: function(datos){
                $("#registro_auditoria").html(datos);
        }
    });
}
function reasignar_tramite(id_perfil_usuario,id_tramite_usuario,cut,regional_proc,respuesta,id_tramite,firma = 0){
    reset_rt();
    //alert(id_tramite);
    $("#id_tu_r").val(id_tramite_usuario);
    $("#id_tra").val(id_tramite);
    $("#cod_tra").val(cut);
    $("#cut").html(cut);
    $("#firma").val(firma);
    //alert(firma);
    if(firma=="2"){
        $(".tit_reasignar_firmar").html("Firmar y Contestar Tramite");
        $(".bnt_reasignar_firmar").html("<i class='zmdi zmdi-swap'></i> &nbsp;Contestar Trámite");
        $("#reasignado_a").prop("required",false);
        $("#reasignacion").prop("hidden",true);
    }else{
        $("#reasignado_a").prop("required",true);
        $("#reasignacion").prop("hidden",false);
        $.ajax({
            type: "POST",
            url: "ajax/obtener_usuariosi_reasignar.php",
            data: 'idtu='+id_tramite_usuario+"&perfil="+id_perfil_usuario+"&reg="+regional_proc+"&respuesta="+respuesta,
            success: function(datos){
                $("#reasignado_a").html(datos);
                if(firma==='1'){
                    $(".tit_reasignar_firmar").html("Firmar y Reasignar Trámite");
                    $(".bnt_reasignar_firmar").html("<i class='zmdi zmdi-border-color'></i> &nbsp;Firmar y Reasignar Trámite");
                
                }else{
                    $(".tit_reasignar_firmar").html("Reasignar Trámite");
                    $(".bnt_reasignar_firmar").html("<i class='zmdi zmdi-swap'></i> &nbsp;Reasignar Trámite");
                }
            }
        });
    }
}
function reset_rt(){
}
function convalidar_tramite(id_tramite_usuario,cut,id_tramite,reg_id){
    reset_ct();
    $("#cid_tu_r").val(id_tramite_usuario);
    $("#cid_tra").val(id_tramite);
    $("#ccod_tra").val(cut);
    $("#ccut").html(cut);
    $("#reg_id").val(reg_id);
    /*$.ajax({
        type: "POST",
        url: "ajax/obtener_usuariosi_reasignar.php",
        data: 'idtu='+id_tramite_usuario+"&perfil="+id_perfil_usuario+"&reg="+regional_proc+"&respuesta="+respuesta,
        success: function(datos){
                $("#reasignado_a").html(datos);
        }
    });*/
}
function reset_ct(){
    $("#observaciones_c").val("");
}



//=================== FUNCIO WEB SERVICE PARA REGISTRO DE DATOS EN TRAMITE 13 ===============================
$("#cedula_propietario").change(function(){
    //if($("#tipo_identificacion").val()==="CI"){
           $.ajax({
            type: "POST",
            url: "ajax/obtener_datos_CIws.php",
            data: 'ci='+$("#cedula_propietario").val(),
            success: function(datos){
                var data = $.parseJSON(datos);
                //var ubicacion="";
                $.each(data, function(i, item) {
                    var nombre=item.Nombre.split(' ');
                    var apellidos=nombre[0]+" "+nombre[1];
                    var nombres="";
                    for(var j=2;j<nombre.length;j++){
                        nombres +=nombre[j]+" ";
                    }
                    nombres=nombres.slice(0,-1);
                    $('#nombres_propietario').val(nombres + " " + apellidos);
                    
                    //$('#apellidos').val(apellidos);
                    //ubicacion=item.Domicilio.split('/');
                    //cargar_ubicacion(ubicacion);
                });
            }
        }); 
    //}
});