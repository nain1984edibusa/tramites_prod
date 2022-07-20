<?php
$contenido_respuesta="<h4>".mb_strtoupper($ttramite["tra_resultado"])."</h4>";//TIPO DE DOCUMENTO
$contenido_respuesta.="<br/><h5>INFORMACIÓN GENERAL</h5><table>"
                    . "<tr><th>Fecha de emisión:</th><td>".$res_fecha."</td></tr>"
                    . "<tr><th>CUT:</th><td>".$tra_codigo."</td></tr>"
                    . "<tr><th>Solicitante:</th><td>".$ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]." (".$ttramite["usu_identificador"].")"."</td></tr>"
        . "</table><br/>";//DATOS GENERALES
if($respuesta["tuc_tipocontestacion"]=="AFIRMATIVO"){
    $tresp=" <b>SI</b> se aprueba el proyecto de investigacion .";
}else{
    $tresp=" <b>NO</b> se aprueba el proyecto de investigacion .";
}
$direccion=$tespecifico["te_direccion"];
if(strlen($tespecifico["te_codigo_inventario"])>0){
    $codinv=" (Código Inventario: ".$tespecifico["te_codigo_inventario"].")";
}else{
    $codinv="";
}
$contenido_respuesta.="<p>El Instituto Nacional de Patrimonio Cultural <b>APRUEBA</b> que el PROYECTO DE INVESTIGACION solicitado en el tramite de ingreso ".$codinv.$tresp."</p>";
$contenido_respuesta.="<br/><div class='bloque_especifico'><p><small><b>Observaciones:</b><br/>".nl2br($respuesta["tuc_marcolegal"])."</small></p>";
