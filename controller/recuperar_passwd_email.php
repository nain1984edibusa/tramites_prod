<?php

include_once("../config/variables.php");
include_once '../modelo/clsusuarios.php';
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");

//require '../librerias/PHPMailer/PHPMailerAutoload.php';
//require '../librerias/PHPMailer/src/PHPMailer.php';
//require '../librerias/PHPMailer/src/SMTP.php'; 
//require '../librerias/PHPMailer/src/Exception.php';
require_once '../includes/functions.php';
$template = "../includes/email_template.html";
$objUsuario = new clsusuarios();

if (isset($_POST["recuperaEmailInput"]) && (!empty($_POST["recuperaEmailInput"]))) {
    $email = $_POST["recuperaEmailInput"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error = "<p>Invalid email address please type a valid email address!</p>";
    } else {


        $objUsuario->setUsu_correo($email);
        $resultQuery = mysqli_fetch_array($objUsuario->seleccionarByEmail());
        if ($resultQuery) {
            $objUsuario->setUsu_id($resultQuery["usu_id"]);
            //$expFormat = mktime(date("H")+1, date("i"), date("s"), date("m") ,date("d"), date("Y"));
            //$expDate = date("Y-m-d H:i:s",$expFormat);
            //$key = md5(2418*2+$email);
            //$addKey = substr(md5(uniqid(rand(),1)),3,10);
            //$key = $key . $addKey;
            //$mail = new PHPMailer();     
            $tipo_mensaje = "recupera_passwd";
            //$titulo="Solicitud de recuperación de contraseña";
            $destinatario = $objUsuario->getUsu_correo();
//            $urlRecuperacion = "https://inpcz3.servehttp.com/tramites_publico/recupera_contrasena_form.php" . "?idUser=" . $resultQuery["usu_id"] . "&email=" . $objUsuario->getUsu_correo();
            $urlRecuperacion = "https://inpcz3.servehttp.com/tramites_publico/recupera_contrasena_form.php" . "?idUser=" . $resultQuery["usu_id"] . "&email=" . $objUsuario->getUsu_correo();
            $mensaje_especifico = 'Estimado/a ' . $resultQuery["usu_nombre"] . ' ' . $resultQuery["usu_apellido"] . ", para poder recuperar su contraseña de acceso haga click en el siguiente enlace: <br><br>" . ' <a href="' . $urlRecuperacion . '">Recuperar Contraseña</a>';
            $correo_destino = $objUsuario->getUsu_correo();
            $nombre_destino = $resultQuery["usu_nombre"] . ' ' . $resultQuery["usu_apellido"];
            $mensaje = "<div class='cuerpo_mensaje'>";
            include_once "./enviar_correo.php";
            $mensaje .= "<h4 class='txt_titulo'>" . $titulo . "</h4>";
            $mensaje .= $cuerpo . "</div>";
            echo '<script language="javascript">alert("Se ha enviado un correo electrónico con un link para restablecer su contraseña.");</script>';

//        echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_publico";</script>';
        } else {
            echo '<script language="javascript">alert("Error. No se ha encontrado usuario registrado con ese email.");</script>';
//         echo '<script language="javascript">window.location.href="https://inpcz3.servehttp.com/tramites_publico";</script>';  
        }
    }
}
?>

