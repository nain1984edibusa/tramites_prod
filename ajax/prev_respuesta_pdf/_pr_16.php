<?php
include_once("../modelo/clstipoareaasesoria.php");
$area=new clstipoareaasesoria();
$area->carga_aaset_codigo($tespecifico["te_area"]);
$area= mysqli_fetch_array($area->tipoareaasesoria_seleccionar());
$contenido_respuesta="<h4>".mb_strtoupper($ttramite["tra_resultado"])."</h4>";//TIPO DE DOCUMENTO
$contenido_respuesta.="<br/><h5>INFORMACIÓN GENERAL</h5><table>"
                    . "<tr><th>Fecha de emisión:</th><td>".$res_fecha."</td></tr>"
                    . "<tr><th>CUT:</th><td>".$tra_codigo."</td></tr>"
                    . "<tr><th>Solicitante:</th><td>".$ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]." (".$ttramite["usu_identificador"].")"."</td></tr>"
        . "</table><br/>";//DATOS GENERALES
if($respuesta["tuc_tipocontestacion"]=="AFIRMATIVO"){
    $tresp="ésta se ha <b>VALIDADO</b> correctamente, conforme lo indica el informe técnico que se adjunta.";
}else{
    $tresp="se han encontrado <b>ERRORES</b> durante el proceso de validación. Los detalles se describen en el informe técnico adjunto.";
}
$area= ucwords(strtolower($area["amb_nombre"]));
if(strlen($respuesta["tuc_infoadicional"])>0){
    $observaciones=nl2br($respuesta["tuc_infoadicional"]);
}else{
    $observaciones="Ninguna";
}
$contenido_respuesta.="<p>El Instituto Nacional de Patrimonio Cultural del Ecuador (INPC) pone en su conocimiento que:</p><p>Una vez que la Dirección de Control Técnico, Conservación y Salvaguardia del Patrimonio Cultural, en el ámbito del ".$area.", ha procedido a realizar el análisis respectivo de la Ficha de Inventario <b>".$tespecifico["te_ficha_inventario"]."</b> en el Sistema SIPCE, ".$tresp."</p>";
$contenido_respuesta.="<br/><div class='bloque_especifico'><p><small><b>Observaciones:</b><br/>".$observaciones."</small></p>";
