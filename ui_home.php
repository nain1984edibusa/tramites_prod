<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="PRINCIPAL";
$opcion="Inicio";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
//$total_tramites=$_SESSION["bandeja_elaboracion"]+$_SESSION["bandeja_validacion"]+$_SESSION["bandeja_analisis"]+$_SESSION["bandeja_convalidacion"];
?>
<div class="container-fluid descripcion-container">
    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2">
            <img src="assets/img/bienvenida.png" alt="user" class="img-responsive center-box">
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
            <?php echo BIENVENIDA;?>
        </div>
    </div>
</div>
<section class="full-reset text-center"> 
    <?php if($_SESSION["codperfil"]==ASIGNADOR){?>
        <article class="tile">   
            <a href="ui_bandeja_recibidos.php">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-download"></i></div>
                <div class="tile-name all-tittles tile-name-espec">recibidos</div>
                <div class="tile-num full-reset navm_bandeja_recibidos"></div>
                <div class="tile-desc alert-danger "><b class="navm_bandeja_recibidos_d"></b> fuera de tiempo de trámite</div>
                <div class="tile-desc alert-warning"><b class="navm_bandeja_recibidos_w"></b> de contestación urgente</div>
            </a>
        </article>
    <?php } 
        if (($_SESSION["codperfil"]==EJECUTOR)||($_SESSION["codperfil"]==APROBADOR)){
    ?>
        <article class="tile">
            <a href="ui_bandeja_revision.php">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-eye"></i></div>
                <div class="tile-name all-tittles tile-name-espec">en revisión</div>
                <div class="tile-num full-reset navm_bandeja_revision"></div>
                <div class="tile-desc alert-danger"><b class="navm_bandeja_revision_d"></b> fuera de tiempo de trámite</div>
                <div class="tile-desc alert-warning"><b class="navm_bandeja_revision_w"></b> de contestación urgente</div>
            </a>
        </article>
    <?php } 
        if (($_SESSION["codperfil"]==ASIGNADOR)||($_SESSION["codperfil"]==EJECUTOR)){
    ?>
    <article class="tile">
        <a href="ui_bandeja_convalidacion.php">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-return"></i></div>
            <div class="tile-name all-tittles tile-name-espec">en subsanación</div>
            <div class="tile-num full-reset navm_bandeja_convalidacion"></div>
            <div class="tile-desc alert-danger"><b class="navm_bandeja_convalidacion_d"></b> fuera de tiempo de trámite</div>
            <div class="tile-desc alert-warning"><b class="navm_bandeja_convalidacion_w"></b> de contestación urgente</div>
        </a>
    </article>
    <?php } ?>
</section>
<?php include_once("./includes/footer.php"); ?>