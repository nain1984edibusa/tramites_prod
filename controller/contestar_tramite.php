<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*REGISTRAR TRÁMITE*/
/*Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../modelo/clstramiteusuario.php';
require_once '../modelo/clstramiterespuestas.php';
require_once '../modelo/clstramites.php';
require_once '../modelo/clsauditoria.php';
require_once '../modelo/clsusuarios.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
$tramite = $_POST["id_tu_r"]; //id del trámite usuario
$id_tramite= $_POST["id_tra"]; //id del trámite
$cod_tramite= $_POST["cod_tra"]; //código del trámite
$observaciones_r= $_POST["observaciones_r"]; //observaciones de la reasignación
//INCLUIR TRAMITE ESPECÍFICO
//require_once '../modelo/clstramite'.$id_tramite.'.php';
/*OTENER INFORMACIÓN DEL TRÁMITE ESPECÍFICO*/
/*switch ($id_tramite){
    case "8": $clstramitee = new clstramite8();
        break;
    case "12": $clstramitee = new clstramite12();break;
}*/
/*$clstramitee->setTu_codigo($cod_tramite);
$idtue=$clstramitee->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($idtue);*/
/*--fin--*/
/*NUEVO ESTADO DEL TRAMITE Y REDIRECCIÓN*/
$nuevo_estado=CONTESTADO_DESPACHADO;
$redireccion="ui_bandeja_revision"; 

$fecha_respuesta = date("Y-m-d H:i:s"); //fecha de ingreso
/*ACTUALIZAR EL TRAMITE_USUARIO*/
$clstramiteusuario = new clstramiteusuario();
$clstramiteusuario->setTu_id($tramite);
$clstramiteusuario->setEt_id($nuevo_estado);
$clstramiteusuario->setTu_fecha_contestacion($fecha_respuesta);
$re1=$clstramiteusuario->tra_contestar("ct_tramite_usuario");
$re2=$clstramiteusuario->tra_contestar("_ct_tramite".$id_tramite);
$usu=$clstramiteusuario->tra_seleccionar_byid();
$dtramite=mysqli_fetch_array($usu);
/*ACTUALIZAR TRÁMITE ESPECÍFICO*/
/*switch ($id_tramite){
    case "8": $clstramitee = new clstramite8();
        break;
    case "12": $clstramitee = new clstramite12();break;
}
$clstramitee->setTu_codigo($cod_tramite);
$idtue=$clstramitee->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($idtue);*/
/*$clstramitee->setTu_id($idtue["tu_id"]);
$clstramitee->setUsu_iid($reasignado_a);
$clstramitee->setEt_id($nuevo_estado);
$reasignacion=$clstramitee->tra_reasignar();*/
//exit();
if($re1==0 || $re2==0){
    redireccionar("../".$redireccion.".php?proc=cnttra&est=0");
}else{
    /*REGISTRAR PROCESO EN AUDITORIA*/
    $clsaud = new clsauditoria();
    $clsaud->setAud_fechahora_proceso($fecha_respuesta);
    $clsaud->setAud_objeto("TRAMITE");
    $clsaud->setAud_proceso("CONTESTACION");
    $clsaud->setTu_id($tramite);
    $clsaud->setUsu_id($_SESSION["codusuario"]);
    $clsaud->setAud_descripcion($observaciones_r);
    $clsaud->auditoria_insertar();
    //ENVIAR MAIL
    $ttipot=new cl_tramites();
    $ttipot->setTra_id($id_tramite);
    $tipot=$ttipot->tra_seleccionar_byid();
    $tipot= mysqli_fetch_array($tipot);
    $tipo_mensaje="contestacion_tra";
    //$clsusuario = new clsusuarios();
    //$clsusuario->setUsu_id($reasignado_a);
    //$ddestinatario=$clsusuario->usu_email_byid();
    //$ddestinatario= mysqli_fetch_array($ddestinatario);
    $destinatario=$dtramite["usu_correo"];
    //echo $dtramite["usu_correo"];
    $mensaje_especifico="<p>Estimado/a <b>".$dtramite["usu_nombre"]." ".$dtramite["usu_apellido"]."</b> portador/a ".denominacion_identificador($dtramite["usu_tidentificador"])." ".$dtramite["usu_identificador"].", su trámite ha sido contestado:</p>";
    $mensaje_especifico.="<div class='bloque_especifico'><p><b>Tipo de trámite:</b> ".$dtramite["tra_nombre"]."</p>";
    $mensaje_especifico.="<p><b>CUT:</b> ".$cod_tramite."</p>";
    $mensaje_especifico.="<p><b>Fecha de ingreso:</b> ".$dtramite["tu_fecha_ingreso"]."</p>";
    $mensaje_especifico.="<p><b>Fecha de respuesta:</b> ".$dtramite["tu_fecha_contestacion"]."</p></div>";
    $mensaje_especifico.="<p><b>Descargar respuesta</b> <a href='".URL_SIS.DIRDOWNLOAD.RUTA_ARCHIVOSTRAMITES.$cod_tramite."/".$cod_tramite.".pdf'>Click aquí</a></p>";
    $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
    $template="../includes/email_template.html";
    sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$destinatario,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
    //include_once "enviar_correo.php";
    //exit();
    //REDIRECCIONAR
    redireccionar("../".$redireccion.".php?proc=cnttra&est=1");
}
?>