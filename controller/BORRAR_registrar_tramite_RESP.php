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
require_once '../modelo/clsusuarios.php';
//require_once '../modelo/clstramiteusuarioturno.php';
require_once '../modelo/clsauditoria.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DE LA SESION Y DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
$tramite = $_POST["idt"]; //id del trámite
$estado_tramite = $_POST["estadot"]; //estado del trámite
$duracion_tramite = $_POST["duraciont"]; //estado del trámite
$fecha_ingreso = date("Y-m-d H:i:s"); //fecha de ingreso
$fecha_aprox=sumar_ndias_fecha($fecha_ingreso, $duracion_tramite); //fecha aproximada
$regional = $_SESSION["regional"]; //regional // LA REGIONAL DEL TRAMITE VA A DEPENDER DONDE ESTÁ EL DOCUMENTO

if($duracion_tramite<=DIAS_COLCHON){
    $fecha_control=$fecha_ingreso;
}else{
    $fecha_control=sumar_ndias_fecha($fecha_ingreso, DIAS_COLCHON);
}
$fecha_fin=sumar_ndias_fecha($fecha_ingreso,$duracion_tramite);
$codigo_tramite=generar_codigo_tramite($tramite,$fecha_ingreso,$usuario);
//echo $codigo_tramite;
/*CREACIÓN DE REGISTRO E INFORMACIÓN PARA EL INSERTADO DEL TRÁMITE*/
$clstramiteusuario = new clstramiteusuario;
$clstramiteusuario->setTu_codigo($codigo_tramite);
$clstramiteusuario->setUsu_eid($usuario);
$clstramiteusuario->setTra_id($tramite);
$clstramiteusuario->setTu_fecha_ingreso($fecha_ingreso);
$clstramiteusuario->setTu_fecha_aprocont($fecha_aprox);
$clstramiteusuario->setTu_fecha_contcont($fecha_control);
$clstramiteusuario->setReg_id($regional);
$clstramiteusuario->setEt_id($estado_tramite);
$clsusuario = new clsusuarios();
$asignador=$clsusuario->get_usuario_by_zonal_perfil($regional, ASIGNADOR);
$asignador= mysqli_fetch_array($asignador);
//echo $asignador["usu_id"];
$clstramiteusuario->setUsu_iid($asignador["usu_id"]);
$id_tramite=$clstramiteusuario->tu_insertar();
$clstramiteusuario->setTu_id($id_tramite);
if($id_tramite==0){
    redireccionar("../ue_formularios_tramites.php?idt=$tramite&proc=regtra&est=0");
}else{
    include("registrar_tramite/_rt_".$tramite.".php"); //AQUI SE INSERTAN LOS PARÁMETROS ESPECÍFICOS DEL TRAMITE
    //exit();
    if($band==0){
        //INACTIVAR TRÁMITE
        $clstramiteusuario->setTu_estado("INACTIVO");
        $clstramiteusuario->tu_cambiar_estado();
        //exit();
        //REDIRECCIONAR
        redireccionar("../ue_formularios_tramites.php?idt=$tramite&proc=regtra&est=0");
    }else{
        /*REGISTRAR PROCESO EN AUDITORIA*/
        $clsaud = new clsauditoria();
        $clsaud->setAud_fechahora_proceso($fecha_ingreso);
        $clsaud->setAud_objeto("TRAMITE");
        $clsaud->setAud_proceso("REGISTRO");
        $clsaud->setTu_id($id_tramite);
        $clsaud->setUsu_id($usuario);
        $clsaud->auditoria_insertar();
        //REDIRECCIONAR
        //exit();
        redireccionar("../ue_bandeja_enviados.php?proc=regtra&est=1");
    }
}
?>