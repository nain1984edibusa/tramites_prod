<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*PROCESO DE AUTENTIFICACION*/
/*Recibe las variables del formulario de registro del index.php, verifica el captcha
 (si está bien) registra al usuario, envía el correo y redirige a la página principal del usuario con el correspondiente mensaje 
 (si no está bien) redirige al index con mensaje de error en el captcha */
?>
<?php
session_start();
if(isset($_POST["tipo_identificacion"])&&isset($_POST["identificacion"])){ //SI SE RECIBIERON DATOS DEL FORMULARIO DE LOGIN
    require_once '../config/variables.php';
    require_once '../modelo/Db.class.php';
    require_once '../modelo/Config.class.php';
    require_once "../modelo/clsusuarios.php";
    require_once "../modelo/util.php";
    require_once '../includes/functions.php';
    $clsusu = new clsusuarios;
    $clsusu->setUsu_usuario($_POST["identificacion"]);
    $clsusu->setUsu_tidentificacion($_POST["tipo_identificacion"]);
    $clsusu->setUsu_identificador($_POST["identificacion"]);
    $clsusu->setUsu_nombre($_POST["nombres"]);
    $clsusu->setUsu_apellido($_POST["apellidos"]);
    $clsusu->setPro_id($_POST["id_provincia"]);
    $clsusu->setCan_id($_POST["id_canton"]);
    $clsusu->setPar_id($_POST["id_parroquia"]);
    $clsusu->setReg_id($_POST["id_regional"]);
    $clsusu->setUsu_telefono($_POST["telefono"]);
    $clsusu->setUsu_direccion($_POST["direccion"]);
    $clsusu->setUsu_correo($_POST["email"]);
    $clsusu->setUsu_contrasena(password_hash($_POST["clave"],PASSWORD_BCRYPT));
    $clsusu->setRol_id(CIUDADANO);//ciudadano
    $clsusu->setUsu_fechcreacion(date('Y-m-d H:i:s'));
    $clsusu->setUsu_estado("INACTIVO");//CAMBIAR A INACTIVO
    switch($clsusu->usu_insertar()){
        case 1:
            //enviar correo electrónico de activación
            $correo_destino=$_POST["email"];
            $nombre_destino=$_POST["nombres"]." ".$_POST["apellidos"];
            $tipo_mensaje="registro_usu";
            $destinatario=$_POST["email"];
            $mensaje_especifico="<p>Estimado/a ".$nombre_destino." portador/a ".denominacion_identificador($_POST["tipo_identificacion"])." ".$_POST["identificacion"]." su cuenta ha sido creada exitosamente.</p>";
            $mensaje_especifico.="<p>Requerimos la confirmación de recepción de este correo para su activación, haciendo clic en el siguiente enlace:</p>";
            $mensaje_especifico.="<a href='".URL_SIS.DIRDOWNLOAD."/controller/activar_usuario.php?usuident=".$_POST["identificacion"]."'>Activar cuenta de usuario</a>";
            $mensaje=get_contenido_mensaje($tipo_mensaje,$mensaje_especifico);
            $template="../includes/email_template.html";
            sendemail(SENDEREMAIL_USER,SENDEREMAIL_PASS,SENDEREMAIL_USER,"Sistema de Trámites en Línea INPC",$destinatario,$mensaje,"INPC: Notificación Sistema de Trámites en Línea",$template,"","");
            //include_once "enviar_correo.php";
            //if(!$enviar_mail){
                //borrar usuario
              //  redireccionar("../index.php?proc=reg&est=2");
            //}else{
            //exit();
                redireccionar("../index.php?proc=reg&est=1");
            //}
            break;
        case 0:
            redireccionar("../index.php?proc=reg&est=0");
            break;        
    }
}
?>

