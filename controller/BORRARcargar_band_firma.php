<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*PROCESO DE ACTIVACIÓN DE USUARIO*/
/*Recibe la identificación del usuario y activa al usuario registrado*/
?>
<?php
if(isset($_GET["cut"])){ //SI SE RECIBIERON DATOS
    require_once '../config/variables.php';
    require_once '../modelo/Db.class.php';
    require_once '../modelo/Config.class.php';
    require_once "../modelo/clstramiteusuario.php";
    require_once "../modelo/util.php";
    $clstramite = new clstramiteusuario;
    $clstramite->setTu_codigo($_GET["cut"]);
    $clstramite->setTu_band_firma("1");
    $clstramite->tra_cambiar_bandfirma();
}
?>

