<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Firmar y Gestionar";
$opcion="Trámite";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramiteusuario.php");
if((isset($_GET["idtu"])&&(!empty($_GET["idtu"])))){ //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($_GET["idtu"]);
    $ttramite = $tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tra_id=$ttramite["tra_id"]; //ID DEL TRÁMITE
    $tra_codigo=$ttramite["tu_codigo"];
    //echo $tra_id;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Para finalizar este proceso, firme el documento y haga clic en "Completar Proceso".
        </div>
    </div>
</div>
<?php
$redireccion="";
switch ($_SESSION["codperfil"]){
    case EJECUTOR: $redireccion="ui_bandeja_revision.php"; break;
    case APROBADOR: $redireccion="ui_bandeja_revision.php"; break;
}
?>
    <?php
	$nombre_archivo=$tra_codigo.'.pdf';
        $ruta_archivo=RUTA_ARCHIVOSTRAMITES.$tra_codigo."/".$nombre_archivo;
	$archivo_firmar=".".$ruta_archivo;
    //$archivo_firmar=".".$_GET["ruta"];
    //echo $archivo_firmar;
    //$archivo_firmar="./upload/img20200925_12290730.pdf";
    /* 
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    include_once './includes/ws_firmaEc.php';
    ?>
<div class="container-fluid">
    <div class="row msuperior">
        <div class="col-xs-3">
            <a class="btn btn-info btnanchocompleto" href="<?php echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
        </div>
        <div class="col-xs-3">
            <button onclick="javascript:location.reload()" type="submit" class="btn btn-secondary btnanchocompleto" data-dismiss="modal"><i class="zmdi zmdi-refresh-alt"></i>&nbsp; Recargar Página</button>
        </div>
        <!--<div class="col-xs-3">
            <a href="firmaec://<?php //print $sistema ?>/firmar?token=<?php //print $token ?><?php //print $certificadoDigital ?><?php //print $estampado ?><?php //print $pre ?>" ><button type="button" class="btn btn-primary btnanchocompleto" ><i class="zmdi zmdi-border-color"></i> &nbsp;&nbsp; Firmar Respuesta</button></a>
        </div>-->
        <div class="col-xs-3">
            <?php if(isset($_GET["pro"])&&($_GET["pro"]=="cont")){
                $controlador="controller/contestar_tramite.php";
                $reasignado_a=0;
            }else{
                $controlador="controller/reasignar_tramite.php";
                $reasignado_a=$_GET["rea"];
            }
            ?>
            <form id="form_completarproceso" action="<?php echo $controlador;?>" method="post">
                <input type="hidden" name="id_tu_r" id="id_tu_r" value="<?php echo $_GET["idtu"] ?>"/>
                <input type="hidden" name="id_tra" id="id_tra" value="<?php echo $tra_id;?>"/>
                <input type="hidden" name="cod_tra" id="cod_tra" value="<?php echo $tra_codigo;?>"/>
                <input type="hidden" name="reasignado_a" id="reasignado_a" value="<?php echo $reasignado_a ?>"/>
                <input type="hidden" name="observaciones_r" id="observaciones_r" value="<?php echo $_GET["obs"] ?>"/>
                <input type="hidden" name="firma" id="firma" value="0"/>
                <button type="button" onclick="validar_archivofe('<?php echo $tra_codigo;?>')" class="btn btn-success bnt_reasignar_firmar btnanchocompleto"><i class="zmdi zmdi-swap"></i> &nbsp;Completar Proceso</a>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.open("firmaec://<?php print $sistema ?>/firmar?token=<?php print $token ?><?php print $certificadoDigital ?><?php print $estampado ?><?php print $pre ?>");    
</script>
<?php 
$documento_visualizar=$ruta_archivo;
include_once("_visualizar_tramite.php");
?>
<?php 
include_once("./includes/footer.php");
include_once('./modal/auditoria.php'); 
?>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/_ui_firmar_tramite.js"></script>
<?php
}else{ //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:".RUTA_BANDEJAS_UI);
}
?>


