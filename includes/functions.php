<?php

/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

function recortar_texto_bc($texto) { //recorta el texto al tamanio definido en la variable globar LONG_TEXT_BC
    if (strlen($texto) > LONG_TEXT_BC) {
        return substr($texto, 0, LONG_TEXT_BC - 6) . " (...)";
    } else {
        return $texto;
    }
}

function diferencia_fechas($fechainicio, $fechafin) {
    $diferencia = (strtotime($fechafin) - strtotime($fechainicio)) / (60 * 60 * 24);
    return $diferencia;
}

function sumar_ndias_fecha($fechainicio, $numdias) {
    $nueva_fecha = date("Y-m-d", strtotime($fechainicio . "+ " . $numdias . " days"));
    return $nueva_fecha;
}

function generar_codigo_tramite($tramite, $fecha, $usuario) {
    //ID TRAMITE A DOS CARACTERES
    if ($tramite < 10) {
        $tramite = "0" . $tramite;
    }
    //FECHA DE INGRESO SOLO NUMEROS
    $fecha = str_replace(array(' ', ':', '-'), "", $fecha);
    return $tramite . $fecha . $usuario;
}

function paginate($reload, $page, $tpages, $adjacents) {
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = '<ul class="pagination pagination-large">';
    // previous label
    if ($page == 1) {
        $out .= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
    } else if ($page == 2) {
        $out .= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
    } else {
        $out .= "<li><span><a href='javascript:void(0);' onclick='load(" . ($page - 1) . ")'>$prevlabel</a></span></li>";
    }
    // first label
    if ($page > ($adjacents + 1)) {
        $out .= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
    }
    // interval
    if ($page > ($adjacents + 2)) {
        $out .= "<li><a>...</a></li>";
    }
    // pages
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out .= "<li class='active'><a>$i</a></li>";
        } else if ($i == 1) {
            $out .= "<li><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
        } else {
            $out .= "<li><a href='javascript:void(0);' onclick='load(" . $i . ")'>$i</a></li>";
        }
    }
    // interval
    if ($page < ($tpages - $adjacents - 1)) {
        $out .= "<li><a>...</a></li>";
    }
    // last
    if ($page < ($tpages - $adjacents)) {
        $out .= "<li><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
    }
    // next
    if ($page < $tpages) {
        $out .= "<li><span><a href='javascript:void(0);' onclick='load(" . ($page + 1) . ")'>$nextlabel</a></span></li>";
    } else {
        $out .= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
    }
    $out .= "</ul>";
    return $out;
}

function subir_archivo($temporal, $nombre, $ruta) {
    $fileNameCmps = explode(".", $nombre);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $nombre) . '.' . $fileExtension;
    $uploadFileDir = DIRSERVIDOR . $ruta;
    $dest_path = $uploadFileDir . $newFileName;
    //echo $dest_path;
    if (move_uploaded_file($temporal, $dest_path)) {
        return $newFileName;
    } else {
        return 0;
    }
}

function sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject, $template, $cc = "", $namecc = "", $anexo1 = 0, $anexo2 = 0) {
    include_once DIRSERVIDOR . '/librerias/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    //$mail->SMTPDebug = 3; //para ver los errores del lado del cliente y servidor
    $mail->Debugoutput = 'html'; // Indicamos que use SMTP
    $mail->Host = 'mail.patrimoniocultural.gob.ec';  // Indicamos los servidores SMTP
    $mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
    $mail->Username = $mail_username;                 // SMTP username
    $mail->Password = $mail_userpassword;                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Habilitar encriptación TLS o SSL
    $mail->Port = 465;                                    // TCP port
    $mail->setFrom($mail_setFromEmail, $mail_setFromName); //Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
    $mail->addReplyTo($mail_setFromEmail, $mail_setFromName); //Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
    $mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
    if ($cc != "") {
        $mail->addCC($cc, $namecc);
    }
    $mail->SMTPOptions = array(//necesario sino me larga error
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $message = file_get_contents($template);
    $message = str_replace('{{first_name}}', $mail_setFromName, $message);
    $message = str_replace('{{message}}', $txt_message, $message);
    $message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
    $mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML

    $mail->Subject = $mail_subject;
    //$mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/syscatleia/xml/docelectronicos/pdfs/'.$archivopdf);
    //$mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/syscatleia/xml/docelectronicos/porfirmar/'.$archivoxml);
    $mail->msgHTML($message);
    if (!$mail->send()) {
        echo '<p style="color:red">No se pudo enviar el mensaje..';
        echo 'Error de correo: ' . $mail->ErrorInfo . "</p>";
    } else {
        //echo "se envió";
    }
}

function get_contenido_mensaje($tipo_mensaje, $mensaje_especifico) {
    $titulo = "";
    $cuerpo = "";
    switch ($tipo_mensaje) {
        case "convalidar_tra":
            $titulo = "Su trámite se encuentra en proceso de subsanación!";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Por favor ingrese al sistema de gestión de trámites ciudadanos, bandeja de trámites por subsanar y verifique las observaciones, haciendo clic en el siguiente enlace:</p>";
            $cuerpo .= "<p><a href='" . URL_SIS . DIRDOWNLOAD . "'>Sistema de Trámites en Línea INPC</a></p>";
            $cuerpo .= "<p><b>Recuerde que el tiempo de subsanación es de 10 días hábiles, fuera de este plazo, se entenderá el desistimiento del trámite y en caso de persistir la necesidad, deberá iniciar nuevamente el proceso.</b></p>";
            //$cc=$namecc="";
            break;
        case "enviar_convalidar_tra":
            $titulo = "TRÁMITE RECIBIDO";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Recuerde que puede ingresar a la plataforma online para gestionar sus trámites:</p>";
            $cuerpo .= "<p><a href='" . URL_SIS . DIRDOWNLOAD . "'>Sistema de Trámites en Línea INPC</a></p>";
            //$cc=$namecc="";
            break;
        case "registro_usu": /* L */
            $titulo = "Su cuenta ha sido creada exitosamente!";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Si usted no registró una cuenta en el sistema, ignore este mensaje.</p>";
            //$cc=$namecc="";
            break;
        case "registro_tra": /* L */
            $titulo = "Su trámite ha sido ingresado exitosamente!";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
            $cuerpo .= "<p><a href='" . URL_SIS . DIRDOWNLOAD . "'>Sistema de Trámites en Línea INPC</a></p>";
            break;
        case "registro_tra_asi": /* L */
            $titulo = "TRÁMITE RECIBIDO";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Recuerde que puede ingresar a la plataforma online para gestionar sus trámites:</p>";
            $cuerpo .= "<p><a href='" . URL_SIS . DIRDOWNLOAD . "'>Sistema de Trámites en Línea INPC</a></p>";
            break;
        case "reasignacion_tra":
            $titulo = "TRÁMITE REASIGNADO";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Recuerde que puede ingresar a la plataforma online para gestionar sus trámites:</p>";
            $cuerpo .= "<p><a href='" . URL_SIS . DIRDOWNLOAD . "'>Sistema de Trámites en Línea INPC</a></p>";
            //$cc=$namecc="";
            break;
        case "contestacion_tra":
            $titulo = "Su trámite ha sido respondido!";
            $cuerpo .= $mensaje_especifico;
            $cuerpo .= "<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
            $cuerpo .= "<p><a href='" . URL_SIS . DIRDOWNLOAD . "'>Sistema de Trámites en Línea INPC</a></p>";
            //$cc=$namecc="";
            break;
        case "recupera_passwd":
            $titulo = "Solicitud de recuperación de contraseña";
            $cuerpo .= $mensaje_especifico;
            //$cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
            //$cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Tr�mites en L�nea INPC</a></p>";
            //$cc=$namecc="";
            break;
        case "actualiza_cuenta":
            $titulo = "Actualizacion de Datos Personales";
            $cuerpo .= $mensaje_especifico;
            //$cuerpo.="<p>Recuerde que puede ingresar a la plataforma online para revisar la respuesta y descargarla:</p>";
            //$cuerpo.="<p><a href='".URL_SIS.DIRDOWNLOAD."'>Sistema de Tr�mites en L�nea INPC</a></p>";
            //$cc=$namecc="";
            break;
    }
    $mensaje = "<div class='cuerpo_mensaje'>";
    $mensaje .= "<h4 class='txt_titulo'>" . $titulo . "</h4>";
    $mensaje .= $cuerpo . "</div>";
    return $mensaje;
}

/* ADD 1/1 */

function sumasdiasemana($fecha, $dias) {
    $datestart = strtotime($fecha);
    $datesuma = 15 * 86400;
    $diasemana = date('N', $datestart);
    $totaldias = $diasemana + $dias;
    $findesemana = intval($totaldias / 5) * 2;
    $diasabado = $totaldias % 5;
    if ($diasabado == 6)
        $findesemana++;
    if ($diasabado == 0)
        $findesemana = $findesemana - 2;
    $total = (($dias + $findesemana) * 86400) + $datestart;
    return $twstart = date('Y-m-d', $total);
}

function saber_dia($fechabuscar) {
    $dias = array(1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sabado', 7 => 'Domingo');
    return $dias[date('N', strtotime($fechabuscar))];
}

function fechainicio($fecha) {
    $devolver_fecha_fs = $fecha;
    $diasem = saber_dia($fecha);
    //echo $diasem;
    if (saber_dia($fecha) == "Sabado") {
        $devolver_fecha_fs = date('Y-m-d H:i:s', strtotime($fecha . "+ 2 days"));
        $fecha = new DateTime(substr($devolver_fecha_fs, 0, 10));
        date_time_set($fecha, 8, 0, 0);
        $devolver_fecha_fs = $fecha->format('Y-m-d H:i:s');
    } elseif (saber_dia($fecha) == "Domingo") {
        $devolver_fecha_fs = date('Y-m-d H:i:s', strtotime($fecha . "+ 1 days"));
        $fecha = new DateTime(substr($devolver_fecha_fs, 0, 10));
        date_time_set($fecha, 8, 0, 0);
        $devolver_fecha_fs = $fecha->format('Y-m-d H:i:s');
    }
    return $devolver_fecha_fs;
}

function denominacion_identificador($tidentificador) {
    $result = "";
    switch ($tidentificador) {
        case "CI": $result = "de la cédula de ciudadanía Nro.";
            break;
        case "RUC": $result = "del RUC";
            break;
        case "PASAPORTE": $result = "del pasaporte Nro.";
            break;
    }
    return $result;
}

/* add */
?>

