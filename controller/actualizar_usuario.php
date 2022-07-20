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
if(isset($_POST["idUsuarioH"])&& isset($_POST["tipoId"])){ //SI SE RECIBIERON DATOS DEL FORMULARIO DE LOGIN
    require_once '../config/variables.php';
    require_once '../modelo/Db.class.php';
    require_once '../modelo/Config.class.php';
    require_once "../modelo/clsusuarios.php";
    require_once "../modelo/util.php";
    require_once '../includes/functions.php';
    $clsusu = new clsusuarios;
    //$clsusu->setUsu_usuario($_POST["identificacion"]);
    $clsusu->setUsu_tidentificacion($_POST["tipoId"]);
    $clsusu->setUsu_identificador($_POST["idUsuarioH"]);
    $clsusu->setUsu_nombre($_POST["nombres"]);
    $clsusu->setUsu_apellido($_POST["apellidos"]);
    $clsusu->setPro_id($_POST["id_provincia_mod"]);
    $clsusu->setCan_id($_POST["id_canton_mod"]);
    $clsusu->setPar_id($_POST["id_parroquia_mod"]);
    $clsusu->setReg_id($_POST["id_regional_mod"]);
    $clsusu->setUsu_telefono($_POST["mod_telefono"]);
    $clsusu->setUsu_direccion($_POST["direccion_mod"]);
    $clsusu->setUsu_correo($_POST["email"]);
    $clsusu->setUsu_contrasena(password_hash($_POST["clave"],PASSWORD_BCRYPT));
    $clsusu->setRol_id($_POST["id_rol"]);//ciudadano
    $clsusu->setUsu_fechcreacion(date('Y-m-d H:i:s'));
    $clsusu->setUsu_estado("INACTIVO");//CAMBIAR A INACTIVO
    
    
//        switch($clsusu->usu_insertar()){
//            case 1:
//                //enviar correo electrónico de activación
//                $correo_destino=$_POST["email"];
//                $nombre_destino=$_POST["nombres"]." ".$_POST["apellidos"];
//                $tipo_mensaje="registro_usu";
//                $destinatario=$_POST["email"];
//                $mensaje_especifico="<a href='".URL_SIS.DIRDOWNLOAD."/controller/activar_usuario.php?usuident=".$_POST["identificacion"]."'>Activar cuenta de usuario</a>";
//                include_once "enviar_correo.php";
//                //if(!$enviar_mail){
//                    //borrar usuario
//                  //  redireccionar("../index.php?proc=reg&est=2");
//                //}else{
//                //exit();
//                    redireccionar("../index.php?proc=reg&est=1");
//                //}
//                break;
//            case 0:
//                redireccionar("../index.php?proc=reg&est=0");
//                break;        
//        }
    
    
    //elseif($_POST["banderaReg"] == 0){ // si la bandera es 0 simplemente actualizamos el usuario
        $clsusu->setUsu_id($_SESSION["codusuario"]);
        if($clsusu->usu_actualizarData() == 1){
            
            $tipo_mensaje="actualiza_cuenta";
            $destinatario = $clsusu->getUsu_correo();            
            $mensaje_especifico = 'Estimado/a ' .$clsusu->getUsu_nombre(). ' '. $clsusu->getUsu_apellido().", Sus Datos han sido actualizados correctamente: <br><br>";
            $correo_destino = $clsusu->getUsu_correo();
            $nombre_destino= $clsusu->getUsu_nombre(). ' '. $clsusu->getUsu_apellido();
            $mensaje="<div class='cuerpo_mensaje'>";
            include_once "./enviar_correo.php";
            $mensaje.="<h4 class='txt_titulo'>".$titulo."</h4>";
            $mensaje.=$cuerpo."</div>";            
            //redireccionar("../index.php?proc=reg&est=0");
            echo '<script language="javascript">alert("Datos actualizados correctamente.");</script>';
            //echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_publico";</script>';
            if($clsusu->getRol_id() == 4) // Caso que sea ciudadano regresa a su menu asignado
                echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_unir/ue_home.php";</script>';
            else
                echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_unir/ui_home.php";</script>';
            
        }
        else {
            echo "Error";
        }
                    
}

?>

