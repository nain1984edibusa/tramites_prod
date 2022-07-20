<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Bandeja de Trámites";
$opcion="Por subsanar";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, en la cual se muestran todos los trámites por convalidar: <strong> revisado, con errores en los requisitos y/o formulario de solicitud</strong>.
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UE;?>">Inicio</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo $opcion?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php include_once './includes/errores.php'; 
    if(!isset($_GET["proc"])):?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>Importante:</strong> Tiene <strong class="navm_bandeja_convalidacion"></strong> trámite(s) por convalidar; resuelva los errores detectados en el trámite y re-envíelo para su revisión.						
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
<!--<div class="container-fluid">
    <div class="outer_div">			
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="info">
                        <th style="width: 5%">Cod</th>
                        <th style="width: 50%">Trámite</th>
                        <th style="width: 10%">Fecha de Ingreso</th>
                        <th style="width: 10%">Fecha Convalidación</th>
                        <th style="width: 20%">Observaciones</th>
                        <th style="width: 10%;" class="text-right">Acciones</th>	
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AS2321</td>
                        <td>Autorización de salida de fragmentos o pequeñas muestras arqueológicas o paleontológicas del Patrimonio Cultural</td>
                        <td>2020/03/14</td>
                        <td>2020/03/21</td>
                        <td>Falta requisito (...)</td>
                        <td class="text-right">
                            <a href="#" class='btn btn-default' title='Descargar respuesta' onclick="reimprimir('');"><i class="zmdi zmdi-download"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php //include_once("./includes/paginador.php"); ?>
        </div>
    </div>
</div>-->
<div id="loader"></div>
<div class="resultados container-fluid"></div>
<?php
include_once("./includes/footer.php"); 
include_once('./modal/auditoria.php'); 
?>
<script type="text/javascript" src="js/_ue_bandeja_convalidacion.js"></script>
<script type="text/javascript" src="js/funciones_generales.js"></script>