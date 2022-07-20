<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

$modulo="Iniciar Trámite";
include_once("./config/variables.php");
/*incluir modelo(s)*/
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramites.php");
include_once("./modelo/clstramiterequisitos.php");
/*generar instancias*/
if((isset($_GET["idt"])&&(!empty($_GET["idt"])))){ //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramite = new cl_tramites();
    $tramite->setTra_id($_GET["idt"]);
    $ntramite = $tramite->tra_seleccionar_byid();
    $ntramite = mysqli_fetch_array($ntramite);
    $opcion = $ntramite["tra_nombre"];
    $estado_inicial = "1"; // ENVIAR HACIA EL ASIGNADOR DEL TRÁMITE
    $tramite_tiempo = $ntramite["tra_tiempo"];
    $inicia_tramite = $ntramite["tra_ingreso"]; //ZONAL O MATRIZ
    //$receptor_tramite = ; 
    //OBTENER REQUISITOS
    $requisitos = new clstramiterequisitos();
    $requisitos->setTra_id($_GET["idt"]);
    $trequisitos=$requisitos->obtener_tramiterequisitos();
    include_once("./includes/header.php");
    include_once("./includes/navbar.php");
    include_once("./includes/top.php");
    include_once("./includes/functions.php");
?>
<div class="container-fluid descripcion-container">
    <div class="row">
        <!--<div class="col-xs-12 col-sm-2 col-md-2">
            <img src="assets/img/flat-book.png" alt="pdf" class="img-responsive center-box">
        </div>-->
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            <?php echo $ntramite["tra_descripcion"]?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_CATALOGO_TRAMITES;?>">Catálogo de Trámites</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo recortar_texto_bc($opcion);?></li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php include_once './includes/errores.php'; ?>
</div>
<?php
include_once("./_form_req/".$ntramite["tra_reqform"]);
?>
<script type="text/javascript" src='./js/autocompletar_ubicacion.js'></script>
<?php include_once("./includes/footer.php"); 
}else{ //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:".RUTA_CATALOGO_TRAMITES);
}
?>

