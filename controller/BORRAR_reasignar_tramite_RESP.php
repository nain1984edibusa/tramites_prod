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
require_once '../modelo/clsauditoria.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
$tramite = $_POST["id_tu_r"]; //id del trámite usuario
$id_tramite= $_POST["id_tra"]; //id del trámite
$cod_tramite= $_POST["cod_tra"]; //código del trámite
//INCLUIR TRAMITE ESPECÍFICO
require_once '../modelo/clstramite'.$id_tramite.'.php';
/*--fin--*/
$reasignado_a = $_POST["reasignado_a"]; //usuario al que se va a reasignar
$observaciones_r= $_POST["observaciones_r"]; //observaciones de la reasignación
$fecha_reasignacion = date("Y-m-d H:i:s"); //fecha de ingreso
/*NUEVO ESTADO DEL TRAMITE*/
$nuevo_estado="";
$redireccion="";
switch ($_SESSION["codperfil"]){
    case ASIGNADOR: $nuevo_estado=ANALISIS_SOLICITUD;$redireccion="ui_bandeja_recibidos"; break;
    case EJECUTOR: $nuevo_estado=CONTESTADO_REVISION;$redireccion="ui_bandeja_revision"; break;
    case APROBADOR: $nuevo_estado=CONTESTADO_REVISION;$redireccion="ui_bandeja_revision"; break;
    default: $nuevo_estado="0"; break;
}
/*ACTUALIZAR EL TRAMITE_USUARIO*/
$clstramiteusuario = new clstramiteusuario();
$clstramiteusuario->setTu_id($tramite);
$clstramiteusuario->setUsu_iid($reasignado_a);
$clstramiteusuario->setEt_id($nuevo_estado);
$reasignacion=$clstramiteusuario->tra_reasignar();

/*ACTUALIZAR TRÁMITE ESPECÍFICO*/
switch ($id_tramite){
    case "8": $clstramitee = new clstramite8();
        break;
    case "12": $clstramitee = new clstramite12();break;
}
$clstramitee->setTu_codigo($cod_tramite);
$idtue=$clstramitee->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($idtue);
$clstramitee->setTu_id($idtue["tu_id"]);
$clstramitee->setUsu_iid($reasignado_a);
$clstramitee->setEt_id($nuevo_estado);
$reasignacion=$clstramitee->tra_reasignar();
//exit();
if($reasignacion==0){
    redireccionar("../ui_bandeja_recibidos.php?proc=reatra&est=0");
}else{
    /*REGISTRAR PROCESO EN AUDITORIA*/
    $clsaud = new clsauditoria();
    $clsaud->setAud_fechahora_proceso($fecha_reasignacion);
    $clsaud->setAud_objeto("TRAMITE");
    $clsaud->setAud_proceso("REASIGNACIÓN");
    $clsaud->setTu_id($tramite);
    $clsaud->setUsu_id($_SESSION["codusuario"]);
    $clsaud->setAud_descripcion($observaciones_r);
    $clsaud->auditoria_insertar();
    //REDIRECCIONAR
    redireccionar("../".$redireccion.".php?proc=reatra&est=1");
}
?>