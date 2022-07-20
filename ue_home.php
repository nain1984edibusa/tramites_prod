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
<div class="descripcion-container">
    <div class="row">
        <div class="col-xs-12 col-sm-2 col-md-2">
            <img src="assets/img/bienvenida.png" alt="user" class="img-responsive center-box">
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 text-justify lead">
            <?php echo BIENVENIDA;?>
        </div>
    </div>
</div>
<div class="text-center descripcion-container">
    <a href="ue_catalogo_tramites.php" class="btn btn-primary"><i class="zmdi zmdi-file-plus"></i> &nbsp;Nuevo Trámite</a>
</div>
<section class="full-reset text-center">
    <article class="tile" style="display: none">
        <a href="ue_bandeja_elaboracion.php">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-edit"></i></div>
            <div class="tile-name all-tittles">en elaboración</div>
            <div class="tile-num full-reset navm_bandeja_elaboracion"></div>
        </a>
    </article>
    <article class="tile">
        <a href="ue_bandeja_enviados.php">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-mail-send"></i></div>
            <div class="tile-name all-tittles">enviados</div>
            <div class="tile-num full-reset navm_bandeja_enviados"></div>
        </a>
    </article>
    <article class="tile">
        <a href="ue_bandeja_convalidacion.php">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-return"></i></div>
            <div class="tile-name all-tittles">por subsanar</div>
            <div class="tile-num full-reset navm_bandeja_convalidacion"></div>
        </a>
    </article>
    <article class="tile">
        <a href="ue_bandeja_contestados.php">
            <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-check"></i></div>
            <div class="tile-name all-tittles" style="width: 90%;">contestados</div>
            <div class="tile-num full-reset navm_bandeja_contestados"></div>
        </a>
    </article>
</section>
<?php include_once("./includes/footer.php"); ?>