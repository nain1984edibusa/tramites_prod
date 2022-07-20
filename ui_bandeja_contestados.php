<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Bandeja de Trámites";
$opcion="Contestados";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestran todos los trámites en contestados.
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
    <!--<h3 class="text-center all-tittles encabezado-tabla">Listado de devoluciones pendientes</h3>-->
</div>
<?php
include_once("./includes/footer.php"); 
include_once('./modal/auditoria.php'); 
?>
<script type="text/javascript" src="js/_ui_bandeja_contestados.js"></script>
<script type="text/javascript" src="js/funciones_generales.js"></script>