<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Bandeja de Trámites";
$opcion="En Revisión";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestran todos los trámites en revisión: en proceso de <strong> análisis de la solicitud (2)</strong>.
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UI;?>">Inicio</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo $opcion?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php include_once './includes/errores.php'; 
    if(!isset($_GET["proc"])):?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <strong>Importante:</strong> Tiene <strong class="navm_bandeja_revision"></strong> trámites en revisión; analiza información relacionada al trámite en la opción "Ver detalle" para solicitar subsanación (si días restantes > 3) o dar contestación a la solicitud.						
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif;?>
</div>
<div class="container-fluid">
    <form class="col-md-8" style="" autocomplete="off">
        <div class="group-material">
            <input type="text" style="display: inline-block !important; width: 50%;" class="material-control tooltips-general" id="q" placeholder="Coloque aquí el CUT a buscar" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el código único del trámite">
            <button type="button" class="btn" style="" onclick='load(1);'>
                <i class="zmdi zmdi-search" style=""></i>
            </button>
            <button type="button" class="btn" style="" onclick='$("#q").val("");load(1);'>
                <i class="zmdi zmdi-close" style=""></i>
            </button>
        </div>
    </form>
    <div class="col-md-4 text-right">
        <p class="subtitulo-inner text-right">Enlaces de Descarga</p>
        <ul class=''>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Versión PDF"><img class="icono-descarga" src='./assets/icons/pdf.png'/></a>
            <a href="#" data-toggle="tooltip" data-placement="top" title="Versión Hojas de Cálculo"><img class="icono-descarga" src='./assets/icons/excel.png'/></a>
        </ul>
    </div>
</div>
<div id="loader"></div>
<div class="resultados container-fluid">
</div>
<?php 
include_once("./includes/footer.php"); 
include_once('./modal/auditoria.php'); 
include_once('./modal/reasignar_tramite.php'); 
//include_once('./modal/reasignar_firmar_tramite.php'); 
?>
<script type="text/javascript" src="js/_ui_bandeja_revision.js"></script>
<script type="text/javascript" src="js/funciones_generales.js"></script>