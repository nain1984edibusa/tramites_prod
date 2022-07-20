<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*MENSAJES DE ERRORES*/
/*Presenta mensajes de alerta, de acuerdo a los parámetros enviados mediante redireccionamiento */
    if(isset($_GET["proc"])):
        switch ($_GET["proc"]){
            case "reatra": //REASIGNACIÓN TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El trámite no pudo reasignarse a otro usuario. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> El trámite ha sido reasignado correctamente.
                <?php
                }
                break;
            case "valanx": //VALIDAR ANEXO TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No pudo registrarse la validación del anexo. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> La validación del anexo pudo registrarse correctamente.
                <?php
                }
                break;
            case "valres": //VALIDAR RESPUESTA TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No pudo registrarse la validación de la respuesta. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> La validación de la respuesta pudo registrarse correctamente.
                <?php
                }
                break;
            case "rftra": //REASIGNACIÓN TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No pudo generarse el documento de respuesta. Inténte nuevamente.
                    </div>
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> El documento de respuesta fue generado y registrado correctamente.
                <?php
                }
                break;
            case "contra": //CONVALIDACIÓN TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El trámite no pudo enviarse a convalidación. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> El trámite se ha enviado a convalidación correctamente.
                <?php
                }
                break;
            case "ecotra": //CONVALIDACIÓN TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El trámite no pudo enviarse a revisión. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> El trámite ha sido enviado nuevamente a revisión.
                <?php
                }
                break;
            case "regtra": //REGISTRO TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El trámite no pudo registrarse. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> El trámite ha sido registrado correctamente. Podrá revisar y dar seguimiento al estado de su trámite en esta bandeja.
                <?php
                }
                break;
            case "reganx": //REGISTRO ANEXO
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El anexo del trámite no pudo registrarse. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> El anexo del trámite ha sido registrado correctamente. 
                <?php
                }
                break;
            case "regres": //REGISTRO RESPUESTA
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> La respuesta del trámite no pudo registrarse. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> La respuesta del trámite ha sido registrado correctamente.
                <?php
                }
                break;
            case "restra": //RESPUESTA TRAMITE
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> La respuesta no pudo registrarse. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> La respuesta al trámite ha sido registrada correctamente. Puede proceder a reasignarla al aprobador.
                <?php
                }
                break;
            case "valreq": //VALIDACIÓN REQUISITO
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No se registró la validación del requisito. Inténte nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Proceso exitoso!</strong> La validación del requisito ha sido registrada correctamente. Si va revisado todos los requisitos, puede proceder a enviar el trámite a convalidación.
                <?php
                }
                break;
            case "ing": //INGRESO O LOGIN
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Clave y/o usuario incorrecto!</strong> Inténtelo nuevamente.
                <?php 
                }
                break;
            case "reg": // REGISTRO DE USUARIO
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El usuario ya existe, o existió un problema en su conexión a internet.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Registro exitoso!</strong> Revise su bandeja de correo electrónico y active su usuario mediante el link enviado.
                <?php
                }
                if($_GET["est"]=="2"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No se pudo enviar el correo electrónico de activación. Realice el proceso de registro nuevamente.
                <?php
                }
                break;
            case "act": // ACTIVACIÓN DE USUARIO
                if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> El usuario no pudo activarse. Inténtelo nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Activación exitosa!</strong> Ingrese su número de identificación (usuario) y la clave que ingreso en el formulario de registro.
                <?php
                }
		break;
            case "cnttra"://CONTESTAR TRAMITE
		if($_GET["est"]=="0"){?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No pudo enviarse la contestación al usuario. Inténtelo nuevamente.
                <?php
                }
                if($_GET["est"]=="1"){?>
                    <div class="alert alert-success">
                        <strong>Envío exitoso!</strong> La contestación al trámite fue generada y enviada correctamente.
                <?php
                }
		break;	
        }?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<?php                      
    endif;
?>