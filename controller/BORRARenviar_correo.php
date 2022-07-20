<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*ENVÍO DE CORREOS*/
/* Se hace un include de este archivo para enviar un correo electrónico, conforme el formato de envío de emails*/
//incluimos la clase PHPMailer
//include("../includes/functions.php");
//include("../config/variables.php");
$template="../includes/email_template.html";
$titulo="";$cuerpo="";
switch($tipo_mensaje){
    case "convalidar_tra":
        $titulo="Su trámite se encuentra en proceso de convalidación !!!";
        $cuerpo.=$mensaje_especifico;
        $cuerpo.="<p>Recuerde que puede ingresar a la plataforma online a revisar el estado de su trámite, mediante el link:</p>";
        $cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Trámites en Línea INPC</a></p>";
        $cc=$namecc="";
        break;
    case "registro_usu":  /*L*/
        $titulo="Su cuenta ha sido creada exitosamente!";
        $cuerpo.=$mensaje_especifico;
        $cuerpo.="<p>Si usted no registró una cuenta en el sistema, ignore este mensaje.</p>";
        $cc=$namecc="";
        break;
    case "registro_tra": /*L*/
        $titulo="Su trámite ha sido ingresado exitosamente!"; 
        $cuerpo.=$mensaje_especifico;
        $cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
        $cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Trámites en Línea INPC</a></p>";
        break;
    case "reasignacion_tra": 
        $titulo="Tramite recibido/reasignado !!!";
        $cuerpo.=$mensaje_especifico;
        $cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para gestionar sus trámites:</p>";
        $cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Trámites en Línea INPC</a></p>";
        $cc=$namecc="";
        break;
    case "contestacion_tra":
		$titulo="Su trámite ha sido contestado !!!";
        $cuerpo.=$mensaje_especifico;
        $cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
        $cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Trámites en Línea INPC</a></p>";
        $cc=$namecc="";
		break;
   case "recupera_passwd":
	$titulo="Solicitud de recuperación de contraseña";
        $cuerpo.=$mensaje_especifico;
        //$cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
        //$cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Tr�mites en L�nea INPC</a></p>";
        $cc=$namecc="";
	break;
    case "actualiza_cuenta":
	$titulo="Actualizacion de Datos Personales";
        $cuerpo.=$mensaje_especifico;
        //$cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
        //$cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Tr�mites en L�nea INPC</a></p>";
        $cc=$namecc="";
	break;
}
$mensaje="<div class='cuerpo_mensaje'>";
$mensaje.="<h4 class='txt_titulo'>".$titulo."</h4>";
$mensaje.=$cuerpo."</div>";
sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$destinatario,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,$cc,$namecc);