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
//INCLUIR TRAMITE ESPECÍFICO
require_once '../modelo/clstramite'.$id_tramite.'.php';
/*OTENER INFORMACIÓN DEL TRÁMITE ESPECÍFICO*/
switch ($id_tramite){
    case "5": $clstramitee = new clstramite5();break;
    case "8": $clstramitee = new clstramite8();break;
    case "12": $clstramitee = new clstramite12();break;
    case "13": $clstramitee = new clstramite13();break;
    case "16": $clstramitee = new clstramite16();break;
    case "18": $clstramitee = new clstramite18();break;
}
$clstramitee->setTu_codigo($cod_tramite);
$idtue=$clstramitee->tra_seleccionar_bycodigo();
$idtue= mysqli_fetch_array($idtue);
/*--fin--*/
/*NUEVO ESTADO DEL TRAMITE Y REDIRECCIÓN*/
$nuevo_estado="";
$redireccion="";
switch ($_SESSION["codperfil"]){
    case ASIGNADOR: $nuevo_estado=ANALISIS_SOLICITUD;$redireccion="ui_bandeja_recibidos"; break;
    case EJECUTOR: $nuevo_estado=CONTESTADO_REVISION;$redireccion="ui_bandeja_revision"; break;
    case APROBADOR: $nuevo_estado=CONTESTADO_REVISION;$redireccion="ui_bandeja_revision"; break;
    default: $nuevo_estado="0"; break;
}
$firma= $_REQUEST["firma"]; //código del trámite GENERAMOS EL PDF Y FIRMAMOS
$observaciones_r= $_POST["observaciones_r"]; //observaciones de la reasignación
if($firma==2){
    $fecha_firma = date("Y-m-d H:i:s"); //fecha de ingreso
    require_once '../modelo/clstu'.$id_tramite.'respuestas.php';
    //require_once '../modelo/clstramite'.$id_tramite.'.php';
    switch ($id_tramite){
        case "8": $clstramiteresp = new clstu8respuestas();
            break;
        //case "12": $clstramitee = new clstramite12();break;
        case "13": $clstramiteresp = new clstu13respuestas();
            break;
    }
    //$nombre_archivo=$cod_tramite.'.pdf';
    //$ruta_archivo=RUTA_ARCHIVOSTRAMITES.$cod_tramite."/".$nombre_archivo;
    $clsaud = new clsauditoria();
        $clsaud->setAud_fechahora_proceso($fecha_firma);
        $clsaud->setAud_objeto("TRAMITE");
        $clsaud->setAud_proceso("GENERACIÓN DE DOCUMENTO DE RESPUESTA");
        $clsaud->setTu_id($tramite);
        $clsaud->setUsu_id($_SESSION["codusuario"]);
        $clsaud->setAud_descripcion("");
        $clsaud->auditoria_insertar();
        //REDIRECCIONAR
        //exit();
        //redireccionar("../".$redireccion.".php?proc=rftra&est=1");
        $redireccion="ui_firmar_tramite.php";
        //redireccionar("../".$redireccion."?idtu=".$tramite."&ruta=".$ruta_archivo."&pro=cont&obs=".$observaciones_r);
		redireccionar("../".$redireccion."?idtu=".$tramite."&pro=cont&obs=".$observaciones_r);
}else{
    $reasignado_a = $_POST["reasignado_a"]; //usuario al que se va a reasignar
    if($firma==1){
        $fecha_firma = date("Y-m-d H:i:s"); //fecha de ingreso
        require_once '../modelo/clstu'.$id_tramite.'respuestas.php';
        //require_once '../modelo/clstramite'.$id_tramite.'.php';
        switch ($id_tramite){
            case "5": $clstramiteresp = new clstu5respuestas();
                break;
            case "8": $clstramiteresp = new clstu8respuestas();
                break;
            case "12": $clstramiteresp = new clstu12respuestas();
                break;
            case "13": $clstramiteresp = new clstu13respuestas();
                break;
			case "16": $clstramiteresp = new clstu16respuestas();
                break;
			case "18": $clstramiteresp = new clstu18respuestas();
                break;
        }
        //ACTUALIZAR CONTESTACIÓN, INCLUIDA RUTA PREESTABLECIDA DE LA RESPUESTA
        switch ($_SESSION["codperfil"]){
            case EJECUTOR:  //SI EL EJECUTOR REASIGNA AL APROBADOR, DEBE GENERAR EL PDF Y FIRMAR.
                $clstramiteresp->setUsu_aprobador($reasignado_a); 
                $actualizador="aprobador";
                break;
        }
        $clstramiteresp->setTu_id($idtue["tu_id"]);
        //$nombre_archivo=md5(time().$cod_tramite).'.pdf';
        $nombre_archivo=$cod_tramite.'.pdf';
        $ruta_archivo=RUTA_ARCHIVOSTRAMITES.$cod_tramite."/".$nombre_archivo;
        $clstramiteresp->setTuc_rutaarchivo($ruta_archivo);
        $clstramiteresp->tuc_actualizar_respuesta_firma($actualizador);
        //EL APROBADOR DEBE TENER LA OPCIÓN REASIGNAR (NO FIRMA NI GENERA PDF) O REASIGNAR Y ENVIAR CONTESTACIÓN.
        //CREACION DE PDF 
        include_once("../ajax/prev_respuesta_pdf.php"); 
        include_once("../librerias/pdf/reportes/respuesta_tramite_crearpdf.php"); 
        $redireccion="ui_firmar_tramite.php";
        if($resultado_crear==1){
            /*REGISTRAR PROCESO EN AUDITORIA*/
            $clsaud = new clsauditoria();
            $clsaud->setAud_fechahora_proceso($fecha_firma);
            $clsaud->setAud_objeto("TRAMITE");
            $clsaud->setAud_proceso("GENERACIÓN DE DOCUMENTO DE RESPUESTA");
            $clsaud->setTu_id($tramite);
            $clsaud->setUsu_id($_SESSION["codusuario"]);
            $clsaud->setAud_descripcion("");
            $clsaud->auditoria_insertar();
            //REDIRECCIONAR
            //exit();
            //redireccionar("../".$redireccion.".php?proc=rftra&est=1");
            redireccionar("../".$redireccion."?idtu=".$tramite."&rea=".$reasignado_a."&obs=".$observaciones_r);
			//redireccionar("../".$redireccion."?idtu=".$tramite."&ruta=".$ruta_archivo."&rea=".$reasignado_a."&obs=".$observaciones_r);
        }else{
            redireccionar("../".$redireccion.".php?proc=rftra&est=0");
        }
        //FIRMA DEL ARCHIVO --PENDIENTE Y EN UNA SIGUIENTE PÁGINA--
    }else{
        $fecha_reasignacion = date("Y-m-d H:i:s"); //fecha de ingreso
        /*ACTUALIZAR EL TRAMITE_USUARIO*/
        $clstramiteusuario = new clstramiteusuario();
        $clstramiteusuario->setTu_id($tramite);
        $clstramiteusuario->setUsu_iid($reasignado_a);
        $clstramiteusuario->setEt_id($nuevo_estado);
        $reasignacion=$clstramiteusuario->tra_reasignar("ct_tramite_usuario");

        /*ACTUALIZAR TRÁMITE ESPECÍFICO*/
        /*switch ($id_tramite){
            case "8": $clstramitee = new clstramite8();
                break;
            case "12": $clstramitee = new clstramite12();break;
        }
        $clstramitee->setTu_codigo($cod_tramite);
        $idtue=$clstramitee->tra_seleccionar_bycodigo();
        $idtue= mysqli_fetch_array($idtue);*/
        $clstramitee->setTu_id($idtue["tu_id"]);
        $clstramitee->setUsu_iid($reasignado_a);
        $clstramitee->setEt_id($nuevo_estado);
        $reasignacion=$clstramitee->tra_reasignar("_ct_tramite".$id_tramite);
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
            //ENVIAR MAIL
            $ttipot=new cl_tramites();
            $ttipot->setTra_id($id_tramite);
            $tipot=$ttipot->tra_seleccionar_byid();
            $tipot= mysqli_fetch_array($tipot);
            $tipo_mensaje="reasignacion_tra";
            $clsusuario = new clsusuarios();
            $clsusuario->setUsu_id($reasignado_a);
            $ddestinatario=$clsusuario->usu_email_byid();
            $ddestinatario= mysqli_fetch_array($ddestinatario);
            $destinatario=$ddestinatario["usu_correo"];
            $mensaje_especifico="<p>Estimado/a <b>".$ddestinatario["usu_nombre"]." ".$ddestinatario["usu_apellido"]."</b>, se le ha asignado el siguiente trámite:</p>";
            $mensaje_especifico.="<div class='bloque_especifico'><p><b>Tipo de trámite:</b> ".$tipot["tra_nombre"]."</p>";
            $mensaje_especifico.="<p><b>CUT:</b> ".$cod_tramite."</p>";
            $mensaje_especifico.="<p><b>Fecha de ingreso:</b> ".$idtue["tu_fecha_ingreso"]."</p>";
            $mensaje_especifico.="<p><b>Fecha estimada de respuesta:</b> ".$idtue["tu_fecha_aprocont"]."</p></div>";
            $mensaje_especifico.="<p><b>Remite:</b> ".$_SESSION["nombre"]."</p></div>";
            $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
            $template="../includes/email_template_interno.html";
            sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$destinatario,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
            //include_once "enviar_correo.php";
            //REDIRECCIONAR
            //exit();
            redireccionar("../".$redireccion.".php?proc=reatra&est=1");
        }
    }
}
?>