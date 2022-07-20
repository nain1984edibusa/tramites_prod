/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function cargar_datos_vr(id_tramite,id_tur,id_tu,cod_tu){
    //alert(id_tramite+id_tu);
    reset_vr();
    $("#etra_id").val(id_tramite);
    $("#etur_id").val(id_tur);
    $("#etu_id").val(id_tu);
    $("#etu_codigo").val(cod_tu);
    $("#etu_convalidar").val($("#bandera_convalidar").val());
}
function cargar_datos_va(id_tramite,id_tur,id_tu,cod_tu){
    //alert(id_tramite+id_tu);
    reset_va();
    $("#atra_id").val(id_tramite);//id del tramite=8
    $("#atua_id").val(id_tur); //id del anexo
    $("#atu_id").val(id_tu); //id del trámite
    $("#atu_codigo").val(cod_tu); //codigo del trámite
    $("#atu_convalidar").val($("#bandera_convanxres").val());
}
function cargar_datos_vrte(id_tramite,id_tu,cod_tu){
    //alert(id_tramite+id_tu);
    reset_vr();
    $("#etra_id").val(id_tramite);
    $("#etur_id").val("SOLIC");
    $("#etu_id").val(id_tu);
    $("#etu_codigo").val(cod_tu);
    $("#etu_convalidar").val($("#bandera_convalidar").val());
}
function cargar_datos_vres(id_tramite,id_tur,id_tu,cod_tu){
    //alert(id_tramite+id_tu);
    reset_vres();
    $("#rtra_id").val(id_tramite);
    $("#rtuc_id").val(id_tur); // ID DE LA CONTESTACION O RESPUESTA
    $("#rtu_id").val(id_tu);
    $("#rtu_codigo").val(cod_tu);
    $("#rtu_convalidar").val($("#bandera_convanxres").val());
}
function reset_vr(){
    $("#etra_id").val("");
    $("#etur_id").val("");
    $("#etu_id").val("");
    $("#etu_codigo").val("");
    $("#etu_convalidar").val("");
}
function reset_va(){
    $("#atra_id").val("");//id del tramite=8
    $("#atua_id").val(""); //id del anexo
    $("#atu_id").val(""); //id del trámite
    $("#atu_codigo").val(""); //codigo del trámite
    $("#acumple").val(""); //codigo del trámite
    $("#aobservaciones").val(""); //codigo del trámite
    $("#atu_convalidar").val("");
}
function reset_vres(){
    $("#rtra_id").val("");//id del tramite=8
    $("#rtuc_id").val(""); //id del anexo
    $("#rtu_id").val(""); //id del trámite
    $("#rtu_codigo").val(""); //codigo del trámite
    $("#rcumple").val(""); //codigo del trámite
    $("#robservaciones").val(""); //codigo del trámite
    $("#rtu_convalidar").val("");
}

