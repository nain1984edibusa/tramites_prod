<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

$modulo="Visualizar";
$opcion="Detalles del Trámite";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
/*incluir modelo(s)*/
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramiteusuario.php");
/*generar instancias*/
if((isset($_GET["idtu"])&&(!empty($_GET["idtu"])))){ //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($_GET["idtu"]);
    $ttramite = $tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tra_id=$ttramite["tra_id"]; //ID DEL TRÁMITE
    $tra_codigo=$ttramite["tu_codigo"];    
    $nombre_archivo=$tra_codigo.'.pdf';
    $documento_visualizar=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/".$nombre_archivo;
    $redireccion="";
    switch ($ttramite["et_id"]){
        case CONVALIDACIÓN_REQUISITOS1:
        case CONVALIDACIÓN_REQUISITOS2:
            $redireccion="ue_bandeja_convalidacion.php";
            break;
        case ANALISIS_SOLICITUD:
        case VALIDACION_REQUISITOS:
        case CONTESTADO_REVISION:
            $redireccion="ue_bandeja_enviados.php"; 
            break;
        case CONTESTADO_DESPACHADO:
            $redireccion="ue_bandeja_contestados.php";
    }
?>
<div class="container-fluid">
    <div class="row msuperior">
        <div class="col-xs-3">
            <a class="btn btn-info btnanchocompleto" href="<?php echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
        </div>
        <?php 
        if($ttramite["tu_band_convalidar"]==1){
        ?>
        <div class="col-xs-3">
            <a class="btn btn-secondary btnanchocompleto" href="./ue_formularios_convalidacion.php?idtu=<?php echo $_GET["idtu"]?>"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar y enviar</a>
        </div>    
        <?php
        
        }
        ?>
        <!--<div class="col-xs-3 lead">
            <ol class="breadcrumb">
                <li><a href="<?php //echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
            </ol>
        </div>-->
    </div>
</div>
<?php 
include_once("_visualizar_tramite.php");
?>
<?php 
include_once("./includes/footer.php");
include_once('./modal/auditoria.php'); 
?>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<?php
}else{ //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:".RUTA_BANDEJAS_UE);
}
?>