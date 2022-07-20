<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*PROCESO DE ACTIVACIÓN DE USUARIO*/
/*Recibe la identificación del usuario y activa al usuario registrado*/
?>
<?php
if(isset($_GET["usuident"])){ //SI SE RECIBIERON DATOS
    require_once '../config/variables.php';
    require_once '../modelo/Db.class.php';
    require_once '../modelo/Config.class.php';
    require_once "../modelo/clsusuarios.php";
    require_once "../modelo/util.php";
    $clsusu = new clsusuarios;
    $clsusu->setUsu_identificador($_GET["usuident"]);
    $clsusu->setUsu_estado("ACTIVO");
    switch($clsusu->usu_cambiar_estado()){
        case 1:
            redireccionar("../index.php?proc=act&est=1");
            break;
        case 0:
            redireccionar("../index.php?proc=act&est=0");
            break;        
    }
}
?>

