<?php
function sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject, $template,$archivopdf,$archivoxml){
        require DIRSERVIDOR.'/librerias/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
	$mail->isSMTP();     
        $mail->SMTPDebug = 3; //para ver los errores del lado del cliente y servidor
        $mail->Debugoutput = 'html';// Indicamos que use SMTP
        $mail->Host = 'mail.patrimoniocultural.gob.ec';  // Indicamos los servidores SMTP
        $mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
        $mail->Username = $mail_username;                 // SMTP username
        $mail->Password = $mail_userpassword;                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Habilitar encriptación TLS o SSL
        $mail->Port = 465;                                    // TCP port
	$mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
	$mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
	$mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
        $mail->SMTPOptions = array(  //necesario sino me larga error
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //$mail->SMTPDebug = 2;
	$message = file_get_contents($template);
	$message = str_replace('{{first_name}}', $mail_setFromName, $message);
	$message = str_replace('{{message}}', $txt_message, $message);
	$message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
	$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
	
	$mail->Subject = $mail_subject;
        //$mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/syscatleia/xml/docelectronicos/pdfs/'.$archivopdf);
        //$mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/syscatleia/xml/docelectronicos/porfirmar/'.$archivoxml);
	$mail->msgHTML($message);
	if(!$mail->send()) {
		echo '<p style="color:red">No se pudo enviar el mensaje..';
		echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
	} else {
            echo "se envió";
	}
}