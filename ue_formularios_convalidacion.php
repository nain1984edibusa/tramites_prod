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
include_once("./modelo/clstramiteusuario.php");
include_once("./modelo/clstramiterequisitos.php");
/*generar instancias*/
if((isset($_GET["idtu"])&&(!empty($_GET["idtu"])))){ //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($_GET["idtu"]);
    $ttramite=$tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tramite = new cl_tramites();
    $tramite->setTra_id($ttramite["tra_id"]);
    //echo "idtra ".$ttramite["tra_id"]."<br>";
    $ntramite = $tramite->tra_seleccionar_byid();
    $ntramite = mysqli_fetch_array($ntramite);
    $opcion = $ntramite["tra_nombre"];
    $tra_codigo=$ttramite["tu_codigo"];
    $tra_id=$ttramite["tra_id"];
     /*$estado_inicial = "1"; // ENVIAR HACIA EL ASIGNADOR DEL TRÁMITE
    $tramite_tiempo = $ntramite["tra_tiempo"];
    $inicia_tramite = $ntramite["tra_ingreso"]; //ZONAL O MATRIZ
    $requisitos = new clstramiterequisitos();
    $requisitos->setTra_id($tu["tra_id"]);
    $trequisitos=$requisitos->obtener_tramiterequisitos();*/
    include_once("./includes/header.php");
    include_once("./includes/navbar.php");
    include_once("./includes/top.php");
    include_once("./includes/functions.php");
?>
<?php
$redireccion="";
switch ($_SESSION["codperfil"]){
    case CIUDADANO: 
        if(($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS1)||($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS2)){
            $redireccion="ue_bandeja_convalidacion.php"; 
        }else{
            $redireccion="ue_bandeja_enviados.php"; 
        }
        break;
    case ASIGNADOR: $redireccion="ui_bandeja_recibidos.php"; break;
    case EJECUTOR: $redireccion="ui_bandeja_revision.php"; break;
    case APROBADOR: $redireccion="ui_bandeja_revision.php"; break;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
                <?php if ($_SESSION["codperfil"]!=CIUDADANO):?>
                
                <?php switch($ttramite["tu_band_convalidar"]){
                    case 1:?>
                        <li><i class="zmdi zmdi-swap btn-desactivado" title="Acción no permitida"></i> Reasignar</li>
                        <li><a href="#" data-toggle="modal" data-target="#ConvalidarTramite" title='Convalidar' onclick="convalidar_tramite('<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["tra_id"]?>','<?php echo $ttramite["reg_id"]?>');"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a></li>
                <?php break;
                    case 0:?>
                        <li><a href="#" data-toggle="modal" data-target="#ReasignarTramite" title='Reasignar' onclick="reasignar_tramite('<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["tra_id"]?>');"><i class="zmdi zmdi-swap"></i> Reasignar</a></li>
                        <li><i class="zmdi zmdi-rotate-ccw btn-desactivado" title="Acción no permitida"></i> Convalidar</li>   
                <?php break;
                }?>
                <?php endif;?>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php include_once './includes/errores.php';?>
</div>
<?php
    include_once "includes/_visualizar_tramite.php";
?>
<?php
include_once("./_form_con/ct_".$ttramite["tra_id"].".php");
?>
<script type="text/javascript" src='./js/autocompletar_ubicacion.js'></script>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<?php 
include_once("./includes/footer.php"); 
include_once('./modal/auditoria.php'); 
}else{ //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:".RUTA_CATALOGO_TRAMITES);
}
?>

