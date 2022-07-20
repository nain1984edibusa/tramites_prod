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
require_once '../modelo/clsauditoria.php';
require_once '../modelo/clstramites.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*ADD 1/4*/
include_once "../modelo/clsferiadosanio.php";
include_once "_obtener_feriados.php";
/*add*/
/*OBTENCIÓN DE DATOS DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
$tramite = $_POST["cid_tu_r"]; //id del trámite usuario
$id_tramite= $_POST["cid_tra"]; //id del trámite
$cod_tramite= $_POST["ccod_tra"]; //código del trámite
/*ADD*/
$reg_id=$_POST["reg_id"];
/*add*/
//INCLUIR TRAMITE ESPECÍFICO
require_once '../modelo/clstramite'.$id_tramite.'.php';
/*--fin--*/
$observaciones_c= $_POST["observaciones_c"]; //observaciones de la reasignación
/*ADD 2/4 Se modificó el nombre de la variable OJO*/
$fecha_actual = date("Y-m-d H:i:s"); //fecha de ingreso
$fecha_reasignacion=fechainicio($fecha_actual);
$cferiados=new clsferiadosanio();
$fecha_control_con=sumar_ndias_slaborables_sferiados($cferiados,$fecha_reasignacion,CONVALIDACION,$reg_id);
/*add*/
/*NUEVO ESTADO DEL TRAMITE*/
$nuevo_estado="";
$redireccion="";
switch ($_SESSION["codperfil"]){
    case ASIGNADOR: $nuevo_estado=CONVALIDACIÓN_REQUISITOS1;$redireccion="ui_bandeja_recibidos"; break;
    case EJECUTOR: $nuevo_estado=CONVALIDACIÓN_REQUISITOS2;$redireccion="ui_bandeja_revision"; break;
    default: $nuevo_estado="0"; break;
}
/*ACTUALIZAR EL TRAMITE_USUARIO*/
$clstramiteusuario = new clstramiteusuario();
$clstramiteusuario->setTu_id($tramite);
$clstramiteusuario->setEt_id($nuevo_estado);
/*ADD 3/4*/
$clstramiteusuario->setTu_fecha_convalidacion($fecha_reasignacion);
$clstramiteusuario->setTu_fecha_concon($fecha_control_con);
/*add*/
$reasignacion=$clstramiteusuario->tra_convalidar("ct_tramite_usuario");

/*ACTUALIZAR TRÁMITE ESPECÍFICO*/
switch ($id_tramite){
    case "5": $clstramitee = new clstramite5();
        break;
    case "8": $clstramitee = new clstramite8();
        break;
    case "12": $clstramitee = new clstramite12();
        break;
    case "13": $clstramitee = new clstramite13();
        break;
}
$clstramitee->setTu_codigo($cod_tramite);
$idtue=$clstramitee->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($idtue);
$clstramitee->setTu_id($idtue["tu_id"]);
$clstramitee->setEt_id($nuevo_estado);
/*ADD 4/4*/
$clstramitee->setTu_fecha_convalidacion($fecha_reasignacion);
$clstramitee->setTu_fecha_concon($fecha_control_con);
/*add*/
$reasignacion=$clstramitee->tra_convalidar("_ct_tramite".$id_tramite);
//exit();
if($reasignacion==0){
    //redireccionar("../ui_bandeja_recibidos.php?proc=reatra&est=0");
}else{
    /*REGISTRAR PROCESO EN AUDITORIA*/
    $clsaud = new clsauditoria();
    /*ADD cambio de variable*/
    $clsaud->setAud_fechahora_proceso($fecha_actual);
    /*add*/
    $clsaud->setAud_fechahora_proceso($fecha_reasignacion);
    $clsaud->setAud_objeto("TRAMITE");
    $clsaud->setAud_proceso("CONVALIDACIÓN");
    $clsaud->setTu_id($tramite);
    $clsaud->setUsu_id($_SESSION["codusuario"]);
    $clsaud->setAud_descripcion($observaciones_c);
    $clsaud->auditoria_insertar();
    //ENVIAR_EMAILS
    $ttipot=new cl_tramites();
    $ttipot->setTra_id($id_tramite);
    $tipot=$ttipot->tra_seleccionar_byid();
    $tipot= mysqli_fetch_array($tipot);
    $tipo_mensaje="convalidar_tra";
    $usu=$clstramiteusuario->tra_seleccionar_byid();
    $dtramite=mysqli_fetch_array($usu);
    $destinatario=$dtramite["usu_correo"];
    $mensaje_especifico="<p>Estimado/a <b>".$dtramite["usu_nombre"]." ".$dtramite["usu_apellido"]."</b> portador/a ".denominacion_identificador($dtramite["usu_tidentificador"])." ".$dtramite["usu_identificador"].", una vez que se realizó la revisión de la solicitud ingresada, se evidencia que los requisitos para acceder al trámite descrito a continuación necesitan ser corregidos. Se solicita revisar la documentación faltante u observada.</p>";
    $mensaje_especifico.="<div class='bloque_especifico'><p><b>Tipo de trámite:</b> ".$dtramite["tra_nombre"]."</p>";
    $mensaje_especifico.="<p><b>CUT:</b> ".$cod_tramite."</p></div>";
    $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
    $template="../includes/email_template.html";
    sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$destinatario,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
    //include_once "enviar_correo.php";
    //REDIRECCIONAR
    //exit();
    redireccionar("../".$redireccion.".php?proc=contra&est=1");
}
?>