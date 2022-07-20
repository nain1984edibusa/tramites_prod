<?php

include_once("../config/variables.php");
include_once '../modelo/clsusuarios.php';
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");


$idUs = $_POST["idUsuario"];
//$correo = $_POST["email"];
$nuevoPassword = $_POST["clave"];
$repPassword = $_POST["reclave"];
if(isset($_POST["idUsuario"]) && (!empty($_POST["idUsuario"])) ){  
    $objUsuario = new clsusuarios();     
    $objUsuario->setUsu_id($idUs);
    //$objUsuario->setUsu_correo($correo);
    if(($nuevoPassword == $repPassword)){
        //echo $nuevoPassword;
        $objUsuario->setUsu_contrasena(password_hash($nuevoPassword,PASSWORD_BCRYPT));
    //$objUsuario->setUsu_contrasena(hash('sha256', $nuevoPassword));
        if($objUsuario->recuperaContrasena()){
            echo '<script language="javascript">alert("Se ha restablecido su contraseña correctamente. ");</script>';
            echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_publico";</script>';
        } 
        else{
            echo '<script language="javascript">alert("No se pudo restablecer su contraseña, por favor intentelo nuevamente. ");</script>';
            echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_publico";</script>';
        }
        
    }
    else{
        echo '<script language="javascript">alert("Las contraseñas no coinciden, por favor intente nuevamente.");</script>';
        echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_publico/recupera_contrasena_form.php?idUser='.$idUs.'&email='.$correo.'";</script>';
        
    }
    
}

