<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*CONVALIDAR TRÁMITE*/
/*Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../modelo/clstramiteusuario.php';
require_once '../modelo/clsusuarios.php';
require_once '../modelo/clsauditoria.php';
require_once '../modelo/clstramites.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*ADD 1/4*/
include_once "../modelo/clsferiadosanio.php";
include_once "_obtener_feriados.php";
/*add*/
/*OBTENCIÓN DE DATOS DEL FORMULARIO*/
$tra_codigo=$_POST["tra_codigo"];
$tra_id=$_POST["tra_id"];
$id_tu=$_POST["idtu"];
//INCLUIR TRAMITE ESPECÍFICO
require_once '../modelo/clstramite'.$tra_id.'.php';
include_once("../modelo/clsturequisitos.php");
switch ($tra_id){
    case "5": $tramitee = new clstramite5();
        //$req=1;
        break;
    case "8": $tramitee = new clstramite8();
        //$req=1;
        break;
    case "12": $tramitee = new clstramite12();
        //$req=0;
        break;
    case "13": $tramitee = new clstramite13();
        //$req=0;
        break;
}
/*OBTENER TRÁMITE ESPECÍFICO*/
$tramitee->setTu_codigo($tra_codigo);
$tespecifico=$tramitee->tra_seleccionar_bycodigo();
$tespecifico= mysqli_fetch_array($tespecifico);
$tramitee->setTu_id($tespecifico["tu_id"]);
/*OBTENER TRAMITE_USUARIO*/
$clstramiteusuario = new clstramiteusuario();
$clstramiteusuario->setTu_id($id_tu);
/*if($req==1){
    //OBTENER REQUISITOS
    $requisitose=new clsturequisitos();
    $requisitose->setTu_id($tespecifico["tu_id"]);
    $requisitose->setTra_id($tra_id);
    $requisitost=$requisitose->tur_seleccionar_byte();
}*/
//INCLUIR CONFORME EL TRAMITE
include_once("enviarconval_tramite/_ect_".$tra_id.".php");
switch ($tespecifico["et_id"]){
    case CONVALIDACIÓN_REQUISITOS1:
        //echo "1";
        $nuevo_estado=VALIDACION_REQUISITOS;
        break;
    case CONVALIDACIÓN_REQUISITOS2:
        //echo "2";
        $nuevo_estado=ANALISIS_SOLICITUD;
        break;
    default :
        break;
}
//exit();
$redireccion="ue_bandeja_convalidacion";
//PROCESOS DE ACTUALIZACIÓN GENERAL
$clstramiteusuario->setEt_id($nuevo_estado);
$clstramiteusuario->setTu_band_convalidar(-1);
$clstramiteusuario->setTu_codigo($tra_codigo);
$clstramiteusuario->tra_cambiar_bandconvalidacion("ct_tramite_usuario");
/*ADD 2/3 Cambiada la funcion tra_convalidar por ..... y aumentados datos*/
$fecha_actual = date("Y-m-d H:i:s"); //fecha de ingreso
$fecha_ingreso=fechainicio($fecha_actual);
$cferiados=new clsferiadosanio();
$fecha_control_coa=sumar_ndias_slaborables_sferiados($cferiados,$fecha_ingreso,COA,$tespecifico["reg_id"]);
$clstramiteusuario->setTu_fecha_iniciocoa($fecha_ingreso);
$clstramiteusuario->setTu_fecha_concoa($fecha_control_coa);
$clstramiteusuario->tra_enviarconvalidacion("ct_tramite_usuario");
/*add*/
$tramitee->setEt_id($nuevo_estado);
$tramitee->setTu_band_convalidar(-1);
$tramitee->setTu_codigo($tra_codigo);
$tramitee->tra_cambiar_bandconvalidacion("_ct_tramite".$tra_id);
/*ADD 3/3 Cambiada la funcion tra_convalidar por .....*/
$tramitee->setTu_fecha_iniciocoa($fecha_ingreso);
$tramitee->setTu_fecha_concoa($fecha_control_coa);
$tramitee->tra_enviarconvalidacion("_ct_tramite".$tra_id);
/*add*/
//exit();
if($res==0){
    redireccionar("../".$redireccion.".php?proc=ecotra&est=0");
}else{
    /*REGISTRAR PROCESO EN AUDITORIA*/
    /*ADD eliminado fecha_proceso*/
    $clsaud = new clsauditoria();
    $clsaud->setAud_fechahora_proceso($fecha_actual);
    $clsaud->setAud_objeto("TRAMITE");
    $clsaud->setAud_proceso("ENVIAR CONVALIDACIÓN");
    $clsaud->setTu_id($id_tu);
    $clsaud->setUsu_id($_SESSION["codusuario"]);
    $clsaud->setAud_descripcion("");
    $clsaud->auditoria_insertar();
    //ENVIAR_EMAILS
    $ttipot=new cl_tramites();
    $ttipot->setTra_id($tra_id);
    $tipot=$ttipot->tra_seleccionar_byid();
    $tipot= mysqli_fetch_array($tipot);
    /*Envío de correo al usuario interno*/
    $clsusuario = new clsusuarios();
    $tipo_mensaje="enviar_convalidar_tra";
    $dcc=$clsusuario->setUsu_id($tespecifico["usu_intid"]);
    $dcc=$clsusuario->usu_email_byid();
    $dcc= mysqli_fetch_array($dcc);
    $cc=$dcc["usu_correo"];
    $namecc=$dcc["usu_nombre"]." ".$dcc["usu_apellido"];
    $mensaje_especifico="Estimado/a ".$namecc." ha recibido la subsanación de un trámite de '".$tipot["tra_nombre"]."', el cual tiene como fecha aproximada de respuesta el ".$tespecifico["tu_fecha_aprocont"];
    $mensaje_especifico_c="<div class='bloque_especifico'><p><b>Tipo de trámite:</b> ".$tipot["tra_nombre"]."</p>";
    $mensaje_especifico_c.="<p><b>CUT:</b> ".$tra_codigo."</p>";
    $mensaje_especifico_c.="<p><b>Fecha de ingreso:</b> ".$tespecifico["tu_fecha_ingreso"]."</p>";
    $mensaje_especifico_c.="<p><b>Fecha estimada de respuesta:</b> ".$tespecifico["tu_fecha_aprocont"]."</p></div>";
    $mensaje_especifico.=$mensaje_especifico_c;
    $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
    $template="../includes/email_template_interno.html";
    sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$cc,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
    //REDIRECCIONAR
    redireccionar("../".$redireccion.".php?proc=ecotra&est=1");
}
?>