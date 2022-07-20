<?php
include_once("../modelo/clsambito.php");
$ambito=new clsambito();
$ambito->setAmb_id($tespecifico["te_ambito"]);
$ambito= mysqli_fetch_array($ambito->ambito_seleccionar_byid());
$contenido_respuesta="<h4>".mb_strtoupper($ttramite["tra_resultado"])."</h4>";//TIPO DE DOCUMENTO
$contenido_respuesta.="<br/><h5>INFORMACIÓN GENERAL</h5><table>"
                    . "<tr><th>Fecha de emisión:</th><td>".$res_fecha."</td></tr>"
                    . "<tr><th>CUT:</th><td>".$tra_codigo."</td></tr>"
                    . "<tr><th>Solicitante:</th><td>".$ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]." (".$ttramite["usu_identificador"].")"."</td></tr>"
        . "</table><br/>";//DATOS GENERALES
if($respuesta["tuc_tipocontestacion"]=="AFIRMATIVO"){
    $tresp="éstas se han <b>VALIDADO</b> correctamente en su totalidad, conforme lo indica el informe técnico que se adjunta.";
}else{
    $tresp="se han encontrado <b>ERRORES</b> durante el proceso de validación (en una o varias de ellas). Los detalles se describen en el informe técnico adjunto.";
}
$ambito= ucwords(strtolower($ambito["amb_nombre"]));
if(strlen($respuesta["tuc_infoadicional"])>0){
    $observaciones=nl2br($respuesta["tuc_infoadicional"]);
}else{
    $observaciones="Ninguna";
}
$contenido_respuesta.="<p>El Instituto Nacional de Patrimonio Cultural del Ecuador (INPC) pone en su conocimiento que:</p><p>Una vez que la Dirección de Control Técnico, Conservación y Salvaguardia del Patrimonio Cultural, en el ámbito del ".$ambito.", ha procedido a realizar el análisis respectivo de <b>".$tespecifico["te_cantidad_fichas"]."</b> Fichas de Inventario en el Sistema SIPCE, ".$tresp."</p>";
$contenido_respuesta.="<br/><div class='bloque_especifico'><p><small><b>Observaciones:</b><br/>".$observaciones."</small></p>";
