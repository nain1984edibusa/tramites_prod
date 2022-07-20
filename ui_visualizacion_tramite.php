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
    //echo $tra_id;
?>
<!--<div class="container-fluid descripcion-container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            <?php //echo $ttramite["tra_nombre"]?>
        </div>
    </div>
</div>-->
<?php
$redireccion="";
switch ($_SESSION["codperfil"]){
    /*case CIUDADANO: 
        if(($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS1)||($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS2)){
            $redireccion="ue_bandeja_convalidacion.php"; 
        }else{
            $redireccion="ue_bandeja_enviados.php"; 
        }
        break;*/
    case ASIGNADOR: 
        if(($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS1)||($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS2)){
            $redireccion="ui_bandeja_convalidacion.php"; 
        }else{
            $redireccion="ui_bandeja_recibidos.php"; 
        }
        break;
    case EJECUTOR: 
        if(($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS1)||($ttramite["et_id"]==CONVALIDACIÓN_REQUISITOS2)){
            $redireccion="ui_bandeja_convalidacion.php"; 
        }else{
            $redireccion="ui_bandeja_revision.php"; 
        }    
        break;
    case APROBADOR: 
        $redireccion="ui_bandeja_revision.php"; break;
}
?>
<div class="container-fluid">
    <div class="row msuperior">
        <div class="col-xs-3">
            <a class="btn btn-info btnanchocompleto" href="<?php echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
        </div>
        <?php 
            if ($_SESSION["codperfil"]==ASIGNADOR):
                switch($ttramite["tu_band_convalidar"]){
                case -1: /* NO REASIGNAR NI CONVALIDAR*/?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-swap btn-desactivado" title="Acción no permitida"></i> Reasignar</a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-rotate-ccw btn-desactivado" title="Acción no permitida"></i> Convalidar</li></a>
                    </div>
                <?php break;
                case 0: /* REASIGNAR, NO CONVALIDAR*/?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-secondary btnanchocompleto" data-toggle="modal" data-target="#ReasignarTramite" title='Reasignar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["reg_id"]?>','<?php echo $ttramite["tra_respuesta"]?>','<?php echo $ttramite["tra_id"]?>');"><i class="zmdi zmdi-swap"></i> Reasignar</a></li>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-rotate-ccw btn-desactivado" title="Acción no permitida"></i> Convalidar</li></a>
                    </div>
                <?php break;
                case 1: /*NO REASINGAR, CONVALIDAR*/?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-swap btn-desactivado" title="Acción no permitida"></i> Reasignar</a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto" data-toggle="modal" data-target="#ConvalidarTramite" title='Convalidar' onclick="convalidar_tramite('<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["tra_id"]?>','<?php echo $ttramite["reg_id"]?>');"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a>
                    </div>
                <?php break;
                }    
            endif;
        ?>
        <?php if ($_SESSION["codperfil"]==EJECUTOR):?>
            <?php switch($ttramite["tu_band_convalidar"]){
                case -1:?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-attachment-alt"></i> Añadir Respuesta</a>
                    </div>
            <?php break;
               case 1:?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-secondary btnanchocompleto" data-toggle="modal" data-target="#ConvalidarTramite" onclick="convalidar_tramite('<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["tra_id"]?>','<?php echo $ttramite["reg_id"]?>');"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-attachment-alt"></i> Añadir Respuesta</a>
                    </div>
            <?php break;
               case 0:?>
                    <?php if($ttramite["tu_band_respuesta"]==0){ ?>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a>
                        </div>
                        <div class="col-xs-3">    
                            <a href="ui_respuestas_tramites.php?idt=<?php echo $ttramite["tra_id"]?>&idtu=<?php echo $ttramite["tu_id"]?>" class="btn btn-primary btnanchocompleto"><i class="zmdi zmdi-attachment-alt"></i> Añadir Respuesta</a>
                        </div>
                    <?php }else{?>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a>
                        </div>
                        <div class="col-xs-3">    
                            <a href="ui_respuestas_tramites.php?idt=<?php echo $ttramite["tra_id"]?>&idtu=<?php echo $ttramite["tu_id"]?>" class="btn btn-primary btnanchocompleto"><i class="zmdi zmdi-attachment-alt"></i> Añadir Respuesta</a>
                        </div>  
                    <?php } ?>
            <?php break;
                }
            ?>
        <?php endif;?>
        <?php if ($_SESSION["codperfil"]==APROBADOR):?>
            <?php switch($ttramite["tu_band_convanxres"]){ 
                    case -1:?>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-swap"></i> Reasignar</a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-border-color"></i> Firmar y Contestar</a>
                        </div>
                <?php break;
                    case 0:?>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-swap"></i> Reasignar</a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-primary btnanchocompleto" data-toggle="modal" data-target="#ReasignarTramite" onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["reg_id"]?>','<?php echo $ttramite["tra_respuesta"]?>','<?php echo $ttramite["tra_id"]?>','2');"><i class="zmdi zmdi-border-color"></i> Firmar y Contestar</a>
                        </div>
                <?php break;
                    case 1:?>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-secondary btnanchocompleto" data-toggle="modal" data-target="#ReasignarTramite" onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["reg_id"]?>','<?php echo $ttramite["tra_respuesta"]?>','<?php echo $ttramite["tra_id"]?>');"><i class="zmdi zmdi-swap"></i> Reasignar</a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-border-color"></i> Firmar y Contestar</a>
                        </div>    
                <?php break;
                } ?>
            <?php endif;?>
        <?php /*if (($_SESSION["codperfil"]!=CIUDADANO)&&(($ttramite["et_id"]!=CONVALIDACIÓN_REQUISITOS1)&&($ttramite["et_id"]!=CONVALIDACIÓN_REQUISITOS2))):?>
        <?php switch($ttramite["tu_band_respuesta"]){
            case 1:?>
                <div class="col-xs-3">
                    <a href="#" class="btn btn-secondary btnanchocompleto btndesactivado"><i class="zmdi zmdi-swap btn-desactivado" title="Acción no permitida"></i> Reasignar</a>
                </div>
            <?php break;
            case 0:?>
                <div class="col-xs-3">
                    <a href="#" class="btn btn-secondary btnanchocompleto" data-toggle="modal" data-target="#ReasignarTramite" title='Reasignar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["reg_id"]?>','<?php echo $ttramite["tra_respuesta"]?>','<?php echo $ttramite["tra_id"]?>');"><i class="zmdi zmdi-swap"></i> Reasignar</a></li>
                </div>
            <?php
            break;
        }
        ?>
        <?php 
            if (($_SESSION["codperfil"]==APROBADOR)){
                echo "FIRMAR Y CONTESTAR";
            }else{
            switch($ttramite["tu_band_convalidar"]){
                case 1:?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto" data-toggle="modal" data-target="#ConvalidarTramite" title='Convalidar' onclick="convalidar_tramite('<?php echo $ttramite["tu_id"]?>','<?php echo $ttramite["tu_codigo"]?>','<?php echo $ttramite["tra_id"]?>');"><i class="zmdi zmdi-rotate-ccw"></i> Convalidar</a>
                    </div>
            <?php break;
                case 0:?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-primary btnanchocompleto btndesactivado"><i class="zmdi zmdi-rotate-ccw btn-desactivado" title="Acción no permitida"></i> Convalidar</li></a>
                    </div>
            <?php break;
                }
            }
        ?>
        <?php endif;*/?>
    </div>
</div>
<div class="container-fluid">
    <?php include_once './includes/errores.php';?>
</div>
<?php
    include_once './includes/_visualizar_tramite.php';
?>
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table">
            <tr class="info">
                <th colspan="6">Detalles del Trámite</th>	
            </tr>
            <?php include "_view_inf/vt_".$tra_id.".php";?>
            <input type="hidden" name="bandera_convalidar" id="bandera_convalidar" value="<?php echo $bandera_convalidar; ?>"/>
            <input type="hidden" name="bandera_convanxres" id="bandera_convanxres" value="<?php echo $bandera_convanxres; ?>"/>
        </table>
    </div>
</div>
<?php 
include_once('./modal/validar_requisitos.php');
include_once('./modal/validar_anexos.php');
include_once('./modal/validar_respuesta.php');
include_once('./modal/reasignar_tramite.php'); 
include_once('./modal/convalidar_tramite.php');
include_once("./includes/footer.php");
include_once('./modal/auditoria.php'); 
?>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/_ui_visualizacion_tramite.js"></script>
<?php
}else{ //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:".RUTA_BANDEJAS_UI);
}
?>

