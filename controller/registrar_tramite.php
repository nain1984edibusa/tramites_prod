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
require_once '../modelo/clstramites.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*ADD 1/3*/
include_once "../modelo/clsferiadosanio.php";
include_once "_obtener_feriados.php";
/*add*/
/*OBTENCIÓN DE DATOS DE LA SESION Y DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
$tramite = $_POST["idt"]; //id del trámite
$estado_tramite = $_POST["estadot"]; //estado del trámite
$duracion_tramite = $_POST["duraciont"]; //estado del trámite
/*ADD3/3*/
$regional = $_SESSION["regional"]; //regional // LA REGIONAL DEL TRAMITE VA A DEPENDER DONDE ESTÁ EL DOCUMENTO
if(isset($_POST["id_regional"])){
    $regional=$_POST["id_regional"];
}
/*add*/
/*ADD 2/3 Se modificó el nombre de la variable*/
$fecha_actual = date("Y-m-d H:i:s"); //fecha de ingreso
$fecha_ingreso=fechainicio($fecha_actual);
$cferiados=new clsferiadosanio();
$fecha_control_coa=sumar_ndias_slaborables_sferiados($cferiados,$fecha_ingreso,COA,$regional);
/*add*/
/*ADD modificado el cálculo de tiempos de control de eficiencia*/
$fecha_aprox=sumar_ndias_slaborables_sferiados($cferiados,$fecha_ingreso, $duracion_tramite,$regional); //fecha aproximada
if($duracion_tramite<=DIAS_COLCHON){
    $fecha_control=$fecha_ingreso;
}else{
    $fecha_control=sumar_ndias_slaborables_sferiados($cferiados,$fecha_ingreso, DIAS_COLCHON,$regional);
}
/*add*/
//$fecha_fin=sumar_ndias_fecha($fecha_ingreso,$duracion_tramite);
$codigo_tramite=generar_codigo_tramite($tramite,$fecha_ingreso,$usuario);
$carpeta=DIRSERVIDOR.RUTA_ARCHIVOSTRAMITES.$codigo_tramite;
if(!file_exists($carpeta)){
    mkdir($carpeta,0777,true);
}
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
/*ADD3/3*/
$clstramiteusuario->setTu_fecha_iniciocoa($fecha_ingreso);
$clstramiteusuario->setTu_fecha_concoa($fecha_control_coa);
//$fecha_convalidacion='0000-00-00';
//$fecha_control_con='0000-00-00';
//$clstramiteusuario->setTu_fecha_convalidacion($fecha_convalidacion);
//$clstramiteusuario->setTu_fecha_concon($fecha_control_con);
/*add*/
$clsusuario = new clsusuarios();
$asignador=$clsusuario->get_usuario_by_zonal_perfil($regional, ASIGNADOR);
$asignador= mysqli_fetch_array($asignador);
//echo $asignador["usu_id"];
$clstramiteusuario->setUsu_iid($asignador["usu_id"]);
$id_tramite=$clstramiteusuario->tu_insertar();
$clstramiteusuario->setTu_id($id_tramite);
if($id_tramite==0){
    //echo $id_tramite;
    //exit();
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
        /*ADD cambio de variable*/
        $clsaud->setAud_fechahora_proceso($fecha_actual);
        /*add*/
        $clsaud->setAud_objeto("TRAMITE");
        $clsaud->setAud_proceso("REGISTRO");
        $clsaud->setTu_id($id_tramite);
        $clsaud->setUsu_id($usuario);
        $clsaud->auditoria_insertar();
        //ENVIAR_EMAILS
        $ttipot=new cl_tramites();
        $ttipot->setTra_id($tramite);
        $tipot=$ttipot->tra_seleccionar_byid();
        $tipot= mysqli_fetch_array($tipot);
        /*Envío de correo al ciudadano*/
        $tipo_mensaje="registro_tra";
        $clsusuario->setUsu_id($_SESSION["codusuario"]);
        $ddestinatario=$clsusuario->usu_email_byid();
        $ddestinatario= mysqli_fetch_array($ddestinatario);
        $destinatario=$ddestinatario["usu_correo"];
        $mensaje_especifico="<p>Estimado/a <b>".$_SESSION["nombre"]."</b> portador/a ".denominacion_identificador($ddestinatario["usu_tidentificador"])." ".$ddestinatario["usu_identificador"].", el trámite '".$tipot["tra_nombre"]."' ha ingresado exitosamente.</p>"
                . "<p>El Instituto Nacional de Patrimonio Cultural procederá a revisar la documentación presentada en el término de 3 días hábiles, este plazo podría extenderse dependiendo de la demanda de servicios y trámites ingresados. Recuerde que en caso de no presentar toda la documentación necesaria conforme a los requisitos establecidos, se enviará una notificación para que se proceda con la subsanación. En caso de no recibir la notificación de subsanación, su trámite continuará con el proceso correspondiente.</p>";
        $mensaje_especifico_c="<div class='bloque_especifico'><p><b>Tipo de trámite:</b> ".$tipot["tra_nombre"]."</p>";
        $mensaje_especifico_c.="<p><b>CUT:</b> ".$codigo_tramite."</p>";
        $mensaje_especifico_c.="<p><b>Fecha de ingreso:</b> ".$fecha_ingreso."</p>";
        $mensaje_especifico_c.="<p><b>Fecha estimada de respuesta:</b> ".$fecha_aprox."</p></div>";
        $mensaje_especifico.=$mensaje_especifico_c;
        $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
        $template="../includes/email_template.html";
        sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$destinatario,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
        /*Envío de correo al asignador*/
        $tipo_mensaje="registro_tra_asi";
        $dcc=$clsusuario->setUsu_id($asignador["usu_id"]);
        $dcc=$clsusuario->usu_email_byid();
        $dcc= mysqli_fetch_array($dcc);
        $cc=$dcc["usu_correo"];
        $namecc=$dcc["usu_nombre"]." ".$dcc["usu_apellido"];
        $mensaje_especifico="Estimado/a <b>".$namecc."</b> ha recibido un trámite de '".$tipot["tra_nombre"]."', el cual tiene un tiempo máximo de respuesta de ".$duracion_tramite." días laborables.";
        $mensaje_especifico.=$mensaje_especifico_c;
        $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
        $template="../includes/email_template_interno.html";
        sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$cc,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
        //include_once "enviar_correo.php";
        //exit();
        //REDIRECCIONAR
        //exit();
        redireccionar("../ue_bandeja_enviados.php?proc=regtra&est=1");
    }
}
?>
